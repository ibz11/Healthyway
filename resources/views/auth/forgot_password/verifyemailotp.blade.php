<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VerifyPasswordToken</title>
    <link rel="stylesheet" href="./auth/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
   
<div class="div-center">

<form class="auth-form" action="{{url('verifyforgotToken')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<h1>{{$title}}</h1>
</div>




@if(Session::has('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Type your OTP sent to your email </label>
 
    <input type="text" name="resettoken"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
 
  </div>
  <div class="mb-3">
  <!-- @if ($expire > 0)
    <p class="text-danger">Password reset token will expire in {{ $expire }} {{ Str::plural('minute', $expire) }}</p>
    time now {{$now}}<br>
    time expire {{$tokenExpirationTimestamp}} 
@else
    <p class="text-danger">Password reset token has expired.</p>
@endif
  </div>

  <div id="timer3">
  @if ($expire > 0)
    <p class="text-danger">Password reset token will expire in <span id="timer-minutes">{{ $expire }}</span> minutes.</p>
    @else
    <p class="text-danger">Password reset token has expired.</p>
@endif
</div> -->






<div class="mb-3 form-check">
<button type="submit" class="auth-btn btn btn-outline-dark">Verify Token</button>
</div>

</form>
</div>
 
<!-- <div id="timer">
    Password reset token will expire in <span id="minutes"></span> minutes
    and <span id="seconds"></span> seconds.
</div>

<script>
    var minutesElement = document.getElementById('minutes');
    var secondsElement = document.getElementById('seconds');

    var tokenExpirationTimestamp = "{{ $expire }}";
    var countdownInterval;

    function updateTimer() {
        var now = new Date();
        var expirationTime = new Date(tokenExpirationTimestamp);
        var timeRemaining = Math.max(0, Math.floor((expirationTime - now) / 1000)); // Calculate remaining seconds

        var minutes = Math.floor(timeRemaining / 60);
        var seconds = timeRemaining % 60;

        minutesElement.innerText = minutes;
        secondsElement.innerText = seconds < 10 ? '0' + seconds : seconds;

        if (timeRemaining <= 0) {
            clearInterval(countdownInterval);
        }
    }

    // Start the timer countdown
    countdownInterval = setInterval(updateTimer, 1000);
    updateTimer(); // Initial timer update
</script>
 -->


</body>
</html>