<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['salt'] = "B0no5"; ///SALT
$config['modulos_no_sesion'] = array(
    'login' => array('index', 'cerrar_session', 'cerrar_session_ajax'),
    'pagina_no_encontrada' => array('index'),
    'recuperar_contrasenia' => array('*'),
    'captcha' => array('*')
);
$config['modulos_sesion_generales'] = array(
    'login' => array('cerrar_session', 'cerrar_session_ajax'),
    'dashboard' => array('*'),
    'perfil' => array('*'),
    'pagina_no_encontrada' => array('index')
);

//$config['route_base_files'] = 'C://Bitnami/wappstack5.5.27/apache2/htdocs/isbn/assets/js/uf/uploads/';
$config['route_base_files'] = $_SERVER['DOCUMENT_ROOT'] . '/isbn/assets/js/uf/uploads/';
/* $config['modulos_permisos'] = array(E_rol::SUPERADMINISTRADOR => array('solicitud' => array('*')), 
  E_rol::ADMINISTRADOR => array('solicitud' => array('*')),
  E_rol::DGAJ => array('solicitud' => array('*')),
  E_rol::ENTIDAD => array('solicitud' => array('*'))
  ); */
$config['modulos_permisos'] = array(
    E_rol::SUPERADMINISTRADOR =>
    array(
        'permisos' => array(
            'solicitud' => array('*'),
            'files' => array('*'),
            'catalogo' => array('*'),
            'reporte' => array('*'),
            "colaborador" => array('*')
        ),
        'menu' => array(
            'Solicitud' => array(
                'solicitud/index' => 'Solicitud',
                'solicitud/registrar' => 'Registrar'
            ),
            'reporte' => 'Reporte',
            'Catálogo' => array(
                'catalogo/barcode_size' => 'Barcode',
                'catalogo/ciudad' => 'Ciudad',
                'catalogo/categoria' => 'Categoría',
                'catalogo/departamento' => 'Departamento',
                'catalogo/descripcion_fisica' => 'Descripción física',
                'catalogo/encuadernacion' => 'Encuadernación',
                'catalogo/entidad' => 'Entidad',
                'catalogo/estado' => 'Estado',
                'catalogo/formato' => 'Formato',
                'catalogo/gramaje' => 'Gramaje',
                'catalogo/idioma' => 'Idioma',
                'catalogo/idioma_al' => 'Idioma al',
                'catalogo/idioma_del' => 'Idioma del',
                'catalogo/imagen_tamanio' => 'Imagen tamaño',
                'catalogo/impresion' => 'Impresión',
                'catalogo/medio' => 'Medio',
                'catalogo/subcategoria' => 'Subcategoría',
                'catalogo/subsistema' => 'Subsistema',
                'catalogo/tamanio' => 'Tamaño',
                'catalogo/tinta' => 'Tinta',
                'catalogo/tipo_contenido' => 'Tipo de contenido',
                'catalogo/tipo_papel' => 'Tipo de papel'
            )
        )
    ),
    E_rol::ADMINISTRADOR => array(
        'permisos' => array(
            'solicitud' => array('*'),
            "colaborador" => array('*'),
            'files' => array('*'),
            'catalogo' => array('*'),
            'reporte' => array('*')
        ),
        'menu' => array(
            'Solicitud' => array(
                'solicitud/index' => 'Solicitud',
                'solicitud/registrar' => 'Registrar'
            ),
            'reporte' => 'Reporte',
            'Catálogo' => array(
                'catalogo/barcode_size' => 'Barcode',
                'catalogo/ciudad' => 'Ciudad',
                'catalogo/categoria' => 'Categoría',
                'catalogo/departamento' => 'Departamento',
                'catalogo/descripcion_fisica' => 'Descripción física',
                'catalogo/encuadernacion' => 'Encuadernación',
                'catalogo/entidad' => 'Entidad',
                'catalogo/estado' => 'Estado',
                'catalogo/formato' => 'Formato',
                'catalogo/gramaje' => 'Gramaje',
                'catalogo/idioma' => 'Idioma',
                'catalogo/idioma_al' => 'Idioma al',
                'catalogo/idioma_del' => 'Idioma del',
                'catalogo/imagen_tamanio' => 'Imagen tamaño',
                'catalogo/impresion' => 'Impresión',
                'catalogo/medio' => 'Medio',
                'catalogo/subcategoria' => 'Subcategoría',
                'catalogo/subsistema' => 'Subsistema',
                'catalogo/tamanio' => 'Tamaño',
                'catalogo/tinta' => 'Tinta',
                'catalogo/tipo_contenido' => 'Tipo de contenido',
                'catalogo/tipo_papel' => 'Tipo de papel'
            )
        )
    ),
    E_rol::DGAJ => array(
        'permisos' => array(
            'solicitud' => array('*'),
            'files' => array('*'),
        ),
        'menu' => array(
            'solicitud/index' => 'Solicitud'
        )
    ),
    E_rol::ENTIDAD => array(
        'permisos' => array(
            'solicitud' => array('*'),
            'files' => array('*'),
            "colaborador" => array('*')
        ),
        'menu' => array(
            'dashboard' => 'Reportes',
            "solicitud/registrar" => "Nueva solicitud"
        )
    )
);

