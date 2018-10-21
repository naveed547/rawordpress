<?php
/**
 * Naveed Custom Theme
 *
 * @package WordPress
 * @subpackage navedd-themes
 * @since 1.0
 */

function ratheme1_setup() {
	
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in two locations.
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ratheme1' ),
		'social'  => __( 'Social Links Menu', 'ratheme1' ),
		'topleft'  => __( 'Top Left Menu', 'ratheme1' ),
		'secondary'  => __( 'Secondary Menu', 'ratheme1' ),
	) );

	
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
    add_theme_support('post-thumbnails');
  	set_post_thumbnail_size(150,150);
}
add_action( 'after_setup_theme', 'ratheme1_setup' );

add_filter('admin_init', 'my_general_settings_register_fields');
 
function my_general_settings_register_fields()
{
    register_setting('general', 'my_field', 'esc_attr');
    add_settings_field('my_field', '<label for="my_field">'.__('My Field' , 'my_field' ).'</label>' , 'my_general_settings_fields_html', 'general');
}
 
function my_general_settings_fields_html()
{
    $value = get_option( 'my_field', '' );
    echo '<input type="text" id="my_field" name="my_field" value="' . $value . '" />';
}

add_filter( 'wp_title', 'ratheme1_title_for_home' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function ratheme1_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Home', 'textdomain' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}


//if ( ! function_exists( 'ratheme1_fonts_url' ) ) :

function ratheme1_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Roboto:400,700';
	$font_family[] = 'Lato:100,100i,300,300i,400,400i,700,700i,900,900i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles');
add_post_type_support( 'page', 'excerpt' );

function suraksha_security_guard_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}



function child_enqueue_styles() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'google-fonts', ratheme1_fonts_url(), array(), null );
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css');
	wp_enqueue_style( 'global', get_stylesheet_uri() );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css');
	wp_enqueue_script( 'jQuery', 'https://code.jquery.com/jquery-3.3.1.min.js');
	wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
	wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_filter( 'posts_search', 'my_search_is_perfect', 20, 2 );
function my_search_is_perfect( $search, $wp_query ) {
    global $wpdb;

    if ( empty( $search ) )
        return $search;

    $q = $wp_query->query_vars;
    $n = !empty( $q['exact'] ) ? '' : '%';

    $search = $searchand = '';

    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );

        $search .= "{$searchand}($wpdb->posts.post_title REGEXP '[[:<:]]{$term}[[:>:]]') OR ($wpdb->posts.post_content REGEXP '[[:<:]]{$term}[[:>:]]')";

        $searchand = ' AND ';
    }

    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }

    return $search;
}
add_action( 'pre_get_posts', 'aj_modify_posts_per_page' );
function aj_modify_posts_per_page( $query ) {
	if ( $query->is_search() ) {
		$query->set( 'posts_per_page', '10' );
	}
}
function ratheme_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  $pagination_args = array(
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('«'),
    'next_text'       => __('»'),
    'type'            => 'array',
    'add_args'        => false,
    'add_fragment'    => ''
  );

 $paginate_links = paginate_links($pagination_args);

 if (is_array($paginate_links)) {
   $custom_pagination = "<div class='cpagination mt-5 text-center'><span class='page-numbers page-num'>Page <b class='text-primary'>" . $paged . "</b> of " . $numpages . "</span><nav class='mt-2' aria-label='Search Results pagination'><ul class='pagination justify-content-center'>";
   $list_class = "page-item ";
   foreach ( $paginate_links as $index=>$page ) {
   	$list_class .= $index == ($paged==1 ? ($paged-1):$paged) ? 'active' : '';
    $custom_pagination .= "<li class='page-item ". $list_class ."'>". str_replace('page-numbers','page-link',$page) ."</li>";
    $list_class = " ";
   }
   $custom_pagination .='</ul></nav></div>';
   echo $custom_pagination;
 }
}
function get_email_body_wpse_96357() {
    $body = '<html><body><p>I am html template</p></body></html>';
    return $body;
}
function clean_custom_menus() {
	$menu_name = 'primary'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<nav>' ."\n";
		$menu_list .= "\t\t\t\t". '<ul>' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
		$menu_list .= "\t\t\t". '</nav>' ."\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}
class Description_Walker extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array|object $args    Additional strings. Actually always an 
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
       
		$object = $item->object;
    	$type = $item->type;
    	$title = $item->title;
    	$description = $item->description;
    	$permalink = $item->url;
      	$output .= "<li class='nav-item'>";
        
      //Add SPAN if no Permalink
      if( $permalink && $permalink != '#' ) {
      	$output .= '<a class="nav-link" href="' . $permalink . '">';
      } else {
      	$output .= '<span>';
      }
       
      $output .= $title;
      if( $description != '' && $depth == 0 ) {
      	$output .= '<small class="description">' . $description . '</small>';
      }
      if( $permalink && $permalink != '#' ) {
      	$output .= '</a>';
      } else {
      	$output .= '</span>';
      }
    }
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    	
    }
}


function debug_to_console( $data, $context = 'Debug in Console' ) {

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info( \'' . $context . ':\' );';
    $output .= 'console.log(' . json_encode( $data ) . ');';
    $output  = sprintf( '<script>%s</script>', $output );

    echo $output;
}


class Social_Walker extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array|object $args    Additional strings. Actually always an 
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
       
		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$description = $item->description;
		$themelocation = $args->theme_location;
		$liclass = $item->attr_title;
		$iconclass = $item->classes[0];
		$iconclass .= ' ' . $item->classes[1];
		$permalink = $item->url;
		$output .= "<li class='".$liclass."'>";
		//Add SPAN if no Permalink
		PC::debug($item);
		if( $permalink && $permalink != '#' ) {
			if(strtolower($title) == 'contact') {
				$output .= '<a href="' . $permalink . '" data-toggle="modal">';
			} else {
				$output .= '<a href="' . $permalink . '">';
			}
			$output .= '<i class="' . $iconclass . '"></i>';
			if($themelocation == 'social') {
				$output .= '<span class="icon-text sr-only">';
			}else {
				$output .= '<span class="icon-text">';
			}

			
		} else {
			$output .= '<span>';
		}

						

		$output .= $title;
		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}
		if( $permalink && $permalink != '#' ) {
			$output .= '</span></a>';
		} else {
			$output .= '</span>';
		}
    }
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    	
    }
}



class TopRightButton_Walker extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array|object $args    Additional strings. Actually always an 
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
       
		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$description = $item->description;
		$themelocation = $args->theme_location;
		$permalink = $item->url;
		$btnClass = $item->classes[0];
		$btnClass .= ' ' . $item->classes[1];
		//Add SPAN if no Permalink
		if( $permalink && $permalink != '#' ) {
			$output .= '<a class="' . $btnClass . '" href="' . $permalink . '">';
			
		} else {
			$output .= '<button class="' . $btnClass . '">';
		}
		
						

		$output .= $title;
		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}
		if( $permalink && $permalink != '#' ) {
			$output .= '</span></a>';
		} else {
			$output .= '</button>';
		}
    }
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    	
    }
}
/* Excerpt Limit Begin */
function ratheme1_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}
require get_parent_theme_file_path( '/inc/customizer.php' );

?>