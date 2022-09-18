<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Response;
use Session;
use DB;
use App\Helpers\ActivityLog;

class ActivityLogController extends Controller
{
    public function index(){

        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }
        
        $report_data = Staff::join('staff_activitylog', 'staff.Staff_ID', '=', 'staff_activitylog.Staff_ID')
                            ->get(['staff_activitylog.*', 'staff.Username']);

        return view('admin.activitylog.index',compact('data','report_data'));
    }
}
