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
                                <th>Holiday Name</th>
                                <th>Holiday Date</th>
                                <th>Holiday Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($holidays as $key=>$value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value}}</td>
                                <td>{{$date[$key]}}</td>
                                <td>{{$day[$key]}}</td>
                           
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{$holidays->links('vendor.pagination.simple-bootstrap-4')}} --}}
                
            </div>
        </div>
    </div>
</div>
@endsection

