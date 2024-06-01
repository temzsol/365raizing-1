<?php

namespace App\Http\Controllers;

use App\Models\Mytask;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Mail\MailMytask;
use Auth;
use Mail;
use Session;
use Validator;
class MytaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mytask::where('is_deleted',0)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.tasks.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Mytask $mytask)
    {
        $data=$request->all();
        if ($request->hasFile('t_file')) {
            $file = $request->file('t_file');
            $t_file = $this->upload_single_image($file, $folder = 't_file');
            $data['t_file'] = $folder."/".$t_file;
        }
        $data['assign_date']=date('Y-m-d');
        $result=$mytask->create($data);
        $email= Auth::user()->email;
        Mail::to($email)->send(new MailMytask($result));
        return redirect(route('tasks.index'))->with('message','Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mytask  $mytask
     * @return \Illuminate\Http\Response
     */
    public function show(mytask $mytask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mytask  $mytask
     * @return \Illuminate\Http\Response
     */
    public function edit(Mytask $mytask,$id)
    {
        $mytask=Mytask::find($id);
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.tasks.create',compact('mytask','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mytask  $mytask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mytask $mytask)
    {
        $mytask=Mytask::find($request->id);
        $data=$request->all();
        if ($request->hasFile('gst_file')) {
            $file = $request->file('gst_file');
            $gst_file = $this->upload_single_image($file, $folder = 'gst_file');
            $data['gst_file'] = $folder."/".$gst_file;
        }
        $mytask->update($data);
        $result = $mytask->fresh();
        $email= Auth::user()->email;
        Mail::to($email)->send(new MailMytask($result));
        return redirect(route('tasks.index'))->with('message','Task updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mytask  $mytask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Mytask $mytask,$id)
    {
        $mytask=Mytask::find($request->id); 
        if($mytask->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }

    public function statusUpdate(Request $request,Mytask $mytask,$id)
    {
        $mytask=Mytask::find($request->id); 
        if($mytask->update(['status'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Task Status updated successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }
    
}
