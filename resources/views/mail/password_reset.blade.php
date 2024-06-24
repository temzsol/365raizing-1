<html>
    <p>Hello {{$result->name}}</p>
    <h3>Message:-you want to reset your password  plese click on below button for password rest.</h3>
    <a href="{{ route('reserform', ['token' => $result->remember_token]) }}" style="width:20px; height:20px; border-radius: 5px;; background-color:light-green color:whight">Reset Password</a>
    <h5>--- Raizing Group---</h5>
    </html>