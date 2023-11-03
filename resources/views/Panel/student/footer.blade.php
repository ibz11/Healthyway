  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{URL('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>








<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
    <span>Copyright &copy; Your Healthyway 2023</span>
</div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>









<!-- If the profile picture is not working in a deeper route then its because you didn't add the '/'
 at the script tags below -->

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="/adminpanel/vendor/jquery/jquery.min.js"></script>
    <script src="/adminpanel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core pluadminpanel/gin JavaScript-->
    <script src="/adminpanel/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom sadminpanel/cripts for all pages-->
    <script src="/adminpanel/js/sb-admin-2.min.js"></script>


  
    <!-- Page levadminpanel/el plugins -->
    <script src="/adminpanel/vendor/chart.js/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   
   
   
   
   
   
   
    <!-- J query -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
    <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
    <!-- Date picker -->
    <script>
    $(document).ready(function() {

    $('#datepicker').datepicker({
        dateFormat: "yy-mm-dd", // Set the date format
        minDate: 0,            // Minimum date (0 means today)
        maxDate: "+1W", 
        beforeShowDay: function(date) {
            var day = date.getDay();
            // Disable Sundays (0 is Sunday, 1 is Monday, and so on)
            return [day !== 0, ''];
        }       // Maximum date (1 month from today)
    });

 $('#timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,  // Set the time interval to 30 minutes
    });


    
    });
    </script>
    <!-- Time picker -->
    <!-- <script>
$(document).ready(function() {
    $('#timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,  // Set the time interval to 30 minutes
    });
});
</script> -->




    <!-- Page level custom scripts -->
    <!-- <script src="/adminpanel/js/demo/chart-area-demo.js"></script>
    <script src="/adminpanel/js/demo/chart-pie-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>