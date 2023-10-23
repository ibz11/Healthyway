@include('Panel/Admin/header')
<div class="container-form"> 

 
<form action="{{URL('updatetherapistprofile',$therapist->therapist_id)}}" 
method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<h1>Update Profile</h1>


<div hidden class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Therapist ID</strong> </label>
<input readonly type="text" value="{{$therapist->user_id}}"class="bg-dark text-light form-control w-100" id="name" name="user_id">  
</div>


<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Therapist Full Names</strong> </label>
<input  type="text" value="{{$therapist->Full_name}}"class="bg-dark text-light form-control w-100" id="full_name" name="full_name">  
</div>

<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Therapist Email</strong> </label>
<input  type="text" value="{{$therapist->email}}"class="bg-dark text-light form-control w-100"  name="email" required>  
</div>

<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Therapist Phone Number</strong> </label>
<input  type="text" value="{{$therapist->phone}}"class="bg-dark text-light form-control w-100" name="phone">  
</div>

<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Title</strong> </label>
<p class="text-info">NB:Titles can be written as Mr. or DR. or Ms</p>

<input type="text" value="{{$therapist->title}}"class="bg-dark text-light form-control w-100" id="name" name="title">  
</div>



<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Location</strong> </label>
<p class="text-info">NB:Write your preffered place of meeting.<br>If online type "online".If NOT write the address of your office</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('location') {{$message}} @enderror</strong></div>

<input type="text" value="{{$therapist->Location}}" class="bg-dark text-light form-control w-100" id="name" name="location">  
</div>

<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Specialization</strong> </label>
<p class="text-info">NB:State what your specialization is in your field e.g Child Phsycology</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('specialization') {{$message}} @enderror</strong></div>

<input type="text" value="{{$therapist->specialization}}" class="bg-dark text-light form-control w-100" id="name" name="specialization">  
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
@include('Panel/Admin/footer')
</div>