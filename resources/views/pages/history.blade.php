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
    <h2>History</h2>
</div>
    <div class="row">
        @if(!empty($history))
        <table border ='1'>
            <th>Number</th>
            <th>Result</th>
            <th>Amount</th>
        @foreach($history AS $h)
        <tr>
        <td>{{$h->rand}}</td>
            <td>{{$h->result}}</td>
            <td>{{$h->amount}}</td>
           
        </tr>
        @endforeach
        </table>
        @endif
    </div>
    <br>
    <button onclick=" history.back();">Go Back</button>
</div>
</body>
</html>