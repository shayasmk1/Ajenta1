<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cavescript.js"></script>

<!-- Script for Auto complete 3 -->
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<!--<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" rel = "stylesheet">

<link href = "/assets/css/dropzone.css" rel = "stylesheet">

<!--<link rel="stylesheet" type="text/css" href="/assets/libraries/formBuilder/demo/assets/css/demo.css">-->
<!--<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.1/jquery.rateyo.min.css">-->

<!--<script src="/assets/libraries/formBuilder/demo/assets/js/vendor.js"></script>-->
<!--  <script src="/assets/libraries/formBuilder/dist/form-builder.min.js"></script>
  <script src="/assets/libraries/formBuilder/dist/form-render.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>

<!--<link rel="stylesheet" href="/assets/fileUpload/css/jquery.fileupload.css">
<link rel="stylesheet" href="/assets/fileUpload/css/jquery.fileupload-ui.css">-->

<!-- The basic File Upload plugin -->
<!--<script src="/assets/fileUpload/js/jquery.fileupload.js"></script>
 The File Upload processing plugin 
<script src="/assets/fileUpload/js/jquery.fileupload-process.js"></script>
 The File Upload image preview & resize plugin 
<script src="/assets/fileUpload/js/jquery.fileupload-image.js"></script>
 The File Upload audio preview plugin 
<script src="/assets/fileUpload/js/jquery.fileupload-audio.js"></script>
 The File Upload video preview plugin 
<script src="/assets/fileUpload/js/jquery.fileupload-video.js"></script>
 The File Upload validation plugin 
<script src="/assets/fileUpload/js/jquery.fileupload-validate.js"></script>
 The File Upload user interface plugin 
<script src="/assets/fileUpload/js/jquery.fileupload-ui.js"></script>-->

<script src="/assets/js/dropzone.js"></script>

<style>
    .hide{
        display: none;
    }

    .center {
        margin: auto;
        width: 100%;
        border: 2px solid green;
        text-align: center;
        padding: 10px;
    }
    
    .cave-section {
  padding: 0;
  margin: 10px 0;
  background: #f2f2f2 url('http://formbuilder.readthedocs.io/en/latest/img/noise.png');
}

.form-custom-container label
{
    text-align: left;
}


</style>

<script type="text/javascript">
    var formBuilder = '';
    var myDropzone = '';
    var cave_num_global = 0;
    var count = 0;
    

        
    $(document).ready(function () {
       // $('.switch_data').trigger('change');
    });
 
</script>




<script>
    function makeEdit() {
        document.getElementById("two").contentEditable = true;
        document.getElementById("three").contentEditable = true;
        document.getElementById("four").contentEditable = true;
        document.getElementById("five").contentEditable = true;
        document.getElementById("editBtn").disabled = true;
        document.getElementById("updateBtn").disabled = false;
        document.getElementById("deleteBtn").disabled = false;
    }
</script>
<script type="text/javascript">
    $(function () {
        $('#updateBtn').click(function () {
            //get input data as a array
            var post_data = {
                'cave_numb': $("#one").html(),
                'cave_description': $("#two").html(),
                'cave_patron': $("#three").html(),
                'cave_period': $("#four").html(),
                'cave_type': $("#five").html()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("caves/updateCave"); ?>",
                data: post_data,
                success: function (data) {
                    //Create jQuery object from the response HTML.
                    //console.log(data);
                    var data = eval("(" + data + ")");
                    //console.log(data.one_cave_data[0].cave_description);

                    $("#one").html(data.one_cave_data[0].cave_numb);
                    $("#two").html(data.one_cave_data[0].cave_description);
                    $("#three").html(data.one_cave_data[0].cave_patron);
                    $("#four").html(data.one_cave_data[0].cave_period);
                    $("#five").html(data.one_cave_data[0].cave_type);
                }
            });


            document.getElementById("two").contentEditable = false;
            document.getElementById("three").contentEditable = false;
            document.getElementById("four").contentEditable = false;
            document.getElementById("five").contentEditable = false;
            document.getElementById("editBtn").disabled = false;
            document.getElementById("deleteBtn").disabled = true;
            document.getElementById("updateBtn").disabled = true;
        });
    });
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

