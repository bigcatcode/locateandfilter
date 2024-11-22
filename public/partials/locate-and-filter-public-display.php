<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://monothemes.com/
 * @since      1.0.0
 *
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/public/partials
 */
?>


<?php 

/* Outputs layout */
$template = str_replace(
    array("[map]", "[navlist]", "[filters]"),
    array(
        "[LocateAndFilter_map map_id=" . esc_attr($map_id) . "]",
        "[LocateAndFilter_navlist map_id=" . esc_attr($map_id) . "]",
        "[LocateAndFilter_filters map_id=" . esc_attr($map_id) . "]"
    ),
    $template
);

// Remove filters for compatibility with other plugins
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'badgeos_reformat_entries', 9);
remove_filter('the_content', 'bp_replace_the_content');

// Apply 'the_content' filter
$filtered_content = apply_filters("the_content", $template);

// Escape the output
//echo wp_kses_post($filtered_content);
echo $filtered_content;

?>