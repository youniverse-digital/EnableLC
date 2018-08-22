<?php
/**
 * Author: Todd Motto | @toddmotto
 * URL: html5blank.com | @html5blank
 * Custom functions, support, custom post types and more.
 */


/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/



if (!isset($content_width))
{
    $content_width = 1170;
}

if (function_exists('add_theme_support'))
{

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('banner_img', 1170, 500, true); // Banner image
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}


// HTML5 Blank navigation
function footer_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'footer-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}


function about_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'about-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

function work_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'work-with-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        // Scripts minify
        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0');
        // Enqueue Scripts
        wp_enqueue_script('html5blankscripts');
        // Scripts minify
        wp_register_script('owlcarousel', get_template_directory_uri() . '/js/lib/slick.min.js', array(), '1.0.0');
        // Enqueue Scripts
        wp_enqueue_script('owlcarousel');
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        // Conditional script(s)
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0');
        wp_enqueue_script('scriptname');
    }
}

// Load HTML5 Blank styles
function html5blank_styles(){
// 	wp_register_style('html5blankcss', get_template_directory_uri() . '/dale.css', array(), '1.0');
// 	wp_enqueue_style('html5blankcss');
}


// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank'), // Extra Navigation if needed (duplicate as many as you need!)
        'footer-menu' => __('Footer Menu', 'html5blank')
    ));
}

add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;


require_once('wp_bootstrap_navwalker.php');

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'THEMENAME' ),
) );

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)




// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('For the homepage Twitter feed', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts


