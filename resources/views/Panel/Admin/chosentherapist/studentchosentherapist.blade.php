@include('Panel/admin/header')

@if($choose=='no-data')
<h1 class="text-gray-700">This student has not selected a therapist yet</h1>
@else


@if(method_exists($choose,'links'))
<div class="d-flex justify-content-center">
  {!! $choose->links()!!} 
</div>
@endif
<h6 class="text-gray-700"><strong>Note:If you cannot see any data that means the student has not selected a therapist yet</strong></h6>
<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Choose ID</th>
                                            <th>Student ID</th>
                                            <th>Profile ID</th>
                                            <th>Therapist ID</th>
                                            <th>Therapist Fullname</th>
                                          
                                           
                                           
                                            <!-- <th>Issue</th> -->
                                            <th>selection status</th>
                                            <th>application status</th>
                                            <!-- <th></th> -->
                                      
                                            <th>Created at</th>
                                            <!-- <th>Download PDF</th> -->
                                            <th>View Chosen therapist profile</th>
                                            <th>Accept application</th>
                                            <th>Reject application</th>
                                            <th>Delete</th>
                                          
                                         
                                        </tr>
                                    </thead>

                                    <tbody>
                                @foreach($choose as $choose)
                                <tr>
                                <td>{{$choose->ChooseID}}</td>
                                <td>{{$choose->student_id}}</td>
                                <td>{{$choose->profile_id}}</td>
                                <td>{{$choose->therapist_id}}</td>
                                <td>{{$choose->therapist_fullname}}</td>
                                <td>
                                @if($choose->selection_status=='deselected')
                               <span class="text-light badge bg-warning">{{$choose->selection_status}}</span>
                               @else
                               <span class="text-light badge bg-success">{{$choose->selection_status}}</span>
                                @endif
                                </td>

                                <td>
                                @if($choose->application_status=='accepted')
                                <span class="text-light badge bg-success">{{$choose->application_status}}</span>
                                @endif
                                @if($choose->application_status=='rejected')
                                <span class="text-light badge bg-danger">{{$choose->application_status}}</span>
                                @endif
                                @if($choose->application_status=='pending')
                                <span class="text-light badge bg-info">{{$choose->application_status}}</span>
                                @endif
                                </td>
                               <td>{{$choose->created_at}}</td>
                               
                               <td><a class="btn btn-dark"href="{{URL('viewtherapistprofile',$choose->profile_id)}}">View therapist profile</a></td>
                               <td><a style="border-radius:0em;" href="{{URL('adminacceptapplication',$choose->ChooseID)}}"class="btn btn-outline-success">Accept</a></td>
                              <td><a style="border-radius:0em;" href="{{URL('adminrejectapplication',$choose->ChooseID)}}"class="btn btn-outline-danger">Reject</a></td>
                               <td><a class="btn btn-danger"href="{{URL('admindeletetherapistapplication',$choose->ChooseID)}}">Delete</a></td>
                               <td></td>
                            </tr>  
                                @endforeach
                                </tbody>  
</table>
</div> 
@endif









@include('Panel/admin/footer')