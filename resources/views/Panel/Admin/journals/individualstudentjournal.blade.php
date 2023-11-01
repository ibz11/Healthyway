@include('Panel/admin/header')


<div class="col-xl-8">
<div class="d-sm-flex align-items-center justify-content-between  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hello {{$userdata->full_name}}.Below you can check {{$user->full_name}}'s journals</h1>
 <!-- <p>Note:if you can't see any journals that means you havent approved a students applications for private therapy consultation</p> -->
</div>
</div>

@if(method_exists($journal,'links'))
<div class="d-flex justify-content-center">
  {!! $journal->links()!!} 
</div>
@endif


<div class="card-body">
    <h1>{{$user->full_name}}'s journals</h1>
    <div class="col-xl-12">
<a href="{{URL('adminpublicjournal',$user->id)}}" class="m-1  btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-check fa-sm text-white-50"></i> Make All journals public</a>

<a href="{{URL('adminprivatejournal',$user->id)}}" class="m-1 btn btn-sm btn-warning shadow-sm"><i
            class="fas fa-stop fa-sm text-white-50"></i> Make All journals private</a>
</div>



<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<thead>
   <tr>
   <th> Journal ID</th>
   <th> Student ID</th>
   <th>Title</th>
   <th>Content Viewability</th>
   <th>Content</th>
   <th>Created At</th>
   <th>View Journal</th>
   <th>Make Private </th>
   <th>Update</th>
   <th>Delete</th>
   
 
   </tr>   
</thead>
<tbody>
@foreach($journal as $journal) 
    <tr>
    
    <td>{{$journal->Journal_id}}</td>
    <td>{{$journal->user_id}}</td>
    <td>{{$journal->title}}</td>

    @if($journal->view_content==1)
    <td><span class="badge bg-danger">Public</span></td>
    @endif

    @if($journal->view_content==0)
    <td><span class="badge bg-info">Private</span></td>
    @endif
    <td>{{$journal->content}}</td>
    <td>{{$journal->created_at}}</td>
    @if($journal->view_content==1)
    <td><button type="button" class="show btn btn-outline-primary text-light" data-bs-toggle="modal" data-bs-target="#journalModal_{{  $journal->Journal_id }}">View Journal</button></td>
   @endif
    @if($journal->view_content==1)
    <td><a href="{{URL('adminprivateselectjournal',$journal->Journal_id)}}"style="padding:.2em;"  class="m-1 btn btn-outline-primary ">Make private</a></td>
     @endif
    @if($journal->view_content==0)
    <td><a href="{{URL('adminpublicselectjournal',$journal->Journal_id)}}"style="padding:.2em;"  class="m-1 btn btn-outline-warning ">Make public</a></td>
    @endif

    <td><a class="btn btn-success"href="{{URL('adminupdatejournal',$journal->Journal_id)}}">Update</a></td>
    <td><a class="btn btn-danger"href="{{URL('admindeletejournal',$journal->Journal_id)}}">Delete</a></td>
   
    </tr>
    @include('Panel/Admin/journals/journalmodal') 
    @endforeach
</tbody>
</table>

</div>
</div>















@include('Panel/admin/footer')