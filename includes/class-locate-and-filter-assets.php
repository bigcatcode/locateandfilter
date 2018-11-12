<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://monothemes.com/
 * @since      1.0.0
 *
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/includes
 * @author     AMonin <monothemes@gmail.com>
 */
class Locate_And_Filter_Assets {	

	var $plugin_url,$plugin_path;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {			
	}

	public static function getPath() {		
		$file = dirname(__FILE__) . '/../locateandfilter.php';
		$plugin_url = plugin_dir_url($file);
		$plugin_path = plugin_dir_path($file);
		return array("plugin_url"=>$plugin_url,"plugin_path"=>$plugin_path);
	}	

	public static function getMapOverlays() {		
		$overlays=array();
		$overlays=apply_filters("locate_anything_add_overlays",$overlays);		
		return $overlays;		
	}
	
	public static function getMarkers($id=null) {	
		$markers=array();
		$markers=apply_filters("locate_anything_add_marker_icons",$markers);		
		if($id) return $markers[$id]; else return $markers;		
	}	

	public static function getMapTemplates($id=null) {	
		$templates=array();
		$templates=apply_filters("locate_anything_add_map_layouts",$templates);			
		if($id) return $templates[$id]; else return $templates;
	}

}
