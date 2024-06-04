<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class DashboardController extends Controller
{
     public function index(){
        return view('admin.dashboards.master_admin_dashboar');
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
