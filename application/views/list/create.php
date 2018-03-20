


<!-- End File Upload -->

<!-- Gallery -->

<!-- End of Gallery -->


<main class="main">

      <!-- Breadcrumb -->
    <ol class="breadcrumb">
<!--  <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item"><a href="#">Admin</a></li>-->
      <li class="breadcrumb-item active">List</li>


    </ol>
      
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>List</strong>
                            <small>Create</small>
                           
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="List Name" id="name"/>
                            <button type="button" class="btn btn-success top-margin" id="submit-button">Submit</button>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function(){
       $('#submit-button').click(function(){
          var name = $('#name').val().trim();
          if(name == '')
          {
              alert("Name is Required");
              return;
          }
          var current  = $(this);
          $(current).attr('disabled', 'disabled').text('Submitting Name');
          $.post('/lists/ajax/create', {name:name}, function(res){
              alert(res);
              location.reload();
          },'json').fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON);
                $(current).removeAttr('disabled').text('Submit');
            },'json');;
       });
    });
</script>