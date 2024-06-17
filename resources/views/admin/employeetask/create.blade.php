@extends('layouts.masteradmin')
@section('body')
<div class="page-content">
<div class="row">
    <div class="col-12">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card-body">
                <div class="card">
                <div class="card-header"><strong>Employee Task</strong><small> Form</small></div>
               
                @if(isset($employeeTask))
                <form action="{{route('employeetask.update',$employeeTask->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" value="{{$employeeTask->id}}" name="id">
                    @else
                    <form action="{{route('employeetask.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                    <div class="card-body card-block">
                        <div class="form-group mb-4">
                            <label for="emp_id" class=" form-control-label">Employee Name<span class="text-danger">*</span></label>
                            <select name="emp_id" id="emp_id" class="form-control" required>
                                <option value="#">Please select Employee first</option>
                                @foreach($employee as $key => $value)
                                <option value="{{ $value->id }}" {{ isset($employeeTask) && $value->id == $employeeTask->emp_id ? 'selected' : '' }}>
                                    {{ $value->fname }}
                                </option>
                            @endforeach
  
                                
                            </select>
                        </div>

                      <div class="form-group mb-4">
                          <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                          <input type="text" id="t_title" class="form-control" name="t_title" value="{{isset($employeeTask)?$employeeTask->t_title:''}}" required>
                      </div>
                      <div class="form-group mb-4">
                        <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                        <input type="date" id="deadline" class="form-control" name="deadline" value="{{isset($employeeTask)?$employeeTask->deadline:''}}" required>
                    </div>

                      <div class="form-group mb-4">
                          <label>Upload task related documents/images (if any)</label>
                          @if(isset($employeeTask))
                          <a href="{{url('/images/'.$employeeTask->t_file)}}">Task File</a>
                          @endif
                          <input type="file" name="t_file" multiple="multiple" class="form-control">
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control">{{isset($employeeTask)?$employeeTask->t_detail:''}}</textarea>
                      </div>
                      @if(isset($employeeTask))
                      <div class="form-group mb-4">
                          <label for="comments" class="form-control-label">Comments</label>
                          <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{isset($employeeTask)?$employeeTask->comments:''}}</textarea>
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Status</label>
                          <select class="form-select" name="status">
                              <option @if(isset($employeeTask) && $employeeTask->status=='1') selected="selected" @endif value="1">Completed</option>
                              <option @if(isset($employeeTask) && $employeeTask->status=='0') selected="selected" @endif value="0">Incompleted</option>
                          </select>
                      </div>
                      @endif
                      <div class="form-group mb-4">
                        <input type="submit" name="cok" value="{{isset($employeeTask)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"     />
                      </div>
                    </div>
                </form>
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


@endpush

