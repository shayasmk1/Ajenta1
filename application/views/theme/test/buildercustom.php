<script>
var count = 1;
var trs = document.getElementById('select-container-right-inside');

    
    
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
                $('#' + id).parents('.main-text-area-continer').first().after('<div class="col-xs-12 inBetween" ></div>');
            }
            var tar = ev.target.innerHTML;
            return true;
         }
         
         function dragOver(ev) {
            if(ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'ELEMENT-NAME'  || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE')
            {
                //$('.inBetween').slideUp('slow');
            }
            return false;
         }
         
         function dragDrop(ev) {
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
            return false;
         }
         
         function dropCommon(id, ev, src, currentID)
         {
             if(id == 'container-fields')
                {
                    if(src == 'text-area-container')
                    {
                        $('#select-container-right-inside').append(addText());
                    }
                    else if(src == 'select-container')
                    {
                        $('#select-container-right-inside').append(addSelect());
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
                        else if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE' || ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT')
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
                    if(src == 'text-area-container')
                    {
                        $('#' + id).parents('.main-text-area-continer').first().after(addText());
                    }
                    else if(src == 'select-container')
                    {
                        $('#' + id).parents('.main-text-area-continer').first().after(addSelect());
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
                        else if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE' || ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT')
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
               $(value).attr('data-positon', positionCount);
               
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
    </div>
    <div class="select-container-right" id="container-fields" ondragenter="return dragEnter(event)" ondrop="return dragDrop(event)"  ondragover="return dragOver(event)">
        <div class='col-xs-12' id='select-container-right-inside'>
            
        </div>
    </div>
</div>
<script>
    
    $(document).ready(function(){
        $('#add-text').click(function(){
            $('#select-container-right-inside').append(addText());
            setAllPositions();
        });
        
        $('#add-select').click(function(){
            $('#select-container-right-inside').append(addSelect());
            setAllPositions();
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
            var startpos= $(this).attr('data-positon');
            var endpos = $(this).attr('data-positon');
            console.log(""+startpos+" "+endpos);
            //selectRowsBetweenIndexes(startpos, endpos);
        }
        
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
    
    function addSelect()
    {
        var ret = '<element-name draggable="true" ondragstart="return dragStart(event)" data-count="' + count + '" id="select_' + count + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container"><span class="position_count col-xs-12"></span><main-inside-container-inside class="col-xs-9"><select data-type="select" id="textarea_' + count + '" class="col-xs-12"><option value="">Option 1</option></select></main-inside-container-inside><div class="col-xs-3 "><button type="button" class=" btn-delete">Delete</button></div></element-name>';
        count++;
        return ret;
    }
    
    function addText()
    {
        var ret =  '<element-name draggable="true" ondragstart="return dragStart(event)" data-count="' + count + '" id="textbox_' + count + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container"><span class="position_count col-xs-12"></span><main-inside-container-inside class="col-xs-9"><div class="card"><textarea data-type="textarea" id="textarea_' + count + '" class="col-xs-12"></textarea></div></main-inside-container-inside><div class="col-xs-3 "><button type="button" class="btn-delete">Delete</button></div></element-name>';
        count++;
        return ret;
    }
    
</script>