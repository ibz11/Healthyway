@include('Panel/student/header')

@if(!$appointment and $latestapt)
<h1>No appointments have been made yet.</h1>
@else
@if($latestapt=='no-data')
<h1 class="text-gray-500">You have not made any appointments yet</h1>
@else
<div class="row">
<div class="col-xl-8  col-lg-5">
<div class="card shadow mb-4">
<div class="card-body p-5">
 
    <span class="badge bg-info text-light text-2xl p-2">Latest appointment</span>
    <h2>Appointment Date<strong>  {{ $latestapt->appointment_date}}  </strong></h2>
    <h2>Status:<strong> <span class="p-2 badge bg-dark text-light">  {{ $latestapt->status}}</span>  </strong></h2>
    <h2>AppointmentTime:<strong> <span class="p-2 badge bg-dark text-light">  {{ $latestapt->time}}</span>  </strong></h2>
    @if( $latestapt->status=="rejected")
    <h4>Rejection reason: <strong>  {{ $latestapt->rejectionreason }}  </strong></h4>
    @else

    @endif
    @if( $latestapt->location="Online")
    <h4>Online link <strong>  {{ $latestapt->onlinelink}}  </strong></h4>
    @else
    <h4>Therapist Office <strong>  {{ $latestapt->location}}  </strong></h4>
    @endif
    <h5>Appointment created at: <strong>  {{ $latestapt->created_at}}  </strong></h5>
    <button style="border-radius:0em;" type="button" class="show btn btn-outline-primary" data-appointment-id="{{ $latestapt->appointment_id }}"data-bs-toggle="modal" data-bs-target="#appointment_{{ $latestapt->appointment_id }}">View appointment</button></td>
    <button style="border-radius:0em;" type="button" class="show btn btn-outline-success" data-update-id="{{ $latestapt->appointment_id }}"data-bs-toggle="modal" data-bs-target="#updateModal_{{ $latestapt->appointment_id }}">Update</button></td>
    <a style="border-radius:0em;" href="{{URL('deleteappointment',$latestapt->appointment_id)}}"class="btn btn-outline-danger">Delete</a>

   
  
</div>
</div>
</div>
</div>
@endif
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">MY APPOINTMENTS</h6>
                        </div>
                        <div>

                       




@if(method_exists($appointment,'links'))
<div class="d-flex justify-content-center">
  {!! $appointment->links()!!} 
</div>
@endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>User ID</th>
                                            <th>Time</th>
                                            <th>Location</th>
                                            <th>Online link</th>
                                            <th>Email</th>
                                            <th>Therapists_id</th>
                                            <th>Issue</th>
                                            <th>status</th>
                                            <th>Rejection reason</th>
                                      
                                            <th>Created at</th>
                                            <!-- <th>Download PDF</th> -->
                                            <th>View</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                          
                                         
                                        </tr>
                                    </thead>

                                    <tbody>
                                @foreach($appointment as $appointment)
                                <tr>
                                <td>{{$appointment->appointment_id}}</td>
                                <td>{{$appointment->user_id}}</td>
                                <td>{{$appointment->time}}</td>
                                <td>    
                                @if($appointment->location=='Online')
                                <span class="text-light badge bg-info">Online</>
                                @else
                                {{$appointment->location}}
                                @endif
                            </td>
                            @if(!$appointment->onlinelink=='')
                          <td>{{$appointment->onlinelink}}</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{$appointment->student_email}}</td>
                                <td>{{$appointment->Therapists_id}}</td>
                                <td>{{$appointment->issue}}</td>
                                <td>
                                @if($appointment->status=='accepted')
                                <span class="text-light badge bg-success">accepted</span>
                                @endif
                                @if($appointment->status=='rejected')
                                <span class="text-light badge bg-danger">rejected</span>
                                @endif
                                @if($appointment->status=='pending')
                                <span class="text-light badge bg-info">pending</span>
                                @endif
                                </td>
                                @if($appointment->status=='rejected')
                                <td>{{$appointment->rejectionreason}}</td>
                                @endif
                                @if($appointment->status=='accepted')
                                <td>None</td>
                                @endif
                                @if($appointment->status=='pending')
                                <td>None</td>
                                @endif
                                <td>{{$appointment->created_at}}</td>
                                
                              


                                @if($appointment->status=='accepted')
                                <!-- <td><a style="border-radius:0em;"href="{{URL('viewdiagnosis',$appointment->appointment_id)}}" class="btn btn-outline-dark">Download PDF</a></td> -->
                                @else
                                
                                @endif
                               
                            
                           
                                <td><button type="button" class="show btn btn-outline-primary" data-appointment-id="{{ $appointment->appointment_id }}"data-bs-toggle="modal" data-bs-target="#appointment_{{ $appointment->appointment_id }}">View appointment</button></td>
                                <td><button type="button" class="show btn btn-outline-success" data-update-id="{{ $appointment->appointment_id }}"data-bs-toggle="modal" data-bs-target="#updateModal_{{ $appointment->appointment_id }}">Update</button></td>
                                <!-- <a style="border-radius:0em;"href="{{URL('viewdiagnosis',$appointment->appointment_id)}}" class="btn btn-outline-primary">View </a> -->
                                <td><a style="border-radius:0em;" href="{{URL('deleteappointment',$appointment->appointment_id)}}"class="btn btn-outline-danger">Delete</a></td>

                                </tr>
                                @include('Panel/student/modals/appointmentmodal')
                               @include('Panel/student/modals/updateappointmentmodal')
                                    @endforeach
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>






@include('Panel/student/footer')