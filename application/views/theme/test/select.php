
<select class="select-box">
    <option value="">---Select Option----</option>
    <?php
    if(!empty($headers))
    {
        foreach($headers AS $header)
        {
            ?>
            <option value="<?php echo $header['id'] ?>"><?php echo $header['name'] ?></option>
    <?php
        }
    }
    ?>
    <option value="!@#$%^^^QWERFFTGT%$##">Add New List</option>
</select>
<?php 
    if($message != '')
    {
        ?>
    
    <div class="error"><?php echo $message ?></div>
    <?php
    }
    ?>
<form method="POST" class="create-area" style="display:none">
    
    <div class="textarea-container">
        <textarea class="new-textarea" name="name"></textarea>
    </div>
    <button type="submit" id="btn-submit">Submit</button>
</form>

<script>
    $(document).ready(function(){
        $('#add-textarea').click(function(){
            $('.create-area').append('<div class="textarea-container"><textarea class="new-textarea" placeholder="Text"></textarea></div>')
        });
        
        $('.select-box').change(function(){
            var value = $(this).val();
            if(value == '!@#$%^^^QWERFFTGT%$##')
            {
                
                $('.create-area').show();
            }
            else if(value != '')
            {
                window.location.href = '/home/body/' + value;
                //$('.create-area').hide();
            }
        });
    });
</script>