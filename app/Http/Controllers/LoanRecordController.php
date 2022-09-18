<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRecord;
use App\Models\LoanPackage;
use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Helpers\ActivityLog;

use Session;
class LoanRecordController extends Controller
{
    public function checkauth(){
        if(Session::has('loginID')) {
            return User::where('ID', '=', Session::get('loginID'))->first();
        }
        else
            return false;
    }

    public function records($records){
        foreach($records as $record){
            $package = LoanPackage::find($record->Package_ID);
            $user = UserAccount::find($record->User_ID);
            $amount = $package->Amount;
            $credit_amount = $package->CreditAmount;
            $period = $package->Day;
            $user_name = $user->FirstName.' '.$user->LastName;
            $record->Package_Amount = $amount; 
            $record->Credit_Amount = $credit_amount;
            $record->Username =$user_name;
            $record->Period = $period;
        }
        return $records;
    }
    public function index(){
        $records = DB::table('loan_record')->where('Status',3)->get();
        $records = $this->records($records);
        return view('admin/loan/index')->with(compact('records'));
    }
    public function application(){
        $data = $this->checkauth();
        // if(Session::has('loginID')) {
        //     $this->data = User::where('ID', '=', Session::get('loginID'))->first();
        // }
        //return $data;
        //$admin = new AdminController;
        //$this->data = $admin->loginauth();
        // if(Session::has('loginID')) {
        //     $data = User::where('ID', '=', Session::get('loginID'))->first();
        // }
        $records = DB::table('loan_record')->where('Status',0)->get();
        foreach($records as $record){
            $package = LoanPackage::find($record->Package_ID);
            $user = UserAccount::find($record->User_ID);
            $amount = $package->Amount;
            $period = $package->Day;
            $user_name = $user->FirstName.' '.$user->LastName;
            $record->Package_Amount = $amount; 
            $record->Username =$user_name;
            $record->Period = $period;
        }
        return view('admin/loan/application')->with(compact('records','data'));
    }
    public function view(Request $request){
        $id = $request->id;
        $records = DB::table('loan_record')->where('id',$id)->get();
        if(!empty($records)){
            //$gallery = Storage::disk('user_gallery')->listContents();
            $path = public_path('assets/images/loan_user_gallery/'.$id);
            if(File::exists($path))
            $galleries = File::allfiles($path);
        }
        $path = array();
        foreach($galleries as $gallery){
            $gallery = explode('/',$gallery);
            $index = array_search('assets',$gallery);
            for($i=0;$i<$index;$i++){
                unset($gallery[$i]);
            }
            $gallery = implode('/',$gallery);
            array_push($path,$gallery);
        }
        foreach($records as $record){
            $rejected = DB::table('loan_record')->where('user_id',$record->User_ID)->where('Status',2)->get();
            $completed = DB::table('loan_record')->where('user_id',$record->User_ID)->where('Status',4)->get();
            $current = DB::table('loan_record')->where('user_id',$record->User_ID)->where('Status',1)->get();
            $package = LoanPackage::find($record->Package_ID);
            $user = UserAccount::find($record->User_ID);
            $amount = $package->Amount;
            $period = $package->Day;
            $user_name = $user->FirstName.' '.$user->LastName;
            $record->Package_Amount = $amount; 
            $record->Username =$user_name;
            $record->Period = $period;
            $record->Completed = $completed;
            $record->Current =$current;
            // $record->Tracking = $tracking;
        }
        return view('admin/loan/view')->with(compact('record','path'));
    }

    public function pendingtransfer(Request $request){
        $records = LoanRecord::where('Status',1)->get();
        $records = $this->records($records);
        return view('admin/loan/pendingtransfer/index')->with(compact('records'));
    }

