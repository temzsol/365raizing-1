<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <hr>
                <li class="menu-title" key="t-menu">Employee Details</li>
                <hr>
                <li>
                    <a href="{{route('employee-dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Task Details</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-vertical">Employee Task</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('employeetaskview')}}" key="t-light-sidebar">My Assigned Task</a></li>
                                <li><a href="{{route('staftask.index')}}" key="t-compact-sidebar">Task For Management</a></li>
                            </ul>
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
                            <li><a href="{{route('customer-query.create')}}" key="t-compact-sidebar">Add Query</a></li>
                            <li><a href="{{route('customer-query.index')}}" key="t-compact-sidebar">All Query</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Leave Information</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="{{route('leave.create')}}" key="t-compact-sidebar">Apply Leave</a></li>
                            <li><a href="{{route('EmpLeaveStatus')}}" key="t-compact-sidebar">View Status</a></li>
                            <li><a href="{{route('holiday.index')}}" key="t-compact-sidebar">Holiday List</a></li>
                        </li>
                    </ul>
                </li>
     
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->