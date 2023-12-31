<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="onlineModal__{{ $appointment->appointment_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment ID: {{ $appointment->appointment_id }}</h1> <br><br>
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Date: {{ $appointment->appointment_date }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="{{URL('modalonline',$appointment->appointment_id )}}" method="POST" id="editform"enctype="multipart/form-data">
@csrf

<h1 class="mt-4 text-2xl"><strong>Give an online link meeting if its online</strong></h1>  


<!-- <div hidden class="mb-3 mt-3">
<label for="email" class="form-label">Therapist ID</label>

<input readonly type="text" class="datepicker form-control w-50" id="phone" value="{{$appointment->Therapists_id}}"  name="Therapists_id" required>
</div> -->






<div class="mb-0 mt-3">
<label for="email" class="form-label">Online meeting link</label>
<p class="text-primary">Note: You can give an online meeting link if the location is online</p>
</div>
<div class="mb-3 mt-3">

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('onlinelink') {{$message}} @enderror</strong></div>

<textarea name="onlinelink"  cols="30" rows="10">
{{$appointment->onlinelink}}
</textarea>
</div>

<div class="mb-3 mt-3">
<button class="text-light btn btn-primary "type="submit">Submit</button>
</div>
</form>

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
            var itemId = $(this).data('data-online-id');

            // Make an AJAX request to fetch item details based on the ID
            $.ajax({
                url: '/modalrejection/' + itemId, // Replace with the actual route
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
