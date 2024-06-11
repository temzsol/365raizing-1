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
use App\Models\Vendor;
use App\Models\Holiday;
use App\Models\EmpLeave;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
     public function index(){

      $brand=Brand::all()->count();
      $company=Company::all()->count();
      $admin=Admin::all()->count();
      $employee=Employee::all()->count();
      $admintask=AdminTask::where('status',0)->count();
      $emptask=EmployeeTask::where('status',0)->count();
      $vendortask=VendorTaskAssign::where('status',0)->count();
      $vendor=Vendor::all()->count();
      $empleave=EmpLeave::where('l_status',0)->where('type','=','Employee')->count();
      $adminleave=EmpLeave::where('l_status',0)->where('type','=','Admin')->count();
        return view('admin.dashboards.master_admin_dashboar',compact('brand','company','admintask','admin','employee','emptask','vendortask','vendor','empleave','adminleave'));
     }

   //   For Admin Dashboard
     public function Adminindex(){
      return view('admin.dashboards.admin_dashboar');
   }

      //   For HR Dashboard
      public function HRindex(){
         return view('admin.dashboards.hr_dashboar');
      }

      //   For HR Dashboard
      public function Employeeindex(){
         return view('admin.dashboards.employee_dashboar');
      }

}
