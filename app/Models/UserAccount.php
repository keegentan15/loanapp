<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserAccount extends Model
{
    use HasFactory;
    protected $fillable = ['username','firstname','lastname','password','contactno','email','address_line_1','address_line_2','city','postal_code','state','api_token'];
    public $timestamps = false;
    protected $table = 'user';
    public function approvalList(){
        $user_list = DB::table('user')->where('status',0)->get();
        return $user_list;
    }
    public function getList(){
        $user_list = DB::table('user')->get();
        return $user_list;
    }

    public static function updateprofile($request){
        // $user = self::find($request->input('user_id'));
        // $user->update(
        //     'username' => $request->input('username'),
        //     'firstname' => $request->input('firstname'),
        //     'lastname' => $request->input('lastname'),
        //     'password' => $request->input('password'),
        //     'email' => $request->input('email'),
        //     'address_line_1' => $request->input('address_line_1'),
        //     'address_line_2' => $request->input('address_line_2'),
        //     'city' => $request->input('city'),
        // );
    }
    public function login($username,$password){
        $user = DB::table('user')->where('username',$username)->where('password',$password)->get()->first();
        if(count((array)$user)){
            
            if($user->Status == 0){
                $response = '{ "Error" : "Your account is waiting for admin approval"}';
                return json_decode((string)$response);
            }
            else{
                $user->Error = "";
                return json_decode(json_encode($user));
            }
            //return $user;
        }
        else{
            $response = '{ "Error" : "Invalid user credential. Please try again"}';
            return json_decode((string)$response);
        }
    }
}
