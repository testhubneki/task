<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script>


</script>
</head>
<body>
<div class="container mt-2">
<div class="pull-left mb-2">
@if(!empty($user))
    <p>Welcome {{$user[0]->username}}</p>
@endif

 <p>Click to link below to continue</p>
  @foreach($url AS $u)
  <br>
  <a href='/play/{{$user[0]->id}}/{{$u->id}}'>{{$u->unique_link}}</a>
  @endforeach
</div>
</div>

</body>
</html>