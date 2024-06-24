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
                <div class="card-header"><strong>Management Task</strong><small> Form</small></div>
               
                <form action="{{route('managementtask.update',$staffTask->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" value="{{$staffTask->id}}" name="id">
                        @csrf
                    <div class="card-body card-block">
                        <div class="form-group mb-4">
                            <label for="user_type" class=" form-control-label">Management Role<span class="text-danger">*</span></label>
                            <select name="user_type" id="user_type" class="form-control" required @if(isset($staffTask) && $login_id==$staffTask->task_assign_from)onchange="usertype()" @endif {{isset($staffTask) && $login_id != $staffTask->task_assign_from?'readonly':''}}>
                                <option value="#">Please Select Role First</option>
                               
                                <option value="master_admin" {{ isset($staffTask) && $staffTask->user_type == 'master_admin' ? 'selected' : '' }}>
                                    {{'Master Admin'}}
                                </option>
                                <option value="Admin" {{ isset($staffTask) && $staffTask->user_type == 'Admin' ? 'selected' : '' }}>
                                    {{'Admin'}}
                                </option>
                                <option value="HR" {{ isset($staffTask) && $staffTask->user_type == 'HR' ? 'selected' : '' }}>
                                    {{'HR'}}
                                </option>                                
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="task_assign_to" class=" form-control-label">Management Person Name<span class="text-danger">*</span></label>
                            <select name="task_assign_to" id="task_assign_to" class="form-control" required {{isset($staffTask) && $login_id != $staffTask->task_assign_from?'readonly':''}} >
                               
                            @if(isset($staffTask))
                                @foreach($emp_data as $value)
                                <option value="{{$value->id}}" @if(isset($staffTask) && $staffTask->task_assign_to==$value->id) selected="selected" @endif>{{$value->fname}}</option>
                                @endforeach
                            @else
                            <option value="#">Please select Employee first</option>
                            @endif
                            </select>
                        </div>

                      <div class="form-group mb-4">
                          <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                          <input type="text" id="t_title" class="form-control" name="t_title" value="{{isset($staffTask)?$staffTask->t_title:''}}" required {{isset($staffTask) && $login_id != $staffTask->task_assign_from?'readonly':''}}>
                      </div>
                      <div class="form-group mb-4">
                        <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                        <input type="date" id="deadline" class="form-control" name="deadline" value="{{isset($staffTask)?$staffTask->deadline:''}}" required {{isset($staffTask) && $login_id != $staffTask->task_assign_from?'readonly':''}} >
                    </div>

                      <div class="form-group mb-4">
                          <label>Upload task related documents/images (if any)</label>
                          @if(isset($staffTask))
                          <a href="{{url('/images/'.$staffTask->t_file)}}">Task File</a>
                          @endif
                          <input type="file" name="t_file" multiple="multiple" class="form-control"{{isset($staffTask) && $login_id != $staffTask->task_assign_from?'readonly':''}}>
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control" {{isset($staffTask) && $login_id != $staffTask->task_assign_from?'readonly':''}} >{{isset($staffTask)?$staffTask->t_detail:''}}</textarea>
                      </div>
                      @if(isset($staffTask))
                      <div class="form-group mb-4">
                          <label for="comments" class="form-control-label">Comments</label>
                          <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{isset($staffTask)?$staffTask->comments:''}}</textarea>
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Status</label>
                          <select class="form-select" name="status">
                              <option @if(isset($staffTask) && $staffTask->status=='1') selected="selected" @endif value="1">Completed</option>
                              <option @if(isset($staffTask) && $staffTask->status=='0') selected="selected" @endif value="0">Incompleted</option>
                          </select>
                      </div>
                      @endif
                      
                      <div class="form-group mb-4">
                        <input type="submit" value="{{isset($staffTask)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"     />
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
      // Get the input field
      const dateInput = document.getElementById('deadline');
      
      // Create a new Date object for today
      const today = new Date();
      
      // Format the date as YYYY-MM-DD
      const formattedDate = today.toISOString().split('T')[0];
      
      // Set the min attribute to today's date
      dateInput.setAttribute('min', formattedDate);
    });
  </script>
@endpush

