<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>

<script type="text/javascript">
    $(function () {
        $('#addColumn').click(function () {
            var btn = document.getElementById("addColumn");
            btn.disabled = true;
            document.getElementById("InputFields").classList.remove("hide");
            var columns = document.getElementById('columns').value;
            for (i = 0; i < columns; i++) {
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("value", "Column " + i);
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
<link href="/assets/libraries/font-awesome/css/font-awesome.min.css"
            rel="stylesheet" type="text/css">

<script type="text/javascript">
    $(function () {
        $('#alllist').click(function () {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("lists/allList"); ?>",
                dataType: 'json',
                success: function (data) {
                    //Create jQuery object from the response HTML.
                    var dropDownList = [];
                    var i = 0;
                    retList = document.getElementById('ret_list');
                    var table_html = "<tr>";
//                    for (var key in data[0]) {
//                        table_html += "<th>" + [key] + "</th>";
//                        option = document.createElement('option');
//                        option.value = option.text = key;
//                        retList.add(option);
//                        dropDownList[i++] = key;
//                    }
//                    for (var key in data[0]) {
//                        delList = document.getElementById('del_list');
//                        option = document.createElement('option');
//                        option.value = option.text = key;
//                        delList.add(option);
//                        dropDownList[i++] = key;
//                   }

                    //                    table_html += "</tr>";
                    //                    console.log(dropDownList);
                    //                    
                    //                    $.each(data.list_data, function(i, item) {
                    //                        var html_str = "";
                    //                        for(var key in data.list_data[i]){
                    //                            html_str += "<td><p>" + data.list_data[i][key] + "</p></td>"; 
                    //                        }
                    //                        table_html += "<tr><p>"+html_str+"</p></tr>";
                    //                    });
                    //                    
                    //                    $('#listtable').html(table_html);

//                    var tr, td, i, oneRecord;
//                    var myDiv = document.createElement('DIV');
//                    myTable = document.createElement('TABLE');
//                    myTable.setAttribute("border", 1);
//                    // node tree
//                    //var data = node.getElementsByTagName("NewDataSet")[0];
//                    var data = data.list_data[0];
//                    for (i = 0; i < data.list_data.length; i++) {
//                        // use only 1st level element nodes to skip 1st level text nodes in NN
//                        if (data.childNodes[i].nodeType === 1) {
//                            oneRecord = data.childNodes[i];
//                            tr = myTable.insertRow(myTable.rows.length);
//                            td = tr.insertCell(tr.cells.length);
//                            td.innerHTML = oneRecord.getElementsByTagName("Name")[0].firstChild.nodeValue;
//                            td = tr.insertCell(tr.cells.length);
//                            td.innerHTML = oneRecord.getElementsByTagName("Age")[0].firstChild.nodeValue;
//                            td = tr.insertCell(tr.cells.length);
//                            td.innerHTML = oneRecord.getElementsByTagName("Org")[0].firstChild.nodeValue;
//                        }
//                    }
//                    myDiv.appendChild(myTable);
//                    return myDiv.innerHTML;
//                    }
                    
                    var table_html = "<tr>";
                   // console.log(data.list_data[0]);
                    for (var key in data[0]) {
                        if(key != 'id')
                        {
                            table_html += "<th>" + [key] + "</th>";
                            $('#ret_list').append('<option>' + key + '</option>');
                            $('#del_list').append('<option>' + key + '</option>');
                        }
                    }
                    
                    
                    
                    table_html += "</tr>";

                    var i = 0;
                    //var button = document.createElement("button");
                    $.each(data, function (i, item) {
                        var html_str = "";
                        $.each(item, function(i1,item1){
                            if(i1 != 'id')
                            {
                                html_str += "<td data-container='all_period'><input value='" + item1 + "' />";
                                html_str += deleteButton(item.id); + '</td>';
                            }
                        });
                        
                        
//                        html_str += "<td data-container='all_patron'><input value='" + item.all_patron + "' />";
//                        html_str += deleteButton(item.id); + '</td>';
//                        
//                        html_str += "<td data-container='all_type'><input value='" + item.all_type + "' />";
//                        html_str += deleteButton(item.id); + '</td>';
//                        for (var key in data.list_data[i]) {
//                            console.log(key);
//                            if(key!= 'id')
//                            {
//                                id = key;
//                                html_str += "<td><p><input name='post_data[" + i + "][" + key + "]' value='" + data.list_data[i][key] + "' /></p>";
//                                html_str += "<button type='button' data-id='" + id + "' data-count='" + count + "' class='delete_list'>Delete</button>";
//                            }
//                            else
//                            {
//                                console.log(item)
//                            }
//                            count++;
//                        }
                        i = i + 1;
                        table_html += "<tr><p>" + html_str + "</p></tr>";
                    });
                    
                    $('#edittable').html(table_html);
                }//Ends data-success function 
            });//Ends Ajax
        });//Ends Click Function
    }); //Ends $ Function
    
    
    $(document).on('click', '.delete_list', function(res){
        
        var parent = $(this).parents('tr').first();
        //var list = $(parent).attr('data-container');
        var conf = confirm("Are you sure you want to delete this entire row?");
        if(!conf)
        {
            return;
        }
        $(this).attr('disabled', 'disabled');
        var id = $(this).attr('data-id');
        $.get('/lists/entry/' + id + '/delete', function(){
            alert('Deleted Successfully');
            $(parent).remove();
        }).fail(function(xhr, status, error) {
            alert('Something went wrong');
            $(this).removeAttr('disabled');
        });;
    });
    
    function deleteButton(id)
    {
        return "<button type='button' data-id='" + id + "' class='delete_list'>Delete</button>";
    }
</script>

<script type="text/javascript">
    $(function () {
        $("#editlist").click(function () {
            document.getElementById("listtable").contentEditable = "true";
        });
    });
    
    $(function () {
        $("#del_list_button").click(function () {
            window.alert("Caution ! You are going to DELETE entire list !!");
        });
    });
</script>
<script type="text/javascript">
    function myFunction() {
        window.alert("Happy Borthday"+value);
//        var post_data = {
//                'list_entry': $("#one").html(),
//            };
//            $.ajax({
//                type: "POST",
//                url: "<php echo site_url("caves/deleteCave"); ?>",
//                data: post_data,
//                success: function (data) {
//                }
//            });
//            location.reload();
}


    $(function () {
        $('.entrydel').click(function () {
            
            window.alert("Check if its !");

            
        });
    });
</script>
<body>
    <div id="container center">
        <?php echo form_open('Lists/createList1'); ?>
        <h3 align="center">Create 1 Dimensional List</h3>
        <?php echo form_label('Enter New List Name :'); ?>
        <?php echo form_input(array('id' => 'columnname', 'name' => 'columnname')); ?>
        <?php echo form_submit(array('id' => 'submit', 'value' => 'Create List')); ?>
        <?php echo form_close(); ?>
        <hr>
        <br>
        <?php echo form_open('Lists/updateList'); ?>
        <h3>Show and Edit List</h3>
        <input type="button" value="Show All List" id="alllist"/>
        <br><br>
        <table id="listtable" style="border: 3px solid black;">  
        </table><br>
        <?php echo form_close(); ?>


        <?php echo form_open('Lists/updateList'); ?>
        <table id="edittable" style="border: 3px solid black;">  
        </table><br>
        <?php echo form_close(); ?>
        <hr>
        <br>
        <h3>Add Entry to a List</h3>
        <?php echo form_open('Lists/addToList'); ?>
        <select id="ret_list" name="ret_list">
            <option value="">Select List Name</option>
        </select>
        <br>
        <?php echo form_label('Value to be Added:'); ?>
        <?php echo form_input(array('id' => 'entryAdd', 'name' => 'entryAdd')); ?>
        <input type="submit" value="Add Entry" id="add_entry" />
        <?php echo form_close(); ?>

        <hr>
        <br>

        <?php echo form_open('Lists/deleteList'); ?>
        <h3>Delete List</h3>
        <?php echo form_label('Select List to Delete:'); ?>
        <select id="del_list" name="del_list">
            <option>Select List Name</option>
        </select>
        <input type="submit" value="Delete List" id="del_list_button" />
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


</div>
</body>