<script>
    function isNormalInteger(n) {
        return n % 1 === 0 ? true : false;
    }
</script>

<script type="text/javascript">
    $(function () {
        $('#newCaveBtn').click(function () {
            if (isNormalInteger(document.getElementById("add_cave").value)) {
                var caveToAdd = document.getElementById("add_cave").value;
                var x = document.getElementById("cave_numb");
                var option = document.createElement("option");
                var cave = "Cave ";
                var res = cave.concat(caveToAdd);
                option.text = res;
                option.value = caveToAdd;
                x.add(option);
                document.getElementById('newCaveBtn').style.visibility = 'hidden';
                document.getElementById('caveadded').innerHTML = "Cave is Added !";
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
                        //Create jQuery object from the response HTML.
                        console.log(data);
                        var data = eval("(" + data + ")");
                        console.log(data.one_cave_data[0].cave_description);

                        $("#one").html(data.one_cave_data[0].cave_numb);
                        $("#two").html(data.one_cave_data[0].cave_description);
                        $("#three").html(data.one_cave_data[0].cave_patron);
                        $("#four").html(data.one_cave_data[0].cave_period);
                        $("#five").html(data.one_cave_data[0].cave_type);
                    }
                });
                document.getElementById("two").contentEditable = false;
                document.getElementById("three").contentEditable = false;
                document.getElementById("four").contentEditable = false;
                document.getElementById("five").contentEditable = false;
                document.getElementById("editBtn").disabled = false;
                document.getElementById("updateBtn").disabled = true;
                location.reload();

            } else {
                window.alert("Enter Numeric Integer Only !");
                document.getElementById("add_cave").value = '';
            }
        });
    });
</script>


<script>
    $(document).on("click", function (e) {
        if ($(e.target).is("#detailBtn")) {
            $("#image-gallery").show();
        } else {
        }
    });
</script>
<style type="text/css">

    /* Section 1 **/
    .form-wrap .tabs {
        overflow: hidden;
      //  z-index: 100;
       // top: 80px;
       // height: 500px;
        position: relative;
        padding-left: 50px;
        padding-right: 50px;
    }


    #submit_button{
        display:none;
    }

    .hide{
        display: none;
    }

    /* Navigation */

    nav#submenu {
        height: 60px;
        position: relative; 
        top: 10px;
        text-align: right;
    }

    nav#submenu ul {
        padding: 20px;
        margin: 0 auto;
        list-style: none;
    }
    nav#submenu ul li {
        display: inline-block;
        margin: 0 30px;
    }
    nav#submenu ul li a {
        padding: 10px 0;
        color: #fff;
        font-size: 1rem;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.2s ease;
    }
    nav#submenu ul li a:hover {
        color: #34495E;
    }
    nav#submenu a.active {
        border-bottom: 2px solid #ecf0f1;
    }


    /* Headings */

    h1 {
        font-size: 5rem;
        color: #34495E;
    }

    /* Section */
    section {
        width: 100%;
        background: #fff;
        /*border-bottom: 1px solid #ccc;
        height: 500px;*/
       // height: 600px;
        margin-top: 20px; 
        z-index: -1;
        text-align: center;
    }
    section:nth-child(even) {
        background: #ecf0f1;
    }
    section:nth-child(odd) {
        background: #fff;
    }
    .sections section:first-child {
        margin-top: 0px;
    }

    footer {
       // height: 500px;
        background: #34495e;
        position: fixed;
        bottom : 0px;
        width:  100%;
    }
</style>


