<?php
//pr($solicitud);
$this->lang->load('interface', 'spanish');
$string_detalle = $this->lang->line('interface')['solicitud_detalle'];
?>
<div class="text-left" role="main">
    <div class="">
        <h3>HISTORIAL</h3>
    </div>
    <!---Cuerpo-->
    <div class="x_panel">
        <div class="x_title">
            <!-- <h2>Historial</h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div> -->
        </div>
        <div class="x_content">
            <table width="100%">
                <thead>
                    <tr>
                        <th width="40%" class="text-center">Estado</th>
                        <th width="60%" class="text-center">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $key => $fecha) {
                        echo '<tr>
                                <td>'.$fecha['name'].'</td>
                                <td class="text-center">'.nice_date($fecha['reg_revision'], 'd-m-Y h:i:s').'</td>
                            </tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>