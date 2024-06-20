@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin-top:80px;">
                   All Employee
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Brand Name</th>
                                <th>Designation</th>
                                <th>Location</th>
                                <th>Contact</th>
                                <th>Employee Role</th>
                                <th>Assign Task</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->fname . $value->mname.$value->lname }}</td>
                                <td>{{$value->bname}}</td>
                                <td>{{$value->designation}}</td>
                                <td>{{$value->eloc}}</td>
                                <td>{{$value->empmob}}</td>
                               @if($value->role==0)
                               <td><button disabled class="btn btn-primary">Employee</button></td>
                                @elseif($value->role==1)
                                <td> <button disabled class="btn btn-success">Admin</button></td>
                                @else
                                <td>  <button disabled class="btn btn-dark">HR</button></td>
                                @endif
                                <td><a class="btn btn-primary" href="{{route('employeetask.create')}}">Add Task</a></td>
                                <td>
                                    <div class="button_align">
                                        <a href="{{route('employee.edit',$value->id)}}" class="btn btn-outline-primary"><i class="bx bx-pencil"></i> Edit </a>
                                       
                                        @if($usertype=Auth::user()->type =='master_admin')
                                        <a href="javascript:void(0);" onClick="deleteblogs('{{$value->id}}')" class="btn btn-outline-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$data->links('vendor.pagination.simple-bootstrap-4')}}
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-section-code')

<script>
    function deleteblogs(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('master-admin/employee') }}/'+tid,
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
    </script>


@endpush