function new_excerpt_more( $more ) {
    return '... <a class="read-more blog-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}



/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
//remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether



// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

	// define('child_template_directory', dirname( get_bloginfo('stylesheet_url')) );


	// DR debug
	if (!function_exists('mDR_Debug')) {
			function mDR_Debug($dr_msg){
					echo '<p class="dr_debug"><strong>DR debug info: </strong><span>'.$dr_msg.'</span></p>';
			}
	}

    // Load  styles
	function enable_styles() {
		wp_register_style('enablecss', get_stylesheet_directory_uri() . '/style.css', array(), '1.0');
		wp_enqueue_style('enablecss');
		wp_register_style('joecss', get_template_directory_uri() . '/joe.css', array(), '1.0');
		wp_enqueue_style('joecss');
	}
	add_action('wp_enqueue_scripts', 'enable_styles', PHP_INT_MAX); // Add Theme Stylesheet

  // CREATE CUSTOM POST TYPES
  function create_post_type() {
    register_post_type( 'banner',
      array(
        'labels' => array(
          'name' => __( 'Banners' ),
          'singular_name' => __( 'Banner' ),
					'add_new' => __( 'Add New Banner' ),
					'add_new_item' => __( 'Add Banner' ),
					'edit_item' => __( 'Edit Banner' ),
					'new_item' => __( 'Add Banner' ),
					'view_item' => __( 'View Banner' ),
					'search_items' => __( 'Search Banners' ),
					'not_found' => __( 'No Banners' ),
					'not_found_in_trash' => __( 'No Banners found in trash' )
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title')
      )
    );

    register_post_type( 'feature_panels',
      array(
        'labels' => array(
          'name' => __( 'Feature panels' ),
          'singular_name' => __( 'Feature panel' ),
					'add_new' => __( 'Add New Feature panel' ),
					'add_new_item' => __( 'Add Feature panel' ),
					'edit_item' => __( 'Edit Feature panel' ),
					'new_item' => __( 'Add Feature panel' ),
					'view_item' => __( 'View Feature panel' ),
					'search_items' => __( 'Search Feature panels' ),
					'not_found' => __( 'No Feature panels found' ),
					'not_found_in_trash' => __( 'No Feature panels found in trash' )
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title')
      )
    );

    register_post_type( 'job',
      array(
        'labels' => array(
          'name' => __( 'Jobs' ),
          'singular_name' => __( 'Job' ),
					'add_new' => __( 'Add New Job' ),
					'add_new_item' => __( 'Add Job' ),
					'edit_item' => __( 'Edit Job' ),
					'new_item' => __( 'Add Job' ),
					'view_item' => __( 'View Job' ),
					'search_items' => __( 'Search Jobs' ),
					'not_found' => __( 'No Jobs found' ),
					'not_found_in_trash' => __( 'No Jobs found in trash' )
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor')
      )
    );

    register_post_type( 'green_spaces',
      array(
        'labels' => array(
          'name' => __( 'Green Spaces' ),
          'singular_name' => __( 'Green Space' ),
					'add_new' => __( 'Add New Green Space' ),
					'add_new_item' => __( 'Add Green Space' ),
					'edit_item' => __( 'Edit Green Space' ),
					'new_item' => __( 'Add Green Space' ),
					'view_item' => __( 'View Green Space' ),
					'search_items' => __( 'Search Green Spaces' ),
					'not_found' => __( 'No Green Spaces found' ),
					'not_found_in_trash' => __( 'No Green Spaces found in trash' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'green-spaces' ),
        'capability_type' => 'post',
        'supports' => array( 'title', 'editor')
      )
    );
    
    flush_rewrite_rules();

  }
  add_action( 'init', 'create_post_type' );


	// 
	function create_custom_tax() {
		// Add new taxonomy, make it hierarchical (like categories)
		$banner_labels = array(
			'name'              => _x( 'Slide categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Slide category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Slide Categories' ),
			'all_items'         => __( 'All Slide Categories' ),
			'parent_item'       => __( 'Parent Slide Categories' ),
			'parent_item_colon' => __( 'Parent Slide Categories:' ),
			'edit_item'         => __( 'Edit Slide Category' ),
			'update_item'       => __( 'Update Slide Category' ),
			'add_new_item'      => __( 'Add New Slide Category' ),
			'new_item_name'     => __( 'New Slide Category Name' ),
			'menu_name'         => __( 'Slide categories' ),
		);

		$banner_args = array(
			'hierarchical'      => true,
			'has_archive'       => true,
			'labels'            => $banner_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'slide', 'hierarchical' => true, 'with_front' =>false ),
		);

		register_taxonomy( 'slides', array( 'banner' ), $banner_args );
		
 
		// Feature panels ----------------------------------------------------------------------------------
		$feature_labels = array(
			'name'              => _x( 'Feature-panel (FP) categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'FP category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search FP Categories' ),
			'all_items'         => __( 'All FP Categories' ),
			'parent_item'       => __( 'Parent FP Categories' ),
			'parent_item_colon' => __( 'Parent FP Categories:' ),
			'edit_item'         => __( 'Edit FP Category' ),
			'update_item'       => __( 'Update FP Category' ),
			'add_new_item'      => __( 'Add New FP Category' ),
			'new_item_name'     => __( 'New FP Category Name' ),
			'menu_name'         => __( 'Feature-panel (FP) categories' ),
		);

		$feature_args = array(
			'hierarchical'      => false,
			'has_archive'       => true,
			'labels'            => $feature_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'feature_panel', 'hierarchical' => false, 'with_front' =>false ),
		);

		register_taxonomy( 'fpc', array( 'feature_panels' ), $feature_args );
		
 
		// Jobs ----------------------------------------------------------------------------------
		$job_labels = array(
			'name'              => _x( 'Job categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Job category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Job Categories' ),
			'all_items'         => __( 'All Job Categories' ),
			'parent_item'       => __( 'Parent Job Categories' ),
			'parent_item_colon' => __( 'Parent Job Categories:' ),
			'edit_item'         => __( 'Edit Job Category' ),
			'update_item'       => __( 'Update Job Category' ),
			'add_new_item'      => __( 'Add New Job Category' ),
			'new_item_name'     => __( 'New Job Category Name' ),
			'menu_name'         => __( 'Job categories' ),
		);

		$job_args = array(
			'hierarchical'      => false,
			'has_archive'       => true,
			'labels'            => $job_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'feature_panel', 'hierarchical' => false, 'with_front' =>false ),
		);

		register_taxonomy( 'jobs', array( 'job' ), $job_args );
 
		// Green Spaces ----------------------------------------------------------------------------------
		$gs_labels = array(
			'name'              => _x( 'Green Space categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Green Space category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Green Space Categories' ),
			'all_items'         => __( 'All Green Space Categories' ),
			'parent_item'       => __( 'Parent Green Space Categories' ),
			'parent_item_colon' => __( 'Parent Green Space Categories:' ),
			'edit_item'         => __( 'Edit Green Space Category' ),
			'update_item'       => __( 'Update Green Space Category' ),
			'add_new_item'      => __( 'Add New Green Space Category' ),
			'new_item_name'     => __( 'New Green Space Category Name' ),
			'menu_name'         => __( 'Green Space categories' ),
		);

		$gs_args = array(
			'hierarchical'      => true,
			'has_archive'       => true,
			'labels'            => $gs_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'green_spaces', 'hierarchical' => true, 'with_front' =>false ),
		);

		register_taxonomy( 'green', array( 'green_spaces' ), $gs_args );
 
	}
	add_action( 'init', 'create_custom_tax', 0 );



  // CREATE TOP ACCESSIBILITY MENU
  function accessmenu() {
    wp_nav_menu(
    array(
        'theme_location'  => 'access-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
  }

  function register_enable_menu(){
    register_nav_menus(array( // Using array to specify more menus if needed
        'find_service' => __('Find Services menu', 'enable'),
        'about_us' => __('About us menu', 'enable'),
        'work-with-menu' => __('Work With Us Menu', 'enable'),
        'access-menu' => __('Access Menu', 'enable'),
        'filming' => __('Filming Menu', 'enable'),
        'public_halls' => __('Public Halls Menu', 'enable'),
        'putney' => __('Putney School Menu', 'enable'),
        'arts' => __('Arts Menu', 'enable'),
        'events' => __('Events Menu', 'enable'),
        'bereavement' => __('Bereavement Menu', 'enable'),
        'parks' => __('Parks Menu', 'enable'),
        'leisure_and_sport' => __('Sport and Leisure menu', 'enable'),
        'film_services' => __('Film Services page menu', 'enable'),
        'putney_about' => __('Putney About Us Sidebar Menu', 'enable'),
        'bereavement_sidebar' => __('Bereavement Sidebar Menu', 'enable')
    ));
  }
  add_action('init', 'register_enable_menu'); 
  
  

// get taxonomies terms links
function custom_taxonomies_terms_links(){
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = "<h2>" . $taxonomy->label . "</h2>\n<ul>";
      foreach ( $terms as $term ) {
        $out[] =
          '  <li><a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a></li>\n";
      }
      $out[] = "</ul>\n";
    }
  }

  return implode('', $out );
}


/*
    BUTTONS SHORTCODES

 */


function rounded_btns ($btns) {
    extract( shortcode_atts( array(
      'text' => 'text',
      'url' => 'url',
      'type' => 'type' 
    ), $btns ) );
    
    if ($type == 'weblink'){
			$type .= ' new_window'; 
    }
    
    return '<p><a href="'.$url.'" class="rounded-btn rb_'.$type.'">'.$text.'</a></p>';
}
add_shortcode('round_btn', 'rounded_btns'); 

function add_strapline ($strap) {
    extract( shortcode_atts( array(
      'text' => 'text'
    ), $strap ) );
    return '<p class="enable_strapline">'.$text.'</p>';
}
add_shortcode('strapline', 'add_strapline'); 

function add_caption ($caption) {
    extract( shortcode_atts( array(
      'text' => 'text'
    ), $caption ) );
    return '<p class="image_caption">'.$text.'</p>';
}
add_shortcode('image_caption', 'add_caption'); 


/*------------------------------------*\
     Columns Shortcode
\*------------------------------------*/
// Example Usage
/*
    [start_column_row]
    [start_column mobile="" tablet="" desktop="" class=""][end_column]
    [end_column_row]
*/

function boostrap_start_row() {
    return '<div class="row">';
}
add_shortcode('start_column_row', 'boostrap_start_row');    

function boostrap_start_columns($columns) {
    extract( shortcode_atts( array(
      'desktop' => 'desktop', // Desktop Columns (Maximum of 6)
      'tablet' => 'tablet', // Tablet Columns (Maximum of 6)
      'mobile' => 'mobile', // Mobile Columns (Maximum of 6)
      'class' => 'class', // Custom Class
    ), $columns ) );    

    $columnCount = array(
      "1" => 12, // 1 column
      "2" => 6, // 2 columns
      "2.5" => 8,
      "3" => 4, // 3 columns
      "4" => 3, // 4 columns
      "5" => 2, // 5 columns
      "6" => 2,  // 6 columns
      "12" => 1  // 12 columns
    );

    if($desktop){
        $colDesktop = "col-md-".$columnCount[$desktop];
    }
    if($tablet){
        $colTablet = "col-sm-".$columnCount[$tablet];   
    }
    if($mobile){
        $colMobile = "col-xs-".$columnCount[$mobile];   
    }    

    return '<div class="' . $class . ' ' . $colMobile . ' ' . $colTablet . ' ' . $colDesktop . '">';
}
add_shortcode('start_column', 'boostrap_start_columns');

// End column
function boostrap_end_column() {
    return "</div>";
}
add_shortcode('end_column', 'boostrap_end_column');

function boostrap_end_column_row() {
    return "</div>";
}
add_shortcode('end_column_row', 'boostrap_end_column_row');


/*------------------------------------*\
    OHP Accordions Shortcode
\*------------------------------------*/
// Example Usage
/*
    [accordion_start id=""]
        [accordion title="" id="" parent="" open="1"]
        ** Content Goes Here **
        [end_accordion]
    [accordion_end]
*/  

function accordion_start($accordion_title) {
    extract( shortcode_atts( array(
      'id' => 'id' // This is the ID of the accordion grouping
    ), $accordion_title ) );

    return '<div class="panel-group" id="'.$id.'">';
}
add_shortcode('accordion_start', 'accordion_start');

function accordion($accordion) {
    extract( shortcode_atts( array(
      'id' => 'id',
      'title' => 'title',
      'parent' => 'parent',
      'open' => 'open'
    ), $accordion ) );

    if($selected == 1){
        $selected = "active";
    }
    
    if($open == 1){
        $open = "true";
        $openClass = "in";
        $collapsed = 'collapsed';
    }
    else{
        $open = "false";
        $collapsed = '';
    }

    return '<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading_'.$id.'">'.
    '<h3 class="panel-title"><a class="accordion-toggle '.$collapsed.'" data-toggle="collapse" aria-controls="'.$id.'" data-parent="#'.$parent.'" href="#'.$id.'"'.
    'aria-expanded="'.$open.'"><span>'.$title.'</span></a></h3></div>'.
    '<div id="'.$id.'" class="panel-collapse collapse '.$openClass.'" role="tabpanel" aria-labelledby="heading_'.$id.'" aria-expanded="'.$open.'"><div class="panel-body">';
}
add_shortcode('accordion', 'accordion');

function end_accordion() {
    return '</div></div></div>';    
}
add_shortcode('end_accordion', 'end_accordion');

function accordion_end() {
    return '</div>';    
}
add_shortcode('accordion_end', 'accordion_end');



// add site options page 
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}


// add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
// function add_search_box_to_menu( $items, $args ) {
// 	if( $args->theme_location == 'access-menu' ){
// 		$items .= '<li class="search"><a href="#" class="open-search">Search</a></li>';
// 		$items .= '<li class="feedback-form"><a href="#" class="open-feedback-form">Feedback</a>';
// 	}
// 	//return $items.get_search_form();

// 	return $items;
// }


// Breadcrumbs
function custom_breadcrumbs() {
      
    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
     
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
      
    // Get the query & post information
    global $post,$wp_query;
      
    // Do not display on the homepage
   // if ( !is_front_page() ) {
      
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
          
        // Home page
        echo '<li>You are here: </li><li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
          
        if(is_home() ){
            echo '<li class="item-current item-archive">News</li>';
        }else if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
             
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title() . '</strong></li>';
             
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
             
            }
             
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
             
        } else if ( is_single() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
             
            }
             
            // Get post category info
            $category = get_the_category();


             
            // Get last category post is in
            //$last_category = end(array_values($category));
             
            //Get parent any categories and create array
            $get_cat_parents = get_category_parents($category->term_id, true, ',');
            // $cat_parents = explode(',',$get_cat_parents);
             
            // Loop through parent categories and store in variable $cat_display
            $cat_display = '';
            // foreach($cat_parents as $parents) {
            //     $cat_display .= '<li class="item-cat">'.$parents.'</li>';
            //     $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
            // }
             
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                  
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
              
            }
             
            // Check if the post is in a category
            if(!empty($category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                 
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                 
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
             
            } else {
                 
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                 
            }
             
        } else if ( is_category() ) {
              
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
              
        } else if ( is_page() ) {
              
            // Standard page
            if( $post->post_parent ){
                  
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                  
                // Get parents in the right order
                $anc = array_reverse($anc);
                  
                // Parent page loop
                $parents = '';
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                  
                // Display parent pages
                echo $parents;
                  
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                  
            } else {
                  
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_tag() ) {
              
            // Tag page
              
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
              
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
          
        } elseif ( is_day() ) {
              
            // Day archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
              
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
              
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
              
        } else if ( is_month() ) {
              
            // Month Archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
              
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
              
        } else if ( is_year() ) {
              
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
              
        } else if ( is_author() ) {
              
            // Auhor archive
              
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
              
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
          
        } else if ( get_query_var('paged') ) {
              
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
              
        } else if ( is_search() ) {
          
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
          
        } elseif ( is_404() ) {
              
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
      
        echo '</ul>';
          
   // }
      
}


function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}



