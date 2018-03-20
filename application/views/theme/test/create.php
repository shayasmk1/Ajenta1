
<button type="button" id="add-textarea">Add TextArea</button>
<div class="create-area">
    
</div>

<script>
    $(document).ready(function(){
        $('#add-textarea').click(function(){
            $('.create-area').append('<div class="textarea-container"><textarea class="new-textarea" placeholder="Text"></textarea></div>')
        });
    });
</script>