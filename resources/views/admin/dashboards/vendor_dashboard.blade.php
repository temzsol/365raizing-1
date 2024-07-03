@extends('layouts.masteradmin')
@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
       <h2>Vendor Dashboard</h2>
        <!-- end page title -->

        <div class="row">
           
            <div class="col-xl-12">
                <div class="row">
                                        
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <a href="{{route('vendor-task.index')}}">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Active Tasks</p>
                                            <h4 class="mb-0">{{$activetask}}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="fa fa-thumb-tack font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <a href="{{route('vendor-task.index')}}">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Task Completed</p>
                                            <h4 class="mb-0">{{$completedtask}}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="fa fa-check-square-o font-size-24"  aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    
                </div>
                <!-- end row -->

            </div>
        </div>
        <!-- end row -->

        

        
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
@endsection