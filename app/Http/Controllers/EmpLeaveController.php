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
        ->select('emp_leaves.*', 'employees.fname')
        ->orderBy('emp_leaves.id', 'DESC')
        ->paginate(20);
        return view('admin.leave_info.emp_leave_info', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_name=Auth::user()->name;
        $user_email=Auth::user()->email;
        $leaveresult=Employee::where('official_id','=',$user_email)->where('fname','=',$user_name)->first();

        // find DOJ
        $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($leaveresult->doj)));  
        if($effectiveDate <= date('Y-m-d'))
        
        {
            $total_leave=$leaveresult->total_leave;
           
        }
        else
        {
            $total_leave = 'No leaves ,Your are on probation period' ;
        }
        $LeaveCalculate = EmpLeave::where('emp_id', $leaveresult->id)
        ->where('l_status', 1)
        ->sum('no_days');
        if($LeaveCalculate > 0)
        {
            $takenleave=$LeaveCalculate;
        }
        else{
            $takenleave=0;
        }
        return view('admin.leave_info.emp_leave_form',compact('total_leave','takenleave','effectiveDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,EmpLeave $empLeave)
    {
        $user_name=Auth::user()->name;
        $type=Auth::user()->type;
        $user_email=Auth::user()->email;
        $employeeresult=Employee::where('official_id','=',$user_email)->where('fname','=',$user_name)->first();

        $start = strtotime($request->l_date);
        $end = strtotime($request->to_date);
        $days_between = ceil(abs($end - $start) / 86400) + 1;
        if($request->leave_remaining >= $days_between)
        {
        $data=$request->all();
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachment = $this->upload_single_image($file, $folder = 'attachment');
            $data['attachment'] = $folder."/".$attachment;
        }
        $data['emp_id']=$employeeresult->id;
        $data['type']=$type;
        $data['no_days']=$days_between;
        $data['leave_remaining']=$request->leave_remaining;

        $empLeave->create($data);
        return back()->with('message', 'Leave Applyed Successfully');
        }
        return back()->with('message', 'You have less remaining leave.');

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
    ->where('emp_leaves.type','=','Admin')
    ->join('admins', 'emp_leaves.emp_id', '=', 'admins.id')
    ->select('emp_leaves.*', 'admins.fname')
    ->orderBy('emp_leaves.id', 'DESC')
    ->paginate(20);
    return view('admin.leave_info.admin_leave_info', compact('data'));
}

//  Admin Leave Approve
public function AdminLeaveStatusApprove(Request $request,$id)
    {
        $leaveStatus=EmpLeave::find($request->id); 
        if($leaveStatus->update(['l_status'=>1]))
        {
            $admin_data=Admin::find($leaveStatus->emp_id);
            $admin_data['approve_status']=1;
            Mail::to($admin_data->empmail)->send(new AdminLeaveMail($admin_data));
            $response = array('success' => true, 'error' => false, 'message' => 'Admin Leave is Approved successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }

    //  Leave is reject 
    public function AdminLeaveStatusReject(Request $request,$id)
    {
        $leaveStatus=EmpLeave::find($request->id); 
        if($leaveStatus->update(['l_status'=>2]))
        {
            $admin_data=Admin::find($leaveStatus->emp_id);
            $admin_data['approve_status']=0;
            Mail::to($admin_data->empmail)->send(new AdminLeaveMail($admin_data));
            $response = array('success' => true, 'error' => false, 'message' => 'Admin Leave is Rejected successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }
    //  Admin Leave Information End




     //  For Employee Leave Information
public function EmpLeave(Request $request){
    $data = EmpLeave::where('emp_leaves.is_deleted', 0)
    ->where('emp_leaves.type','=','Employee')
    ->join('employees', 'emp_leaves.emp_id', '=', 'employees.id')
    ->select('emp_leaves.*', 'employees.fname')
    ->orderBy('emp_leaves.id', 'DESC')
    ->paginate(20);
    return view('admin.leave_info.emp_leave_info', compact('data'));
}

public function EmpLeaveStatusApprove(Request $request,$id)
    {
        $leaveStatus=EmpLeave::find($request->id); 
        $leave_remaining = ($leaveStatus->leave_remaining) - ($leaveStatus->no_days);
        if($leaveStatus->update(['l_status'=>1,'leave_remaining'=>$leave_remaining]))
        {
            $emp_data=Employee::find($leaveStatus->emp_id);
            $emp_data['approve_status']=1;

            Mail::to($emp_data->official_id)->send(new EmployeeLeaveMail($emp_data));
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
            $emp_data=Employee::find($leaveStatus->emp_id);
            $emp_data['approve_status']=0;
            Mail::to($emp_data->official_id)->send(new EmployeeLeaveMail($emp_data));
            $response = array('success' => true, 'error' => false, 'message' => 'Employee Leave is Rejected successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }


    //  Employee Leave Information End

    function EmpLeaveStatus(Request $request){
        $user_name=Auth::user()->name;
        $type=Auth::user()->type;
        $user_email=Auth::user()->email;
        $employeeresult=Employee::where('official_id','=',$user_email)->where('fname','=',$user_name)->first();

        $data=EmpLeave::where('emp_leaves.emp_id',$employeeresult->id) 
        ->join('employees', 'emp_leaves.emp_id', '=', 'employees.id')
        ->orderBy('emp_leaves.id', 'DESC')
        ->paginate(20);
        return view('admin.leave_info.emp_leave_info', compact('data'));
    }

    function primary_leave_status(Request $request,EmpLeave $empLeave){
        $empLeave=EmpLeave::find($request->id); 
       $data=$request->all();
       $data['approved_by']=Auth::user()->type;
        if($empLeave->update($data))
        {
            return back()->with('message', 'Leave Status Updated Successfully');
        }
    }

}
