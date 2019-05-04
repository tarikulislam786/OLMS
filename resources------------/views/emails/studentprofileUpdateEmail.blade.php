<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>Your profile updated successfully.</p>
<div class="registrationdetails">
    <h2>Hello {{$fname.' '.$lname.','}}</h2>
    <p> Your profile has been updated.</p>
    <div class="registrationinfo">
      @if(isset($email))
        <p>New Email: {{$email}}</p>
      @endif
          @if(isset($password))
        <p>New Password: {{$password}}</p>
         @endif
    </div>
</div>
</body>
</html>
