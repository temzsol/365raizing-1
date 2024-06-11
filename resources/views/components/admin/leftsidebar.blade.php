<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <hr><li class="menu-title" key="t-menu">All Details</li><hr>

                <li>
                    <a href="{{route('master-dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Task Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-vertical">My Task</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('tasks.index')}}" key="t-light-sidebar">My Assigned Task</a></li>
                                <li><a href="{{route('tasks.create')}}" key="t-compact-sidebar">Assign Task</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Brand & Company</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('brands.index')}}" key="t-light-sidebar">All Brand </a></li>
                            <li><a href="{{route('brands.create')}}" key="t-light-sidebar">Add Brand </a></li>
                            <li><a href="{{route('company.index')}}" key="t-compact-sidebar">All Company</a></li>
                            <li><a href="{{route('company.create')}}" key="t-compact-sidebar">Add Company</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">HR Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Employee Data Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Job Opening Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Applicants Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Employee Training Data</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Benefit Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Documents Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Project Tracking</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Access from Devices</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Company info Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Setup Password Protection</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">HR Manager Reminder</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Employee Attendance Methods</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Common offer letter</a></li>
                        
                       
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Employee Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('employee.index')}}" key="t-light-sidebar">Employee List </a></li>
                            <li><a href="{{route('employee.create')}}" key="t-light-sidebar">Add Employee </a></li>
                            <li><a href="{{route('adminlist')}}" key="t-compact-sidebar">All Admin</a></li>
                            <li><a href="{{route('admins_create')}}" key="t-compact-sidebar">Add admin</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Task Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('employeetask.index')}}" key="t-compact-sidebar">All Employee Task</a></li>
                            <li><a href="{{route('employeetask.create')}}" key="t-compact-sidebar">Assign Task</a></li>
                            <li><a href="{{route('admintask.index')}}" key="t-compact-sidebar">All Admin Task</a></li>
                            <li><a href="{{route('admintask.create')}}" key="t-compact-sidebar">Assign Admin Task</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Customer Query</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('customer-query.index')}}" key="t-compact-sidebar">All Query</a></li>
                            <li><a href="{{route('customer-query.create')}}" key="t-compact-sidebar">Add Query</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Holiday Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('holiday.index')}}" key="t-compact-sidebar">All Holiday</a></li>
                            <li><a href="{{route('holiday.create')}}" key="t-compact-sidebar">Add Holiday</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Leave Infomation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('EmpLeave')}}" key="t-compact-sidebar">Employee Leave</a></li>
                            <li><a href="{{route('AdminLeave')}}" key="t-compact-sidebar">Admin Leave</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Vendor Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('vendor.index')}}" key="t-compact-sidebar">All Vendor</a></li>
                            <li><a href="{{route('vendor.create')}}" key="t-compact-sidebar">Add Vendor</a></li>
                            <li><a href="{{route('vendor-task.index')}}" key="t-compact-sidebar">Vendor Task</a></li>
                            <li><a href="{{route('vendor-task.create')}}" key="t-compact-sidebar">Assign Task</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Web Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('/admin/settings')}}" key="t-tui-calendar">Website Settings</a></li>
                        <li><a href="{{url('/admin/settings/create')}}" key="t-full-calendar">Update Web Settings</a></li>
                        
                    </ul>
                </li>

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->