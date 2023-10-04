@include('Panel/therapist/header')

<div class="row">
<div class="col-xl-6">
    <div class="card text-center">
      <div class="card-body">
        <h1 class="card-title"><strong>{{$expdata->LSAS_score}}</strong></h1>
        <p><strong>LSAS SCORE</strong></p>
        <h4 class="card-text"><strong> {{$expdata->socialanxiety_level}}</i></strong> social anxiety  </h4>
       
      </div>
    </div>
  </div>

  <div class="col-xl-6">
    <div class="card">
      <div class="card-body">
        <h1>Diagnosis</h1>
        <h5 class="card-title">Student's level of Fear is :<strong> {{$expdata->fear_level}}</strong>   </h5>
        <h5 class="card-title">Student's Level of Avoidance is: <strong> {{$expdata->avoidance_level}}</strong> </h5>
        <h1>Recommendation</h1>
        <h5 class="card-title">{{$recommendation}}</h5>
      
       
      </div>
    </div>
  </div>
</div>






</div>















@include('Panel/therapist/footer')