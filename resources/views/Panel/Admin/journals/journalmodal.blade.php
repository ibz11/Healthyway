<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="journalModal_{{  $journal->Journal_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Journal ID: {{ $journal->journal_id }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">



<h1 class="mt-4 text-2xl"><strong>Title: {{$journal->title}}</strong></h1>  

<h5 class="text-dark">User ID:{{$journal->user_id}} </h5>


<div class="mb-0 mt-3">
@if($journal->view_content==1)
    <span class="badge bg-danger">Public</span>
    @endif

    @if($journal->view_content==0)
    <span class="badge bg-info">Private</span>
    @endif
</div>


<div class="mb-0 mt-3">
<h5 class="text-dark">Content:</h5>
<p>{{$journal->content}}</p>
</div>


<div class="mb-3 mt-3">
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Show modal when a button is clicked
        $('.show').on('click', function() {
            var itemId = $(this).data('journal-id');

            // Make an AJAX request to fetch item details based on the ID
            $.ajax({
                url: '/getadminjournal/' + itemId, // Replace with the actual route
                method: 'GET',
                success: function(data) {
                    // Assuming you have a modal with the ID "item-modal"
                    $('#staticBackdrop .modal-body').html(data);
                    $('#staticBackdrop').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
