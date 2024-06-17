

<html>
<h3>Task Name:- {{$result->t_title}}</h3>
<h3>Deadline:- {{$result->deadline}}</h3>
<h3>Assign Date:- {{$result->assign_date}}</h3>
<h3>Detail:- {{$result->t_detail}}</h3>
<h3>File (click for download):- <a href="{{url('/images/'.$result->t_file)}}" downlaod> Click Me </a></h3>
<h5>--- Raizing Group--- </h5>
</html>