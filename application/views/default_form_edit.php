<script type="text/javascript" src="/assets/js/cavescript.js"></script>
<link href = "/assets/css/dropzone.css" rel = "stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="/assets/libraries/formBuilder/dist/form-builder.min.js"></script>
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
<main class="main" id="main">

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
                            <strong>Form</strong>
                                <small>Edit</small>
                        </div>
                        <div class="card-body" >
        
        <section id="1" class='col-xs-12 no-padding hide' >
            <div class="form-wrap col-xs-12" >
                <div class="tabs col-xs-12" >
                    
                    <div class='col-xs-12 error' id="error">
                    </div>
                    
                    <div class="switch_data col-xs-12 no-padding" >
                        <div class="form-group">
                            <label>Form Name</label>
                            <input type="text" class="form-control" placeholder="Form Name" id="form_name"/>
                        </div>
                        <!-- CAVE OPTIONS --->
                        <div class="cave_options  col-xs-12 no-padding" style="z-index:1">
                            <div class="setDataWrap" style="display:none">
                                        <button id="setData" type="button">Set Data</button>
                                      </div>
                            <div id="build-wrap" class="col-xs-12 top-margin no-padding"></div>
                                    <button id="getJSON2" type="button" class="btn btn-success col-xs-12 getJSON top-margin">Update Form</button>
                        </div> <!-- CLOSE CAVE OPTIONS -->

                        
                    </div> 
                </div>
            </div>
        </section>
                            <section id="2" class='col-xs-12 no-padding' >
                                <i class="fa fa-spin fa-spinner"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Processing Request......
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
    formBuilder = $(fbEditor).formBuilder();
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url("form/getDefaultFormData/" . $id); ?>",
        dataType: 'json',
        success: function (res, textStatus, xhr) {
            
            $('#form_name').val(res.formName);
            $('#build-wrap').html('');

            var fbEditor = document.getElementById('build-wrap');
            formBuilder = $(fbEditor).formBuilder();
            var formData = res.data;

          //  document.getElementById('setData').addEventListener('click', function() {
            setTimeout(
                function() 
                {
                    $('#1').removeClass('hide');
                    $('#2').addClass('hide');
                    formBuilder.actions.setData(formData);
                },200);
        }
    
    });   
 });
        
jQuery(function($) {
    
   // document.getElementById('getJSON2').addEventListener('click', function() {
    $(document).on('click', '#getJSON2', function(){
        $('.error').html('<div class="alert alert-warning"><i class="fa fa-spin fa-spinner"></i> Saving Form...</div>');
        var data = formBuilder.actions.getData('json');
        var form_name = $('#form_name').val();
        $.post('/form/default_update/<?php echo $id ?>',{'data':data, 'form_name': form_name}, function(res){
            alert("Form Updated Successfully");
            window.location.href = '/form/edit/<?php echo $id ?>';
        },'json').fail( function(xhr, textStatus, errorThrown) {
            $('.error').html('<div class="alert alert-danger">' + xhr.responseJSON + '</div>');
            window.location.href = '#main';
        },'json');
    });
    
  
});

</script>

<script>
    $(document).ready(function(){
        $('#default-li').addClass('active');
    });
</script>