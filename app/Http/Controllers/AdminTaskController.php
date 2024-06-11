<?php

namespace App\Http\Controllers;

use App\Models\AdminTask;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Mail\AdminTaskMail;
use Mail;
use Auth;
use Session;

class AdminTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AdminTask::where('admin_tasks.is_deleted', 0)
        ->join('admins', 'admin_tasks.emp_id', '=', 'admins.id')
        ->select('admin_tasks.*', 'admins.fname as admin_name')
        ->orderBy('admin_tasks.id', 'DESC')
        ->paginate(20);
        return view('admin.admintask.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin=Admin::where('status',1)->where('is_deleted',0)->get();
        return view('admin.admintask.create',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,AdminTask $adminTask)
    {
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 't_file');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $data['status']=0;
        $result=$adminTask->create($data);
        $emp_id = $result->emp_id;
        $empl_result=Admin::find($emp_id);
        $result['deadline_date']=$request->deadline_date;
        $email_id = $empl_result->empmail;
        Mail::to($email_id)->send(new AdminTaskMail($result));
        return redirect(route('admintask.index'))->with('message','Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminTask  $adminTask
     * @return \Illuminate\Http\Response
     */
    public function show(AdminTask $adminTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminTask  $adminTask
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminTask $adminTask,$id)
    {
        $adminTask =AdminTask::find($id);
        $admin=Admin::where('status',1)->where('is_deleted',0)->get();
        return view('admin.admintask.create',compact('adminTask','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminTask  $adminTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminTask $adminTask,$id)
    {
        $AdminTask=AdminTask::find($request->id);
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 't_file');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $data['status']=0;
        $result=$AdminTask->update($data);
        $result=$AdminTask;
        $emp_id = $data['emp_id'];
        $empl_result=Admin::find($emp_id);
        $email_id = $empl_result->empmail;

        Mail::to($email_id)->send(new AdminTaskMail($result));
        return redirect(route('admintask.index'))->with('message','Task updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminTask  $adminTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,AdminTask $adminTask,$id)
    {
        $AdminTask=AdminTask::find($request->id); 
            if($AdminTask->update(['is_deleted'=>1]))
            {
                $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
            }
        else{
            $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
                }
        return $response;
    }

     //  Updating Task Status
     public function admin_task_update(Request $request,AdminTask $AdminTask){
        $AdminTask=AdminTask::find($request->id); 
        if($AdminTask->update(['status'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Status Updated Successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }
}
