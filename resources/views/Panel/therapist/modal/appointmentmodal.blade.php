<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="appointmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div style="display:flex;flex-direction:column;">
      <h1 class="modal-title fs-5" id="staticBackdropLabel">User ID:{{$user->id}} </h1> </br>
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Student Full Name:{{$user->full_name}}  </h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="{{URL('appointmentcreate' )}}" method="POST" id="editform"enctype="multipart/form-data">
@csrf

<h1 class="mt-4 text-2xl"><strong>Make an appointment for this Student</strong></h1>  









<div class="mb-0 mt-3">
<label for="email" class="form-label">Online meeting link</label>
<p class="text-primary">Note: You can give an online meeting link if the location is online</p>
</div>

<div  class="mb-3 mt-3">
<label for="email" class="form-label">Therapist ID (Your user id)</label>
<input readonly type="text" class=" form-control w-50" id="phone" value="{{Auth::user()->id}}" placeholder="{{Auth::user()->id}}" name="Therapists_id" required>
</div>

<div   class="mb-3 mt-3">
<label for="email" class="form-label">Student ID</label>
<input readonly type="text" class="form-control w-50" id="phone" value="{{$user->id}}"  name="user_id" required>
</div>


<div   class="mb-3 mt-3">
<label for="email" class="form-label">Email</label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text"></div>
<input  type="text" class="form-control w-75" value="{{$user->email}}"  name="student_email" required>
</div>

<div   class="mb-3 mt-3">
<label for="email" class="form-label">Date</label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text"></div>
<input  type="date" class="datepicker form-control w-50" value=""  name="appointment_date" required>
</div>


<div class="mb-3 mt-3">
<label for="email" class="form-label">Appointment time</label>
<p class="text-danger">Nb:Write in am pm format</p>
<input type="time" class="form-control w-50" id="email"  name="time" required>
</div>

<div class="mb-0 mt-3">
<label for="email" class="form-label">Venue</label>
</div>
<div class="mb-3 mt-3">
<select  class="form-control block mt-1 w-50" name="location" >
<option value="Online" >
Online
</option>
<option value="{{$location}}" >
My Office : {{$location}}
</option>
</select>

</div>

<div class="mb-3 mt-3">
<label>Provide Online Link meeting if its online</label>

<textarea name="onlinelink"  cols="30" rows="10">
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