// draw a calendar for the events page 
function draw_calendar($month,$year){

    $multiday_events = [];


    /* draw table */
    $monthNum  = $month;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);   
    $monthName = $dateObj->format('F'); 


    $calendar = '<h2 class="calendar-month">'.$monthName.' '.$year.'</h2><table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $calendar.= '<tr class="calendar-row calendar-header"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td class="calendar-day">';
            /* add in the day number */
            

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
            
            //$today = getdate();

            $args = array(
                'category_name' => 'events',
                'posts_per_page' => -1,
                'year' => $year,
                'monthnum' => $month,
                'day' => $list_day
            );

            //$posts = get_posts($args);
            //echo $posts;
            $my_query = new WP_Query($args);




            




            if ( $my_query->have_posts() ) {
                $calendar.= '<div class="day-container">';
                $calendar.= '<div class="day-number">'.$list_day.'</div>';
                
                while ($my_query->have_posts()) : $my_query->the_post();
                    // $do_not_duplicate = $post->ID;
                    $post_class =  implode(" ", get_post_class());
                    $link = get_permalink();
                    $calendar.= '<a href="#" class="has-event '. $post_class .'" id="post-'.get_the_ID ().'"> '. get_the_title() .' </a>';
                    $calendar.= '<div class="hidden-calendar-poup"><h2>'.get_the_title().'</h2><div>'. get_the_content_with_formatting().'</div></div>';

                    if (get_field('event_end_date')) {
                        $end_date_unix = strtotime(str_replace('/', '-', get_field('event_end_date')));
                        $end_date = new DateTime;
                        $end_date->setTimestamp($end_date_unix);

                        array_push($multiday_events, get_the_ID());

                        $calendar.= $diff;   
                    }
                
                endwhile;

                wp_reset_postdata();

                
            }else {


                //now do future events
                $args = array(
                    'category_name' => 'events',
                    'post_status' => 'future',
                    'posts_per_page' => -1,
                    'year' => $year,
                    'monthnum' => $month,
                    'day' => $list_day
                );

                $my_query = new WP_Query($args);

                $calendar.= '<div class="day-container">';
                $calendar.= '<div class="day-number">'.$list_day.'</div>';

                

                if ( $my_query->have_posts() ) {
                    
                    
                    while ($my_query->have_posts()) : $my_query->the_post();
                        //$do_not_duplicate = $post->ID;
                        $post_class =  implode(" ", get_post_class());
                        $link = get_permalink();
                        $calendar.= '<a href="#" class="has-event '. $post_class .'" id="post-'.get_the_ID ().'"> '. get_the_title() .' </a>';
                        $calendar.= '<div class="hidden-calendar-poup"><h2>'.get_the_title().'</h2><div>'. get_the_content_with_formatting().'</div></div>';

                        if (get_field('event_end_date')) {

                        }
                    endwhile;
                    
                    wp_reset_postdata();
                }

                

            }

            if(!empty($multiday_events)) {
                    foreach($multiday_events as $event) {

                        
                        $event_post = get_post($event);
                        global $post;
                        $post = $event_post;
                        setup_postdata($post);

                        $working_date = $list_day . '-' . $month . '-' . $year;

                        $end_date_unix = strtotime(str_replace('/', '-', get_field('event_end_date')));
                        $working_date_unix = strtotime($working_date);


                        if ($end_date_unix >= $working_date_unix) {
                            if (strtotime($working_date) != strtotime(get_the_date())) {
                                $post_classes =  implode(" ", get_post_class("", $event_post->ID));
                                $link = get_permalink($event_post->ID);
                                $calendar.= '<a href="#" class="has-event '. $post_classes .'" id="post-'. $event_post->ID .'"> '. get_the_title($event_post->ID) .' </a>';
                                $calendar.= '<div class="hidden-calendar-poup"><h2>'.get_the_title($event_post->ID).'</h2><div>'. $event_post->post_content .'</div></div>';
                            }
                        }

                        

                        wp_reset_postdata();

                    }

                }

                $calendar.= '</div>';
            

            



            // if($posts){
            //  foreach ( $posts as $post ) : setup_postdata( $post ); 

            //      $link = get_permalink();
            
            //      $calendar.= '<a href="'. $link .'"> Event </a>';
                
            //      //echo $list_day;
            
            //  endforeach; 
            // }else {
                
            //  //echo 'this is the future posts';
            //  wp_reset_postdata();
            //  $args = array(
            //      'category_name' => 'events',
            //      'post_status' => 'future',
            //      'posts_per_page' => -1,
            //      'year' => $year,
            //      'monthnum' => $month,
            //      'day' => $list_day
            //  );

            //  $posts = get_posts($args);

            //  foreach ( $posts as $post ) : setup_postdata( $post ); 

            //      $link = get_permalink();
            
            //      $calendar.= '<a href="'. $link .'"> Event date: '.$list_day.' </a>';
            //      //the_title();
                
            //      //echo $list_day;
            
            //  endforeach; 

            // }


            //echo '<p>Hit</p>';
            
            //wp_reset_postdata();
            

            

            $calendar.= str_repeat('<p> </p>',2);
            
        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';
    
    /* all done, return result */
    return $calendar;



    // Always die in functions echoing ajax content
   //die();

}




