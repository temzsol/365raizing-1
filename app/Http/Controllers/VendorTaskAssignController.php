<?php

namespace App\Http\Controllers;

use App\Models\VendorTaskAssign;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Mytask;
use App\Models\Brand;
use App\Mail\Vendormail;
use Mail;
use Auth;
use Session;
use Validator;

class VendorTaskAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VendorTaskAssign::where('vendor_task_assigns.is_deleted', 0)
        ->join('vendors', 'vendor_task_assigns.vendor_id', '=', 'vendors.id')
        ->select('vendor_task_assigns.*', 'vendors.fname as vendor_name')
        ->orderBy('vendor_task_assigns.id', 'DESC')
        ->paginate(20);
        return view('admin.vendor_task.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        $vendor=Vendor::where('status',1)->where('is_deleted',0)->get();
        return view('admin.vendor_task.create',compact('brand','vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,VendorTaskAssign $vendorTaskAssign)
    {
        $data=$request->all();
        if ($request->hasFile('task_file')) {
            $file = $request->file('task_file');
            $task_file = $this->upload_single_image($file, $folder = 'task_file');
            $data['task_file'] = $folder."/".$task_file;
        }
        $data['assign_date']=date('Y-m-d');
        $result=$vendorTaskAssign->create($data);
        $vendor_id = $result->vendor_id;
        $vendor_result=Vendor::find($vendor_id);

        $result['deadline_date']=$request->deadline_date;
        $vendoremail=explode(',',$vendor_result->vemail);
        Mail::to($vendoremail[0])->send(new Vendormail($result));
        return redirect(route('vendor-task.index'))->with('message','Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorTaskAssign  $vendorTaskAssign
     * @return \Illuminate\Http\Response
     */
    public function show(VendorTaskAssign $vendorTaskAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorTaskAssign  $vendorTaskAssign
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorTaskAssign $vendorTaskAssign,$id)
    {
        $vendorTaskAssign =VendorTaskAssign::find($id);
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        $vendor=Vendor::where('status',1)->where('is_deleted',0)->get();
        return view('admin.vendor_task.create',compact('vendorTaskAssign','brand','vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorTaskAssign  $vendorTaskAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorTaskAssign $vendorTaskAssign,$id)
    {
        $vendorTaskAssign=VendorTaskAssign::find($request->id);
        $data=$request->all();
        if ($request->hasFile('task_file')) {
            $file = $request->file('task_file');
            $task_file = $this->upload_single_image($file, $folder = 'task_file');
            $data['task_file'] = $folder."/".$task_file;
        }
        $data['assign_date']=date('Y-m-d');
        $result=$vendorTaskAssign->update($data);

        $vendor_id = $request->vendor_id;
        $vendor_result=Vendor::find($vendor_id);

        $vendoremail=explode(',',$vendor_result->vemail);
        Mail::to($vendoremail[0])->send(new Vendormail($vendorTaskAssign));
        return redirect(route('vendor-task.index'))->with('message','Task updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorTaskAssign  $vendorTaskAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,VendorTaskAssign $vendorTaskAssign,$id)
    {
        $vendorTaskAssign=VendorTaskAssign::find($request->id); 
        if($vendorTaskAssign->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }

    
}
