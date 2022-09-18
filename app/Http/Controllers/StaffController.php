<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;
use App\Http\Traits\SessionTrait;
use App\Helpers\ActivityLog;

class StaffController extends Controller
{
    use SessionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginauth(){
        if(Session::has('loginID')) {
            $data = User::where('ID', '=', Session::get('loginID'))->first();
        }
        return $data;
    }
    public function index()
    {
        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }

        $staff = DB::select('select * from staff');

        return view('admin.staff.index',compact('staff', 'data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }

        return view('admin.staff.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'required',
            'Email' =>'required',
        ]);

        $inputData = $request->all();
        $inputData['status1'] = $request->has('checkbox1');
        
        $user = Staff::create($inputData);
        $user->save();       
        
        return redirect()->route('staff.index')
                        ->with('success','Staff created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }

        $users = DB::table('staff')
            ->where('staff.Staff_ID','=',$id)
            ->first();

        return view('admin.staff.show',compact('users','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Session::has('loginID')) {
            $data = Staff::where('Staff_ID', '=', Session::get('loginID'))->first();
        }

        $users = DB::table('staff')
            ->where('staff.Staff_ID','=',$id)
            ->first();

        return view('admin.staff.edit',compact('users','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'required',
            'Email' =>'required',
        ]);

        Staff::where('Staff_ID','=',$id)->update([
            'Username'  => $request->Username,
            'Password' => $request->Password,
            'Email' => $request->Email,
            'status1' => $request->has('checkbox1'),
        ]);
        
        return redirect()->route('staff.index')
                        ->with('success','Staff updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::where('Staff_ID', $id)->delete();
    
        return redirect()->route('staff.index')
                        ->with('success','Staff deleted successfully');
    }
}