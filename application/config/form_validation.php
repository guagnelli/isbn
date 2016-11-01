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
$config["solicitud"] = array(
    array(
        'field' => 'libro[title]',
        'label' => 'Título de la obra',
        'rules' => 'required'
    ),
    array(
        'field' => 'solicitud_categoria',
        'label' => 'Categoría',
        'rules' => 'greater_than[0]',
        'errors' => array(
            'greater_than' => "El campo %s es obligatorio"
        )
    ),
    array(
        'field' => 'solicitud[id_subcategoria]',
        'label' => 'Sub categoría',
        'rules' => 'greater_than[0]',
        'errors' => array(
            'greater_than' => "El campo %s es obligatorio"
        )
    ),
);
$config["form_perfil"] = array(
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[20]'
    ),
    array(
        'field' => 'apaterno',
        'label' => 'Apellido paterno',
        'rules' => 'trim|required|max_length[20]'
    ),
    array(
        'field' => 'amaterno',
        'label' => 'Apellido materno',
        'rules' => 'trim|required|max_length[20]'
    ),
    array(
        'field' => 'correo',
        'label' => 'Correo',
        'rules' => 'trim|required|max_length[40]|valid_email'
    ),
    array(
        'field' => 'contrasenia',
        'label' => 'Contraseña',
        'rules' => 'trim|required|max_length[150]'
    ),
    array(
        'field' => 'confirmacion',
        'label' => 'Confirmar contraseña',
        'rules' => 'trim|required|max_length[150]|matches[contrasenia]'
    ),
);
$config["sol_sec_tema"] = array(
    array(
        'field' => 'tema[coleccion]',
        'label' => 'Colección',
        'rules' => 'requiered',
        'errors' => array(
            'requiered' => "El campo %s es obligatorio"
        )
    ),
    array(
        'field' => 'tema[no_coleccion]',
        'label' => 'No. de colección',
        'rules' => 'requiered',
        'errors' => array(
            'requiered' => "El campo %s es obligatorio"
        )
    ),
    array(
        'field' => 'tema[tipo_contenido]',
        'label' => 'Tipo de contenido',
        'rules' => 'greater_than[0]',
        'errors' => array(
            'greater_than' => "El campo %s es obligatorio"
        )
    ),
    array(
        'field' => 'tema[nombre_serie]',
        'label' => 'Colección',
        'rules' => 'requiered',
        'errors' => array(
            'greater_than' => "El campo %s es obligatorio"
        )
    ),
    $config["comentario_JUST"] = array(
    array(
        'field' => 'comentario_justificacion',
        'label' => 'observacion',
        'rules' => 'trim|required|max_length[150]|matches[contrasenia]'
    ),
    ),
);

