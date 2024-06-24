

<html>
<h3>Reporter Name:- {{$result->reporter_name}}</h3>
<h3>Assignee name:- {{$result->assignee_name}}</h3>
<h3>Task Name:- {{$result->t_title}}</h3>
<h3>Deadline:- {{$result->deadline}}</h3>
<h3>Assign Date:- {{$result->assign_date}}</h3>
<h3>Detail:- {{$result->t_detail}}</h3>
@if(!empty($result->t_file))
<h3>File (click for download):- <a href="{{url('/images/'.$result->t_file)}}" downlaod>Download</a></h3>
@endif
<a href="{{route('employeetaskview')}}"><button>View Task</button></a>
<h5>--- Raizing Group--- </h5>
</html>