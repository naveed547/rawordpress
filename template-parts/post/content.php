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
  <div class="col-sm-auto">
    <span class="event-date">
      <?php the_time( get_option( 'date_format' ) ); ?>
    </span>
  </div>
  <div class="col-sm">
    <p class="event-title"><b><?php the_title(); ?></b></p>
    <p class="event-desc"><?php esc_html_e(the_excerpt()) ; ?></p>
    <p class="read-more-link">
      <a href="<?php echo esc_url( get_permalink() );?>" title="<?php esc_attr_e( 'READ MORE', 'ratheme1'); ?>">
        <?php esc_html_e('READ MORE','ratheme1'); ?> <i class="fas fa-arrow-circle-right" "></i>
      </a>
    <p>
  </div>
  <div class="text-muted col-sm-12">
    <small><?php esc_html_e('Last Modified','ratheme1'); ?>: <?php the_modified_time(get_option( 'date_format' )) ?></small>
  </div>
</div>