<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Brand;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmployeeMail;
use App\Mail\AdminMail;
use App\Mail\HRMail;
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
        $company=Company::where('status',1)->where('is_deleted',0)->get();
        return view('admin.employee.create',compact('company'));
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
        $emp_result=$employee->create($data);
        $emp_id='RZI0000'.$emp_result->id;
        $employee=Employee::find($emp_result->id);
        $employee->update(['emp_id'=>$emp_id,'user_type'=>'emp']);
        
        //  For Employee Registration
        if($request->role==0)
        {
        $user = User::create([
            'name' => $request->fname,
            'email' => $request->official_id,
            'status' => 1,
            'password' => Hash::make($request->empmob[0]),
            'type' => 'Employee',
        ]);
        $mailresult=['email'=>$request->official_id,'password'=>$request->empmob[0]];
        
        Mail::to($request->official_id)
        ->cc($request->personal_id) // Use cc or bcc if there are multiple recipients
        ->send(new EmployeeMail($mailresult));
        }

        //  For Admin Registration
        if($request->role==1)
        {
        $user = User::create([
            'name' => $request->fname,
            'email' => $request->official_id,
            'status' => 1,
            'password' => Hash::make($request->empmob[0]),
            'type' => 'Admin',
        ]);
        $mailresult=['email'=>$request->official_id,'password'=>$request->empmob[0]];
        
        Mail::to($request->official_id)
        ->cc($request->personal_id) // Use cc or bcc if there are multiple recipients
        ->send(new AdminMail($mailresult));
        }

        //  for HR Registration 

        if($request->role==2)
        {
        $user = User::create([
            'name' => $request->fname,
            'email' => $request->official_id,
            'status' => 1,
            'password' => Hash::make($request->empmob[0]),
            'type' => 'HR',
        ]);
        $mailresult=['email'=>$request->official_id,'password'=>$request->empmob[0]];
        
        Mail::to($request->official_id)
        ->cc($request->personal_id) // Use cc or bcc if there are multiple recipients
        ->send(new HRMail($mailresult));
        }
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
        $company=Company::where('status',1)->where('is_deleted',0)->get();
        return view('admin.employee.create',compact('company','employee'));
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

    public function findbrandname(Request $request) {
       $data = $request->all();
        $html = ''; // Initialize a variable to store the HTML options
            $brand_data = Brand::where('bcomp', $request->comp_id)->select('brands.bname','brands.id')
            ->get(); 
         
            foreach ($brand_data as $value) {
                $html .= "<option value='{$value->id}'>{$value->bname}</option>";
            }        
            return response()->json([
                'success' => true,
                'html' => $html
            ]); 
}
}
