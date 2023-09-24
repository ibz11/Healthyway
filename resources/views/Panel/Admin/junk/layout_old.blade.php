<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="Admin/assets/favicon.ico" />
        
        <link href="/Panel/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--Scripts-->
        <!-- Bootstrap core JS-->
        
           <!---Ajax-->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--Alpine js-->
        @vite('resources/js/app.js')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Core theme JS-->
        <script src="/Panel/js/scripts.js"></script>
  
        <style>
        body{
        background-image: linear-gradient(to right,#000428,#004e92);
        }
        </style>
    </head>
    <body>

<div class="d-flex" id="wrapper">
<div class="border-end bg-dark" id="sidebar-wrapper">
<div class="sidebar-heading border-bottom bg-dark text-light"><strong>HealthyWay<i>/ADMIN</i></strong></div>
<div class="list-group bg-dark list-group-flush">
    <a class="list-group-item border-light bg-info text-light list-group-item-action list-group-item-info p-3" href="">Dashboard</a>
    <a class="list-group-item border-light  bg-dark text-light list-group-item-action list-group-item-light p-3" href="">Link1</a>
    <a class="list-group-item border-light  bg-dark text-light list-group-item-action list-group-item-light p-3" href="">Lin2</a>

</div>
</div>
<!-- Page content wrapper-->
<div id="page-content-wrapper">
<!-- Top navigation-->
<!-- 
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Healthyway</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{URL('register')}}">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{URL('login')}}">Login</a>
        </li>
    
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
     
      </ul>
    </div>
  </div>
</nav> -->



<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
<div class="container-fluid">

<button class="btn btn-outline-light" id="sidebarToggle">Sidebar</button>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav ms-auto mt-2 mt-lg-0">

<li class="nav-item active"><a class="nav-link" href="{{URL('redirect')}}">Home</a></li> 
    
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{$data->full_name}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>  
    
</ul>
</div>
</div>
</nav>

<div class="container-fluid">
@yield('content')
</div> 



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script>
    const ctx = document.getElementById('myChart');
    let mydata=[12, 19, 3, 5, 2, 3]
    let deta=[]
    for (let i in mydata){
    deta.push(mydata[i])
    console.log(mydata[i])
    }
    
  
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: deta ,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>