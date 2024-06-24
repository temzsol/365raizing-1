@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin-top:80px;">
                    Employee's Holidays List Company Wise
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->company_name}}</td>
                                <td>{{$value->brand}}</td>
                                <td><a href="{{route('viewholidays',['id'=>$value->id])}}"class="btn btn-primary">View Holidays</a></td>
                           
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
            url: '{{ url('master-admin/brands') }}/'+tid,
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