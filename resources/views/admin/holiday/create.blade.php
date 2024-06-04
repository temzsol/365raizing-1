
@extends('layouts.masteradmin')
@section('body')

<div class="page-content">
<div class="row">
    <div class="col-12">
        @if ($errors->any())
    <div class="alert alert-text-text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="card">
            <div class="card-body">
                <div class="card">
                        <div class="card-header"><strong>Holiday</strong><small> Form</small></div>
                        @if(isset($holiday))
                        <form action="{{route('holiday.update',$holiday->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                            @else
                            <form action="{{route('holiday.store')}}" method="post" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="card-body card-block">
                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="v_brand" class="form-control-label">Company Name<span class="danger">*</span></label>
                                                <select name="company_id" id="company_id" class="form-control" required>
                                                    <option value="">Please select Company</option>
                                                    @foreach($company as $value)
                                                    <option value="{{$value->id}}">{{$value->compname}}</option>
                                                    @endforeach

                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="date" class="form-control-label">Holiday Date<span class="danger">*</span></label>
                                                <input type="date" id="date" name="date[]" placeholder="Date" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="holidays" class="form-control-label">Holiday Name<span class="danger">*</span></label>
                                                <input type="text" id="holidays" name="holidays[]" placeholder="Holidays Name" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mt-4">
                                                <button type="button" id="vendor_service" class="btn btn-success">+Add</button>

                                            </div>
                                        </div>
                                    <div id="contentappend"></div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="submit" name="holiday_ok" value="Submit" class="form-control btn btn-primary" style="margin-top: 15px; border-radius: 6px; width: 130px;" />
                                    </div>
                                </div>
                            </form>
                    
                  </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
</div>

@endsection

@push('footer-section-code')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        $('#vendor_service').click(function () {
            $('#contentappend').append(
                '<div class="row">' +
                    '<div class="col-md-4 mt-4">' +
                        '<label for="date" class="form-control-label">Holiday Date<span class="danger">*</span></label>' +
                        '<input type="date" name="date[]" placeholder="Date" class="form-control" required>' +
                    '</div>' +
                    '<div class="col-md-4 mt-4">' +
                        '<label for="holidays" class="form-control-label">Holiday Name<span class="danger">*</span></label>' +
                        '<input type="text" name="holidays[]" placeholder="Holidays Name" class="form-control" required>' +
                    '</div>' +
                    '<div class="col-md-4 mt-4">' +
                        '<button type="button" class="btn btn-danger mt-4 btn_remove2"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                    '</div>' +
                '</div>'
            );
        });
    
        $(document).on('click', '.btn_remove2', function () {
            $(this).closest('.row').remove();
        });
    });
    </script>
@endpush
