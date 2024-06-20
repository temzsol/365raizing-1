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
                  <div class="card-header"><strong>Employee</strong><small> Form</small></div>
                  @if(isset($employee))
                  <form action="{{route('employee.update',$employee->id)}}" method="post" enctype="multipart/form-data">
                     @method('PUT')
                     @else
                  <form  method="post" enctype="multipart/form-data" action="{{route('employee.store')}}" id="form1" >
                     @endif
                     @csrf
                     <div class="card-body card-block">
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4 mb-4">
                                 <label for="ucomp" class=" form-control-label">Company Name <span style="color:red;">*</span></label>
                                 <select name="compname" id="compname" class="form-control" required onchange="Findbrand()">
                                    <option value="">Please select brand</option>
                                    @foreach($company as $value)
                                    <option value="{{$value->id}}" @if(isset($employee)){{$value->id==$employee->compname?'selected':''}}@endif>{{$value->compname}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-lg-4 mb-4">
                                 <label for="ucomp" class=" form-control-label">Brand <span style="color:red;">*</span></label>
                                 <select name="empbrand" id="empbrand" class="form-control" required>
                                    <option value="">Please select brand</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label for="fname" class="form-control-label">Location <span style="color:red;">*</span></label>
                                 <input type="text" id="eloc" placeholder="Enter employee's location" class="form-control" name="eloc" value="{{isset($employee)?$employee->eloc:''}}" required>
                              </div>
                              <div class="col-lg-4">
                                 <label for="fname" class="form-control-label">Full Name <span style="color:red;">*</span> </label>
                                 <input type="text" id="fname" placeholder="Enter employee's name" class="form-control" name="fname" value="{{isset($employee)?$employee->fname:''}}" required>
                              </div>
                              <div class="col-lg-4">
                                 <label for="mname" class="form-control-label">Designation <span style="color:red;">*</span></label>
                                 <input type="text" id="designation" placeholder="Enter employee's Designnation" class="form-control" name="designation" value="{{isset($employee)?$employee->designation:''}}" required>
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label for="dob" class=" form-control-label">Office Landline</label>
                                 <input type="text" id="landline" placeholder="Enter Office Landline" class="form-control" name="landline" value="{{isset($employee)?$employee->landline:''}}">
                              </div>
                              <div class="col-lg-4">
                                 <!--<label class="form-control-label">Official Email ID</label>-->
                                 <label for="fname" class="form-control-label">Official Email ID <span style="color:red;">*</span></label>
                                 <input type="email" id="official_id" placeholder="Enter Official Email ID" class="form-control" name="official_id" value="{{isset($employee)?$employee->official_id:''}}" required>
                              </div>
                              <div class="col-lg-4">
                                 <!--<label class="form-control-label">Personal Email ID</label>-->
                                 <label for="fname" class="form-control-label">Personal Email ID <span style="color:red;">*</span></label>
                                 <input type="email" id="personal_id" placeholder="Enter Personal Email ID" class="form-control" name="personal_id" value="{{isset($employee)?$employee->personal_id:''}}" required>
                              </div>
                              <div class="col-lg-4">
                                 <label for="mob" class=" form-control-label">Mobile <span style="color:red;">*</span></label>
                                 {{-- if mobile number more then one --}}
                                 @if(isset($employee))
                                 @php
                                 $empmob = explode(',', $employee->empmob); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 @foreach($empmob as $key=>$value)
                                 <div class="row" id="emp_mob_div{{$key}}" style="margin-top:5px; margin-bottom: 10px;">
                                    <div class="col-lg-8 mt-4">
                                       <input type="text" id="mob" placeholder="Enter employee's contact" class="form-control" name="empmob[]" value="{{$value}}">
                                    </div>
                                    <div class="col-lg-2 mt-4">
                                       <button type="button" class="btn btn-danger btn_remove1" id="{{$key}}">Remove</button>
                                    </div>
                                 </div>
                                 @endforeach
                                 <div id="emp_mob_div"></div>
                                 <div class="col-lg-2 mt-4">
                                    <button type="button" class="btn btn-success" id="emp_cont">+Add</button>
                                 </div>
                                 @else
                                 <div id="emp_mob_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="text" id="empmob" placeholder="Enter employee's contact" class="form-control" name="empmob[]" required>
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_cont">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label class="form-control-label">DOL</label>
                                 @if(isset($employee))
                                 @php
                                 $appointment_latter = explode(',', $employee->empdol); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 <div class="row" id="emp_file_div001" style="margin-top:5px; margin-bottom: 10px; display: inline;">
                                    @foreach($appointment_latter as $key=>$value)
                                    <div class="col-lg-8 mt-4" >
                                       @if(!empty($value))
                                       <img src="{{url('/images/'.$value)}}" height="100px" width="100px">
                                       @else
                                       <input type="file" id="dol" class="form-control" name="empdol[]">
                                       @endif
                                       {{-- <input type="file" id="dol" class="form-control" name="empdol[]" value="{{$value}}"> --}}
                                    </div>
                                    {{-- 
                                    <div class="col-lg-2 mt-4">
                                       <buttontype="button" class="btn btn-danger btn_remove1" id="{{$key}}">Remove</buttontype="button">
                                    </div>
                                    --}}
                                    @endforeach
                                 </div>
                                 <div id="emp_file_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="emp_file">+Add</button>
                                    <buttontype="button" class="btn btn-danger emp_dol_section" id="001">Section Remove</buttontype="button">
                                 </div>
                                 @else
                                 <div id="emp_file_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="file" id="dol" class="form-control" name="empdol[]">
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_file">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Appointment Letter</label>
                                 {{-- new code --}}
                                 @if(isset($employee))
                                 @php
                                 $appointment_latter = explode(',', $employee->appointment_latter); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 <div class="row" id="emp_appointment_latter_div001" style="margin-top:5px; margin-bottom: 10px; display: inline;">
                                    @foreach($appointment_latter as $key=>$value)
                                    <div class="col-lg-8 mt-4" >
                                       @if(!empty($value))
                                       <img src="{{url('/images/'.$value)}}" height="100px" width="100px">
                                       @else
                                       <input type="file" id="dol" class="form-control" name="appointment_latter[]" value="Sample"> 
                                       @endif
                                    </div>
                                    @endforeach
                                 </div>
                                 <div id="emp_appointment_latter_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="emp_appointment_latter">+Add</button>
                                    <buttontype="button" class="btn btn-danger emp_appointment_latter_section" id="001">Remove</buttontype="button">
                                 </div>
                                 @else
                                 <div id="emp_appointment_latter_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="file" id="dol" class="form-control" name="appointment_latter[]" value="Sample">
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_appointment_latter">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                                 {{-- New Code End --}}
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Office Add</label>
                                 <input type="text" id="office_add" placeholder="Enter employee's Office Add" class="form-control" name="office_add" value="{{isset($employee)?$employee->office_add:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label class="form-control-label">Res Add</label>
                                 <input type="text" id="res_id" placeholder="Enter employee's Res Add" class="form-control" name="res_id"value="{{isset($employee)?$employee->res_id:''}}">
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Salary(Per Month)</label>
                                 <input type="text" id="salary" placeholder="Enter Salary" class="form-control" name="salary"value="{{isset($employee)?$employee->salary:''}}">
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Emergency Contact Name</label>
                                 <input type="text" id="emergency_name" placeholder="Enter Emergency Contact Name" class="form-control" name="emergency_name"value="{{isset($employee)?$employee->emergency_name:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label class="form-control-label">Emergency Contact no</label>
                                 <input type="text" id="emergency_no" placeholder="Enter Emergency Contact no" class="form-control" name="emergency_no" value="{{isset($employee)?$employee->emergency_no:''}}">
                              </div>
                              <div class="col-lg-4">
                                 <label for="dob" class=" form-control-label">Date of Birth</label>
                                 <input type="date" id="dob" placeholder="Enter employee's DOB" class="form-control" name="empdob" value="{{isset($employee)?$employee->empdob:''}}">
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Date of joining <span style="color:red;">*</span></label>
                                 <input type="date" id="doj" placeholder="Enter DOJ" class="form-control" name="doj" value="{{isset($employee)?$employee->doj:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label class="form-control-label">ID Number</label>
                                 <input type="text" id="aadhar_no" placeholder="Enter employee's ID No" class="form-control" name="aadhar_no" value="{{isset($employee)?$employee->aadhar_no:''}}">
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">ID card</label>
                                 @if(isset($employee))
                                 @php
                                 $aadharcard = explode(',', $employee->aadharcard); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 <div id="emp_adhar_div001">
                                    @foreach($aadharcard as $key=>$value)
                                    <div class="col-lg-8 mt-4" >
                                       @if(!empty($value))
                                       <img src="{{url('/images/'.$value)}}" height="100px" width="100px">                                                 
                                       @else
                                       <input type="file" id="aadharcard" class="form-control mb-4" name="aadharcard[]"> 
                                       @endif
                                    </div>
                                    @endforeach
                                 </div>
                                 <div id="emp_adhar_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="emp_adhar">+Add</button>
                                    <buttontype="button" class="btn btn-danger emp_adhar_section" id="001">Remove</buttontype="button">
                                 </div>
                                 @else
                                 <div id="emp_adhar_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="file" id="aadharcard"  class="form-control" name="aadharcard[]">
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_adhar">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Tax Number</label>
                                 <input type="text" id="pan_no" placeholder="Enter employee's Tax No" class="form-control" name="pan_no" value="{{isset($employee)?$employee->pan_no:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label class="form-control-label">Tax Card</label>
                                 @if(isset($employee))
                                 @php
                                 $pancard = explode(',', $employee->pancard); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 <div class="row" id="emp_pan_div001" style="margin-top:5px; margin-bottom: 10px; display: inline;">
                                    @foreach($pancard as $key=>$value)
                                    <div class="row">
                                       <div class="col-lg-8">
                                          @if(!empty($value))
                                          <img src="{{url('/images/'.$value)}}" height="100px" width="100px">                                                 
                                          @else
                                          <input type="file" id="dol" class="form-control" name="empdol[]" value="Sample"> 
                                          @endif
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                                 <div id="emp_pan_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="emp_pan">+Add</button>
                                    <buttontype="button" class="btn btn-danger emp_pan_section" id="001">Remove</buttontype="button">
                                 </div>
                                 @else
                                 <div id="emp_pan_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="file" id="pancard"  class="form-control" name="pancard[]">
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_pan">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Educational Certificate</label>
                                 @if(isset($employee))
                                 @php
                                 $aadharcard = explode(',', $employee->aadharcard); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 <div id="emp_certificate_div001">
                                    @foreach($aadharcard as $key=>$value)
                                    <div class="col-lg-8">
                                       {{-- <input type="file" id="certificate"  class="form-control" name="certificate[]"> --}}
                                       @if(!empty($value))
                                       <img src="{{url('/images/'.$value)}}" height="100px" width="100px">                                                 
                                       @else
                                       <input type="file" id="certificate" class="form-control mb-4" name="certificate[]"> 
                                       @endif
                                    </div>
                                    @endforeach
                                 </div>
                                 <div id="emp_certificate_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="emp_certificate">+Add</button>
                                    <buttontype="button" class="btn btn-danger emp_certificate_section" id="001">Remove</buttontype="button">
                                 </div>
                                 @else
                                 <div id="emp_certificate_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          {{-- <input type="file" id="certificate"  class="form-control" name="certificate[]"> --}}
                                          @if(!empty($value->file))
                                          <img src="{{url('/images/'.$value)}}" height="100px" width="100px">                                                 
                                          @else
                                          <input type="file" id="certificate" class="form-control mb-4" name="certificate[]"> 
                                          @endif
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_certificate">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Photo</label>
                                 @if(!empty($employee->empphoto))
                                 <img src="{{url('/images/'.$employee->empphoto)}}" height="100px" width="100px">
                                 @endif
                                 <input type="file" id="photo" class="form-control" name="empphoto" >
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-4 mt-4">
                                 <label for="ucomp" class=" form-control-label">Employee Role<span style="color:red;">*</span> </label>
                                 <select name="role" class="form-control" required>
                                 <option value="0"{{isset($employee) && $employee->status==0?'selected':''}}>Employee</option>
                                 <option value="1"{{isset($employee) && $employee->status==1?'selected':''}}>Admin</option>
                                 <option value="2"{{isset($employee) && $employee->status==2?'selected':''}}>HR</option>
                                 </select>
                              </div>
                              <div class="col-lg-4 mt-4">
                                 <label for="ucomp" class=" form-control-label">Status<span style="color:red;">*</span> </label>
                                 <select name="status" class="form-control" required>
                                    <option>Please select status</option>
                                    <option value="1"{{isset($employee) && $employee->status==1?'selected':''}}>Active</option>
                                    <option value="2"{{isset($employee) && $employee->status==2?'selected':''}}>Ex Employee</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <input type="submit" name="cok" value="{{isset($employee)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;" onclick="this.value='Please Wait ...';"     />
                           </div>
                        </div>
                  </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end col -->
   </div>
</div>
@endsection
@push('footer-section-code')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
   //on Subimt button , disable button and text change as updating
   
       function disableButton()
       {
           var btn = document.getElementById('Add_emp_submit');
           btn.disabled = true;
           btn.value = 'Please Wait...'
            //document.getElementById("form1").submit();
          // return true;
       }
       
             function emp_validation()
           {
                 var location =  $("#eloc").val();
                  var fname =  $("#fname").val();
                  //  var mobile =  $("#empmob").val();
                if(location == '')
                {
                   alert('Please enter location');
                   return false;
                }
                 if(fname == '')
                {
                   alert('Please enter Name');
                   return false;
                }
   
           var eduInput = document.getElementsByName('empmob[]');
           for (i=0; i<eduInput.length; i++)
           {
               //alert(eduInput[i].value);
                if (eduInput[i].value == "")
                   {
                    alert('Please Enter Mobile');
                    return false;
                   }
           }
   
   
   
   
             return true;
           }
   
   
        $(document).ready(function(){
   

   
              var x=1;
             $('#emp_cont').click(function(){
                  x++;
                  $('#emp_mob_div').append('<div class="row" id="emp_mob_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="text" id="mob" placeholder="Enter employee\'s contact" class="form-control" name="empmob[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Remove</button></div></div>');
              });
   
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_mob_div'+button_id+'').remove();
               });
   
   
   
   
               var x=1;
             $('#emp_file').click(function(){
                  x++;
                  $('#emp_file_div').append('<div class="row" id="emp_file_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="file" id="dol"  class="form-control" name="empdol[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Row Remove</button></div></div>');
              });
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_file_div'+button_id+'').remove();
               });
   
   
   
           var x=1;
             $('#emp_appointment_latter').click(function(){
                  x++;
                  $('#emp_appointment_latter_div').append('<div class="row" id="emp_appointment_latter_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="file" id="appointment_latter"  class="form-control" name="appointment_latter[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'"> Row Remove</button></div></div>');
              });
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_appointment_latter_div'+button_id+'').remove();
               });
   
                   var x=1;
             $('#emp_dojl').click(function(){
                  x++;
                  $('#emp_dojl_div').append('<div class="row" id="emp_dojl_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="file" id="dojl"  class="form-control" name="dojl[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Row Remove</button></div></div>');
              });
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_dojl_div'+button_id+'').remove();
               });
   
   
                   var x=1;
             $('#emp_adhar').click(function(){
                  x++;
                  $('#emp_adhar_div').append('<div class="row" id="emp_adhar_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="file" id="aadharcard"  class="form-control" name="aadharcard[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Row Remove</button></div></div>');
              });
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_adhar_div'+button_id+'').remove();
               });
   
           var x=1;
             $('#emp_pan').click(function(){
                  x++;
                  $('#emp_pan_div').append('<div class="row" id="emp_pan_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="file" id="pancard"  class="form-control" name="pancard[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Row Remove</button></div></div>');
              });
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_pan_div'+button_id+'').remove();
               });
   
   
           var x=1;
             $('#emp_certificate').click(function(){
                  x++;
                  $('#emp_certificate_div').append('<div class="row" id="emp_certificate_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="file" id="certificate"  class="form-control" name="certificate[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Row Remove</button></div></div>');
              });
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#emp_certificate_div'+button_id+'').remove();
               });
   
   //  For Loop Section Remove
           $(document).on('click', '.emp_dol_section', function(){
              var button_id = $(this).attr("id");
              $('#emp_file_div'+button_id+'').remove();
               });
   
               $(document).on('click', '.emp_appointment_latter_section', function(){
              var button_id = $(this).attr("id");
              alert(button_id);
              $('#emp_appointment_latter_div'+button_id+'').remove();
               });
   
               $(document).on('click', '.emp_pan_section', function(){
              var button_id = $(this).attr("id");
              alert(button_id);
              $('#emp_pan_div'+button_id+'').remove();
               });
   
               $(document).on('click', '.emp_adhar_section', function(){
              var button_id = $(this).attr("id");
              $('#emp_adhar_div'+button_id+'').remove();
               });
   
               $(document).on('click', '.emp_certificate_section', function(){
              var button_id = $(this).attr("id");
              alert(button_id);
              $('#emp_certificate_div'+button_id+'').remove();
               });
   
        });


        //  For find Brand
        function Findbrand() {
    var comp_id = $('#compname').val();
    
    $.ajax({
        method: 'POST',
        url: '{{ url('findbrandname') }}',
        data: {
            comp_id: comp_id,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success === true) {
                $('#empbrand').html(response.html); // Update the HTML of the dropdown with the response
            } else {
                $('#empbrand').html("No Data Found");
               
            }
        },
        error: function(xhr, status, error) {
            swal("Request Failed!", "An error occurred while processing your request.", "error");
        }
    });
}
        
</script>
@endpush