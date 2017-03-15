
<?php 
if(isset($debug)){
	pr($debug);
}
if(isset($files) && count($files) > 0){
//pr($files);
?>
<table id="datatable-responsive" 
   class="table table-striped table-bordered dt-responsive nowrap" 
   cellspacing="0" 
   width="100%">
	<tr>
		<th width="30%">Archivo</th>
		<th width="50%">Descripci&oacute;n</th>
		<th width="20%">Opciones</th>
	</tr>
	<?php foreach($files as $key=>$file){?>
	<tr>
		<td><?php 
		$uri = asset_url()."js/uf/uploads/".$file["solicitud_id"]."/".$file["nombre_fisico"];
		echo anchor_popup(
			$uri, 
			$file["nombre"], 
			FALSE);
		?>
		</td>
		<td>
			<?php echo $file["description"]?>
		</td>
		<td>
			<button id="remove_file" 
            type="button" 
            class="btn btn-form" 
            data-file="<?php echo $file['id']?>"
            onclick="btn_dfile(this)" >
     		Eliminar
     		</button>
		</td>
	</tr>
	<?php }?>
</table>
<?php } ?>