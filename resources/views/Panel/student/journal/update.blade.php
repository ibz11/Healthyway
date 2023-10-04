@include('Panel/student/header')
<div class="container-form"> 

 
<form action="{{URL('updatejournal',$journal->Journal_id)}}" 
method="POST" class="expertform"id="editform"enctype="multipart/form-data">
@csrf
<h1>Update journal</h1>

<div class="m-1"style="height:8.5em;padding:.5em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Journal title</strong> </label>
<input type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$journal->title}}"  name="title">    
</div>

<div class="m-1"style="height:8.5em;padding:.5em; margin-top:0;">
<label for="date" style="margin-top:;"class=" text-light form-label"><strong>Content viewability</strong> </label>
<select  style="border:1px solid white;background:linear-gradient(to right,#141E30,#243B55);
    width:8em;height:2em;border-radius:.3em;" name="view_content"class="w-10 bg-dark text-light form-select"  aria-label="Default select example">
        
        <option value="{{$journal->view_content}}">Current option:{{$journal->view_content}}</option>
        <option value="0">0-Private</option>
        <option value="1">1-Public</option>
    
      </select>  
</div>

<div class="m-1"style="height:auto;padding:.5em; margin-top:0;">
<label for="date" name="content"style="margin-top:;"class=" text-light form-label"><strong>Content</strong> </label>
 
<textarea name="content" class="bg-dark text-light  form-control"  id="" cols="60" rows="15">
{{$journal->content}}
</textarea>  
</div>


<div class="m-1"style="height:auto;padding:.5em; margin-top:0;">
<button type="submit"
style=" background:linear-gradient(to right,#159957,#155799);"
class="btn btn-success"><strong>Update</strong></button>
</div>



</form>
</div>


<div style="margin-top:30em;">
@include('Panel/student/footer')
</div>