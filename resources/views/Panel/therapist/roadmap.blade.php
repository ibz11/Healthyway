<div>
<button style="margin:1em;padding:.8em; border-radius:0;"class="btn btn-info" id="toggleBtn">Show  Therapist roadmap</button>
</div>
<!-- <div id="toggle"> -->

<div id="timeline"class="timeline">
  <h2 style="color:white;">Follow this roadmap once you create an account</h2>
  <div class="outer-rd">
  
    <div class="card-rd">
      <div class="info-rd">
        <h3 class="title-rd">1. Create a therapist profile</h3>
        <p>You must create a therapist profile inorder to interact with the students and it must be approved by the Administrator.</p>
        <a class="btn btn-primary" style="border-radius:0;"href="{{URL('therapistprofile')}}">Create a therapist profile</a>
      </div>
    </div>
    <div class="card-rd">
      <div class="info-rd">
        <h3 class="title-rd">2. Create timeslots</h3>
        <p>After your profile has been approved.You can create timeslots that the students will pick to book an appointment with you. </p>
        <a class="btn btn-primary" style="border-radius:0;" href="{{URL('timeslotspage')}}">Create timeslots</a>
      </div>
    </div>
    <div class="card-rd">
      <div class="info-rd">
        <h3 class="title-rd">3. Therapy services applications</h3>
        <p>Here you can approve or reject students that have requested for your therapy services applications</p>
        <a class="btn btn-primary" style="border-radius:0;" href="{{URL('mystudents')}}">View students applications</a>
    </div>
    </div>
  
    <div class="card-rd">
      <div class="info-rd">
        <h3 class="title-rd">4. Progress</h3>
        <p> After approving students applications you can view their progress as they take the LSAS test</p>
        <a class="btn btn-primary" style="border-radius:0;" href="{{URL('studentprogress')}}">View students Progress</a>
      </div>
    </div>




    <div class="card-rd">
      <div class="info-rd">
        <h3 class="title-rd">5. Journals</h3>
        <p> After approving students applications you can view their journals that are public .</p>
       
        <a class="btn btn-primary" style="border-radius:0;" href="{{URL('viewstudentjournals')}}">View students Journals</a>
      </div>
    </div>

    <div class="card-rd">
      <div class="info-rd">
        <h3 class="title-rd">6. Appointments</h3>
        <p>You can approve or reject appointments that the students make</p>
        <a class="btn btn-primary" style="border-radius:0;" href="{{URL('viewstudentappointments')}}">View appointments</a>
      </div>
    </div>


  </div>
</div>