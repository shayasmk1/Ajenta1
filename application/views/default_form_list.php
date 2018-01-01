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
                            <small>List</small>
                        </div>
                        <div class="card-body" >
        
        <section id="1" class='col-xs-12 no-padding' >
            <div class="form-wrap col-xs-12" >
                <div class="tabs col-xs-12" >
                    
                    <div class='col-xs-12 error' id="error">
                    </div>
                    
                    <div class="switch_data col-xs-12 no-padding" >
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>
                                        SI
                                    </td>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($list))
                                {
                                    $count = 1;
                                    foreach($list AS $each)
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $count++ ?>
                                            </td>
                                            <td>
                                                <?php echo htmlspecialchars($each['name']) ?>
                                            </td>
                                            <td>
                                                <a href="/form/edit/<?php echo htmlspecialchars($each['id']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <button data-href="/form/delete/<?php echo htmlspecialchars($each['id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
 
        
jQuery(function($) {
    
   // document.getElementById('getJSON2').addEventListener('click', function() {
    $(document).on('click', '#getJSON2', function(){
        $('.error').html('<div class="alert alert-warning"><i class="fa fa-spin fa-spinner"></i> Saving Form...</div>');
        var data = formBuilder.actions.getData('json');
        var form_name = $('#form_name').val();
        $.post('/form/default_save',{'data':data, 'form_name': form_name}, function(res){
            alert("Form Added Successfully");
            window.location.href = '/form/default_add';
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