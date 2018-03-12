<script type="text/javascript" src="/assets/js/cavescript.js"></script>
<link href = "/assets/css/dropzone.css" rel = "stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<!--<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>-->
<script src="/assets/libraries/formBuilder/dist/form-builder.min.js"></script>
<script src="/assets/js/dropzone.js"></script>
<script src='/assets/ckeditor/ckeditor.js' ></script>

<script type="text/javascript">
    var formBuilder = '';
    var myDropzone = '';
    var cave_num_global = 0;
    var count = 0;
    var cave_image_id_global = 0;
    var currentStoryGlobal = 0;
    var currentTitleGlobal = 0;
</script>



<script type="text/javascript">
    $(function () {
        $('#deleteBtn').click(function () {

            //get input data as a array
            var post_data = {
                'cave_numb': $("#one").html(),
            };
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("caves/deleteCave"); ?>",
                data: post_data,
//                success: function (data) {
//                }
            });
            location.reload();
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#newCaveBtn').click(function () {
            console.log(isNaN($("#add_cave").val()));
            if (!isNaN($("#add_cave").val())) {
                $(this).attr('disabled', 'disabled').text('Adding New Cave....');
                var caveToAdd = document.getElementById("add_cave").value;
                var x = document.getElementById("cave_numb");
                var option = document.createElement("option");
                var cave = "Cave ";
                var res = cave.concat(caveToAdd);
                option.text = res;
                option.value = caveToAdd;
                x.add(option);
                //document.getElementById('newCaveBtn').style.visibility = 'hidden';
                //document.getElementById('caveadded').innerHTML = "Cave is Added !";
                //get input data as a array
                var post_data = {
                    'cave_numb': option.value,
                    'cave_description': undefined,
                    'cave_patron': undefined,
                    'cave_period': undefined,
                    'cave_type': undefined
                };
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url("caves/addCave"); ?>",
                    data: post_data,
                    success: function (data) {
  
                        alert("Cave Added Successfully");
                        location.reload();
                    }
                });

            } else {
                window.alert("Enter Numeric Integer Only !");
                document.getElementById("add_cave").value = '';
            }
        });
    });
</script>


<!-- File Upload -->
<style>
    .upload.container{
        margin-top:20px;
    }
    .image-preview-input {
        position: relative;
        overflow: hidden;
        margin: 0px;    
        color: #333;
        background-color: #fff;
        border-color: #ccc;    
    }
    .image-preview-input input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        //cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title {
        margin-left:2px;
    }
    
    .input-control-0, .input-control-2, .input-control-6, .fld-subtype option[value="fineuploader"]
    {
        display : none;
    }
    
</style>

<script>
    $(document).on('click', '#close-preview', function () {
        $('.image-preview').popover('hide');
        // Hover befor close the preview    
    });


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
                            <small>Management</small>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($cave_list) && !empty($cave_list)) {
                                ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Select Cave Number</label>
                                        <select id="cave_numb" name="cave_numb" class="form-control" data-target=".switch_data">
                                        <option value="">Select Cave Number</option>

                                        <?php
                                        foreach ($cave_list as $value) {
                                            ?>
                                            <option data-show=".cave_options" value="<?php echo $value; ?>" <?php echo (isset($_POST['cave_numb']) && $_POST['cave_numb'] == $value) ? 'selected="selected"' : ''; ?>><?php echo "Cave " . $value; ?></option>
                                            <?php
                                        }
                                        ?>
                                        <option data-show="add_cave">Add New Cave</option>
                                    </select>

                                  </div>

                                </div>
                                
                            </div>
                            
                            <?php
                            } else {
                                echo "No Cave Data Available !";
                                echo "<br><br><br>";
                            }
                            ?>
                        </div>
                        
                        
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" id="cave-sub-menu">
                                
                                <li class="nav-item" id="cave-info-li">
                                    <a class="nav-link active"  href="#">Cave Info</a>
                                </li>
                                <li class="nav-item" id="cave-gallery-li">
                                    <a class="nav-link" href="#">Cave Gallery</a>
                                </li>
                                <li class="nav-item" id="cave-story-li">
                                    <a class="nav-link" href="#">Cave Story</a>
                                </li>
