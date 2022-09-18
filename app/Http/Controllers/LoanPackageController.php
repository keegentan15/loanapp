<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanPackage;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class LoanPackageController extends Controller
{   

    public function index(){
        $package = LoanPackage::orderBy('Amount','asc')->get();
        return view('admin/loanpackage/index')->with(compact('package'));
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'Amount' => ['required','numeric'],
                'LatePeriod' => ['numeric','gt:0'],
                'Day' => ['numeric','gte:0'],
                'CreditAmount' => ['required','numeric','lte:Amount'],
                'CollectAmount' => ['required','numeric','gte:Amount'],
                'IncrementAmount' => ['numeric'],
            ]);
            if($validator->fails()){ 
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            else{
                $id = $request->input('id');
                LoanPackage::where('id',$id)->create([
                    'Amount' => $request->input('Amount'),
                    'CreditAmount' => $request->input('CreditAmount'),
                    'CollectAmount' => $request->input('CollectAmount'),
                    'Day' => $request->input('Day'),
                    'IncrementAmount' => $request->input('IncrementAmount'),
                    'IncrementPeriod' => $request->input('LatePeriod'),
                    'Status' => $request->input('Status')!=null?1:0,
                ]);
                return redirect()->back();
            }
        }
        return view('admin/loanpackage/form');
    }
    
    public function updatestatus(Request $request){
        $status = $request->input('status');
        $id = $request->input('id');
        LoanPackage::where('id',$id)->update(['status' => $status]);
    }

    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = last(request()->segments());
            $package = DB::table('loanpackage')->find($id);
            return view('admin/loanpackage/form')->with(compact('package'));
        }
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'Amount' => ['required','numeric'],
                'LatePeriod' => ['numeric','gt:0'],
                //'Year' => ['numeric','gte:0'],
                //'Month' => ['numeric','gte:0'],
                'Day' => ['numeric','gte:0'],
                'CreditAmount' => ['required','numeric','lte:Amount'],
                'CollectAmount' => ['required','numeric','gte:Amount'],
                'IncrementAmount' => ['numeric'],
            ]);

            // if($request->input('Year')!=null){
            //     if(!is_numeric($request->input('Year')))
            //         $year = "error";
            //     else
            //         $year = $request->input('Year');
            // }
            // else{
            //     $year = 0;
            // }
                
            // if($request->input('Month')!=null){
            //     if(!is_numeric($request->input('Month')))
            //         $month = "error";
            //     else
            //         $month = $request->input('Month');
            // }
            // else
            //     $month = 0;
            // if($request->input('Day')!=null){
            //     if(!is_numeric($request->input('Day')))
            //         $day = "error";
            //     else
            //         $day = $request->input('Day');
            // }
            // else
            //     $day = 0;
            // if($year=="error"||$month=="error"||$day=="error"){
            //     $period = 'Period must be numeric value';
            // }    
            // else
            //     $period = $year*365+$month*12+$day;
            // if($period==0)
            //     $period = 'Loan period must be at least 1 day';
            if($validator->fails()){ 
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            // if(!is_numeric($period))
            //     $validator->errors()->add('Period',$period);
            // if($validator->errors()!=null)
            //     return $validator->errors();//redirect()->back()->withInput($request->input())->withErrors($validator);
            else{
                $id = $request->input('id');
                $package = LoanPackage::orderBy('Amount','asc')->get();
                LoanPackage::where('id',$id)->update([
                    'Amount' => $request->input('Amount'),
                    'CreditAmount' => $request->input('CreditAmount'),
                    'CollectAmount' => $request->input('CollectAmount'),
                    'Day' => $request->input('Day'),
                    'IncrementAmount' => $request->input('IncrementAmount'),
                    'IncrementPeriod' => $request->input('LatePeriod'),
                    'Status' => $request->input('Status')!=null?1:0,
                ]);
                $success = true;
                return redirect()->back()->with(compact('package','success'));
            }

            return redirect()->route('loanpackage');
        }
    }
}
