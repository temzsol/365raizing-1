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
               
                @if(isset($stafftask))
                <form action="{{route('staftask.update',$stafftask->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" value="{{$stafftask->id}}" name="id">
                    @else
                    <form action="{{route('staftask.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                    <div class="card-body card-block">
                        <div class="form-group mb-4">
                            <label for="user_type" class=" form-control-label">Management Role<span class="text-danger">*</span></label>
                            <select name="user_type" id="user_type" class="form-control" required onchange="usertype()" onclick="usertype()">
                                <option value="#">Please Select Role First</option>
                               
                                <option value="master_admin" {{ isset($stafftask) && $stafftask->user_type == 'master_admin' ? 'selected' : '' }}>
                                    {{'Master Admin'}}
                                </option>
                                <option value="Admin" {{ isset($stafftask) && $stafftask->user_type == 'Admin' ? 'selected' : '' }}>
                                    {{'Admin'}}
                                </option>
                                <option value="HR" {{ isset($stafftask) && $stafftask->user_type == 'HR' ? 'selected' : '' }}>
                                    {{'HR'}}
                                </option>
                           
  
                                
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="task_assign_to" class=" form-control-label">Management Person Name<span class="text-danger">*</span></label>
                            <select name="task_assign_to" id="task_assign_to" class="form-control" required>
                                <option value="#">Please select Employee first</option>
                                @foreach($emp_data as $value)
                                <option value="{{$value->id}}" @if(isset($stafftask) && $stafftask->task_assign_to==$value->id) selected="selected" @endif>{{$value->fname}}</option>
                                @endforeach
                            </select>
                        </div>

                      <div class="form-group mb-4">
                          <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                          <input type="text" id="t_title" class="form-control" name="t_title" value="{{isset($stafftask)?$stafftask->t_title:''}}" required>
                      </div>
                      <div class="form-group mb-4">
                        <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                        <input type="date" id="deadline" class="form-control" name="deadline" value="{{isset($stafftask)?$stafftask->deadline:''}}" required>
                    </div>

                      <div class="form-group mb-4">
                          <label>Upload task related documents/images (if any)</label>
                          @if(isset($stafftask))
                          <a href="{{url('/images/'.$stafftask->t_file)}}">Task File</a>
                          @endif
                          <input type="file" name="t_file" multiple="multiple" class="form-control">
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control">{{isset($stafftask)?$stafftask->t_detail:''}}</textarea>
                      </div>
                      @if(isset($stafftask))
                      <div class="form-group mb-4">
                          <label for="comments" class="form-control-label">Comments</label>
                          <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{isset($stafftask)?$stafftask->comments:''}}</textarea>
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Status</label>
                          <select class="form-select" name="status">
                              <option @if(isset($stafftask) && $stafftask->status=='1') selected="selected" @endif value="1">Completed</option>
                              <option @if(isset($stafftask) && $stafftask->status=='0') selected="selected" @endif value="0">Incompleted</option>
                          </select>
                      </div>
                      @endif
                      <div class="form-group mb-4">
                        <input type="submit" name="cok" value="{{isset($stafftask)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"     />
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
<script>
function usertype() {
    var user_type = $('#user_type').val();
    
    $.ajax({
        method: 'POST',
        url: '{{ url('user_type') }}',
        data: {
            user_type: user_type,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success === true) {
                $('#task_assign_to').html(response.html); // Update the HTML of the dropdown with the response
            } else {
                $('#task_assign_to').html("No Data Found");
                location.reload(); // Reload the page on failure
            }
        },
        error: function(xhr, status, error) {
            swal("Request Failed!", "An error occurred while processing your request.", "error");
        }
    });
}

</script>
@endpush