<!--                                <li class="nav-item" id="cave-general-story-li">
                                    <a class="nav-link" href="#">Add a new General Story</a>
                                </li>
                                <li class="nav-item" id="cave-general-story-list-li">
                                    <a class="nav-link" href="#">List ALl General Stories</a>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="card section-breaker hide" id="section-1">
                        <div class="card-header">
                            <strong>Caves / Form</strong>
                            <small>Create / Edit</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group hide" id="select-cave">
                                        <?php

                                        if($this->session->userdata('user_profile') == 'administrator')
                                        {
                                        ?>
                                            <div class="form-group">
                                                <label class="col-xs-12 pull-left" style="text-align:left">You are using</label>
                                                <select class="form-control" id="form-templte-select">
                                                    <option value="custom">Custom Form</option>
                                                    <?php
                                                    if(!empty($defaultCaves))
                                                    foreach($defaultCaves AS $defaultCave)
                                                    {
                                                        
                                                    ?>
                                                    <option value="<?php echo $defaultCave['id'] ?>"><?php echo $defaultCave['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                                <div class="setDataWrap" style="display:none">
                                                    <button id="setData" type="button">Set Data</button>
                                                  </div>
<!--                                            <div class="form-group">
                                                <div class="col-xs-12 top-margin-big no-padding">
                                                    <label class="col-xs-12 pull-left" style="text-align:left">Add a name for this form</label>
                                                    <input type="text" class="form-control" id="form_name" placeholder="Add a name for form" />
                                                </div>
                                            </div>-->
                                                <div id="build-wrap" class="col-xs-12 top-margin no-padding" ></div>
                                                <button id="getJSON2" type="button" class="btn btn-success col-xs-12 getJSON top-margin">Save Form</button>
                                            
                                        <?php
                                        }
                                        else
                                        {
                                           ?>
                                                <input type="hidden" id="form-templte-select" value="custom" />
                                        <h3 id="title_for_users" style="text-align:left"></h3>
                                                <form id="cave_form" method="post">

                                                </form>
                                        <?php

                                        }
                                        ?>
                                    </div>  

                                    <div class="form-group hide" id="add-cave">
                                        <div class="col-xs-12 top-margin-big no-padding">
                                            <label class="col-xs-12 pull-left">Cave Number</label>
                                            <textarea rows="1" class="form-control" id="add_cave" name="cave_number" style="margin-bottom:15px;height:100px"></textarea>
                                           
                                            <div id="caveadded"></div>
                                            <button class="btn btn-primary" id="newCaveBtn">Add New Cave</button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card section-2 hide section-breaker">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Upload Image</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                        <div class="col-xs-12">

                                            <form class="dropzone" id='dropzone'>
                                                <div class="fallback">
                                                  <input name="file" type="file" multiple accept='image/*' />
                                                  <input type='text' id='cave_id_image_upload' value='' />
                                                </div>
                                            </form>

                                            <button class="col-xs-12 btn btn-primary top-margin" id="refresh-button" type="button">Refresh / Save All Changes</button>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card section-2 hide section-breaker">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Image Gallery  (* Click over an existing image to see its stories)</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                        <div class='col-xs-12' id="image-gallery" style="height:400px;overflow:auto;background-color:white;border:1px solid">

                                        </div>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card section-2 hide section-breaker col-sm-6 no-padding pull-left" id="show-image">
                        <div class="card-body" style="height:363px;" id="show-image-image">
                            
                        </div>
                    </div>
                    <div class="card section-2 hide section-breaker col-sm-6 no-padding pull-left" id="image-details">
                        <div class="card-body" style="height:363px; " id="imgae-details-form">
                            <textarea class="form-control" value="" placeholder="Info" id="info" name="info"></textarea>
                            <button type="button" class="btn btn-success col-sm-12 pull-left top-margin" id="update-info">Update Info</button>
                            <button type="button" class="btn btn-danger col-sm-12 pull-right top-margin" id="delete-image">Delete Image</button>
                            <button type="button" class="btn btn-primary col-sm-12 pull-right top-margin" id="add-story">Add Story</button>
                        </div>
                        
                    </div>
                    
<!--                    <div class="card section-2 hide section-breaker col-sm-6 no-padding pull-right" id="add-story">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Add Story</small>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12 alert alert-success" id="image-count">
            No Images Selected
        </div>
                            <div class="col-xs-12 top-margin">
                                <label class="col-xs-12">
                                    Story Title
                                </label>
                                <input type="text" class="form-control" id="cave_title"/>
                            </div>

                            <div class="col-xs-12 top-margin">
                                <label class="col-xs-12">
                                    Description
                                </label>
                                <textarea class="form-control" id="cave_description"></textarea>
                            </div>
                            
                            <div class="col-xs-12 top-margin">
                                <button type="button" id="story-save" class="btn btn-success pull-right">Save Story</button>
                            </div>
                        </div>
                        
                        
                    </div>-->
                    
<!--                    <div class="card section-2 hide section-breaker col-sm-6 no-padding pull-right" id="add-title" style="display:none">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Add Chapter</small>
                        </div>
                    
                        <div class="card-body">
                            <div class="alert alert-success" id="story-name"></div>
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
                                <textarea class="form-control" id="title_description"></textarea>
                            </div>
                            <div class="col-sm-12 no-padding top-margin">
                                <div class="col-sm-3 btn btn-primary no-padding pull-left">
                                    Add Marker
                                </div>
                                <div class="col-sm-3 btn btn-warning no-padding pull-left">
                                    Add Audio
                                </div>
                                <div class="col-sm-3 btn btn-danger no-padding pull-left">
                                    Add More Chapters
                                </div>
                                <div id="title-save" class="btn btn-success pull-left col-sm-3 no-padding">Save Title</div>
                            </div>
                            
                        </div>
                    </div>-->
                    
                    <div class="card section-3 hide section-breaker">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Image Gallery  (* Click over an existing image to see its stories)</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                        <div class='col-xs-12' id="image-gallery-story" style="height:400px;overflow:auto;background-color:white;border:1px solid">

                                        </div>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card section-3 hide section-breaker">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Stories</small>
                            <button class="pull-right btn btn-danger" id="new_story" style="display:none">New Story</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div id='4' class='col-sm-12' style="margin-top:0px;padding-bottom:55px;">
                                        <div class="col-sm-12 col-md-3 pull-left" id="story-headers">
                                            
                                        </div>
                                        <div id='4-1' class='col-sm-12 col-md-9 no-padding pull-right' style="position:relative;">
                                            <div class="card-body">
                                                <div class="col-sm-12 alert alert-success" id="image-count">
                                                    No Images Selected
                                                </div>
                                                <div class="col-sm-12 alert alert-primary" id="story-count">
                                                    No Stories Selected
                                                </div>
                                                <div class="story_error">
                                                    
                                                </div>
                                                        <div class="col-sm-12 top-margin">
                                                            <label class="col-xs-12">
                                                                Story Title
                                                            </label>
                                                            <input type="text" class="form-control" id="cave_title"/>
                                                        </div>

                                                        <div class="col-sm-12 top-margin">
                                                            <label class="col-xs-12">
                                                                Description
                                                            </label>
                                                            <textarea class="form-control" id="cave_description"></textarea>
                                                        </div>

                                                        <div class="col-sm-12 top-margin">
                                                            <button type="button" id="story-save" class="btn btn-success pull-right">Save Story</button>
                                                            <button type="button" style="display:none;margin-left:5px" class="story-update-buttons btn btn-invert pull-right list-titles" id="list-title" title="List Chapters" style=""><i class="fa fa-list"></i></button>
                                                            <button type="button" style="display:none;margin-left:5px" class="story-update-buttons btn btn-primary pull-right add-title" id="add-title" title="Add Chapter" style=""><i class="fa fa-plus"></i></button>
                                                            <button type="button"  style="display:none;margin-left:5px" id="remove-story-button" class="story-update-buttons btn btn-danger pull-right remove-story" title="Delete Story"><i class="fa fa-remove"></i></button>&nbsp;
                                                            <button type="button" id="story-update" style="display:none" class="story-update-buttons btn btn-success pull-right" title="Update Story"><i class="fa fa-edit"></i></button>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="dummy-area" style="z-index: 10;position:absolute;left:0;top:0">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
<!--                    <div class="card section-4 hide section-breaker">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>General Stories</small>
                        </div>
                        <div class="card-body">
                            <div class="col-xs-12 top-margin">
                                <label class="col-xs-12">
                                    Title
                                </label>
                                <input type="text" class="form-control" id="cave_title"/>
                            </div>

                            <div class="col-xs-12 top-margin">
                                <label class="col-xs-12">
                                    Description
                                </label>
                                <textarea class="form-control" id="cave_description"></textarea>
                            </div>
                            
                            <div class="col-xs-12 top-margin">
                                <button type="button" id="story-save" class="btn btn-success pull-right">Save Story</button>
                            </div>
                        </div>
                    </div>-->

<!--                    <div class="card section-5 hide section-breaker">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>General Stories List</small>
                        </div>
                        <div class="card-body" id="general-stories-list">
                            
                        </div>
                    </div>-->
                    <div class="card section-3 section-breaker hide">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Stories</small>
                        </div>
                        <div class="card-body">
                            <div class="card " id="section-loading">
                                <div class="card-body">
                                    <div class="row">
                                        <i class="fa fa-spin fa-spinner"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Processing Request......
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal" id="storyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-sm-12 no-padding">
      <div class="modal-header col-sm-12">
        <h5 class="modal-title col-sm-6" id="exampleModalLabel">Edit Story</h5>
        <button type="button" class="close col-sm-6 pull-right btn-close" data-dismiss="modal" aria-label="Close" style="text-align: right;padding-right:15px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="story-model-loading">
            <i class="fa fa-spin fa-spinner"></i> Loading..... Please Wait.
        </div>
        <div class="modal-body col-sm-12 no-padding hide story-model" style="padding-top:0px">
          <div class="error">
              
          </div>
          <div class="col-sm-12">
              <label class="col-xs-12 no-padding">Story Title</label>
              <div class="col-xs-12 no-padding">
                  <input type="text" class="form-control" id="modal_story_title"/>
              </div>
          </div>
          
          <div class="col-sm-12 ">
              <label class="col-xs-12 no-padding">Story Description</label>
               <div class="col-xs-12 no-padding">
                   <textarea class="form-control" id="modal_story_description" style="height:150px"></textarea>
              </div>
          </div>
          <input type="hidden" value="" id="marking_id" />
          <input type="hidden" id="story_id" />
      </div>
      <div class="modal-footer col-xs-12 story-model">
        <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save-story">Save changes</button>
        <button type="button" class="btn btn-danger" id="btn-delete">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="titleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
    <div class="modal-dialog" role="document" style="max-width:800px;width:800px">
    <div class="modal-content col-sm-12 no-padding">
      <div class="modal-header col-sm-12">
        <h5 class="modal-title col-sm-6" id="exampleModalLabel">Add Chapter</h5>
        <button type="button" class="close col-sm-6 pull-right btn-close" data-dismiss="modal" aria-label="Close" style="text-align: right;padding-right:15px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        <div class="modal-body col-sm-12 no-padding title-model" style="padding-top:0px">
          <div class="title-error" id="title-error">
              
          </div>
          <div class="col-sm-12">
              <label class="col-xs-12 no-padding">Chapter</label>
              <div class="col-xs-12 no-padding">
                  <input type="text" class="form-control" id="modal_title_title"/>
              </div>
          </div>
          
          <div class="col-sm-12 ">
              <label class="col-xs-12 no-padding">Chapter Description</label>
               <div class="col-xs-12 no-padding">
                   <textarea class="form-control" id="modal_title_description" style="height:150px"></textarea>
              </div>
          </div>
          <input type="hidden" value="" id="marking_id" />
          <input type="hidden" id="story_id" />
      </div>
      <div class="modal-footer col-xs-12 story-model">
        <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save-title">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="titleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
    <div class="modal-dialog" role="document" style="max-width:800px;width:800px">
    <div class="modal-content col-sm-12 no-padding">
      <div class="modal-header col-sm-12">
        <h5 class="modal-title col-sm-6" id="exampleModalLabel">Update Chapter</h5>
        <button type="button" class="close col-sm-6 pull-right btn-close" data-dismiss="modal" aria-label="Close" style="text-align: right;padding-right:15px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="title-model-loading">
            <i class="fa fa-spin fa-spinner"></i> Loading..... Please Wait.
        </div>
        <div class="modal-body col-sm-12 no-padding title-model hide" style="padding-top:0px">
          <div class="title-update-error" id="title-update-error">
              
          </div>
          <div class="col-sm-12">
              <label class="col-xs-12 no-padding">Chapter</label>
              <div class="col-xs-12 no-padding">
                  <input type="text" class="form-control" id="modal_title_title_update"/>
              </div>
          </div>
          
          <div class="col-sm-12 ">
              <label class="col-xs-12 no-padding">Chapter Description</label>
               <div class="col-xs-12 no-padding">
                   <textarea class="form-control" id="modal_title_description_update" style="height:150px"></textarea>
              </div>
          </div>
      </div>
      <div class="modal-footer col-xs-12 story-model">
        <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-update-title">Update changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="addMp3Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
    <div class="modal-dialog" role="document" style="max-width:800px;width:800px">
    <form class="modal-content col-sm-12 no-padding" method="post" enctype="multipart/form-data" id="mp3-form">
      <div class="modal-header col-sm-12">
        <h5 class="modal-title col-sm-6" id="exampleModalLabel">Add Mp3</h5>
        <button type="button" class="close col-sm-6 pull-right btn-close" data-dismiss="modal" aria-label="Close" style="text-align: right;padding-right:15px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        <div class="modal-body col-sm-12 no-padding title-model" style="padding-top:0px">
          <div class="file-upload-error" id="file-upload-error">
              
          </div>
          <div class="col-sm-12">
              <label class="col-xs-12 no-padding">Update Mp3 File</label>
              <div class="col-xs-12 no-padding">
                  <input type="file" class="form-control" id="file" name="file"/>
                  <input type="hidden" name="reference_task_id" id="reference_task_id" />
              </div>
          </div>
      </div>
      <div class="modal-footer col-xs-12 story-model">
        <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btn-upload-title">Upload File</button>
      </div>
    </form>
  </div>
</div>

<div class="modal" id="listChapters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
    <div class="modal-dialog" role="document" style="max-width:800px;width:800px">
        <div class="modal-content col-sm-12 no-padding">
            <div class="modal-header col-sm-12">
                <h5 class="modal-title col-sm-6" id="exampleModalLabel">List All Chapters</h5>
                <button type="button" class="close col-sm-6 pull-right btn-close" data-dismiss="modal" aria-label="Close" style="text-align: right;padding-right:15px">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-sm-12 no-padding" id="title-modal-list" style="padding-top:0px">
                  Loading.....
              </div>
              <div class="modal-footer col-xs-12 story-model">
                <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>

<script>
CKEDITOR.replace( 'modal_title_description' );
CKEDITOR.replace( 'modal_title_description_update');
$(document).ready(function(){
    $('#update-info').click(function(){
        $('#update-info').attr('disabled', 'disabled').text('Updating Info');
        var info = $('#info').val();
        var id = $('.active-image-section-2').find('.each-image-gallery').attr('data-id');
        $.post('/caves/images/' + id, {info:info}, function(res){
            refreshGalllery();
            $('#update-info').removeAttr('disabled').text('Update Info');
            alert('Info Updated');
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON);
            $('#update-info').removeAttr('disabled').text('Update Info');
        },'json');
    });
    
    $('#delete-image').click(function(){
        $('#delete-imag').attr('disabled', 'disabled').text('Deleting Image');
        var id = $('.active-image-section-2').find('.each-image-gallery').attr('data-id');
        $.post('/caves/delete_image/' + id, function(res){
            refreshGalllery();
            $('#delete-imag').removeAttr('disabled').text('Delete Info');
            alert('Image Deleted');
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON);
            $('#delete-imag').removeAttr('disabled').text('Delete Info');
        },'json');
    });
    
    
    $('#story-save').click(function(){
        var caveID = $('#cave_numb').val();
        if(caveID.trim() == '')
        {
            alert('Please Select Cave');
            return;
        }
        var data = new Object();
        data['title'] = $('#cave_title').val();
        data['description'] = $('#cave_description').val();
        data['cave_num'] = caveID;
        if($('.active-image').length)
        {
            data['cave_image_id'] = $('.active-image').find('.each-image-gallery').attr('data-id');
        }
        var current = $(this);
        $(current).attr('disabled', 'disabled').text('Saving.....');
        $.post('/caves/saveStory', {data:data}, function(res){
            alert(res.message);
            $('.story_error').html('<div class="alert alert-success">' + res.message + '</div>');
            $('#add-story').slideUp();
            $('#add-title').slideDown();
            
            $('#story-name').text('Story Name : ' +  $('#cave_title').val());
            $(current).removeAttr('disabled', 'disabled').text('Save Story');
            $('#cave_title').val('');
            $('#cave_description').val('');
            getAllStoriesList();
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON.message);
            
            $(current).removeAttr('disabled', 'disabled').text('Save Story');
        },'json');
    });
    
    $('#title-save').click(function(){
        var caveID = $('#cave_numb').val();
        if(caveID.trim() == '')
        {
            alert('Please Select Cave');
            return;
        }
        var data = new Object();
        data['title'] = $('#cave_title').val();
        data['description'] = $('#cave_description').val();
        data['cave_num'] = caveID;
        if($('.active-image').length)
        {
            data['cave_image_id'] = $('.active-image').find('.each-image-gallery').attr('data-id');
        }
        var current = $(this);
        $(current).attr('disabled', 'disabled').text('Saving.....');
        $.post('/caves/saveStory', {data:data}, function(res){
            alert(res.message);
            $('#add-story').slideUp();
            $('#add-title').slideDown();
            
            $('#story-name').text('Story Name : ' +  $('#cave_title').val());
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON);
            
            $(current).removeAttr('disabled', 'disabled').text('Save Story');
        },'json');
    });
    
    
    $('#cave-info-li').click(function(){
        $('.section-breaker').addClass('hide');
        $('#section-1').removeClass('hide');
        
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-info-li a').addClass('active');
    });
    
    $('#cave-gallery-li').click(function(){
        if($('#cave_numb').val() == '')
        {
            alert("Cave Not Selected");
            return;
        }
       $('.section-breaker').addClass('hide');
        $('.section-2').removeClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-gallery-li a').addClass('active');
        
        if(!$('.active-image-section-2').length)
        {
            $('#show-image').addClass('hide');
            $('#image-details').addClass('hide');
        }
        
    });
    
    $('#cave-story-li').click(function(){
        if($('#cave_numb').val() == '')
        {
            alert("Cave Not Selected");
            return;
        }
        $('.section-breaker').addClass('hide');
        $('.section-3').removeClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-story-li a').addClass('active');
    });
    
    $('#cave-general-story-li').click(function(){
        $('.section-breaker').addClass('hide');
        $('.section-4').removeClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-general-story-li a').addClass('active');
    });

    $('#cave-general-story-list-li').click(function(){
        $('.section-breaker').addClass('hide');
        $('.section-5').removeClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-general-story-list-li a').addClass('active');
    });
        
    function getFormValues()
    {
        $('#section-loading').removeClass('hide');
        if($('#form-templte-select').val() != 'custom')
        {
            var defaultID = $('#form-templte-select').val();
            $.ajax({
            type: "POST",
            url: "/form/getDefaultFormData/" + defaultID,
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
                      //  $('#section-loading').addClass('hide');
                    },300);
                }

            });   
        }
        else
        {
            var cave_numb = $('#cave_numb').val();
            var cave_number = {
                'cave_numb': cave_numb
            };
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("caves/getFormData"); ?>",
                data: cave_number,
                dataType: 'json',
                success: function (res, textStatus, xhr) {
                    <?php
                if($this->session->userdata('user_profile') == 'administrator')
                {
                    ?>
                    $('#build-wrap').html('');
                    $('#form_name').val(res.formName);
                    var fbEditor = document.getElementById('build-wrap');
                    formBuilder = $(fbEditor).formBuilder();
                    var formData = res.data;
                    
                    setTimeout(
                        function() 
                        {
                            formBuilder.actions.setData(formData);
                           // $('#section-loading').addClass('hide');
                        },300);
                        
                        
                        <?php
                }
                else
                {
                    ?>
                        $('#cave_form').html('');
                        if(res.message == 'Empty Array')
                        {
                            $('#title_for_users').text('');
                        }
                        else
                        {
                            $('#title_for_users').text(res.formName);
                        }
                        var count1 = 0;
                        if(xhr.status == 200)
                        {
                            var html = '';
                            var result = $.parseJSON(res.data);
                            html+= "<div class='col-xs-12 form-custom-container no-padding'>";
                            html+= "<input type='hidden' name='cave_id' value='" + cave_num_global + "' />";
                            $(result).each(function(i, value){
                                
                                html+= "<div class='col-xs-12 each-form-field'>";
                                html+=      "<label class='col-xs-12'>" + value.label + "</label>";
                                html+=      "<div class='col-xs-12' style='text-align:left'>";

                                var actualValue = '';
                                var placeholder = '';
                                
                                if(value.value != null)
                                {
                                    actualValue = value.value;
                                }  
                                if(value.value != null)
                                {
                                    placeholder = value.value;
                                }  
                                
                                if(value.type == 'file' || value.type == 'number' || value.type == 'date')
                                {
                                    html+=  "<input type='" + value.type + "' name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "' placeholder='" + placeholder + "' value='" + actualValue + "' />";
                                }
                                else if(value.type == 'button' || value.type == 'text')
                                {
                                    html+=  "<input type='" + value.subtype + "' name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "' placeholder='" + placeholder + "' value='" + actualValue + "' />";
                                }
                                else if(value.type == 'select')
                                {
                                    html+= "<select name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "'>";
                                    console.log(value.values);
                                    $(value.values).each(function(i1, value1){
                                        
                                        var selected = '';
                                        if(value1.selected == 1)
                                        {
                                            selected = 'selected="selected"';
                                        }
                                        html+=      "<option value='" + value1.label + "' " + selected + ">" + value1.value + "</option>";
                                    })

                                    html+= "</select>";
                                }
                                else if(value.type == 'checkbox-group')
                                {
                                    html+= "<div class='col-xs-12'>";
                                    $(value.values).each(function(i1, value1){
                                        html+= "<label class='pull-left'>" + value1.label + "</label>";
                                        html+= "<input type='checkbox' class='pull-left' value='" + value1.value + "'/>";
                                    });
                                    html+= "</div>";
                                }
                                else if(value.type == 'radio-group')
                                {
                                    html+= "<div class='col-xs-12'>";
                                    $(value.values).each(function(i1, value1){
                                        html+= "<label class='pull-left'>" + value1.label + "</label>";
                                        html+= "<input type='radio' class='pull-left' name='radio_" + count1 + "' value='" + value1.value + "'/>";
                                    });
                                    html+= "</div>";
                                    count1++;
                                }
                                else if(value.type == 'textarea')
                                {
                                    html+= "<textarea name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "' placeholder='" + placeholder + "' >" + actualValue + "</textarea>";
                                }

                                html+=      "</div>";
                                html+= "</div>";
                            });
                            html+= "</div>";
                            $('#cave_form').html(html);
                        }
                    <?php
                }
                ?>
                }
            });
        }
        
        
    }
    
    
    $('#cave_numb').change(function(){
        cave_num_global = $(this).val();
        $('#section-1').removeClass('hide');
        $('.section-2').addClass('hide');
        $('.section-3').addClass('hide');
        $('#cave-info-li').trigger('click');
        
        //$('#4-1').html('');
        $('#dummy-area').html('');
        
        $('#dropzone').find('.dz-complete').remove();
        $('#dropzone').removeClass('dz-started');
        
        refreshGalllery();
        if($(this).val() == '')
        {
            $('#section-1').addClass('hide');
            return;
        }
        
        if($('#cave_numb option:selected').attr('data-show') == 'add_cave')
        {
            $('#select-cave').addClass('hide');
            $('#add-cave').removeClass('hide');
        }
        else
        {
            $('#select-cave').removeClass('hide');
            $('#add-cave').addClass('hide');
        }
        
        $('#section-1').addClass('hide');
        $('#form-templte-select').val('custom');
        getFormValues();
        $('#section-1').removeClass('hide');
        getAllStoriesList();
        $('#image-count').text('No Images Selected');
    });
    
    $('#form-templte-select').change(function(){
        $('#section-1').addClass('hide');
        getFormValues();
        $('#section-1').removeClass('hide');
    });
});
        
