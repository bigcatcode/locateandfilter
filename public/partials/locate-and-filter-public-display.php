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

$template=str_replace(array("[map]","[navlist]","[filters]"),array("[LocateAndFilter_map map_id=".$map_id."]","[LocateAndFilter_navlist map_id=".$map_id."]","[LocateAndFilter_filters map_id=".$map_id."]"),$template);
remove_filter( 'the_content', 'wpautop'); 

/*** COMPATIBILITY WITH OTHER PLUGINS */
remove_filter( 'the_content', 'badgeos_reformat_entries', 9 );
remove_filter( 'the_content', 'bp_replace_the_content' );

echo apply_filters("the_content",$template);
	
?>
