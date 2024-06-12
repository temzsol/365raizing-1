@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin-top:80px;">
                   All Cutomer Query
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Lead Type</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Passport Number</th>
                                <th>Query</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->leadtype}}</td>
                                <td>{{$value->ct_name}}</td>
                                <td>{{$value->ct_mail}}</td>
                                <td>{{$value->ct_mob}}</td>
                                <td>{{$value->ct_passport}}</td>
                                <td>{{$value->query_details}}</td>
                                
                                <td>
                                    <a href="{{route('customer-query.edit',$value->id)}}"><i class="bx bx-pencil"></i> Edit </a>
                                    @if(Auth::user()->type=='master_admin')
                                    <a href="javascript:void(0);"  onClick="deleteblogs('{{$value->id}}')" class="text-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                    @endif
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
            url: '{{ url('master-admin/customer-query') }}/'+tid,
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