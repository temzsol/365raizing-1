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
                    <form action="{{route('managementtask.store')}}" method="post" enctype="multipart/form-data">
                       
                        @csrf
                    <div class="card-body card-block">
                        <div class="form-group mb-4">
                            <label for="user_type" class=" form-control-label">Management Role<span class="text-danger">*</span></label>
                            <select name="user_type" id="user_type" class="form-control" required onchange="usertype()" >
                                <option value="#">Please Select Role First</option>
                               
                                <option value="master_admin">Master Admin</option>
                                <option value="Admin">Admin</option>
                                <option value="HR">HR </option> 
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="task_assign_to" class=" form-control-label">Management Person Name<span class="text-danger">*</span></label>
                            <select name="task_assign_to" id="task_assign_to" class="form-control" required  >
                               
                            
                            <option value="#">Please select Employee first</option>
                           
                            </select>
                        </div>

                      <div class="form-group mb-4">
                          <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                          <input type="text" id="t_title" class="form-control" name="t_title"  required>
                      </div>
                      <div class="form-group mb-4">
                        <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                        <input type="date" id="deadline" class="form-control" name="deadline"  required >
                    </div>

                      <div class="form-group mb-4">
                          <label>Upload task related documents/images (if any)</label>
                          <input type="file" name="t_file" multiple="multiple" class="form-control">
                      </div>
                      <div class="form-group mb-4">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control"  ></textarea>
                      </div>                      
                      
                      <div class="form-group mb-4">
                        <input type="submit" value="Submit" class="form-control btn btn-primary" id="Add_comp_submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"     />
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

