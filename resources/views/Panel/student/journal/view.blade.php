@include('Panel/student/header')
<!-- d-flex justify-content-center align-center -->
<div class="d-flex justify-content-center align-center">

<div>

<div class="header">  
<h1>{{$journal->title}}</h1>
<p class="text-muted">Created at {{$journal->created_at}}</p>
</div> 
<!-- class="d-flex justify-content-center align-center"  -->
<div >
<p style="font-size:2em;">{{$journal->content}}</p> 

</div>
</div>


</div>






<div style="margin-top:30em;">
@include('Panel/student/footer')
</div>

