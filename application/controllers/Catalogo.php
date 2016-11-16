<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene la gestion de catalogos
 * @version 	: 1.0.0
 * @author      : Hilda. Pilar Trejo Zea
 * */
class Catalogo extends MY_Controller {
    function __construct() {
        parent::__construct();
        /*$this->lang->load('interface_administracion');
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Adminstracion_catalogos_model','adm_catmod');*/
        $this->load->model('Catalogos_generales');
    }

    public function index() {
        /*$this->load->library('Enum_cg');
        $refl = new ReflectionClass('Enum_cg');
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        pr($refl->getConstants());*/

        /*$main_content = null;
        $datos = array();
        $datos['string_values'] = $this->lang->line('interface_administracion')['usuario']; //Cargar textos utilizados en vista

        //$entidades_ = array(enum_ecg::cdelegacion, enum_ecg::cdepartamento, enum_ecg::ccategoria);
        $entidades_ = array(enum_ecg::cdelegacion, enum_ecg::crol, enum_ecg::cestado_usuario);
        $datos['catalogos'] = carga_catalogos_generales($entidades_, null, null);
    
        $datos['order_columns'] = array('USU_MATRICULA'=>$datos['string_values']['buscador']['tab_head_matricula'], 'USU_PATERNO'=>$datos['string_values']['buscador']['tab_head_nombre'], 'nom_delegacion'=>$datos['string_values']['buscador']['tab_head_delegacion'], 'dep_nombre'=>$datos['string_values']['buscador']['tab_head_adscripcion'], 'EDO_USUARIO_DESC'=>$datos['string_values']['buscador']['tab_head_estado']);
        $main_content = $this->load->view('administracion/usuario/buscador_listado', $datos, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();*/
    }

    //bono_cestado_bono

