<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="pull-left mb-2">
<h2>Register</h2>
</div>
    <div class="row">
    <form action=" {!! url('register') !!}" method="GET">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" value="{{ old('username') }}" name="username" id="username" aria-describedby="username" placeholder="Enter username">
            @error('username')
            <p>{{$message}}</p>
             @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number') }}" name ="phone_number" placeholder="Enter phone number">
            @error('phone_number')
            <p>{{$message}}</p>
             @enderror
        </div>
      
        <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
</body>
</html>