<!-- Description Panel -->
<style>
    .desc-menu {
        font-family: 'Roboto', sans-serif;  
        top: 0;
        height: 100%;
        list-style-type: none;
        margin: 0;
        padding: 0;
        background: #fff4f5;
        width: 45px;
    }
    .desc-menu li a{
        display:block;
        width:5em;
        text-indent:-500em;
        line-height:5em;
        text-align:center;
        color: #ff5c62;
        background: #fff4f5;
        position: relative;
        border-bottom: 1px solid #ffe2e3;
        transition: background 0.3s ease-in-out;
    }
    .desc-menu li a:before {
        font-family: FontAwesome;
        speak: none;
        text-indent: 0em;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-size: 1.4em;
    }
    .desc-menu li a.facade:before {
        content: "\0046";
    }
    .desc-menu li a.hall:before {
        content: "\0048";
    }
    .desc-menu li a.antichamber:before {
        content: "\0041";/*content: "\f040";*/
    }
    .desc-menu li a.pillars:before {
        content: "\0050";/*content: "\f040";*/
    }
    .desc-menu li a.shrine:before {
        content: "\0053";
    }
    .desc-menu li a.ceiling:before {
        content: "\0043";
    }
    .desc-menu li a.wall:before {
        content: "\0057";
    }
    .desc-menu li a:hover{
        background: #ff5c62;
        color: #fff;
    }
    .desc-menu li.current a {
        background: #ff5e5e;
        color: #fff;
    }
    .desc-menu li a.active {
        background: #ff5e5e;
        color: #fff;
    }
    .desc-menu li a.active:after{
        position:absolute;
        left:5em;
        top:0;
        content:"";
        border:2.5em solid transparent;
        border-left-color:#ff5c62;
        border-width: 2.5em 1em
    }
    .desc-menu li{
        position:relative;
    }
    .desc-menu li:after{
        content: attr(title);
        position:absolute;
        left:5em;
        top:0;
        height:5em;   
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        text-transform:uppercase;
        background:#ff5c62;
        padding:2em;
        transition: all 0.3s ease-in-out;
        visibility:hidden;
        opacity:0;
    }
    .desc-menu li:hover:after{
        visibility:visible;
        opacity:1;
    }
    @media screen and (max-height: 34em){
        .desc-menu li{
            font-size:70%;
        }
    }

    .wrapper{
        position: relative;
        left:50px;
        display: inline;
        margin: 0;
        padding: 0;
        font-size: 12px;
        background: aqua;
    }
</style>
<script>
    function toggle(target) {
        var artz = document.getElementsByClassName('content');
        var targ = document.getElementById(target);
        var isVis = targ.style.display === 'block';

        // hide all
        for (var i = 0; i < artz.length; i++) {
            artz[i].style.display = 'none';
        }
        // toggle current
        targ.style.display = isVis ? 'none' : 'block';

        return false;
    }
