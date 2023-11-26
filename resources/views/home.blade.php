<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthyWay</title>

    <link href="/Home/style.css" rel="stylesheet" />
    <link href="/Home/css/home.css" rel="stylesheet" />
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



            <!-- About section-->
            <section class="py-5" id="features">
                <div class="container px-5 my-5">
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5 mb-lg-0"><h2 style="font-size:23px;" class="fw-bolder mb-0"><strong>A better way to fix your mental health</strong></h2></div>
                        <div class="col-lg-8">
                            <div class="row gx-5 row-cols-1 row-cols-md-2">
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5">Interact with our expert system</h2>
                                    <p class="mb-0">Here you can take a test to gauge your level of social anxiety</p>
                                </div>
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-dark bg-gradient text-white rounded-3 mb-3"><i class="bi bi-eye"></i></div>
                                    <h2 class="h5">Book an appointment</h2>
                                    <p class="mb-0">After your application has been accepted by the therapist you can make appointments with them</p>
                                </div>
                                <div class="col mb-5 mb-md-0 h-100">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi-pen"></i></div>
                                    <h2 class="h5">Create journals</h2>
                                    <p class="mb-0">Here you can journals to help keep track of your personal progress and help to relieve stress and anxiety</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
           
       <!--Guide section-->
       <section style="height:180vh;"class="py-5" id="features">
                <div class="container px-5 my-5">
                <h2 style="font-size:33px;" class="mb-5 text-center fw-bolder mb-0"><strong>Healthyway roadmap</strong></h2>
                    <!--<div class="row gx-5">
                    
                        <div class="col-lg-12">-->
                            <div class="row ">
                            
                                <div class="col-sm-12 mb-1 h-100">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi-">1</i></div>
                                    <h2 class="h5">Step 1. Create an account</h2>
                                    <p class="mb-0">You must be a registered user for you to use our system
                                        @if(Auth::check())
                                        @else
                                        <p>You can register below: </p>
                                    <a href="{{URL('register')}}" style="text-decoration:none;" class="badge bg-dark">Register</a>
                                        @endif
</div>  
                                
<div class="row">
<div class="col-12 mb-1">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi"><strong>2</strong></i></div>
                                    <h2 class="h5">Step 2. Take a social anxiety test</h2>
                                    <p class="mb-0">You can take our Social Anxiety test from  our expert system on your dashboard</p>
                                 
                                </div>
                                <div class="col-sm-12 mb-1 h-100">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi-">3</i></div>
                                   <h2 class="h5">Step 2. View therapist profiles</h2>
                                    <p class="mb-0">Here you can see all the therapists details that you might need to book an appointment with.You can view th</p>
                                    <!-- <a href="{{URL('alltherapistsview')}}"class="badge bg-dark">View therapists</a> -->
                                </div>

</div>
<div class="row">          

                                <div class="col-12 mb-1 ">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi-">3</i></div>
                                    <h2 class="h5">Step 3. Book an appointment on the form</h2>
                                    <p class="mb-0">There will be a form displayed once logged in in the therapist profile and then you can book date time and venue of the therapy session.You can check therapist profiles below</p>
                                    <!-- <a href="{{URL('alltherapistsview')}}"class="badge bg-dark">Check therapists profiles</a> -->
                                </div>



                                <div class="row">                             
                                     <div class="col-12 mb-1">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi">4</i></div>
                                    <h2 class="h5">Step 4. Wait for the appointment to be approved</h2>
                                    <p class="mb-0">You must wait for your appointment to be approved for you to proceed with the appointment</p>
                                    <!-- <a href="{{URL('appointments')}}"class="badge bg-dark">My appointments</a> -->
                                </div>
</div>



                                <div class="row">
                                <div class="col-12 mb-1 ">
                                    <div class="feature bg-info bg-gradient text-white rounded-3 mb-3"><i class="bi bi-">5</i></div>
                                    <h2 class="h5">Step 5. View progress</h2>
                                    <p class="mb-0">There will be a dashboard with which you can view your social anxiety progress over time. </p>
                                </div>
