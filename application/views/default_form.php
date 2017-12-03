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


<!-- End File Upload -->

<!-- Gallery -->

<!-- End of Gallery -->

<div class="container submenu col-xs-12 col-md-9 no-padding pull-right" >
    <div class="sections col-xs-12 no-padding" style="z-index:10;margin-top :50px">
        
        <section id="1" class='col-xs-12 no-padding' style="background-color:lightblue;">
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