</script>
<!-- End Desc Panel -->

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
    
    #cave_numb
    {
        margin-top : 100px;
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

<div class="container submenu col-xs-12 col-md-9 no-padding pull-right" >
    <div class="sections col-xs-12 no-padding" style="z-index:10;margin-top :50px">
        
        <section id="1" class='col-xs-12 no-padding' style="background-color:lightblue;">
            <div class="form-wrap col-xs-12">
                <div class="tabs col-xs-12">
                    
                    <?php
                    if (isset($cave_list) && !empty($cave_list)) {
                        ?>

                    <select id="cave_numb" name="cave_numb" class="div-toggle center white" data-target=".switch_data">
                            <option>Select Cave Number</option>

                            <?php
                            foreach ($cave_list as $value) {
                                ?>
                                <option data-show=".cave_options" value="<?php echo $value; ?>" <?php echo (isset($_POST['cave_numb']) && $_POST['cave_numb'] == $value) ? 'selected="selected"' : ''; ?>><?php echo "Cave " . $value; ?></option>
                                <?php
                            }
                            ?>
                            <option data-show=".add_cave">Add New Cave</option>
                        </select>
                        <?php
                    } else {
                        echo "No Cave Data Available !";
                        echo "<br><br><br>";
                    }
                    ?>
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
                            <?php
                            
                            if($this->session->userdata('user_profile') == 'administrator')
                            {
                            ?>
                                <section class="cave-section col-xs-12" style="background:transparent">
                                    <label class="col-xs-12 pull-left" style="text-align:left">You are using</label>
                                    <select class="form-control" id="form-templte-select">
                                        <option value="custom">Custom Form</option>
                                        <option value="default">Default Form</option>
                                    </select>
                                    <div class="setDataWrap" style="display:none">
                                        <button id="setData" type="button">Set Data</button>
                                      </div>
                                    <div class="col-xs-12 top-margin-big no-padding">
                                        <label class="col-xs-12 pull-left" style="text-align:left">Add a name for this form</label>
                                        <input type="text" class="form-control" id="form_name" placeholder="Add a name for form" />
                                    </div>
                                    <div id="build-wrap" class="col-xs-12 top-margin no-padding"></div>
                                    <button id="getJSON2" type="button" class="btn btn-success col-xs-12 getJSON top-margin">Save Form</button>
                                </section>
                            <?php
                            }
                            else
                            {
                               ?>
                            <h3 id="title_for_users" style="text-align:left"></h3>
                                    <form id="cave_form" method="post">

                                    </form>
                            <?php
                                
                            }
                            ?>
                        </div> <!-- CLOSE CAVE OPTIONS -->

                        <div class="add_cave hide">
                            <div style="text-align:center;">
                                <p>Cave Number:
                                    <textarea rows="1" class="input" id="add_cave" name="cave_number" class="input"></textarea>
                                </p>
                                <div id="caveadded"></div>
                                <button class="btn btn-primary" id="newCaveBtn">Add New Cave</button>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
        </section>
        
        <section id="2" class='col-xs-12 no-padding' style="display:none;background-color:lightblue;margin-top:0px;padding-bottom:55px">
            <h1>
                Upload Images
            </h1>
            <div class="col-xs-12">
                
                <form class="dropzone" id='dropzone'>
<!--                    <div class="fallback">
                      <input name="file" type="file" multiple accept='image/*' />
                      <input type='text' id='cave_id_image_upload' value='' />
                    </div>-->
                </form>
                
                <button class="col-xs-12 btn btn-primary top-margin" id="refresh-button" type="button">Refresh / Save All Changes</button>
            </div>
        </section>
        
        <section id='3' class='col-xs-12' style="display:none;background-color:lightblue;margin-top:0px;padding-bottom:55px;">
            <h1>
                Image Gallery
            </h1>
            <div class='col-xs-12' id="image-gallery" style="height:200px;overflow:auto;background-color:white;border:1px solid">
                
            </div>
        </section>
        
        <section id='4' class='col-xs-12' style="display:none;background-color:lightblue;margin-top:0px;padding-bottom:55px;">
            <div id='4-1' class='col-xs-12 no-padding' style="position:relative;">
                
            </div>
<!--            <div class="dummy-area" style="z-index: 10;position:absolute;left:0;top:0">
                
            </div>-->
        </section>

        
<!--        <section id="3" class="col-xs-12" style="display:none">
            <h1>Image Gallery</h1>
            
                 https://tympanus.net/codrops/2011/09/20/responsive-image-gallery/ 
        </section>
        
        <section id="4" class="col-xs-12" style="display:none">
            <h1> Story Section</h1>   
        </section>-->
        
    </div> <!-- Section Tag Ends Here -->
</div> <!--Ending Container -->
<!-- Modal -->
<div class="modal fade" id="storyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top :50px">
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
          <div class="col-xs-12 ">
              <label class="col-xs-12 no-padding">Story Description</label>
               <div class="col-xs-12 no-padding">
                   <textarea class="form-control" id="description" style="height:150px"></textarea>
              </div>
          </div>
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
    $('#form-templte-select').change(function(){
        if($(this).val() == 'default')
        {
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
                    $('#build-wrap').html('');
                    $('#form_name').val(res.formName);
                    var fbEditor = document.getElementById('build-wrap');
                    formBuilder = $(fbEditor).formBuilder();
                    var formData = res.data;

                    setTimeout(
                        function() 
                        {
                            formBuilder.actions.setData(formData);
                        },500);
                }
            });
        }
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
                html+= '<div class="col-xs-12 col-sm-6 col-md-3 top-margin"><div class="col-xs-12 each-image-gallery" data-id=' + value.id + ' data-image=' + bgImage + ' style="background-image:url(' + bgImage + ');"></div></div>';
            });
            $('#image-gallery').html(html);
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
            $(res).each(function(i, value){
                html+= '<div class="marking" id="new_' + count1++ + '" data-id=' + value.id + ' data-title=' + value.title + ' data-description=' + value.description + ' data-x=' + value.x + ' data-y=' + value.y + ' style="left:' + value.x + 'px;top:' + value.y + 'px"></div>';
            });
            console.log(html);
            $('#4-1').append(html);
            $('#image-overlay-loading').remove();
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
        
//    function activateDropZone()
//    {
//        console.log("A");
//        
//    }
//</script>