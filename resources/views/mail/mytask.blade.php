@php
  $brand_name =  \App\Models\Brand::find($result->brand);
@endphp
<html><h3>Brand:- {{$brand_name->bname}} </h3>
<h3>Task Title:- {{$result->t_title}} </h3>
<h3>Deadline:- {{$result->deadline}}</h3>
<h3>Detail:- {{$result->t_detail}}</h3>
<h3>File (click for download):- <a href="{{url('/images/'.$result->t_file)}}" downlaod>{{$result->t_file}}</a></h3></html>