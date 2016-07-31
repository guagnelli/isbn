<?php   defined('BASEPATH') OR exit('No direct script access allowed');   ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo (!is_null($title)) ? "{$title}::" : "" ?> UNAM
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<script type="application/x-javascript">
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
		</script>

		<?php echo css("bootstrap.min.css"); ?>
		<?php //echo css("jasny-bootstrap.min.css"); ?>
		<!-- Custom Theme files -->
		<?php echo css("style.css"); ?>
		<?php echo css("font-awesome.css"); ?>
		<?php //echo css("bootstrap-datetimepicker.css"); ?>

		<!-- Custom and plugin javascript -->
		<?php //echo css("custom.css"); ?>
		<?php echo css("apprise.css"); ?>
		<?php //echo css("bonos.css"); ?>
		<?php // echo js("jquery.min.js"); ?>
		<?php echo js("jquery-2.1.4.min.js"); ?>
		<?php echo js("moment.js"); ?>
		<?php echo js("transition.js"); ?>
		<?php //echo js("bootstrap-datetimepicker.js"); ?>
		<?php echo js("collapse.js"); ?>
		<?php echo js("file-browse.js"); ?>
		<?php echo js("apprise.js"); ?>

		<?php echo js("bootstrap.min.js"); ?>
		<?php //echo js("jasny-bootstrap.min.js"); ?>
		<?php echo js("general.js"); ?>

		<script type="text/javascript">
			var img_url_loader = "<?php echo img_url_loader(); ?>";
			var site_url = "<?php echo site_url(); ?>";
			<?php echo $css_script; ?>
		</script>

		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>

		<div id="wrapper">
			<div class="gray-bg dashbard-1"> <!-- id="page-wrapper" -->
				<div class="content-main">
					<div class="container">
					<header role="banner">
						<div id="cd-logo"><a href="www.unam.mx"><?php echo img("UNAM-escalable-inverso.png", array('width'=>'50px')); ?></a></div>
						<!-- <div id="cd-logo"><a href="#0"><?php echo img("revUNAM.png", array('width'=>'120px')); ?></a></div>
						<div id="cd-logo"><a href="#0"><?php echo img("arrobas.png"); ?></a></div>-->
					</header>

					<!--navbar principal-->
						<br>
					<!--- -->
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
						<!--//banner-->
						<!--grid-->
						<div class="inbox-mail">
							<?php if($this->session->flashdata('success')){?>

							<div class="row">
								<div class="col-sm-2"></div>
								<div class="col-sm-8">
									<div class="row">
										<div class="alert alert-success">
											<?php echo $this->session->flashdata('success'); ?>
								</div>
							</div>
						</div>

						<?php 		}elseif($this->session->flashdata('error')){ 		?>

					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="alert alert-danger">
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							</div>
						</div>
					</div>
					<?php 		}elseif($this->session->flashdata('warning')){ 		?>

					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="alert alert-error">
									<?php echo $this->session->flashdata('warning'); ?>
								</div>
							</div>
						</div>
					</div>

					<?php 		}

					if( ! is_null($main_content) ){
						echo $main_content;
					} ?>
					</div>
				</div>
				</div>
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
		<footer style="background-color:#CCC; padding:20px; 0px;">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                  <div class="copyright text-center">
	                    <p>Copyright © UNAM 2016. Este sitio se visualiza mejor a partir de resoluciones 1024 px con Explorer 11 / Firefox 33.0 / Chrome 38.0</p>
	                  </div>
	                </div>
	            </div>
	        </div>
	    </footer>

		<!-- Mainly scripts -->
		<?php echo js("jquery.metisMenu.js"); ?>
		<?php echo js("jquery.slimscroll.min.js"); ?>
		<?php echo js("custom.js"); ?>
		<?php echo js("screenfull.js"); ?>

		<script>
			$(function () {
				$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

				if (!screenfull.enabled) {
					return false;
				}

				$('#toggle').click(function () {
					screenfull.toggle($('#container')[0]);
				});

			});
		</script>

		<?php echo js('jquery.nicescroll.js'); ?>
		<?php echo js('scripts.js'); ?>
	</body>
</html>