/// ability to scroll through next and previous months of the calendar
/// 
/// // Make sure it runs when the user is logged in,
// and when they are not.
add_action('wp_ajax_my_unique_action', 'get_offset');
add_action('wp_ajax_nopriv_my_unique_action', 'get_offset');

function get_offset() {

    $multiday_events = [];

  if( isset($_POST['newmonth']) ) {
     $month = $_POST['newmonth'];
     $year = $_POST['newyear'];
    // if($chosenMonth){
    //     $month = $chosenMonth;
    // }

    //echo '<h1>Month is now:' . $chosenMonth . '</h1>'; 

    /* draw table */

    $monthNum  = $month;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);   
    $monthName = $dateObj->format('F'); 

    $calendar = '<h2 class="calendar-month">'.$monthName.' '.$year.'</h2><table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $calendar.= '<tr class="calendar-row calendar-header"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td class="calendar-day">';
            /* add in the day number */
            

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
            
            //$today = getdate();

           $args = array(
                'category_name' => 'events',
                'posts_per_page' => -1,
                'year' => $year,
                'monthnum' => $month,
                'day' => $list_day
            );

            //$posts = get_posts($args);
            //echo $posts;
            $my_query = new WP_Query($args);
            if ( $my_query->have_posts() ) {
                $calendar.= '<div class="day-container">';
                $calendar.= '<div class="day-number">'.$list_day.'</div>';
                
                while ($my_query->have_posts()) : $my_query->the_post();
                    // $do_not_duplicate = $post->ID;
                    $post_class =  implode(" ", get_post_class());
                    $link = get_permalink();
                    $calendar.= '<a href="#" class="has-event '. $post_class .'" id="post-'.get_the_ID ().'"> '. get_the_title() .' </a>';
                    $calendar.= '<div class="hidden-calendar-poup"><h2>'.get_the_title().'</h2>'. get_the_content_with_formatting() .'</div>';

                    if (get_field('event_end_date')) {
                        $end_date_unix = strtotime(str_replace('/', '-', get_field('event_end_date')));
                        $end_date = new DateTime;
                        $end_date->setTimestamp($end_date_unix);

                        array_push($multiday_events, get_the_ID());

                        $calendar.= $diff;   
                    }

                endwhile;

                wp_reset_postdata();
            }else {


                //now do future events
                $args = array(
                    'category_name' => 'events',
                    'post_status' => 'future',
                    'posts_per_page' => -1,
                    'year' => $year,
                    'monthnum' => $month,
                    'day' => $list_day
                );

                $working_date = $list_day . '-' . $month . '-' . $year;

                $my_query = new WP_Query($args);
                if ( $my_query->have_posts() ) {
                    
                    $calendar.= '<div class="day-container">';
                    $calendar.= '<div class="day-number">'.$list_day.'</div>';
                    while ($my_query->have_posts()) : $my_query->the_post();
                        //$do_not_duplicate = $post->ID;
                        $post_class =  implode(" ", get_post_class());
                        $link = get_permalink();
                        $calendar.= '<a href="#" class="has-event '. $post_class .'" id="post-'.get_the_ID ().'"> '. get_the_title() .' </a>';
                        $calendar.= '<div class="hidden-calendar-poup"><h2>'.get_the_title().'</h2><div>'. get_the_content_with_formatting() .'</div></div>';
                    endwhile;

                    wp_reset_postdata();
                }else {
                    $calendar.= '<div class="day-container">';
                    $calendar.= '<div class="day-number">'.$list_day.'</div>';
                }
            
            }

            if(!empty($multiday_events)) {
                    foreach($multiday_events as $event) {

                        
                        $event_post = get_post($event);
                        global $post;
                        $post = $event_post;
                        setup_postdata($post);

                        $working_date = $list_day . '-' . $month . '-' . $year;

                        $end_date_unix = strtotime(str_replace('/', '-', get_field('event_end_date')));
                        $working_date_unix = strtotime($working_date);


                        if ($end_date_unix >= $working_date_unix) {
                            if (strtotime($working_date) != strtotime(get_the_date())) {
                                $post_classes =  implode(" ", get_post_class("", $event_post->ID));
                                $link = get_permalink($event_post->ID);
                                $calendar.= '<a href="#" class="has-event '. $post_classes .'" id="post-'. $event_post->ID .'"> '. get_the_title($event_post->ID) .' </a>';
                                $calendar.= '<div class="hidden-calendar-poup"><h2>'.get_the_title($event_post->ID).'</h2><div>'. $event_post->post_content .'</div></div>';
                            }
                        }

                        

                        wp_reset_postdata();
                        
                    }
                    $calendar.= '</div>';
                }
            

            

            // if($posts){
            //  foreach ( $posts as $post ) : setup_postdata( $post ); 

            //      $link = get_permalink();
            
            //      $calendar.= '<a href="'. $link .'"> Event </a>';
                
            //      //echo $list_day;
            
            //  endforeach; 
            // }else {
                
            //  //echo 'this is the future posts';
            //  wp_reset_postdata();
            //  $args = array(
            //      'category_name' => 'events',
            //      'post_status' => 'future',
            //      'posts_per_page' => -1,
            //      'year' => $year,
            //      'monthnum' => $month,
            //      'day' => $list_day
            //  );

            //  $posts = get_posts($args);

            //  foreach ( $posts as $post ) : setup_postdata( $post ); 

            //      $link = get_permalink();
            
            //      $calendar.= '<a href="'. $link .'"> Event date: '.$list_day.' </a>';
            //      //the_title();
                
            //      //echo $list_day;
            
            //  endforeach; 

            // }


            //echo '<p>Hit</p>';
            
            //wp_reset_postdata();
            

            

            $calendar.= str_repeat('<p> </p>',2);
            
        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';
    
    /* all done, return result */
    echo $calendar;

  }

  //die;
}



