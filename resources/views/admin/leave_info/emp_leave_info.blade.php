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
                                <td>{{$value->no_days}}</td>
                                
                                @if(Auth::user()->type=='master_admin')
                                   @if($value->l_status	==1)
                                   <td>  <button class="btn btn-primary btn-sm disabled">Leave Approved</button></td>
                                   @endif
                                   @if($value->l_status	==2)
                                 <td>  <button class="btn btn-warning btn-sm disabled">Leave Rejected</button></td>
                                   @endif
                                   @if($value->l_status	==0)
                                  <td> <button type="button" class="btn btn-success btn-sm" onclick="approve({{$value->id}})">Leave Approved</button></td>
                                    </td>
                                   <td><button type="button" class="btn btn-danger btn-sm" onclick="reject({{$value->id}})">Leave Rejected</button></td>
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
                    location.reload();
                    swal("Success!", response.message, "success");
                }
                if(response.success==false)
                {
                    location.reload();
                    swal("Success!", response.message, "success");
                    

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