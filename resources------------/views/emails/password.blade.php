<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Hello {{$user['name']}}</h2>

<div>
    Click here to reset your password: <a href="{{ URL::to('password/reset/' . $token) }}">Password Reset</a>.
</div>

</body>
</html>
