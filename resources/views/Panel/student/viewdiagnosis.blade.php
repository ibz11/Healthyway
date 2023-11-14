@include('Panel/student/header')

<div class="row">
<div class="col-xl-6">
    <div class="card text-center">
      <div class="card-body">
        <h1 class="card-title"><strong>{{$expdata->LSAS_score}}</strong></h1>
        <p><strong>LSAS SCORE</strong></p>
        <h4 class="card-text">Social Anxiety Level: <strong><i> {{$expdata->socialanxiety_level}}</i></strong>   </h4>
       
      </div>
    </div>
  </div>

  <div class="col-xl-6">
    <div class="card">
      <div class="card-body">
        <h1>Diagnosis</h1>
        <h5 class="card-title">Your level of Fear is :<strong> {{$expdata->fear_level}}</strong>   </h5>
        <h5 class="card-title">Your Level of Avoidance is: <strong> {{$expdata->avoidance_level}}</strong> </h5>
        <h1>Recommendation</h1>
        <h5 class="card-title">
        {!! nl2br(str_replace(',', ',<br>',$recommendation)) !!}
         </h5>
      
       
      </div>
    </div>
  </div>
</div>






</div>















@include('Panel/student/footer')