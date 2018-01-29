
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
                            <button type="button" class="btn btn-success pull-right" id="edit-story">Edit</button>
                            <div class='each-api top-margin col-sm-12 pull-left'>
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
                                            <div class="story-edit" id="story_title"><?php echo $story->title ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Story Description
                                        </th>
                                        <td>
                                            <div class="story-edit" id="story_description"><?php echo $story->description ?></div>
                                        </td>
                                    </tr>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-success pull-right hide" id="update-story">Update Story</button>
                                            </td>
                                        </tr>
                                    </tfoot>
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
                            <div class="col-xs-12 top-margin">
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
                        <div class="card-body" id="story-title-container">
                            <?php
                            if(!empty($titles))
                            {
                                foreach($titles AS $title)
                                {
                                    ?>
                            <div class="col-xs-12 each-story-title-container">
                                    <div class='each-story-title'>
                                        <?php echo $title['name'] ?>
                                        <i class="fa fa-chevron-down pull-right"></i>
                                    </div>
                                <div class='each-story-title-description' style="display:none">
                                        <?php echo $title['description'] ?>
                                    </div>
                                
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
                    <?php 
                    if(isset($caveImage->location))
                    {
                        ?>
                    
                    <img src="/assets/uploads/<?php echo $caveImage->location ?>" class="col-xs-12 col-sm-12" />
                    <?php
                    }
                    ?>
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
                getAllTtitles()
            },'json').fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON);
                $(current).removeAttr('disabled', 'disabled').text('Save Title');
            },'json');
        });
        
        $('#edit-story').click(function(){
            $('.story-edit').addClass('editable-text-border').attr('contenteditable', 'true');
            $('#edit-story').addClass('hide');
            $('#update-story').removeClass('hide');
        });
    });
    
    function getAllTtitles()
    {
        $('#story-title-container').html('Loading.....');
        $.get('/title/all/<?php echo $story->id ?>', function(res){
            var html = '';
            $(res).each(function(i, value){
                html+= '<div class="col-xs-12 each-story-title-container">';
                html+= '<div class="each-story-title">' + value.name + '<i class="fa fa-chevron-down pull-right"></i></div>';
                html+= '<div class="each-story-title-description" style="display:none">' + value.description + '</div>';
                html+= '</div>';
            });
            $('#story-title-container').html(html);
        },'json');
    }
    
    $(document).on('click', '#update-story', function(){
        var data = new Object();
        data['title'] = $('#story_title').text().trim();
        data['description'] = $('#story_description').text().trim();
        $(this).attr('disabled', 'disabled');
        var current = $(this);
        $.post('/caves/updateStory',{'storyID':<?php echo $story->id ?>, data:data}, function(res){
            alert(res);
            $('.story-edit').removeClass('editable-text-border').removeAttr('contenteditable', 'true');
            $('#edit-story').removeClass('hide');
            $('#update-story').addClass('hide');
            $('#update-story').removeAttr('disabled', 'disabled');
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON);
            $(current).removeAttr('disabled', 'disabled');
        },'json');
    });
    
    $(document).on('click', '.each-story-title', function(){
        var parent = $(this).parents('.each-story-title-container').first();
        $(parent).find('.each-story-title-description').slideToggle();
    });
    
</script>