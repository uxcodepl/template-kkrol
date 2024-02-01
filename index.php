<?php defined('_JEXEC') or die ;

include_once JPATH_THEMES . '/' . $this -> template . '/logic.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $this -> language; ?>">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	
	<script>
  	window.dataLayer = window.dataLayer || [];
 	 function gtag(){dataLayer.push(arguments);}
  	gtag('js', new Date());

  	gtag('config', 'UA-number');
	</script>

	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
</head>

<body id="b-override" class="<?php echo(($menu -> getActive() == $menu -> getDefault()) ? ('front') : ('site')) . ' ' . $active -> alias . ' ' . $pageclass; ?>">


	<div class="container-main">
		<div class="row align-items-center writing">
			<div class="col">
				<img class="hidden-lg-up" src="<?php if ($this -> language == "pl-pl") echo 'templates/'.$this -> template.'/images/brand-text.svg';
				else echo 'templates/'.$this -> template.'/images/napis-1.svg';
				?>"/>

			</div>
		</div>

		<div class="row">
			<div class="col-3 top-left hidden-lg-up">	
			</div>
			<div class="col-3 hidden-md-down">	
			</div>
		</div>

		<nav class="navbar navbar-light navbar-toggleable-md">
			<button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="logo-wrap text-center">
				<a  href="/">
					<span id="logo">
						<img class="hidden-md-down" <?php if ($this -> language == "pl-pl") echo 'src="templates/'.$this -> template.'/images/logo.svg"'.' alt="Brand name PL"';
						else echo 'src="templates/'.$this -> template.'/images/logo-en.svg"'.'alt="Brand name EN"';
						?>/>

						<img class="hidden-lg-up" src="<?php echo 'templates/'.$this -> template;?>/images/logo-min.svg" <?php if ($this -> language == "pl-pl") echo 'alt="Brand name PL"';
						else echo 'alt="Brand name EN"';?>/>
					</span>
				</a>		
			</div>
			
			<div id="top-icon">
				<div class="wrap">
					<a href="#" class="mySearch hidden-md-down" data-toggle="modal" data-target="#mySearch" title="Szukaj"><img src="<?php echo  'templates/'.$this -> template;?>/images/icon-search.png"></a>

					<jdoc:include type="modules" name="language-switcher" style="none" />


					<!--<a href="<?php //if ($this -> language == "pl-pl") echo "/it"; else echo "/en/it-en"; ?>" class="it" data-toggle="tooltip" title="IT poczta Wifi system Akademus" ><img alt="IT" src="<?php // echo  'templates/'.$this -> template;?>/images/icon-it.png"></a>
					-->
				</div>
			</div>
			<div class="menu-area-wrap">
				<div class="navbar-collapse collapse menu-area">
					<div class="hidden-lg-up search-mobile">
						<jdoc:include type="modules" name="search-mobile" style="xhtml" />
					</div>
					
					<div>
						
						<jdoc:include type="modules" name="menu" style="xhtml" />
					</div>
					<button type="button" class="navbar-toggle collapsed close close-icon  hidden-lg-up" aria-label="Close" data-toggle="collapse" data-target=".navbar-collapse">
						<span aria-hidden="true"><img src="<?php echo  'templates/'.$this -> template;?>/images/close.svg"></span>
					</button>
				</div>
			</div>
			
		</nav> 

		
		<section id="banner" class="hidden-sm-down">
			<jdoc:include type="modules" name="position-1" style="xhtml" />

		</section> 

		<!-- <div id="pbgrid_notice"><button class="more_button"></button></div> -->
		

		<!-- <div id="pbgrid_notice"><button class="more_button"><p><i class="fa fa-2x fa-long-arrow-down"></i></p>POKAŻ WIĘCEJ</button></div> -->


		<?php
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$lang = JFactory::getLanguage();
		?>

		<?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) : ?>
		<div class="col-sm-12">
			<!-- Begin Content -->							
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			<jdoc:include type="modules" name="position-2" style="xhtml" />
			<!-- End Content -->
		</div>	
		<?php else : ?>
			<div>
			</div>
			<div class="row breadcrumbs">
				<div class="col-12"><jdoc:include type="modules" name="breadcrumbs" style="xhtml" /></div>
			</div>

			<div class="row p-1">

				<div class="col-lg-3 col-sm-12">
					<div class="submenu"> 
						<jdoc:include type="modules" name="submenu" style="xhtml" />	
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<jdoc:include type="component" />
				</div>	
				<div class="col-lg-3 col-sm-12">
				</div>

			</div>
		<?php endif ?>

		<footer class="row">
			<div class="col-4 col-lg-3 offset-lg-1 justify-content-start align-self-center emblem"><img src="<?php echo  'templates/'.$this -> template;?>/images/logo-01.png">
			</div>

			<div class="col-4 align-self-center">
				<div class="social-media justify-content-center" ><div class="column"><a href="http://facabook-link"><img src="<?php  echo  'templates/'.$this -> template;?>/images/icon-facebook.png"></a>
					<a href="https://youtube-channel"><img src="<?php  echo  'templates/'.$this -> template;?>/images/icon-youtube.png"></a>
					<a href="https://instagram"><img src="<?php  echo  'templates/'.$this -> template;?>/images/icon-instagram.png"></a></div></div>
			</div>

			<div class="col-4 col-lg-2 offset-lg-1 d-flex justify-content-end align-self-center bip">
				<a href="https://local-site"><img src="<?php  echo  'templates/'.$this -> template;?>/images/local-site.png"></a>
			</div>

		</footer>
		<div class="footer2">
			<p><?php echo JText::_( 'TPL_KKROL_FOOTER1' ); ?> <span class="hidden-md-down"> <?php echo JText::_( 'TPL_KKROL_FOOTER2' ); ?></span></p>
			<p class="hidden-md-down">
				<?php echo JHtml::_('email.cloak', 'contact@site.com', 0);?>
			</p>
		</div>

		<div class="cookie">
			<jdoc:include type="modules" name="cookie" style="xhtml" />
		</div>

		<div class="modal" id="mySearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<jdoc:include type="modules" name="search-modal" />
					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
		</div>

	</div>




	<script>
		$(document).ready(function() {

			jQuery('a.mySearch').attr('data-toggle', 'modal').attr('data-target', '#mySearch')
			jQuery('#mySearch').on('shown.bs.modal', function() {
				jQuery("input[name=searchword]").focus();
			})


			$('.menu .dropdown-toggle').append('<i class="fa fa-angle-down"></i>');
			$('ul [data-toggle="collapse"]').append('<i class="fa fa-angle-down"></i>');		
			$('.menu > li > a').addClass('justify-content-between d-flex align-items-center');
			// alias in menu
			$('.menu li ul li a').addClass('dropdown-item').removeClass('nav-link');
			$('.menu > li > a').attr('href', '#');
			$('.pbitem_label').addClass('news-element');
			$('img').addClass('img-fluid');
			$('.lang-active').remove();
			

			// accordion
			$('.menu .collapse').on('show.bs.collapse', function (e) {
				$('.menu .collapse').collapse("hide")
			})	


			$('ul[role="menu"]')
			.on('show.bs.collapse', function (e) {
				$(e.target).prev('a[role="menuitem"]').addClass('active');
			})
			.on('hide.bs.collapse', function (e) {
				$(e.target).prev('a[role="menuitem"]').removeClass('active');
			})

			$('a[data-toggle="collapse"]').click(function (event) {

				event.stopPropagation();
				event.preventDefault();

				var drop = $(this).closest(".dropdown");
				$(drop).addClass("open");

				$('.collapse.in').collapse('hide');
				var col_id = $(this).attr("href");
				$(col_id).collapse('toggle');
			})
		})   
	</script>

</body>

</html>