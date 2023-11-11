@include('Panel/therapist/modal/appointmentmodal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script> -->


<script>

    $(document).ready(function(){ 
    // jQuery.ready(function($) {
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

<!-- Include jQuery -->

<!-- Datepicker script -->
<script>
//  jQuery.noConflict();

$(document).ready(function($) {
    const selectedID = $('#datepicker2').val();
    console.log(selectedID)
$('#datepicker2').datepicker({
   
    dateFormat: "yy-mm-dd", // Set the date format
    minDate: 0,            // Minimum date (0 means today)
    maxDate: "+1M", 
    beforeShowDay: function(date) {
        var day = date.getDay();
        // Disable Sundays (0 is Sunday, 1 is Monday, and so on)
        return [day !== 0, ''];
    }       // Maximum date (1 month from today)
});





});

$(document).ready(function() {
    $('#datepicker2').on('change', function() {
        const selectedDate = $(this).val();
        const selectedID = $('#therapistID').val();
      
        console.log(selectedID);
        console.log(selectedDate);
      
        $.ajax({
            url: "/timeslotstherapist",
            type: 'GET',
            data: { therapists_id:selectedID, appointment_date: selectedDate },
          
            success: function(response) {
               // Populate the select input with available time slots
                const select = $('#time-select');
                select.empty();

                $.each(response.available_time_slots, function(key, value) {
                    select.append($('<option>', { value: value }).text(value));
                });

                // Update the hidden input with the available time slots
                $('#available-time-slots').val(JSON.stringify(response.available_time_slots));

                const bookedTimeSlots = response.booked_time_slots;

                console.log(bookedTimeSlots)
                select.find('option').each(function() {
                    const optionValue = $(this).val();
                    if (bookedTimeSlots.includes(optionValue)) {
                        $(this).prop('disabled', true);
                    }
                });



            }
            
        });
      
    });
});



</script>


