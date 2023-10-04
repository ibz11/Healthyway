@include('Panel/student/header')


<div class="row">

<div class="col-xl-8">
<div class="d-sm-flex align-items-center justify-content-between  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hello {{$userdata->full_name}}.Below you can check and create journals</h1>
 
</div>
</div>

<div class="col-xl-12">
<a href="{{URL('publicjournal')}}" class="m-1  btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-check fa-sm text-white-50"></i> Make All journals public</a>

<a href="{{URL('privatejournal')}}" class="m-1 btn btn-sm btn-warning shadow-sm"><i
            class="fas fa-stop fa-sm text-white-50"></i> Make All journals private</a>

<a href="{{URL('createjournal')}}" class="m-1 btn btn-sm btn-info shadow-sm"><i
            class="fas fa-pen fa-sm text-white-50"></i> Create Journal</a>
</div>

</div>

<h1 class="h3 mt-5 text-gray-800">Your  journals</h1>
<div class="mt-1 mb-5 row">
@foreach($journal as $journal)
<!-- Card 1 -->
<div  class="col-xl-3">
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">{{$journal->title}}</h5>
    <p class="card-subtitle mb-2 text-muted"><i>Created at {{$journal->created_at}}</i></p>
    @if($journal->view_content==1)
    <span class="badge bg-danger text-light">public</span>
    @endif
    @if($journal->view_content==0)
    <span class="badge bg-primary text-light">private</span>
    @endif
    <p class="card-text">{{ Str::limit($journal->content, 15) }}</p>
    <a href="{{URL('viewjournal',$journal->Journal_id)}}" style="height:2.5em;padding:.8em;"class="m-1 badge bg-info text-light">View journal</a>
    <a href="{{URL('updatejournal',$journal->Journal_id)}}" style="height:2.5em;padding:.8em;" class="m-1 badge bg-success text-light">Update journal</a>
    <a href="{{URL('deletejournal',$journal->Journal_id)}}"style="height:2.5em;padding:.8em;"  class="m-1 badge bg-danger text-light">Delete journal</a>
    @if($journal->view_content==1)
    <a href="{{URL('privateselectjournal',$journal->Journal_id)}}"style="height:2.5em;padding:.8em;"  class="m-1 badge bg-primary text-light">Make private</a>
     @endif
    @if($journal->view_content==0)
    <a href="{{URL('publicselectjournal',$journal->Journal_id)}}"style="height:2.5em;padding:.8em;"  class="m-1 badge bg-warning text-light">Make public</a>
    @endif
</div>
</div>
</div>

@endforeach
<!-- End of Card 1-->





</div>

























@include('Panel/student/footer')