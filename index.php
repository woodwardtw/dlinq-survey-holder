<?php 
/*
Plugin Name: DLINQ Survey Holder
Plugin URI:  https://github.com/
Description: For stuff that's magical
Version:     1.0
Author:      DLINQ
Author URI:  https://dlinq.middcreate.net
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_action('wp_footer', 'survey_holder_load_scripts');

function survey_holder_load_scripts() {                           
    $deps = array('jquery');
    $version= '1.0'; 
    $in_footer = true;    
    wp_enqueue_script('survey_holder-main-js', plugin_dir_url( __FILE__) . 'js/survey_holder-main.js', $deps, $version, $in_footer); 
    wp_enqueue_style( 'survey_holder-main-css', plugin_dir_url( __FILE__) . 'css/survey_holder-main.css');
}



add_filter( 'the_content', 'survey_holder_add_to_content', 1 );
 
function survey_holder_add_to_content( $content ) {
    gravity_form_enqueue_scripts(4, true);
    // Check if we're inside the main loop in a single Post.
    if ( is_singular() && in_the_loop() && is_main_query() ) {
      ob_start();
      dynamic_sidebar('survey_holder_widget');
      $widget = ob_get_contents();
      ob_end_clean();
        return $content . "<button id='launch-survey'>feedback?</button>
        <div id='the-survey' class='survey-holder hide'><div class='survey-content'><button id='close-survey'>&#10006; close</button>{$widget}</div></div>";
  } else {
    return $content;
  } 
}


function survey_holder_widgets_init() {

  register_sidebar( array(
    'name'          => 'Survey Holder',
    'id'            => 'survey_holder_widget',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="survey-title">',
    'after_title'   => '</h2>',
  ) );

}
add_action( 'widgets_init', 'survey_holder_widgets_init' );





//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

  //print("<pre>".print_r($a,true)."</pre>");
