<script>
var count = 0;
 function dragStart(ev) {
            var id =  ev.target.getAttribute('id');
            console.log(ev.target.getAttribute('class'));
            ev.dataTransfer.effectAllowed='move';
            
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
            if(ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER'  || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE')
            {
                $('#' + id).parents('.main-text-area-continer').first().after('<div class="col-xs-12 inBetween" ></div>');
            }
            var tar = ev.target.innerHTML;
            return true;
         }
         
         function dragOver(ev) {
            if(ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT' || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER'  || ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE')
            {
                $('.inBetween').slideUp('slow');
            }
            return false;
         }
         
         function dragDrop(ev) {
            if($('.draggable-content').length == 0)
            {
                var src = ev.dataTransfer.getData("Text");
                var id = ev.target.id;
                dropCommon(id, ev, src);
                
            }
            else
            {
                $('.draggable-content').each(function(i, value){
                    var src = ev.dataTransfer.getData("Text_" + $(value).attr('id'));
                    var id = ev.target.id;
                    dropCommon(id, ev, src);

                });
            }
            ev.stopPropagation();
            $('.draggable-content').removeClass('draggable-content');
            return false;
         }
         
         function dropCommon(id, ev, src)
         {
             if(id == 'container-fields')
                {
                    if(src == 'text-area-container')
                    {
                        $('#' + id).append(addText());
                    }
                    else if(src == 'select-container')
                    {
                        $('#' + id).append(addSelect());
                    }
                    else
                    {
                        if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER')
                        {
                            ev.target.after(document.getElementById(src));
                        }
                        else if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE' || ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT')
                        {
                           var parent = $('#' + id).parents('.main-inside-container').first();
                            $(parent).after(document.getElementById(src));
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
                        if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER')
                        {
                            ev.target.after(document.getElementById(src));
                        }
                        else if(ev.target.nodeName == 'MAIN-INSIDE-CONTAINER-INSIDE' || ev.target.nodeName == 'TEXTAREA' || ev.target.nodeName == 'SELECT')
                        {
                            var parent = $('#' + id).parents('.main-inside-container').first();
                            $(parent).after(document.getElementById(src));
                        }
                    }

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
            Select <button type="button" id="add-select" class="add-button">+</button>
        </div>
    </div>
    <div class="select-container-right" id="container-fields" ondragenter="return dragEnter(event)" ondrop="return dragDrop(event)"  ondragover="return dragOver(event)">
        
    </div>
</div>
<script>
    
    $(document).ready(function(){
        $('#add-text').click(function(){
            $('.select-container-right').append(addText());
        });
        
        $('#add-select').click(function(){
            $('.select-container-right').append(addSelect());
            
        });
    });
    
    $(document).on('click', '.btn-delete', function(){
        var parent = $(this).parents('.main-inside-container').first();
        var conf = confirm("Are you sure you want to delete this?");
        if(conf)
        {
            $(parent).remove();
        }
    });
    
    $(document).on('click', '.main-inside-container', function(){
        if($(this).hasClass('draggable-content'))
        {
            $(this).removeClass('draggable-content');
        }
        else
        {
            $(this).addClass('draggable-content');
        }
    })
    
    function addSelect()
    {
        return '<main-inside-container draggable="true" ondragstart="return dragStart(event)" id="count_' + count++ + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container"><main-inside-container-inside class="col-xs-9"><select data-type="select" id="textarea_' + count++ + '" class="col-xs-12"><option value="">Option 1</option></select></main-inside-container-inside><div class="col-xs-3 "><button type="button" class=" btn-delete">Delete</button></div></main-inside-container>';
    }
    
    function addText()
    {
        return '<main-inside-container draggable="true" ondragstart="return dragStart(event)" id="container_' + count++ + '" class="col-xs-12 top-margin main-text-area-continer main-inside-container"><main-inside-container-inside class="col-xs-9"><textarea data-type="textarea" id="textarea_' + count++ + '" class="col-xs-12"></textarea></main-inside-container-inside><div class="col-xs-3 "><button type="button" class="btn-delete">Delete</button></div></main-inside-container>';
    }
</script>