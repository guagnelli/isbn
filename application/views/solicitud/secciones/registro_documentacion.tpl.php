<?php 
//css
echo css("../uf/css/style.css");

?>
<p class="lead">Registro de documentaci&oacute;n <?php echo $comentarios; ?></p>
<?php
echo form_open("solicitud/upload",array(
    'id'=>'upload',
    'method'=>'post',
    "enctype"=>"multipart/form-data"
));
?>	
	<div id="drop">
		Arrastra aquí
		<a>Buscar</a>
		<input type="file" name="upl" multiple />
	</div>

	<ul>
		<!-- The file uploads will be shown here -->
	</ul>
<?php 
echo form_close(); 
//<!-- JavaScript Includes -->
//echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>';
?>
<?php 
		echo js("../uf/js/jquery.knob.js");
		//<!-- jQuery File Upload Dependencies -->
		echo js("../uf/js/jquery.ui.widget.js");
		echo js("../uf/js/jquery.iframe-transport.js");
		echo js("../uf/js/jquery.fileupload.js");
		?>
<?php
//<!-- Our main JS file -->
echo js("../uf/js/script.js");
?>