<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
    
    <link rel="stylesheet" href="./auth/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>
  
.div-center{
    display: flex;
    justify-content:center;
    margin: 2em;
    text-align: center;
}
.auth-grid{
    display: grid;
    grid-template-columns: auto;
    border: 1px solid orange;
    padding:2em;
    width:20%;
}
.auth-form{
width:28em;
/* background: #0f0c29; */
 
  border: 1px solid black;
  border-radius: .3em;
  padding:2em;
}
.auth-btn{
 
    width:100%;
}


.link{
    color:black;
}
.link:hover{
    color:gray;

}
</style>





  </head>
<body>
   
<div class="div-center">

<form class="auth-form" action="{{url('resetpassword',$token)}}" method="POST" enctype="multipart/form-data">
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

 <input type="hidden" readonly name="token" value="{{ $token }}">
 <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('email') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>


  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('password') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text">Passwords must have atleast 1 special character , 1 uppercase letter and a minimum of 8 characters</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('confirm_password') {{$message}} @enderror</strong></div>
  </div>




<div class="mb-3 form-check">
<button type="submit" class="auth-btn btn btn-outline-dark">Submit</button>
</div>

</form>
</div>
 
</body>
</html>