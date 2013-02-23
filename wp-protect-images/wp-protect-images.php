<?php
/*
Plugin Name: WP Protect Images
Plugin URI: https://github.com/tobias-redmann/wp-notify-subscribers
Description: A brief description of the Plugin.
Version: 0.1
Author: Tobias Redmann
Author URI: http://www.tricd.de
*/


add_action('generate_rewrite_rules', 'wppi_generate_rewrite_rules');
add_filter('mod_rewrite_rules', 'wppi_mod_rewrite_rules');


/**
 * Add a dummy line to rewrite them later
 * 
 * @global type $wp_rewrite
 */
function wppi_generate_rewrite_rules() {
  
  global $wp_rewrite;
  
	$non_wp_rules = array(
		'wp-content/uploads/?$wppi_pattern' => 'wp-content/plugins/wp-protect-images/image.php',
	);

	$wp_rewrite->non_wp_rules = $non_wp_rules + $wp_rewrite->non_wp_rules;
  
}


/**
 * Find the dummy line and replace them
 * 
 * @param type $rules
 * @return type
 */
function wppi_mod_rewrite_rules($rules) {
  
  // FIXME: This is a not that good hack to get it work
  
  $lines = explode("\n", $rules);
  
  foreach($lines as $line_number => $line) {
    
    if (stripos($line, 'RewriteRule ^wp-content/uploads/?$wppi_pattern') !== false) {
      
      $lines[$line_number] = 'RewriteRule ^wp-content/uploads/(.*)$ wp-content/plugins/wp-protect-images/index.php?f=$1';
      
      
    }
    
  }
  
  $rules = implode("\n", $lines);
  
	return $rules;
  
  
}

?>
