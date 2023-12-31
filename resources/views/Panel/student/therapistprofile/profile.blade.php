@include('Panel/student/header')
<div class="container-fluid">
@if(count($selectedtherapistArray)<=0 )
<div class="text-center mt-5">
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.It seems like you have not chosen a therapist yet.<br>
Please view the therapist below and choose a therapist</br>
If you have already chosen one wait for the therapist to accept your application
</strong></h1>
</div>
@else
<div class="text-center mt-5">
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.Below are your personal therapists </strong></h1>



<div class="row">
@foreach($selectedtherapistArray as $selected)
@if($selected->application_status='accepted')

<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div  class="d-flex flex-column align-items-center text-center">
                <!-- asset('storage/'.$therapist->profile_img)     -->
                    <img src="/therapist_img/{{$selected->profile_img}}"style="border:solid 1px black;" alt="profilepic" class="rounded-circle" width="150">
                    <div class="col mr-2">
                        <div class="m-2 text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h4>{{$selected->title}}.{{$selected->Full_name}}</h4>  </div>
                        
                        <span class="m-3 text-light badge bg-info">specialization</span>  
                       
                        <div><a href="{{URL('viewtherapist',$selected->therapist_id)}}" class="btn btn-outline-primary"><strong>View Profile</strong></a>  </div>
                    </div>
                  
                </div>
            </div>
           
        </div>
        @else

@endif       
    </div>
  
</div>

@endforeach 

</div>
</div>
@endif

<div class="text-center mt-5">


@if($therapist->count()==0)
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.<br>It seems the therapist haven created profiles</strong></h1>

@else
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.In this section you can view other therapist profiles below.</strong></h1>
<h5>Note:You can make appointments with the therapist of your choice by clicking the view profile button</h5>
@endif


@if(method_exists($therapist,'links'))
<div class="m-5 d-flex justify-content-center">
  {!! $therapist->links()!!} 
</div>
@endif

<div class="row">
@foreach($therapist as $therapist)
@if($therapist->admin_approval=='approved')
<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div  class="d-flex flex-column align-items-center text-center">
                <!-- asset('storage/'.$therapist->profile_img)     -->
                    <img src="/therapist_img/{{$therapist->profile_img}}"style="border:solid 1px black;" alt="Admin" class="rounded-circle" width="150">
                    <div class="col mr-2">
                        <div class="m-2 text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h4>{{$therapist->title}} {{$therapist->Full_name}}</h4>  </div>
                        
                        <span class="m-3 text-light badge bg-info">{{$therapist->specialization}}</span>  
                       
                        <div><a href="{{URL('viewtherapist',$therapist->therapist_id)}}" class="btn btn-outline-primary"><strong>View Profile</strong></a>  </div>
                    </div>
                  
                </div>
            </div>
        </div>
        
    </div>
</div>
@endif
@endforeach



</div>
<div style="margin-top:50em;">

@include('Panel/student/footer')
</div>