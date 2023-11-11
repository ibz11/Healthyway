<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HeathyWay/Therapist</title>

    <!-- Custom fonts for this template-->
    <link href="/adminpanel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- {{ asset('css/style.css') }} -->
    <link href=" {{ asset('/adminpanel/css/sb-admin-2.min.css')}}" rel="stylesheet">

       <!-- J query -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 
    @vite('resources/js/app.js')
    <!-- <link href="/Panel/css/styles.css" rel="stylesheet" /> -->
    <style>
    .expertform{
color:white;
background:linear-gradient(to right,#141E30,#243B55);
border-radius:.4em;
width:fit-content;
height: fit-content;
padding: 2em;
margin:0em;
 }

 .container-form{
    display:flex;
    justify-content:center;
    align-items:center;
 }

 .container2{
    display: flex; 
    /* border:2px solid white; */
    flex-direction:row; 
    
}
  @media only screen and (max-width: 800px){ 
.containerform{
    transform: scale(.7); 
}
.expertform{
    
width:auto;
overflow-x: auto; 
  /* transform: scale(1); */
  transform: scale(1); 
  /* background:blue; */
}
/* .expertform div{
 
    width:auto;
    transform: scale(1);  
} */
.container-form{
   margin:0;
   padding:0;
  
}
.container2{
    transform: scale(1); 
     
}
}
  </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                
                <div class="sidebar-brand-text mx-3">HealthyWay/Therapist</div>
            </a>
            <!-- <sup>2</sup> -->
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{URL('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Navigation
            </div>

    
   
            <li class="nav-item">
                <a class="nav-link" href="{{URL('therapistprofile')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>My Therapist Profile</span></a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="{{URL('timeslotspage')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Timeslots</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{URL('myclients')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Student's applications </span>
                    @if($newclient<=0)
                    @else
                    <span class="badge bg-danger">{{$newclient}}</span>
                    @endif
                
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{URL('studentprogress')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Students Progress</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{URL('therapistnotifications')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Notifications </span>
                    @if($notcount<=0)
                    @else
                    <span class="badge bg-danger">{{ $notcount }}</span>
                @endif
                </a>
            </li>
      

            <li class="nav-item">
                <a class="nav-link" href="{{URL('viewstudentjournals')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>View Student Journals</span></a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link" href="{{URL('viewstudentappointments')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>View Student Appointments</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{URL('getrecommendations')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Expert system recommendations</span></a>
            </li>

            



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->




















        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">

                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{$notcount}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    New messages
                                </h6>
                             @foreach($not as $not)
                                <a class="dropdown-item d-flex align-items-center" href="{{URL('viewstudent',$not->student_id)}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{$not->created_at}}</div>
                                        <span class="font-weight-bold text-gray-500">From:{{$not->student_fullname}}</span></br>
                                        <span class="font-weight-bold">New Diagnosis report for  {{$not->student_fullname}} came as <u>{{$not->diagnosis}}</u> social anxiety!</br>
                                        Click to view progress

                                        </span>
                                    </div>
                                </a>
                                @endforeach

<!-- 
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a> -->
                                <a class="dropdown-item text-center small text-gray-500" href="{{URL('therapistnotifications')}}">Show Notifications</a>
                            </div>
                        </li>

                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$userdata->full_name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="/adminpanel/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{URL('profile',$userdata->id)}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


 <!-- Logout Modal-->

               
<div class="container-fluid p-3">
  
@if(Session::has('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif

 @if(Session::has('warning'))
 <div class="alert alert-warning">{{Session::get('warning')}}</div>
 @endif
  













