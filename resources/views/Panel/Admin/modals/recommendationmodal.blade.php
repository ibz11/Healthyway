<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="recommendationModal_{{  $rec->Recommendations_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Recommendation ID: {{ $rec->Recommendations_id }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="{{URL('updaterecommendation',$rec->Recommendations_id )}}" method="POST" id="editform"enctype="multipart/form-data">
@csrf

<h1 class="mt-4 text-2xl"><strong>Update recommendations based on the instances below</strong></h1>  

<h3 class="text-dark">Fear Level:{{$rec->fear_level}} </h3>
<h3 class="text-dark">Avoidance Level:{{$rec->avoidance_level}} </h3>







<div class="mb-0 mt-3">
<label for="email" class="form-label">Expert system recommendations</label>
<p class="text-primary">Note: Here  you can give recommendations of solutions to deal with their social anxiety</p>
<p class="text-primary">Seperate the recommendations with a comma e.g <br> Sleep 8 hours ,<br> Drink a lot of water</p>
</div>

<div class="mb-3 mt-3">
<label for="email" class="form-label">Fear level</label>

<select class="form-control" name="fear_level" id="">
<option class="form-control" value="{{$rec->fear_level}}">Current option: {{$rec->fear_level}}</option>
  <option value="low">Low</option>
  <option value="marked">Marked</option>
  <option value="high">High</option>
</select>
</div>
<div class="mb-3 mt-3">
<label for="email" class="form-label">Avoidance Level</label>

<select class="form-control" name="avoidance_level" id="">
  <option value="{{$rec->avoidance_level}}">Current option: {{$rec->avoidance_level}}</option>
  <option value="low">Low</option>
  <option value="marked">Marked</option>
  <option value="high">High</option>
</select>
</div>
<div class="mb-3 mt-3">

<textarea name="recommendation"  cols="30" rows="10">
{{$rec->Recommendation}}
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
            var itemId = $(this).data('recommendation-id');

            // Make an AJAX request to fetch item details based on the ID
            $.ajax({
                url: '/getadminRecommendationDetails/' + itemId, // Replace with the actual route
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
