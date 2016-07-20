<!-- <div class="container">
  <div class="row">
    <div class="col-md-2">
      <div id="logo">
      <?php 
        /* echo anchor("http://www.unam.mx/",
              img("unaam-u.png",
                array("class"=>"img-responsive")
              ),
              'target="_blank"'); */
      ?>
      </div>
    </div>

    <div class="col-md-2">
      <div id="logo">
      <?php 
        /* echo anchor("http://www.libros.unam.mx/",
              img("libunam.png",
                array("class"=>"img-responsive")
              ),
              'target="_blank"'); */
      ?>
      </div>
    </div>
    <div class="col-md-8">
      <div id="logo">
      <?php 
        /* echo anchor("http://www.revistas.unam.mx/",
              img("logo.png",
                array("class"=>"img-responsive")
              ),
              'target="_blank"'); */
      ?>
      </div>
    </div>
        
  </div>
</div> -->

<div class="container">
      <div class="row">
      <!-- logo Starts -->
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7">
          <div >
            <?php 
              echo anchor("http://www.unam.mx/",
                    img("logoUNAM.png",
                      array("class"=>"img-responsive")
                    ),
                    'target="_blank"');
            ?>
          </div>
        </div>
      <!-- logo Ends -->
      <!-- Logo Starts -->
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <div >
          <?php 
            echo anchor("http://www.revistas.unam.mx/",
                  img("revunam.png",
                    array("class"=>"img-responsive")
                  ),
                  'target="_blank"');
          ?>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-5">
          <?php 
          $url_harvester = $this->config->item("url_harvester");
          echo form_open($url_harvester, array('id'=>'form_main')); ?>
          <div class="col-sm-9 col-xs-12">
            <div class="pull-right">
            <!-- Search Starts -->
          
            <div id="search">
              <div class="input-group">
                <input id="q" name="q" type="text" class="form-control input-lg" placeholder="Buscar" style="padding: 1px 16px;">
                <span class="input-group-btn">
                <button id="btn_busqueda_avanzada" class="btn btn-lg" type="button">
                  <i class="fa fa-search"></i>
                </button>
                </span>
              </div>
            </div>  
        <!-- Search Ends -->
            </div>
          </div>
          <div class="col-sm-3 col-xs-12 header-links"><ul class="nav navbar-nav pull-right"><li><a href="<?php echo site_url('revistas/busqueda_avanzada'); ?>" style="color:#f42434;">Búsqueda avanzada</a><li></ul></div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>