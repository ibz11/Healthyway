<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="appointment_{{ $appointment->appointment_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">My Appointment {{ $appointment->appointment_date }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Appointment ID:{{ $appointment->appointment_id }}</p>
      <p>User ID:{{ $appointment->user_id }}</p>
      <p>Time:{{ $appointment->time }}</p>
      <p>Appointment Date:{{ $appointment->appointment_date }}</p>
      <p>Location:{{ $appointment->location }}</p>
        @if($appointment->status=='accepted')
        @if(!$appointment->onlinelink==null)
            <p>Online link: {{$appointment->onlinelink}}</p>
            @else
            <p></p>
            @endif
       status: <span class="text-light badge bg-success">accepted</span>
        @endif
        @if($appointment->status=='rejected')
        Status:  <span class="text-light badge bg-danger">rejected</span>
        @endif
        @if($appointment->status=='pending')
        status: <span class="text-light badge bg-info">pending</span>
        @endif
    @if($appointment->status=='rejected')
      <p>Rejection reason:{{ $appointment->rejectionreason }}</p>
    @else
    @endif


      <p>Created At:{{ $appointment->created_at }}</p>
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
            var itemId = $(this).data('data-appointment-id');

            // Make an AJAX request to fetch item details based on the ID
            $.ajax({
                url: '/viewappointment/' + itemId, // Replace with the actual route
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
