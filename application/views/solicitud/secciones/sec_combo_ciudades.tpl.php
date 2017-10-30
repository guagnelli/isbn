<?php
    echo $this->form_complete->create_element(array('id' => 'ciudad_id',
        'type' => 'dropdown',
        'options' => $combos["c_ciudad"],
        'first' => array('' => "Seleccione una opción"),
        'value' => isset($edicion["ciudad_id"]) ? $edicion["ciudad_id"] : "",
        'class' => '',
        'attributes' => array('class' => '')
    ));
?>
<?php echo form_error('ciudad_id'); ?>