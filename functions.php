<?php

require_once(__DIR__ . '/vendor/autoload.php');

class mySite extends Timber\Site {
    public function __construct() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );

        add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
        
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );

        // register image sizes (for theme)
        add_action( 'after_setup_theme', array( $this,'kal_custom_add_image_sizes') );

        // Register custom image sizes for use inside post editor.
        // The custom sizes will appear in the drop-down for image size in block settings sidebar.
        add_filter( 'image_size_names_choose', array( $this,'kal_register_custom_image_sizes') );

        parent::__construct();
    }

    function kal_custom_add_image_sizes() {
      add_image_size( 'medium300w', 300, 450 );
      add_image_size( 'medium333w250h', 333, 250 );
      add_image_size( 'medium200w', 200, 350 );
      add_image_size( 'medium150w', 150, 275 );
    }

    function kal_register_custom_image_sizes( $sizes ) {
        return array_merge( $sizes, array(
          'medium150w' => __( 'Medium, 150w' ),
          'medium200w' => __( 'Medium, 200w' ),
            'medium300w' => __( 'Medium, 300w' ),
            'medium333x250' => __( 'Medium, 333x250' ),
        ) );
    }

    function add_to_context( $context ) {
        $context['menu'] = new Timber\Menu('main-menu');
        $context['site'] = $this;

        return $context;
    }
}

new mySite();


if ( !is_admin() ) wp_deregister_script('jquery');

/*
add_filter('script_loader_src','add_nonce_to_script',10,2);
function add_nonce_to_script($src, $handle){
   $my_nonce = wp_create_nonce('nonce-'.rand());
   return $src.' nonce= '.$my_nonce;
}
*/

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );





// ========================================================
// Create custom post types
// ========================================================

function create_posttypes() {

    register_post_type( 'project',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'projects'),
            'show_in_rest' => true,
            'taxonomies' => array('category', 'post_tag'),
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' )
        )
    );




}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttypes' );



function sc_taglist($atts){
  //var tagOutput = '<div class="tags">' . get_the_tag_list() . '</div>';

  if ( ! empty( $atts['postid'] ) ) {
        $postid = $atts['postid'];

        $postTags = get_the_tags($postid);

        if ($postTags) {
              foreach ($postTags as $tag) {
                    $output .= '<div>' . $tag->name  . '</div>';
                }
        } else {
                  $output = '';
        }
        return $output;



    } else {
        return '<div class="tags">' . get_the_tag_list() . '</div>';
    }
}
add_shortcode('tags', 'sc_taglist');


/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

?>