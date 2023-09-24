@include('auth/template')



<div class="div-center">

<form class="auth-form" action="{{URL('loginUser')}}" method="POST" enctype="multipart/form-data">
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
    <label for="exampleInputEmail1" class="form-label">Email address</label>
 
    <input type="email" name="email"class="form-control" id="exampleInputEmail1" value="{{old('email')}}"aria-describedby="emailHelp">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('email') {{$message}} @enderror</strong></div>
    <div id="emailHelp" class="form-text"></div>
  </div>

 

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" value="{{old('password')}}" class="form-control" id="exampleInputPassword1">
    <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('password') {{$message}} @enderror</strong></div>
  </div>

<div class="mb-3"> 
 <label class="form-check-label" for="exampleCheck1">No account? <a class="link" href="{{ url ('register') }}">Register here</a></label>
</div>   

<div class="mb-3">
<label class="form-check-label" for="exampleCheck1"><a class="link" href="{{ url ('forgotpassword') }}">Forgot password</a></label>  
</div>


<div class="mb-3 form-check">
<button type="submit" class="auth-btn btn btn-outline-dark">Submit</button>
</div>

</form>
</div>






@include('auth/footer')


