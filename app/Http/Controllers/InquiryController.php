<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Http\Response;
use App\Models\Inquiry;
use Session;
use DB;

class InquiryController extends Controller
{
    public function index(Request $request) {

        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }

        if($request->from_date == '' && $request->to_date == '') {
            $inquiry = DB::select("SELECT * FROM inquiry");
        }
        else {
            $from_date = $request->from_date;
            $to_date = $request ->to_date;
            $inquiry = DB::select("SELECT * FROM inquiry where created_at BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59'");
        }

        return view("admin.inquiry.index",compact('data','inquiry'));
    }

    public function view($id) {

        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }

        $inquiry = DB::select('select * from inquiry');

        return view("admin.inquiry.view",compact('inquiry','data'));
    }

    public function destroy($id)
    {
        Inquiry::where('Inquiry_ID', $id)->delete();
    
        return redirect()->route('inquiry')
                        ->with('success','Inquiry deleted successfully');
    }
}
