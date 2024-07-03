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
                  <div class="card-header"><strong>Vendor</strong><small> Form</small></div>
                  @if(isset($vendor))
                  <form action="{{route('vendor.update',$vendor->id)}}" method="post" enctype="multipart/form-data">
                     @method('PUT')
                     @else
                  <form  method="post" enctype="multipart/form-data" action="{{route('vendor.store')}}" id="form1" >
                     @endif
                     @csrf
                     <div class="card-body card-block">
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label for="fname" class="form-control-label">Vendor Name <span style="color:red;">*</span></label>
                                 <input type="text" id="fname" placeholder="Enter vendor's name" class="form-control" name="fname" value="{{isset($vendor)?$vendor->fname:''}}" required>
                              </div>
                              <div class="col-lg-4">
                                 <label for="vbrand" class=" form-control-label">Brand <span style="color:red;">*</span></label>
                                 <select name="vbrand" id="vbrand" class="form-control" required>
                                    <option value="">Please select brand</option>
                                    @foreach($brand as $value)
                                    <option value="{{$value->id}}" @if(isset($vendor)){{$value->id==$vendor->vbrand?'selected':''}}@endif>{{$value->bname}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-lg-4 mb-4">
                                 <label for="vgstin" class="form-control-label">Tax Number <span style="color:red;">*</span> </label>
                                 <input type="text" id="vgstin" placeholder="Enter vendor's tax number" class="form-control" name="vgstin" value="{{isset($vendor)?$vendor->vgstin:''}}" required>
                              </div>
                              <div class="col-lg-4 mb-4">
                                 <label for="vcountry" class="form-control-label">Country <span style="color:red;">*</span></label>
                                 <input type="text" id="vcountry" placeholder="Country name" class="form-control" name="vcountry" value="{{isset($vendor)?$vendor->vcountry:''}}" required>
                              </div>
                              <div class="col-lg-4 mb-4">
                                 <label for="vstreet" class="form-control-label">Street <span style="color:red;">*</span></label>
                                 <input type="text" id="vstreet" placeholder="Enter vendor's street" class="form-control" name="vstreet" value="{{isset($vendor)?$vendor->vstreet:''}}" required>
                              </div>
                              <div class="col-lg-4 mb-4">
                                 <label for="vcity" class="form-control-label">City <span style="color:red;">*</span></label>
                                 <input type="text" id="vcity" placeholder="Enter vendor's city" class="form-control" name="vcity" value="{{isset($vendor)?$vendor->vcity:''}}" required>
                              </div>
                              <div class="col-lg-4 mb-4">
                                 <label for="vcode" class="form-control-label">Postal Code <span style="color:red;">*</span></label>
                                 <input type="text" id="vcode" placeholder="Postal Code" class="form-control" name="vcode" value="{{isset($vendor)?$vendor->vcode:''}}" required>
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                              <div class="col-lg-4">
                                 <label for="mob" class=" form-control-label">Vendor Email <span style="color:red;">*</span></label>
                                 {{-- if mobile number more then one --}}
                                 @if(isset($vendor))
                                 @php
                                 $vemail = explode(',', $vendor->vemail); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 @foreach($vemail as $key=>$value)
                                 <div class="row" id="ven_email_div{{$key}}" style="margin-top:5px; margin-bottom: 10px;">
                                    <div class="col-lg-8 mt-4">
                                       <input type="text" id="vemail" placeholder="Enter vendor's email" class="form-control" name="vemail[]" value="{{$value}}">
                                    </div>
                                    <div class="col-lg-2 mt-4">
                                       <button type="button" class="btn btn-danger btn_remove1" id="{{$key}}">Remove</button>
                                    </div>
                                 </div>
                                 @endforeach
                                 <div id="ven_email_div"></div>
                                 <div class="col-lg-2 mt-4">
                                    <button type="button" class="btn btn-success" id="emp_cont">+Add</button>
                                 </div>
                                 @else
                                 <div id="ven_email_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="text" id="vemail" placeholder="Enter vendor's email" class="form-control" name="vemail[]" required>
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_cont">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Vendor Contact<span class="text-danger">*</span></label>
                                 @if(isset($vendor))
                                 @php
                                 $vconts = explode(',', $vendor->vcont); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 @foreach($vconts as $key=>$value)
                                 <div class="row" id="ven_con_div{{$key}}" style="margin-top:5px; margin-bottom: 10px; display: inline;">
                                    <div class="row">
                                    <div class="col-lg-8 mt-4" >
                                       @if(!empty($value))
                                       <input type="text" id="vcont" class="form-control" value="{{$value}}" name="vcont[]"placeholder="Enter vendor's contact" required>
                                       @endif
                                    </div>
                                    <div class="col-lg-2 mt-4">
                                       <button type="button" class="btn btn-danger btn_ven_contact" id="{{$key}}">Remove</buttontype="button">
                                       
                                    </div>
                                 </div>
                              </div>
                                 @endforeach
                                 <div id="ven_con_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="vendor_contact">+Add</button>
                                    
                                 </div>
                                 @else
                                 <div id="ven_con_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                        <input type="text" id="vcont" class="form-control" name="vcont[]"placeholder="Enter vendor's contact">
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="vendor_contact">+Add</button>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <div class="col-lg-4">
                                 <label class="form-control-label">Services</label>
                                 {{-- new code --}}
                                 @if(isset($vendor))
                                 @php
                                 $vservices = explode(',', $vendor->vservice); 
                                 // print_r($loopemail); die();
                                 @endphp
                                 @foreach($vservices as $key=>$value)
                                 <div class="row" id="ven_service_div{{$key}}" style="margin-top:5px; margin-bottom: 10px; display: inline;">
                                    <div class="row">
                                    <div class="col-lg-8 mt-4" >
                                       @if(!empty($value))
                                       <input type="text" id="vservice" class="form-control" value="{{$value}}" name="vservice[]" placeholder="Enter vendor's services"> 
                                       @endif
                                    </div>
                                    <div class="col-lg-2 mt-4">
                                       <buttontype="button" class="btn btn-danger service_button" id="{{$key}}">Remove</buttontype="button">
                                    </div>
                                 </div>
                                    </div>
                                 @endforeach
                                 <div id="ven_service_div"></div>
                                 <div class="col-lg-2 mt-4" style="display: inline;">
                                    <button type="button" class="btn btn-success" id="emp_appointment_latter">+Add</button>
                                  
                                 </div>
                                 @else
                                 <div id="ven_service_div">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <input type="text" id="vservice" class="form-control" name="vservice[]" placeholder="Enter vendor's services">
                                       </div>
                                       <div class="col-lg-2">
                                          <button type="button" class="btn btn-success" id="emp_appointment_latter">+Add</button>
                                         
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                                 {{-- New Code End --}}
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-4">
                           <div class="row">
                           </div>
                           <div class="row">
                              <div class="col-lg-4 mt-4">
                                 <label for="ucomp" class=" form-control-label">Status<span style="color:red;">*</span> </label>
                                 <select name="status" class="form-control" required>
                                    <option>Please select status</option>
                                    <option value="1"{{isset($vendor) && $vendor->status==1?'selected':''}}>Active</option>
                                    <option value="2"{{isset($vendor) && $vendor->status==2?'selected':''}}>Inactive</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <input type="submit" name="cok" value="{{isset($vendor)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;" onclick="this.value='Please Wait ...';"     />
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