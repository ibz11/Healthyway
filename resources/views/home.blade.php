<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthyWay</title>

    <link href="/Home/style.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Scripts -->
        
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
</head>
<body>

 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  @if(Auth::check())
    <a class="navbar-brand"href="{{ URL('redirect') }}">HealthyWay</a>
    @else
    <a class="navbar-brand"href="{{ URL('/') }}">HealthyWay</a>
    @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li> -->
       </ul>
       @if (Route::has('login'))
    @auth
             
      <span class="navbar-text">
      @else
      <a class="btn btn-outline-dark m-1 ml-1 " href="{{ route('login') }}">Login</a>
      @if (Route::has('register'))
      <a class="btn btn-outline-dark m-1 me-3" href="{{ route('register') }}">Register</a>
      </span>
      @endif
      @endauth

@endif
    </div>
  </div>
</nav>
<div class="hero-image">
  <div class="hero-text">
    <h1>HealthyWay</h1>
    <p>A healthier you</p>

    @if(auth()->check())
      <a class="btn btn-outline-light m-1  " href="{{ URL('dashboard') }}">Dashboard</a>

      @else
    
      <a class="btn btn-outline-light m-1  " href="{{ URL('login') }}">Login Page</a>
      <a class="btn btn-outline-light m-1  " href="{{ URL('register') }}">Register Page</a>
      @endif
   
  </div>
</div>

</body>
</html>

