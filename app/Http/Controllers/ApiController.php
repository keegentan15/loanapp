<?php

namespace App\Http\Controllers;
use Illuminate\Http\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Contact;
use App\Models\LoanRecord;
use App\Models\LoanPackage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Response; 
use Illuminate\Support\Facades\File;
use App\Helpers\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class ApiController extends Controller
{
    private function invaliduser(){
        $response = array(
            'status' => 'fail',
            'description' => 'Invalid User ID'
        );
        return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
    }
    public function token(){
        $response = array(
            'status' => 'success',
            'X-CSRF-TOKEN' => csrf_token()
        );
        return response()->json($response)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    }
    //login api to check user credential
    public function login(Request $request){
        if(($request->input('email') == null && $request->input('password') == null ) || $request->input('password') == null){
            $response = array(
                'status' => 'fail',
                'description' => 'Login credentials required'
            );
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $username_login = ['username' => $username, 'password' => $password];
        $email_login = ['email' => $email, 'password' => $password];
        $user = UserAccount::where('username',$username_login)->orWhere('email',$email)->where('password',$password)->limit(1)->get();
        // return $user[0]->Api_Token;
        if(count($user)<1){
            $response = array(
                'status' => 'fail',
                'description' => 'Invalid Credentials'
            );
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }
        else{
            // return $user;
            foreach($user as $u){
                $u->Api_Token = Crypt::decryptString($u->Api_Token);
            }
            $user->makeHidden(['Created_At']);
            $response = array(
                'status' => 'success',
                'data' => $user
            );
            return response()->json($response)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }
    }

    //register api to register user in mobile app
    public function register(Request $request){
        //if(Request::hasFile('file'))
        $validator = Validator::make($request->all(), [
            'username' => ['required','between:5,50','unique:App\Models\UserAccount,username'],
            'password' => ['required', Password::min(8)->numbers()->symbols()->mixedCase()],
            'firstname' => ['required','max:50'],
            'lastname' => ['required','max:100'],
            'contactno' => ['required','max:20'],
            'email' => ['required','max:320','unique:App\Models\UserAccount,email'],
            'address_line_1' => ['required','max:100'],
            'city' => ['required','max:25'],
            'postal_code' => ['required','digits:5','numeric'],
            'state' => ['required','max:25'],
        ]);
        if($validator->fails()){
            $response = array(
                'status' => 'fail',
                'description' => $validator->errors()
            );
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }
        else{
            $api_token = Str::random(10);
            $hashed_token = Crypt::encryptString($api_token);
            $request->request->add(['api_token'=>$hashed_token]);
            // $request->request->add(['api_token'=>$api_token]);
            $input = $request->all();
            $new_user = UserAccount::create($input);
            if($new_user -> exists){
                $registered_id = $new_user->id;
                //return registered id to create contact book for this user
                $response = array(
                    'status' => 'success',
                    'user_id' => $registered_id,
                    'api_token' => $api_token
                );
                $status_code = Response::HTTP_CREATED;
                $status_text = Response::$statusTexts[Response::HTTP_CREATED];
            }     
            else{
                $response = array(
                    'status' => 'fail',
                    'description' => 'Database insertion error'
                );
                $status_code = Response::HTTP_SERVICE_UNAVAILABLE;
                $status_text = Response::$statusTexts[Response::HTTP_SERVICE_UNAVAILABLE];
            }
            return response()->json($response)->setStatusCode($status_code, $status_text);     
        }
    }
    //create api to record all contact list of user
    public function createcontact(Request $request){
        $response =  json_decode($request->getContent(),true);
        if(empty($response["user_id"])){
            $response = array(
                "status" => 'fail',
                'description' => 'User ID is required'
            );
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }else{
            $user_id = $response["user_id"];
            if(empty(UserAccount::find($user_id))){
                $response = array(
                    'status' => 'fail',
                    'description' => 'Invalid User ID'
                );
                $status_code = Response::HTTP_BAD_REQUEST;
                $status_text = Response::$statusTexts[Response::HTTP_BAD_REQUEST];
            }else{
            // foreach($response["contacts"] as $res){
            //     $res["user_id"] = $user_id;
            //     Contact::create($res);
            // }
            $response = array(
                'status' => 'success'
            );
            $status_code = Response::HTTP_CREATED;
            $status_text = Response::$statusTexts[Response::HTTP_CREATED];
            }
            
            return response()->json($response)->setStatusCode($status_code, $status_text);
        }      
    }
    public function loanlist(Request $request){
        $user_id = $request->user_id;
        if(empty(UserAccount::find($user_id))){
            $response = array(
                'status' => 'fail',
                'description' => 'Invalid User ID'
            );
            $status_code = Response::HTTP_BAD_REQUEST;
            $status_text = Response::$statusTexts[Response::HTTP_BAD_REQUEST];
        }
        else{
            $records = LoanRecord::where('user_id',$user_id)->get();
            $records->makeHidden(['User_ID','Package_ID','Approve_Date']);
            if(count($records)){
                foreach($records as $record){
                    if($record->Reject_Date == null)
                        $record->makeHidden('Reject_Date');
                    $record->Status = LoanRecord::status[$record->Status];
                    $record->makeHidden(LoanRecord::setReturnedData($record->Status));
                    $package = LoanPackage::find($record->Package_ID);
                    $record->Package_Amount = $package->Amount;
                    // if(!empty($record->Collect_Date))
                    $record->Day = 3;
                    $record->Collect_Date = date('Y-m-d',strtotime($record->Collect_Date));
                    $record->Pay_Before = date('Y-m-d',strtotime($record->Collect_Date.' '.'4'.' Days'));
                }
            }
            else
                $records = "No record found";
            $response = array(
                'status' => 'success',
                'description' => $records
            );
            $status_code = Response::HTTP_OK;
            $status_text = Response::$statusTexts[Response::HTTP_OK];
        }
        return response()->json($response)->setStatusCode($status_code, $status_text);
    }

    public function loanpackage(){
        $package = LoanPackage::where('Status',0)->get();
        $package->makeHidden(['Status','Year','Month','CollectAmount','CreditAmount','IncrementAmount','IncrementPeriod']);
        $response = array(
            'status' => 'success',
            'description' => $package
        );
        return response()->json($response)->setStatusCode(Response::HTTP_OK,Response::$statusTexts[Response::HTTP_OK]);
    }

    public function applyloan(Request $request){
        $loan = new LoanRecord();
        if(empty(LoanPackage::find($request->Package_ID))||empty(UserAccount::find($request->User_ID))){
            $response = array(
                'status' => 'fail',
                'description' => 'Loan package or user not exists'
            );
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST,Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }
        else{
            $loan->fill($request->only('User_ID','Package_ID'));
            $apply_date = array(
                'Applied_Date' => date('Y-m-d H:i:s'),
                'Owed_Amount' => LoanPackage::select('CollectAmount')->find($request->Package_ID)->CollectAmount
            );
            $loan->fill($apply_date);
            $save = $loan->save();
            $path = public_path('assets/images/loan_user_gallery/'.$loan->id);
            if(!File::exists($path))
                File::makeDirectory($path, 0777, true, true);    
            $gallery = $request->user_gallery;
            $iterator = 1;
            
            File::makeDirectory($path, 0777, true, true); 
            foreach($gallery as $img){
                if(in_array($img->getMimeType(),FileUpload::allowedMimeType)){
                    $img->move($path,$iterator.'.'.$img->getClientOriginalExtension());
                    $iterator++;
                }
            }
            if($save){
                $response = array(
                    'status' => 'success',
                    'description' => Response::$statusTexts[Response::HTTP_CREATED]
                );
                $status_code = Response::HTTP_CREATED;
                $status_text = Response::$statusTexts[Response::HTTP_CREATED];
            }
            else{
                $response = array(
                    'status' => 'fail',
                    'description' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]
                );
                $status_code = Response::HTTP_INTERNAL_SERVER_ERROR;
                $status_text = Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR];
            }
            return response()->json($response)->setStatusCode($status_code,$status_text);
        }
    }

    public function editprofile(Request $request){
            $user_id = $request->input('user_id');
            $validator = Validator::make($request->all(), [
                'username' => ['required','between:5,50',"unique:App\Models\UserAccount,username,$user_id,id"],
                'password' => ['required', Password::min(8)->numbers()->symbols()->mixedCase()],
                'firstname' => ['required','max:50'],
                'lastname' => ['required','max:100'],
                'contactno' => ['required','max:20'],
                'email' => ['required','max:320',"unique:App\Models\UserAccount,email,$user_id,id"],
                'address_line_1' => ['required','max:100'],
                'city' => ['required','max:25'],
                'postal_code' => ['required','digits:5','numeric'],
                'state' => ['required','max:25'],
            ]);
            if($validator->fails()){
                $response = array(
                    'status' => 'fail',
                    'description' => $validator->errors()
                );
                return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
            }
            else{
                $data = $request->only(['username','password','firstname','lastname','contactno','email','address_line_1','city','postal_code','state']);
                $user = UserAccount::where('id',$user_id);
                if($user->update($data)){
                    $response = array(
                        'status' => 'success',
                        'description' => 'Profile updated'
                    );
                    $status_code = Response::HTTP_OK;
                    $status_text = Response::$statusTexts[Response::HTTP_OK];
                }
                else{
                    $response = array(
                        'status' => 'fail',
                        'description' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]
                    );
                    $status_code = Response::HTTP_INTERNAL_SERVER_ERROR;
                    $status_text = Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR];
                }
                return response()->json($response)->setStatusCode($status_code, $status_text);
            }      
    }

}
