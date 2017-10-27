<?php   defined('BASEPATH') OR exit('No direct script access allowed');   ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo (!is_null($title)) ? "{$title}::" : "" ?> UNAM
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<script type="application/x-javascript">
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
		</script>

		<?php echo css("bootstrap.min.css"); ?>
		<?php //echo css("jasny-bootstrap.min.css"); ?>
		<!-- Custom Theme files -->
		<?php echo css("style.css"); ?>
		<?php echo css("font-awesome.css"); ?>
		<?php echo css("nprogress.css"); ?>
		<?php echo css("apprise.css"); ?>
		<?php // echo css("style-isbn.css"); ?>
		<?php // echo css("style-isbn.css"); ?>
		<?php //echo css("bootstrap-datetimepicker.css"); ?>

		<!-- Custom and plugin javascript -->
		<?php echo css("custom.css"); ?>
		<?php echo js("jquery-2.1.4.min.js"); ?>
		<?php //echo js("moment.js"); ?>
		<?php echo js("transition.js"); ?>
		<?php echo js("collapse.js"); ?>
		<?php echo js("file-browse.js"); ?>
		<?php echo js("apprise.js"); ?>

		<?php echo js("bootstrap.min.js"); ?>
		<?php echo js("fastclick.js"); ?>
		<?php echo js("nprogress.js"); ?>
		<?php echo js("Chart.min.js"); ?>
		<?php echo js("jquery.sparkline.min.js"); ?>
		<?php echo js("Flot/jquery.flot.js"); ?>
		<?php echo js("Flot/jquery.flot.pie.js"); ?>
		<?php echo js("Flot/jquery.flot.time.js"); ?>
		<?php echo js("Flot/jquery.flot.stack.js"); ?>
		<?php echo js("Flot/jquery.flot.resize.js"); ?>
		<?php echo js("jquery.flot.orderBars.js"); ?>
		<?php echo js("jquery.flot.spline.min.js"); ?>
		<?php echo js("curvedLines.js"); ?>
		<?php echo js("DateJS/build/date.js"); ?>
		<?php echo js("daterangepicker.js"); ?>
		<?php //echo js("custom.min.js"); ?>
		<?php echo js("general.js"); ?>
		<?php echo js("apprise.js"); ?>
		
		

		<script type="text/javascript">
			var img_url_loader = "<?php echo img_url_loader(); ?>";
			var site_url = "<?php echo site_url(); ?>";
			<?php echo $css_script; ?>
		</script>

		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script type="text/javascript">
        window.history.forward();
        function noBack()
        {
            window.history.forward();
        }
		</script>
	</head>
	<body class="nav-md" onLoad="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">		
	     	<div class="container main-header">
	      		<div class="row">
	      			<!-- logo Starts -->
			        <div class="col-lg-2 col-sm-2 col-xs-1 header-links"></div>
			        <div class="col-lg-3 col-sm-4 col-xs-6">
			            <a href="http://www.unam.mx/" target="_blank" class="">
			              	<?php 
			              	$image_properties = array(
							        'class' => 'img-responsive'
							);
			              	echo img("escudo_unam.png",$image_properties); 
			              	?>
			            </a>
			            <a href="http://www.libros.unam.mx" title="Libros UNAM">
			                <?php
			                echo img('logo_libros.png',$image_properties); 
			                ?>
			            </a>
			        </div>
			      	<!-- logo Ends -->
			      	<!-- Logo Starts>
			        <div class="col-lg-2 col-sm-2 col-xs-3 ">
			            
			        </div-->
			        <div class="col-lg-5 col-sm-5 col-xs-5 logo-isbn">
				        <div>
				        	<a href="#" title="Inicio">
			                <?php 
			                $image_properties["class"]="";
			                echo img('logo_isbn.png',$image_properties); 
			                ?>
			            </a>
				        </div>
			        </div>
			        <div class="col-lg-2 col-sm-2 col-xs-1 header-links"></div>
		        </div>
		        <!-- seccion buscadores Starts -->					        
	    	</div>
	    
	    <div class="container body">
      		<div class="main_container">
				<!--navbar principal-->
				<?php
					if(!is_null($menu)){
						$menu = null;
					}
					echo $this->load->view("template/navbar.tpl.php",$menu,true);
					
					if(!is_null($main_title)){ ?>
						<header class="mastheadI">
							<div class="container">
								<div class="row">
									<div class="col-lg-12">
										<h1 class="tituloI">
											<?php echo $main_title?>
										</h1>
									</div>
								</div>
							</div>
						</header>
				<?php   }   ?>
				<div class="row">
					<div class="col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="row">
							<?php if($this->session->flashdata('success')){?>
								<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
							<?php } elseif($this->session->flashdata('error')){ ?>
								<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
							<?php } elseif($this->session->flashdata('warning')){ 		?>
								<div class="alert alert-error"><?php echo $this->session->flashdata('warning'); ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-2 col-lg-2"></div>
				</div>
				<div class="row">
		            <div class="col-md-2 col-lg-2"></div>
	              	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<?php 
						if( ! is_null($main_content) ){
							echo $main_content;
						} ?>
					</div>
					<div class="col-md-2 col-lg-2"></div>
				</div>
			</div>

		</div>

		<div class="clearfix"> </div>
		
		<!-- Se declara una ventana modal llamada modal_censo -->
		<div class="modal fade" id="modal_censo" tabindex="-1" role="dialog" aria-labelledby="modal_censo_label" data-backdrop="static">
		    <div class="modal-dialog modal-lg" role="document">
		        <div class="modal-content" id="modal_content">
							<!-- Cuerpo de la ventana modal -->
                             <?php echo (! is_null($cuerpo_modal)) ? "{$cuerpo_modal}" : ""; ?>
		        </div>
		    </div>
		</div>
		<!-- Termina la ventana modal llamada modal_censo -->

		<div class="clearfix"> </div>
		<footer >
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                  <div class="copyright text-center">
	                    <p>Dirección General de Publicaciones y Fomento Editorial, UNAM 2017.</p>
	                  </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-md-12">
	                  <div class="text-center">
	                  	<?php
		                echo img('firma_footer.png'); 
		                ?>
	                  </div>
	                </div>
	            </div>
	        </div>
	    </footer>
	</body>
</html>
