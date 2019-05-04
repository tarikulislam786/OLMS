<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Welcome!</h2>

<div class="contact mails">
    <table border="1" width="100%">
        <tr><td width="120px"> Mail From </td><td  width="100px"> {{env('MAIL_FROM')}} </td></tr>
        <tr><td> Username </td><td style="color:red"> {{$fullname}} </td></tr>
        <tr><td> User Email </td><td> {{$email}}</td></tr>
        <tr><td> Message </td><td>{{$comment}}</td></tr>
    </table>
</div>
</body>
</html>