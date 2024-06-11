

<html>
<h3>Deadline:- {{$result['deadline_date']}}</h3>
<h3>Detail:- {{$result['task_detail']}}</h3>
<h3>File (click for download):- <a href="{{url('/images/'.$result['task_file'])}}" downlaod>{{$result['task_file']}}</a></h3>
<h5>--- Raizing Group--- </h5>
</html>