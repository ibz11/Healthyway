<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify2FA</title>
    <link rel="stylesheet" href="./auth/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
   
<div class="div-center">

<form class="auth-form" action="{{url('verify2FA')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<h1>{{$title}}</h1>

</div>

@if(Session::has('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Type the code sent to your email to login</label>
 
    <input type="text" name="twoFA_input"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
 
  </div>




<div class="mb-3 form-check">
<button type="submit" class="auth-btn btn btn-outline-dark">Verify</button>
</div>

</form>
</div>
 
</body>
</html>