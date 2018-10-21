<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>
		<footer>
			<div class="container">
				<?php get_template_part( 'template-parts/footer/footer', 'top' ); ?>
				<?php get_template_part( 'template-parts/footer/footer', 'disclaimer' ); ?>
			</div>
		</footer>
		<script>
			$(function () {
				$('.ra-popover').popover({
					container: 'body'
				});
				var scrollToTop = $('.vlp-scroll-top');
				var $window = $(window);
				var scrollTop;

				$(window).on('scroll', function (e) {
				  scrollTop = $window.scrollTop();

				  if (scrollTop >= 500 && $window.scrollTop() > 0) {
				      scrollToTop.addClass('vlp-scroll-top--fixed');
				  } else {
				      scrollToTop.removeClass('vlp-scroll-top--fixed');
				  }
				});

				scrollToTop.find('a').on('click', function () {
				  $('html, body').animate({ scrollTop: 0 }, 'slow');
				  return false;
				});
				let stickyNavHeight = $("header .navbar").height();
				$(window).scroll(function () {
					let $this = $(this);
					if ($(window).scrollTop() > stickyNavHeight) {
						if (!$('body').hasClass('fixed-sticky-nav')) {
						  $('body').addClass('fixed-sticky-nav');
						}
					} else {
						$('body').removeClass('fixed-sticky-nav');
					}
				});
			});
		</script>
		<div class="vlp-scroll-top">
	      <a class="vlp-scroll-top__link">
	          <i class="fa fa-arrow-up"></i>
	          <p class="sr-only">Back to Top</p>
	      </a>
	    </div>

	    <?php if ( has_nav_menu( 'social' ) ) : ?>
			<div class="sticky-icons-wrap left" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'ratheme1' ); ?>">
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

		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<div class="sticky-icons-wrap right" role="navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'ratheme1' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'menu_class'     => 'secondary-links-menu',
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
	    <!-- <div class="sticky-icons-wrap right">
	    	<ul class="list-unstyled clearfix">
				<li class="facebook-icon">
					<a href="http://www.facebook.com">
						<i class="fas fa-graduation-cap"></i>
						<span class="icon-text">Apply</span>
					</a>
				</li>
				<li class="youtube-icon">
					<a href="http://www.twitter.com">
						<i class="fas fa-handshake"></i>
						<span class="icon-text">Donate</span>
					</a>
				</li>
				<li class="twitter-icon">
					<a href="#contact-us" data-toggle="modal">
						<i class="fas fa-chalkboard-teacher"></i>
						<span class="icon-text">Contact</span>
					</a>
				</li>
			</ul>
	    </div> -->
	    <?php get_template_part( 'template-parts/contact'); ?>
		<?php wp_footer(); ?>
	</body>
</html>
