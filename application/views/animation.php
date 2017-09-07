<!DOCTYPE html>
<html>
<head>
<style type="text/css"></style>


<script type="text/javascript"
	src="http://code.jquery.com/jquery-latest.min.js"></script>
<title></title>
</head>

<!-- Start your code here -->


<body
	background="http://s5.postimg.org/6v1uiqb93/sparrow-bird-sitting.jpg"></body>

<!-- End your code here -->

<script>
$(document).ready(function(){ 
    
    $(document).click(function (ev) {
        if($('div').length < 3) {
        		$(".marker").remove();
            	$("body").append(            
                $('<div class="marker"></div>').css({
                    position: 'absolute',
                    top: ev.pageY + 'px',
                    left: ev.pageX + 'px',
                    //console.log('x: ' + ev.pageX + ', y: ' + ev.pageY);
                    //console.log(ev.pageX,ev.pageY);
                    width: '10px',
                    height: '10px',
                    background: '#000000'
                })              
            );
        }
    });
    
});
</script>
<div class="marker"
	style="position: absolute; top: 209px; left: 207px; width: 10px; height: 10px; background: rgb(0, 0, 0);"></div>
</body>