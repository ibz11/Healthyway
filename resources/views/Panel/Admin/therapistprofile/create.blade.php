@include('Panel/Admin/header')
<div class="container-form"> 

 
<form action="{{URL('admincreatetherapistprofile')}}" 
method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<h1>Create Profile for a therpist</h1>


<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Select a Therapist ID</strong> </label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('user_id') {{$message}} @enderror</strong></div>
<!-- <input type="text" class="bg-dark text-light form-control w-100" id="name" name="therapist_id">   -->
<select name="therapist_id" class="bg-dark text-light form-control w-100" id="">
    @foreach($user as $id)
    <option value="{{$id->id}}">{{$id->id}}-{{$id->full_name}}</option>
    @endforeach
</select>
</div>

<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Select a Therapist's Full name based on their Therapist ID</strong> </label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('full_name') {{$message}} @enderror</strong></div>
<!-- <input type="text" class="bg-dark text-light form-control w-100" id="name" name="therapist_id">   -->
<select name="full_name" class="bg-dark text-light form-control w-100" id="">
    @foreach($user as $fullname)
    <option value="{{$fullname->full_name}}">{{$fullname->id}}-{{$fullname->full_name}}</option>
    @endforeach
</select>
</div>

<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Select a Therapist Email based on their Therapist ID</strong> </label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('email') {{$message}} @enderror</strong></div>
<!-- <input type="text" class="bg-dark text-light form-control w-100" id="name" name="therapist_id">   -->
<select   name="email" class="bg-dark text-light form-control w-100" id="">
    @foreach($user as $email)
    <option value="{{$email->email}}">{{$email->id}}-{{$email->email}}</option>
    @endforeach
</select>
</div>


<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Select a Therapist Phone based on their Therapist ID</strong> </label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('phone') {{$message}} @enderror</strong></div>
<!-- <input type="text" class="bg-dark text-light form-control w-100" id="name" name="therapist_id">   -->
<input type="number" placeholder="Phone number"class="bg-dark text-light form-control w-100" id="name" name="phone" required>
</div>



<div class="m-2 mb-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Title</strong> </label>
<p class="text-info">NB:Write a title e.g Mr,Dr,Mrs</p>
<p class="text-info">NB:Not a Must!Therapist can be Updated later</p>

<input type="text" class="bg-dark text-light form-control w-100" id="name" name="title">  
</div>



<div class="m-2"style="height:8.5em;padding:.2em; margin-top:1em;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Location</strong> </label>
<p class="text-info">NB:Write a preffered place of meeting for the Therapisr.<br>If online type "online".If NOT write the address of your office</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('location') {{$message}} @enderror</strong></div>

<input type="text" class="bg-dark text-light form-control w-100" id="name" name="location">  
</div>

<div class="mt-5"style="height:8.5em;padding:.2em; margin-top:0.5;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Specialization</strong> </label>
<p class="text-info">NB:State what your specialization is in your field</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('specialization') {{$message}} @enderror</strong></div>

<input type="text" class="bg-dark text-light form-control w-100" id="name" name="specialization">  
</div>

<div class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="" style="margin-top:;"class=" text-light form-label"><strong>Add a profile picture</strong> </label>
<p class="text-info">NB:It should be an appropiate picture of yourself</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('profile_img') {{$message}} @enderror</strong></div>


<input type="file" class="bg-dark text-light form-control w-100" id="name" name="profile_img">  
</div>

<div class="m-2"style="height:auto;padding:.2em; margin-top:0;">
<label for="date" name="content" style="margin-top:;"class=" text-light form-label"><strong>Bio</strong> </label>
<p class="text-info">NB:Give a short bio of yourself</p>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text">

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


<div style="margin-top:20em;">
@include('Panel/Admin/footer')
</div>