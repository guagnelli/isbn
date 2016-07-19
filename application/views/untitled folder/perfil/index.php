<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->lang->load('interface','spanish');
$string_values = $this->lang->line('interface');
//pr($array_menu);
?>
<script>
    var array_menu_perfil = new Array(15);
    var hrutes = new Object();//Objeto que almacena las rutas del controlador 
</script>
    
<div class="row" id="contenedor_formulario">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel">
            <div class="breadcrumbs6 panel-heading" style="padding-left:20px;">
                <h1 id="titulo_registro">
                    <small>
                        <span class="glyphicon glyphicon-info-sign">
                        </span>
                    </small>
                    <?php echo $string_values['perfil']['lbl_titulo_seccion']; ?>
                </h1>
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked col-md-3">
                    <?php foreach ($array_menu as $value) { 
                        $pos = strpos($value['ruta'], ':');
                        $array_quitar = array('(', ')');
                        if($pos>0){
                            $separa = explode(":", $value['ruta']);
                            $array_quitar = array('(', ')');
                            $val = $separa[0];
//                            $array_quitar = array('(', ')');
//                            $val = str_replace($array_quitar, "", $separa[0]);
                        ?>
                            <script>
                                //Guarda los datos de configuración para el uso de ajax en javascript
                                hrutes['<?php echo $val; ?>'] = '<?php echo $value['ruta_padre'].":".$value['ruta']; ?>';
                            </script>
                        <?php        
                        }else{
//                            $val = str_replace($array_quitar, "", $value['ruta']);
                            $val =  $value['ruta'];
                            $separa = array(); 
                        }
                        
                        ?>
                        <li>
                            <a data-toggle="tab" href="#<?php echo $val?>" >
                                <?php echo $value['nombre_modulo']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                
                <div id = 'tabContent' class='tab-content col-md-9'>
                    <?php foreach ($array_menu as $value) { 
                        $pos = strpos($value['ruta'], ':');
                        if($pos>0){
                            $separa = explode(":", $value['ruta']);
//                            $val = str_replace($array_quitar, "", $separa[0]);
                            $val = $separa[0];
                        }else{
//                            $val = str_replace($array_quitar, "", $value['ruta']);
                            $val = $value['ruta'];
                        }
                        ?>
                    <div id = '<?php echo $val; ?>' class = 'tab-pane fade'>
                        <div class ="row">
                            <?php 
                                $busca_cadena = strpos($value['ruta'], 'ajax'); //Busca si el metodo a invocar es un ajax
//                                    pr('Invoca ajax' . $busca_cadena);
                                if(!$busca_cadena){//Si no existe un ajax, llama a una vista 
                                    $this->load->view($value['ruta_padre']."/".$value['ruta']); 
                                } 
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
</div>


//<?php 
//  if(isset($modal_general)){
//     echo $modal_general;
//  }
//?>

<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
      
    <div class="modal-content">
      
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalTitulo">Modal title</h4>
      </div>
      <div class="modal-body" id="my_modal_perfil_cuerpo" >
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    
    </div>
      
  </div>
</div>-->

