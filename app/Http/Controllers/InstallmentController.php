<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\Interest;
use App\Models\LoanAmount;
use Illuminate\Support\Facades\DB;

class InstallmentController extends Controller
{
    //
    public function index(){
        $installment = Installment::orderBy('Years','asc')->orderBy('Months','asc')->get();
        return view('admin/installment/index')->with(compact('installment'));
    }
    public function create(Request $request){
        if($request->isMethod('get'))
            return view('admin/installment/form');
        else{
            $year = $request->input('year');
            $month = $request->input('month');
            $data = Installment::create([
                'years' => $year,
                'months' => $month
            ]);
            $package_amount = DB::table('loan_package')->get();
            foreach($package_amount as $package){
                Interest::create([
                    'package_id' => $package->ID,
                    'period_id' => $data->id
                ]);
            }
        }
    }
    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = last(request()->segments());
            $data = Installment::find($id); 
            return view('admin/installment/form')->with(compact('data'));
        }
        else{
            $id = last(request()->segments());
            $year = $request->input('year');
            $month = $request->input('month');
            $data = Installment::where('id',$id)->update([
                'years' => $year,
                'months' => $month
            ]);
        }
    }
    public function delete(Request $request){
        $id = $request->input('id');
        Installment::where('id',$id)->delete();
        Interest::where('period_id',$id)->delete();
    }
}
