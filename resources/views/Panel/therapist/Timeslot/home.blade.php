@include('Panel/therapist/header')



<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">My Timeslots </h6>
                            <p class="m-0 font-weight-bold text-primary">These  are your timeslots that will be booked by the students seeking therapy sessions</p>
                            <p class="m-0 font-weight-bold text-primary">You can set these are any time and interval that you want.</p>
                            <a href="{{URL('createtimeslot')}}" class="btn btn-primary">Create timeslot</a>
                        </div>
                        <div>


<div class="card-body">  
@if($times=='no-data')
<h4>You can not created timeslots yet.<br>
Please create by click the 'create timeslot' button above</h4>
@else

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Time ID</th>
                                            <th>Therapist ID(Your login ID)</th>
                                            <th>Time Slot</th>
                                            <th>Update</th>
                                            <th>Delete</th>

                                            </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($times as $times)
                                        <tr>
                                        <td><strong>{{$times->time_id}}</strong></td>
                                        <td><strong>{{$times->therapist_id}}</strong></td>
                                        <td><strong>{{$times->timeslot}}</strong></td>
                                      
                                        <td><a href="{{URL('updatetimeslot',$times->time_id)}}" class="btn btn-success">Update</a></td>
                                        <td><a href="{{URL('deletetimeslot',$times->time_id)}}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                        @endforeach
                                   </tbody>
                                </table>
                               </div>

</div>
@endif




@include('Panel/therapist/footer')