


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
                            <small>Select</small>
                            <a href="/lists/create" class="pull-right btn btn-danger">Add New List</a>
                        </div>
                        <div class="card-body">
                            <select class="col-sm-12 form-control" id="header_id">
                                <option value="">---Select Option---</option>
                                <?php
                                if(!empty($lists))
                                {
                                    ?>
                                    <?php
                                    foreach($lists AS $list)
                                    {
                                        ?>
                                            <option value="<?php echo $list['id'] ?>"><?php echo $list['name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                        
                        
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>List</strong>
                            <small>Add/Edit New Row</small>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12" id="list-body-container">
                                
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function(){
       $('#header_id').change(function(){
          var id = $(this).val();
          $('#list-body-container').append('Loading....');
          $.get('/lists/body/' + id, function(res){
              var html = '<table class="table table-bordered" id="body-table"><tbody>';
              $(res).each(function(i, value){
                  html+= '<tr><td>' + value.name + '</td><td><button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></td></tr>';
              });
              html+= '<tr><td><span class="col-sm-12 editable-text-border pull-left data-name"></span></td><td><button type="button" class="btn btn-danger btn-add btn-sm"><i class="fa fa-plus"></i></button></td></tr>';
              
            html+= '</tbody><tfoot><tr><td colspan="2"><button type="button" class="btn btn-success" id="add-new-rows">Add New Rows</button></td></tr></tfoot></table>';
              $('#list-body-container').html(html);
          },'json');
       });
    });
    
    $(document).on('click', '.btn-add', function(){
        var html = '<tr><td><span class="col-sm-12 editable-text-border pull-left data-name"></span></td><td><button type="button" class="btn btn-danger btn-add btn-sm"><i class="fa fa-plus"></i></button></td></tr>';
        $('#body-table tbody').append(html);
    });
    
    $(document).on('click', '#add-new-rows', function(){
       var data = new Object();
       var count = 0;
       $('#body-table tbody tr').each(function(i, value){
           data[count]['name'] = $(value).attr('data-name');
           count++;
       });
       
       saveAllRows(data);
    });
    
    function saveAllRows(data)
    {
        var id = $('#header_id').val();
        $.post('/lists/save_body', {data:data, id:id}, function(){
            
        });
    }
</script>