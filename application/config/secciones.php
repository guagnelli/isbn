<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/*$config["cfg_solicitud"] = array (
	"fecha_solicitud"=>array(
		"label"=>"Fecha de solicitud",
		"value"=>"",
		"table"=>"solicitud",
		"field"=>"date_created",
	),
	"folio"=>array(
		"label"=>"Folio de la solicitud",
		"value"=>"",
		"table"=>"solicitud",
		"field"=>"folio",
	),
	"sol_tipo_obra"=>array(
		"label"=>"Tipo de obra",
		"value"=>"",
		"table"=>"solicitud",
		"field"=>"sol_tipo_obra",
	),
	"folio_coleccion"=>array(
		"label"=>"Folio de la colección completa a la que pertenece este volúmen",
		"value"=>"",
		"table"=>"solicitud",
		"field"=>"folio_coleccion",
	),
	
	"clasif_subcategoria"=>array(
		"label"=>"Sub-categoria",
		"value"=>"",
		"table"=>"c_subcategoria",
		"field"=>"nombre",
	),
	"tematica"=>array(
		"label"=>"Temática personal",
		"value"=>"",
		"table"=>"c_categoria",
		"field"=>"nombre",
	),
	"entidad"=>array(
		"label"=>"Entidad",
		"value"=>"",
		"table"=>"c_entidad",
		"field"=>"name",
	),
	"ent_subsistema"=>array(
		"label"=>"Subsistema",
		"value"=>"",
		"table"=>"c_subsistema",
		"field"=>"name",
	),
	"libro_titulo"=>array(
		"label"=>"Título de la obra",
		"value"=>"",
		"table"=>"libro",
		"field"=>"title",
	),
	"libro_subtitulo"=>array(
		"label"=>"Subtitulo",
		"value"=>"",
		"table"=>"libro",
		"field"=>"subtitulo",
	),
	"libro_isbn"=>array(
		"label"=>"ISBN",
		"value"=>"",
		"table"=>"libro",
		"field"=>"isbn",
	),
	"libro_resenia"=>array(
		"label"=>"Reseña",
		"value"=>"",
		"table"=>"libro",
		"field"=>"resenia",
	),
	"libro_folio_coleccion"=>array(
		"label"=>"Folio de la colección completa a la que pertenece este volúmen",
		"value"=>"",
		"table"=>"solicitud",
		"field"=>"folio_coleccion",
	),
	"tema_coleccion"=>array(
		"label"=>"Colección",
		"value"=>"",
		"table"=>"tema",
		"field"=>"coleccion",
	),
	"tema_no_coleccion"=>array(
		"label"=>"No. de colección",
		"value"=>"",
		"table"=>"tema",
		"field"=>"no_coleccion",
	),
	"tema_tipo_contenido"=>array(
		"label"=>"Tipo de contenido",
		"value"=>"",
		"table"=>"tema",
		"field"=>"tipo_contenido",
	),
	"tema_nombre_serie"=>array(
		"label"=>"Nombre de la serie",
		"value"=>"",
		"table"=>"tema",
		"field"=>"nombre_serie",
	),
	"idiomas" => array(
		"label"=>"Idioma",
		"value"=>"",
		"table"=>"c_idioma",
		"field"=>"nombre",
	),
	"colab_nombre"=>array(
		"label"=>"Nombre",
		"value"=>"",
		"table"=>"colaboradores",
		"field"=>"nombre",
	),
	"colab_paterno"=>array(
		"label"=>"Apellido paterno",
		"value"=>"",
		"table"=>"colaboradores",
		"field"=>"paterno",
	),
	"colab_materno"=>array(
		"label"=>"Apellido materno",
		"value"=>"",
		"table"=>"colaboradores",
		"field"=>"materno",
	),
	"colab_nacionalidad"=>array(
		"label"=>"Nacionalidad",
		"value"=>"",
		"table"=>"c_nacionalidad",
		"field"=>"nombre",
	),
	"colab_rol"=>array(
		"label"=>"Rol",
		"value"=>"",
		"table"=>"c_tipo_colab",
		"field"=>"nombre",
	),
	"colab_seudonimo"=>array(
		"label"=>"Seudónimo",
		"value"=>"",
		"table"=>"colaboradores",
		"field"=>"seudonimo",
	),
	"colab_mail"=>array(
		"label"=>"Correo electrónico",
		"value"=>"",
		"table"=>"colaboradores",
		"field"=>"email",
	),
	"trad_titulo_original"=>array(
		"label"=>"Título en el idioma original",
		"value"=>"",
		"table"=>"traduccion",
		"field"=>"titulo_original",
	),
	"trad_idioma_del"=>array(
		"label"=>"Idioma Del",
		"value"=>"",
		"table"=>"traduccion",
		"field"=>"idioma_del",
	),
	"trad_idioma_al"=>array(
		"label"=>"Idioma Al",
		"value"=>"",
		"table"=>"traduccion",
		"field"=>"idioma_al",
	),
	"trad_idioma_original"=>array(
		"label"=>"Idioma Original",
		"value"=>"",
		"table"=>"traduccion",
		"field"=>"idioma_original",
	),
	"edi_no_edicion"=>array(
		"label"=>"No. de edición",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"no_edicion",
	),
	"edi_fecha_aparicion"=>array(
		"label"=>"Fecha de aparición",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"fecha_aparicion",
	),
	"edi_estado"=>array(
		"label"=>"Estado",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"depto_id",
	),
	"edi_ciudad"=>array(
		"label"=>"Ciudad de edición",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"ciudad_id",
	),
	"edi_coedicion"=>array(
		"label"=>"Coedición",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"coedicion",
	),
	"edi_coeditor"=>array(
		"label"=>"Coeditor",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"coeditor",
	),
	"edi_radicado"=>array(
		"label"=>"Radicado",
		"value"=>"",
		"table"=>"edicion",
		"field"=>"radicado",
	),
	"comer_ej_nacional"=>array(
		"label"=>"Ejemplares nacionales",
		"value"=>"",
		"table"=>"comercializable",
		"field"=>"ejemplares_nacional",
	),
	"comer_p_local"=>array(
		"label"=>"Precio local",
		"value"=>"",
		"table"=>"comercializable",
		"field"=>"precio_local",
	),
	"comer_ej_externa"=>array(
		"label"=>"Ejemplares externos",
		"value"=>"",
		"table"=>"comercializable",
		"field"=>"ejemplares_externa",
	),
	"comer_p_externo"=>array(
		"label"=>"Precios externos",
		"value"=>"",
		"table"=>"comercializable",
		"field"=>"precio_externo",
	),
	"comer_of_local"=>array(
		"label"=>"Oferta total",
		"value"=>"",
		"table"=>"comercializable",
		"field"=>"oferta_local",
	),
);*/
$config["cfg_solicitud"] = array (
	"solicitud"=>array(
		"label"=>"Información de la solicitud",
		"table"=>"v_solicitud",
	),
	"tematica"=>array(
		"label"=>"Temática",
		"table"=>"tema",
	),
	"idioma"=>array(
		"label"=>"Idiomas",
		"table"=>"sol_idioma",
	),
	"colab"=>array(
		"label"=>"Colaboradores",
		"table"=>"colaboradores",
	),
	"translate"=>array(
		"label"=>"Traducción",
		"table"=>"traduccion",
	),
	"edit"=>array(
		"label"=>"Información de edición",
		"table"=>"edicion",
	),
	"comerce"=>array(
		"label"=>"Comercialización",
		"table"=>"comercializable",
	),
	"desc"=>array(
		"label"=>"Colaboradores",
		"table"=>"colaboradores",
	),
);