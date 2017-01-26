<?php if(isset($file_list)){
pr($file_list);
?>

<table>
	<tr>
		<th>Archivo</th>
		<th>Opciones</th>
	</tr>
	<tr>
		<td>
			Nombre
		</td>
		<td>
			<input type="hidden" value="file" data-file="123">
		</td>
	</tr>
</table>
<?php } ?>