<!DOCTYPE html>
<html>
<head>
 <title>Laravel 8 Send Email Example</title>
</head>
<body>
 
 <h3>Your account has been created</h3>
 <p>Username : {{$userdata->email}}</p>
 <p>Password : {{Crypt::decryptString($userdata->password)}}</p>
 
</body>
</html> 