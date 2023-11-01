@include('Panel/student/header')

<!-- <div class="container"> 

 <div class="progress"></div>
<div class="scrollable-div">  -->


<form class="expert-form"data-multi-step class="multi-step-form"
action="{{URL('expertsystem')}}" 

method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<div class="exp-card" data-step>
<h3 class="step-title">LIEBOWITZ SOCIAL ANXIETY SCALE (LSAS)</h3>

<p class="step-title"><strong>
 
The Liebowitz Social Anxiety Scale (LSAS) is a widely used self-report
<br>and clinician-administered questionnaire  designed to assess and measure social anxiety disorder (SAD),
<strong></p>



<p class="step-title"><strong>The Liebowitz Social Anxiety scale consists of 24 questions<br> where each question has an Avoidance and a Fear scale<br>
The questions has been categorized in different scenarios:<br>1. Interpersonal interaction,<br>2.General Interactions <br> 
3.Situational Interactions<br>4. Perfomance anxiety situations<br>In these situations you are going to select your level of fear and avoidance in interacting with each scenario
</strong></p>

<p class="step-title"><strong><i>Remember to be kind to yourself and <br> your Mental health matters to Us <br>
Happy Test Taking!!
</i></strong></p>

<p class="step-title" style="color:red;"><strong>Note:Do not refresh the page while taking the test
    <br> otherwise you lose your progress on the test</strong></p>

<button type="button" style="border-radius:0;"class="btn btn-info" data-next>Take the test</button>
</div>








<!--Step 1---->
<div class="exp-card" data-step>
<h3 class="step-title">Situational anxiety</h3>

@foreach ($general['questions'] as $index => $question)
<div class="exp-form-group">
<p class="step-title"><strong>Scenario {{ $question }} </strong></p>
 
  <div style="border-radius:.3em;border: 1px solid black; padding:.3em;">


 <p><strong> {{ $general['feartag'][$index] }}. How much fear do you have engaging in this activity?</strong></p>
 @if ($errors->has('gender'))
    <span class="m-1 text-danger">{{ $errors->first('F1') }}</span>
@endif
  <input type="radio" name="{{ $general['feartag'][$index] }}" class="animated-radio" id="male" value="0" required>
  <label for="male">None</label>
  
  <input type="radio" name="{{ $general['feartag'][$index] }}" class="animated-radio" id="female" value="1" required>
  <label for="female">Mild</label>
  
  <input type="radio" name="{{ $general['feartag'][$index] }}" class="animated-radio" id="ola" value="2"required>
  <label for="other">Moderate</label>

  <input type="radio" name="{{ $general['feartag'][$index] }}" class="animated-radio" id="fulu" value="3" required>
  <label for="other">Severe</label>



  <p><strong> {{ $general['avoidancetag'][$index] }}. How likely are you to avoid doing this activity?</strong></p>
  <input type="radio" name="{{ $general['avoidancetag'][$index] }}" class="animated-radio" id="a" value="0" required>
  <label for="male">Never</label>
  
  <input type="radio" name="{{ $general['avoidancetag'][$index] }}" class="animated-radio" id="b" value="1" required>
  <label for="female">Ocassionally</label>
  
  <input type="radio" name="{{ $general['avoidancetag'][$index] }}" class="animated-radio" id="c" value="2" required>
  <label for="other">Often</label>

  <input type="radio" name="{{ $general['avoidancetag'][$index] }}" class="animated-radio" id="d" value="3" required>
  <label for="other">Usually</label>
</div>
</div>



@endforeach
<button type="button" style="border-radius:0;"class="btn btn-info" data-previous>Previous</button>
<button type="button" style="border-radius:0;"class="btn btn-info" data-next>Next</button>

</div>
<!--End of Step 1---->

   
<!--Step 2---->
<div class="exp-card" data-step>
<h3 class="step-title">Performance anxiety</h3>

@foreach ($performance['questions'] as $index => $question)
<div class="exp-form-group">
<p class="step-title"><strong>Scenario {{ $question }} </strong></p>
 
  <div style="border-radius:.3em;border: 1px solid black; padding:.3em;">


 <p><strong> {{$performance['feartag'][$index] }}. How much do you fear doing this activity?</strong></p>
  <input type="radio" name="{{ $performance['feartag'][$index] }}" class="animated-radio" id="male" value="0"  required>
  <label for="male">None</label>
  
  <input type="radio" name="{{$performance['feartag'][$index] }}" class="animated-radio" id="female" value="1"  required>
  <label for="female">Mild</label>
  
  <input type="radio" name="{{ $performance['feartag'][$index] }}" class="animated-radio" id="ola" value="2" required>
  <label for="other">Moderate</label>

  <input type="radio" name="{{ $performance['feartag'][$index] }}" class="animated-radio" id="fulu" value="3" required>
  <label for="other">Severe</label>



  <p><strong> {{ $performance['avoidancetag'][$index] }}. How likely are you to avoid doing this activity?</strong></p>
  <input type="radio" name="{{ $performance['avoidancetag'][$index] }}" class="animated-radio" id="a" value="0">
  <label for="male">Never</label>
  
  <input type="radio" name="{{ $performance['avoidancetag'][$index] }}" class="animated-radio" id="b" value="1">
  <label for="female">Ocassionally</label>
  
  <input type="radio" name="{{ $performance['avoidancetag'][$index] }}" class="animated-radio" id="c" value="2">
  <label for="other">Often</label>

  <input type="radio" name="{{ $performance['avoidancetag'][$index] }}" class="animated-radio" id="d" value="3">
  <label for="other">Usually</label>
</div>
</div>



@endforeach
<button type="button" style="border-radius:0;"class="btn btn-info" data-previous>Previous</button>
<button type="button" style="border-radius:0;"class="btn btn-info" data-next>Next</button>

</div>
<!--End of Step 2---->


   
<!--Step 3---->
<div class="exp-card" data-step>
<h3 class="step-title">Interpersonal anxiety</h3>

@foreach ($interpersonal['questions'] as $index => $question)
<div class="exp-form-group">
<p class="step-title"><strong>Scenario {{ $question }} </strong></p>
 
  <div style="border-radius:.3em;border: 1px solid black; padding:.3em;">


 <p><strong> {{$interpersonal['feartag'][$index] }}. How much do you fear doing this activity?</strong></p>
  <input type="radio" name="{{ $interpersonal['feartag'][$index] }}" class="animated-radio" id="male" value="0" required>
  <label for="male">None</label>
  
  <input type="radio" name="{{$interpersonal['feartag'][$index] }}" class="animated-radio" id="female" value="1"required>
  <label for="female">Mild</label>
  
  <input type="radio" name="{{ $interpersonal['feartag'][$index] }}" class="animated-radio" id="ola" value="2" required>
  <label for="other">Moderate</label>

  <input type="radio" name="{{ $interpersonal['feartag'][$index] }}" class="animated-radio" id="fulu" value="3" required>
  <label for="other">Severe</label>



  <p><strong> {{ $interpersonal['avoidancetag'][$index] }}. How likely are you to avoid doing this activity?</strong></p>
  <input type="radio" name="{{ $interpersonal['avoidancetag'][$index] }}" class="animated-radio" id="a" value="0" required>
  <label for="male">Never</label>
  
  <input type="radio" name="{{ $interpersonal['avoidancetag'][$index] }}" class="animated-radio" id="b" value="1"required>
  <label for="female">Ocassionally</label>
  
  <input type="radio" name="{{ $interpersonal['avoidancetag'][$index] }}" class="animated-radio" id="c" value="2">
  <label for="other">Often</label>

  <input type="radio" name="{{ $interpersonal['avoidancetag'][$index] }}" class="animated-radio" id="d" value="3">
  <label for="other">Usually</label>
</div>
</div>



@endforeach
<button type="button" style="border-radius:0;"class="btn btn-info" data-previous>Previous</button>
<button type="button" style="border-radius:0;"class="btn btn-info" data-next>Next</button>

</div>
<!--End of Step 3---->





   
<!--Step 4---->
<div class="exp-card" data-step>
<h3 class="step-title">Situational anxiety</h3>

@foreach ($situational['questions'] as $index => $question)
<div class="exp-form-group">
<p class="step-title"><strong>Scenario {{ $question }} </strong></p>
 
  <div style="border-radius:.3em;border: 1px solid black; padding:.3em;">


 <p><strong> {{$situational['feartag'][$index] }}. How much do you fear doing this activity?</strong></p>
  <input type="radio" name="{{ $situational['feartag'][$index] }}" class="animated-radio" id="male" value="0" required>
  <label for="male">None</label>
  
  <input type="radio" name="{{$situational['feartag'][$index] }}" class="animated-radio" id="female" value="1" required>
  <label for="female">Mild</label>
  
  <input type="radio" name="{{ $situational['feartag'][$index] }}" class="animated-radio" id="ola" value="2" required>
  <label for="other">Moderate</label>

  <input type="radio" name="{{ $situational['feartag'][$index] }}" class="animated-radio" id="fulu" value="3" required>
  <label for="other">Severe</label>



  <p><strong> {{ $situational['avoidancetag'][$index] }}. How likely are you to avoid doing this activity?</strong></p>
  <input type="radio" name="{{ $situational['avoidancetag'][$index] }}" class="animated-radio" id="a" value="0" required>
  <label for="male">Never</label>
  
  <input type="radio" name="{{ $situational['avoidancetag'][$index] }}" class="animated-radio" id="b" value="1" required>
  <label for="female">Ocassionally</label>
  
  <input type="radio" name="{{ $situational['avoidancetag'][$index] }}" class="animated-radio" id="c" value="2" required>
  <label for="other">Often</label>

  <input type="radio" name="{{ $situational['avoidancetag'][$index] }}" class="animated-radio" id="d" value="3" required>
  <label for="other">Usually</label>
</div>
</div>



@endforeach
<button type="button" style="border-radius:0;"class="btn btn-info" data-previous>Previous</button>
<button type="submit" style="border-radius:0;"class="btn btn-info" data-next>Submit</button>


</div>
<!--End of Step 4---->


























  </form>













</div>

@include('Panel/student/footer')