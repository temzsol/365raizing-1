<?php

namespace App\Http\Controllers;

use App\Models\StaffTask;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\AdminTaskMail;
use App\Mail\EmployeeTaskMail;
use Mail;
use Auth;
use Session;

class StaffTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type=Auth::user()->type;
        if($user_type =='master_admin')
        {
            $data = StaffTask::where('staff_tasks.is_deleted', 0)
            ->join('users', 'staff_tasks.task_assign_from', '=', 'users.id')
            ->select('staff_tasks.*', 'users.name as emp_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);
            return view('admin.stafftask.index', compact('data'));
        }
        elseif($user_type =='Admin')
        {
            $data = StaffTask::where('staff_tasks.is_deleted', 0)
            ->join('admins', 'staff_tasks.task_assign_from', '=', 'admins.id')
            ->select('staff_tasks.*', 'admins.fname as emp_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);
            return view('admin.stafftask.index', compact('data'));
        }
       
        else{
            $data = StaffTask::where('staff_tasks.is_deleted', 0)
            ->join('employees', 'staff_tasks.task_assign_from', '=', 'employees.id')
            ->select('staff_tasks.*', 'employees.fname as emp_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);
            return view('admin.stafftask.index', compact('data'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee=Employee::where('status',1)->where('is_deleted',0)->get();
        return view('admin.stafftask.create',compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,StaffTask $staffTask)
    {
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 'management_task');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $data['status']=0;

        
        // Task assign from
        if(Auth::user()->type=='Admin')
        {
            $admindata=Admin::where('official_id',Auth::user()->email)->first();
            $data['task_assign_from']=$admindata->id;
            $data['task_from']='Admin';
        }
        if(Auth::user()->type=='Employee')
        {
            $employeedata=Employee::where('official_id',Auth::user()->email)->first();
            $data['task_assign_from']=$employeedata->id;
            $data['task_from']='Employee';
            
        }
        if(Auth::user()->type=='HR')
        {
            
        }

        $result=$staffTask->create($data);

        $task_assign_to = $result->task_assign_to;

//  Task Assign to 
        if($request->user_type=='Admin')
        {
            $admin_result=Admin::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $admin_result->empmail;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('staftask.index'))->with('message','Task Created Successfully');
        }
        if($request->user_type=='HR')
        {
            
        }
        if($request->user_type=='master_admin')
        {
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffTask  $staffTask
     * @return \Illuminate\Http\Response
     */
    public function show(StaffTask $staffTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffTask  $staffTask
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffTask $staffTask,$id)
    {
        $stafftask =staffTask::find($id);
       
        if($stafftask->user_type == 'master_admin')
        {
            $emp_data=User::where('type','=','master_admin')->get();
        }
        if($stafftask->user_type == 'Admin')
        {
            $emp_data=Admin::where('is_deleted',0)->get();
            
        }
        if($stafftask->user_type == 'HR')
        {
            
        }
        return view('admin.stafftask.create',compact('stafftask','emp_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffTask  $staffTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffTask $staffTask)
    {
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 'management_task');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');


        
        // Task assign from
        if(Auth::user()->type=='Admin')
        {
            $admindata=Admin::where('official_id',Auth::user()->email)->first();
            $data['task_assign_from']=$admindata->id;
            $data['task_from']='Admin';
        }
        if(Auth::user()->type=='Employee')
        {
            $employeedata=Employee::where('official_id',Auth::user()->email)->first();
            $data['task_assign_from']=$employeedata->id;
            $data['task_from']='Employee';
            
        }
        if(Auth::user()->type=='HR')
        {
            
        }

        $staffTask->update($data);
      

        $task_assign_to = $request->task_assign_to;

//  Task Assign to 
        if($request->user_type=='Admin')
        {
            $admin_result=Admin::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $admin_result->empmail;
            Mail::to($email_id)->send(new AdminTaskMail($staffTask));
            return redirect(route('staftask.index'))->with('message','Task Updated Successfully');
        }
        if($request->user_type=='HR')
        {
            
        }
        if($request->user_type=='master_admin')
        {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffTask  $staffTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffTask $staffTask)
    {
        // $EmployeeTask=EmployeeTask::find($request->id); 
        if($staffTask->update(['is_deleted'=>1]))
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
        return view('admin.stafftask.index', compact('data'));
    }


    public function UserType(Request $request) {
        $user_type = $request->user_type;
        $html = ''; // Initialize a variable to store the HTML options
        
        if ($user_type == 'master_admin') {
            // Handle master_admin logic if any
        } elseif ($user_type == 'Admin') {
            $data = Admin::where('is_deleted', 0)->get();
            foreach ($data as $value) {
                $html .= "<option value='{$value->id}'>{$value->fname}</option>";
            }
        } elseif ($user_type == 'HR') {
            // Handle HR logic if any
        } 
        elseif ($user_type == 'Employee') {
            $data = Employee::where('is_deleted', 0)->get();
            foreach ($data as $value) {
                $html .= "<option value='{$value->id}'>{$value->fname}</option>";
            }
        }
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
    
}
