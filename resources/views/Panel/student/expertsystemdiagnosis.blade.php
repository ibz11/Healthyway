@include('Panel/student/header')
@if($diagnosis=='no-data')
<h1 class="text-gray-800"><strong>You have not taken the test yet.Please take the test to get a diagnosis</strong></h1>
@else
<div style="background:black;color:white; margin:1.5em; 
display:flex;
justify-content:center;
align-items:center;
flex-direction:row;
border:2px solid blue; border-radius:1em; padding:2em;" >
<div style="display:flex;

flex-direction:column;">
    <h4>Your latest LSAS score is</h4>
    <h1 style="font-size:6rem;"><strong>{{$diagnosis->LSAS_score}}</strong></h1>
    <h2>You are diagnosed with <strong><i>{{$diagnosis->socialanxiety_level}} social anxiety</i></strong> </h2>

    <h3>Your level of fear in different social situations is: <strong><i>{{$diagnosis->fear_level}}</i></strong></h3>
    <h3>Your level of Avoidance in different social situations is :<strong><i> {{$diagnosis->avoidance_level}}</i></strong> </h3>
   
    <div style="margin-top:1em;margin-bottom:2em;"> 
    <h4>Recommendation:</h4>
    <h5><i><strong>
     {!! nl2br(str_replace(',', ',<br>',$rec->Recommendation)) !!}   
   
   </strong>
   </i></h5>

  
    </div>
    <a href="{{URL('progress')}}" class="btn btn-danger"><strong>Check Your progress</strong></a>

</div>
</div>
@endif
<!-- <script src="/expertform/script.js" ></script> -->
@include('Panel/student/footer')