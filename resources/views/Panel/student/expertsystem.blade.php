@include('Panel/student/header')

<div style="display:flex;justify-content:center;align-items:center;">
<form action="" 
style="
color:white;
background:linear-gradient(to right,#141E30,#243B55);
border-radius:.4em;
width:fit-content;
height: fit-content;
padding: 2em;
margin:2em;
"
method="POST" id="editform"enctype="multipart/form-data">
   
<div   class="mb-3 mt-3">
<h1>Expert system Form</h1>
<p>Explain test here</p>
</div>
   
<div style ="display: flex; flex-direction:row; justify-content: space-between;"class="mb-3 mt-3">
<div class="m-2">
    <label for="date" class="text-light form-label"><strong>Q.1 Using a telephone in public</strong> </label>
</div>
<div class="m-2">
    <select  style="border:1px solid white;background:linear-gradient(to right,#141E30,#243B55);
    width:8em;height:2em;border-radius:.3em;" class="w-10 bg-dark text-light form-select" aria-label="Default select example">
        <option selected>Fear</option>
        <option value="0">0 None</option>
        <option value="1">1 Mild</option>
        <option value="2">2 Moderate</option>
        <option value="3">3 Severe</option>
      </select>
    </div>

  <div class="m-2">
  <select  style="border:1px solid white;background:linear-gradient(to right,#141E30,#243B55);
    width:8em;height:2em;border-radius:.3em;" class="w-10 bg-dark text-light form-select" aria-label="Default select example">
        <option selected>Avoidance</option>
        <option value="0">0 Never</option>
        <option value="1">1 Occasionally</option>
        <option value="2">2 Often</option>
        <option value="3">3 Usually</option>
      </select>
    </div>
  </div> 

<button type="submit"
style=" background:linear-gradient(to right,#1FA2FF,#0d2f35 ,#155799,#12D8FA);"

class="btn btn-primary"><strong>Submit</strong></button>

            
</form>
</div>
</div>
















@include('Panel/student/footer')