@include('Panel/admin/header')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hello {{$userdata->full_name}}.Here you can view all the Therapist's timeslots </h1><br>
   
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
<!-- <p>Note:if you can't see any journals that means you havent approved a students applications for private therapy consultation</p> -->

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    @foreach($therapist as $therapist)
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h3>Therapist ID:{{$therapist->user_id}}</h3>  <h3>{{$therapist->Full_name}}</h3></div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">LSAS Average :<span style="color:blue;">54</span></div> -->
                        <!-- <div><span class="badge bg-danger text-light">High risk</span></div>
                        <div><span class="badge bg-warning text-light">Moderate risk</span></div>
                        <div><span class="badge bg-info text-light">Low risk</span></div> -->
                        <div><a href="{{URL('admintimeslotspage',$therapist->user_id)}}" class="btn btn-outline-primary"><strong>View {{$therapist->Full_name}}'s Timeslots</strong></a>  </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

</div>

@include('Panel/admin/footer')