<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

use Includes\Modules\Helpers\CleanWP;
use Includes\Modules\Testimonials\Testimonials;
use Includes\Modules\KMAFacebook\FacebookController;

require('vendor/autoload.php');

new CleanWP();

$testimonials = new Testimonials();
$testimonials->createPostType();

$facebook = new FacebookController();
$facebook->setupAdmin();

add_shortcode('testimonials',function(){
	$testimonials = new Testimonials();
	$allTestimonials = $testimonials->getTestimonials([]);
	$output = '';
	foreach($allTestimonials as $testimonial){
		$output .=	'<div class="testimonial">' .
						'<p class="text-center review-text">&ldquo;' . $testimonial['content'] . '&rdquo;</p>' .
						'<p class="text-center review-author">&mdash;' . $testimonial['author'] . ($testimonial['company'] != '' ? ', ' . $testimonial['company'] : '') . '</p>' .
					'</div>';
	}
	return $output;
});

add_shortcode('random_testimonial',function(){
	$testimonials = new Testimonials();
	$testimonial = $testimonials->getRandomTestimonial();
	$output = '<div class="testimonial random">' .
		'<p class="text-center review-text">&ldquo;' . $testimonial['content'] . '&rdquo;</p>' .
		'<p class="text-center review-author">&mdash;' . $testimonial['author'] . ($testimonial['company'] != '' ? ', ' . $testimonial['company'] : '') . '</p>' .
		'</div>';
	return $output;
});

add_shortcode('contact_section', function(){
    ob_start();
	get_template_part('template-parts/sections/footer-contact');
    return ob_get_clean();
});

add_shortcode('work_gallery', function(){
    ob_start();
	if(isset($_GET['albumName']) && $_GET['albumName'] !=''){
        include(locate_template('template-parts/sections/work-album.php'));
	}else{
        include(locate_template('template-parts/sections/work-gallery.php'));
	}
    return ob_get_clean();
});

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'animate-css' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'chld_thm_cfg_parent','vega-wp-style','vega-wp-color' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION
