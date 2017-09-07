<!DOCTYPE html>
<html>

<head>
<style type="text/css">
.clickable {
	border: 1px solid #333;
	background: #eee;
	height: 500px;
	width: 1060px;
	margin: 15px;
		}

.display {
	text-transform: uppercase;
	color: blue;
}
</style>
<script type="text/javascript"
	src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>


<body>
	<div class="clickable">
	<div id="click_position">
	<img class="imag" src="" width="1060" height="500"></img></div>
		<span class="display"></span>
	</div>

	<script>
	$(document).ready(function(){
	$('.clickable').bind('click', function (ev) {
	    var $div = $(ev.target); //Catch target element as $div
	    var $display = $div.find('imag'); //search "imag" and call it display
	    x = ev.pageX; //Get X Value
	    y = ev.pageY; //Get Y Value

	    var e = document.createElement('input'); //Create Input Element
		e.type ="text"; //Defining type

		var btn = document.createElement("BUTTON"); //Create Button Element
	    var t = document.createTextNode("CANCEL"); //Create Text node
	    btn.appendChild(t); //Append text to button
	    document.body.appendChild(btn); // Append <button> to <body>
	    this.parentNode.appendChild(e);

	    var btns = document.createElement("BUTTON"); //Create Button Element
	    var ts = document.createTextNode("SUBMIT"); //Create Text node
	    btns.appendChild(ts); //Append text to button
	    document.body.appendChild(btns); // Append <button> to <body>	    
	    console.log('x: ' + x + ', y: ' + y);

});
	});
	</script>
</body>
</html>