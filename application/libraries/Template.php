<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para la carga de la plantilla base del sistema y creación de la paginación
 * @version 	: 1.1.0
 * @author 		: Jesús Díaz P.
 * @author      : Miguel Guagnelli
 * @property    : mixed[] Data arreglo de datos de plantilla con la siguisnte estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
 **/
class Template {
	private $elements;


	public function __construct() {
    	$this->CI =& get_instance();
        $this->CI->load->helper('html');
        $this->elements = array(
        	"title"=>null,
        	"menu"=>null,
            "top_header"=>null,
            "main_header"=>null,
        	"main_title"=>null,
        	"main_content"=>null,
            "footer"=>null,
            "footer_menu"=>null,
            "css_files"=>null,
            "js_files"=> null,
            "css_script"=>null
        );
    }

    /*Retorna el atributo elements
    *@method: array getData()
    *@return: mixed[] Data arreglo de datos de plantilla con la siguiente estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
    */
    function getElements(){
    	return $this->elements;
    }

    /*regresa en pantalla el contenido de la plantilla
    *@method: array getData()
    *@return: mixed[] Data arreglo de datos de plantilla con la siguisnte estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
    */
    function getTemplate($tipo = FALSE){
	$this->elements['redes'] = $this->getElement('div[class=header-top]');
        $this->elements['encabezado'] = $this->getElement('div[class=main-header]');
        $this->elements['pie_ligas'] = $this->getElement('div[class=footer-links]');
        $this->elements['pie_derechos'] = $this->getElement('div[class=copyright]');
        $this->elements['menu'] = $this->getElement('nav[class=navbar]');
    	if($tipo){
    		$this->CI->load->view('template/home.tpl.php', $this->elements,TRUE);
    	}
    	$this->CI->load->view('template/home.tpl.php', $this->elements);

    }

    function getElement($elemento){
        return "";
        $this->CI->load->helper('simple_html_dom');
        // $url_site = $this->CI->config->item('url_site');
        $url_site = $this->CI->config->item('url_site_head_foot');
        
	
		$html = file_get_html($url_site.'creditos'); //Se obtiene HTML de página créditos, debido a que no contiene mucha información
        $htmlElemento = null;
        foreach($html->find($elemento) as $element){
            $htmlElemento = $element->outertext;
        }
        return $htmlElemento;
		/*$html = new DOMDocument();
		@$html->loadHTMLFile($url_site);
		//pr($html);
		//pr($html->getElementsByTagName($elemento));
		$journals = @get_inner_html($html->getElementsByTagName($elemento)); 
		//pr($journals);
		exit();*/
    }

    /**
     * Método que carga datos en la plantilla base del sistema
     * @author 		: Jesús Díaz P.
	 * @modified 	: Miguel Guagnelli
	 * @access 		: public
	 * @method:     : void 
	 * @param 		: mixed[] $elements Elementos configurables en la plantilla
     */
	public function setTemplate($elements=array()){
		$this->elements['title'] = (array_key_exists('title', $elements)) ? $elements['title'] : null;
		$this->elements['menu'] = (array_key_exists('menu', $elements)) ? $elements['menu'] : null;
		$this->elements['main_title'] = (array_key_exists('main_title', $elements)) ? $elements['main_title'] : null;
		$this->elements['main_content'] = (array_key_exists('main_content', $elements)) ? $elements['main_content'] : null;
		$this->elements['css_files'] = (array_key_exists('css_files', $elements)) ? $elements['css_files'] : null;
		$this->elements['js_files'] = (array_key_exists('js_files', $elements)) ? $elements['js_files'] : null;
		$this->elements['css_script'] = (array_key_exists('css_script', $elements)) ? $elements['css_script'] : null;
	}
        
    
        
    /**
     * Método que crea links de paginación y mensaje sobre registros mostrados
     * @autor 		: Jesús Díaz P.
	 * @modified 	: 
	 * @access 		: public
	 * @param 		: mixed[] $pagination_data Parámetros usados para generar las ligas
	 * @return 		: midex[] links -> Ligas para la paginación
	 *						total -> Mensaje sobre registros mostrados
     */
	function pagination_data($pagination_data){
		$this->CI->load->library(array('pagination', 'table')); 
		$config['base_url'] = site_url(array('revistas', 'listado')); //Path que se utilizará en la generación de los links
        //$config['base_url'] = 'javascript: data_ajax(\''.site_url('revistas/listado').'\', \'#form_revista\', \'#revistas_resultado\');';
		$config['total_rows'] = $pagination_data['total']; //Número total de registros
		$config['per_page'] = $pagination_data['per_page']; //Sobreescribir número de registros a mostrar
		$this->CI->pagination->initialize($config);
		
		return array('links'=>"<div class='dataTables_paginate paging_simple_numbers text-right'>".$this->CI->pagination->create_links()."</div>",
				'total'=>"Mostrando ".($pagination_data['current_row']+1)." a ".((($pagination_data['current_row']+$config['per_page'])>$pagination_data['total']) ? $pagination_data['total'] : $pagination_data['current_row']+$config['per_page'])." de ".$pagination_data['total']
			);
	}

	/*
    * Asigna valores a la propiedad Titulo de la plantilla
	* @author  : Miguel Guagnelli
	* @method  : void setTitle($title) 
	* @access  : public
	* @param   : string $title Es el título de la pestaña de la plantilla.
    */
    function setTitle($title = null){
    	$this->elements["title"] = $title;
    }

    /*
	* Asigna la propiedad de opciones de menú de la plantilla
	* @author  : Miguel Guagnelli
	* @method  : void setNav($nav)
	* @access  : public
	* @param   : mixed[] $nav Arreglo compuesto de n elementos con la sig estructura array("link"=>"","titulo"=>"","attribs"=>array())",
	*/
    function setNav($menu = null){
    	$this->elements["menu"] = $nav;
    }


    /*
    * Asigna la propiedad de título de la sección en la plantilla
    * @author  : Miguel Guagnelli
    * @method: void setMainTitle($main_title)
    * @param: string $main_title Titulo de la sección en la que se encuentra el usuario
    */
    function setMainTitle($main_title = null){
    	$this->elements["main_title"] = $main_title;
    }


    /*
    * Asigna la propiedad de contenido principal en la plantilla
    * @author  : Miguel Guagnelli
    * @method: void setMainContent($main_content)
    * @param: string $main_content Contenido principal de la plantill
    */
    function setMainContent($main_content = null){
    	$this->elements["main_content"] = $main_content;
    }


    /*
    * Asigna la propiedad de contenido principal en la plantilla
    * @author  : Miguel Guagnelli
    * @method: void setMainContent($main_content)
    * @param: string $main_content Contenido principal de la plantill
    */
    function setCSSFiles($main_content = null){
    	$this->elements["main_content"] = $main_content;
    }

     /**
     * Método que generación del menú
     * @author      : Pablo José
     * @modified    : Miguel Guagnelli
     * @access      : public
     * @method:     : string menu html del meú principal 
     * @deprecated  : 17 de junio de 2015
     * */

    public function templete_menu() { 
        /*$logeado = $this->CI->session->userdata('usuario_logeado');
        if($logeado === true){
            $menu_templete = $this->CI->load->view('template/menu_admin', null, TRUE);
            return $menu_templete;
        }else{
            $menu_templete = $this->CI->load->view('template/menu', null, TRUE);
            return $menu_templete;
        } */        
        trigger_error('Función descontinuada!', E_NOTICE);         
    }  
}