</div>  
</div>                              
                            
                        </div>
                    </div>
                </div>
            </section>     


            <section >
            <div class="mt-5 py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-10 col-xl-7">
                            <div class="text-center">
                                <div class="fs-4 mb-4 fst-italic">"I would say what others have said: It gets better. One day, you'll find your tribe. 
                                  You just have to trust that people are out there waiting to love you and celebrate you for who you are. In the meantime, the reality is you might have to be your own tribe. 
                                  You might have to be your own best friend. That's not something they're 
                                  going to teach you in school. So start the work of loving yourself.</div>
                                <div class="d-flex align-items-center justify-content-center">
                                <!-- src=" https://dummyimage.com/40x40/ced4da/6c757d  -->
                                    <img class="rounded-circle me-3" height="40" width="40"   src="/adminpanel/img/undraw_profile.svg" alt="profile picture" />
                                
                                    <div class="fw-bold">
                                        Ibrahim
                                        <span class="fw-bold text-primary mx-1">/</span>
                                        Founder, Healthway
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>
        
                    <section id="therapists" class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="mb-4  text-center">
                        <h2 style="font-size:25px;" class="fw-bolder">Our Therapists</h2>
                        <p class="lead fw-normal text-muted mb-5">Dedicated to quality and success in your mental health journey</p>
                        <!-- <a href="{{URL('alltherapistsview')}}" class="btn btn-primary">View all the therapists</a> -->
                    </div>
                    @if(method_exists($therapist,'links'))
            <div class="m-2 d-flex justify-content-center">
             {!! $therapist->links()!!}
             </div>
              @endif
                    <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                    @foreach($therapist as $therapist)
                    @if($therapist->admin_approval=='approved')
                    
                        <div class="col mb-5 mb-5 mb-xl-0">
                      
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" style="height:15em;width:18em;" src="/therapist_img/{{$therapist->profile_img}}" alt="..." />
                                <h5 class="fw-bolder">Dr.{{$therapist->Full_name}}</h5>
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{$therapist->role}}</div>
                                <div class="fst-italic text-muted"><strong>Credential</strong><br>  {{$therapist->credential}}</div>
                                <div class="fst-italic text-muted"><strong>Specialization</strong> <br>
                                {{$therapist->specialization}} </div>
                                <div class="fst-italic text-muted"><strong>Place of work</strong><br> {{$therapist->Location}} </div>
                                <div class="fst-italic text-muted"><strong>Biography</strong><br><i> {{$therapist->bio}}" </i> </div>
                                <!-- <a class="btn btn-info text-light" href="{{URL('viewtherapist',$therapist->id)}}"> View profile</a> -->
                            </div>
                        </div>
                        @else

                        @endif
                      @endforeach

                    </div>
                </div>
</div>
            </section>
                   
 


                            <div class="col-xl-4">
                            <div class="card border-0 bg-light mt-xl-5">
                                <div class="card-body p-4 py-lg-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <div style="padding:2em;" class="h6 fw-bolder">Any more questions?</div>
                                            <p class=" mb-4">
                                                Contact us at
                                                <br />
                                                <a href="#!" style="text-decoration:none;">ibramiabdi.ke@gmail.com</a>
                                               <div style="padding:2em; text-decoration:none;"> <a style="text-decoration:none;" href="+254704736051"><strong>Phone: +254704736051</strong></a></div>
                                            </p>
                                            <!-- <div class="mt-2 h6 fw-bolder">Other contacts</div>
                                            <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-instagram"></i></a>
                                            <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                            <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a> -->
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; Healthymind 2022</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="{{URL('/')}}">Home</a>
                        <span class="text-white mx-1">&middot;</span>
                        <!-- <a class="link-light small" href="{{URL('forum')}}">Forum</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="/blog">Blog</a> -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        
    </body>
</html>