// function remove_editor_init() {
// 	// If not in the admin, return.
// 	if ( ! is_admin() ) {
// 		 return;
// 	}
// 
// 	// Get the post ID on edit post with filter_input super global inspection.
// 	$current_post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );
// 	// Get the post ID on update post with filter_input super global inspection.
// 	$update_post_id = filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT );
// 
// 	// Check to see if the post ID is set, else return.
// 	if ( isset( $current_post_id ) ) {
// 		 $post_id = absint( $current_post_id );
// 	} else if ( isset( $update_post_id ) ) {
// 		 $post_id = absint( $update_post_id );
// 	} else {
// 		 return;
// 	}
// 
// 	// Don't do anything unless there is a post_id.
// 	if ( isset( $post_id ) ) {
// 		// Get the template of the current post.
// 		$template_file = get_post_meta( $post_id, '_wp_page_template', true );
// 
// 		// Example of removing page editor for page-your-template.php template.
// 		if ( 'homepage.php' === $template_file ) {
// 			 remove_post_type_support( 'page', 'editor' );
// 			 // Other features can also be removed in addition to the editor. See: https://codex.wordpress.org/Function_Reference/remove_post_type_support.
// 		}
// 	}
// }
// add_action( 'init', 'remove_editor_init' );


/**
 * Recent_Posts widget w/ category exclude class
 * This allows specific Category IDs to be removed from the Sidebar Recent Posts list
 *
 */
class WP_Widget_Recent_Posts_Exclude extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site") );
        parent::__construct('recent-posts', __('Recent Posts with Exclude'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
        $exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

        $r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__not_in' => explode(',', $exclude) ));
        if ($r->have_posts()) :
?>
        <?php //echo print_r(explode(',', $exclude)); ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <ul>
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
        <li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
        <?php endwhile; ?>
        </ul>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['exclude'] = strip_tags( $new_instance['exclude'] );
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $exclude = esc_attr( $instance['exclude'] );
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
        <p>
            <label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude Category(s):' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Category IDs, separated by commas.' ); ?></small>
        </p>
<?php
    }
}

function WP_Widget_Recent_Posts_Exclude_init() {
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('WP_Widget_Recent_Posts_Exclude');
}

add_action('widgets_init', 'WP_Widget_Recent_Posts_Exclude_init');



function get_first_image( $content ) {
    $first_img = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    $first_img = $matches[1][0];

    if (empty($first_img)) {
        $img_data = array(
            'img_url'   => '',
            'img_class' => 'no-img'
        );
    } else {
        $img_data = array(
            'img_url'   => $first_img,
            'img_class' => 'img'
        );
    }

    

    return $img_data;
}

?>