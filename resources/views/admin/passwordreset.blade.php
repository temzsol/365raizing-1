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
                  <div class="card-header"><strong>Password Reset</strong><small> Form</small>
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                </div>
                  <form action="{{route('passwordReset')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body card-block">
                        <div class="form-group mb-4">
                           <div class="row">
                            <div class="col-lg-6">
                                <label for="email" class="form-control-label">User Email<span style="color:red;">*</span></label>
                                <input type="text" id="email"readonly class="form-control" name="email" value="{{$authresult[0]->email}}">
                                <input type="hidden" readonly class="form-control" name="id" value="{{$authresult[0]->id}}">
                             </div>               
                              <div class="col-lg-6">
                                 <label for="vgstin" class="form-control-label">New Password<span style="color:red;">*</span> </label>
                                 <input type="text" id="vgstin" placeholder="New password" class="form-control" name="n_password"  required>
                              </div>
                              <div class="col-lg-6 mt-4">
                                 <label for="vcont" class="form-control-label">Confirm Password <span style="color:red;">*</span></label>
                                 <input type="text" id="vcont" placeholder="Confirm" class="form-control" name="c_password" required>
                              </div>
                              </div>
                            <button class="btn btn-primary mt-4">Update</button>
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
                  //  var mobile =  $("#vemail").val();
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
   
           var eduInput = document.getElementsByName('vemail[]');
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
   
           //   var i=1;
           //   $('#emp_mail').click(function(){
           //        i++;
           //        $('#emp_email_div').append('<div class="row" id="emp_email_div'+i+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-10"><input type="mail" id="uemail" placeholder="Enter employee\'s email" class="form-control" name="empemail[]"></div><div class="col-lg-2"><img src="images/cross.png" alt="" id="'+i+'" class="btn_remove" width="25"></div></div>');
           //    });
   
           //    $(document).on('click', '.btn_remove', function(){
           //    var button_id = $(this).attr("id");
           //    $('#emp_email_div'+button_id+'').remove();
           //     });
   
   
        //    New Code 
              var x=1;
             $('#emp_cont').click(function(){
                  x++;
                  $('#ven_email_div').append('<div class="row" id="ven_email_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="text" id="mob" placeholder="Enter vendor\'s email" class="form-control" name="vemail[]"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_remove1" id="'+x+'">Remove</button></div></div>');
              });
   
              $(document).on('click', '.btn_remove1', function(){
              var button_id = $(this).attr("id");
              $('#ven_email_div'+button_id+'').remove();
               });
   
               var x=1;
             $('#vendor_contact').click(function(){
                  x++;
                  $('#ven_con_div').append('<div class="row" id="ven_con_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="text" id="vcont"  class="form-control" name="vcont[]" placeholder="Enter vendor\'s contact"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger btn_ven_contact" id="'+x+'">Remove</button></div></div>');
              });
              $(document).on('click', '.btn_ven_contact', function(){
              var button_id = $(this).attr("id");
              $('#ven_con_div'+button_id+'').remove();
               });

               var x=1;
             $('#emp_appointment_latter').click(function(){
                  x++;
                  $('#ven_service_div').append('<div class="row" id="ven_service_div'+x+'" style="margin-top:5px; margin-bottom: 10px;"><div class="col-lg-8 mt-4"><input type="text" id="vservice"  class="form-control" name="appointment_latter[]"placeholder="Enter vendor\'s services"></div><div class="col-lg-2 mt-4"><buttontype="button" class="btn btn-danger service_button" id="'+x+'">Remove</button></div></div>');
              });
              $(document).on('click', '.service_button', function(){
              var button_id = $(this).attr("id");
              $('#ven_service_div'+button_id+'').remove();
               });
   //    New Code End 

   
   //  For Loop Section Remove
           $(document).on('click', '.emp_dol_section', function(){
              var button_id = $(this).attr("id");
              $('#ven_con_div'+button_id+'').remove();
               });
   
               $(document).on('click', '.emp_appointment_latter_section', function(){
              var button_id = $(this).attr("id");
              alert(button_id);
              $('#ven_service_div'+button_id+'').remove();
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
        
</script>
@endpush