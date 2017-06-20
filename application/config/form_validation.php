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
        'field' => 'title',
        'label' => 'Título de la obra',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => "sol_tipo_obra",
        'label' => 'Tipo de obra',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => "resenia",
        'label' => 'Reseña',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => "solicitud_categoria",
        'label' => 'Temática principal',
        'rules' => 'required|greater_than[0]',
        'errors' => array(
            'required' => "El campo %s es obligatorio",
            'greater_than' => "El campo %s es obligatorio",
        )
    ),
    array(
        'field' => "id_subcategoria",
        'label' => 'Sub categoría',
        'rules' => 'required|greater_than[0]',
        'errors' => array(
            'required' => "El campo %s es obligatorio",
            'greater_than' => "El campo %s es obligatorio",
        )
    ),
    
);
$config["sol_folio"] = array(
        'field' => "folio_coleccion",
        'label' => 'Tipo de obra',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
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
        'rules' => 'trim|required|max_length[40]|valida_correo_electronico'
    )
);
$config["sol_sec_tema"] = array(
    /*array(
        'field' => 'coleccion',
        'label' => 'Colección',
        'rules' => '',
        'errors' => array(
            '' => "El campo %s es obligatorio"
        )
    ),*/
    array(
        'field' => 'no_coleccion',
        'label' => 'No. de colección',
        'rules' => 'numeric|min_length[10]|max_length[13]',
        'errors' => array(
            'numeric' => "El %s debe ser numérico",
            'min_length' => "El %s debe tener por lo menos 10 y máximo 13 dígitos",
            'max_length' => "El %s debe tener por lo menos 10 y máximo 13 dígitos"
        )
    ),
    array(
        'field' => 'tipo_contenido',
        'label' => 'Tipo de contenido',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => 'nombre_serie',
        'label' => 'Nombre de la serie',
        //'rules' => '',
        /*'errors' => array(
            //'required' => "El campo %s es obligatorio"
        )*/
    )
);
$config['sec_sol_idioma'] = array(
    array(
        'field' => 'drop_idiomas',
        'label' => 'Idioma',
        'rules' => 'required',
        'errors' => array(
            'required' => "El campo %s es obligatorio"
        )
    )
);
$config['sec_colaboradores'] = array(
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => 'paterno',
        'label' => 'Paterno',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => 'tipo',
        'label' => 'Rol',
        'rules' => 'required|greater_than[0]',
        'errors' => array(
            'required' => "El campo %s es obligatorio",
            'greater_than' => "El campo %s es obligatorio",
        )
    ),
    array(
        'field' => 'nacionalidad',
        'label' => 'Nacionalidad',
        'rules' => 'required|greater_than[0]',
        'errors' => array(
            'required' => "El campo %s es obligatorio",
            'greater_than' => "El campo %s es obligatorio",
        )
    ),
    array(
        'field' => 'email',
        'label' => 'Correo electrónico',
        'rules' => 'required|valida_correo_electronico',
        'errors' => array(
            'required' => "El campo %s es obligatorio",
            'valida_correo_electronico' => "El %s debe ser valido"
        )
    )
);
$config['sec_traduccion'] = array(
    array(
        'field' => 'idioma_del',
        'label' => 'Idioma del',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => 'idioma_al',
        'label' => 'Idioma al',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => 'idioma_original',
        'label' => 'Idioma original',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
    array(
        'field' => 'titulo_original',
        'label' => 'Título en el idioma original',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
    ),
);
$config['sec_edicion'] = array(
    "normal"=>array(
        array(
            'field' => 'no_edicion',
            'label' => 'No. edición',
            'rules' => 'required|integer',
            /*'errors' => array(
                'required' => "El campo %s es obligatorio"
            )*/
        ),
        array(
            'field' => 'depto_id',
            'label' => 'Departamento, provincia o estado',
            'rules' => 'required',
            /*'errors' => array(
                'required' => "El campo %s es obligatorio"
            )*/
        ),
        array(
            'field' => 'ciudad_id',
            'label' => 'Ciudad de edición',
            'rules' => 'required',
            /*'errors' => array(
                'required' => "El campo %s es obligatorio"
            )*/
        ),
        array(
            'field' => 'fecha_aparicion',
            'label' => 'Fecha de aparición',
            'rules' => 'required',
            /*'errors' => array(
                'required' => "El campo %s es obligatorio"
            )*/
        ),
    ),
    "coedicion"=>array(
        array(
        'field' => 'coeditor',
        'label' => 'Coeditor',
        'rules' => 'required',
        /*'errors' => array(
            'required' => "El campo %s es obligatorio"
        )*/
        ),
        array(
            'field' => 'radicado',
            'label' => 'No. de radicado de la coedición',
            'rules' => 'required|integer',
            /*'errors' => array(
                'required' => "El campo %s es obligatorio"
            )*/
        ),
    )  
);
$config["sec_comercializable"] = array(
    array(
        'field' => 'ejemplares_nacional',
        'label' => 'Ejemplares nacionales',
        'rules' => 'is_natural_no_zero'
    ),
    array(
        'field' => 'precio_local',
        'label' => 'Precio local',
        'rules' => 'numeric'
    ),
    array(
        'field' => 'ejemplares_externa',
        'label' => 'Ejemplares externo',
        'rules' => 'is_natural_no_zero'
    ),
    array(
        'field' => 'precio_externo',
        'label' => 'Precio externo',
        'rules' => 'numeric'
    ),
    array(
        'field' => 'oferta_total',
        'label' => 'Oferta total',
        'rules' => 'numeric'
    ),
);
$config["sec__descripcion_fisica_impresa"] = array(
    /*array(
        'field' => 'rad_df',
        'label' => 'Tipo de descripción física',
        'rules' => 'required'
    ),*/
    array(
        'field' => 'desc_fisica',
        'label' => 'Descripción física',
        'rules' => 'required'
    ),
    array(
        'field' => 'encuadernacion',
        'label' => 'Encuadernación',
        'rules' => 'required'
    ),
    array(
        'field' => 'gramaje',
        'label' => 'Gramaje',
        'rules' => 'required'
    ),
    array(
        'field' => 'impresion',
        'label' => 'Tipo de impresión',
        'rules' => 'required'
    ),
    array(
        'field' => 'tipo_papel',
        'label' => 'Tipo de papel',
        'rules' => 'required'
    ),
    array(
        'field' => 'no_paginas',
        'label' => 'Número de páginas',
        'rules' => 'required|numeric'
    ),
    array(
        'field' => 'num_tintas',
        'label' => 'Número de tintas',
        'rules' => 'required'
    ),
    array(
        'field' => 'ancho',
        'label' => 'Ancho',
        'rules' => 'required|numeric'
    ),
    array(
        'field' => 'alto',
        'label' => 'Alto',
        'rules' => 'required|numeric'
    )
);
$config["sec__descripcion_fisica_electronica"] = array(
    array(
        'field' => 'formato',
        'label' => 'Formato',
        'rules' => 'required'
    ),
    array(
        'field' => 'medio',
        'label' => 'Medio',
        'rules' => 'required'
    ),
    /*array(
        'field' => 'url',
        'label' => 'URL',
        'rules' => 'required'
    ),*/
    array(
        'field' => 'tamanio_desc',
        'label' => 'Tamaño',
        'rules' => 'required|numeric'
    ),
    array(
        'field' => 'tamanio',
        'label' => 'Tamaño',
        'rules' => 'required'
    ),
);
$config["sec_epay"] = array(
    array(
        'field' => 'pay_hash',
        'label' => 'Clave de pago',
        'rules' => 'required|numeric'
    ),
    array(
        'field' => 'cadena_dependencia',
        'label' => 'cadena_dependencia',
        'rules' => 'required|alpha_numeric'
    ),
    array(
        'field' => 'cadena_referencia',
        'label' => 'cadena_referencia',
        'rules' => 'required|alpha_numeric'
    ),
    array(
        'field' => 'no_operacion',
        'label' => 'Número de operación',
        'rules' => 'required|numeric'
    )
);
$config["sec_archivo"] = array(
    array(
        'field' => 'nombre',
        'label' => 'Nombre del archivo',
        'rules' => 'required|alpha_numeric_spaces'
    ),

    array(
        'field' => 'file_type',
        'label' => 'Tipo',
        'rules' => 'required'
    ),
);
$config["comentario_jus"] = array(
);

