@include('Panel/Admin/header')

 
<form action="{{URL('adminupdatetimeslot',$times->time_id)}}" 
method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<h1>Create Timeslots for appointments setting</h1>




<div  class="m-2"style="height:8.5em;padding:.2em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Therapist_ID</strong> </label>




<input readonly type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$times->therapist_id}}"name="therapist_id">  
</div>



<div class="m-2"style="height:15.5em;padding:.2em; margin-top:0;">
<label for="" style="margin-top:;"class=" text-light form-label"><strong>Add a timeslot</strong> </label>
<p class="text-info">NB:Timeslots should be written depending on the duration of the session.<br>
If you have sessions of 1 hour it should be written like this: 8:30-9:30 ,9:45-10:45<br>
Be sure to include times between for breaks and prep-work for the next student ideally 15-30 minutes
</p>
<p class="text-danger"><strong>Format to input below: 8:30-9:30 or 8:45-9:45 </strong></p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('timeslot') {{$message}} @enderror</strong></div>

<input type="text" class="bg-dark text-light form-control w-100" value="{{$times->timeslot}}" id="timeslot" name="timeslot"> 
</div>


<div class="mt-5"style="height:auto;padding:.5em; margin-top:0;">
<button type="submit"
style=" background:linear-gradient(to right,#1FA2FF,#0d2f35 ,#155799,#12D8FA);"

class="btn btn-primary"><strong>Update Timeslot</strong></button>
</div>



</form>
</div>
</div>


<div style="margin-top:20em;">
@include('Panel/Admin/footer')
</div>
