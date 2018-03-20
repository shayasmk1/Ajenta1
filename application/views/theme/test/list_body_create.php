 <div>Existing List Names</div>
    <select class="select-box">
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
    
</select>
 
 <?php 
    if($message != '')
    {
        ?>
    
    <div class="error"><?php echo $message ?></div>
    <?php
    }
    ?>

 <form class="create-area" method="post">
   
    <div class="textarea-container"><textarea class="new-textarea" placeholder="List Name" name="name"></textarea></div>
    <button type="submit">Add List Name</button>
</form>

<script>
    $(document).ready(function(){
        $('#add-textarea').click(function(){
            $('.create-area').append('<div class="textarea-container"><textarea class="new-textarea" placeholder="Text"></textarea></div>')
        });
    });
</script>