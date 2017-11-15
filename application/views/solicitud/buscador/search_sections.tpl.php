<table>
	<tr>
		<td colspan="2">
			<input name='all' type='checkbox' class='js-switch' value="1"/>&nbsp;Todas las secciones 
		</td>
		<td >
			<input name='df' type='checkbox' class='js-switch' value="1"/>&nbsp;Descripción Física 
		</td>
	</tr>
<?php

$i = 0;
foreach ($fields as $section) {
	if($i==0){
		echo "<tr>";
	}elseif($i==3){
		echo "</tr>";
		$i=0;
	}
	$i++;
	echo "<td width='33%'><input
               name='seccion[".$section["cve"]."]' 
               type='checkbox'
               class='js-switch' 
               /> &nbsp;".$section["label"]."</td>";
}
?>
</table>
<?php
// pr($fields);
?>