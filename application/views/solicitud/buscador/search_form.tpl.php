<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" id="div_secciones">
	    <div class="x_panel">
	        <div class="x_title">
	            <h2>Buscar solicitudes</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
	        </div>
	        <div class="x_content">
	        	<?php
	            echo form_open("search/result", array(
	                'class' => 'form-horizontal',
	                'method' => 'get',
	                "id"=>"buscar",
	            ));?>
	    		<div class="row" >
		        	<div class="col-md-6 col-sm-12 col-xs-12 ">
	                  	<div class="item form-group">
		                    <label class="col-md-4 col-sm-12 col-xs-12 text-right" for="name">
		                        <b>Fecha de inicio:</b> 
		                    </label>
		                    <div class="col-md-8 col-sm-12 col-xs-12">
		                    	<?php
		                      echo $this->form_complete->create_element(array(
		                       'id'=>'filtros[init]',
		                       'name' => 'filtros[init]',
		                       'type' => 'text',
		                       'class' => 'form-control col-md-7 col-xs-12',
		                       'attributes' => array(
		                          'class' => '',
		                          'min'=>'0',
		                          'placeholder'=>'yyyy-mm-dd',
		                          
		                          )
		                       ));
		                       ?>  
		                    </div>
	                	</div>
	                
		        	</div>
		        	<div class="col-md-6 col-sm-12 col-xs-12 ">
	        			<div class="item form-group">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
		                        <b>Temática principal: </b>
		                    </label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                      <?php
		                      echo $this->form_complete->create_element(array(
		                       'id' => 'solicitud_categoria',
		                       'type' => 'dropdown',
		                       'options' => dropdown_options($combos["categorias"], "id", "nombre"),
		                       // 'first' => array('0' => "Seleccione una opción"),
		                       'value' => isset($solicitud["clasificacion_tematica"]["id_categoria"]) ? $solicitud["clasificacion_tematica"]["id_categoria"]:"",
		                       'class' => '',
		                       'attributes' => array('onchange' => 'sub_categoria(this)',
		                          
		                        )
		                       ));
		                       ?>
		                        
		                      <?php echo form_error("solicitud_categoria"); ?>
		                        
		                    </div>
		                </div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-6 col-sm-12 col-xs-12 ">
		        		<div class="item form-group">
		                  <label class="text-right col-md-4 col-sm-4 col-xs-12" for="name">
		                  <b>Tipo de obra: </b>
		                  </label>
		                  <div class=" col-md-8 col-sm-8 col-xs-12">
			                  <input type="radio" 
			                   class="flat" 
			                   name="filtros[sol_tipo_obra]"
			                   value="I" 
			                   /> Independiente &nbsp;&nbsp;<br>
			                  <input type="radio" 
			                   class="flat" 
			                   name="filtros[sol_tipo_obra]"
			                   value="C" 
			                   /> Completa &nbsp;&nbsp;<br>
			                  <input type="radio" 
			                   id="volumen"
			                   class="flat" 
			                   name="filtros[sol_tipo_obra]"
			                   value="V" 
			                   /> Volumen 
			               </div>
		                </div>
		        	</div>
		        	<div class="col-md-6 col-sm-12 col-xs-12 ">
		        		<div class="item form-group">
		                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
		                        <b>Sub-categoría:</b>
		                    </label>
		                    <div class="col-md-8 col-sm-8 col-xs-12" id="div_subcategoria">
		                    	<?php
			                      echo $this->form_complete->create_element(array(
			                       'id' => 'id_subcategoria',
			                       // 'id' => 'solicitud[id_subcategoria]',
			                       'type' => 'dropdown',
			                       'first' => array('' => "Seleccione una opción"),
			                       'class' => '',
			                       'name'=>'filtros[id_subcategoria]'
			                       ));
			                       ?>
		                    </div>
		                </div>
		        	</div>
		        </div>
		        <div class="row" >
		        	<div class="col-md-12 col-sm-12 col-xs-12">
	        			<div class="item form-group">
						    <label class="text-right col-md-2 col-sm-2 col-xs-12" for="name">
						        <b>Secciones: </b>
						    </label>
						    <div class="col-md-10 col-sm-10 col-xs-12" id="div_sections">
						        Sin secciones [<a href="#" id="a_sections" onclick="sections(this)">Seleccionar secciones</a>]
						    </div>
						</div>
		        	</div>
		        	
		        </div>
		        <div class="row" >
		        	<div class="col-md-6 col-sm-12 col-xs-12 text-right">
		        		<button name="generar"  id="send" type="submit" value='g' class="btn">Generar reporte</button>
		        	</div>
		        	<!--div class="col-md-6 col-sm-12 col-xs-12 ">
		        		<button name="exportar" id="submit" type="submit" value='x' class="btn btn-primary">Exportar en Excel</button>
		        	</div-->
		        </div>
		        <?php echo form_close(); ?>
	        </div>
	    </div>
	</div>  
</div>
<?php 
echo js("solicitud/secciones.js");
?>
<script type="text/javascript">
function sub_categoria(obj){
  var categoria_id = $(obj).val();
  var action = "<?php echo base_url();?>index.php/solicitud/sub_categoria";
  var form_data = {categoria:categoria_id};
  //alert(form_data)
  ajax(action,form_data,'#div_subcategoria','#msg_general');
  //});
}
function sections(obj){
  var action = "<?php echo base_url();?>index.php/search/sections";
  //alert(form_data)
  ajax(action,null,'#div_sections','#msg_general');
  //});
}
</script>