<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Company;
use App\Models\AdminTask;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use App\Models\EmployeeTask;
use App\Models\VendorTaskAssign;
use App\Models\vendor;
use App\Models\StaffTask;
use App\Models\Holiday;
use App\Models\EmpLeave;
use Auth;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
     public function index(){

      $brand=Brand::all()->count();
      $company=Company::all()->count();
      $admin=Employee::where('role',1)->count();
      $employee=Employee::where('role',0)->count();
      $admintask=AdminTask::where('status',0)->count();
      $emptask=EmployeeTask::where('status',0)->count();
      $vendortask=VendorTaskAssign::where('status',0)->count();
      $vendor=vendor::all()->count();
      $empleave=EmpLeave::where('l_status',0)->where('type','=','Employee')->count();
      $adminleave=EmpLeave::where('l_status',0)->where('type','=','Admin')->count();
        return view('admin.dashboards.master_admin_dashboard',compact('brand','company','admintask','admin','employee','emptask','vendortask','vendor','empleave','adminleave'));
     }

   //   For Admin Dashboard
     public function Adminindex(){
      $brand=Brand::all()->count();
      $company=Company::all()->count();
      $admin=Employee::where('role',1)->count();
      $employee=Employee::where('role',0)->count();
      $admintask=AdminTask::where('status',0)->count();
      $emptask=EmployeeTask::where('status',0)->count();
      $vendortask=VendorTaskAssign::where('status',0)->count();
      $vendor=vendor::all()->count();
      $empleave=EmpLeave::where('l_status',0)->where('type','=','Employee')->count();
      $adminleave=EmpLeave::where('l_status',0)->where('type','=','Admin')->count();
      return view('admin.dashboards.admin_dashboard',compact('brand','company','admintask','admin','employee','emptask','vendortask','vendor','empleave','adminleave'));
   }

      //   For HR Dashboard
      public function HRindex(){
         $admin=Employee::where('role',1)->count();
         $employee=Employee::where('role',0)->count();
         $brand=Brand::all()->count();
         $company=Company::all()->count();
         $empleave=EmpLeave::where('l_status',0)->where('type','=','Employee')->count();
         $adminleave=EmpLeave::where('l_status',0)->where('type','=','Admin')->count();
         $vendor=vendor::all()->count();
         return view('admin.dashboards.hr_dashboard',compact('admin','employee','brand','company','empleave','adminleave','vendor'));
      }

      //   For HR Employee
      public function Employeeindex(){
        $useremail= Auth::user()->email;
        $emp_data=Employee::where('official_id',$useremail)->first();

         $activetask=EmployeeTask::where('status',0)->where('is_deleted',0)->where('emp_id',$emp_data->id)->count();
         $completedtask=EmployeeTask::where('status',1)->where('is_deleted',0)->where('emp_id',$emp_data->id)->count();
         $taskassignbyyou=StaffTask::where('status',0)->where('is_deleted',0)->where('task_assign_from',$emp_data->id)->count();
         $completed=StaffTask::where('status',1)->where('is_deleted',0)->where('task_assign_from',$emp_data->id)->count();

         return view('admin.dashboards.employee_dashboard',compact('activetask','completedtask','taskassignbyyou','completed'));
      }

      
      //   For HR Vendor
      public function Vendorindex(){
         $useremail= Auth::user()->email;
         $emp_data=Employee::where('official_id',$useremail)->first();
 
          $activetask=EmployeeTask::where('status',0)->where('is_deleted',0)->where('emp_id',$emp_data->id)->count();
          $completedtask=EmployeeTask::where('status',1)->where('is_deleted',0)->where('emp_id',$emp_data->id)->count();
          $taskassignbyyou=StaffTask::where('status',0)->where('is_deleted',0)->where('task_assign_from',$emp_data->id)->count();
          $completed=StaffTask::where('status',1)->where('is_deleted',0)->where('task_assign_from',$emp_data->id)->count();
 
          return view('admin.dashboards.vendor_dashboard',compact('activetask','completedtask','taskassignbyyou','completed'));
       }

}