    public function barcode_size(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_barcode_size')
            ->set_subject('Barcode size')
            ->columns('id','nombre')
            ->display_as('nombre','Barcode size');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function categoria(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_categoria')
            ->set_subject('Categoría')
            ->columns('id','nombre')
            ->display_as('nombre','Categoría');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function ciudad(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_ciudad')
            ->set_subject('Ciudad')
            ->columns('id','nombre')
            ->display_as('nombre','Ciudad');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function departamento(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_departamento')
            ->set_subject('Departamento')
            ->columns('id','nombre')
            ->display_as('nombre','Departamento');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function descripcion_fisica(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_desc_fisica')
            ->set_subject('Descripción física')
            ->columns('id','nombre')
            ->display_as('nombre','Descripción física');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function encuadernacion(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_encuadernacion')
            ->set_subject('Encuadernación')
            ->columns('id','nombre')
            ->display_as('nombre','Encuadernación');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function entidad(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_entidad')
            ->set_subject('Entidad')
            ->columns('id','name', 'code', 'subsistema_id')
            ->display_as('name','Entidad')
            ->display_as('code','Código')
            ->display_as('subsistema_id','Subsistema');
        
        $crud->edit_fields('name', 'code', 'subsistema_id');
        $crud->required_fields('nombre');

        $crud->set_relation('subsistema_id','c_subsistema','name');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function estado(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_estado')
            ->set_subject('Estado')
            ->columns('id', 'name','description')
            ->display_as('name','Nombre')
            ->display_as('description','Descripción');
        
        $crud->edit_fields('name','description');
        $crud->required_fields('name');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function formato(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_formato')
            ->set_subject('Formato')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function gramaje(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_gramaje')
            ->set_subject('Gramaje')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function idioma(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_idioma')
            ->set_subject('Idioma')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function idioma_al(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_idioma_al')
            ->set_subject('Idioma al')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function idioma_del(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_idioma_del')
            ->set_subject('Idioma del')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function imagen_tamanio(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_img_size')
            ->set_subject('Tamaño de imagen')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function impresion(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_impresion')
            ->set_subject('Impresión')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function medio(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_medio')
            ->set_subject('Medio')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function subcategoria(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_subcategoria')
            ->set_subject('Subcategoría')
            ->columns('id','nombre', 'id_categoria')
            ->display_as('nombre','Nombre')
            ->display_as('id_categoria','Categoría');
        
        $crud->edit_fields('nombre', 'id_categoria');
        $crud->required_fields('nombre', 'id_categoria');

        $crud->set_relation('id_categoria','c_categoria','nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function subsistema(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_subsistema')
            ->set_subject('Subsistema')
            ->columns('id','name')
            ->display_as('name','Nombre');
        
        $crud->edit_fields('name');
        $crud->required_fields('name');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function tamanio(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_tamanio')
            ->set_subject('Tamaño')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function tinta(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_tinta')
            ->set_subject('Tinta')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function tipo_contenido(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_tipo_contenido')
            ->set_subject('Tipo de contenido')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function tipo_papel(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('c_tipo_papel')
            ->set_subject('Tipo de papel')
            ->columns('id','nombre')
            ->display_as('nombre','Nombre');
        
        $crud->edit_fields('nombre');
        $crud->required_fields('nombre');

        //$crud->callback_edit_field('nombre',array($this,'edit_est_estado_nombre'));
        $crud->unset_delete(); //Remover la acción borrar
        //$crud->unset_add();
        
        $main_content = $crud->render();
        $this->template->setMainContent($this->load->view('catalogo/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    /*function edit_est_estado_nombre($value, $primary_key)
    {
    return $value;
    }

    //bono_ctipo_evaluacion

    public function tipo_evaluacion(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('bono_ctipo_evaluacion')
            ->set_subject('Tipo de evaluación')
            ->columns('tipo_eva_cve','tipo_eva_nombre', 'id_regla_evaluacion')
            ->display_as('tipo_eva_cve','#')
            ->display_as('tipo_eva_nombre','Descripción')
            ->display_as('id_regla_evaluacion','Regla evaluación encuestas');
        
        $crud->edit_fields('tipo_eva_nombre', 'id_regla_evaluacion');
        $crud->required_fields('tipo_eva_nombre', 'id_regla_evaluacion');

        $data_reglas_evaluacion = $this->adm_catmod->get_reglas_evaluacion();
        //pr($data_reglas_evaluacion);
        $crud->field_type('id_regla_evaluacion','dropdown', $data_reglas_evaluacion);



        $crud->unset_delete(); //Remover la acción borrar
        
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //carea
    public function area(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('carea')
            ->set_subject('Area')
            ->columns('AREA_CVE', 'AREA_NOMBRE')
            ->display_as('AREA_CVE','#')
            ->display_as('AREA_NOMBRE','Nombre');
        
        $crud->fields('AREA_NOMBRE');
        $crud->required_fields('AREA_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    } 

    //beca interrumpida

    public function beca_interrumpida(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cbeca_interrumpida')
            ->set_subject('Beca interrumpida')
            ->columns('BECA_INTERRIMPIDA_CVE', 'MSG_BEC_INTE')
            ->display_as('BECA_INTERRIMPIDA_CVE','#')
            ->display_as('MSG_BEC_INTE','Descripción');
        
        $crud->fields('MSG_BEC_INTE');
        $crud->required_fields('MSG_BEC_INTE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //ccatalogo_modulo

    public function cat_modulo(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('ccatalogo_modulo')
            ->set_subject('Módulo')
            ->columns('MODULO_CVE', 'MOD_NOMBRE')
            ->display_as('MODULO_CVE','#')
            ->display_as('MOD_NOMBRE','Descripción');
        
        $crud->fields('MOD_NOMBRE');
        $crud->required_fields('MOD_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //ccategoria
    public function categoria(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('ccategoria')
            ->set_subject('Categoría')
            ->columns('id_cat', 'nom_categoria','des_clave','cve_tipo_categoria')
            ->display_as('id_cat','#')
            ->display_as('nom_categoria','Descripción')
            ->display_as('des_clave','Clave')
            ->display_as('nom_tipo_cat','Clave tipo')
            ->display_as('cve_tipo_categoria','Tipo categoría');
        
        $crud->fields('nom_categoria','des_clave','cve_tipo_categoria');
        $crud->required_fields('nom_categoria','des_clave','cve_tipo_categoria');

        //$crud->unset_delete(); //Remover la acción borrar
        $crud->order_by('id_cat','asc');

        $crud->field_type('id_cat', 'hidden');

        $nom_tipo_cat = $this->adm_catmod->get_tipo_cat();
        //pr($data_reglas_evaluacion);
        $crud->field_type('cve_tipo_categoria','dropdown', $nom_tipo_cat);



        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //ccategoria_dictamen

    public function cat_dictamen(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('ccategoria_dictamen')
            ->set_subject('Categoría dictamen')
            ->columns('CATEGORIA_CVE', 'CAT_NOMBRE')
            ->display_as('CATEGORIA_CVE','#')
            ->display_as('CAT_NOMBRE','Descripción');
        
        $crud->fields('CAT_NOMBRE');
        $crud->required_fields('CAT_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

       //cclase_beca

    public function clase_beca(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cclase_beca')
            ->set_subject('Clase beca')
            ->columns('CLA_BECA_CVE', 'CLA_BEC_NOMBRE')
            ->display_as('CLA_BECA_CVE','#')
            ->display_as('CLA_BEC_NOMBRE','Descripción');
        
        $crud->fields('CLA_BEC_NOMBRE');
        $crud->required_fields('CLA_BEC_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


       //cejercicio_predominante

    public function ejer_pred(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cejercicio_predominante')
            ->set_subject('Ejercicio predominante')
            ->columns('EJER_PREDOMI_CVE', 'EJE_PRE_NOMBRE')
            ->display_as('EJER_PREDOMI_CVE','#')
            ->display_as('EJE_PRE_NOMBRE','Descripción');
        
        $crud->fields('EJE_PRE_NOMBRE');
        $crud->required_fields('EJE_PRE_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //cejercicio_profesional

    public function ejer_prof(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cejercicio_profesional')
            ->set_subject('Ejercicio profesional')
            ->columns('EJE_PRO_CVE', 'EJE_PRO_NOMBRE')
            ->display_as('EJE_PRO_CVE','#')
            ->display_as('EJE_PRO_NOMBRE','Descripción');
        
        $crud->fields('EJE_PRO_NOMBRE');
        $crud->required_fields('EJE_PRO_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //cestado_CIVIL

    public function est_civil(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_civil')
            ->set_subject('Estado civil')
            ->columns('CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE')
            ->display_as('CESTADO_CIVIL_CVE','#')
            ->display_as('EDO_CIV_NOMBRE','Descripción');
        
        $crud->fields('EDO_CIV_NOMBRE');
        $crud->required_fields('EDO_CIV_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

   //cestado_dictamen

    public function est_dictamen(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_dictamen')
            ->set_subject('Estado dictamen')
            ->columns('ESTADO_DICTAMEN_CVE', 'EST_DIC_NOMBRE')
            ->display_as('ESTADO_DICTAMEN_CVE','#')
            ->display_as('EST_DIC_NOMBRE','Descripción');
        
        $crud->fields('EST_DIC_NOMBRE');
        $crud->required_fields('EST_DIC_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //cestado_evaluacion

    public function est_eva(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_evaluacion')
            ->set_subject('Estado evaluación')
            ->columns('EST_EVALUACION_CVE', 'EST_EVA_NOMBRE')
            ->display_as('EST_EVALUACION_CVE','#')
            ->display_as('EST_EVA_NOMBRE','Descripción');
        
        $crud->fields('EST_EVA_NOMBRE');
        $crud->required_fields('EST_EVA_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }
    

    //cestado_LABORAL   

    public function est_laboral(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_laboral')
            ->set_subject('Estado laboral')
            ->columns('EDO_LABORAL_CVE', 'EDO_LAB_NOMBRE')
            ->display_as('EDO_LABORAL_CVE','#')
            ->display_as('EDO_LAB_NOMBRE','Descripción');
        
        $crud->fields('EDO_LAB_NOMBRE');
        $crud->required_fields('EDO_LAB_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }




    //cestado_SOLICITUD_EVALUACION   

    public function est_soleva(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_solicitud_evauacion')
            ->set_subject('Estado solicitud evaluación')
            ->columns('CESE_CVE', 'CESE_NOMBRE')
            ->display_as('CESE_CVE','#')
            ->display_as('CESE_NOMBRE','Descripción');
        
        $crud->fields('CESE_NOMBRE');
        $crud->required_fields('CESE_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //cestado_usuario   

    public function est_user(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_usuario')
            ->set_subject('Estado usuario')
            ->columns('ESTADO_USUARIO_CVE', 'EDO_USUARIO_DESC')
            ->display_as('ESTADO_USUARIO_CVE','#')
            ->display_as('EDO_USUARIO_DESC','Descripción');
        
        $crud->fields('EDO_USUARIO_DESC');
        $crud->required_fields('EDO_USUARIO_DESC');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }




    //cestado_validacion   

    public function est_val(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cestado_validacion')
            ->set_subject('Estado validación')
            ->columns('EST_VALIDACION_CVE', 'EST_VALIDA_DESC')
            ->display_as('EST_VALIDACION_CVE','#')
            ->display_as('EST_VALIDA_DESC','Descripción');
        
        $crud->fields('EST_VALIDA_DESC');
        $crud->required_fields('EST_VALIDA_DESC');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //cinstitucion_avala   

    public function inst_aval(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cinstitucion_avala')
            ->set_subject('Institución que avala')
            ->columns('INS_AVALA_CVE', 'IA_NOMBRE','IA_TIPO')
            ->display_as('INS_AVALA_CVE','#')
            ->display_as('IA_NOMBRE','Descripción')
            ->display_as('IA_TIPO','Tipo de Institución');
        
        $crud->fields('IA_NOMBRE','IA_TIPO');
        $crud->required_fields('IA_NOMBRE','IA_TIPO');

        //$crud->unset_delete(); //Remover la acción borrar

        $tipo_ins = array('A'=>'AVALA','I'=>'IMPARTE');
        $crud->field_type('IA_TIPO','dropdown', $tipo_ins);
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


       //cMATERIA  

    public function materia(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmateria')
            ->set_subject('Materia')
            ->columns('MATERIA_CVE', 'MATERIA_NOMBRE')
            ->display_as('MATERIA_CVE','#')
            ->display_as('MATERIA_NOMBRE','Descripción');
        
        $crud->fields('MATERIA_NOMBRE');
        $crud->required_fields('MATERIA_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


       //cMATERIAl

    public function material(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmaterial')
            ->set_subject('Material')
            ->columns('TIP_MATERIAL_CVE', 'TIP_MAT_NOMBRE')
            ->display_as('TIP_MATERIAL_CVE','#')
            ->display_as('TIP_MAT_NOMBRE','Descripción');
        
        $crud->fields('TIP_MAT_NOMBRE');
        $crud->required_fields('TIP_MAT_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


      //cMEDIO_DIVULGACION

    public function mdivulgacion(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmedio_divulgacion')
            ->set_subject('Medio divulgación')
            ->columns('MED_DIVULGACION_CVE', 'MED_DIV_NOMBRE','is_reconocido','tp_f_r_l')
            ->display_as('MED_DIVULGACION_CVE','#')
            ->display_as('MED_DIV_NOMBRE','Descripción')
            ->display_as('is_reconocido','¿ Es reconocido ?')
            ->display_as('tp_f_r_l','Tipo');
        
        $crud->fields('MED_DIV_NOMBRE','is_reconocido','tp_f_r_l');
        $crud->required_fields('MED_DIV_NOMBRE','is_reconocido','tp_f_r_l');

        //$crud->unset_delete(); //Remover la acción borrar


        $crud->change_field_type('is_reconocido','true_false',array(0=>'No',1=>'Si'));

        $tipo = array('f'=>'Foro','r'=>'Revista','l'=>'Libro');
        $crud->field_type('tp_f_r_l','dropdown', $tipo);
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


       //cmodalidad

    public function modalidad(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmodalidad')
            ->set_subject('Modalidad')
            ->columns('MODALIDAD_CVE', 'MOD_NOMBRE')
            ->display_as('MODALIDAD_CVE','#')
            ->display_as('MOD_NOMBRE','Descripción');
        
        $crud->fields('MOD_NOMBRE');
        $crud->required_fields('MOD_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //cmodulos sistema

    public function modulosis(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmodulo')
            ->set_subject('Módulo')
            ->columns('MODULO_CVE', 'MODULO_NOMBRE')
            ->display_as('MODULO_CVE','#')
            ->display_as('MODULO_NOMBRE','Descripción');
        
        $crud->fields('MODULO_NOMBRE');
        $crud->required_fields('MODULO_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

   //cmodulo_estado

    public function moduloestado(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmodulo_estado')
            ->set_subject('Estados módulo')
            ->columns('MOD_EST_CVE', 'MOD_EST_NOMBRE')
            ->display_as('MOD_EST_CVE','#')
            ->display_as('MOD_EST_NOMBRE','Descripción');
        
        $crud->fields('MOD_EST_NOMBRE');
        $crud->required_fields('MOD_EST_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //cmotivo_becado

    public function motivobeca(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cmotivo_becado')
            ->set_subject('Motivo de beca')
            ->columns('MOTIVO_BECADO_CVE', 'MOT_BEC_NOMBRE')
            ->display_as('MOTIVO_BECADO_CVE','#')
            ->display_as('MOT_BEC_NOMBRE','Descripción');
        
        $crud->fields('MOT_BEC_NOMBRE');
        $crud->required_fields('MOT_BEC_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //cmotivo_becado

    public function nivelacademico(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cnivel_academico')
            ->set_subject('Nivel académico')
            ->columns('NIV_ACADEMICO_CVE', 'NIV_ACA_NOMBRE')
            ->display_as('NIV_ACADEMICO_CVE','#')
            ->display_as('NIV_ACA_NOMBRE','Descripción');
        
        $crud->fields('NIV_ACA_NOMBRE');
        $crud->required_fields('NIV_ACA_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //cparametros

    public function parametros(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('cnivel_academico')
            ->set_subject('Nivel académico')
            ->columns('NIV_ACADEMICO_CVE', 'NIV_ACA_NOMBRE')
            ->display_as('NIV_ACADEMICO_CVE','#')
            ->display_as('NIV_ACA_NOMBRE','Descripción');
        
        $crud->fields('NIV_ACA_NOMBRE');
        $crud->required_fields('NIV_ACA_NOMBRE');

        //$crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


   //crole
    public function rol(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('crol')
            ->set_subject('Roles')
            ->columns('ROL_CVE', 'ROL_NOMBRE','PROYECTO_CVE')
            ->display_as('ROL_CVE','#')
            ->display_as('ROL_NOMBRE','Rol')
            ->display_as('PROYECTO_CVE','Proyecto');
        
        $crud->fields('ROL_NOMBRE','PROYECTO_CVE');
        $crud->required_fields('ROL_NOMBRE','PROYECTO_CVE');

        $proyecto = $this->adm_catmod->get_proyecto();
        $crud->field_type('PROYECTO_CVE','dropdown', $proyecto);

        $crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //crole_area
    public function rolarea(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('crol_area')
            ->set_subject('Roles por área')
            ->columns('ROL_AREA_CVE','ROL_DESEMPENIA_CVE', 'ROL_AREA_DESC')
            ->display_as('ROL_AREA_CVE','#')
            ->display_as('ROL_DESEMPENIA_CVE','ROL QUE DESEMPEÑA EN EL ÁREA')
            ->display_as('ROL_AREA_DESC','NOMBRE DEL ÁREA');
        
        $crud->fields('ROL_DESEMPENIA_CVE', 'ROL_AREA_DESC');
        $crud->required_fields('ROL_DESEMPENIA_CVE', 'ROL_AREA_DESC');

        $crud->unset_delete(); //Remover la acción borrar
        
        $get_rol_desempenia = $this->adm_catmod->get_rol_desempenia();
        $crud->field_type('ROL_DESEMPENIA_CVE','dropdown', $get_rol_desempenia);



        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }


    //crole_desempeña
    public function roldesemp(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('crol_desempenia')
             ->set_subject('Roles que desempeña')
            ->columns('ROL_DESEMPENIA_CVE', 'ROL_DESEMPENIA','ROL_MDL_CVE')
            ->display_as('ROL_DESEMPENIA_CVE','#')
            ->display_as('ROL_DESEMPENIA','ROL QUE DESEMPEÑA')
            ->display_as('ROL_MDL_CVE','ROL MOODLE');
        
        $crud->fields('ROL_DESEMPENIA', 'ROL_MDL_CVE');
        $crud->required_fields('ROL_DESEMPENIA', 'ROL_MDL_CVE');

        $crud->unset_delete(); //Remover la acción borrar
        
        $get_rol_moodle = $this->adm_catmod->get_rol_moodle();
        $crud->field_type('ROL_MDL_CVE','dropdown', $get_rol_moodle);



        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    //crole_evaluador
    public function roleva(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('crol_desempenia')
             ->set_subject('Roles que desempeña')
            ->columns('ROL_DESEMPENIA_CVE', 'ROL_DESEMPENIA','ROL_MDL_CVE')
            ->display_as('ROL_DESEMPENIA_CVE','#')
            ->display_as('ROL_DESEMPENIA','ROL QUE DESEMPEÑA')
            ->display_as('ROL_MDL_CVE','ROL MOODLE');
        
        $crud->fields('ROL_DESEMPENIA', 'ROL_MDL_CVE');
        $crud->required_fields('ROL_DESEMPENIA', 'ROL_MDL_CVE');

        $crud->unset_delete(); //Remover la acción borrar
        
        $get_rol_moodle = $this->adm_catmod->get_rol_moodle();
        $crud->field_type('ROL_MDL_CVE','dropdown', $get_rol_moodle);



        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }




    public function modulo(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('modulo')
            ->set_subject('Modulos')
            ->columns('MODULO_CVE', 'MODULO_CVE_PADRE', 'MOD_NOMBRE', 'MOD_RUTA', 'MOD_EST_CVE', 'IS_CONTROLADOR')
            ->display_as('MODULO_CVE', 'Identificador del modulo')
            ->display_as('MOD_NOMBRE', 'Módulo')
            ->display_as('MOD_RUTA', 'Ruta')
            ->display_as('MOD_EST_CVE', 'Estado')
            ->display_as('IS_CONTROLADOR', 'Es controlador')
            ->display_as('MODULO_CVE_PADRE', 'Módulo padre')
            ->display_as('ORDEN_MODULO', 'Orden');

        $crud->set_relation('MOD_EST_CVE', 'cmodulo_estado', 'MOD_EST_NOMBRE');
        $crud->set_relation('MODULO_CVE_PADRE', 'modulo', 'MOD_NOMBRE');

        $crud->field_type('IS_CONTROLADOR', 'true_false', array('0'=>'No', '1'=>'Sí'), '0');
        $crud->field_type('ORDEN_MODULO', 'integer');

        $crud->set_rules('ORDEN_MODULO','Orden','numeric');
        
        //$crud->fields('MOD_NOMBRE');
        //$crud->required_fields('ROL_NOMBRE');

        $crud->unset_delete(); //Remover la acción borrar
        
        $main_content = $crud->render();
         
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }*/
}