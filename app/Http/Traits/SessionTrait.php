<?php

namespace App\Http\Traits;
use App\Models\Student;
use App\Models\User;
use Session;

trait SessionTrait {
    public function index() {

        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }
        
        return $data::all();
    }
}