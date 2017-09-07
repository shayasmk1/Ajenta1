
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>REST Server Tests</title>

    
</head>
<body>

<div id="container">
    <h1>REST Server Tests</h1>

    <div id="body">


        <ol>

            <li><a href="<?php echo site_url('api/unity/users/id/1'); ?>">User #1</a> - defaulting to JSON  (users/id/1)</li>
            <li><a href="<?php echo site_url('api/unity/users/1'); ?>">User #1</a> - defaulting to JSON  (users/1)</li>
            
        </ol>

    </div>

   </div>

<script src="https://code.jquery.com/jquery-1.12.0.js"></script>


</body>
</html>
