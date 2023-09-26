@include('Panel/student/header')


@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif
 

<div class="container-form"
> 

 
<form action="" 

method="POST" class="expertform"id="editform"enctype="multipart/form-data"

>
@csrf
<div   class="mb-3 mt-3">
<h1>Expert system Form</h1>
<div style="display:flex;flex-direction:row;
justify-content:space-between;"> 
<p>Explain test here</p>
</div>


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
    width:8em;height:2em;border-radius:.3em;" class="w-10 bg-dark text-light form-select" name={{$feartag}} aria-label="Default select example">
        
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