jQuery(function($) {
    
    //var formBuilder = $(document.getElementById('build-wrap')).formBuilder();
     $('.cave_options').addClass('hide');
    //document.getElementById('getJSON1').addEventListener('click', function() {
    $(document).on('click', '#getJSON1', function(){
        var data = formBuilder.actions.getData('json');
        $.post('/caves/forms',{'data':data, 'cave_id': $('#cave_numb').val()}, function(res){
            alert(res);
        }).fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });
    });
    
    // document.getElementById('getJSON2').addEventListener('click', function() {
    $(document).on('click', '#getJSON2', function(){
        var data = formBuilder.actions.getData('json');
        var form_name = $('#form_name').val();
        $.post('/caves/forms',{'data':data, 'cave_id': $('#cave_numb').val(), 'form_name': form_name}, function(res){
            alert(res);
        }).fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });
    });
});

$(document).on('click', '.btn-close', function(){
   var markingID = $('#marking_id').val();
   console.log(markingID);
   
   var attr = $('#' + markingID).attr('data-id');
    // For some browsers, `attr` is undefined; for others,
    // `attr` is false.  Check for both.
    if (typeof attr == typeof undefined || attr == false) {
        $('#' + markingID).remove();
    }
   
});

$(document).on('change', '.div-toggle', function () {
   // $('#4-1').html('');
    $('#dropzone').find('.dz-complete').remove();
    $('#dropzone').removeClass('dz-started');
    //changing <div> according to the selected dropdown option
    var target = $(this).data('target'); //get data whose name is'target'
    var show = $("option:selected", this).data('show'); //get data from HTML elment option:selected of 'this' whose name is 'show'
    $(target).children().addClass('hide'); //hide  other options if they are shown previously by choosing their dropdown
    $(show).removeClass('hide');
        
        
    var height = $('.cb-wrap').height();
    $('.frmb').attr('style', 'min-height:' + height + 'px')
    //Access Cave Number and send AJAX to controller
    var e = document.getElementById("cave_numb");
    var cave_numb = e.options[e.selectedIndex].value;
    cave_num_global = cave_numb;
    refreshGalllery();

    $('#cave_id_image_upload').val(cave_numb);

    var cave_number = {
        'cave_numb': cave_numb
    };
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url("caves/getFormData"); ?>",
        data: cave_number,
        dataType: 'json',
        success: function (res, textStatus, xhr) {
            $('#2').show();
            $('#3').show();
          //  $("div#myId").dropzone({ url: "/file/post" });
          
                <?php
                if($this->session->userdata('user_profile') == 'administrator')
                {
                    ?>
                    $('#build-wrap').html('');
                    $('#form_name').val(res.formName);
                    
                    var fbEditor = document.getElementById('build-wrap');
                    formBuilder = $(fbEditor).formBuilder();
                    var formData = res.data;

                  //  document.getElementById('setData').addEventListener('click', function() {
                    setTimeout(
                        function() 
                        {
                            formBuilder.actions.setData(formData);
                        },500);
                    //activateDropZone();
                    <?php
                }
                else
                {
                    ?>
                        $('#cave_form').html('');
                        if(res.message == 'Empty Array')
                        {
                            $('#title_for_users').text('');
                        }
                        else
                        {
                            $('#title_for_users').text(res.formName);
                        }
                        var count1 = 0;
                        if(xhr.status == 200)
                        {
                            var html = '';
                            console.log(res.data);
                            var result = $.parseJSON(res.data);
                            html+= "<div class='col-xs-12 form-custom-container no-padding'>";
                            html+= "<input type='hidden' name='cave_id' value='" + cave_num_global + "' />";
                            $(result).each(function(i, value){
                                
                                html+= "<div class='col-xs-12 each-form-field'>";
                                html+=      "<label class='col-xs-12'>" + value.label + "</label>";
                                html+=      "<div class='col-xs-12' style='text-align:left'>";

                                var actualValue = '';
                                var placeholder = '';
                                
                                if(value.value != null)
                                {
                                    actualValue = value.value;
                                }  
                                if(value.value != null)
                                {
                                    placeholder = value.value;
                                }  
                                
                                if(value.type == 'file' || value.type == 'number' || value.type == 'date')
                                {
                                    html+=  "<input type='" + value.type + "' name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "' placeholder='" + placeholder + "' value='" + actualValue + "' />";
                                }
                                else if(value.type == 'button' || value.type == 'text')
                                {
                                    html+=  "<input type='" + value.subtype + "' name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "' placeholder='" + placeholder + "' value='" + actualValue + "' />";
                                }
                                else if(value.type == 'select')
                                {
                                    html+= "<select name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "'>";
                                    console.log(value.values);
                                    $(value.values).each(function(i1, value1){
                                        
                                        var selected = '';
                                        if(value1.selected == 1)
                                        {
                                            selected = 'selected="selected"';
                                        }
                                        html+=      "<option value='" + value1.label + "' " + selected + ">" + value1.value + "</option>";
                                    })

                                    html+= "</select>";
                                }
                                else if(value.type == 'checkbox-group')
                                {
                                    html+= "<div class='col-xs-12'>";
                                    $(value.values).each(function(i1, value1){
                                        html+= "<label class='pull-left'>" + value1.label + "</label>";
                                        html+= "<input type='checkbox' class='pull-left' value='" + value1.value + "'/>";
                                    });
                                    html+= "</div>";
                                }
                                else if(value.type == 'radio-group')
                                {
                                    html+= "<div class='col-xs-12'>";
                                    $(value.values).each(function(i1, value1){
                                        html+= "<label class='pull-left'>" + value1.label + "</label>";
                                        html+= "<input type='radio' class='pull-left' name='radio_" + count1 + "' value='" + value1.value + "'/>";
                                    });
                                    html+= "</div>";
                                    count1++;
                                }
                                else if(value.type == 'textarea')
                                {
                                    html+= "<textarea name='" + value.name + "' id='" + value.name + "' class='" + value.className + "' style='" + value.style + "' placeholder='" + placeholder + "' >" + actualValue + "</textarea>";
                                }

                                html+=      "</div>";
                                html+= "</div>";
                            });
                            html+= "</div>";
                            $('#cave_form').html(html);
                        }
                    <?php
                }
                ?>
            }
        });
    });
    
    Dropzone.autoDiscover = false;
    $('.dropzone').dropzone ({
            url: "/caves/uploadImage",
            init: function() {
                this.on("sending", function(file, xhr, formData){
                    formData.append("cave_num_global", cave_num_global)
                }),
                this.on("success", function(file, xhr){
                    alert(file.xhr.response);
                })
            },
    });        
                    
    $(document).on('click', '#refresh-button', function(res){
       refreshGalllery();
    });
    
    function refreshGalllery()
    {
        $('#info').val('');
        $('#show-image').addClass('hide');
        $('#image-details').addClass('hide');
        
        $('#dropzone').find('.dz-default').html('<span>Drop files here to upload</span>');
        $.get('/caves/getImages', {'cave_num' : cave_num_global}, function(res){
            var html = '';
            $(res).each(function(i,value){
                var bgImage = "'/assets/uploads/" + value.location + "'";
                html+= '<div class="col-xs-12 col-sm-6 col-md-3 top-margin image-each-container"><div class="col-xs-12 each-image-gallery" data-info="' + value.info + '" data-id=' + value.id + ' data-image=' + bgImage + ' style="background-image:url(' + bgImage + ');"></div></div>';
            });
            $('#image-gallery').html(html);
            $('#image-gallery-story').html(html);
        },'json').fail(function(xhr, textStatus, errorThrown) {
            $('#image-gallery').html('');
             $('#image-gallery-story').html('');
        },'json');
    }
    
    $(document).on('click', '#image-gallery .each-image-gallery', function(){
        $('.active-image-section-2').removeClass('active-image-section-2');
        var parent = $(this).parents('.image-each-container').first();
        $(parent).addClass('active-image-section-2');
        var image = $(this).attr('data-image');
        $('#show-image-image').attr('style', 'background-image:url("' + image + '")');
        if($(this).attr('data-info') != 'null')
        {
            $('#info').val($(this).attr('data-info'));
        }
        else
        {
            $('#info').val('');
        }
        $('#show-image').removeClass('hide');
        $('#image-details').removeClass('hide');
    });
    
    $(document).on('click', '#image-gallery-story .each-image-gallery', function(){
        var parent = $(this).parents('.image-each-container').first();
        
        $('.active-image').removeClass('active-image');
        $(parent).addClass('active-image');
        $('#image-count').text('1 Image Selected');
        $('#image-overlay-loading').remove();
        $('.marking').remove();
        var image = $(this).attr('data-image');
        var cave_image_id = $(this).attr('data-id');
        cave_image_id_global = cave_image_id;
        $('#4').show();
        //$('#4-1').html('<img class="col-xs-12 gallery-image-coordiate no-padding" id="hash-4-image" data-id="' + cave_image_id + '" src="' + image + '"/>');
        //window.location.href = '#3';
        var cave_num = cave_num_global;
        
        //getAllCaveStories(cave_num, cave_image_id);
        getAllStoriesList();
        //window.location.href = '#add-story';
    });
    
    
    function getAllCaveStories(cave_num, cave_image_id)
    {
        var count1 = 0;
        $.get('/caves/getAllCaveStories', {cave_num:cave_num, cave_image_id:cave_image_id}, function(res){
            //$('#4-1').append('<div class="col-xs-12" id="image-overlay-loading" style="position:absolute;height:100vh;text-align:center;background-color: rgba(0, 0, 0, 0.5);color:white;padding-top:70px;font-size:21px;font-weight:bold">Loading Stories</div>')
            var html = '<div id="story-container">';
            var html1 = '';
            $(res).each(function(i, value){
//                html+= '<a href="/caves/story/' + value.id + '" target="_blank" class="marking" id="new_' + count1++ + '" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + ' style="left:' + value.x + 'px;top:' + value.y + 'px"></a>';
//                html1+= '<a href="/caves/story/' + value.id + '" target="_blank" class="col-xs-12 each-story pull-left" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + '>' +  value.title + '</a>';
                var image = '';
                if(value.cave_image_id == 0)
                {
                    image = ' <b>- General Story</b>';
                }
                
                html+= '<a href="/caves/story/' + value.id + '" target="_blank" class="col-xs-12 each-story pull-left" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + '>' +  value.title + image + '</a>';
                
                html1+= '<div class="col-sm-12 each-story-container" data-story-id="' + value.id + '" >';
                
                
                html1+= '<div class="each-story" data-id="' + value.id + '">' + value.title + image + '<i class="fa fa-chevron-down pull-right"></i></div>';
                html1+= '<div class="each-story-description" data-id="' + value.id + '" style="display:none"><div class="col-sm-12"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-primary" id="add-title">Add Chapter</button><button type="button" class="btn btn-danger remove-story" data-id="' + value.id + '"><i class="fa fa-remove"></i></button></div><div class="col-sm-12"></div><div class="each-story-description-main col-sm-12"><i class="fa fa-spin fa-spinner"></i> Loading...</div></div>';
                
                html1+= '</div>';
            });
            
            html+= '</div>';
            
           // $('#4-1').append(html);
            //$('#story-headers').html(html1);
            $('#story-headers').html(html);
            $('#section-loading .row').html(html1);
            $('#image-overlay-loading').remove();
            //$('#cave-story-li').trigger('click');
            fetchEachDescription();
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON.message);
            $('.btn-close').removeAttr('disabled');
            $('#image-overlay-loading').remove();
        },'json');
    }
    
    $(document).on('click', '.gallery-image-coordiate', function(e){
        var offset = $(this).offset();
        var left = (e.pageX - offset.left) -5;
        var top = (e.pageY - offset.top) - 5;
        count = count + 1;
        //$('#4-1').append('<div class="marking" id="coordinate_' + count + '" data-x=' + left + ' data-y=' + top + ' style="left:' + left + 'px;top:' + top + 'px"></div>');
        $('#title').val('');
        $('#description').val('');
        $('#marking_id').val('coordinate_' + count);
        $('#story_id').val('');
        $('#storyModal').modal('show');
    });
    
    $(document).on('click', '#btn-save-story', function(){
        $('.error').html('<div class="alert alert-warning">Updating Story.....</div>');
        $('#btn-save-story').attr('disabled', 'disabled');
        var data = new Object();
        var title = data['title'] = $('#modal_story_title').val();
        var description = data['description'] = $('#modal_story_description').val();
       // data['cave_image_id'] = $('.gallery-image-coordiate').attr('data-id');
        //data['cave_num'] = cave_num_global;
        
//        if($('#marking_id').val() != '')
//        {
//            var markingID = $('#marking_id').val();
//            data['x'] = $('#' + markingID).attr('data-x');
//            data['y'] = $('#' + markingID).attr('data-y');
//            data['window_width'] = document.getElementById('hash-4-image').clientWidth;
//            data['image_actual_width'] = document.getElementById('hash-4-image').naturalWidth;
//            data['window_height'] = document.getElementById('hash-4-image').clientHeight;
//            data['image_actual_height'] = document.getElementById('hash-4-image').naturalHeight;
//        }
//        if($('#story_id').val().trim() == '')
//        {
//            $.post('/caves/saveStory', {data:data}, function(res){
//                $('#' + markingID).attr('data-title', title);
//                $('#' + markingID).attr('data-description', description);
//                $('#' + markingID).attr('data-id', res.id);
//                $('#story_id').val(res.id);
//
//                alert("Story Saved Successfully");
//                
//                //getAllCaveStories(cave_num_global, cave_image_id_global);
//                getAllStoriesList();
//                
//                $('#storyModal').modal('hide');
//                $('.btn-close').removeAttr('disabled');
//            },'json').fail( function(xhr, textStatus, errorThrown) {
//                alert(xhr.responseJSON.message);
//                $('.btn-close').removeAttr('disabled');
//            },'json');
//        }
//        else
//        {
            var storyID = $('#story_id').val();
            updateStory(data, storyID);
  //      }
    });
    
    $(document).on('click', '#story-update', function(){
        $('.story_error').html('<div class="alert alert-warning">Updating Story.....</div>');
        $('#btn-save-story').attr('disabled', 'disabled');
        var data = new Object();
        var title = data['title'] = $('#cave_title').val();
        var description = data['description'] = $('#cave_description').val();
        var storyID = $('.story-active').attr('data-id');
        $.post('/caves/updateStory', {data:data, storyID:storyID}, function(res){
                $('.story_error').html('<div class="alert alert-success">Story Updated Successfully</div>');
                $('#btn-save-story').removeAttr('disabled');
               
                $('#story-count').text('No Story Selected');
                $('.story-update-buttons').hide();
                $('#story-save').show();
                $('#new_story').hide();
                
                $('#cave_title').val('');
                $('#cave_description').val('');
                getAllStoriesList();
            },'json').fail( function(xhr, textStatus, errorThrown) {
                $('.story_error').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                $('#btn-save-story').removeAttr('disabled');
            },'json');
        
    });
    
    function updateStory(data, storyID)
    {
        $.post('/caves/updateStory', {data:data, storyID:storyID}, function(res){
                $('.error').html('<div class="alert alert-success">Story Updated Successfully</div>');
                $('#btn-save-story').removeAttr('disabled');
                getAllStoriesList();
            },'json').fail( function(xhr, textStatus, errorThrown) {
                $('.error').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                $('#btn-save-story').removeAttr('disabled');
            },'json');
    }
    
    
