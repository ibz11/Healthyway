@include('Panel/therapist/header')
<div class="container-form"> 

 
<form action="{{URL('updateprofile',$therapist->therapist_id)}}" 
method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<h1>Update Profile</h1>


<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Title</strong> </label>
<p class="text-info">NB:Write your preffered title e.g Mr,Dr,Mrs</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('title') {{$message}} @enderror</strong></div>

<input type="text" value="{{$therapist->title}}"class="bg-dark text-light form-control w-100" id="name" name="title">  
</div>
<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Location</strong> </label>
<p class="text-info">NB:Write your preffered place of meeting.<br>If online type "online".If NOT write the address of your office</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('location') {{$message}} @enderror</strong></div>

<input type="text" value="{{$therapist->Location}}" class="bg-dark text-light form-control w-100" id="name" name="location">  
</div>



<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="">Current Image</label></br>
<img src="/therapist_img/{{$therapist->profile_img}}" style="height:6em;width:7em;"class="rounded" alt="">
</div>
<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="" style="margin-top:;"class=" text-light form-label"><strong>Add a profile picture</strong> </label>
<p class="text-info">NB:It should be an appropiate picture of yourself</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('profile_img') {{$message}} @enderror</strong></div>


<input type="file" value="{{$therapist->profile_img}}"class="bg-dark text-light form-control w-100" id="name" name="profile_img">  
</div>




<!-- Credentials -->
<div class="mt-5"style="height:10.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Degree or Diploma</strong> <span class="text-danger">*</span> </label>
<p class="text-info">NB:State what diploma or degree that you have done in the field of health.</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('credential') {{$message}} @enderror</strong></div>
<input type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$therapist->credential}}" name="credential">  
</div>

@if(!$therapist->credential_img or $therapist->credential_img=='')
@else
<div class="m-2"style="height:8.5em;padding:.2em; margin-bottom:3em;">
<label for="">Current Credential image</label></br>
<img src="/credential/{{$therapist->credential_img}}" style="height:10em;width:12em;"class="rounded" alt="">
</div>
@endif

<div class="mt-5"style="height:12.5em;padding:.2em; margin-top:14em;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Degree or Diploma credential Certification</strong> <span class="text-danger">*</span> </label>
<p class="text-info">NB:Provide an  image  of your Degree or diploma</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('credential_img') {{$message}} @enderror</strong></div>
<input type="file" class="bg-dark text-light form-control w-100" id="name" value="{{$therapist->credential_img}}" name="credential_img">  
</div>



<!-- Specialization -->
<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Specialization</strong> </label>
<p class="text-info">NB:State what your specialization is in your field</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('specialization') {{$message}} @enderror</strong></div>
<input type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$therapist->specialization}}"name="specialization">  
</div>

@if(!$therapist->spec_img or $therapist->spec_img=='')

@else
<div class="m-2"style="height:8.5em;padding:.2em; margin-bottom:3em;">
<label for="">Current Specialization image</label></br>
<img src="/specialization/{{$therapist->spec_img}}" style="height:10em;width:12em;"class="rounded" alt="">
</div>
@endif








<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Specialization Certification</strong> </label>
<p class="text-info">NB:Provide a in image certificate of your specialization field</p>

<!-- <div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('spec_img') {{$message}} @enderror</strong></div> -->
<input type="file" class="bg-dark text-light form-control w-100" id="name" name="spec_img">  
</div>


















<div class="m-2"style="height:auto;padding:.2em; margin-top:0;">
<label for="date" name="content" style="margin-top:;"class=" text-light form-label"><strong>Bio</strong> </label>
<p class="text-info">NB:Give a short bio of yourself</p>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text">

<textarea name="bio" class="bg-dark text-light  form-control"  id="" cols="30" rows="10">
{{$therapist->bio}}
</textarea>  
</div>
<div class="m-1"style="height:auto;padding:.5em; margin-top:0;">
<button type="submit"
style=" background:linear-gradient(to right,#159957,#155799);"
class="btn btn-primary"><strong>Update</strong></button>
</div>



</form>
</div>
</div>


<div style="margin-top:20em;">
@include('Panel/therapist/footer')
</div>