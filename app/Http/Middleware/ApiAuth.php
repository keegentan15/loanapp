<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Models\UserAccount;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
class ApiAuth
{
    private function invaliduser(){
        $response = array(
            'status' => 'fail',
            'description' => 'Invalid User ID'
        );
        return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
    }
    // private $api_key = "1@uN!q4l";
    private $api_key = '123';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $header_key = $request->header('Access_Key');
        $url = request()->segment(count(request()->segments()));
        $without_user_token = array(
            'login','register','token','loanpackage'
        );
        if(in_array($url,$without_user_token)){
            if($header_key != $this->api_key){
                $response = array(
                    'status' => 'fail',
                    'description' => 'Invalid API Key'
                );
                return response()->json($response)->setStatusCode(Response::HTTP_FORBIDDEN, Response::$statusTexts[Response::HTTP_FORBIDDEN]);
            }
        }
        else{
            $user_id = $request->input('user_id');
            if(UserAccount::find($user_id)==null)
                return $this->invaliduser();
            $user = UserAccount::find($user_id,['api_token']);
            if($header_key != Crypt::decryptString($user->api_token)){
                $response = array(
                    'status' => 'fail',
                    'description' => 'Invalid API Key',
                );
                return response()->json($response)->setStatusCode(Response::HTTP_FORBIDDEN, Response::$statusTexts[Response::HTTP_FORBIDDEN]);
            }
        }
        return $next($request);
    }
}
