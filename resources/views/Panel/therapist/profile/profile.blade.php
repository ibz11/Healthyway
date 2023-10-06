@include('Panel/therapist/header')
<div class="container-fluid">
<div class="text-center mt-5">


@if($therapist->count()==0)
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.<br>It seems you dont have a profile.Click below to create one</strong></h1>
<a href="{{URL('createtherapistprofile')}}" class="btn btn-outline-primary">Create Profile</a>
@else
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.You can view your created profile below.</strong></h1>
<h5>Note:You profile will be displayed to the students</h5>
@endif



@foreach($therapist as $therapist)
<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div  class="d-flex flex-column align-items-center text-center">
                    <img src="/therapist_img/{{$therapist->profile_img}}"style="border:solid 1px black;" alt="Admin" class="rounded-circle" width="150">
                    <div class="col mr-2">
                        <div class="m-3 text-xs font-weight-bold text-primary text-uppercase mb-1">
                        {{$therapist->title}} {{$therapist->Full_name}}  </div>
                        
                        <span class="m-3 badge bg-dark">{{$therapist->specialization}}</span>  
                       
                        <div><a href="{{URL('profileview',$therapist->therapist_id)}}" class="btn btn-outline-primary"><strong>View Profile</strong></a>  </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
@endforeach




</div>
<div style="margin-top:50em;">

@include('Panel/therapist/footer')
</div>