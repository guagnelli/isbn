
<?php
if (isset($debug)) {
    pr($debug);
}
if (!isset($enable_options)) {
    $enable_options = TRUE;
}

//pr($files);
if (isset($files) && count($files) > 0) {
//pr($files);
    ?>
    <table id="datatable-responsive" 
           class="table table-striped table-bordered dt-responsive nowrap" 
           cellspacing="0" 
           width="100%">
        <tr>
            <th width="15%">Archivo</th>
            <th width="15%">Tipo de archivo</th>
            <th width="50%">Descripci&oacute;n</th>
            <?php if ($enable_options) { ?>
                <th width="20%">Opciones</th>
            <?php } ?>
        </tr>
        <?php foreach ($files as $key => $file) { ?>
            <tr>
                <td><?php
                    $uri = asset_url() . "js/uf/uploads/" . $file["solicitud_id"] . "/" . $file["nombre_fisico"];
                    echo anchor_popup(
                            $uri, $file["nombre"], FALSE);
                    ?>
                </td>
                <td>
                <?php
                echo $c_tipo_file[$file["file_type"]];
                ?>
                </td>
                <td>
                    <?php echo $file["description"] ?>
                </td>

                <?php if ($enable_options) { ?>
                    <td>
                        <button id="remove_file" 
                                type="button" 
                                class="btn btn-form" 
                                data-file="<?php echo $file['id'] ?>"
                                onclick="btn_dfile(this)" >
                            Eliminar
                        </button>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
<?php } ?>