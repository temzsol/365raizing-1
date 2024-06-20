@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin-top:80px;">
                   Employee Leave Information  
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Leave Subject</th>
                                <th>Description</th>
                                <th>Attachment</th>
                                <th>Leave From</th>
                                <th>Leave To</th>
                                <th>Leave Remaing</th>
                                <th>Approval Status</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->fname . $value->mname.$value->lname }}</td>
                                <td>{{$value->l_title}}</td>
                                <td>{{$value->l_desc}}</td>
                                <td>{{$value->attachment}}</td>
                                <td>{{$value->l_date}}</td>
                                <td>{{$value->to_date}}</td>
                                <td>{{$value->leave_remaining}}</td>
                                {{-- For Master Admin Section --}}
                                @if(Auth::user()->type=='master_admin')
                                    @if($value->l_status == 1)
                                    <td>  <button class="btn btn-primary btn-sm disabled">Leave Approved</button></td>
                                    @endif
                                    @if($value->l_status == 2)
                                        <td><button class="btn btn-warning btn-sm disabled">Leave Rejected</button></td>
                                    @endif
                                   {{-- For Master Admin Approval Section --}}
                                    @if($value->l_status==0)
                                    
                                        <td><button type="button" class="btn btn-success btn-sm" onclick="approve({{$value->id}})">Leave Approved</button></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="reject({{$value->id}})">Leave Rejected</button></td>
                                        
                                    @endif
                                    {{-- For Master Admin Approval Section --}}
                                @elseif(Auth::user()->type=='Admin' || Auth::user()->type=='HR')
                                   @if($value->approve_status_of_admin	==1)
                                   <td>  <button class="btn btn-primary btn-sm disabled">Leave Approved</button></td>
                                   @endif
                                   @if($value->approve_status_of_admin	==2)
                                    <td><button class="btn btn-warning btn-sm disabled">Leave Rejected</button></td>
                                   @endif
                                   {{-- For Master Admin And Hr Approval Section --}}
                                   @if($value->approve_status_of_admin==0)
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_button{{$value->id}}">Approve</button></td>
                                   <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_button{{$value->id}}">Rejected</button></td>
                                    @endif  
                                @else

                                   {{-- Employee Dashboar Section --}}
                                   @if($value->l_status	==1)
                                   <td>  <button class="btn btn-success btn-sm disabled">Leave Approved</button></td>
                                   @endif
                                   @if($value->l_status	==2)
                                 <td>  <button class="btn btn-warning btn-sm disabled">Leave Rejected</button></td>
                                   @endif
                                   @if($value->l_status	==0)
                                   <td>  <button class="btn btn-primary btn-sm disabled">Pending</button></td>
                                     @endif
                                @endif
                               <!-- Modal -->
                            <div class="modal fade" id="modal_button{{$value->id}}" tabindex="-1" aria-labelledby="modal_button{{$value->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="modal_button{{$value->id}}Label">HR / Admin Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="{{route('primary_leave_status')}}">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="form-control-label">Admin/Hr Comments<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="admin_hr_comments" id="admin_hr_comments" cols="30" rows="10">{{isset($value->admin_hr_comments)?$value->admin_hr_comments:''}}</textarea>
                                                    <input type="hidden" value="{{$value->id}}" name="id">
                                                    
                                                </div>
                                                <div class="col-sm-12 mt-4">
                                                    <label class="form-control-label">Leave Status<span class="text-danger">*</span></label>
                                                <select class="form-select" name="approve_status_of_admin">
                                                    <option @if(isset($value) && $value->approve_status_of_admin=='1') selected="selected" @endif value="1">Approve</option>
                                                    <option @if(isset($value) && $value->approve_status_of_admin=='2') selected="selected" @endif value="0">Reject</option>
                                                </select>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
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
    function approve(tid){
        if(confirm('You Want To Approve Leave'))
        {
        $.ajax({
            method:'POST',
            url: '{{ url('master-admin/EmpLeaveStatusApprove') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success==true)
                {
                    swal("Success!", response.message, "success");
                    location.reload();
               
                }
                if(response.success==false)
                {
                    swal("Success!", response.message, "success");
                    location.reload();
                    

                }
                
            }
        });
    }
}
    function reject(tid){
        if(confirm('Are You sure you want to Reject'))
        {
        $.ajax({
            method:'POST',
            url: '{{ url('master-admin/EmpLeaveStatusReject') }}/'+tid,
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