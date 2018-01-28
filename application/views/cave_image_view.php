
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src='/assets/ckeditor/ckeditor.js' ></script>
<main class="main">

      <!-- Breadcrumb -->
    <ol class="breadcrumb">
<!--  <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item"><a href="#">Admin</a></li>-->
      <li class="breadcrumb-item active">Images</li>


    </ol>
      
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Cave</strong>
                            <small>Story</small>
                        </div>
                        <div class="card-body">
                            <div class='each-api'>
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            Cave Num
                                        </th>
                                        <td>
                                            <?php echo $cave->cave_numb ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Story Title
                                        </th>
                                        <td>
                                            <?php echo $story->title ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Story Description
                                        </th>
                                        <td>
                                            <?php echo $story->description ?>
                                        </td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <strong>Cave</strong>
                            <small>Title</small>
                        </div>
                        <div class="card-body">

                            <div class="col-xs-12">
                                <label class="col-xs-12">
                                    Title
                                </label>
                                <input type="text" class="form-control" id="title"/>
                            </div>

                            <div class="col-xs-12 top-margin">
                                <label class="col-xs-12">
                                    Description
                                </label>
                                <textarea class="form-control" id="description"></textarea>
                            </div>
                            
                            <div class="col-xs-12 top-margin">
                                <button type="button" id="title-save" class="btn btn-success pull-right">Save Title</button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="card">
                        <div class="card-header">
                            <strong>Story</strong>
                            <small>All Titles</small>
                        </div>
                        <div class="card-body">
                            <?php
                            if(!empty($titles))
                            {
                                foreach($titles AS $title)
                                {
                                    ?>
                                    <div class='each-title'>
                                        <?php echo $title['name'] ?>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                            No Stories Available Currently
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                    
                    <img src="/assets/uploads/<?php echo $caveImage->location ?>" class="col-xs-12 col-sm-12" />
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    CKEDITOR.replace( 'description' );
    $(document).ready(function(){
        $('#rest-li').addClass('active');
        
        $('#title-save').click(function(){
            $(this).text('Saving Title....').attr('disabled', 'disabled');
            var current = $(this);
            var data = new Object();
            data['name'] = $('#title').val();
            data['description'] = CKEDITOR.instances['description'].getData()
            $.post('/title/save/<?php echo $story->id ?>', {data:data}, function(res){
                alert(res);
                $(current).removeAttr('disabled', 'disabled').text('Save Title');
                $('#title').val('');
                CKEDITOR.instances['description'].setData('');
            },'json').fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON);
                $(current).removeAttr('disabled', 'disabled').text('Save Title');
            },'json');
        });
    });
</script>