<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <hr>
                <li class="menu-title" key="t-menu">Vendor Panel</li>
                <hr>
                <li>
                    <a href="{{route('vendor-dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-tasks font-size-18"></i>
                        <span key="t-layouts">Task Details</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-vertical">Vendor Task</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('vendor-task.index')}}" key="t-light-sidebar">My Assigned Task</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->