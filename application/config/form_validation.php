<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['inicio_sesion'] = array(
        array(
            'field' => 'nick',
            'label' => 'Nombre de usuario',
            'rules' => 'required|max_length[20]|alpha_dash'
        ),
        array(
            'field' => 'passwd',
            'label' => 'Contraseña',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'userCaptcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|check_captcha'
        ),
);
$config["solicitud"]=array(
        array(
            'field' => 'libro[titulo]',
            'label' => 'Título de la obra',
            'rules' => 'required'
        ),
        array(
            'field' => 'solicitud_categoria',
            'label' => 'Categoría',
            'rules' => 'greater_than[0]',
            'errors'=>array(
                'greater_than'=>"El campo %s es obligatorio"
            )
        ),
        array(
            'field' => 'solicitud[subcategoria_id]',
            'label' => 'Sub categoría',
            'rules' => 'greater_than[0]',
            'errors'=>array(
                'greater_than'=>"El campo %s es obligatorio"
            )
        ),
    );


