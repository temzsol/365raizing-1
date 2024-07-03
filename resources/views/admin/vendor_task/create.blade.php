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
                <div class="card-header"><strong>Vendor Task Assign</strong><small> Form</small></div>
               
                @if(isset($vendorTaskAssign))
                <form action="{{route('vendor-task.update',$vendorTaskAssign->id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="{{$vendorTaskAssign->id}}" name="id">
                @method('PUT')
                <input type="hidden" value="{{$vendorTaskAssign->id}}" name="id">
                    @else
                    <form action="{{route('vendor-task.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                    <div class="card-body card-block">
                        <div class="form-group mb-4">
                            <label for="vendor_id" class=" form-control-label">Vendor Name<span class="text-danger">*</span></label>
                            
                            <select name="vendor_id" id="vendor_id" class="form-control" required {{$type !='Vendor'?'':'readonly'}}>
                                <option value="#">Please select Vendor Name</option>
                                @foreach($vendor as $key => $value)
                                <option value="{{ $value->id }}" {{ isset($vendorTaskAssign) && $value->id == $vendorTaskAssign->vendor_id ? 'selected' : '' }}>
                                    {{ $value->fname }}
                                </option>
                            @endforeach
                        </select>
                        
                        </div>
                      {{-- <div class="form-group mb-4">
                          <label for="brand" class=" form-control-label">Brand<span class="text-danger">*</span></label>
                          <select name="brand" id="brand" class="form-control" onchange="employee_fetch(this.value)" required>
                              <option value="#">Please select Brand first</option>
                              @foreach($brand as $key => $value)
                              <option value="{{ $value->id }}" {{ isset($vendorTaskAssign) && $value->id == $vendorTaskAssign->brand ? 'selected' : '' }}>
                                  {{ $value->bname }}
                              </option>
                          @endforeach

                              
                          </select>
                      </div>
                      <div class="form-group mb-4">
                        <label for="brand" class=" form-control-label">Services<span class="text-danger">*</span></label>
                        <select name="brand" id="brand" class="form-control" onchange="employee_fetch(this.value)" required>
                            <option value="#">Please select Brand first</option>
                            @foreach($brand as $key => $value)
                            <option value="{{ $value->id }}" {{ isset($vendorTaskAssign) && $value->id == $vendorTaskAssign->brand ? 'selected' : '' }}>
                                {{ $value->bname }}
                            </option>
                        @endforeach

                            
                        </select>
                    </div> --}}
                      <div class="form-group mb-4">
                        <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                        <input type="date" id="deadline_date" class="form-control" name="deadline_date" value="{{isset($vendorTaskAssign)?$vendorTaskAssign->deadline_date:''}}" required {{$type !='Vendor'?'':'readonly'}}>
                    </div>
                    <div class="form-group mb-4">
                          @if($type !='Vendor')
                          <label>Upload task related documents/images (if any)</label>
                                @if(isset($vendorTaskAssign) && $vendorTaskAssign->task_file !='')
                                <a href="{{url('/images/'.$vendorTaskAssign->task_file)}}">Task File</a>
                                @endif
                          <input type="file" name="task_file"  class="form-control">
                          @else
                                @if(isset($vendorTaskAssign) && $vendorTaskAssign->task_file !='')
                                <a href="{{url('/images/'.$vendorTaskAssign->task_file)}}" class="btn btn-primary" target="_blank" download>Download File</a>
                                @endif
                          @endif
                      </div>


                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="task_detail" id="task_detail" rows="5" placeholder="Detail..." class="form-control" {{$type !='Vendor'?'':'readonly'}}>{{isset($vendorTaskAssign)?$vendorTaskAssign->task_detail:''}}</textarea>
                      </div>
                      @if(isset($vendorTaskAssign))
                      <div class="form-group mb-4">
                          <label for="comments" class="form-control-label">Comments</label>
                          <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{isset($vendorTaskAssign)?$vendorTaskAssign->comments:''}}</textarea>
                      </div>
                     
                      <div class="col-lg-4 mt-4">
                        <label for="ucomp" class=" form-control-label">Status<span style="color:red;">*</span> </label>
                        <select name="status" class="form-control" required>
                           <option>Please select status</option>
                           <option value="1"{{isset($vendorTaskAssign) && $vendorTaskAssign->status==1?'selected':''}}>Done</option>
                           <option value="2"{{isset($vendorTaskAssign) && $vendorTaskAssign->status==2?'selected':'selected'}}>Under Process</option>
                        </select>
                     </div>
                     @endif
                      <div class="form-group mb-4">
                         
                          <input type="submit" name="cok" value="{{isset($vendor)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"     />
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

