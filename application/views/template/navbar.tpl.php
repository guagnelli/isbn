<nav id="main-menu" class="navbar" role="navigation">
  <div class="container">
  <!-- Nav Header Starts -->
    <div class="navbar-header">
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-cat-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <i class="fa fa-bars"></i>
      </button>
    </div>
  <!-- Nav Header Ends -->
  <!-- Navbar Cat collapse Starts -->
    <div class="collapse navbar-collapse navbar-cat-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $this->config->item('url_site'); ?>">Inicio</a></li>
        <li><a href="<?php echo $this->config->item('url_site'); ?>info_gral">Información general</a></li>
        <li><a href="<?php echo $this->config->item('url_site'); ?>normas">Normas operativas</a></li>
        <li><a href="<?php echo $this->config->item('url_site'); ?>estructura">Estructura organizacionales</a></li>
        <li><a href="<?php echo $this->config->item('url_site'); ?>lineamientos">Lineamientos institucionales</a></li>
        <li class="dropdown">
          <a href="<?php echo $this->config->item('url_site'); ?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="10">
            Temas de interés<span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1" href="<?php echo $this->config->item('url_site'); ?>">Buenas prácticas</a></li>
            <li><a tabindex="-1" href="<?php echo $this->config->item('url_site'); ?>">Recursos de apoyo</a></li>
            <li><a tabindex="-1" href="<?php echo $this->config->item('url_site'); ?>">Enlaces</a></li>
            <li><a tabindex="-1" href="<?php echo $this->config->item('url_site'); ?>">Open Access</a></li>                
          </ul>
        </li>
        <li><a href="<?php echo $this->config->item('url_site'); ?>colaboraciones">Colaboraciones</a></li>
        <li><a href="<?php echo $this->config->item('url_site'); ?>info_contacto">Contacto</a></li>
      </ul>
    </div>
  <!-- Navbar Cat collapse Ends -->
  </div>
</nav>