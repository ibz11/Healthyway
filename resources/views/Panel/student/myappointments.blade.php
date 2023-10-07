@include('Panel/student/header')

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
                                           
                                            <th>Therapists_id</th>
                                            <th>status</th>
                                            <th>Rejection reason</th>
                                      
                                            <th>Created at</th>
                                            <th>Download PDF</th>
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
                                <td>{{$appointment->Therapists_id}}</td>
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
                                
                              



                                <td><a style="border-radius:0em;"href="{{URL('viewdiagnosis',$appointment->appointment_id)}}" class="btn btn-outline-dark">Download PDF</a></td>
                            
                           
                                <td><button type="button" class="show btn btn-outline-primary" data-appointment-id="{{ $appointment->appointment_id }}"data-bs-toggle="modal" data-bs-target="#staticBackdrop">View appointment</button></td>
                                <td><button type="button" class="show btn btn-outline-success" data-update-id="{{ $appointment->appointment_id }}"data-bs-toggle="modal" data-bs-target="#updateModal">Update</button></td>
                                <!-- <a style="border-radius:0em;"href="{{URL('viewdiagnosis',$appointment->appointment_id)}}" class="btn btn-outline-primary">View </a> -->
                                <td><a style="border-radius:0em;" href="{{URL('deleteappointment',$appointment->appointment_id)}}"class="btn btn-outline-danger">Delete</a></td>

                                </tr>
                                    @endforeach
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


@include('Panel/student/modals/appointmentmodal')
@include('Panel/student/modals/updateappointmentmodal')



@include('Panel/student/footer')