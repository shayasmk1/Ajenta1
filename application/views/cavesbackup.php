<?php echo form_open('Lists/addtoList'); ?>
            <h3>Add Element to List: </h3>
            <?php echo form_label('Select List:'); ?>
            <select id="ret_list" name="ret_list" class="div-toggle center white">
                <option>Select List Name</option>  
            </select>
            <br><br>
            <?php echo form_label('Value to be Added:'); ?>
            <?php echo form_input(array('id' => 'entryAdd', 'name' => 'entryAdd')); ?>
            
            
            <input type="button" value="Add Entry" id="add_entry" class="hide"/>
        <?php echo form_close(); ?>
            
            
            
            <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>

<script type="text/javascript">
    $(function () {
        $('#addColumn').click(function () {
            var btn = document.getElementById("addColumn");
            btn.disabled = true;
            document.getElementById("InputFields").classList.remove("hide");
            var columns= document.getElementById('columns').value;
            for (i = 0; i < columns; i++) {
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("value", "Column "+i);
                document.getElementById("InputFields").appendChild(x);
            }
    });
    });
</script>

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
    table{
        width: 100%;
    }
    
    th {
    height: 50px;
}

</style>
<script type="text/javascript">
    $(function () {
        $('#alllist').click(function () {
            document.getElementById("editlist").classList.remove("hide");
            
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("lists/allList"); ?>",
                dataType : 'json',
                success: function (data) {
                    //Create jQuery object from the response HTML.
                    // Mahesh Code
                        var dropDownList = [];
                        var i = 0;
                        //caveNumb = document.getElementById('cave_numb');
                        retList = document.getElementById('ret_list');
                        console.log(retList);
                        delList = document.getElementById('del_list');
                    // Mahesh Code
                    var table_html ="<tr>";
                    for(var key in data.list_data[0]){
                        table_html += "<th>" + [key] + "</th>";
                        // Mahesh Code
                            option = document.createElement( 'option' );
                            option.value = option.text = key;
                            delList.add(option);
                            retList.add(option);
                            dropDownList[i++] = key;
                        // Mahesh Code
                    }
                    table_html += "</tr>";
                    console.log(dropDownList);
                    
                    $.each(data.list_data, function(i, item) {
                        var html_str = "";
                        for(var key in data.list_data[i]){
                            html_str += "<td><p>" + data.list_data[i][key] + "</p></td>"; 
                        }
                        table_html += "<tr><p>"+html_str+"</p></tr>";
                    });
                    
                    $('#listtable').html(table_html);
                    
                    
                    var table_html ="<tr>";
                    for(var key in data.list_data[0]){
                        table_html += "<th>" + [key] + "</th>";
                    }
                    table_html += "</tr>";
                    
                    $.each(data.list_data, function(i, item) {
                        var html_str = "";
                        var i = 0;
                        for(var key in data.list_data[i]){
                            html_str += "<td><p><input name='post_data[" + i + "][" +  + "]' value='" + data.list_data[i][key] + "' /></p></td>"; 
                        }
                        table_html += "<tr><p>"+html_str+"</p></tr>";
                    });
                    $('#edittable').html(table_html);
                }
            });
    });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#editlist").click(function () {
            document.getElementById("listtable").contentEditable = "true";
            document.getElementById("updatelist").classList.remove("hide");
    });
    });
</script>

