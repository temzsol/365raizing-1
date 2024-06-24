<?php

namespace App\Http\Controllers;

use App\Models\StaffTask;
use App\Models\Admin;
use App\Models\User;
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
            $user_email = Auth::user()->email;
            $suer_result=User::where('email','=',$user_email)->first();
     
            $task_for_me =StaffTask::where('staff_tasks.is_deleted', 0)
            ->where('staff_tasks.task_assign_to', $suer_result->id)
            ->join('employees as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
            ->join('users as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
            ->select('staff_tasks.*', 'assigner.fname as assigner_name', 'assignee.name as assignee_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);

            $task_assign_by_me = StaffTask::where('staff_tasks.is_deleted', 0)
            ->where('staff_tasks.task_assign_from', $suer_result->id)
            ->join('users as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
            ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
            ->select('staff_tasks.*', 'assigner.name as assigner_name', 'assignee.fname as assignee_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);
            return view('admin.stafftask.index', compact('task_for_me','task_assign_by_me'));
        }

        elseif($user_type =='Admin')
        {
            $user_email = Auth::user()->email;
            $user_type = Auth::user()->type;
            $emp_result=Employee::where('official_id','=',$user_email)->first();

            $task_for_me =StaffTask::where('staff_tasks.is_deleted', 0)
            ->where('staff_tasks.task_assign_to', $emp_result->id)
            ->join('users as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
            ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
            ->select('staff_tasks.*', 'assigner.name as assigner_name', 'assignee.fname as assignee_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);

            $task_for_me =StaffTask::where('staff_tasks.is_deleted', 0)
            ->where('staff_tasks.task_assign_to', $emp_result->id)
            ->join('employees as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
            ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
            ->select('staff_tasks.*', 'assigner.fname as assigner_name', 'assignee.fname as assignee_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);

            $task_assign_by_me = StaffTask::where('staff_tasks.is_deleted', 0)
            ->where('staff_tasks.task_assign_from', $emp_result->id)
            ->join('employees as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
            ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
            ->select('staff_tasks.*', 'assigner.fname as assigner_name', 'assignee.fname as assignee_name')
            ->orderBy('staff_tasks.id', 'DESC')
            ->paginate(20);
            
            return view('admin.stafftask.index', compact('task_for_me','task_assign_by_me'));
        }
       
        elseif($user_type =='HR'){
           
            //  For HR Section
            $user_email = Auth::user()->email;
            $user_type = Auth::user()->type;
            $emp_result=Employee::where('official_id','=',$user_email)->first();
            
                $task_for_me =StaffTask::where('staff_tasks.is_deleted', 0)
                ->where('staff_tasks.task_assign_to', $emp_result->id)
                ->join('users as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
                ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
                ->select('staff_tasks.*', 'assigner.name as assigner_name', 'assignee.fname as assignee_name')
                ->orderBy('staff_tasks.id', 'DESC')
                ->paginate(20);

                $task_for_me =StaffTask::where('staff_tasks.is_deleted', 0)
                ->where('staff_tasks.task_assign_to', $emp_result->id)
                ->join('employees as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
                ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
                ->select('staff_tasks.*', 'assigner.fname as assigner_name', 'assignee.fname as assignee_name')
                ->orderBy('staff_tasks.id', 'DESC')
                ->paginate(20);

                $task_assign_by_me = StaffTask::where('staff_tasks.is_deleted', 0)
                ->where('staff_tasks.task_assign_from', $emp_result->id)
                ->join('employees as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
                ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
                ->select('staff_tasks.*', 'assigner.fname as assigner_name', 'assignee.fname as assignee_name')
                ->orderBy('staff_tasks.id', 'DESC')
                ->paginate(20);
            
           
            //  HR Section END
            return view('admin.stafftask.index', compact('task_assign_by_me','task_for_me'));
        }
        else{
            $user_email = Auth::user()->email;
            $user_type = Auth::user()->type;
            $emp_result=Employee::where('official_id','=',$user_email)->first();
                
                $task_assign_by_me = StaffTask::where('staff_tasks.is_deleted', 0)
                ->where('staff_tasks.task_assign_from', $emp_result->id)
                ->join('employees as assigner', 'staff_tasks.task_assign_from', '=', 'assigner.id')
                ->join('employees as assignee', 'staff_tasks.task_assign_to', '=', 'assignee.id')
                ->select('staff_tasks.*', 'assigner.fname as assigner_name', 'assignee.fname as assignee_name')
                ->orderBy('staff_tasks.id', 'DESC')
                ->paginate(20);
                return view('admin.stafftask.index', compact('task_assign_by_me'));
        }
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_type=Auth::user()->type;

        return view('admin.stafftask.create');
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
            $admindata=Employee::where('official_id',Auth::user()->email)->first();
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
            $hrdata=Employee::where('official_id',Auth::user()->email)->first();
            $data['task_assign_from']=$hrdata->id;
            $data['task_from']='HR';
        }
        if(Auth::user()->type=='master_admin')
        {
            $hrdata=User::where('email',Auth::user()->email)->first();
            $data['task_assign_from']=$hrdata->id;
            $data['task_from']='master_admin';
        }
        $result=$staffTask->create($data);
        $task_assign_to = $result->task_assign_to;

        //  Task Assign to 
        if($request->user_type=='Admin')
        {
            $admin_result=Employee::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $admin_result->official_id;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('managementtask.index'))->with('message','Task Created Successfully');
        }
        if($request->user_type=='HR')
        {
            $hr_result=Employee::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $hr_result->official_id;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('managementtask.index'))->with('message','Task Created Successfully');
        }
        if($request->user_type=='master_admin')
        {
            $master_result=User::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $master_result->email;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('managementtask.index'))->with('message','Task Created Successfully');
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
        $staffTask =StaffTask::find($id);
       
        $user_type=$staffTask->user_type;
       

        if($user_type == 'master_admin')
        {
            $emp_data=User::where('type','=','master_admin')->select('users.name as fname','users.id')->get();
        }
        if($user_type == 'Admin')
        {
            $emp_data=Employee::where('is_deleted',0)->where('role',1)->get();
            // dd($emp_data);
        }
        if($user_type == 'HR')
        {
            $emp_data=Employee::where('is_deleted',0)->where('role','=',2)->get();
        }
        if($user_type == 'Employee')
        {
            $emp_data=Employee::where('is_deleted',0)->where('role','!=',0)->get();
        }

        //  For Find Login type 
        $useremail=Auth::user()->email;
        $type = Auth::user()->type;
        $login_id='';
        if($type=='Admin')
        {
            $login_id = Employee::where('official_id',$useremail)->first();
            $login_id = $login_id->id;

        }
        elseif($type=='master_admin')
        {
            $login_id = User::where('email',$useremail)->first();
            $login_id = $login_id->id;
        }
        elseif($type=='HR')
        {
            $login_id = Employee::where('official_id',$useremail)->first();
            $login_id = $login_id->id;
        }
        else
        {
            $login_id = Employee::where('official_id',$useremail)->first();
            $login_id = $login_id->id;
        }
        // logi type end
        return view('admin.stafftask.update',compact('staffTask','emp_data','login_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffTask  $staffTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffTask $staffTask,$id)
    {
        $staffTask =StaffTask::find($id);
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 'management_task');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $data['comments']=$request->comments;
        $data['status']=$request->status;

        $staffTask->update($data);
        $task_assign_to = $request->task_assign_to;
       
//  Task Assign to 
        if($request->user_type=='Admin')
        {
            $result=Employee::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $result->official_id;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('managementtask.index'))->with('message','Task Updated Successfully');
        }
        if($request->user_type=='HR')
        {
            $result=Employee::find($task_assign_to);
            $result['deadline_date']=$request->deadline_date;
            $email_id = $result->official_id;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('managementtask.index'))->with('message','Task Updated Successfully');
        }
        if($request->user_type=='master_admin')
        {
            $result=User::find($task_assign_to);
            
            $result['deadline_date']=$request->deadline_date;
            $email_id = $result->email;
            Mail::to($email_id)->send(new AdminTaskMail($result));
            return redirect(route('managementtask.index'))->with('message','Task Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffTask  $staffTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffTask $staffTask,$id)
    {
        $staffTask=StaffTask::find($id); 

        if($staffTask->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }


    public function UserType(Request $request) {
        $user_type = $request->user_type;
        $html = ''; // Initialize a variable to store the HTML options
        
        if ($user_type == 'master_admin') {
            $emp_data = User::where('type', 'master_admin')->select('users.name as fname','users.id')
            ->get();
            foreach ($emp_data as $value) {
                $html .= "<option value='{$value->id}'>{$value->fname}</option>";
            }
        } elseif ($user_type == 'Admin') {
            $data = Employee::where('is_deleted', 0)->where('role',1)->get();
            foreach ($data as $value) {
                $html .= "<option value='{$value->id}'>{$value->fname}</option>";
            }
        } elseif ($user_type == 'HR') {
            $data = Employee::where('is_deleted', 0)->where('role',2)->get();
            foreach ($data as $value) {
                $html .= "<option value='{$value->id}'>{$value->fname}</option>";
            }
        } 
        elseif ($user_type == 'Employee') {
            $data = Employee::where('is_deleted', 0)->where('role',0)->get();
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
