<?php
if(isset($list_colaboradores)){
  //pr($list_colaboradores);
  ?>
<table id="datatable-responsive" 
   class="table table-striped table-bordered dt-responsive nowrap" 
   cellspacing="0" 
   width="100%">
  <thead>
    <tr>
      <th width="40%">Nombre</th>
      <th width="30%">Tipo</th>
      <th width="30%">Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  foreach($list_colaboradores as $colaborador){
  ?>
    <tr>
      <td><?php echo $colaborador["nombre"]?></td>
      <td><?php echo $colaborador["tipo"]?></td>
      <td>
        <a href="#"
           onclick="editar(this)"
           data-id="<?php echo $colaborador["id_colab"]?>"
        >Editar</a>
        |<a href="#"
           onclick="eliminar(this)"
           data-id="<?php echo $colaborador["id_colab"]?>"
        >Eliminar</a>
      </td>
    </tr>
  <?php 
  }
  ?>
  </tbody>
</table>
<script type="text/javascript">
  function editar(obj){
    var id_colab = $(obj).data("id");
    var solicitud = $("#sol").val();
    var form = {"id_colab":id_colab,"solicitud_id":solicitud};
    //alert(id_colab)
    ajax(site_url+"/solicitud/sec_colaboradores",form,'#tab_colaboradores','#msg_general');
  }
  function eliminar(obj){
    var id_colab = $(obj).data("id");
    var solicitud = $("#sol").val();
    var form = {"id_colab":id_colab,"solicitud_id":solicitud,"eliminar":true};
    //alert(id_colab)
    ajax(site_url+"/solicitud/sec_colaboradores",form,'#tab_colaboradores','#msg_general');
  }
</script>

<?php 
}else{
   echo "<h2>No se han registrado colaboradores</h2>";
}
?>