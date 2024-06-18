@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Responsive Table</h4>
                <p class="card-title-desc">
                    Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>
                    to make them scroll horizontally on small devices (under 768px).
                </p>

{{--  For Tab Section  --}}
<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
      <a class="nav-link active" id="me_task_button" onclick="tabFunction('task_assign_by_me')" href="#task_assign_by_me">Task Assign by Me</a>
    </li>
    @if(Auth::user()->type!='Employee')
    <li class="nav-item">
      <a class="nav-link" id="my_task_tab"  onclick="tabFunction('mytask')" href="#mytask">My Task</a>
    </li>
    @endif
  </ul>
 {{--  Tab Section Code End  --}}

        @if(Auth::user()->type!='Employee')
            <div id="mytask">
                <div class="table-responsive">
                  Management All Task
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Assign By</th>
                                <th>Task Assign To</th>
                                <th>Task Title</th>
                                <th>Assign Date</th>
                                <th>File</th>
                                <th>Task Details</th>
                                <th>Status</th>
                                @if(Auth::user()->type=='master_admin')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task_for_me as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>
                                    {{$value->assigner_name}}
                                </td>
                                <td>
                                    {{$value->assignee_name}}
                                </td>
                                <td>{{$value->t_title}}</td>
                                <td>{{$value->assign_date}}</td>
                                <td><a href="{{url('/images/'.$value->t_file)}}" target="_blank" download>Download File</a></td>
                                <td>{{$value->t_detail}}</td>
                                
                                
                                <td><div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    {{-- <input class="form-check-input" type="checkbox" id="SwitchCheckSizemd{{$value->id}}" @if($value->status==1){{'checked'}} @endif> --}}
                                    
                                    <label class="form-check-label" for="SwitchCheckSizemd{{$value->id}}">@if($value->status==1)<button class="btn btn-success">Completed</button>@else <button class="btn btn-warning">Incomplete</button> @endif</label>
                                    </div>
                                </td>

                                <td>
                                    <a href="{{route('staftask.edit',$value->id)}}"><i class="bx bx-pencil"></i> Edit </a> 
                                    @if(Auth::user()->type === $value->task_from)
                                     <a href="javascript:void(0);"  onClick="deletetasks('{{$value->id}}')" class="text-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                     @endif
                                </td>
                               
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$task_for_me->links('vendor.pagination.simple-bootstrap-4')}}
            </div>
        @endif
            <div id="task_assign_by_me">
                <a href="{{route('staftask.create')}}" class="btn btn-primary">Add Task</a>
                <div class="table-responsive">
                  Management All Task
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Assign By</th>
                                <th>Task Assign To</th>
                                <th>Task Title</th>
                                <th>Assign Date</th>
                                <th>File</th>
                                <th>Task Details</th>
                                <th>Status</th>
                               
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task_assign_by_me as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->assigner_name}}</td>
                                <td>{{$value->assignee_name}}</td>
                                <td>{{$value->t_title}}</td>
                                <td>{{$value->assign_date}}</td>
                                <td><a href="{{url('/images/'.$value->t_file)}}" target="_blank" download>Download File</a></td>
                                <td>{{$value->t_detail}}</td>
                                
                                
                                <td><div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                                        
                                    <label class="form-check-label" for="SwitchCheckSizemd{{$value->id}}">@if($value->status==1)<button class="btn btn-success disabled">Completed</button>@else <button class="btn btn-warning disabled">Incomplete</button> @endif</label>
                                    </div>
                                </td>

                                
                               
                                <td>
                                    <a href="{{route('staftask.edit',$value->id)}}"><i class="bx bx-pencil"></i> Edit </a> 
                                    @if(Auth::user()->type=='master_admin')
                                     <a href="javascript:void(0);"  onClick="deletetasks('{{$value->id}}')" class="text-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                    @endif
                                </td>
                              
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$task_assign_by_me->links('vendor.pagination.simple-bootstrap-4')}}
            </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-section-code')

<script>
    function deletetasks(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('master-admin/staftask') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success==true)
                {
                    location.reload();
                    swal("Success!", response.message, "success");
                    

                }
                if(response.success==false)
                {
                    location.reload();
                    swal("Deleted!", response.message, "error");
                    

                }
                
            }
        });
    }
}

$('#mytask').hide();
function tabFunction(type) {
    if (type === 'mytask') {
        $('#mytask').show();
        $('#task_assign_by_me').hide();
        $('#my_task_tab').addClass('active');
        $('#me_task_button').removeClass('active');
    } else {
        $('#mytask').hide();
        $('#task_assign_by_me').show();
        $('#me_task_button').addClass('active');
        $('#my_task_tab').removeClass('active');
    }
}

    </script>


@endpush