<body>
    <div id="container center">
        <?php echo form_open('Lists/createList1'); ?>
            <h3 align="center">Create 1 Dimensional List</h3>
            <?php echo form_label('List Name :'); ?>
            <?php echo form_input(array('id' => 'columnname', 'name' => 'columnname')); ?>
            <?php echo form_submit(array('id' => 'submit', 'value' => 'Create List')); ?>
        <?php echo form_close(); ?>
        <hr>
        <br><br>
        <?php echo form_open('Lists/allList'); ?>
            <h3>Edit List</h3>
            <input type="button" value="Show All List" id="alllist"/><br><br>
            <table id="listtable" style="border: 3px solid black;">  
            </table><br>
            <table id="edittable" style="border: 3px solid black;">  
            </table><br>
            <input type="button" value="Edit List" id="editlist" class="hide"/>
            <input type="button" value="Update List" id="updatelist" class="hide"/>
        <hr>
        <br><br>
        <?php echo form_open('Lists/addtoList'); ?>
            <h3>Add Element to List: </h3>
            <?php echo form_label('Select List:'); ?>
            <select id="ret_list" name="ret_list" class="div-toggle center white">
                <option>Select List Name</option>  
            </select>
        <?php echo form_close(); ?>
        <hr>
        <br><br>
        <?php echo form_open('Lists/allList'); ?>
            <h3>Delete List</h3>
            <?php echo form_label('Select List to Delete:'); ?>
            <select id="del_list" name="del_list" class="div-toggle center white">
                <option>Select List Name</option>
            </select>
            
        <?php echo form_close(); ?>
        <hr>
        <br><br><br><br>
        <?php echo form_open('Lists/createList2'); ?>
            <h3 align="center">Create Multi Dimensional List </h3>
            <?php echo form_label('List Name :'); ?>
            <?php echo form_input(array('id' => 'listname', 'name' => 'listname')); ?>
            <br><br>
            <?php echo form_label('Parameters to Add in List:'); ?>
            <?php echo form_input(array('id' => 'columns', 'name' => 'columns')); ?>
            <input type="button" value="Add" id="addColumn"/> 
            <br><br>
            <div class="hide" id="InputFields"></div>
            <br><br>
            <?php echo form_submit(array('id' => 'submit', 'value' => 'Create List')); ?>
        <?php echo form_close(); ?>
    </div>
    <div id="new_table">
        <div class="container">
            <style>
                .table-editable {
  position: relative;
}
.table-editable .glyphicon {
  font-size: 20px;
}

.table-remove {
  color: #700;
  cursor: pointer;
}
.table-remove:hover {
  color: #f00;
}

.table-up, .table-down {
  color: #007;
  cursor: pointer;
}
.table-up:hover, .table-down:hover {
  color: #00f;
}

.table-add {
  color: #070;
  cursor: pointer;
  position: absolute;
  top: 8px;
  right: 0;
}
.table-add:hover {
  color: #0b0;
}

            </style>
          
  
    </div>
</body>

<?php foreach($data_list as $data): ?>
    <?php $i = 0;?>
    <?php foreach($data as $key => $value): ?>
        <input name="post_data[<?php $i; ?>][<?php $key; ?>]" value="<?php echo $value;?>" />
    <?php endforeach; ?>
    <?php $i = $i+1; ?>
<?php endforeach; ?>
        
        
        
        
        
        
        <link href="<?php echo base_url(); ?>assets/css/cavestyle.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cavescript.js"></script>

<!-- Script for Auto complete 3 -->
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

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
                console.log(data.one_cave_data[0].cave_description);

                $("#one").html(data.one_cave_data[0].cave_numb);
                $("#two").html(data.one_cave_data[0].cave_description);
                $("#three").html(data.one_cave_data[0].cave_patron);
                $("#four").html(data.one_cave_data[0].cave_period);
                $("#five").html(data.one_cave_data[0].cave_type);
            }
        });
    });

    $(document).ready(function () {
        $('.switch_data').trigger('change');
    });
</script>
<style>
    .hide{
        display: none;
    }

    .centerselect {
        margin: auto;
        width: 100%;
        border: 2px solid green;
        text-align: center;
        padding: 10px;
    }

    div {
        text-align:center;
    }
</style>



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
            document.getElementById("deleteBtn").disabled = false;
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
                success: function (data) {
                }
            });

            location.reload();
        });
    });
</script>

