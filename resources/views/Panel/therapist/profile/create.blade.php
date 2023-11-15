@include('Panel/therapist/header')
@if($therapist->count()==0)
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.<br>It seems you dont have a profile.Create one below</strong></h1>



<div class="container-form"> 

 
<form action="{{URL('createtherapistprofile')}}" 
method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<h1>Create Profile</h1>


<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Title</strong> <span class="text-danger">*</span> </label>
<p class="text-info">NB:Write your preffered title e.g Mr,Dr,Mrs</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('title') {{$message}} @enderror</strong></div>

<input type="text" class="bg-dark text-light form-control w-100" id="name" name="title">  
</div>
<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Location</strong> <span class="text-danger">*</span> </label>
<p class="text-info">NB:Write your preffered place of meeting.<br>If online type "online".If NOT write the address of your office</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('location') {{$message}} @enderror</strong></div>

<input type="text" class="bg-dark text-light form-control w-100" id="name" name="location">  
</div>


<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="" style="margin-top:;"class=" text-light form-label"><strong>Add a profile picture <span class="text-danger">*</span></strong> </label>
<p class="text-info">NB:It should be an appropiate picture of yourself</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('profile_img') {{$message}} @enderror</strong></div>
<input type="file" class="bg-dark text-light form-control w-100" id="name" name="profile_img">  
</div>

<!-- Credentials -->
<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Degree or Diploma</strong> <span class="text-danger">*</span> </label>
<p class="text-info">NB:State what diploma or degree that you have done in the field of health.</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('credential') {{$message}} @enderror</strong></div>
<input type="text" class="bg-dark text-light form-control w-100" id="name" name="credential">  
</div>

<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Degree or Diploma credential Certification</strong> <span class="text-danger">*</span> </label>
<p class="text-info">NB:Provide an  image  of your Degree or diploma</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('credential_img') {{$message}} @enderror</strong></div>
<input type="file" class="bg-dark text-light form-control w-100" id="name" name="credential_img">  
</div>



<!-- Specialization -->
<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Specialization</strong> </label>
<p class="text-info">NB:State what your specialization is in your field</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('specialization') {{$message}} @enderror</strong></div>
<input type="text" class="bg-dark text-light form-control w-100" id="name" name="specialization">  
</div>

<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Specialization Certification</strong> </label>
<p class="text-info">NB:Provide a in image certificate of your specialization field</p>

<!-- <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('spec_img') {{$message}} @enderror</strong></div> -->
<input type="file" class="bg-dark text-light form-control w-100" id="name" name="spec_img">  
</div>




<!-- Bio -->
<div class="m-2"style="height:auto;padding:.2em; margin-top:0;">
<label for="date" name="content" style="margin-top:;"class=" text-light form-label"><strong>Bio</strong> <span class="text-danger">*</span></label>
<p class="text-info">NB:Give a short bio of yourself and the work you have done</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('bio') {{$message}} @enderror</strong></div>

<textarea name="bio" class="bg-dark text-light  form-control"  id="" cols="30" rows="10">

</textarea>  
</div>
<div class="m-1"style="height:auto;padding:.5em; margin-top:0;">
<button type="submit"
style=" background:linear-gradient(to right,#1FA2FF,#0d2f35 ,#155799,#12D8FA);"

class="btn btn-primary"><strong>Create</strong></button>
</div>



</form>
</div>
</div>
@else
<h1 style="font-size:40px;"><strong>Hello! {{Auth::user()->full_name}}.You have already created a profile so you cant create another one.</strong></h1>

@endif

<div style="margin-top:20em;">
@include('Panel/therapist/footer')
</div>