//    $(document).on('click', '.marking', function(){
//        var title = $(this).attr('data-title');
//        var description = $(this).attr('data-description');
//        var id = $(this).attr('data-id');
//        $('#title').val(title);
//        $('#description').val(description);
//        $('#story_id').val(id);
//        $('#marking_id').val($(this).attr('id'));
//        
//        $('#storyModal').modal('show');
//    });
    
//    $(document).on('click', '.each-story', function(){
//        var title = $(this).attr('data-title');
//        var description = $(this).attr('data-description');
//        var id = $(this).attr('data-id');
//        $('#title').val(title);
//        $('#description').val(description);
//        $('#story_id').val(id);
//        $('#marking_id').val($(this).attr('id'));
//        
//        $('#storyModal').modal('show');
//    });
    
    $(document).on('click', '#btn-delete', function(){
        var markingID = $('#marking_id').val();
        var storyID = $('#' + markingID).attr('data-id');
        
         // For some browsers, `attr` is undefined; for others,
             // `attr` is false.  Check for both.
             if (typeof storyID == typeof undefined || storyID == false) {
                 console.log("A");
                 $('#' + markingID).remove();
                 $('#storyModal').modal('hide');
             }
             else
             {
                $.get('/caves/deleteCaveStory', {'storyID' : storyID}, function(){
                    $('[data-id="' + storyID + '"]').remove();
                    $('#storyModal').modal('hide');
                    alert("Story Deleted Successfully");
                },'json').fail( function(xhr, textStatus, errorThrown) {
                   alert(xhr.responseJSON.message);
                   $('.btn-close').removeAttr('disabled');
               },'json');;
           }
    });
    
    $(document).on('click', '#btn-add', function(res){
        $('#chapters-text').append('<input type="text" class="form-control top-margin" placeholder="Add Chapters"/>');
    });
    
    $(document).on('click', '#add-new-story', function(){
        $('#title').val('');
        $('#description').val('');
        $('#marking_id').val('coordinate_' + count);
        $('#story_id').val('');
        $('#storyModal').modal('show');
    });
    
    function getGeneralStoriesList()
    {
        var caveNumb = $('#cave_numb').val();
        $.post('/caves/generalStories', {caveNumb:caveNumb}, function(res){
           var html = '<table class="table table-bordered table-striped">';
            $(res).each(function(i, value){
                html+= '<tr><td><a href="/caves/story/' + value.id + '" target="_blank">' + value.title + '</a></td></tr>';
            });
            html+= '</table>'
            
            $('#general-stories-list').html(html);
        },'json');
    }
    
    
    function getAllStoriesList()
    {
        var cave_image_id = cave_image_id_global;
        var count1 = 0;
         var caveNumb = $('#cave_numb').val();
         
         if(cave_image_id == 0)
         {
            $.post('/caves/allStories', {caveNumb:caveNumb}, function(res){
                addToStoryLine(res);
            },'json');
        }
        else
        {
            var count1 = 0;
            $.get('/caves/getAllCaveStories', {cave_num:caveNumb, cave_image_id:cave_image_id}, function(res){
                addToStoryLine(res);
                $('#image-overlay-loading').remove();
                //$('#cave-story-li').trigger('click');
                //$('#4-1').append('<div class="col-xs-12" id="image-overlay-loading" style="position:absolute;height:100vh;text-align:center;background-color: rgba(0, 0, 0, 0.5);color:white;padding-top:70px;font-size:21px;font-weight:bold">Loading Stories</div>')
                
            },'json').fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON.message);
                $('.btn-close').removeAttr('disabled');
                $('#image-overlay-loading').remove();
            },'json');
        }
        
        
