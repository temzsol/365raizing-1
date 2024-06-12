<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\EmployeeTaskMail;
use Mail;
use Auth;
use Session;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = EmployeeTask::where('employee_tasks.is_deleted', 0)
        ->join('employees', 'employee_tasks.emp_id', '=', 'employees.id')
        ->select('employee_tasks.*', 'employees.fname as emp_name')
        ->orderBy('employee_tasks.id', 'DESC')
        ->paginate(20);
        return view('admin.employeetask.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee=Employee::where('status',1)->where('is_deleted',0)->get();
        return view('admin.employeetask.create',compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,EmployeeTask $employeeTask)
    {
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 't_file');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $data['status']=0;
        $result=$employeeTask->create($data);
        $emp_id = $result->emp_id;
        $empl_result=Employee::find($emp_id);
        $result['deadline_date']=$request->deadline_date;
        $email_id = $empl_result->official_id;
        Mail::to($email_id)->send(new EmployeeTaskMail($result));
        return redirect(route('employeetask.index'))->with('message','Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeTask $employeeTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeTask $employeeTask,$id)
    {
        $employeeTask =EmployeeTask::find($id);
        $employee=Employee::where('status',1)->where('is_deleted',0)->get();
        return view('admin.employeetask.create',compact('employeeTask','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeTask $employeeTask,$id)
    {
        $EmployeeTask=EmployeeTask::find($request->id);
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 't_file');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $data['status']=0;
        $result=$EmployeeTask->update($data);
        $result=$EmployeeTask;
        $emp_id = $data['emp_id'];
        $empl_result=Employee::find($emp_id);
        $email_id = $empl_result->official_id;

        Mail::to($email_id)->send(new EmployeeTaskMail($result));
        return redirect(route('employeetask.index'))->with('message','Task updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,EmployeeTask $employeeTask,$id)
    {
        
            $EmployeeTask=EmployeeTask::find($request->id); 
            if($EmployeeTask->update(['is_deleted'=>1]))
            {
                $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
            }
        else{
            $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
                }
        return $response;
        
    
    }

    //  Updating Task Status
    public function employee_task_update(Request $request,EmployeeTask $employeeTask){
        $EmployeeTask=EmployeeTask::find($request->id); 
        if($EmployeeTask->update(['status'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Status Updated Successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }

//  For Employee Dashboard Fundtion 
    public function employeetaskview()
    {
        $user_name=Auth::user()->name;
        $user_email=Auth::user()->email;
        $employeeResult=Employee::where('official_id','=',$user_email)->where('fname','=',$user_name)->first();
        // dd($employeeResult->id);
        $data = EmployeeTask::where('employee_tasks.is_deleted', 0)
        ->where('employee_tasks.emp_id', $employeeResult->id)
        ->join('employees', 'employee_tasks.emp_id', '=', 'employees.id')
        ->select('employee_tasks.*', 'employees.fname as emp_name')
        ->orderBy('employee_tasks.id', 'DESC')
        ->paginate(20);
        return view('admin.employeetask.index', compact('data'));
    }
}
