<p>Se le informa que se ha realizado una actualización en la solicitud con folio 
	<?php echo $solicitud['folio']; ?> correspondiente al título "<?php echo $solicitud['libro']['title']; ?>"
	por lo que se le recomienda dar continuidad a los procedimientos requeridos.</p>
<br>
<p>Historial de actualizaciones:</p>
<table>
	<thead>
		<tr>
			<th>Estado</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($historial as $key_his => $his) {
			echo '<tr>
					<td>'.$his['name'].'</td>
					<td class="text-center">'.nice_date($his['reg_revision'], 'd-m-Y h:i:s').'</td>
				</tr>';
		}
		?>
	</tbody>
</table>
<br>
<p>Atte.</p>
<p>Administración del Sistema ISBN-UNAM</p>