//        html+= '<div class="col-xs-12 each-story-title-container">';
//                html+= '<div class="each-story-title">' + value.name + '<i class="fa fa-chevron-down pull-right"></i></div>';
//                html+= '<div class="each-story-title-description" style="display:none">' + value.description + '</div>';
//                html+= '</div>';
    }
    
    function fetchEachDescription()
    {
        $('.each-story-description').each(function(){
            var id = $(this).attr('data-id');
            getAllTitles(id);
        });
    }
    
    function addToStoryLine(res)
    {
        var html = '<div id="story-container">';
                var html1 = '';
                $(res).each(function(i, value){
    //                html+= '<a href="/caves/story/' + value.id + '" target="_blank" class="marking" id="new_' + count1++ + '" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + ' style="left:' + value.x + 'px;top:' + value.y + 'px"></a>';
    //                html1+= '<a href="/caves/story/' + value.id + '" target="_blank" class="col-xs-12 each-story pull-left" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + '>' +  value.title + '</a>';
                    var image = '';
                    if(value.cave_image_id == 0)
                    {
                        image = ' <b>- General Story</b>';
                    }

                    html+= '<div class="col-xs-12 each-story pull-left" data-id="' + value.id + '" data-title="' + value.title + '" data-description="' + value.description + '" data-x="' + value.x + '" data-y="' + value.y + '">' +  value.title + image + '</div>';

                    html1+= '<div class="col-sm-12 each-story-container" data-story-id="' + value.id + '" id="data-story-id-' + value.id + '">';


                    html1+= '<div class="each-story" data-id="' + value.id + '">' + value.title + image + '<i class="fa fa-chevron-down pull-right"></i></div>';
                    html1+= '<div class="each-story-description" data-id="' + value.id + '" style="display:none"><div class="col-sm-12"><button data-id="' + value.id + '" type="button" class="btn btn-success edit-story-button"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-primary add-title" data-id="' + value.id + '">Add Chapter</button><button type="button" class="btn btn-danger remove-story" data-id="' + value.id + '"><i class="fa fa-remove"></i></button></div><div class="col-sm-12"></div><div class="each-story-description-main col-sm-12"><i class="fa fa-spin fa-spinner"></i> Loading...</div></div>';

                    html1+= '</div>';
                });

                html+= '</div>';

               // $('#4-1').append(html);
                //$('#story-headers').html(html1);
                $('#story-headers').html(html);
                $('#section-loading .row').html(html1);
                
                fetchEachDescription();
    }
    
    function getAllTitles(id)
    {
        $.get('/title/all/' + id, function(res){
            var html = '';
            $(res).each(function(i, value){
                html+= '<div class="col-sm-12 each-story-title-container">';
                html+= '<p class="each-story-title col-sm-12">Chapter : ' + value.name + '<i class="fa fa-chevron-down pull-right"></i></p>';
                html+= '<div class="each-story-title-description col-sm-12" >' + value.description + '</div>';
                if(value.mp3 != '' && value.mp3 != null)
                {
                    html+= '<div class="col-sm-12 mp3-container"><audio controls><source src="/assets/uploads/mp3/' + value.mp3 + '" type="audio/mp3"></audio></div>';
                }
                html+= '<div class="each-story-action-button col-sm-12 top-margin"><button type="button" class="btn btn-success col-sm-3 btn-edit-title" data-id="' + value.id + '"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger col-sm-3 delete-chapter" data-id="' + value.id + '"><i class="fa fa-remove"></i></button><button type="button" class="btn btn-primary col-sm-3" data-id="' + value.id + '"><i class="fa fa-plus"></i></button><button type="button" class="btn btn-warning col-sm-3 add-mp3" data-title="' + value.name + '" data-id="' + value.id + '"><i class="fa fa-music"></i></button></div></div>';
            });
            $('[data-story-id="' + id + '"]').find('.each-story-description-main').html(html);
        },'json');
    }
    
    $(document).on('click', '.each-story', function(){
        var parent = $(this).parents('.each-story-container').first();
        $(parent).find('.each-story-description').slideToggle();
    });