    public function approve(Request $request){
        $id = $request->id;
        if(LoanRecord::where('ID',$id)->update(['Status' => 1, 'Approve_Date'=> now(), ])){
            if(Session::has('loginID')) {
                $data = User::where('ID', '=', Session::get('loginID'))->first();
            }
            $data["Action"] = "approved";
            $data["Content"] = "loan application ".$id;
            ActivityLog::writeLog($data);
            return true;
        }
        else
            return false;
    }
    public function reject(Request $request){
        $id = $request->input('id');
        $reason = $request->input('reason');
        if(LoanRecord::where('ID',$id)->update(['Status' => 2, 'Reject_Date'=> now(), 'Reject_Reason' => $reason])){
            if(Session::has('loginID')) {
                $data = User::where('ID', '=', Session::get('loginID'))->first();
            }
            $data["Action"] = "rejected";
            $data["Content"] = "loan application ".$id;
            ActivityLog::writeLog($data);
            return true;
        }
        else
            return false;
    }
    public function transfer(Request $request){
        $id = $request->id;
        // $record = LoanRecord::where('ID',$id))->update(['Status' => 2, 'TransferDate', now()])
        $package = LoanRecord::find($id)->only('Package_ID');
        $package_id = $package["Package_ID"];
        $period = LoanPackage::find($package_id)->only('Day');
        $current_date = Date('y-m-d',strtotime(now()));
        return $current_date;
        $collect_date = Date('y-m-d',strtotime(now().' + '.$period['Day'].' days'));
        return $collect_date;
        $data = array(
            'Status' => 3,
            'Credited_Date' => Date('y-m-d',strtotime(now())),
            'Collect_Date' => $collect_date
        );
        if(LoanRecord::where('ID',$id)->update($data))
        return 'hehe';
        else
        return 'urm';
    }

    public function latepayment(Request $request){
        $records = LoanRecord::where('LatePayment_Day','>',0)->get();
        $records = $this->records($records);
        return view('admin/loan/latepayment')->with(compact('records'));
    }

    public function rejected(){
        $records = LoanRecord::where('Status',2)->get();
        foreach($records as $record){
            $package = LoanPackage::find($record->Package_ID);
            $user = UserAccount::find($record->User_ID);
            $amount = $package->Amount;
            $period = $package->Day;
            $user_name = $user->FirstName.' '.$user->LastName;
            $record->Package_Amount = $amount; 
            $record->Username =$user_name;
            $record->Period = $period;
        }
        return view('admin/loan/rejectedloan')->with(compact('records'));
    }

    public function active(){
        $records = LoanRecord::where('Status',3)->get();
        foreach($records as $record){
            $package = LoanPackage::find($record->Package_ID);
            $user = UserAccount::find($record->User_ID);
            $amount = $package->Amount;
            $period = $package->Day;
            $user_name = $user->FirstName.' '.$user->LastName;
            $record->Package_Amount = $amount; 
            $record->Username =$user_name;
            $record->Period = $period;
        }
        return view('admin/loan/activeloan')->with(compact('records'));
    }

    public function completed(){
        $records = LoanRecord::where('Status',4)->get();
        foreach($records as $record){
            $package = LoanPackage::find($record->Package_ID);
            $user = UserAccount::find($record->User_ID);
            $amount = $package->CreditAmount;
            $user_name = $user->FirstName.' '.$user->LastName;
            $record->Credit_Amount = $amount; 
            $record->Username =$user_name;
            $record->Period = $period;
        }
        return view('admin/loan/completedloan')->with(compact('records'));
    }

    public function complete(Request $request){
        $id = $request->id;
        $loan = LoanRecord::find($id);
        $paid_amount = $loan->Owed_Amount + $loan->LatePayment_Amount;
        if(LoanRecord::where('ID',$id)->update(
            [
                'Status' => 4, 
                'Payment_Collected' => 1,
                'LastPayment_Date'=> now(),
                'Payment_Collected' => 1, 
                'Collected_Amount' => $paid_amount
            ])){
            return true;
        }
        else
            return false;
    }
}
