<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cavescript.js"></script>

<!-- Script for Auto complete 3 -->
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" rel = "stylesheet">

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


</style>

<script type="text/javascript">
    $(document).on('change', '.div-toggle', function () {
        //changing <div> according to the selected dropdown option
        var target = $(this).data('target'); //get data whose name is'target'
        var show = $("option:selected", this).data('show'); //get data from HTML elment option:selected of 'this' whose name is 'show'
        $(target).children().addClass('hide'); //hide  other options if they are shown previously by choosing their dropdown
        $(show).removeClass('hide');

        //Access Cave Number and send AJAX to controller
        var e = document.getElementById("cave_numb");
        var cave_numb = e.options[e.selectedIndex].value;
    
        var cave_number = {
            'cave_numb': cave_numb
        };
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("caves/getOneCave"); ?>",
            data: cave_number,
            success: function (data) {
                //Create jQuery object from the response HTML.
                var data = eval("(" + data + ")");
                //console.log(data.one_cave_data[0].cave_description);

                $('#one-header').html('Cave Number: ' + data.one_cave_data[0].cave_numb);
//               $("#one").html(data.one_cave_data[0].cave_numb);
//                $("#two").html(data.one_cave_data[0].cave_description);
//                $("#three").html(data.one_cave_data[0].cave_patron);
//                $("#four").html(data.one_cave_data[0].cave_period);
//                $("#five").html(data.one_cave_data[0].cave_type);
            }
        });
    });

    $(document).ready(function () {
        $('.switch_data').trigger('change');
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
    $(function () {
        var obj = <?php echo $cave_ptp ?>;
        var availablePatron = [];
        var noNullPatron = [];
        var uniquePatron = [];
        var i = 0;
        for (i in obj) {
            availablePatron[i] = obj[i]['cave_patron'];
        }
        noNullPatron = availablePatron.filter(function (val) {
            return val !== null;
        });
        uniquePatron = noNullPatron.filter(function (value, index, array) {
            return array.indexOf(value) === index;
        });

        $("#three").autocomplete({
            source: uniquePatron
        });


        var availablePeriod = [];
        var j = 0;
        for (j in obj) {
            availablePeriod[j] = obj[j]['cave_period'];
        }
        noNullPeriod = availablePeriod.filter(function (val) {
            return val !== null;
        });
        uniquePeriod = noNullPeriod.filter(function (value, index, array) {
            return array.indexOf(value) === index;
        });
        $("#four").autocomplete({
            source: uniquePeriod
        });


        var availableType = [];
        var k = 0;
        for (k in obj) {
            availableType[k] = obj[k]['cave_type'];
        }
        noNullType = availableType.filter(function (val) {
            return val !== null;
        });
        uniqueType = noNullType.filter(function (value, index, array) {
            return array.indexOf(value) === index;
        });
        $("#five").autocomplete({
            source: uniqueType
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
        z-index: 100;
        top: 80px;
        height: 500px;
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
        height: 600px;
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
        height: 500px;
        background: #34495e;
    }
</style>
<script>
    var sections = $('section'), nav = $('nav'), nav_height = nav.outerHeight();

    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();

        sections.each(function () {
            var top = $(this).offset().top - nav_height,
                    bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('a').removeClass('active');
                sections.removeClass('active');

                $(this).addClass('active');
                nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
            }
        });
    });

    nav.find('a').on('click', function () {
        var $el = $(this), id = $el.attr('href');

        $('html, body').animate({
            scrollTop: $(id).offset().top - nav_height
        }, 500);

        return false;
    });
</script>

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
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title {
        margin-left:2px;
    }
</style>

<script>
    $(document).on('click', '#close-preview', function () {
        $('.image-preview').popover('hide');
        // Hover befor close the preview    
    });

    $(function () {
        // Create the close button
        var closebtn = $('<button/>', {
            type: "button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;'
        });
        closebtn.attr("class", "close pull-right");

        // Clear event
        $('.image-preview-clear').click(function () {
            $('.image-preview').attr("data-content", "").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function () {
            var img = $('<img/>', {
                id: 'dynamic',
                width: 250,
                height: 200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<script type="text/javascript">
         function dragStart(ev) {
             var id =  ev.target.getAttribute('id');
             
            ev.dataTransfer.effectAllowed='move';
            ev.dataTransfer.setData("Text", ev.target.getAttribute('id'));
            ev.dataTransfer.setDragImage(ev.target,0,0);
            
            return true;
         }
         
         function dragEnter(ev) {
            event.preventDefault();
            return true;
         }
         
         function dragOver(ev) {
             
            return false;
         }
         
         function dragDrop(ev) {
            var src = ev.dataTransfer.getData("Text");
            console.log(src);
            var clone = $('#' + src).clone();
            $(clone).removeAttr('id');
            $(clone).attr('contenteditable', true);
            $(clone).attr('style', 'border : 1px solid');
            $('.cave-property-right').append(clone);
            ev.stopPropagation();
            return false;
            //ev.target.appendChild(document.getElementById(src));
            //
            
         }
      </script>

<!-- End File Upload -->

<!-- Gallery -->

<!-- End of Gallery -->

<div class="container submenu">
    <div class="sections">
        <section id="1">
            <div class="form-wrap">
                <div class="tabs">
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
                    <br><br>
                    <div class="switch_data">

                        <!-- CAVE OPTIONS --->
                        <div class="cave_options hide">
                            <section>
                                <table border="2" class="table">  
                                    <tbody>  
                                        <tr>  
                                            <th id="one-header" style="text-align:center;background-color: gray;color:white">Cave Number</th>  
<!--                                            <th>Description</td>
                                            <th>Patron</td>
                                            <th>Period</td>
                                            <th>Type</td>-->
                                        </tr>

<!--                                        <tr>
                                            <td><div id="one"></div></td>
                                            <td>
                                                <div id="two"></div>
                                                <div style="text-align:center;">

                                                </div>
                                            </td>
                                            <td><div id="three"></div></td>
                                            <td><div id="four"></div></td>
                                            <td><div id="five"></div></td>
                                        </tr>  -->
                                    </tbody>  
                                </table>
                                <div class="col-xs-12 property-control-container">
                                    <div class="col-xs-12 col-sm-3 pull-left cave-property-left " style="">
                                        <div class='col-xs-12 new_category' draggable="true"
                ondragstart="return dragStart(event)" id='new_category'>
                                            <button type="button" class="col-xs-12 btn btn-danger top-margin add-new-category" >Add New Category</button>
                                            
                                            <div class='col-xs-12 '>
                                                <div class='col-xs-12 add-new-category-details editable-text-border col-xs-12' contenteditable="true">Title</div>
                                                 <div class='col-xs-12 add-new-category-details-body editable-text-border col-xs-12' contenteditable="true">Body</div>
                                            </div>
                                        </div>
                                        <?php
                                            $count = 0;
                                            if(!empty($column_headers))
                                            {
                                                foreach($column_headers AS $each)
                                                {
                                                    ?>
                                        <div class='col-xs-12 new_category' draggable="true"
                ondragstart="return dragStart(event)" id='new_category<?php echo $count ?>'>
                                                    <button type="button" class="col-xs-12 btn btn-danger top-margin add-existing-category" id="abcd_<?php echo $count++ ?>"><?php echo $each['name'] ?></button>
                                                    <div class='col-xs-12 '>
                                                <div class='col-xs-12 add-new-category-details editable-text-border col-xs-12' contenteditable="true"><?php echo $each['name'] ?></div>
                                                 <div class='col-xs-12 add-new-category-details-body editable-text-border col-xs-12' contenteditable="true"><?php echo $each['body'] ?></div>
                                            </div>
                                        </div>
                                                <?php
                                                }
                                            }
                                            ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 pull-right cave-property-right" ondragenter="return dragEnter(event)" ondrop="return dragDrop(event)"  ondragover="return dragOver(event)">
                                        
                                    </div>
                                    <button type="button" class="col-xs-12 btn btn-danger" id="save-columns">Save columns</button>
                                </div>

                                <div style="text-align:center;">
                                    <button class="btn btn-primary" onclick="makeEdit()" id="editBtn">Edit Cave</button>
                                    <button class="btn btn-warning" id="updateBtn" disabled="disabled">Update</button>
                                    <button class="btn btn-danger" id="deleteBtn" disabled="disabled">Delete Cave</button>
                                </div>

                                <div style="text-align:right;">
                                    <nav id="submenu">
                                            <ul>
                                                <button class="btn btn-primary" id="moreBtn"><li><a href="#2">Add More</a></li></button>
                                            </ul>
                                    </nav>
                                </div>


                            </section>
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

        <section id="2">          
            <ul class="desc-menu">
                <li title="facade"><a href="#2" class="facade" onclick="toggle('facade');">Facade</a></li>
                <li title="hall"><a href="#2" class="hall" onclick="toggle('hall');">Hall</a></li>
                <li title="antichamber"><a href="#2" class="antichamber" onclick="toggle('antichamber');">AntiChamber</a></li>
                <li title="pillars"><a href="#2" class="pillars" onclick="toggle('pillars');">Pillars</a></li>
                <li title="shrine"><a href="#2" class="shrine" onclick="toggle('shrine');">Shrine</a></li>
                <li title="ceiling"><a href="#2" class="ceiling" onclick="toggle('ceiling');">Ceiling</a></li>
            </ul>
            <div style="text-align:right;">
                <button class="btn btn-primary" id="moreBtn"><i class="icon-cog"></i>Show Gallery</button>
                <button class="btn btn-primary" id="moreBtn"><i class="icon-cog"></i>Add Story</button>
            </div>
            <div class="wrapper">
                <div class="content" id="facade" style="display:none;">
                    <div style="margin-top:-590px">
                            <?php echo form_open_multipart('Caves/galleryUpload'); ?>
                                <h3 class="text-primary text-center">Painting</h3>
                                <?php echo "<input type='file' name='painting' size='350' />"; ?>
                                <br><br><br><br>
                                <h3 class="text-primary text-center">Line Drawing</h3>
                                <?php echo "<input type='file' name='linedrawing' size='350' />"; ?>
                                <br><br><br><br>
                                <h3 class="text-primary text-center">Reconstructed Painting</h3>
                                <?php echo "<input type='file' name='reconstructed' size='350' />"; ?>
                                <br><br><br><br>
                                <h3 class="text-primary text-center">Recreated Painting</h3>
                                <?php echo "<input type='file' name='recreated' size='350' />"; ?>
                                <br><br><br><br>
                                <?php echo "<input type='submit' name='submit' value='Upload'/> "; ?>
                            <?php echo "</form>" ?>
                    </div>
                </div>
                <div class="content" id="hall" style="display:none;">
                    <div style="margin-top:-590px">
                        <?php echo form_open_multipart('Caves/galleryUpload'); ?>
                                <h3 class="text-primary text-center">Painting</h3>
                                <?php echo form_label('Title:'); ?><br />
                                <?php echo form_input(array('id' => 'ptitle', 'name' => 'pname')); ?><br />
                                <?php echo form_label('Description:'); ?><br />
                                <?php echo form_input(array('id' => 'pdescription', 'name' => 'pname')); ?><br />
                                <?php echo "<input type='file' name='painting' size='350' />"; ?>
                                <br><br><br><br>
                                <h3 class="text-primary text-center">Line Drawing</h3>
                                <?php echo "<input type='file' name='linedrawing' size='350' />"; ?>
                                <br><br><br><br>
                                <h3 class="text-primary text-center">Reconstructed Painting</h3>
                                <?php echo "<input type='file' name='reconstructed' size='350' />"; ?>
                                <br><br><br><br>
                                <h3 class="text-primary text-center">Recreated Painting</h3>
                                <?php echo "<input type='file' name='recreated' size='350' />"; ?>
                                <br><br><br><br>
                                <?php echo "<input type='submit' name='submit' value='Upload'/> "; ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="content" id="antichamber" style="display:none;">
                    <div style="margin-top:-550px">
                        
                    </div>
                </div>
            </div>
        </section>
        
        <section id="3">
            <h1>Image Gallery</h1>
            
                <!-- https://tympanus.net/codrops/2011/09/20/responsive-image-gallery/ -->
        </section>
        
        <section id="4">
            <h1> Story Section</h1>   
        </section>
        
    </div> <!-- Section Tag Ends Here -->
</div> <!--Ending Container -->
<!--<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links
        $("a").on('click', function (event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>-->

<script>
    
        $(document).on('click','.add-new-category-details',function(){
            if($(this).text() == 'Title')
            {
                $(this).text('');
            }
        });
        
        $(document).on('click','.add-new-category-details-body',function(){
            if($(this).text() == 'Body')
            {
                $(this).text('');
            }
        });
        
        $(document).on('click', '#save-columns', function(){
            var data = new Object();
            var count = 0;
            $('.cave-property-right .new_category').each(function(){
                data[count] = new Object();
                data[count]['title'] = $(this).find('.add-new-category-details').text();
                data[count]['body'] = $(this).find('.add-new-category-details-body').text();
                count++;
            });
            
            saveColumns(data);
        });
        
        
        function saveColumns(data)
        {
            $.post('/home/caves/save', {data:data}, function(){
                alert('Columns Saved Succefully');
                location.reload();
            });
        }
</script>