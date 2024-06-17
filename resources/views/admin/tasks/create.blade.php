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
                <div class="card-header"><strong>Super Admin Task</strong><small> Form</small></div>
               
                @if(isset($mytask))
                <form action="{{route('tasks.update',$mytask->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" value="{{$mytask->id}}" name="id">
                    @else
                    <form action="{{route('tasks.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                    <div class="card-body card-block">
                      <div class="form-group mb-4">
                          <label for="brand" class=" form-control-label">Brand<span class="text-danger">*</span></label>
                          <select name="brand" id="brand" class="form-control" onchange="employee_fetch(this.value)" required>
                              <option value="#">Please select Brand first</option>
                              @foreach($brand as $key => $value)
                              <option value="{{ $value->id }}" {{ isset($mytask) && $value->id == $mytask->brand ? 'selected' : '' }}>
                                  {{ $value->bname }}
                              </option>
                          @endforeach

                              
                          </select>
                      </div>

                      <div class="form-group mb-4">
                          <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                          <input type="text" id="t_title" class="form-control" name="t_title" value="{{isset($mytask)?$mytask->t_title:''}}" required>
                      </div>

                      <div class="form-group mb-4">
                          <label>Upload task related documents/images (if any)</label>
                          <input type="file" name="t_file" multiple="multiple" class="form-control">
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control">{{isset($mytask)?$mytask->t_detail:''}}</textarea>
                      </div>
                    @if(isset($mytask))
                    <div class="form-group mb-4">
                        <label for="comments" class="form-control-label">Comments</label>
                        <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{isset($mytask)?$mytask->comments:''}}</textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tdetail" class="form-control-label">Task Status</label>
                        <select class="form-select" name="status">
                            <option @if(isset($mytask) && $mytask->status=='1') selected="selected" @endif value="1">Completed</option>
                            <option @if(isset($mytask) && $mytask->status=='0') selected="selected" @endif value="0">Incompleted</option>
                        </select>
                    </div>
                    @endif
                      <div class="form-group mb-4">
                        <input type="submit" value="{{isset($brand)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_brand_submit"style="margin-top: 15px; border-radius: 6px; width: 130px;" />
                                <a href="{{route('tasks.index')}}" class="btn btn-dark" style="margin-top: 15px; border-radius: 6px; width: 130px;" >Back</a>   
                        
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

