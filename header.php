<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php wp_title(''); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<?php wp_head(); ?>
</head>
<body>
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
				<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						the_custom_logo(); 
		           	}else{ ?>
		           	<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					  	<img src="<?php echo get_template_directory_uri() . '/assets/images/ra_logo2.jpg'; ?>" alt="logo"/>
					</a>     
		        <?php }?>
		        <?php if ( has_nav_menu( 'primary' )) : ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
				<?php endif; ?>

				<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					<?php if ( has_nav_menu( 'primary' )) : ?>
						<?php
							wp_nav_menu(
								array (
									'menu'            => 'main-menu',
									'container'       => '',// or false
									'container_id'    => FALSE,
									'menu_class'      => '',
									'menu_id'         => FALSE,
									'items_wrap'    => '<ul id="%1$s" class="navbar-nav mr-auto mt-2 mt-lg-0">%3$s</ul>',
									'theme_location'  => 'primary',
									'walker'          => new Description_Walker
								)
							);
						?>
					<?php endif; ?>
					<div class="d-flex justify-content-between nav-right align-items-center">
						<?php if ( has_nav_menu( 'topleft' )) : ?>
							<?php
								wp_nav_menu(
									array (
										'menu'            => 'button',
										'container'       => '',// or false
										'container_id'    => FALSE,
										'menu_class'      => 'btn btn-info btn-warning',
										'menu_id'         => FALSE,
										'items_wrap'    	=> '%3$s',
										'theme_location'  => 'topleft',
										'walker'          => new TopRightButton_Walker
									)
								);
							?>
						<?php endif; ?>
					    <button class="btn btn-lg btn-danger" data-toggle="collapse" data-target="#searchForm" aria-expanded="false" aria-controls="searchForm"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<div class="collapse" id="searchForm">
    	<div class="container">
			<?php get_search_form(); ?>	
		</div>
    </div>

