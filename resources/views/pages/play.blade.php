<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Play</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="pull-left mb-2">
</div>
    <div class="row">
        <a  class="btn btn-danger"  href="/deactivate/{{$date['id_url']}}/{{$date['id']}}">Deactivate</a>
    </div>
    <br>
    <div class="row">
        <a  class="btn btn-info"  href="/create/{{$date['id']}}/{{$date['id']}}">Create Another Link</a>
        <br>
    </div>
    <br>
    <div class="row">
        <form action=" {!! url('register') !!}" method="GET">
        <a  class="btn btn-info"  href="/lucky/{{$date['id']}}/{{$date['id_url']}}">Im feeling lucky button</a>
        <br>
        <br>
        @if(!empty($res))
            <p>Number: {{$res['rand']}}</p>
            <p>Amount: {{$res['amount']}}</p>
            <p>Result: {{$res['res']}}</p>

        @endif
    </div>
    <br>
    <div class="row">
        <a  class="btn btn-info"  href="/history/{{$date['id']}}/{{$date['id_url']}}">History</a>
    </div>
    <br>
    <br><br>
    <div class="row">
    <a  class="btn btn-info"  href="/back/{{$date['id']}}/{{$date['id']}}">Back</a>
    </div>
</div>
</body>
</html>