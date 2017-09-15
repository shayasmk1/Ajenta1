
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
        <div class='each-api'>
            /api/v1/cave/register - POST
            <br/>
            required fields : data[email], data[password], data[name]
            <br/>
            Return value : 
            <br/>
            {
    "message": "User Registered Successfully",
    "id": 4
}
<br/>
(id is client_id)
        </div>
        
        <div class='each-api'>
            /api/v1/cave/login - POST
            <br/>
            required fields : data[email], data[password]
            <br/>
            Return value : 
            <br/>
            {
    "message": "Login Successful",
    "access_token": "311b57e49036bd6f480cb2c76e8f05e4"
}
        </div>
        
        <div class='each-api'>
            /api/v1/cave/list - GET
            <br/>
            required fields : client_id, access_token
            <br/>
            Return value : 
            <br/>
            {"data":[{"cave_id":"58","cave_numb":"3","cave_description":"This is an incomplete monastery (10.08 X 8.78 m) and only the preliminary excavation of pillared verandah exist.","cave_patron":"Harisena's Queen","cave_period":"Satvahana","cave_type":"","date_added":"2017-07-17","uploaded_by":"ajanta.team"},{"cave_id":"59","cave_numb":"4","cave_description":"This squarish monastery consists of a hall, sanctum sanctorum, pillared verandah. This is the largest monastery at Ajanta measuring (35.08 X 27.65 m). The door frame is exquisitely sculpted flanking to the right is carved Bodhisattva as reliever of Eight Great Perils. The cave was once painted, traces of which can be noticed. The ceiling of the hall shows a unique geological feature of a lava flow....","cave_patron":"Mathuradasa","cave_period":"Vakataka","cave_type":"","date_added":"2017-08-27","uploaded_by":"ajanta.team"},{"cave_id":"60","cave_numb":"5","cave_description":"","cave_patron":"","cave_period":"","cave_type":"","date_added":"2017-07-17","uploaded_by":"ajanta.team"},{"cave_id":"61","cave_numb":"6","cave_description":"This is a double storeyed monastery (16.85 X 18.07 m) consisting of hall, sanctum sanctorum and a pillared hall in the lower storey and a hall with cells, subsidiary cells and sanctum sanctorum in the upper storey. Buddha in preaching attitude is housed in both the shrines. The depiction of Miracle of Sravasti and Temptation of Mara are the important paintings. Sculptural depiction of Buddha in various attitudes and postures can also be noticed here.","cave_patron":"","cave_period":"","cave_type":"","date_added":"2017-07-17","uploaded_by":"ajanta.team"},{"cave_id":"62","cave_numb":"7","cave_description":"This monastery (15.55 X 31.25 m) consists of a sanctum sanctorum, an oblong open hall with two small porticos supported by heavy octagonal pillars and eight cells. Buddha in preaching attitude is housed inside the sanctum. Other sculptural panels include Miracle of Sravasti, seated Buddha under the protection of Nagamuchalinda.","cave_patron":"","cave_period":"","cave_type":"","date_added":"2017-07-14","uploaded_by":"ajanta.team"},{"cave_id":"66","cave_numb":"74","cave_description":null,"cave_patron":null,"cave_period":null,"cave_type":null,"date_added":"2017-08-04","uploaded_by":"ajanta.team"},{"cave_id":"67","cave_numb":"2147483647","cave_description":"s;gnwsigblrwg","cave_patron":"wg;knwolgb","cave_period":"gljsbwgow","cave_type":"gbweogb","date_added":"2017-09-06","uploaded_by":"ajanta.team"}]}
        </div>
        
        <div class='each-api'>
            /api/v1/cave/single - GET
            <br/>
            required fields : client_id, access_token, data[cave_num]
            <br/>
            Return value : 
            <br/>
            {
    "data": [
        {
            "cave_id": "59",
            "cave_numb": "4",
            "cave_description": "This squarish monastery consists of a hall, sanctum sanctorum, pillared verandah. This is the largest monastery at Ajanta measuring (35.08 X 27.65 m). The door frame is exquisitely sculpted flanking to the right is carved Bodhisattva as reliever of Eight Great Perils. The cave was once painted, traces of which can be noticed. The ceiling of the hall shows a unique geological feature of a lava flow....",
            "cave_patron": "Mathuradasa",
            "cave_period": "Vakataka",
            "cave_type": "",
            "date_added": "2017-08-27",
            "uploaded_by": "ajanta.team"
        }
    ]
}
        </div>
        
        <div class='each-api'>
            /api/v1/cave/edit - POST
            <br/>
            required fields : client_id, access_token, data[cave_num],data[cave_description], data[cave_patron], data[cave_period], data[cave_type], data[date_added], data[uploaded_by]
            <br/>
            Return value : 
            <br/>
           {
    "message": "Updated Successfully"
}
        </div>
        
        <div class='each-api'>
            /api/v1/cave/delete - POST
            <br/>
            required fields : client_id, access_token, data[cave_num]
            <br/>
            Return value : 
            <br/>
            Delete Successfull{"message":"Deleted Successfully"}
        </div>

<!--        <ol>

            <li><a href="<?php echo site_url('api/unity/users/id/1'); ?>">User #1</a> - defaulting to JSON  (users/id/1)</li>
            <li><a href="<?php echo site_url('api/unity/users/1'); ?>">User #1</a> - defaulting to JSON  (users/1)</li>
            
        </ol>-->

    </div>

   </div>

<script src="https://code.jquery.com/jquery-1.12.0.js"></script>


</body>
</html>
