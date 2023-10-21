@include('Panel/therapist/header')








<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">MY INBOX </h6>
                            <p class="m-0 font-weight-bold text-primary">The latest notifications are displayed here</p>
                        </div>
                        <div>
@if(method_exists($not,'links'))
<div class="d-flex justify-content-center">
  {!! $not->links()!!} 
</div>
@endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Not ID</th>
                                            <th>Student ID</th>
                                            <th>Therapist ID</th>
                                            <th>Student Fullname</th>
                                            <th>Mark_read status</th>
                                            <th>Diagnosis</th>
                                            <th>LSAS score</th>
                                            <th>message</th>
                                            <th>Sent at</th>
                                            <th>View student's progress</th>
                                            <th>Mark as read</th>
                                            <th>Delete</th>
                                      
                                            
                                          
                                         
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                   @foreach($not as $not)
                                   @if($not->Mark_read=='read')
                                   <td><strong>{{$not->NotID}}</strong></td>
                                     <td style="text-decoration: line-through;"><strong>{{$not->student_id}}</strong></td>
                                     <td style="text-decoration: line-through;"><strong>{{$not->therapist_id}}</strong></td>
                                     <td style="text-decoration: line-through;"><strong>{{$not->student_fullname}}</strong></td>
                                     <td >
                                        @if($not->Mark_read=='read')
                                        <span class="badge bg-primary">{{$not->Mark_read}}</span>
                                        @else
                                        <span class="badge bg-warning">{{$not->Mark_read}}</span>
                                        @endif
                                    </td>
                                   
                                     <td style="text-decoration: line-through;"><strong>{{$not->diagnosis}}</strong></td>
                                     <td style="text-decoration: line-through;"><strong>{{$not->LSAS_score}}</strong></td>
                                     <td style="text-decoration: line-through;"><strong>{{$not->message}}</strong></td>
                                     <td style="text-decoration: line-through;"><strong>{{$not->created_at}}</strong></td>
                                     <td > <a href="{{URL('viewstudent',$not->student_id)}}" class="btn btn-outline-dark"><strong>View Progress</strong></a></td>
                                     @if($not->Mark_read=='unread')
                                     <td> <a href="{{URL('markread',$not->NotID)}}" class="btn btn-outline-primary"><strong>Mark as read</strong></a></td>
                                     @else
                                     <td> <a href="{{URL('markunread',$not->NotID)}}" class="btn btn-outline-warning"><strong>Mark as unread</strong></a></td>
                                     @endif
                                     <td> <a href="{{URL('deletenotification',$not->NotID)}}" class="btn btn-outline-danger"><strong>Delete Message</strong></a></td>
                                    @else
                                     <td>{{$not->NotID}}</td>
                                     <td>{{$not->student_id}}</td>
                                     <td>{{$not->therapist_id}}</td>
                                     <td>{{$not->student_fullname}}</td>
                                     <td>
                                        @if($not->Mark_read=='read')
                                        <span class="badge bg-primary">{{$not->Mark_read}}</span>
                                        @else
                                        <span class="badge bg-warning">{{$not->Mark_read}}</span>
                                        @endif
                                    </td>
                                   
                                     <td><strong>{{$not->diagnosis}}</strong></td>
                                     <td><strong>{{$not->LSAS_score}}</strong></td>
                                     <td><strong>{{$not->message}}</strong></td>
                                     <td><strong>{{$not->created_at}}</strong></td>
                                     <td> <a href="{{URL('viewstudent',$not->student_id)}}" class="btn btn-outline-dark"><strong>View Progress</strong></a></td>

                                     @if($not->Mark_read=='unread')
                                     <td> <a href="{{URL('markread',$not->NotID)}}" class="btn btn-outline-primary"><strong>Mark as read</strong></a></td>
                                     @else
                                     <td> <a href="{{URL('markunread',$not->NotID)}}" class="btn btn-outline-warning"><strong>Mark as unread</strong></a></td>
                                     @endif


                                     <td> <a href="{{URL('deletenotification',$not->NotID)}}" class="btn btn-outline-danger"><strong>Delete Message</strong></a></td>
                                     @endif
                                     </tbody>
                                     @endforeach
                                    
                                    

                                </table>
                            </div>
                        </div>
                    </div>

</div>



@include('Panel/therapist/footer')