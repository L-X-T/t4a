<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

/************
ADD WALKER
************/
class t4a_Walker extends Walker_Nav_Menu {
  // Displays start of an element. E.g '<li> Item Name'
  /**
   * Starts the element output.
   *
   * @since 3.0.0
   * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
   *
   * @see Walker::start_el()
   *
   * @param string   $output Used to append additional content (passed by reference).
   * @param WP_Post  $item   Menu item data object.
   * @param int      $depth  Depth of menu item. Used for padding.
   * @param stdClass $args   An object of wp_nav_menu() arguments.
   * @param int      $id     Current item ID.
   */
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    /**
     * Filters the arguments for a single nav menu item.
     *
     * @since 4.4.0
     *
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param WP_Post  $item  Menu item data object.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

    // var_dump( wp_get_nav_menu_items($item->ID) );

    // die( the_title() );

    // add active classes to product productsCats
    $productsCatId = 0;
    $productsCats = get_the_terms( get_the_ID(), 'product_cat' );
    if (!empty($productsCats) && is_array($productsCats) && $item->object_id && get_field('product_cat', $item->object_id)) {

    $productsCatId = $productsCats[0]->term_id;

      /*
      if ($productsCats[0]->parent != 0) {
            $productsCatId = $productsCats[0]->parent;
      } else {
            $productsCatId = $productsCats[0]->term_id;
      }
      */
      //var_dump( get_the_terms( get_the_ID(), 'product_cat' ) );
      if ($productsCatId == get_field('product_cat', $item->object_id)) {
        $classes[] = 'current-menu-item current_page_item';
        // die( the_title() );
      }
    }


    /**
     * Filters the CSS class(es) applied to a menu item's list item element.
     *
     * @since 3.0.0
     * @since 4.1.0 The `$depth` parameter was added.
     *
     * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
     * @param WP_Post  $item    The current menu item.
     * @param stdClass $args    An object of wp_nav_menu() arguments.
     * @param int      $depth   Depth of menu item. Used for padding.
     */
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    /**
     * Filters the ID applied to a menu item's list item element.
     *
     * @since 3.0.1
     * @since 4.1.0 The `$depth` parameter was added.
     *
     * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
     * @param WP_Post  $item    The current menu item.
     * @param stdClass $args    An object of wp_nav_menu() arguments.
     * @param int      $depth   Depth of menu item. Used for padding.
     */
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names .'>';

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

    /**
     * Filters the HTML attributes applied to a menu item's anchor element.
     *
     * @since 3.6.0
     * @since 4.1.0 The `$depth` parameter was added.
     *
     * @param array $atts {
     *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
     *
     *     @type string $title  Title attribute.
     *     @type string $target Target attribute.
     *     @type string $rel    The rel attribute.
     *     @type string $href   The href attribute.
     * }
     * @param WP_Post  $item  The current menu item.
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
      if ( ! empty( $value ) ) {
        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    /** This filter is documented in wp-includes/post-template.php */
    $title = apply_filters( 'the_title', $item->title, $item->ID );

    /**
     * Filters a menu item's title.
     *
     * @since 4.4.0
     *
     * @param string   $title The menu item's title.
     * @param WP_Post  $item  The current menu item.
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    /**
     * Filters a menu item's starting output.
     *
     * The menu item's starting output only includes `$args->before`, the opening `<a>`,
     * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
     * no filter for modifying the opening and closing `<li>` for a menu item.
     *
     * @since 3.0.0
     *
     * @param string   $item_output The menu item's starting HTML output.
     * @param WP_Post  $item        Menu item data object.
     * @param int      $depth       Depth of menu item. Used for padding.
     * @param stdClass $args        An object of wp_nav_menu() arguments.
     */
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

/*****
MOBILE
*****/

