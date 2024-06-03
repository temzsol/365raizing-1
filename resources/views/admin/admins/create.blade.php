
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
                        <div class="card-header"><strong>Admin</strong><small> Form</small></div>
                        @if(isset($admin))
                        <form action="{{route('admins_update',$admin->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden"  name="id" value="{{$admin->id}}" required>
                            @else
                            <form  method="post" enctype="multipart/form-data" action="{{route('admins_create')}}" id="form1" onSubmit="return emp_validation()" >
                            @endif
                                @csrf
                                <div class="card-body card-block">
                                  <div class="form-group mb-4">
                                      <div class="row">
                                          <div class="col-lg-12">
                                              <label for="fname" class="form-control-label">Full Name <span style="color:red;">*</span> </label>
                                              <input type="text" id="fname" placeholder="Enter employee's name" class="form-control" name="fname" value="{{isset($admin)?$admin->fname:''}}" required>
                                          </div>
                                      </div>
                                  </div>
      
                                  <div class="form-group mb-4">
                                      <div class="row">
                                          <div class="col-lg-12">
                                                 <label for="empmail" class="form-control-label">Personal Email ID <span style="color:red;">*</span></label>
                                              <input type="email" readonly id="empmail" placeholder="Enter Personal Email ID" class="form-control" value="{{isset($admin)?$admin->empmail:''}}">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group mb-4">
                                      <div class="row">
                                          <div class="col-lg-12">
                                                 <label for="empmob" class="form-control-label">Mobile No. <span style="color:red;">*</span></label>
                                              <input type="text" id="empmob" placeholder="Enter Mobile No." class="form-control" name="empmob" value="{{isset($admin)?$admin->empmob:''}}" required>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group mb-4">
                                      <div class="row">
                                           <div class="col-lg-12">
                                              <label class="form-control-label">Aadhar No.</label>
                                                 <input type="text" id="aadhar_no" placeholder="Enter employee's Aadhar No" class="form-control" name="aadhar_no" value="{{isset($admin)?$admin->aadhar_no:''}}">
                                          </div>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group mb-4">
                                      <div class="row">
                                          <div class="col-lg-12">
                                              <label class="form-control-label">Pan No.</label>
                                             <input type="text" id="pan_no" placeholder="Enter employee's Pan No" class="form-control" name="pan_no" value="{{isset($admin)?$admin->pan_no:''}}">
                                          </div>
                                      </div>
                                  </div>
                              <div class="form-group mb-4">
                                <input type="submit" name="brandok" value="{{isset($admin)?'Update':'Submit'}}" class="form-control btn btn-primary" style="margin-top: 15px; border-radius: 6px; width: 130px;" />
                              
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
   function emp_validation()
        {
           
            var fname =  $("#fname").val();
            var empmail =  $("#empmail").val();
            var empmob =  $("#empmob").val();
            
            
             if(fname == '')
        	 {
        	    alert('Please enter Name');
        		return false;
        	 }
            
            if(empmail == '')
        	 {
        	    alert('Please enter Email ID');
        		return false;
        	 }
        	 
        	 if(empmob == '')
        	 {
        	    alert('Please enter Mobile No');
        		return false;
        	 }
    	   
        
          return true;
        }
     </script>
@endpush
