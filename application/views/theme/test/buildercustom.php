<script>
var count = 1;
var trs = document.getElementById('select-container-right-inside');
var clickedPosition = 'NA';
var lastElementID = 0;
var currentPosition = 'NA';
    
function dragStart(ev) {
    var id =  ev.target.getAttribute('id');
    //console.log(ev.target.getAttribute('class'));
    ev.dataTransfer.effectAllowed='move';
    if(!$('#' + id).hasClass('draggable-content'))
    {
        $('.draggable-content').removeClass('draggable-content');
    }
    if($('.draggable-content').length == 0)
    {
        ev.dataTransfer.setData("Text", ev.target.getAttribute('id'));
    }
    else
    {
        $('.draggable-content').each(function(i, value){
            ev.dataTransfer.setData("Text_" + $(value).attr('id'), $(value).attr('id'));
        });
    }

    //ev.dataTransfer.setData("Text", ev.target.getAttribute('id'));
 //   ev.dataTransfer.setDragImage(ev.target,0,0);

    return true;
}
         
function dragEnter(ev) {
    ev.preventDefault();
    var id = ev.target.id;

    if(ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'ELEMENT-NAME'  || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE')
    {
        $('#' + id).parents('.main-text-area-continer').first().addClass('element-name-hover');
        $('#' + id).after('<div class="inBetween"></div>')
    }
    var tar = ev.target.innerHTML;
    return true;
}
         
function dragOver(ev) {
    if(ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'ELEMENT-NAME'  || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE')
    {
        $('.main-text-area-continer').removeClass('element-name-hover');
        $('.inBetween').slideUp('slow');
    }
    return false;
}
         
function dragDrop(ev) {
    console.log("A");
    if($('.draggable-content').length == 0)
    {
        var src = ev.dataTransfer.getData("Text");
        var id = ev.target.id;
        dropCommon(id, ev, src, 0);

    }
    else
    {
        var currentID = 0;
        $('.draggable-content').each(function(i, value){
            var src = ev.dataTransfer.getData("Text_" + $(value).attr('id'));
            var id = ev.target.id;

            dropCommon(id, ev, src, currentID);
            currentID = $(value).attr('id');
        });
    }
    ev.stopPropagation();
    $('.draggable-content').removeClass('draggable-content');
    setAllPositions();
    $('.inBetween').remove();
    currentPosition = 'NA';
    resetTable();
    return false;
 }
 
 function resetTable()
 {
     var html = '';
     var elementCount = 0;
     
     $('element-name').each(function(i, value){
         html+= '<tr>';
            html+= "<td>" + $(value).attr('data-count') + "</td>";
            html+= "<td>" + $(value).attr('data-position') + "</td>";
         html+= '</tr>';
         elementCount++;
     });
     html+= "<tr><td colspan='2'>Total Elements : " + elementCount + "</td></tr>";
     html+= "<tr><td colspan='2'>Last Element ID : " + lastElementID + "</td></tr>";
     html+= "<tr><td colspan='2'>Current Position : " + currentPosition + "</td></tr>";
     $('#element-table tbody').html(html);
 }
         
         function dropCommon(id, ev, src, currentID)
         {
             if(id == 'container-fields')
                {
                    console.log("1");
                    if(src == 'text-area-container')
                    {
                        $('#select-container-right-inside').append(addText());
                        lastElementID = count - 1;
                    }
                    else if(src == 'select-container')
                    {
                        $('#select-container-right-inside').append(addSelect());
                        lastElementID = count - 1;
                    }
                    else
                    {
                        if(ev.target.nodeName == 'ELEMENT-NAME')
                        {
                            if(currentID == 0)
                            {
                                ev.target.after(document.getElementById(src));
                            }
                            else
                            {
                                //console.log(currentID);
                                $('#' + currentID).after(document.getElementById(src));
                            }
                        }
                        else if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE' || ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'SPAN')
                        {
                            if(currentID == 0)
                            {
                                var parent = $('#' + id).parents('.main-inside-container').first();
                                $(parent).after(document.getElementById(src));
                            }
                            else
                            {
                                //console.log(currentID);
                                $('#' + currentID).after(document.getElementById(src));
                            }
                            
                            
                        }

                    }
                    
                    
                }
                else
                {
                    console.log("2");
                    if(src == 'text-area-container')
                    {
                        console.log("3");
                        $('#' + id).parents('.main-text-area-continer').first().after(addText());
                        lastElementID = count - 1;
                    }
                    else if(src == 'select-container')
                    {
                        console.log("4");
                        $('#' + id).parents('.main-text-area-continer').first().after(addSelect());
                        lastElementID = count - 1;
                    }
                    else
                    {
                        console.log("5");
                        if(ev.target.nodeName == 'ELEMENT-NAME')
                        {
                            if(currentID == 0)
                            {
                                ev.target.after(document.getElementById(src));
                            }
                            else
                            {
                                //console.log(currentID);
                                $('#' + currentID).after(document.getElementById(src));
                            }
                        }
                        else if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE' || ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'SPAN')
                        {
                            if(currentID == 0)
                            {
                                var parent = $('#' + id).parents('.main-inside-container').first();
                                $(parent).after(document.getElementById(src));
                            }
                            else
                            {
                                //console.log(currentID);
                                $('#' + currentID).after(document.getElementById(src));
                            }
                        }
                    }

                }
         }
         
         function setAllPositions()
         {
            var positionCount = 1;
            $('element-name').each(function(i, value){
               $(value).attr('data-position', positionCount);
               
               var currentCount = $(value).attr('data-count');
               $(value).find('.position_count').text('Element ID is : ' + currentCount + ' and Form Position is ' + positionCount);
               positionCount++;
            });
         }
         
         function selectRowsBetweenIndexes(indexes){
            indexes.sort(function(a, b) {
            return a - b;
        });

        for (var i = indexes[0]; i <= indexes[1]; i++) {
        trs[i-1].className = 'draggable-content';
    }
}

         
</script>


<div class="create-area">
    <div class="select-area-left">
        <div class="text-area-c hcenter" id="text-area-container" draggable="true"
                        ondragstart="return dragStart(event)">
            Text <button type="button" id="add-text" class="add-button">+</button>
        </div>
        <div class="text-area-c hcenter" id="select-container" draggable="true"
                        ondragstart="return dragStart(event)">
            ListBox <button type="button" id="add-select" class="add-button">+</button>
        </div>
        <table class="col-xs-12" border="1" style="border-collapse:collapse" id="element-table">
            <thead>
                <tr>
                    <th>
                        Element ID
                    </th>
                    <th>
                        Posiiton ID
                    </th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        
        <div class="select-option top-margin col-xs-12 hide" style="margin-top:15px">
            <input type="text" class="col-xs-12" id="option-name" placeholder="Option Name"/>
            <button type="button" id="add-option" style="float:right">Add Option</button>
        </div>
    </div>
    <div class="select-container-right" id="container-fields"  ondragenter="return dragEnter(event)" ondragover="return dragOver(event)"  ondrop="return dragDrop(event)"  >
        <div class="col-xs-12" style="background-color:black;height:80px;padding:20px">
            <select class="col-xs-12" id="form-select" style="padding:5px;margin-bottom:10px">
                <option value="">---Select Form---</option>
                <?php
                if(!empty($forms))
                {
                    foreach($forms AS $form)
                    {
                        ?>
                        <option value="<?php echo $form['id'] ?>"><?php echo $form['name'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <input type="text" placeholder="Name of Form" id="name" class="form-control" style="padding:5px;float:left"/> <button type="button" style="padding :5px;float:right;margin-right: 35px;" id="btn-save">Save</button>
        </div>
        <div class='col-xs-12' id='select-container-right-inside'>
            
        </div>
    </div>
</div>

<!-- Modal -->
<!--<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Option</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="add_option" class="form-control" placeholder="Add Option"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save-option">Save changes</button>
            </div>
        </div>
    </div>
</div>-->
<script>
    var selectID = 0;
    $(document).ready(function(){
        $('#form-select').change(function(){
            $('#select-container-right-inside').text('');
            var id = $(this).val();
            count = 1;
            if(id == '')
            {
                setAllPositions();
                resetTable();
                return;
            }
            $.get('/home/findForm', {id:id}, function(res){
                var html = '';
                var currentSelectID = 0;
                var lastID = 0;
                $('#select-container-right-inside').html('');
                $(res).each(function(i, value){
                    html = '';
                    if(value.id != currentSelectID)
                    {
                        currentSelectID = value.id;
                        console.log(currentSelectID);
                        html+= '<element-name draggable="true" ondragenter="return dragEnter(event)" ondragover="return dragOver(event)" ondragstart="return dragStart(event)" data-count="' + count + '" id="select_' + count + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container">';
                        html+= '   <span class="position_count col-xs-12" id="span_' + count + '"></span>';
                        html+= '   <p contenteditable="true" class="label-p"></p>';
                        html+= '    <main-inside-container-inside class="col-xs-9" id="main_inside_container_inside_' + count + '" data-type="' + value.type + '">';
                        if(value.type == 'select')
                        {
                            html+= '        <select data-type="' + value.type + '" id="textarea_' + count + '" class="col-xs-12 content-type select-type"><option value="">---Please Select---</option><option value="New">Add New Option</option>';
                                if(value.selected == '1')
                                {
                                    html+= '<option value="' + value.form_option_id + '" selected>' + value.name + '</option>';
                                }
                                else
                                {
                                    html+= '<option value="' + value.form_option_id + '">' + value.name + '</option>';
                                }
                            html+= '        </select>';
                            
                            html+= '<table border="1" style="width:100%" class="table-sub-menu">';
                            html+= '    <thead><tr><th>Sub Menu</th><th></th></tr></thead>';
                            html+= '    <tbody><tr><td><input type="text" class="col-xs-12"/></td><td><button type="button" class="btn-sub-menu-add">Add</button></td></tr></tbody>';
                            html+= '</table>';
                        }
                        else
                        {
                            html+= '        <div class="card"><textarea data-type="textarea" id="textarea_' + count + '" class="col-xs-12 content-type">' + value.value + '</textarea></div>';
                        }

                        html+= '    </main-inside-container-inside><div class="col-xs-3 "><button type="button" class=" btn-delete">Delete</button></div>';
                        html+= '</element-name>';
                        $('#select-container-right-inside').append(html);
                        lastID = 'textarea_' + count;
                    }
                    else
                    {
                        if(value.selected == '1')
                        {
                            $('#' + lastID).append('<option value="' + value.form_option_id + '" selected>' + value.name + '</option>');
                        }
                        else
                        {
                            $('#' + lastID).append('<option value="' + value.form_option_id + '">' + value.name + '</option>');
                        }
                    }
                    
                    count++;
                });
                
                
                setAllPositions();
                resetTable();
            },'json').fail(function(xhr) {
//                var html = '';
//                var res = xhr.responseJSON;
//
//                alert(res);
//                $('#btn-save').removeAttr('disabled');
//                window.location.href = '#body';
            },'json');;
        });
        
        
        $('#add-text').click(function(){
            $('#select-container-right-inside').append(addText());
            lastElementID = count - 1;
            setAllPositions();
            resetTable();
            
        });
        
        $('#add-select').click(function(){
            $('#select-container-right-inside').append(addSelect());
            lastElementID = count - 1;
            setAllPositions();
            resetTable();
            
        });
        
        $('#container-fields').click(function(){
            
        });
    });
    
    $(document).on('click', '.btn-delete', function(){
        var parent = $(this).parents('.main-inside-container').first();
        var conf = confirm("Are you sure you want to delete this?");
        if(conf)
        {
            $(parent).remove();
            setAllPositions();
        }
    });
    
    $(document).on('click', '.main-inside-container', function(e){
        if(e.ctrlKey)
        {
            $(this).addClass('draggable-content');
        }
        else if(!$(this).hasClass('draggable-content'))
        {
            $('.draggable-content').removeClass('draggable-content');
            $(this).addClass('draggable-content');
        }
        
        if(e.shiftKey){
            var startpos= $(this).attr('data-position');
            var endpos = $(this).attr('data-position');
            console.log(""+startpos+" "+endpos);
            //selectRowsBetweenIndexes(startpos, endpos);
        }
        currentPosition = $(this).attr('data-position');
        resetTable();
    });
    
     $(document).on('click', '#container-fields', function(e){
      //  $('.draggable-content').removeClass('draggable-content');
    });
    
     $(document).on('mouseup', 'body', function(e)
    {
        var subject = $("#select-container-right-inside"); 
        //console.log(e.target);
        if(e.target.id != subject.attr('id') && !subject.has(e.target).length)
        {
            $('.draggable-content').removeClass('draggable-content');
        }
    });
    
   
    
    $(document).on('click', '.select-area-left', function(e){
        $('.draggable-content').removeClass('draggable-content');
    });
    
    $(document).on('click', '#btn-save', function(res){
        var data = new Object();
        var count = 0;
        data['name'] = $('#name').val();
        data['items'] = new Object();
        $('#select-container-right-inside element-name').each(function(i, value){
            
            data['items'][count] = new Object();
            data['items'][count]['type'] = $(value).find('main-inside-container-inside').attr('data-type');
            if($(value).find('main-inside-container-inside').attr('data-type') == 'select')
            {
                data['items'][count]['options'] = new Object();
                var id = $(value).find('.select-type').attr('id');
                var count1 = 0;
                $("#" + id + " > option").each(function(i, value1) {
                    if($(value1).val() != 'New' && $(value1).val() != '')
                    {
                        data['items'][count]['options'][count1] = $(value1).val();
                        count1++;
                    }
                    
                });
            }
            data['items'][count]['value'] = $(value).find('.content-type').val();
            data['items'][count]['position'] = $(value).attr('data-position');
            count++;
        });
        
        saveForm(data);
    });
    
    
    
    $(document).on('click', '#btn-save-option', function(res){
        var option = $('#add_option').val();
        $('#' + selectID).html('<option value="' + option + '">' + option + '</option>');
    });
    
    function addSelect()
    {
        var ret = '<element-name draggable="true" ondragenter="return dragEnter(event)" ondragover="return dragOver(event)" ondragstart="return dragStart(event)" data-count="' + count + '" id="select_' + count + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container"><span class="position_count col-xs-12" id="span_' + count + '"></span><p contenteditable="true" class="label-p"></p><main-inside-container-inside class="col-xs-9" id="main_inside_container_inside_' + count + '" data-type="select"><select data-type="select"  id="textarea_' + count + '" class="col-xs-12 content-type select-type"><option value="">---Please Select---</option><option value="New">Add New Option</option></select></main-inside-container-inside><div class="col-xs-3 "><button type="button" class=" btn-delete">Delete</button></div></element-name>';
        count++;
        return ret;
    }
    
    function addText()
    {
        var ret =  '<element-name draggable="true" ondragenter="return dragEnter(event)" ondragover="return dragOver(event)" ondragstart="return dragStart(event)" data-count="' + count + '" id="textbox_' + count + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container"><span class="position_count col-xs-12" id="span_' + count + '"></span><p contenteditable="true" class="label-p"></p><main-inside-container-inside class="col-xs-9" id="main_inside_container_inside_' + count + '" data-type="textarea"><div class="card"><textarea data-type="textarea" id="textarea_' + count + '" class="col-xs-12 content-type"></textarea></div></main-inside-container-inside><div class="col-xs-3 "><button type="button" class="btn-delete">Delete</button></div></element-name>';
        count++;
        return ret;
    }
    
    function saveForm(data)
    {
        $.post('/home/buildercutomsave', {data:data}, function(res){
            alert('Form Added Successfully. Reloading Page.....');
            location.reload();
        },'json').fail(function(xhr) {
            var html = '';
            var res = xhr.responseJSON;
          
            alert(res);
            $('#btn-save').removeAttr('disabled');
            window.location.href = '#body';
        },'json');;
    }
    
    $(document).on('change', '.select-type', function(){
        selectID = $(this).attr('id')
        if($(this).val() == 'New')
        {
            $('.select-option').removeClass('hide');
        }
        else
        {
            $('.select-option').addClass('hide');
        }
    });
    
    $(document).on('click', '#add-option', function(){
        var name = $('#option-name').val();
        if(name.trim() == '')
        {
            alert("Name is required");
            return;
        }
        $('#' + selectID).append('<option value="' + name + '">' + name + '</option>');
        $('.select-option').addClass('hide');
        $('#' + selectID).val(name);
        $('#option-name').val('');
    });
   
   $(document).on('click', '.btn-sub-menu-add', function(){
       var parent = $(this).parents('table').first();
       $(parent).find('tbody').append('<tr><td><input type="text" class="col-xs-12"/></td><td><button type="button" class="btn-sub-menu-add">Add</button><button type="button" class="btn-sub-menu-delete">Delete</button></td></tr>');
   });
   
   $(document).on('click', '.btn-sub-menu-delete', function(){
       var conf = confirm("Are you sure you want to delete?");
       if(!conf)
       {
           return;
       }
       var parent = $(this).parents('tr').first();
       $(parent).remove();
   })
</script>