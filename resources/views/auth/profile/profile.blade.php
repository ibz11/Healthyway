<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://apis.google.com"> -->
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/auth/style.css">
    @vite('resources/js/app.js')
</head>
<body >
<!-- style="background:linear-gradient(to right #0f0c29,#302b63,#24243e); -->
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{URL('dashboard')}}">Healthyway</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{URL('dashboard')}}">Dashboard</a>
        </li>

        
     
      </ul>
    </div>
  </div>
</nav>


<div class="div-center">


<div class="auth-form">

@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif
<h1>{{$title}}</h1>
<div style="display:grid;grid-template-columns:auto auto; gap:.3em;">
 <div style="background:white;border-radius:.3em;border:1px solid black;"><strong>Full Names</strong></div> 
 <div style="background:whitesmoke;border-radius:.3em;border:1px solid black;"><strong>{{$userdata->full_name}}</strong></div> 

 <div style="background:whitesmoke;border-radius:.3em;border:1px solid black;"><strong>Email</strong></div> 
 <div style="background:whitesmoke;border-radius:.3em;border:1px solid black;"><strong>{{$userdata->email}}</strong></div> 

 <div style="background:whitesmoke;border-radius:.3em;border:1px solid black;"><strong>Phone</strong></div> 
 <div style="background:whitesmoke;border-radius:.3em;border:1px solid black;"><strong>{{$userdata->phone}}</strong></div> 

 <div style="background:whitesmoke;border-radius:.3em;border:1px solid black;"><strong>Role</strong></div> 
 <div style="background:whitesmoke;border-radius:.3em;padding:.1em;border:1px solid black;"><span class="badge bg-info"><strong>{{$userdata->role}}</strong></span></div> 


</div>
</div>

</div>

<!-- 
<div class="div-center">
<div class="auth-form">


<h1>Two-Factor Authentication</h1>
<div style="display:grid;grid-template-columns:auto auto; gap:.1em;">


<div ><a href="{{URL('enable2FA',$userdata->id)}}"class="btn btn-outline-success"><strong>Enable</strong></a></div> 
 <div ><a href="{{URL('disable2FA',$userdata->id)}}"class="btn btn-outline-danger"><strong>Disable</strong></a></div> 
 





</div>
</div> -->

</div>




<div class="div-center">

<form class="auth-form" action="{{URL('profile',$userdata->id)}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<h1>Update your details here</h1>
</div>

@if(Session::has('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif


 <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Full Name</label>
    <input type="text" name="full_name" value="{{$userdata->full_name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('full_name') {{$message}} @enderror</strong></div>
    <!-- {{$userpwd}} -->
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
 
    <input type="email" name="email"class="form-control" id="exampleInputEmail1" value="{{$userdata->email}}"aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('email') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text"></div>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
    <input type="text" value="{{$userdata->phone}}"name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('phone') {{$message}} @enderror</strong></div>
   
  </div>
 
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password"  value="{{old('password')}}"class="form-control" id="exampleInputPassword1">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('password') {{$message}} @enderror</strong></div>
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






@include('auth/footer')


