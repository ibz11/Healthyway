@include('Panel/therapist/header')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hello {{auth()->user()->full_name}}.Below you can check <u>{{$user->full_name}}</u>'s progress</h1>

    <button type="button" class="m-1 show d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-appointment-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#appointmentModal">
      <i class="fas fa-book fa-sm text-white-50">
      </i> Make an appointment for this user</button>
    
      
   
    
      <a href="{{URL('studentprogresspdf',$user->id)}}" class="m-1 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
@if($latestexpdata=='no-data')
<div class="col-xl-7  col-lg-5">
    <h1 class="text-grey-900">The student has not done the test yet.Please wait until they take the LSAS test track  progress</h1>
</div>
    @else
<div class="col-xl-8  col-lg-5">
<div class="card shadow mb-4">
<div class="card-body p-5">
  
    <span class="badge bg-info text-light text-2xl p-2">Latest Diagnosis</span>
    <h1>{{$user->full_name}} Latest LSAS Test Score:<strong>  {{ $latestexpdata->LSAS_score}}  </strong></h1>
    <h1>Diagnosis(Social Anxiety): <strong>  {{ $latestexpdata->socialanxiety_level}}  </strong></h1>
    <h4>Fear Level: <strong>  {{ $latestexpdata->socialanxiety_level}}  </strong></h4>
    <h4>Avoidance Level: <strong>  {{ $latestexpdata->socialanxiety_level}}  </strong></h4>
    <h5>Test submitted at: <strong>  {{ $latestexpdata->created_at}}  </strong></h5>
    <a style="border-radius:0em;"href="{{URL('viewstudentdiagnosis',$latestexpdata->exp_id)}}" class="btn btn-outline-primary">View Recommendation</a>
    <div class="row">
  
</div>
</div>
</div>
</div>
@endif

<div class="col-xl-4  col-lg-4">
<div class="card shadow mb-4">
<div class="card-body p-5">
    <h1><strong>Expert System Data Analysis</strong></h1>

  <div style="background:whitesmoke; padding:1em;border-radius:.3em; border:1px solid black;">  
    <div class="row">
    <p class="text-dark">Number of <span class="badge bg-danger text-light">very severe</span> cases:</p> 
    <h4 class="text-dark"><strong>{{$very_severe}}</strong></h4>
    </div>

    <div class="row">
    <p class="text-dark">Number of <span class="badge bg-danger text-light">severe</span> cases:</p> 
    <h4 class="text-dark"><strong>{{$severe}}</strong></h4>
    </div>

    <div class="row">
    <p class="text-dark">Number of <span class="badge bg-warning text-light">marked</span> cases:</p> 
    <h4 class="text-dark"><strong>{{$marked}}</strong></h4>
    </div>

    <div class="row">
    <p class="text-dark">Number of <span class="badge bg-primary text-light">moderate</span> cases:</p> 
    <h4 class="text-dark"><strong>{{$moderate}}</strong></h4>
    </div>

    <div class="row">
    <p class="text-dark">Number of <span class="badge bg-info text-light">mild</span> cases:</p> 
    <h4 class="text-dark"><strong>{{$mild}}</strong></h4>
    </div>
</div>


</div>
</div>
</div>














</div>
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">

            <!-- Card Body -->
            <div class="card-body">
            <div class="chart-area">
  <canvas id="myAreaChart"></canvas>
</div>
                <!-- <div  class="chart-area" >
                    <canvas id="myAreaChart"></canvas>
                </div> -->

            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-3 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">AVERAGE LSAS SCORE</h6>


            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="d-flex justify-content-center align-center ">
                    <h1 style="font-size:200px;">{{$averageLSAS}}</h1>
                    </div>
                    
                </div>
                <!-- <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div> -->
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-5">
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">My LSAS SCORE DATA and DIAGNOSIS</h6>
                        </div>

                        @if(method_exists($expdata,'links'))
<div class="d-flex justify-content-center">
  {!! $expdata->links()!!} 
</div>
@endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Exp ID</th>
                                            <th>User ID</th>
                                            <th>Rules ID</th>
                                            <th>Recommend ID</th>
                                           
                                            <th>LSAS score</th>
                                            <th>Fear level</th>
                                            <th>Avoidance level</th>
                                            <th>Social Anxiety level</th>
                                            <th>Created at</th>
                                            <th>View</th>
                                           
                                          
                                         
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($expdata as $expdata)
                                <tr>
                                <td>{{$expdata->exp_id}}</td>
                                <td>{{$expdata->user_id}}</td>
                                <td>{{$expdata->rules_id}}</td>
                                <td>{{$expdata->recommend_id}}</td>
                                <td>{{$expdata->LSAS_score}}</td>
                                <td>{{$expdata->fear_level}}</td>
                                <td>{{$expdata->avoidance_level}}</td>

                                <td>
                                @if($expdata->socialanxiety_level=='very_severe' OR $expdata->socialanxiety_level=='severe')    
                                <span class="text-white badge bg-danger">{{$expdata->socialanxiety_level}}</span>
                                @elseif($expdata->socialanxiety_level=='marked' OR $expdata->socialanxiety_level=='moderate')
                                <span class="text-white badge bg-warning">{{$expdata->socialanxiety_level}}</span>
                                @else
                                <span class="text-white badge bg-info">{{$expdata->socialanxiety_level}}</span>
                                @endif
                                </td>


                                <td>{{$expdata->created_at}}</td>
                                <td><a style="border-radius:0em;"href="{{URL('viewstudentdiagnosis',$expdata->exp_id)}}" class="btn btn-outline-primary">View Diagnosis</a></td>
                               

                                </tr>
                                    @endforeach
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

</div>









</div>











<!-- <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script> -->





<script src="https://cdn.jsdelivr.net/npm/chart.js">

</script>

<script>
  const ctx = document.getElementById('myAreaChart');
  var Lsas = @json($LSAS_scores);
  var createdAt=@json($created_at);
  var createdAtArr=[]
  for(let i in createdAt){

    const dateObject = new Date(createdAt[i]['created_at']);
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
    // 'en-KE',
    const readableDate = dateObject.toLocaleString( options); 
    createdAtArr.push(readableDate)
   }
   console.log(createdAtArr)
  var LsasArr=[]
  
  for(let i in Lsas){
   LsasArr.push(Lsas[i]['LSAS_score'])
   }
    // console.log(LsasArr) 
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: createdAtArr,

      datasets: [{
        label: 'Social anxiety progress',
        data:  LsasArr,
        borderWidth: 3
      }]
    },
    options: {
      scales: {
        x: {
          type: 'category', 
          time: {
            unit: 'day' // You can customize the time unit based on your data
          },
          title: {
            display: true,
            text: 'Date and Time test was done' // X-axis label
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'LSAS Score' // Y-axis label
          }
        }
      }
    }
  });
</script>



@include('Panel/therapist/modal/appointmentmodal')


<!-- Datepicker script -->
<script>


$(document).ready(function() {

$('#datepicker').datepicker({
    dateFormat: "yy-mm-dd", // Set the date format
    minDate: 0,            // Minimum date (0 means today)
    maxDate: "+1W", 
    beforeShowDay: function(date) {
        var day = date.getDay();
        // Disable Sundays (0 is Sunday, 1 is Monday, and so on)
        return [day !== 0, ''];
    }       // Maximum date (1 month from today)
});

// $('#timepicker').timepicker({
//     timeFormat: 'HH:mm',
//     interval: 30,  // Set the time interval to 30 minutes
// });



});
</script>


@include('Panel/therapist/footer')