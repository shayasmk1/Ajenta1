<script type="text/javascript" src="/assets/js/cavescript.js"></script>
<link href = "/assets/css/dropzone.css" rel = "stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<!--<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>-->
<script src="/assets/libraries/formBuilder/dist/form-builder.min.js"></script>
<script src="/assets/js/dropzone.js"></script>

<script type="text/javascript">
    var formBuilder = '';
    var myDropzone = '';
    var cave_num_global = 0;
    var count = 0;
    
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
                            </ul>
                        </div>
                    </div>
                    <div class="card hide" id="section-1">
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
                                            <div class="form-group">
                                                <div class="col-xs-12 top-margin-big no-padding">
                                                    <label class="col-xs-12 pull-left" style="text-align:left">Add a name for this form</label>
                                                    <input type="text" class="form-control" id="form_name" placeholder="Add a name for form" />
                                                </div>
                                            </div>
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
                    
                    <div class="card section-2 hide">
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
                    
                    <div class="card section-2 hide">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Image Gallery</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                        <div class='col-xs-12' id="image-gallery" style="height:200px;overflow:auto;background-color:white;border:1px solid">

                                        </div>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card section-3 hide">
                        <div class="card-header">
                            <strong>Caves</strong>
                            <small>Stories</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id='4' class='col-xs-12' style="display:none;margin-top:0px;padding-bottom:55px;">
                                        <div class="col-xs-12 col-sm-3 pull-left" id="story-headers">
                                            
                                        </div>
                                        <div id='4-1' class='col-xs-12 col-sm-9 no-padding pull-right' style="position:relative;">

                                        </div>
                                        <div class="dummy-area" style="z-index: 10;position:absolute;left:0;top:0">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card hide" id="section-loading">
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
</main>

<!-- Modal -->
<div class="modal" id="storyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-xs-12 no-padding">
      <div class="modal-header col-xs-12 no-padding">
        <h5 class="modal-title col-xs-6" id="exampleModalLabel">Add Story</h5>
        <button type="button" class="close col-xs-6 pull-right btn-close" data-dismiss="modal" aria-label="Close" style="text-align: right;padding-right:15px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-xs-12 no-padding">
          <div class="col-xs-12">
              <label class="col-xs-12 no-padding">Story Title</label>
              <div class="col-xs-12 no-padding">
                  <input type="text" class="form-control" id="title"/>
              </div>
          </div>
          <div class="col-xs-12 top-margin">
              <h4>Add Chapters <button type="button" class="btn btn-xs pull-right btn-danger" id="btn-add"><i class="fa fa-plus"></i></button></h4>
          </div>
          <div class="col-xs-12 " id="chapters-text">
              <input type="text" class="form-control top-margin" placeholder="Add Chapters"/>
          </div>
