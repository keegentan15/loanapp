<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\ActivityLog;

class AuthController extends Controller
{
    public function index() {

        return view("auth.login");
    }

    public function loginUser(Request $request){
        $request ->validate([
            'Email' => 'required',
            'Password' => 'required'
        ]);

        $user = Staff::where('Email','=',$request->Email)->first();

        if($user){
            /*if(hash::check($request->password, $user->password)){
                $request->session()->put('loginID', $user->ID);
                $request->session()->put('name', $user->UserName);
                return redirect('dashboard');
            }else {
                return back()->with('fail','Password not matches.');
            }*/
            $request->session()->put('loginID', $user->Staff_ID);
            $request->session()->put('name', $user->Username);

            return redirect('dashboard');
        }
        else {
            return redirect('login')->with('fail','This email and password does not match');
        }
    }

    public function dashboard() {

        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }
        
        return view("admin.index", compact('data'));
    }

    public function signOut(){
        if (Session::has('loginID')){
            Session::flush();
            return redirect('/login');
        }
    }

   
}