class t4a_m_Walker extends Walker_Nav_Menu {
  // Displays start of an element. E.g '<li> Item Name'
  /**
   * Starts the element output.
   *
   * @since 3.0.0
   * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
   *
   * @see Walker::start_el()
   *
   * @param string   $output Used to append additional content (passed by reference).
   * @param WP_Post  $item   Menu item data object.
   * @param int      $depth  Depth of menu item. Used for padding.
   * @param stdClass $args   An object of wp_nav_menu() arguments.
   * @param int      $id     Current item ID.
   */
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    /**
     * Filters the arguments for a single nav menu item.
     *
     * @since 4.4.0
     *
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param WP_Post  $item  Menu item data object.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

    // var_dump( wp_get_nav_menu_items($item->ID) );

    // die( the_title() );

    // add active classes to product productsCats
    $productsCatId = 0;
    $productsCats = get_the_terms( get_the_ID(), 'product_cat' );
    if (!empty($productsCats) && is_array($productsCats) && $item->object_id && get_field('product_cat', $item->object_id)) {

    $productsCatId = $productsCats[0]->term_id;

      /*
      if ($productsCats[0]->parent != 0) {
            $productsCatId = $productsCats[0]->parent;
      } else {
            $productsCatId = $productsCats[0]->term_id;
      }
      */
      //var_dump( get_the_terms( get_the_ID(), 'product_cat' ) );
      if ($productsCatId == get_field('product_cat', $item->object_id)) {
        $classes[] = 'current-menu-item current_page_item';
        // die( the_title() );
      }
    }


    /**
     * Filters the CSS class(es) applied to a menu item's list item element.
     *
     * @since 3.0.0
     * @since 4.1.0 The `$depth` parameter was added.
     *
     * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
     * @param WP_Post  $item    The current menu item.
     * @param stdClass $args    An object of wp_nav_menu() arguments.
     * @param int      $depth   Depth of menu item. Used for padding.
     */
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    /**
     * Filters the ID applied to a menu item's list item element.
     *
     * @since 3.0.1
     * @since 4.1.0 The `$depth` parameter was added.
     *
     * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
     * @param WP_Post  $item    The current menu item.
     * @param stdClass $args    An object of wp_nav_menu() arguments.
     * @param int      $depth   Depth of menu item. Used for padding.
     */
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names .'>';

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

    /**
     * Filters the HTML attributes applied to a menu item's anchor element.
     *
     * @since 3.6.0
     * @since 4.1.0 The `$depth` parameter was added.
     *
     * @param array $atts {
     *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
     *
     *     @type string $title  Title attribute.
     *     @type string $target Target attribute.
     *     @type string $rel    The rel attribute.
     *     @type string $href   The href attribute.
     * }
     * @param WP_Post  $item  The current menu item.
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
      if ( ! empty( $value ) ) {
        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    /** This filter is documented in wp-includes/post-template.php */
    $title = apply_filters( 'the_title', $item->title, $item->ID );

    /**
     * Filters a menu item's title.
     *
     * @since 4.4.0
     *
     * @param string   $title The menu item's title.
     * @param WP_Post  $item  The current menu item.
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    /**
     * Filters a menu item's starting output.
     *
     * The menu item's starting output only includes `$args->before`, the opening `<a>`,
     * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
     * no filter for modifying the opening and closing `<li>` for a menu item.
     *
     * @since 3.0.0
     *
     * @param string   $item_output The menu item's starting HTML output.
     * @param WP_Post  $item        Menu item data object.
     * @param int      $depth       Depth of menu item. Used for padding.
     * @param stdClass $args        An object of wp_nav_menu() arguments.
     */
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'full-width', 1920, 1280, true );
add_image_size( 'two-thirds', 1280, 960, true );
add_image_size( 'half-width', 960, 640, true );
add_image_size( 'portrait', 640, 1280, true );
add_image_size( 'product_zoom', 1200, 1200, false );
add_image_size( 'product', 640, 640, false );
add_image_size( 'product_thumb', 320, 320, false );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'full-width' => __('Full width - 1920 x 1440'),
        'two-thirds' => __('Two thirds - 1280 x 960'),
        'half-width' => __('Half width - 960 x 720'),
        'portrait' => __('Portrait - 1280 x 720'),
        'product_zoom' => __('Product - 1200 x 1200, no crop'),
        'product' => __('Product - 640 x 640, no crop'),
        'product_thumb' => __('Product Thumb - 380 x 380, no crop'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/*
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.

function bones_fonts() {
  wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}
*/
add_action('wp_enqueue_scripts', 'bones_fonts');


function get_menu_by_location( $location ) {
	if( empty($location) ) return false;

	$locations = get_nav_menu_locations();
	if( ! isset( $locations[$location] ) ) return false;

	$menu_obj = get_term( $locations[$location], 'nav_menu' );

	return $menu_obj;
}


// add woocommerce theme support
add_action( 'after_setup_theme', 'theme_support' );
function theme_support() {
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array('search-form'));
	add_theme_support('woocommerce');
}

/*
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'EUR': $currency_symbol = 'EURO'; break;
     }
     return $currency_symbol;
}
*/

// disable stupid stuff
add_action( 'init', 'disable_json_feed_emojicons' );
function disable_json_feed_emojicons() {
	// all actions related to json
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);

	// filter to disable xmlrpc and json
	add_filter('xmlrpc_enabled', '__return_false');
	add_filter('json_enabled', '__return_false');
	add_filter('json_jsonp_enabled', '__return_false');

	// all actions related to feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );

	// all actions related to emojis
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');

	// filter to remove TinyMCE emojis
	add_filter('emoji_svg_url', '__return_false');
}


// add product col style class
add_filter( 'post_class', 'product_col_style' );
function product_col_style( $classes ) {
	global $post;
	if ($post->post_type === 'product') {
		$classes[] = 'style-' . get_field('pro-layout', $post->ID);
    }
	return $classes;
}


// let editors edit the menu
$role = get_role( 'shop_manager' );
$role->add_cap( 'edit_theme_options' );


//remove link from single product_thumb
add_filter('woocommerce_single_product_image_thumbnail_html','wc_remove_link_on_thumbnails' );

function wc_remove_link_on_thumbnails( $html ) {
     return strip_tags( $html,'<div><img>' );
}

// custom t4a skin for elementor posts widget
add_action( 'elementor/widget/posts/skins_init', function( $widget ) {
	require_once( 'elementor/skin-custom.php' );
	$widget->add_skin( new ElementorPro\Modules\Posts\Skins\Skin_Custom( $widget ) );
}, 10, 1);

/* DON'T DELETE THIS CLOSING TAG */ ?>
