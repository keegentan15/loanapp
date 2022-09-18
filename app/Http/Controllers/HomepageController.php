<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Validator;

class HomepageController extends Controller
{
    public function index() {

        return view("homepage.index");
    }

    public function ContactUsForm(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'Name' => ['required','string','max:255'],
            'Email' => ['required','email:filter','max:255'],
            'Subject' => ['required','string','max:255'],
            'Message' => ['required','string']
        ]);

        if ($validation->fails()){
            return response()->json(['code' => 400, 'msg' => $validation->errors()->first()]);
        }

        $request['Status'] = 'Unread';

        $data = Inquiry::create($request->all());
    
        return response()->json(['code' => 200, 'msg' =>'Thanks for contacting us, we will get back to you soon.']);
    }
}
