<?php
echo form_open("solicitud/sec_edicion",array(
    'id'=>'frm_edicion',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
if(isset($debug)){
  pr($debug);
}
?>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <div id="gender" class="btn-group" data-toggle="buttons">
	    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	      <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
	    </label>
	    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	      <input type="radio" name="gender" value="female"> Female
	    </label>
	  </div>
	</div>
</div>
<?php
echo form_close();
?>