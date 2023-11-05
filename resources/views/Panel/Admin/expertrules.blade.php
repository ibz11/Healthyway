@include('Panel/Admin/header')

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">EXPERT SYSTEM RULES</h6>
                            <!-- <button type="button" class="show btn btn-outline-primary text-light" data-bs-toggle="modal" data-bs-target="#createRecomendation">Create Rule</button> -->
                        <p class="text-gray-800">
   The Liebowitz Social Anxiety Scoring Scale<br>
    0-29 You do not suffer from social
    anxiety<br>
    30-49 Mild social anxiety<br>
    50-64 Moderate social anxiety<br>
    65-79 Marked social anxiety<br>
    80-94 Severe social anxiety<br>
    >=95   Very severe social anxiety</p>
                        </div>
                        <div>
@if(method_exists($rules,'links'))
<div class="d-flex justify-content-center">
  {!! $rules->links()!!} 
</div>
@endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Rules ID</th>
                                            <th>Score_range</th>
                                            <th>Social anxiety Level</th>
                                            <!-- <th>Created At</th>
                                            <th>Update</th>
                                            <th>Delete</th> -->

                                          
                                         
                                        </tr>
                                    </thead>

                                    <tbody>
                                     @foreach($rules as $rules)
                                     <tr>
                                        <td>{{$rules->Rule_id}}</td>
                                        <td>{{$rules->score_range}}</td>
                                        <td>{{$rules->socialanxiety_level}}</td>
                                        <!-- <td>{{$rules->created_at}}</td>
                                        <td></td>
                                        <td></td> --> 
</tr>
@endforeach
</tbody>
</table>
</div>












@include('Panel/Admin/footer')