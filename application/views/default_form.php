<script type="text/javascript" src="/assets/js/cavescript.js"></script>
<link href = "/assets/css/dropzone.css" rel = "stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="/assets/js/dropzone.js"></script>


<script type="text/javascript">
    var formBuilder = '';
    var myDropzone = '';
    var cave_num_global = 0;
    var count = 0;
    
</script>


<!-- End File Upload -->

<!-- Gallery -->

<!-- End of Gallery -->
<main class="main">

      <!-- Breadcrumb -->
    <ol class="breadcrumb">
<!--  <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item"><a href="#">Admin</a></li>-->
      <li class="breadcrumb-item active">Caves</li>


    </ol>
      
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Default Form</small>
                        </div>
                        <div class="card-body">
        
        <section id="1" class='col-xs-12 no-padding' >
            <div class="form-wrap col-xs-12">
                <div class="tabs col-xs-12">
                    
                    
                    <?php
                     if(isset($message))
                    {
                    ?>
                        <div class='col-xs-12 error'>
                            <?php echo $message ?>
                        </div>
                    <?php
                    }
                    ?>
                    <br><br>
                    <div class="switch_data col-xs-12 no-padding">

                        <!-- CAVE OPTIONS --->
                        <div class="cave_options  col-xs-12 no-padding" style="z-index:1">
                            <div class="setDataWrap" style="display:none">
                                        <button id="setData" type="button">Set Data</button>
                                      </div>
                            <div id="build-wrap" class="col-xs-12 top-margin no-padding"></div>
                                    <button id="getJSON2" type="button" class="btn btn-success col-xs-12 getJSON top-margin">Save Form</button>
                        </div> <!-- CLOSE CAVE OPTIONS -->

                        
                    </div> 
                </div>
            </div>
        </section>
        
        
        
        
        
    </div> <!-- Section Tag Ends Here -->
</div> <!--Ending Container -->
<!-- Modal -->

                </div>
            </div>
        </div>
    </div>
</main>

<script>
 $(document).ready(function(){
     var fbEditor = document.getElementById('build-wrap');
    $(fbEditor).formBuilder();
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url("form/getDefaultFormData"); ?>",
        dataType: 'json',
        success: function (res, textStatus, xhr) {
            $('#build-wrap').html('');

            var fbEditor = document.getElementById('build-wrap');
            formBuilder = $(fbEditor).formBuilder();
            var formData = res.data;

          //  document.getElementById('setData').addEventListener('click', function() {
            setTimeout(
                function() 
                {
                    formBuilder.actions.setData(formData);
                },300);
        }
    
    });   
 });
        
jQuery(function($) {
    
   // document.getElementById('getJSON2').addEventListener('click', function() {
    $(document).on('click', '#getJSON2', function(){
        var data = formBuilder.actions.getData('json');
        $.post('/form/default_save',{'data':data}, function(res){
            alert(res);
            location.reload();
        }).fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
            
        });
    });
    
  
});

</script>

<script>
    $(document).ready(function(){
        $('#default-li').addClass('active');
    });
</script>