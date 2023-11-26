@include('Panel/therapist/header')




<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">STUDENT THERAPY APPLICATION</h6>
                            <p class="m-0 font-weight-bold text-primary">Note:These are the students that have chosen you as a therapist.You can accept or reject their application here</p>
                            <p class="m-0 font-weight-bold text-primary">The latest applications are the first ones displayed here</p>
                        </div>
                        <div>
@if(method_exists($choose,'links'))
<div class="d-flex justify-content-center">
  {!! $choose->links()!!} 
</div>
@endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Choose ID</th>
                                            <th>Student ID</th>
                                            <th>student_fullname</th>
                                           
                                            <th>Therapist_id(my ID)</th>
                                            <th>therapist_fullname</th>
                                            <th>Selection status</th>
                                            <th>application status</th>
                                            <th>Created at</th>
                                             <th>View progress</th>
                                            <th>Accept application</th>
                                            <th>Reject application</th>
                                            
                                      
                                           

                                           
                                          
                                         
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($choose as $choose)
                                <tr>
                                <td>{{$choose->ChooseID}}</td>
                                <td>{{$choose->student_id}}</td>
                                <td>{{$choose->student_fullname}}</td>
                               
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
                               
                                
                              
                            
       @if($choose->application_status=='accepted')                      
        <td> <a href="{{URL('viewstudent',$choose->student_id)}}" class="btn btn-outline-dark"><strong>View Progress</strong></a></td>
       @endif
        <td><a style="border-radius:0em;" href="{{URL('acceptclient',$choose->ChooseID)}}"class="btn btn-outline-success">Accept</a></td>
        <td><a style="border-radius:0em;" href="{{URL('rejectclient',$choose->ChooseID)}}"class="btn btn-outline-danger">Reject</a></td>

                                </tr>
                                
                                    @endforeach
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

</div>




@include('Panel/therapist/footer')