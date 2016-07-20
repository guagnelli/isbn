<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo (!is_null($title)) ? "{$title}::" : "" ?>Revistas UNAM</title>

  <!-- Bootstrap Core CSS -->
  <link href="/front/sites/all/themes/revistas_unam/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="/front/sites/all/themes/revistas_unam/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="/front/sites/all/themes/revistas_unam/css/style.css" rel="stylesheet" type="text/css">
  <link href="/front/sites/all/themes/revistas_unam/css/responsive.css" rel="stylesheet" type="text/css">
  <link href="/front/sites/all/themes/revistas_unam/css/accordion.css" rel="stylesheet" type="text/css">
  <?php 
  //echo css("bootstrap.css"); 
  //echo css('font-awesome/css/font-awesome.min.css'); 
  echo css("style.css");
  ?>

  <!-- Google Web Fonts -->
  <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Oswald:400,700,300" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>

  <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/fav-144.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/fav-114.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/fav-72.png">
  <link rel="apple-touch-icon-precomposed" href="images/fav-57.png">
  <link rel="shortcut icon" href="images/fav.png">
  
  <?php echo js("jquery-1.11.1.min.js");?>
  <?php echo js("bootstrap.min.js");?>
  <?php echo js("totop.js"); ?>

  <script type="text/javascript">
    var img_url_loader = "<?php echo img_url_loader('ajax-loader.gif'); ?>";
    var site_url = "<?php echo site_url(); ?>";
  </script>
</head>

<body>
<!-- Header Section Starts -->
  <header id="header-area">
    <!-- Header Top Starts -->
    <div class="header-top">
      <?php 
      if(!is_null($top_header)){
        $top_header = null;
      }
      if(!is_null($redes)){
        echo $redes;
      } else {
        echo $this->load->view("template/header-top.tpl.php",$top_header,true);
      }
      ?>
    </div>
    <!-- Header Top Ends -->
  
    <!-- Main Header LOGOS Starts -->
    <div class="">
      <?php 
      if(!is_null($main_header)){
        $main_header = null;
      }
      if(!is_null($encabezado)){
        echo $encabezado;
      } else {
        echo $this->load->view("template/header-main.tpl.php",$main_header,true);
      }
      ?>
    </div>
    <!-- Main Header Ends -->

    <!-- navegación -->
    <?php 
    if(!is_null($menu)){
      //$menu = null;
      echo $menu;
    } else {
      echo $this->load->view("template/navbar.tpl.php",$menu,true);
    }
    ?>
    <!-- /.navegación -->
  </header>
<!-- Header Section Ends -->

<!--Main content-->
<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <?php 
    if(!is_null($main_content)){
      echo $main_content;
    }
    ?>
    </div>
  </div>
</div><br />

<!-- Footer Section Starts -->
  <footer id="footer-area">
  <!-- Footer Links Starts -->
    <div class="">
    <?php
    if(!is_null($pie_ligas)){
      echo $pie_ligas;
    }
    /*if(!is_null($footer_menu)){
      $footer_menu = null;
    }
    echo $this->load->view("template/menu_footer.tpl.php",$footer_menu,true);*/
    ?>
    </div>
  <!-- Footer Links Ends -->
  <!-- Copyright Area Starts -->
    <div class="">
    <?php 
    if(!is_null($footer)){
      $footer = null;
    }
    if(!is_null($pie_derechos)){
      echo $pie_derechos;
    } else {
      echo $this->load->view("template/footer.tpl.php",$footer,true);
    }
    ?>
    </div>
  <!-- Copyright Area Ends -->
  </footer>
<!-- Footer Section Ends -->
</body>
</html>
