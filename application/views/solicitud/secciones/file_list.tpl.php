
<?php if(isset($files) && count($files) > 0){
//pr($files);
?>
<table width="100%">
	<tr>
		<th width="30%">Archivo</th>
		<th width="50%">Descripci&oacute;n</th>
		<th width="20%">Opciones</th>
	</tr>
	<?php foreach($files as $key=>$file){?>
	<tr>
		<td>
			<?php echo $file["nombre"]?>
		</td>
		<td>
			<?php echo $file["description"]?>
		</td>
		<td>
			<!--button id="remove_file" 
            type="button" 
            class="btn btn-form" 
            data-type="remove"
            data-file="<?php echo $file['id']?>"
            onclick="btn_dfile(this)" >
     		Eliminar
     		</button-->
		</td>
	</tr>
	<?php }?>
</table>
<?php } ?>