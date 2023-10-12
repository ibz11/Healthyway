<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="updateModal_{{ $appointment->appointment_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment ID {{ $appointment->appointment_id }}</h1>
      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5 class="modal-title fs-5" id="staticBackdropLabel">Appointment Date {{ $appointment->appointment_date }}</h5>
      <form action="{{URL('updateappointment',$appointment->appointment_id )}}" method="POST" id="editform"enctype="multipart/form-data">
@csrf

<h1 class="mt-4 text-2xl"><strong>Update appointment</strong></h1>  
<p class="text-danger">Note: be mindful of the date and time,it should be at a <u><strong>reasonable</strong></u> time and date </p>

<div hidden class="mb-3 mt-3">
<label for="email" class="form-label">Therapist ID</label>

<input readonly type="text" class="datepicker form-control w-50" id="phone" value="{{$appointment->Therapists_id}}"  name="Therapists_id" required>
</div>

<div   class="mb-3 mt-3">
<label for="email" class="form-label">Date</label>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('appointment_date') {{$message}} @enderror</strong></div>

<input  type="date" class="datepicker form-control w-50" id="phone" value="{{$appointment->appointment_date}}"  name="appointment_date" required>
</div>





<div class="mb-3 mt-3">
<p class="text-danger">Nb: Time in and time out should be less than or equal to 2 hours</p>
</div>
<div class="mb-3 mt-3">
<label for="email" class="form-label">Appointment time</label>

<p class="text-danger">Nb:Write in am pm format</p>

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('time') {{$message}} @enderror</strong></div>

<input type="time" class="form-control w-50" id="email" value="{{$appointment->time}}"  name="time" required>
</div>

<div class="mb-0 mt-3">
<label for="email" class="form-label">Issue that I am dealing with</label>
</div>
<div class="mb-3 mt-3">

<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text">
<strong>@error('location') {{$message}} @enderror</strong></div>

<textarea name="issue"  cols="30" rows="10">
{{$appointment->issue}}
</textarea>
</div>
<div class="mb-0 mt-3">
<label for="email" class="form-label">Venue</label>
</div>
<div class="mb-3 mt-3">
<select id="qualifications"  class="form-control block mt-1 w-50" name="location" >
<option value="{{$appointment->location}}" >
Current choice:{{$appointment->location}}
</option>
<option value="Online" >
Online
</option>
@foreach($location as $location)
@if($location->user_id === $appointment->Therapists_id)
<option value="{{$location->Location}}" >
Therapist's office: {{$location->Location}}
</option>
@endif
@endforeach



</select>
</div>
<div class="mb-3 mt-3">
<button class="text-light btn btn-success "type="submit">Update</button>
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
            var itemId = $(this).data('data-update-id');

            // Make an AJAX request to fetch item details based on the ID
            $.ajax({
                url: '/updateappointment/' + itemId, // Replace with the actual route
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
