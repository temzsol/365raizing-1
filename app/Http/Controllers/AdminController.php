<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\LoginDetails;
use App\Mail\PasswordResetMail;
use Stevebauman\Location\Facades\Location;
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
            $data['uemail'] = $request->email;  // Ensure the email is sanitized/validated as needed.
            $ip = $request->ip();       // Correct method to get the client's IP address.
            $data['ip'] = $ip;       // Correct method to get the client's IP address.
            $location = Location::get($ip);
            if ($location) {
                $latitude = $location->latitude;
                $longitude = $location->longitude;

                $data['latitude'] = $latitude;       // Correct method to get the client's IP address.
                $data['longitude'] = $longitude;       // Correct method to get the client's IP address.
            }

        
            $data['login_time'] = date('H:i:s'); // Correct format for time.
            $data['login_date'] = date('m-d-Y'); // This format is fine.
            $data['current_status'] = 1;
           
            $loged_id=LoginDetails::create($data);
            $request->session()->put('login_session_id',$loged_id->id);
        
            $request->session()->put('type',Auth::user()->type);
            if(Auth::user()->type=='master_admin')
            {
                return redirect(route('master-dashboard'));
            }
            if(Auth::user()->type=='Admin')
            {
                return redirect(route('admin-dashboard'));
            }
           
            if(Auth::user()->type=='HR')
            {
                return redirect(route('hr-dashboard'));
            }
            if(Auth::user()->type=='Employee')
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
    
    
    
    

    public function logout(Request $request,LoginDetails $loginDetails) {
        $id= Session::get('login_session_id');
        $data = LoginDetails::find($id);
        $logout_time = date('H:i:s');
        $ip = $request->ip();       // Correct method to get the client's IP address.
            $data['ip'] = $ip;       // Correct method to get the client's IP address.
            $location = Location::get($ip);
            $logout_lat="";
            $logout_long="";
            if ($location) {
                $logout_lat = $location->latitude;
                $logout_long = $location->longitude;
            }
        LoginDetails::where('id', $id)->update(['logout_time' => $logout_time, 'current_status' => 0,'logout_lat'=>$logout_lat,'logout_long'=>$logout_long]);
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
            'type' => 'Admin',
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

    public function passwordResetview(Request $request,Admin $admin){
        return view('admin.reset_view');
    }

    public function passwordReset(Request $request,User $user){
      
        $user=User::where('email',$request->email)->first(); 
        $token = $user->createToken("password reset token");
        $new_token=$token->accessToken['token'];
        $user['remember_token']= $new_token;
        
        $user->update(['remember_token' =>$new_token]);
        mail::to($request->email)->send(new PasswordResetMail($user));
        return back()->with('message','Please Check Your Email We Are Send a mail on '.$request->email.' for password reset');
    }

    public function passwordResetForm(Request $request,User $user,$token){
        $result=User::where('remember_token',$token)->first();
        if($result)
        {

            return view('admin.passwordreset',compact('token'));
        }
        else
        {
            return "This session is expire.";
        }

    }

    
    public function passwordfinalReset(Request $request,User $user){
      
        $user=User::where('email',$request->email)->where('remember_token',$request->remember_token)->first();       
        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => null,
        ]);
        Auth::logout();
        $request->session()->pull('result');
        return redirect('/')->with('message','Your Password is Updated Successfully Please Login');       
    }
    



}

