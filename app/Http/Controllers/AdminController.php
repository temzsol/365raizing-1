<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use Redirect;
use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminMail;
use Mail;

class AdminController extends Controller
{
    public function login(){
        if(Auth::check())
        {
            return redirect(route('master-dashboard'));
        }
        else
        {
            return view('admin.login');
        }
    }
    public function AuthLogin(Request $request){
        
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|min:8',
            'type'=>'required'
        ]);
        
        $credentials = $request->only('email', 'password');
        $credentials['type'] = $request->input('type');
        $credentials['status'] = 1;
        
        if(Auth::attempt($credentials))
        {
            $request->session()->put('type',Auth::user()->type);
            if(Auth::user()->type=='master_admin')
            {
                return redirect(route('master-dashboard'));
            }
            if(Auth::user()->type=='admin')
            {
                return redirect(route('admin-dashboard'));
            }
           
            if(Auth::user()->type=='hr')
            {
                return redirect(route('hr-dashboard'));
            }
            if(Auth::user()->type=='emp')
            {
                return redirect(route('employee-dashboard'));
            }
            
        }
        else {
            return redirect()->back()->withInput($request->only('email', 'type'))->withErrors([
                'password' => 'Invalid email or password.',
            ]);
        }
    }
    
    
    
    

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->pull('result');
        return redirect('/');
      }

      public function index()
      {
          $data = Admin::where('is_deleted',0)->orderBy('id', 'DESC')->paginate(20);
          return view('admin.admins.index', compact('data'));
      }

      public function create()
      {
        return view('admin.admins.create');
        }

    public function store(Request $request,Admin $admin)
    {
        $this->validate($request, [
            'empmail' => 'required|email|unique:users,email',
            'empmob'  => 'required|min:10',
            'fname'=>'required'
        ]);
        $data=$request->all();
        // for Leave Calculation  
        $doj= date('Y-m-d');
        $dta['doj']=$doj;
       $current_month= date("m");
       if($current_month==1){
          $data['total_leave']=27;
       }
       else{

               $data['total_leave']=(int)(12-$current_month)*2.25;
       }
       // for Leave Calculation  $doj= date('Y-m-d');
        $admin->create($data);
        $user = User::create([
            'name' => $request->fname,
            'email' => $request->empmail,
            'status' => 1,
            'password' => Hash::make($request->empmob),
            'type' => 'admin',
        ]);

        Mail::to($request->empmail)->send(new AdminMail($data));

        return redirect(route('adminlist'))->with('message','Admin Created Successfully');
    }

    public function edit(Admin $admin,$id)
    {
        $admin=Admin::find($id);
        return view('admin.admins.create',compact('admin'));
    }

    


    public function update(Request $request,Admin $admin,$id)
    {
       $admin=Admin::find($id);
        $data=$request->all();
        $admin->update($data);
        return redirect(route('adminlist'))->with('message','Admin Updated Successfully');
    }

    public function destroy(Admin $admin, $id)
    {
        $admin=Admin::find($id);
        if($admin->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }

    
    



}

