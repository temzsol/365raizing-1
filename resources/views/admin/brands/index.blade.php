@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin-top:80px;">
                    <a href="{{route('company.index')}}" class="btn btn-primary">Back</a>
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Brand Name</th>
                                <th>Company Name</th>
                                <th>Division</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->bname}}</td>
                                <td>{{$value->comp_name}}</td>
                                <td>{{$value->bdivision}}</td>
                                <td>{{$value->div_mail}}</td>
                                <td>{{$value->div_mob}}</td>
                                
                                <td>
                                    <div class="button_align">
                                        <a href="{{route('brands.edit',$value->id)}}" class="btn btn-outline-primary"><i class="bx bx-pencil"></i> Edit </a>  <a href="javascript:void(0);"onClick="deleteblogs('{{$value->id}}')" class="btn btn-outline-danger"><i class="bx bx-trash-alt"></i> Delete</a>
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