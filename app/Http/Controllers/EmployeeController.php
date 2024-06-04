<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Brand;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmployeeMail;
use Mail;
use Auth;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = Employee::where('employees.is_deleted', 0)
                ->join('brands', 'employees.empbrand', '=', 'brands.id')
                ->select('employees.*', 'brands.bname')
                ->orderBy('employees.id', 'DESC')
                ->paginate(20);
        
        
        return view('admin.employee.index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.employee.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Employee $employee)
    {
        $data=$request->all();
        $data['empmob'] = implode(",", $request->empmob);

        $data['empmob'] = implode(",", $request->empmob);
           if ($request->hasFile('empdol')) {
            $file = $request->file('empdol');
            $empdol = $this->upload_images($file, $folder = 'empdol');
            $data['empdol'] = implode(",", $empdol);
        }

       if ($request->hasFile('appointment_latter')) {
            $file = $request->file('appointment_latter');
            $appointment_latter = $this->upload_images($file, $folder = 'appointment_latter');
            $data['appointment_latter'] = implode(",", $appointment_latter);
        }
        if ($request->hasFile('aadharcard')) {
            $file = $request->file('aadharcard');
            $aadharcard = $this->upload_images($file, $folder = 'aadharcard');
            $data['aadharcard'] = implode(",", $aadharcard);
        }
        if ($request->hasFile('pancard')) {
            $file = $request->file('pancard');
            $pancard = $this->upload_images($file, $folder = 'pancard');
            $data['pancard'] = implode(",", $pancard);
        }
        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $certificate = $this->upload_images($file, $folder = 'certificate');
            $data['certificate'] = implode(",", $certificate);
        }
        if ($request->hasFile('empphoto')) {
            $file = $request->file('empphoto');
            $empphoto = $this->upload_single_image($file, $folder = 'empphoto');
            $data['empphoto'] = $folder."/".$empphoto;
            
        }

        $data['doj']=$request->doj;
        $current_month= date("m");
        if($current_month==1){
           $data['total_leave']=27;
        }
        else{
 
                $data['total_leave']=(int)(12-$current_month)*2.25;
        }
        $employee->create($data);
        $user = User::create([
            'name' => $request->fname,
            'email' => $request->empmail,
            'status' => 1,
            'password' => Hash::make($request->empmob[0]),
            'type' => 'emp',
        ]);
        $mailresult=['email'=>$request->empmail,'password'=>$request->empmob[0]];
        
        Mail::to($request->empmail)
        ->cc($request->personal_id) // Use cc or bcc if there are multiple recipients
        ->send(new EmployeeMail($mailresult));
        return redirect(route('employee.index'))->with('message','employee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.employee.create',compact('brand','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data=$request->all();
         $data['empmob'] = implode(",", $request->empmob);
           if ($request->hasFile('empdol')) {
            $file = $request->file('empdol');
            $empdol = $this->upload_images($file, $folder = 'empdol');
            $data['empdol'] = implode(",", $empdol);
        }

       if ($request->hasFile('appointment_latter')) {
            $file = $request->file('appointment_latter');
            $appointment_latter = $this->upload_images($file, $folder = 'appointment_latter');
            $data['appointment_latter'] = implode(",", $appointment_latter);
        }
        if ($request->hasFile('aadharcard')) {
            $file = $request->file('aadharcard');
            $aadharcard = $this->upload_images($file, $folder = 'aadharcard');
            $data['aadharcard'] = implode(",", $aadharcard);
        }
        if ($request->hasFile('pancard')) {
            $file = $request->file('pancard');
            $pancard = $this->upload_images($file, $folder = 'pancard');
            $data['pancard'] = implode(",", $pancard);
        }
        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $certificate = $this->upload_images($file, $folder = 'certificate');
            $data['certificate'] = implode(",", $certificate);
        }
        if ($request->hasFile('empphoto')) {
            $file = $request->file('empphoto');
            $empphoto = $this->upload_single_image($file, $folder = 'empphoto');
            $data['empphoto'] = $folder."/".$empphoto;
            
        }
        $data['doj']=$request->doj;
        $current_month= date("m");
        if($current_month==1){
           $data['total_leave']=27;
        }
        else{
 
                $data['total_leave']=(int)(12-$current_month)*2.25;
        }
        $employee->update($data);
        return redirect(route('employee.index'))->with('message','employee updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->update(['is_deleted' => 1])) {
            $response = array('success' => true, 'error' => false, 'message' => 'Data deleted successfully.');
        } else {
            $response = array('success' => false, 'error' => true, 'message' => 'Something went wrong!');
        }
        return response()->json($response);
    }

    
}
