<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="Admin/assets/favicon.ico" />
        <link rel="stylesheet" href="style.css">
        <link href="/Dashboard/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--Scripts-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
           <!---Ajax-->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--Alpine js-->

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Core theme JS-->
        <script src="/Admin/js/scripts.js"></script>
  
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
<div class="container-fluid">
<button class="btn btn-outline-light" id="sidebarToggle">Sidebar</button>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav ms-auto mt-2 mt-lg-0">

<li class="nav-item active"><a class="nav-link" href="{{URL('redirect')}}">Home</a></li> 
    
    
    
</ul>
</div>
</div>
</nav>


@yield('content')

                 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>