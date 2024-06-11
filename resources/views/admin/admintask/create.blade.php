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
                <div class="card-header"><strong>Admin Task</strong><small> Form</small></div>
               
                @if(isset($adminTask))
                <form action="{{route('admintask.update',$adminTask->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" value="{{$adminTask->id}}" name="id">
                    @else
                    <form action="{{route('admintask.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                    <div class="card-body card-block">
                        <div class="form-group mb-4">
                            <label for="emp_id" class=" form-control-label">Admin Name<span class="text-danger">*</span></label>
                            <select name="emp_id" id="emp_id" class="form-control" required>
                                <option value="#">Please select Admin first</option>
                                
                                @foreach($admin as $key => $value)
                                <option value="{{ $value->id }}" {{ isset($adminTask) && $value->id == $adminTask->emp_id ? 'selected' : '' }}>
                                    {{ $value->fname }}
                                </option>
                            @endforeach
  
                                
                            </select>
                        </div>

                      <div class="form-group mb-4">
                          <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                          <input type="text" id="t_title" class="form-control" name="t_title" value="{{isset($adminTask)?$adminTask->t_title:''}}" required>
                      </div>
                      <div class="form-group mb-4">
                        <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                        <input type="date" id="deadline" class="form-control" name="deadline" value="{{isset($adminTask)?$adminTask->deadline:''}}" required>
                    </div>

                      <div class="form-group mb-4">
                          <label>Upload task related documents/images (if any)</label>
                          @if(isset($adminTask))
                          <a href="{{url('/images/'.$adminTask->t_file)}}">Task File</a>
                          @endif
                          <input type="file" name="t_file" multiple="multiple" class="form-control">
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control">{{isset($adminTask)?$adminTask->t_detail:''}}</textarea>
                      </div>
                      <div class="form-group mb-4">
                        <input type="submit" name="cok" value="{{isset($adminTask)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"     />
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