/////Ruta de solicitudes
//$config['ruta_documentacion'] = $_SERVER["DOCUMENT_ROOT"] . "/sipimss_bonos/assets/files/archivos_bono/";
//$config['ruta_documentacion_web'] = asset_url() . 'files/archivos_bono/'; //base_url()."assets/files/solicitudes/";

$config['tiempo_fuerza_bruta'] = 60 * 60; //3600 = 1 hora => Tiempo válido para chequeo de fuerza bruta

$config['intentos_fuerza_bruta'] = 10; ///Número de intentos válidos durante tiempo 'tiempo_fuerza_bruta'

$config['tiempo_recuperar_contrasenia'] = 60 * 60 * 24; //3600 * 24 = 86400 = 1 día => Límite de tiempo que estará activo el link

$config['meses'] = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

$config['rol_admin'] = array('SUPERADMIN' => array('id' => 1, 'text' => 'Super-admin'), 'ADMIN' => array('id' => 2, 'text' => 'Admin'), 'USUARIO' => array('id' => 3, 'text' => 'Usuario'));

$config['bon_pro_eva_min'] = (float) 80.00;

$config['bon_sum_act_min'] = 26;

$config['cestado_usuario'] = array('ACTIVO' => array('id' => 1), 'INACTIVO' => array('id' => 2), 'RESTABLECERCONTRASENIA' => array('id' => 3), 'RESTABLECERCMA' => array('id' => 4));

$config['catalogos_definidos'] = array(
    Enum_cg::c_barcode_size => array('id' => '', 'desc' => ''),
    Enum_cg::c_entidad => array('id' => 'id', 'desc' => 'name'),
    Enum_cg::c_estado => array('id' => 'id', 'desc' => 'name'),
    Enum_cg::c_subsistema => array('id' => 'id', 'desc' => 'name'),
    Enum_cg::c_categoria => array('id' => 'id', 'desc' => 'nombre'),
    Enum_cg::c_subcategoria => array('id' => 'id', 'desc' => 'nombre'),
);

$config['alert_msg'] = array(
    'SUCCESS' => array('id_msg' => 1, 'class' => 'success'),
    'DANGER' => array('id_msg' => 2, 'class' => 'danger'),
    'WARNING' => array('id_msg' => 3, 'class' => 'warning'),
    'INFO' => array('id_msg' => 4, 'class' => 'info')
);

$config['tipo_obra'] = array(
    'I' => 'Independiente',
    'C' => 'Completa',
    'V' => 'Volumen',
);
$config['tipo_colab'] = array(
    'A' => 'Autor',
    'C' => 'Coautor',
);

$config['tipo_busqueda'] = array(
    1 => array('id' => 1, 'desc' => 'ENTIDAD', 'rol_permite' => array(E_rol::DGAJ), 'nom_var' => 'entidad_id'),
    2 => array('id' => 2, 'desc' => 'SUBSISTEMA', 'rol_permite' => array(E_rol::DGAJ, E_rol::ENTIDAD), 'nom_var' => 'subsistema_cve'),
    3 => array('id' => 3, 'desc' => 'ESTADO', 'rol_permite' => array(E_rol::DGAJ, E_rol::ENTIDAD), 'nom_var' => 'estado_cve'),
    4 => array('id' => 4, 'desc' => 'SUBCATEGORIA', 'rol_permite' => array(E_rol::DGAJ, E_rol::ENTIDAD), 'nom_var' => 'subcategoria_cve')
);

$config['conf_secciones'] = array(
    En_secciones::TEMA => array('b' => 't', 'select' => array()),
    En_secciones::IDIOMA => array('b' => 'Ing', 'select' => array("*",
            "(select nombre from c_idioma where id=idioma) 'nam_idioma'")),
    En_secciones::COLABORADORES => array('b' => 'colab', 'select' => array()),
    En_secciones::TRADUCCION => array('b' => 'trns',
        'select' => array('*',
            "(select nombre from c_idioma where id=traduccion.idioma_del) 'ni_del'",
            "(select nombre from c_idioma where id=traduccion.idioma_original) 'ni_orig'",
            "(select nombre from c_idioma where id=traduccion.idioma_al) 'ni_al'")),
    En_secciones::INFO_EDICION => array('b' => 'ed', 'select' => array("*",
            "(select nombre from c_departamento where id = depto_id) 'nome_dpto'",
            "(select nombre from c_ciudad where id = ciudad_id) 'name_ciudad'")),
    En_secciones::COMERCIALIZACION => array('b' => 'cmrc', 'select' => array()),
    En_secciones::DESC_FISICA_ELECTRONICA => array('b' => 'dfe', 'select' => array()),
    En_secciones::DESC_FISICA_IMPRESA => array('b' => 'dfi', 'select' => array()),
    En_secciones::PAGO_ELECTRONICO => array('b' => 'epay', 'select' => array()),
    En_secciones::CODIGO_BARRAS => array('b' => 'bc', 'select' => array()),
);