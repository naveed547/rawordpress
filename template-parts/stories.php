<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>
<?php $pages = array();
  	for ( $count = 1; $count <= 4; $count++ ) {
        $mod = intval( get_theme_mod( 'control_our_services' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $page_id = $mod;  //Page ID
		  $page_data = get_page( $page_id ); 
		  $pages[] = $page_data;
        }
  	}
  	/*if( !empty($pages) ) {
        $args = array(
        	'post_type' => 'pages',
          	'post__in' => $pages
        );
        echo "naveed";
        $query = new WP_Query( $args );
        echo $query->have_posts();
        if ( $query->have_posts() ) {
        	echo "naveed";
      		$i = 1;
      		while ($loopy->have_posts()) : $loopy->the_post(); ?>
		        <div class="item"><?php the_title(); 
		              echo '<br ?>';

		        echo '</div>';      
			endwhile; 
        }
        wp_reset_query();
    }*/
?> 

<div class="our-stories">
  <h3 class="our-stories__header"><?php echo get_theme_mod('our_services_title') ?></h3>
  <div class="row card-container">
    <?php foreach($pages as $key=>$value): ?>
      <div class="card col-sm-6 col-md-4">
        <div class="card-col">
          <img class="card-img-top" alt="100%x200" src="<?php echo str_replace('-150x150.jpg', '.jpg?w=900', get_the_post_thumbnail_url($pages[$key]->ID,'thumbnail')) ?>" style="height: 200px; width: 100%; display: block;">
          <div class="card-body">
            <h4 class="card-title"><?php echo $pages[$key]->post_title ?></h4>
            <p class="card-text"><?php echo esc_html($pages[$key]->post_excerpt); ?></p>
            <div class="row">
              <div class="col">
                <p class="text-muted">
                    <small class="card-text"><?php esc_html_e('Last Modified','ratheme1'); ?>: <?php echo date('F d, Y', strtotime($pages[$key]->post_modified)); ?></small>
                  </p>
              </div>
              <div class="col text-right">
                <a href="<?php echo get_the_permalink($pages[$key]->ID); ?>" class="card-link"> <?php esc_html_e('READ MORE','ratheme1'); ?> <i class="fas fa-arrow-circle-right" "></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>