<script>
 function dragStart(ev) {
            var id =  ev.target.getAttribute('id');
            
            ev.dataTransfer.effectAllowed='move';
            ev.dataTransfer.setData("Text", ev.target.getAttribute('id'));
         //   ev.dataTransfer.setDragImage(ev.target,0,0);
            
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
            var id = ev.target.id;
            $('.select-container-right').append('<div class="col-xs-12 top-margin main-text-area-continer"><div class="col-xs-9"><textarea class="col-xs-12"></textarea></div><div class="col-xs-3 "><button type="button" class="col-xs-12 btn-delete">Delete</button></div></div>');
           //ev.target.appendChild(document.getElementById(src));
            //ev.target.appendChild('<div class="col-xs-12 top-margin"><div class="col-xs-9"><textarea class="col-xs-12"></textarea></div><div class="col-xs-3 "><button type="button" class="col-xs-12 btn-delete">Delete</button></div></div>');
            ev.stopPropagation();
            
            return false;
         }
</script>


<div class="create-area">
    <div class="select-area-left">
        <div class="text-area-c hcenter" id="text-area-container" draggable="true"
                        ondragstart="return dragStart(event)">
            Text Area <button type="button" id="add-button">Add +</button>
        </div>
    </div>
    <div class="select-container-right" ondragenter="return dragEnter(event)" ondrop="return dragDrop(event)"  ondragover="return dragOver(event)">
        
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#add-button').click(function(){
            $('.select-container-right').append('<div class="col-xs-12 top-margin main-text-area-continer"><div class="col-xs-9"><textarea class="col-xs-12"></textarea></div><div class="col-xs-3 "><button type="button" class="col-xs-12 btn-delete">Delete</button></div></div>');
        });
    });
    
    $(document).on('click', '.btn-delete', function(){
        var parent = $(this).parents('.main-text-area-continer').first();
        var conf = confirm("Are you sure you want to delete this?");
        if(conf)
        {
            $(parent).remove();
        }
    });
</script>