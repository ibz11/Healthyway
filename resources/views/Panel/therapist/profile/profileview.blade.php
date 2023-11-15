@include('Panel/therapist/header')
<div class="container-fluid">
<div class="text-center mt-5">
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.Click on your profile</strong></h1>
<h4>Note:You profile will be displayed to the students. once it has been <u><strong>Approved</strong></u> by the administrator</h4>
</div>

<div class="container mt-4">
    <div class="main-body">
    
         
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
         
              <div class="card">

              <!--https://bootdey.com/img/Content/avatar/avatar7.png-->
                <div class="card-body">
                  <div  class="d-flex flex-column align-items-center text-center">
                    <img src="/therapist_img/{{$therapist->profile_img}}"style="border:solid 1px black;" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$therapist->title}}.{{$therapist->Full_name}}</h4>
                      <p class="text-dark mb-1"><span class="badge bg-info">{{$therapist->specialization}} </span></p>
                      <p class="text-dark font-size-sm">Address- {{$therapist->Location}}</p>
                    
                      <p class="text-dark text-center font-size-sm"><strong>Administrator Approval:</strong></p>
                      <p class="text-dark font-size-xl "><span class="p-3 font-size-xl badge bg-dark">{{$therapist->admin_approval}}</span></p>
                      <a href="{{URL('updateprofile',$therapist->therapist_id)}}" class="btn btn-outline-primary">Update</a>
                      <a href="{{URL('deleteprofile',$therapist->therapist_id)}}" class="btn btn-danger">Delete profile</a>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Names</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   {{$therapist->Full_name}}
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$therapist->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Credential</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$therapist->credential}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Specialization</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$therapist->specialization}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   + {{$therapist->phone}}
                    </div>
                  </div>
                  <hr>

                  <!-- <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Qualification</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
             
                    </div>
                  </div>
                  <hr> -->
           
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Biography & Description</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$therapist->bio}}
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Location of establishment</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$therapist->Location}}
                    </div>
                  </div>
                  <hr>
                  
<!-- Credentials -->
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Degree / Diploma Image</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    @if(!$therapist->credential_img or $therapist->credential_img=='') 
                      <h6>Not provided</h6>
                     @else
                    <img src="/credential/{{$therapist->credential_img}}"style="border:solid 1px black;" alt="Admin"  width="500">
                  @endif 
                    
                    </div>
                  </div>
                  <hr>
<!-- Specialization -->
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Specialization Certification</h6>
                    </div>

                    <div class="col-sm-9 text-secondary">
                     @if(!$therapist->spec_img or $therapist->spec_img=='') 
                      <h6>Not provided</h6>
                     @else
                    <img src="/specialization/{{$therapist->spec_img}}"style="border:solid 1px black;" alt="Admin"  width="500">
                  @endif  
                  </div>
                  </div>
                  <hr>



                  

                  <div class="row">
                    <div class="col-sm-12">
                    
                      <a href="{{URL('updateprofile',$therapist->therapist_id)}}" class="mt-4 btn btn-outline-success">Update</a>
                    </div>
                  </div>
               
                </div>
            
              </div>
           
              
                </div>
                
            
                  </div>
               
                </div>
              </div>



            </div>
          </div>

        </div>
    
</div>





</div>
@include('Panel/therapist/footer')