<script>
    function isNormalInteger(n) {
        if (n % 1 === 0) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script type="text/javascript">
    $(function () {
        $('#newCaveBtn').click(function () {   
            if (isNormalInteger(document.getElementById("add_cave").value) === true) {
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

<style type="text/css">
    .white option{
        color:#000;
    }

    .blue option{
        background-color:#00F;
    }
</style>

<script>
    $(function () {
        var obj = <?php echo $cave_ptp ?>;
        var availablePatron = [];
        var i=0;
        for (i in obj){
            availablePatron[i]=obj[i]['cave_patron'];}
        $("#three").autocomplete({
            source: availablePatron
        });
        
       
        var availablePeriod= [];
        var j=0;
        for (j in obj){
            availablePeriod[j]=obj[j]['cave_period'];} 
        $("#four").autocomplete({
            source: availablePeriod
        });


        var availableType = [];
        var k=0;
        for (k in obj){
            availableType[k]=obj[k]['cave_type'];}
        $("#five").autocomplete({
            source: availableType
        });
    });
</script>

<div class="form-wrap form">
    <div class="tabs">
        <?php
        //print_r($cave_ptp);
        if (isset($cave_list) && !empty($cave_list)) {
            ?>

            <select id="cave_numb" name="cave_numb" class="div-toggle centerselect white" data-target=".switch_data">
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

        <br><br><br><br>
        <div class="switch_data">
            <div class="cave_options hide">
                <table border="2" class="table">  
                    <tbody>  
                        <tr>  
                            <th>Cave Number</td>  
                            <th>Description</td>
                            <th>Patron</td>
                            <th>Period</td>
                            <th>Type</td>
                        </tr>

                        <tr>
                            <td><div id="one"></div></td>
                            <td><div id="two"></div></td>
                            <td><div id="three"></div></td>
                            <td><div id="four"></div></td>
                            <td><div id="five"></div></td>
                        </tr>  
                    </tbody>  
                </table> 
                <br><br>
                <div style="text-align:center;">
                    <button class="btn btn-primary" onclick="makeEdit()" id="editBtn">Edit Cave</button>
                    <button class="btn btn-warning" id="updateBtn" disabled="disabled">Update</button>
                    <button class="btn btn-danger" id="deleteBtn" disabled="disabled">Delete Cave</button>
                </div>    
            </div>

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



//////////////////////////                    
                        <input type="button" onclick="addPatron()" value="Add New" id="add_patron" style="float: right;"/>
                        <div id="patron_entry" hidden style="float: right;">
                            <input type="text" name="" id="patron_value"/> 
                            <input id="confirm_patron" type="button" value="Confirm" onclick="confirmPatron()">
                        </div>
                        <input type="submit" value="Patron List.." style="float: right;" >
                        <select id="patron_dropdown" name="cave_patron" class="input">
                            <option value="none">Cave Patron</option>
                        </select>
                        <br><br>


                        <input type="button" onclick="addPeriod()" value="Add New" id="add_period" style="float: right;"/>
                        <div id="period_entry" hidden style="float: right;">
                            <input type="text" name="" id="period_value"/> 
                            <input id="confirm_period" type="button" value="Confirm" onclick="confirmPeriod()">
                        </div>
                        <input type="submit" value="Period List.." style="float: right;" >
                        <select id="period_dropdown" name="cave_period" class="input">
                            <option value="none">Cave Period</option>
                        </select>
                        <br><br>



                        <input type="button" onclick="addType()" value="Add New" id="add_type" style="float: right;"/>
                        <div id="type_entry" hidden style="float: right;">
                            <input type="text" name="" id="type_value"/> 
                            <input id="confirm_type" type="button" value="Confirm" onclick="confirmType()">
                        </div>
                        <input type="submit" value="Type List.." style="float: right;" >
                        <select id="type_dropdown" name="cave_type" class="input">
                            <option value="none">Cave Type</option>
                        </select>
                        <br><br>



                        <input type="submit" class="button" value="Submit">

////////////////////////////////
