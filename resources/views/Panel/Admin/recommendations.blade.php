@include('Panel/Admin/header')



<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">EXPERT SYSTEM RECOMMENDATIONS</h6>
                            <button type="button" class="show btn btn-outline-primary text-light" data-bs-toggle="modal" data-bs-target="#createRecomendation">Create recommendation</button>
                        </div>
                        <div>
@if(method_exists($rec,'links'))
<div class="d-flex justify-content-center">
  {!! $rec->links()!!} 
</div>
@endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Recommendations ID</th>
                                            <th>Fear level</th>
                                            <th>Avoidance Level</th>
                                            <th>Recommendation</th>
                                            <th>Updated_at</th>
                                          

                                            <th>Add recommendation</th>

                                          
                                         
                                        </tr>
                                    </thead>

                                    <tbody>
                                     @foreach($rec as $rec)
                                     <tr>   
                                        <td>{{$rec->Recommendations_id}}</td>

                                        <td>
                                       @if($rec->fear_level=='high')     
                                       <span class="text-light badge bg-danger"> {{$rec->fear_level}}</span>
                                       @endif
                                       @if($rec->fear_level=='marked') 
                                       <span class="text-light badge bg-warning"> {{$rec->fear_level}}</span>
                                       @endif
                                       @if($rec->fear_level=='low') 
                                       <span class="text-light badge bg-info"> {{$rec->fear_level}}</span>
                                       @endif
                                    </td>
                                        <td>
                                        @if($rec->avoidance_level=='high') 
                                        <span class="text-light badge bg-danger">{{$rec->avoidance_level}}</span>
                                        @endif 
                                        @if($rec->avoidance_level=='marked') 
                                        <span class="text-light badge bg-warning">{{$rec->avoidance_level}}</span> 
                                        @endif
                                        @if($rec->avoidance_level=='low') 
                                        <span class="text-light badge bg-info">{{$rec->avoidance_level}}</span> 
                                        @endif
                                    </td>
                                  
                                    <td>{!! nl2br(str_replace(',', ',<br>',$rec->Recommendation)) !!}</td>
                                        <td>{{$rec->updated_at}}</td>
                                        <td><button type="button" class="show btn btn-outline-success text-light" data-recommendation-id="{{ $rec->Recommendations_id }}"data-bs-toggle="modal" data-bs-target="#recommendationModal_{{$rec->Recommendations_id }}">Update recommendation</button></td>
                                        <td><a class="btn btn-danger" href="{{URL('deleterecommendation',$rec->Recommendations_id)}}">Delete recommendation</a></td>
                                        
                                        </tr>
                                        @include('Panel/Admin/modals/recommendationmodal')
                                    @endforeach

                                    </tbody>
</table>
</div>



@include('Panel/Admin/modals/createrecommendation')



@include('Panel/Admin/footer')