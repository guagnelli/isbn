<?php
  echo $this->form_complete->create_element(array(
   'id' => 'solicitud[id_subcategoria]',
   'type' => 'dropdown',
   'options' => dropdown_options($combos["sub_categorias"], "id", "nombre"),
   'first' => array('' => "Seleccione una opción"),
   'class' => '',
   ));
 ?>