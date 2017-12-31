<footer class="app-footer">
    <span><a href="http://coreui.io">Developed by <a href="https://www.facebook.com/sopan.tripathi">Vivek
		Tripathi</a></a> © All Rights Reserved by <a
		href="http://www.idc.iitb.ac.in/">IDC IIT Bombay</a>.</span>
    <span class="ml-auto"></span>
  </footer>

  <!-- Bootstrap and necessary plugins -->
 
  <script src="/assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!--  <script src="/assets/node_modules/pace-progress/pace.min.js"></script>-->

  <!-- Plugins and scripts required by all views -->
<!--  <script src="/assets/node_modules/chart.js/dist/Chart.min.js"></script>-->

  <!-- CoreUI main scripts -->

  <script src="/assets/js/app.js"></script>

  <!-- Plugins and scripts required by this views -->

  <!-- Custom scripts required by this view -->
  <script src="/assets/js/views/main.js"></script>
  
  <script>
      $(document).ready(function(){
         $('.dropdown .nav-link').click(function(){
             console.log("a");
             var parent = $(this).parents('.dropdown').first();
             $(parent).find('.dropdown-menu').toggle();
         });
      });
      </script>
  
  <div class="col-xs-12" style="display:none">
</body>
</html>