<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="createuserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div style="display:flex;flex-direction:column;">

        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create User </h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<form action="{{URL('createuser')}}" method="POST" id="editform"enctype="multipart/form-data">
@csrf

<h1 class="mt-4 text-2xl"><strong>Create a new user</strong></h1>  









<div class="mb-0 mt-3">
<label for="email" class="form-label">Full name</label>
<input  type="text" class=" form-control w-50" id="phone" value="" placeholder="" name="full_name" required>
</div>

<div  class="mb-3 mt-3">
<label for="email" class="form-label">Phone number</label>
<input  type="number" class=" form-control w-50" id="phone" value="" placeholder="" name="phone" >
</div>

<div   class="mb-3 mt-3">
<label for="email" class="form-label">Email</label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class=" text-danger form-text"><strong>@error('email') {{$message}} @enderror</strong></div>
<input  type="email" class="form-control w-50" id="phone" value=""  name="email" required>
</div>



<div   class="mb-3 mt-3">
<label for="password" class="form-label">Password</label>
<div id="emailHelp" style="border-radius:.3em;background:#f5cac3; color:#d00000;"class="m-1 text-danger form-text"></div>
<input  type="password" class="form-control w-50" value=""  name="password" required>
</div>

<!-- 
<div class="mb-3 mt-3">
<label for="email" class="form-label">Appointment time</label>
<p class="text-danger">Nb:Write in am pm format</p>
<input type="time" class="form-control w-50" id="email"  name="time" required>
</div> -->

<div class="mb-0 mt-3">
<label for="email" class="form-label">Role of the created</label>
<p class="text-danger">Nb:By default if not chosen it will register as a student</p>
</div>
<div class="mb-3 mt-3">

<select  class="form-control block mt-1 w-50" name="role" >
<option value="admin" >
Admin
</option>
<option value="therapist" >
Therapist
</option>

<option value="student" >
Student
</option>
</select>

</div>














<div class="mb-3 mt-3">
<button class="text-light btn btn-primary "type="submit">Create User</button>
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
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
</script> -->
