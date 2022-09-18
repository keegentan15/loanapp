<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserAccount;
use App\Exports\ContactBookExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index(){

        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }

        $user_list = DB::table('user')->get();
        return view('admin/user/index')->with(compact('user_list','data'));;
    }
    public function userapprove(){
        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }

        $model = new UserAccount;
        $user_list = $model->approvalList();
        return view('admin/user/index')->with(compact('user_list','data'));
    }
    public function approvalaction(Request $request){
        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }

        $action = $request->input('action');
        return "success";
        //$model = new UserAccount;
    }
    public function view($id){
        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }

        $model = new UserAccount;
        $user = $model->find($id);
        return view('admin/user/view')->with(compact('user','data'));
    }
    public function exportcontact($id){

        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }

        $user = UserAccount::find($id);
        $name = 'ContactList_'.$user->FirstName.'_'.$user->LastName;
        return Excel::download(new ContactBookExport($id),$name.'.xlsx');
    }
}

