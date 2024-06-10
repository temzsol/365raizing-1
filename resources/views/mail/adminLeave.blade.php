
@if($result['approve_status']==1)

<html>
    <p>Hello Admin {{$result->fname}}</p>
    <h3>Message:- Your Leave is: Approved</h3>
    <h5>--- Raizing Group---</h5>
    </html>
@endif



@if($result['approve_status']==0)

<html>
    <p>Hello Admin {{$result->fname}}</p>
    <h3>Message:- Your Leave is: Rejected</h3>
    <h5>--- Raizing Group---</h5>
    </html>
@endif