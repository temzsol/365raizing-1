
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
                        <div class="card-header"><strong>Brand</strong><small> Form</small></div>
                        @if(isset($brand))
                        <form action="{{route('brands.update',$brand->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                            @else
                      <form action="{{route('brands.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                          <div class="card-body card-block">
                            <div class="form-group mb-4">
                                <label for="brand" class=" form-control-label">Company</label>
                                <div id="brand_add_row" class="mb-4">
                                    <div class="row">
                                        <div class="col-lg-10">
                                              <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" readonly value="{{$company->compname}}">
                                                    <input type="hidden" name="bcomp" class="form-control" readonly value="{{$company->id}}">
                                        </div>
                                        </div>
                 
                                    </div>
                                </div>
                            </div>
							<div class="form-group mb-4">
                                <label for="brand" class=" form-control-label">Brand<span class="text-danger">*</span></label>
                                <div id="brand_add_row">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <input type="text" id="bname" name="bname" value="{{isset($brand)?$brand->bname:''}}" placeholder="Enter company's brand name" class="form-control"required>
                                        </div>
                 
                                    </div>
                                </div>
                            </div>

							

                            @if(isset($brand))
                            {{-- Thid Code For Update Section --}}
                            <div class="form-group mb-4">
                                <label for="bemail" class="form-control-label">Brand's Email & Mobile<span class="text-danger">*</span></label>
                                <div class="row">
                                    @php
                                        $loopemail = explode(',', $brand->bemail);  
                                        $loopmob = explode(',', $brand->bmob); 
                                        // print_r($loopemail); die();
                                    @endphp
                                    @foreach($loopemail as $key=>$value)
                                    <div id="brand_detail_more_loop{{$key}}">
                                            <div class="row mb-4">
                                                <div class="col-lg-5">
                                                    <input type="email" name="bemail[]" id="bemail_{{ $key }}" value="{{ $value }}" placeholder="Provide Email" class="form-control" required>
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="number" name="bmob[]" id="bmob_{{ $key }}" value="{{ $loopmob[$key] }}" placeholder="Provide Mobile" class="form-control" required oninput="this.value = this.value.slice(0, 10);">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-danger btn_removeloop" id="{{ $key }}">-Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div id="brand_detail_more"></div>
                                    
                                    
                                </div>
                                <button type="button" class="btn btn-success mt-4" id="brand_mail">+Add</button>
                            </div>
                            {{-- Thid Code For Update Section End --}}
                            @else

                            <div class="form-group mb-4">
                                <label for="bemail" class="form-control-label">Brand's Email & Mobile<span class="text-danger">*</span></label>
                                <div id="brand_detail_more">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="email" name="bemail[]" id="bemail" placeholder="Provide Email" class="form-control" required>
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="number" name="bmob[]" id="bmob" placeholder="Provide Mobile" class="form-control" required pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==10) return false;" >
                                            
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-success" id="brand_mail">+Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="bstreet" class=" form-control-label">Street</label>
                                            <input type="text" name="bstreet" id="bstreet" value="{{isset($brand->bstreet)?$brand->bstreet:''}}" placeholder="Enter street name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="bcity" class=" form-control-label">City</label>
                                            <input type="text" name="bcity" id="bcity" value="{{isset($brand)?$brand->bcity:''}}" placeholder="Enter your city" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="bcode" class=" form-control-label">Postal Code</label>
                                            <input type="text" name="bcode" id="bcode" value="{{isset($brand->bcode)?$brand->bcode:''}}" placeholder="Postal Code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="bcountry" class="form-control-label">Country<span class="text-danger">*</span></label>
                                            <input type="text" name="bcountry" id="bcountry" value="{{isset($brand->bcountry)?$brand->bcountry:''}}" placeholder="Country name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr style="border-bottom: 1px solid grey;">
                            <div class="form-group mb-4">
                                <label for="division" class=" form-control-label">Add Division Details</label>
                                @if(isset($brand))

                                @php
                                    $bdivision = explode(',', $brand->bdivision);  
                                    $div_mail = explode(',', $brand->div_mail); 
                                    $div_mob = explode(',', $brand->div_mob); 
                                    // print_r($loopemail); die();
                                @endphp
                                @foreach($bdivision as $key=>$value)
                                <div id="add_div_detail_loop{{$key}}">
                                    <div class="row mt-4">
                                         <div class="col-lg-3">
                                            <input type="text" id= "bdivision_{{$key}}" name="bdivision[]" value="{{$value}}" placeholder="Division's Name" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="email" id= "div_mail_{{$key}}" name="div_mail[]" value="{{$div_mail[$key]}}" placeholder="Division's Email" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="number" id= "div_mob_{{$key}}" name="div_mob[]" value="{{$div_mob[$key]}}" placeholder="Division's Contact" class="form-control" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==10) return false;" >
                                            
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn-danger btn_remove_loop" id="{{$key}}">-Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div id="add_div_detail"></div>
                                <button type="button" class="btn btn-success mt-4" id="div_detail">+Add</button>
                                @else
                                <div id="add_div_detail">
                                    <div class="row">
                                         <div class="col-lg-3">
                                            <input type="text" id= "bdivision" name="bdivision[]" placeholder="Division's Name" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="email" id= "div_mail" name="div_mail[]" placeholder="Division's Email" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="number" id= "div_mob" name="div_mob[]" placeholder="Division's Contact" class="form-control" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==10) return false;" >
                                            
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-success" id="div_detail">+Add</button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <input type="submit" name="brandok" value="{{isset($brand)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_brand_submit"style="margin-top: 15px; border-radius: 6px; width: 130px;" />
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
