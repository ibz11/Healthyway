@include('auth/template')


<!-- <div class="div-center">

<div class="auth-grid">
<div class="auth-grid-item">

</div>

<div class="auth-grid-item">
<input class="form-input" type="text" placeholder="name">
</div>

</div>


</div> -->

<div class="div-center">
 

<form class="auth-form" action="{{URL('registerUser')}}" method="POST" enctype="multipart/form-data">
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
    <label for="exampleInputEmail1" class="form-label">Full Name</label>
    <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('full_name') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text">We'll never share your Full names with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('email') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('phone') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text">We'll never share your phone number with anyone else.</div>
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
  <div class="mb-2 form-check">

    <label class="form-check-label" for="exampleCheck1">Already registered? <a class="link" href="{{ url ('login') }}">Login here</a></label>
  </div>
  <div class="mb-3 form-check">
  <button type="submit" class="auth-btn btn btn-outline-dark">Submit</button>
  </div>
</form>
</div>





@include('auth/footer')
