@php
    $setting=App\Models\Websitesetting::where('status',1)->first();
    //dd($setting);
@endphp
<div id="layout-wrapper">     
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{url('/admin/dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="@if($setting['web_logo']!='' && $setting['web_logo']!=null){{url('/images/settings/'.$setting['web_logo'])}}" @endif alt="{{$setting['web_logo']}}" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="@if($setting['web_logo']!='' && $setting['web_logo']!=null){{url('/images/settings/'.$setting['web_logo'])}}" @endif alt="{{$setting['web_logo']}}" height="17">
                        </span>
                    </a>

                    <a href="{{url('/admin/dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{url('/images/settings/logo.png')}}" alt="{{$setting['web_logo']}}" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="@if($setting->web_logo!='' && $setting->web_logo!=null){{url('/images/settings/'.$setting->web_logo)}}" @endif" alt="{{$setting['web_logo']}}" height="75">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                
            </div>

            <div class="d-flex">

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                        <i class="bx bx-fullscreen"></i>
                    </button>
                </div>

                

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                            alt="Header Avatar"> --}}
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                        <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Change Password</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{url('/logout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                    </div>
                </div>

                {{-- <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="bx bx-cog bx-spin"></i>
                    </button>
                </div> --}}

            </div>
        </div>
    </header>

</div>