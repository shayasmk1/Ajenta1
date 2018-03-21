<style>
    .input-control-0,.input-control-1,.input-control-2,.input-control-3,.input-control-4,.input-control-5,.input-control-6,.input-control-7,.input-control-8,
    .input-control-9,.input-control-10,.input-control-11,.input-control-12, .toggle-form
    {
        display:none !important;
    }
</style>

<link href = "/assets/css/dropzone.css" rel = "stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="/assets/libraries/formBuilder/dist/form-builder.min.js"></script>
<script src="/assets/js/dropzone.js"></script>
<div class="create-area">
<div class="build-wrap"></div>
</div>
<script>
jQuery(function($) {
  $('.build-wrap').formBuilder();
});
</script>