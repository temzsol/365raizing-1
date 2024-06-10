<?php

namespace App\Http\Controllers;

use App\Models\EmpLeave;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\EmployeeLeaveMail;
use App\Mail\AdminLeaveMail;
use Mail;
use Auth;
use Session;
use Validator;

class EmpLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = EmpLeave::where('emp_leaves.is_deleted', 0)
        ->join('employees', 'emp_leaves.emp_id', '=', 'employees.id')
        ->select('emp_leaves.*', 'employees.bname')
        ->orderBy('emp_leaves.id', 'DESC')
        ->paginate(20);
        return view('admin.leave_info.emp_leave_info', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpLeave  $empLeave
     * @return \Illuminate\Http\Response
     */
    public function show(EmpLeave $empLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpLeave  $empLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpLeave $empLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpLeave  $empLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpLeave $empLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpLeave  $empLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpLeave $empLeave)
    {
        //
    }

    //  For Admin Leave Information
public function AdminLeave(Request $request){
    $data = EmpLeave::where('emp_leaves.is_deleted', 0)
    ->join('employees', 'emp_leaves.emp_id', '=', 'employees.id')
    ->select('emp_leaves.*', 'employees.fname')
    ->orderBy('emp_leaves.id', 'DESC')
    ->paginate(20);
    return view('admin.leave_info.emp_leave_info', compact('data'));
}

    //  Admin Leave Information End


     //  For Employee Leave Information
public function EmpLeave(Request $request){
    $data = EmpLeave::where('emp_leaves.is_deleted', 0)
    ->join('employees', 'emp_leaves.emp_id', '=', 'employees.id')
    ->select('emp_leaves.*', 'employees.fname')
    ->orderBy('emp_leaves.id', 'DESC')
    ->paginate(20);
    return view('admin.leave_info.emp_leave_info', compact('data'));
}

public function EmpLeaveStatusApprove(Request $request,$id)
    {
        $leaveStatus=EmpLeave::find($request->id); 
        if($leaveStatus->update(['l_status'=>1]))
        {
            $emp_date=Employee::find($leaveStatus->emp_id);
            $emp_data['approve_status']=1;
            Mail::to($emp_date->official_id)->send(new EmployeeLeaveMail($emp_date));
            $response = array('success' => true, 'error' => false, 'message' => 'Employee Leave is Approved successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }
//  Leave Reject Code 
//  Leave Reject Code 
    public function EmpLeaveStatusReject(Request $request,$id)
    {
        $leaveStatus=EmpLeave::find($request->id); 
        if($leaveStatus->update(['l_status'=>2]))
        {
            $emp_date=Employee::find($leaveStatus->emp_id);
            $emp_data['approve_status']=0;
            Mail::to($emp_date->official_id)->send(new EmployeeLeaveMail($emp_date));
            $response = array('success' => true, 'error' => false, 'message' => 'Employee Leave is Rejected successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }


    //  Employee Leave Information End
}
