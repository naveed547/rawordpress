<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>
<div class="row align-items-center">
	<div class="col">
		<p class="fot-col-header"><?php echo esc_html(get_theme_mod('suraksha_security_guard_label',__('CNT US','ratheme1'))); ?></p>
		<p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('suraksha_security_guard_location',__('','ratheme1'))); ?></p>
		<p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('suraksha_security_guard_mail',__('','ratheme1'))); ?>/</p>
	</div>
	<div class="col">
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<div class="social-list" aria-label="<?php esc_attr_e( 'Social Links Menu', 'ratheme1' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'walker'          => new Social_Walker,
						'container'       => '',// or false
						'container_id'    => FALSE,
						'menu_class'      => '',
						'menu_id'         => FALSE,
						'items_wrap'    => '<ul id="%1$s" class="list-unstyled clearfix">%3$s</ul>'
					) );
				?>
			</div><!-- .social-navigation -->
		<?php endif; ?>			
	</div>
	<div class="col">
		<p class="fot-col-header"><?php echo esc_html(get_theme_mod('suraksha_security_guard_address_label',__('','ratheme1'))); ?></p>
		<p><?php echo esc_html(get_theme_mod('suraksha_security_guard_address1',__('','ratheme1'))); ?></p>
		<p><?php echo esc_html(get_theme_mod('suraksha_security_guard_address2',__('','ratheme1'))); ?></p>
	</div>
</div>