</script>


<script>
    $(document).ready(function(){
        $('#caves-li').addClass('active');
    });
    
    $(document).on('click', '.edit-story-button', function(){
        currentStoryGlobal = $(this).attr('data-id');
        $('#storyModal').modal('show');
        getCurrentStory();
    });
    
    $(document).on('click', '.add-title', function(){
        currentStoryGlobal = $(this).attr('data-id');
        $('#titleModal').modal('show');
    });
    
     $(document).on('click', '#btn-save-title', function(){
        $(this).attr('disabled', 'disabled');
        $('.title-error').html('<div class="alert alert-warning">Saving Title.....</div>');
        var data = new Object();
        data['name'] = $('#modal_title_title').val();
        data['description'] = CKEDITOR.instances['modal_title_description'].getData();
        saveTitle(data);
    });
    
    $(document).on('click', '#btn-update-title', function(){
        $(this).attr('disabled', 'disabled');
        $('.title-error').html('<div class="alert alert-warning">Saving Title.....</div>');
        var data = new Object();
        data['name'] = $('#modal_title_title_update').val();
        data['description'] = CKEDITOR.instances['modal_title_description_update'].getData();
        updateTitle(data);
    });
    
    $(document).on('click', '.btn-edit-title', function(){
        currentTitleGlobal = $(this).attr('data-id');
        $('#titleModalUpdate').modal('show');
        getCurrentTitle();
    });
    
    $(document).on('click', '.add-mp3', function(){
        var title = $(this).attr('data-title');
        var taskID = $(this).attr('data-id');
        $('#addMp3Modal').modal('show');
        $('#reference_task_id').val(taskID);
    });
    
    $(document).on('click', '.remove-story', function(){
        var conf = confirm("Removing Story will remove all the associated titles. Are you sue you want to continue?");
        if(!conf)
        {
            return;
        }
        $(this).attr('disabled', 'disabled');
        var current = $(this);
        var id = $(this).attr('data-id');
        $.post('/stories/delete/' + id, function(){
            getAllStoriesList();
            alert('Story Deleted Successfully');
            $(current).removeAttr('disabled');
            $('.story-active').removeClass('story-active');
            $('#story-count').text('No Story Selected');
            $('.story-update-buttons').hide();
            $('#story-save').show();
            $('#new_story').hide();

            $('#cave_title').val('');
            $('#cave_description').val('');
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON);
            $(current).removeAttr('disabled');
        },'json');
    });
    
    $(document).on('click', '.delete-chapter', function(){
        var conf = confirm(" Are you sue you want to continue removing chapter?");
        if(!conf)
        {
            return;
        }
        $(this).attr('disabled', 'disabled');
        var current = $(this);
        var id = $(this).attr('data-id');
        $.post('/stories/delete_title/' + id, function(){
            getAllStoriesList();
            alert('Title Deleted Successfully');
            $(current).removeAttr('disabled');
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON);
            $(current).removeAttr('disabled');
        },'json');
    });
    
    $(document).on('submit', '#mp3-form', function(e){
        e.preventDefault();    
        $('#file-upload-error').html('<div class="alert alert-warning">Uplaoding In Progress. Please Wait....</div>');
        $('#btn-upload-title').attr('disabled', 'disabled');
        var formData = new FormData(this);

        $.ajax({
            url: '/title/file_upload/',
            type: 'POST',
            data: formData,
            success: function (data) {
                $('#btn-upload-title').removeAttr('disabled');
                $('#file-upload-error').html('<div class="alert alert-success">File Uploaded Successfully</div>');
                $('#file').val('');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('#btn-upload-title').removeAttr('disabled'); 
                $('#file-upload-error').html('<div class="alert alert-danger">' + XMLHttpRequest.responseText + '</div>');
            }, 
            cache: false,
            contentType: false,
            processData: false
        });
        
        
        
        $('.title-error').html('<div class="alert alert-warning">Uploading File. PLease Wait....</div>');
        var data = new Object();
        data['name'] = $('#modal_title_title_update').val();
        data['description'] = CKEDITOR.instances['modal_title_description_update'].getData();
        updateTitle(data);
    });
    
    function getCurrentStory()
    {
        $.get('/stories/current/' + currentStoryGlobal, function(res){
            $('#modal_story_title').val(res.title);
            $('#modal_story_description').val(res.description);
            $('#story_id').val(res.id);
            $('#story-model-loading').addClass('hide');
            $('.story-model').removeClass('hide');
        },'json');
    }
    
    function getCurrentTitle()
    {
        $.get('/title/current/' + currentTitleGlobal, function(res){
            $('#modal_title_title_update').val(res.name);
            CKEDITOR.instances['modal_title_description_update'].setData(res.description);
            $('#title-model-loading').addClass('hide');
            $('.title-model').removeClass('hide');
        },'json');
    }
    
    function saveTitle(data)
    {
        $.post('/title/save/' + currentStoryGlobal, {data:data}, function(res){
                $('.title-error').html('<div class="alert alert-success">Title Added Successfully</div>');
                $('#btn-save-title').removeAttr('disabled');
                window.location.href = '#title-error';
                getAllStoriesList();
            },'json').fail( function(xhr, textStatus, errorThrown) {
                $('.title-error').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                $('#btn-save-title').removeAttr('disabled');
                window.location.href = '#title-error';
            },'json');
    }
    
    function updateTitle(data)
    {
         $.post('/title/update/' + currentTitleGlobal, {data:data}, function(res){
                $('.title-update-error').html('<div class="alert alert-success">Title Updated Successfully</div>');
                $('#btn-update-title').removeAttr('disabled');
                window.location.href = '#title-update-error';
                getAllStoriesList();
            },'json').fail( function(xhr, textStatus, errorThrown) {
                $('.title-update-error').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                $('#btn-update-title').removeAttr('disabled');
                window.location.href = '#title-update-error';
            },'json');
    }
    
    $(document).on('click', '.mp3-container', function(){
        
        var current = $(this);
        var titleID = $(this).find('.mp3-area').attr('data-id');
        $(this).attr('disabled', 'disabled').text('Loading Files...');
        $.get('/title/mp3/' + titleID, function(res){
            var html = '';
            $(res).each(function(i, value){
                html+= '<div class="col-sm-12"><audio controls><source src="/assets/uploads/mp3/' + value.location + '" type="audio/mp3"></audio></div>';
            });
            $(current).html(html);
        },'json').fail( function(xhr, textStatus, errorThrown) {
            $('.title-update-error').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
            $('#btn-update-title').removeAttr('disabled');
            window.location.href = '#title-update-error';
        },'json');
    });
    
    $(document).on('click', '#add-story', function(){
        var id = $('.active-image-section-2').find('.each-image-gallery').attr('data-id');
        $('#cave-story-li').trigger('click');
        var currentImage = $('#image-gallery-story').find('[data-id="' + id + '"]');
        $(currentImage).parents('.image-each-container').first().addClass('active-image');
        $(currentImage).trigger('click');
        
    }); 
    
    $(document).on('click', '#story-container .each-story', function(){
        $('#remove-story-button').attr('data-id', $(this).attr('data-id'));
        $('#add-title').attr('data-id', $(this).attr('data-id'));
        $('.story-active').removeClass('story-active');
        $(this).addClass('story-active');
        $('#story-count').text('1 Story Selected');
        $('.story-update-buttons').show();
        $('#story-save').hide();
        $('#new_story').show();
        var title = $(this).attr('data-title');
        var desc = $(this).attr('data-description');
        $('#cave_title').val(title);
        $('#cave_description').val(desc);
        currentStoryGlobal = $(this).attr('data-id');
    });
    
    $(document).on('click', '#list-title', function(){
        console.log(currentStoryGlobal);
        $('[data-story-id="' + currentStoryGlobal + '"]').find('.each-story-description').slideDown();
        window.location.href = '#data-story-id-' + currentStoryGlobal;
        //$('#listChapters').modal('show');
        //getAllTitlesOfStory();
    });
    
    function getAllTitlesOfStory()
    {
        $.get('/title/all/' + currentStoryGlobal, function(res){
            var html = '';
            $(res).each(function(i, value){
                html+= '<div class="col-sm-12 each-story-title-container">';
                html+= '<p class="each-story-title col-sm-12">Chapter : ' + value.name + '<i class="fa fa-chevron-down pull-right"></i></p>';
                html+= '<div class="each-story-title-description col-sm-12" >' + value.description + '</div>';
                if(value.mp3 != '' && value.mp3 != null)
                {
                    html+= '<div class="col-sm-12 mp3-container"><audio controls><source src="/assets/uploads/mp3/' + value.mp3 + '" type="audio/mp3"></audio></div>';
                }
                html+= '<div class="each-story-action-button col-sm-12 top-margin"><button type="button" class="btn btn-success col-sm-3 btn-edit-title" data-id="' + value.id + '"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger col-sm-3 delete-chapter" data-id="' + value.id + '"><i class="fa fa-remove"></i></button><button type="button" class="btn btn-primary col-sm-3" data-id="' + value.id + '"><i class="fa fa-plus"></i></button><button type="button" class="btn btn-warning col-sm-3 add-mp3" data-title="' + value.name + '" data-id="' + value.id + '"><i class="fa fa-music"></i></button></div></div>';
            });
            $('#title-modal-list').html(html);
            $(current).html(html);
        },'json').fail( function(xhr, textStatus, errorThrown) {
            $('.title-update-error').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
            $('#btn-update-title').removeAttr('disabled');
            window.location.href = '#title-update-error';
        },'json');
    }
    
    $(document).on('click', '#new_story', function(){
        newStoryEnviournment();
    });
    
    function newStoryEnviournment()
    {
        $('.story-active').removeClass('story-active');
        $('#story-count').text('No Story Selected');
            $('.story-update-buttons').hide();
            $('#story-save').show();
            $('#new_story').hide();

            $('#cave_title').val('');
            $('#cave_description').val('');
    }
</script>