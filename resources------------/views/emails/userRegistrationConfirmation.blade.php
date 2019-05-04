<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="registrationdetails">
<h2>Hello {{$clientuser}}</h2>
<p> Please confirm your email.</p>
    <div>
        <a href="{{ URL::to('register/verify/' . $confirmation_code) }}">Confirm Your Account.</a>.
    </div>
    <p>NB:Please do not reply this email .If you want to activate your account click the above link.</p>
    <div class="registrationinfo">
    <p>Registration Type: {{$registration_type}}</p>
    <p>Email: {{$registration_email}}</p>
    <p>Password: {{$registration_password}}</p>
     </div>
</div>

</body>
</html>
