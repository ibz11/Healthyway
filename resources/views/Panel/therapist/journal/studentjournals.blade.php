 @include('./Panel/therapist/header') 




<div class="row">

<div class="col-xl-8">
<div class="d-sm-flex align-items-center justify-content-between  mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hello {{$userdata->full_name}}.Below you can check {{$user->full_name}}'s' journals</h1>
 
</div>
</div>



</div>

<h1 class="h3 mt-5 text-gray-800">{{$user->full_name}}'s' journals</h1>
<div class="mt-1 mb-5 row">

@foreach($journal as $journal)
@if($journal->view_content==0)







@else
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
    <a href="{{URL('viewindividualjournal',$journal->Journal_id)}}" style="height:2.5em;padding:.8em;"class="m-1 badge bg-info text-light">View journal</a>

</div>
</div>
</div>
@endif
@endforeach

<!-- End of Card 1-->





</div>

@include('Panel/therapist/footer')
