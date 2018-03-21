<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}
</script>
<div class="create-area">
    <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
        <img src="/assets/images/profile.png" draggable="true" ondragstart="drag(event)" id="drag1" style="width:100%;float:left">
</div>

<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
</div>