<!--          <div class="col-xs-12 ">
              <label class="col-xs-12 no-padding">Story Description</label>
               <div class="col-xs-12 no-padding">
                   <textarea class="form-control" id="description" style="height:150px"></textarea>
              </div>
          </div>-->
          <input type="hidden" value="" id="marking_id" />
          <input type="hidden" id="story_id" />
      </div>
      <div class="modal-footer col-xs-12">
        <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
        <button type="button" class="btn btn-danger" id="btn-delete">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('#cave-info-li').click(function(){
        $('#section-1').removeClass('hide');
        $('.section-2').addClass('hide');
        $('.section-3').addClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-info-li a').addClass('active');
    });
    
    $('#cave-gallery-li').click(function(){
        $('#section-1').addClass('hide');
        $('.section-2').removeClass('hide');
        $('.section-3').addClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-gallery-li a').addClass('active');
    });
    
    $('#cave-story-li').click(function(){
        $('#section-1').addClass('hide');
        $('.section-2').addClass('hide');
        $('.section-3').removeClass('hide');
        $('#cave-sub-menu li a').removeClass('active');
        $('#cave-story-li a').addClass('active');
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
                        $('#section-loading').addClass('hide');
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
                            $('#section-loading').addClass('hide');
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
        
        $('#4-1').html('');
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
    $('#4-1').html('');
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
        $('#dropzone').find('.dz-default').html('<span>Drop files here to upload</span>');
        $.get('/caves/getImages', {'cave_num' : cave_num_global}, function(res){
            var html = '';
            $(res).each(function(i,value){
                var bgImage = "'/assets/uploads/" + value.location + "'";
                html+= '<div class="col-xs-12 col-sm-6 col-md-3 top-margin image-each-container"><div class="col-xs-12 each-image-gallery" data-id=' + value.id + ' data-image=' + bgImage + ' style="background-image:url(' + bgImage + ');"></div></div>';
            });
            $('#image-gallery').html(html);
        },'json').fail(function(xhr, textStatus, errorThrown) {
            $('#image-gallery').html('');
        },'json');
    }
    
    $(document).on('click', '.each-image-gallery', function(){
        $('#image-overlay-loading').remove();
        $('.marking').remove();
        var image = $(this).attr('data-image');
        var id = $(this).attr('data-id');
        $('#4').show();
        $('#4-1').html('<img class="col-xs-12 gallery-image-coordiate no-padding" id="hash-4-image" data-id="' + id + '" src="' + image + '"/>');
        window.location.href = '#3';
        var cave_num = cave_num_global;
        var count1 = 0;
        $.get('/caves/getAllCaveStories', {cave_num:cave_num, cave_image_id:id}, function(res){
            $('#4-1').append('<div class="col-xs-12" id="image-overlay-loading" style="position:absolute;height:100vh;text-align:center;background-color: rgba(0, 0, 0, 0.5);color:white;padding-top:70px;font-size:21px;font-weight:bold">Loading Stories</div>')
            var html = '';
            var html1 = '';
            $(res).each(function(i, value){
                html+= '<div class="marking" id="new_' + count1++ + '" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + ' style="left:' + value.x + 'px;top:' + value.y + 'px"></div>';
                html1+= '<div class="col-xs-12 each-story" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + '>' +  value.title + '</div>';
            });
            
            html1+= '<button type="button" class="btn btn-success col-xs-12 col-sm-12" id="add-new-story">Add New Story</button>';
            console.log(html);
            $('#4-1').append(html);
            $('#story-headers').html(html1);
            $('#image-overlay-loading').remove();
            $('#cave-story-li').trigger('click');
        },'json').fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseJSON.message);
            $('.btn-close').removeAttr('disabled');
            $('#image-overlay-loading').remove();
        },'json');
    });
    
    $(document).on('click', '.gallery-image-coordiate', function(e){
        var offset = $(this).offset();
        var left = (e.pageX - offset.left) -5;
        var top = (e.pageY - offset.top) - 5;
        count = count + 1;
        $('#4-1').append('<div class="marking" id="coordinate_' + count + '" data-x=' + left + ' data-y=' + top + ' style="left:' + left + 'px;top:' + top + 'px"></div>');
        $('#title').val('');
        $('#description').val('');
        $('#marking_id').val('coordinate_' + count);
        $('#story_id').val('');
        $('#storyModal').modal('show');
    });
    
    $(document).on('click', '#btn-save', function(){
        $('.btn-close').attr('disabled', 'disabled');
        var data = new Object();
        var title = data['title'] = $('#title').val();
        var description = data['description'] = $('#description').val();
        data['cave_image_id'] = $('.gallery-image-coordiate').attr('data-id');
        data['cave_num'] = cave_num_global;
        
        var markingID = $('#marking_id').val();
        data['x'] = $('#' + markingID).attr('data-x');
        data['y'] = $('#' + markingID).attr('data-y');
        data['window_width'] = document.getElementById('hash-4-image').clientWidth;
        data['image_actual_width'] = document.getElementById('hash-4-image').naturalWidth;
        data['window_height'] = document.getElementById('hash-4-image').clientHeight;
        data['image_actual_height'] = document.getElementById('hash-4-image').naturalHeight;
        if($('#story_id').val().trim() == '')
        {
            $.post('/caves/saveStory', {data:data}, function(res){
                $('#' + markingID).attr('data-title', title);
                $('#' + markingID).attr('data-description', description);
                $('#' + markingID).attr('data-id', res.id);
                $('#story_id').val(res.id);

                alert("Story Saved Successfully");
                $('#storyModal').modal('hide');
                $('.btn-close').removeAttr('disabled');
            },'json').fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON.message);
                $('.btn-close').removeAttr('disabled');
            },'json');
        }
        else
        {
            var storyID = $('#story_id').val();
            $.post('/caves/updateStory', {data:data, storyID:storyID}, function(res){
                $('[data-id="' + storyID + '"]').attr('data-title', title);
                $('[data-id="' + storyID + '"]').attr('data-description', description);
                $('[data-id="' + storyID + '"]').attr('data-id', res.id);
                $('#story_id').val(res.id);

                alert("Story Saved Successfully");
                $('#storyModal').modal('hide');
                $('.btn-close').removeAttr('disabled');
            },'json').fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON.message);
                $('.btn-close').removeAttr('disabled');
            },'json');
        }
    });
    
    $(document).on('click', '.marking', function(){
        var title = $(this).attr('data-title');
        var description = $(this).attr('data-description');
        var id = $(this).attr('data-id');
        $('#title').val(title);
        $('#description').val(description);
        $('#story_id').val(id);
        $('#marking_id').val($(this).attr('id'));
        
        $('#storyModal').modal('show');
    });
    
    $(document).on('click', '.each-story', function(){
        var title = $(this).attr('data-title');
        var description = $(this).attr('data-description');
        var id = $(this).attr('data-id');
        $('#title').val(title);
        $('#description').val(description);
        $('#story_id').val(id);
        $('#marking_id').val($(this).attr('id'));
        
        $('#storyModal').modal('show');
    });
    
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
        
</script>


<script>
    $(document).ready(function(){
        $('#caves-li').addClass('active');
    });
</script>