@include('Panel/student/header')


 

<div class="container-form"
> 

 
<form action="{{URL('expertsystem')}}" 

method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<div   class="mb-3 mt-3">
<h1>LIEBOWITZ SOCIAL ANXIETY SCALE </h1>
<div style="display:flex;flex-direction:column;
justify-content:space-between;"> 
<p>The liebowitz social anxiety scale consists of 24 questions<br> where each question has an Avoidance and Fear scale<br>
we can take the example of question 1 where you have high Fear and High avoidance <br>
you can score 3 for each or 0 for both if you have no fear or avoidance 
</p>
<p>The scores for are then calculated by adding the Total Fear score and Total Avoidance score for all the 24 questions.
<br>
LSAS SCORE=Total Fear + Total Avoidance

<br>
Then the score is then diagnosed by the scoring scale below</p>
<p>THE SCORING SCALE:</p>
<p> ( 0-29 )You do not suffer from social
    anxiety<br>
   ( 30-49 ) Mild social anxiety<br>
   ( 50-64 )Moderate social anxiety<br>
   ( 65-79) Marked social anxiety<br>
   ( 80-94 ) Severe social anxiety<br>
  ( >= 95 )   Very severe social anxiety</p>
</div>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text">
<strong>@error('F1') {{$message}} @enderror</strong></div>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text">
<strong>@error('F2') {{$message}} @enderror</strong></div>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text">
<strong>@error('F3') {{$message}} @enderror</strong></div>

<div  class="container2" class="mb-3 mt-3">


<!-- Include Bootstrap JS (optional, if needed) -->



<!-- <div class="m-3" style ="display:grid; grid-template-columns:auto; border:1px solid white; padding:em;"> -->
<div class="m-3" style ="display:grid; grid-template-columns:auto;  padding:em;">
@foreach($questions as $questions)
<div class="m-1"style="height:8.5em;border:1px solid white;padding:.5em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>{{$questions}}</strong> </label>
    
</div>
      <hr style="background:white;">
    @endforeach
</div>




<div class="m-3" style ="display:grid; grid-template-columns:auto;  padding:em;">

@foreach($feartag as $feartag)

<div class="m-1"style="border:1px solid white;padding:.5em; margin-top:0;">
  <label for=""><strong>FEAR</strong></label>
    <select  style="border:1px solid white;background:linear-gradient(to right,#141E30,#243B55);
    width:8em;height:2em;border-radius:.3em;" class="w-10 bg-dark text-light form-select" name='{{$feartag}}' >
        
        <option value="0">0 None</option>
        <option value="1">1 Mild</option>
        <option value="2">2 Moderate</option>
        <option value="3">3 Severe</option>
      </select>
      </div>
      <hr style="background:white;">
     
    @endforeach
</div>


<div class="m-3" style ="display:grid; grid-template-columns:auto;  padding:em;">
@foreach($avoidancetag as $avoidancetag)
<div class="m-1"style="border:1px solid white;padding:.5em; margin-top:0;">
  <label for=""><strong> Avoidance</strong></label>
    <select  style="border:1px solid white;background:linear-gradient(to right,#141E30,#243B55);
    width:8em;height:2em;border-radius:.3em;" class="w-10 bg-dark text-light form-select" name={{$avoidancetag}} aria-label="Default select example">
        
        <option value="0">0 Never</option>
        <option value="1">1 Occasionally</option>
        <option value="2">2 Often</option>
        <option value="3">3 Usually</option>
      </select>
      </div>
      <hr style="background:white;">
    @endforeach
</div>
      

  <!-- <div class="m-3"style ="display:grid; grid-template-columns:auto;border:1px solid white; padding:.2em;">
 

 <div style="border:1px solid white;margin-top:.3em;padding:.6em;">
  <label for=""><strong> AVOIDANCE</strong></label>
  
  <select  style="border:1px solid white;background:linear-gradient(to right,#141E30,#243B55);
    width:8em;height:2em;border-radius:.3em;" class="w-10 bg-dark text-light form-select" name="" aria-label="Default select example">
        
        <option value="0">0 Never</option>
        <option value="1">1 Occasionally</option>
        <option value="2">2 Often</option>
        <option value="3">3 Usually</option>
      </select>
    </div>
    <hr style="background:white;">
    
</div> -->



</div> 

<div class="div">
<button type="submit"
style=" background:linear-gradient(to right,#1FA2FF,#0d2f35 ,#155799,#12D8FA);"

class="btn btn-primary"><strong>Submit</strong></button>
</div>
</div>
</form>
</div>

















@include('Panel/student/footer')