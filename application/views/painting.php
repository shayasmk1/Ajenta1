

<link type="text/css" rel="stylesheet"
      href="<?php echo base_url(); ?>assets/css/fileinput.css" />
<script type="text/javascript"
src="<?php echo base_url(); ?>assets/js/notify.js"></script>
<script type="text/javascript"
src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
<script type="text/javascript"
src="<?php echo base_url(); ?>assets/css/boostrap.css"></script>

<script type="text/javascript">
    function addNewValue() {
        var x = document.getElementById("mySelect");
        var option = document.createElement("option");
        option.text = "Other";
        x.add(option);
    }
</script>



<div class="container-fluid">
    <ol class="breadcrumb my-3">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">This is for Pagination</li>
    </ol>

    <div class="row">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12">

                <?php echo form_open_multipart('painting/upload'); ?>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                        <p>
                            Select Cave Number:<br/>
                            <?php
                            $options0 = array(
                                'cave1' => 'Cave 1',
                                'cave2' => 'Cave 2',
                                'cave3' => 'Cave 3',
                                'cave4' => 'Cave 4',
                                'cave5' => 'Cave 5',
                                'cave6' => 'Cave 6',
                                'cave7' => 'Cave 7',
                                'cave8' => 'Cave 8',
                                'cave9' => 'Cave 9',
                                'cave10' => 'Cave 10',
                                'cave11' => 'Cave 11',
                                'cave12' => 'Cave 12',
                                'cave13' => 'Cave 13',
                                'cave14' => 'Cave 14',
                                'cave15' => 'Cave 15',
                                'cave16' => 'Cave 16',
                                'cave17' => 'Cave 17',
                                'cave18' => 'Cave 18',
                                'cave19' => 'Cave 19',
                                'cave20' => 'Cave 20',
                                'cave21' => 'Cave 21',
                                'cave22' => 'Cave 22',
                                'cave23' => 'Cave 23',
                                'cave24' => 'Cave 24',
                                'cave25' => 'Cave 25',
                                'cave26' => 'Cave 26',
                                'cave27' => 'Cave 27',
                                'cave28' => 'Cave 28',
                                'cave29' => 'Cave 29',
                            );
                            echo form_dropdown('cave_numb', $options0, 'cave1', 'class="dropdown_box0"')
                            ?>
                        </p>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                        <p>
                            Description <?php
                            $data = array(
                                'name' => 'txt_area',
                                'id' => 'txt_area',
                                'rows' => '5',
                                'cols' => '10',
                                'style' => 'width:100%',
                            );
                            echo form_textarea($data);
                            ?>
                        </p>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                        <p>
                            Cave Period <br/><select id="mySelect" size="4">
                                <option>Satvahana</option>
                                <option>Vakataka</option>
                                <option>Other</option>
                            </select>
                        </p>
                        <button type="button" onclick="addNewValue()">Add New Value</button>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                        <p>
                            Cave Type <br/> <?php
                            $options3 = array(
                                'cave1' => 'Chaitya',
                                'cave2' => 'Vihara',
                                'cave3' => 'Other',
                            );
                            echo form_dropdown('cave_period', $options3, 'cave1', 'class="dropdown_box0"')
                            ?>
                        </p>
                    </div>

                </div>


                <div class="form-group">
                    <input id="file-3" name="userfile" type="file">
                </div>




                <div class="form-group">
                    <input id="upload-btdn" type="submit" class="btn btn-success"
                           name="submit" value="Upload Image">
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $("#file-3").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn-padding btn btn-primary btn-small"

    });

    $(function () {
        var inputFile = $('input[name=userfile]');
        var uploadURI = $('#form-upload').attr('action');
        var progressBar = $('#progress-bar');

        $("form#form-upload").submit(function () {
            event.preventDefault();
            var fileToUpload = inputFile[0].files[0];
            // make sure there is file to upload
            if (fileToUpload != 'undefined') {
                // provide the form data
                // that would be sent to sever through ajax
                var formData = new FormData($(this)[0]);
                // now upload the file using $.ajax
                $.ajax({
                    url: uploadURI,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.result == '1') {

                            $.notify({
                                title: "<strong>Upload Completed</strong> ",
                                message: "Uploading Completed..!"
                            }, {
                                type: 'success'
                            });

                        } else {
                            $.notify({
                                title: "<strong>Upload Completed</strong> ",
                                message: "Uploading Completed..!"
                            }, {
                                type: 'warning'
                            });
                        }
                    },
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (event) {
                            if (event.lengthComputable) {
                                var percentComplete = Math.round((event.loaded / event.total) * 100);
                                // console.log(percentComplete);
                                $('.progress').show();
                                progressBar.css({width: percentComplete + "%"});
                                progressBar.text(percentComplete + '%');
                            }
                            ;
                        }, false);
                        return xhr;
                    }
                });
            }
        });
        $('body').on('change.bs.fileinput', function (e) {
            $('.progress').hide();
            progressBar.text("0%");
            progressBar.css({width: "0%"});
        });
    });

</script>


