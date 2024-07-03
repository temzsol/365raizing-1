
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
                        <div class="card-header"><strong>Employee Leave Apply</strong><small> Form</small>
                            @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                        </div>
                        @if(isset($holiday))
                        <form action="{{route('leave.update',$holiday->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                            @else
                            <form method="POST" action="{{route('leave.store')}}" id="emp_task_form" enctype="multipart/form-data">
                            @endif
                                
                                @if($leave_remaining > 0)
                                <input type="hidden" id="leave_remaining" name="leave_remaining" value="{{($total_leave-$takenleave)}}"> 
                                <p class="text-primary">Total Leave: <b class="text-dark"> {{$total_leave}},</b> Taken Leave:<b class="text-dark"> {{$takenleave}},</b> Remaining Leave:<b class="text-dark"> {{$leave_remaining}} </b></p>
                                @else
                                <input type="hidden" id="leave_remaining" name="leave_remaining" value="0"> 
                                <p class="text-primary">Total Leave: <b class="text-dark"> {{$total_leave}},</b> Taken Leave:<b class="text-dark"> {{$takenleave}},</b> Remaining Leave:<b class="text-dark"> {{$leave_remaining}} </b></p>
                               @endif
                               @csrf
                                <div class="card-body card-block">
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <label class="form-control-label">Leave Title<span class="text-danger">*</span></label>
                                              <input type="text" id="l_title" name="l_title" class="form-control" required>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                          <input type="text" name="emp_id" id="emp_id" hidden>
                                          <div class="col-sm-12">
                                              <label for="deadline" class="form-control-label">From Date<span class="text-danger">*</span></label>
                                              <input type="date" id="l_date" class="form-control" name="l_date" required>
                                          </div>
              
                                      </div>
              
                                  </div>
                            
                                   <div class="form-group">
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <label for="deadline" class="form-control-label">To Date<span class="text-danger">*</span></label>
                                              <input type="date" id="to_date" class="form-control" name="to_date" required>
                                          </div>
              
                                      </div>
                                  </div>
              
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <label for="l_desc" class="form-control-label">Leave Description<span class="text-danger">*</span></label>
                                              <textarea name="l_desc" id="l_desc" rows="5" placeholder="Detail..." class="form-control" required></textarea>
                                          </div>
                                      </div>
                                  </div>
                                      <div class="form-group">
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <label for="deadline" class="form-control-label">Attach Your Leave Application <span class="text-danger">*File Must be .jpg,png,pdf</span></label>
                                              <input type="file" id="attachment" class="form-control" name="attachment" accept="image/jpeg,image/jpg,image/png,application/pdf" required>
                                          </div>
              
                                      </div>
              
                                  </div>
                                  
                                  <div class="form-group">
                                    @if($effectiveDate > date('Y-m-d'))
                                    <button  class="form-control btn btn-primary submit" id="submit" style="margin-top: 15px; border-radius: 6px; width: 130px;" disabled>Submit </button>
                                   @else
                                   <input type="submit" class="form-control btn btn-primary submit" id="submit" name="submit" style="margin-top: 15px; border-radius: 6px; width: 130px;">
                                   
                                   @endif
                                  </div>
                                  <span class="error" style="display:none"> Please Enter All Details</span>
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
