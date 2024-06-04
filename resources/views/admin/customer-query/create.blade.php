
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
                        <div class="card-header"><strong>Customer Query</strong><small> Form</small></div>
                        @if(isset($customer_query))
                        <form action="{{route('customer-query.update',$customer_query->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                            @else
                            <form action="{{route('customer-query.store')}}" method="POST" enctype="multipart/form-data".>
                                @endif
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label class=" form-control-label">Lead Type <span class="require text-danger">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <select class="form-control" id="leadtype" name="leadtype" required>
                                              <option value="" hidden>Please Select</option>
                                              <option {{isset($customer_query)&& $customer_query->leadtype=='Cold Lead'?'selected':''}}>Cold Lead</option>
                                              <option {{isset($customer_query)&& $customer_query->leadtype=='Hot Lead'?'selected':''}}>Hot Lead</option>
                                              <option {{isset($customer_query)&& $customer_query->leadtype=='Warm Lead'?'selected':''}}>Warm Lead</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label for="text-input" class=" form-control-label">Full Name <span class="require text-danger">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <input type="text" id="ct_name" name="ct_name" value="{{isset($customer_query)?$customer_query->leadtype:''}}" placeholder="Full name as per Passport" class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label for="text-input" class=" form-control-label">Company Email <span class="require text-danger">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <input type="text" id="ct_mail" name="ct_mail" value="{{isset($customer_query)?$customer_query->ct_mail:''}}" placeholder="Company email id" class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label for="text-input" class=" form-control-label">Contact No.<span class="require text-danger">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <input type="text" id="ct_mob" name="ct_mob" value="{{isset($customer_query)?$customer_query->ct_mob:''}}" placeholder="Mobile (Whatsapp) Number" class="form-control" required>
                                          <br>
                                          <input type="text" id="ct_phone" name="ct_phone" value="{{isset($customer_query)?$customer_query->ct_phone:''}}" placeholder="Landline Number (optional)" class="form-control">
                                      </div>
                                  </div>
                                  
                                  <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label for="text-input" class=" form-control-label">Passport No.</label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <input type="text" id="ct_passport" name="ct_passport" value="{{isset($customer_query)?$customer_query->ct_passport:''}}" placeholder="Passport Number" class="form-control">
                                      </div>
                                  </div>
                                   <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label for="text-input" class=" form-control-label">Nationality <span class="require text-danger">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <input type="text" id="nationality" name="nationality" value="{{isset($customer_query)?$customer_query->nationality:''}}" placeholder="Enter Nationality" class="form-control" required>
                                      </div>
                                  </div>
                                  
                                  <hr style="margin-top: 20px;">
                                  
                                  <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label class=" form-control-label">Reference Through</label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <select class="form-control" id="reference_through"  name="reference_through">
                                              <option value="" hidden>Please Select</option>
                                              <option {{isset($customer_query)&& $customer_query->reference_through=='Friends'?'selected':''}}>Friends</option>
                                              <option {{isset($customer_query)&& $customer_query->reference_through=='Social Media'?'selected':''}}>Social Media</option>
                                              <option {{isset($customer_query)&& $customer_query->reference_through=='Channel Partner'?'selected':''}}>Channel Partner</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row form-group mb-4">
                                      <div class="col col-md-3">
                                          <label class=" form-control-label">Profession</label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <select class="form-control" id="profession" name="profession">
                                              <option value="" hidden>Please Select</option>
                                              <option {{isset($customer_query)&& $customer_query->profession=='Businuss'?'selected':''}}>Businuss</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group mb-4">
                                      <label for="address" class="form-control-label">Address</label>
                                      <textarea name="address" id="address" rows="2" placeholder="Enter Your Address" class="form-control">{{isset($customer_query)?$customer_query->address:''}}</textarea>
                                  </div>
                                  <div class="form-group mb-4">
                                      <label for="query_details" class="form-control-label">Enquiry Detail</label>
                                      <textarea name="query_details" id="query_details" rows="5" placeholder="Enter Enquiry Detail..." class="form-control">{{isset($customer_query)?$customer_query->query_details:''}}</textarea>
                                  </div>
                                  <div class="form-group mb-4">
                                    <input type="submit" name="cok" value="{{isset($customer_query)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"   />
                                     
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
   $(document).ready(function(){
          var i=1;
          $('#add_more_brand').click(function(){
               i++;
               $('#brand_add_row').append('<div class="row" id="brand_add_row'+i+'" style="margin-top:5px;"><div class="col-lg-10"><input type="text" id="brand" name="cbrand[]" placeholder="Enter company\'s brand name" class="form-control"></div><div class="col-lg-2"><img src="images/cross.png" alt="" id="'+i+'" width="37" class="btn_remove"></div></div>');
           });
           $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#brand_add_row'+button_id+'').remove();
            });


           var x=1;
          $('#brand_mail').click(function(){
               x++;
               $('#brand_detail_more').append('<div class="row" id="brand_detail_more'+x+'" style="margin-top:5px;"><div class="col-lg-5"><input type="email" name="bemail[]" id="bemail" placeholder="Provide Email" class="form-control"></div><div class="col-lg-5"><input type="number" name="bmob[]" id="bmob" placeholder="Provide Mobile" class="form-control"></div><div class="col-lg-2"><button class="btn btn-danger btn_remove1" id="'+x+'">-Remove</button></div></div>');
           });
           $(document).on('click', '.btn_remove1', function(){
           var button_id1 = $(this).attr("id");
           $('#brand_detail_more'+button_id1+'').remove();
            });

            $(document).on('click', '.btn_removeloop', function(){
           var button_id_loop = $(this).attr("id");
           $('#brand_detail_more_loop'+button_id_loop+'').remove();
            });


            var y=1;
          $('#div_detail').click(function(){
               y++;
               $('#add_div_detail').append('<div class="row" id="add_div_detail'+y+'" style="margin-top:5px;"><div class="col-lg-3"><input type="text" name="bdivision[]" placeholder="Division\'s Name" class="form-control"></div><div class="col-lg-3"><input type="email" name="div_mail[]" placeholder="Division\'s Email" class="form-control"></div><div class="col-lg-3"><input type="number" name="div_mob[]" placeholder="Division\'s Contact" class="form-control"></div><div class="col-lg-3"><button class="btn btn-danger btn_remove2"  id="'+y+'">-Remove</button></div></div>');
           });
           $(document).on('click', '.btn_remove2', function(){
           var button_id2 = $(this).attr("id");
           $('#add_div_detail'+button_id2+'').remove();
            });
            $(document).on('click', '.btn_remove_loop', function(){
           var btn_remove_loop = $(this).attr("id");
           $('#add_div_detail_loop'+btn_remove_loop+'').remove();
            });
     });
    </script>
@endpush
