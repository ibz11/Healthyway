@include('Panel/student/header')
<div class="container-fluid">
<div class="text-center mt-5">
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.View the Therapist's profile</strong></h1>

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
                      <p class="text-light mb-1"><span class="badge bg-info">{{$therapist->specialization}} </span></p>
                      <p class="text-dark font-size-sm">Address- {{$therapist->Location}}</p>
                    
                     
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
                  <div class="row">
                    <div class="col-sm-12">
                    
<div class="row">

<div class="col-sm-12">

<form action="{{URL('createappointment')}}" method="POST" id="editform"enctype="multipart/form-data">
@csrf

<h1 class="mt-4 text-2xl"><strong>Book An appointment</strong></h1>  
<p class="text-danger">Note: be mindful of the date and time,it should be at a <u><strong>reasonable</strong></u> time and date </p>

<div  hidden class="mb-3 mt-3">
<label for="email" class="form-label">Therapist ID</label>

<input readonly type="text" class="datepicker form-control w-50" id="phone" value="{{$therapist->therapist_id}}"  name="Therapists_id" required>
</div>

<div   class="mb-3 mt-3">
<label for="email" class="form-label">Date</label>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('appointment_date') {{$message}} @enderror</strong></div>

<input  type="date" class="datepicker form-control w-50" id="phone" value=""  name="appointment_date" required>
</div>





<div class="mb-3 mt-3">
<p class="text-danger">Nb: Time in and time out should be less than or equal to 2 hours</p>
</div>
<div class="mb-3 mt-3">
<label for="email" class="form-label">Appointment time</label>

<p class="text-danger">Nb:Write in am pm format</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('time') {{$message}} @enderror</strong></div>

<input type="time" class="form-control w-50" id="email" value=""  name="time" required>
</div>

<div class="mb-0 mt-3">
<label for="email" class="form-label">Issue that I am dealing with</label>
</div>
<div class="mb-3 mt-3">

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('location') {{$message}} @enderror</strong></div>

<textarea name="issue"  cols="30" rows="10">

</textarea>
</div>
<div class="mb-0 mt-3">
<label for="email" class="form-label">Venue</label>
</div>
<div class="mb-3 mt-3">
<select id="qualifications"  class="form-control block mt-1 w-50" name="location" >
<option value="Online" >
Online
</option>
<option value="{{$therapist->Location}}" >
Therapist's office: {{$therapist->Location}} 
</option>



</select>
</div>
<div class="mb-3 mt-3">
<button class="text-light btn btn-danger "type="submit">Book</button>
</div>
</form>

                     <!-- Add appointment form here -->
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
@include('Panel/student/footer')