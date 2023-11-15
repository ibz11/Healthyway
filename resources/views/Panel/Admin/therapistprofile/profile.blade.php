@include('Panel/Admin/header')
<div class="container-fluid">

<div class="text-center mt-5">
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.Below are all the profiles created by the therapists </strong></h1>
<a href="{{URL('admincreatetherapistprofile')}}" class="btn btn-outline-primary">Create a  Profile for a Therapist</a>
</div>




<div class="text-center mt-5">



@if(method_exists($therapist,'links'))
<div class="m-5 d-flex justify-content-center">
  {!! $therapist->links()!!} 
</div>
@endif

<div class="row">
@foreach($therapist as $therapist)
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

                        <p class="text-dark text-center font-size-sm"><strong>Administrator Approval:</strong></p>
                      <p class="text-dark font-size-xl "><span class="p-2 font-size-xl badge bg-dark">{{$therapist->admin_approval}}</span></p>
                       
                        <div><a href="{{URL('viewtherapistprofile',$therapist->therapist_id)}}" class="btn btn-outline-primary"><strong>View Profile</strong></a>  </div>
                    </div>
                  
                </div>
            </div>
        </div>
        
    </div>
</div>
@endforeach



</div>
</div>
<div style="margin-top:50em;">

@include('Panel/Admin/footer')
</div>