<?php if(isset($file_list) && count($file_list) > 0){
pr($file_list);
?>

<table width="100%">
	<tr>
		<th width="70%">Archivo</th>
		<th width="30%">Opciones</th>
	</tr>
	<?php foreach($file_list as $key=>$file){?>
	<tr>
		<td>
			<?php echo $file["nombre"]?>
		</td>
		<td>
			<button id="remove_file" 
            type="button" 
            class="btn btn-form" 
            data-type="remove"
            data-file="<?php echo $file['id']?>"
            onclick="btn_file(this)" >
     		Eliminar
     		</button>
		</td>
	</tr>
	<?php }?>
</table>
<?php } ?>