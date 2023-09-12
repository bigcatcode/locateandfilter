<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://monothemes.com/
 * @since      1.0.0
 *
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/public
 * @author     AMonin <monothemes@gmail.com>
 */
class Locate_And_Filter_Public {
	
	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name
	 *        	The name of the plugin.
	 * @param string $version
	 *        	The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
        $this->plugin_name = 'locate-and-filter';
        $this->version = '1.6.13';
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style ( $this->plugin_name . "-all", plugin_dir_url ( __FILE__ ) . 'css/locate-and-filter-public.css', array (), $this->version, 'all' );
		// leaflet css
		//wp_enqueue_style ( $this->plugin_name . "-leaflet", plugin_dir_url ( __FILE__ ) . 'js/leaflet-0.7.3/leaflet.css', array (), $this->version, 'all' );
		wp_enqueue_style ( $this->plugin_name . "-leaflet", plugin_dir_url ( __FILE__ ) . 'js/leaflet-1.9.4/leaflet.css', array (), $this->version, 'all' );
		// Pretty-checkbox
		wp_enqueue_style ( $this->plugin_name . "-pretty-checkbox", plugin_dir_url ( __FILE__ ) . 'js/pretty-checkbox/pretty-checkbox.min.css', array (), $this->version, 'all' );
		// leaflet-filters css
		wp_enqueue_style ( $this->plugin_name . "-leaflet-filters", plugin_dir_url ( __FILE__ ) . 'js/leaflet-filters/leaflet-filters.css', array ($this->plugin_name . "-pretty-checkbox"), $this->version, 'all' );
		
		// leaflet markerCluster css
		//wp_enqueue_style ( $this->plugin_name . "-leaflet-marker-cluster-default", plugin_dir_url ( __FILE__ ) . 'js/leaflet.markercluster/MarkerCluster.Default.css', array (), $this->version, 'all' );
		//wp_enqueue_style ( $this->plugin_name . "-leaflet-marker-cluster", plugin_dir_url ( __FILE__ ) . 'js/leaflet.markercluster/MarkerCluster.css', array (), $this->version, 'all' );

		// leaflet markerCluster css
		wp_enqueue_style ( $this->plugin_name . "-leaflet-marker-cluster-default", plugin_dir_url ( __FILE__ ) . 'js/Leaflet.markercluster-1.4.1/MarkerCluster.Default.css', array (), $this->version, 'all' );
		wp_enqueue_style ( $this->plugin_name . "-leaflet-marker-cluster", plugin_dir_url ( __FILE__ ) . 'js/Leaflet.markercluster-1.4.1/MarkerCluster.css', array (), $this->version, 'all' );

		// Tokenize CSS
		wp_enqueue_style ( $this->plugin_name . "-tokenize", plugin_dir_url ( __FILE__ ) . 'js/Tokenize-2.2.1/jquery.tokenize.css', array (), $this->version, 'all' );
		// Chosen CSS
		$load_chosen = unserialize (get_option ( 'locate-anything-option-load-chosen' ));
		if($load_chosen) {
			wp_enqueue_style ( $this->plugin_name . "-chosen", plugin_dir_url ( __FILE__ ) . 'js/chosen_v1.8.7/chosen.css', array (), $this->version, 'all' );
		}

		// leaflet Google automplete CSS
		// wp_enqueue_style ( $this->plugin_name . "-googleauto", plugin_dir_url ( __FILE__ ) . 'js/leaflet-google-autocomplete/css/leaflet-google-autocomplete.css', array (), $this->version, 'all' );
		wp_enqueue_style ( $this->plugin_name . "-google_autocomplete", plugin_dir_url ( __FILE__ ) . 'js/leaflet-google-places-autocomplete/css/leaflet-gplaces-autocomplete.css', array (), $this->version, 'all' );

		// Ionicons
		wp_enqueue_style ( $this->plugin_name . "-ionicons", 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array (), $this->version, 'all' );
		// Awesome markers
		wp_enqueue_style ( $this->plugin_name . "-awesomemarkers", plugin_dir_url ( __FILE__ ) . 'js/leaflet.awesome-markers-2.0/leaflet.awesome-markers.css', array (), $this->version, 'all' );
		wp_enqueue_style('jquery-ui-css',plugin_dir_url ( __FILE__ ) ."js/jquery-theme/jquery-ui.css", array (), $this->version, 'all');
		// tui-pagination
		wp_enqueue_style ( $this->plugin_name . "-tui-pagination", plugin_dir_url ( __FILE__ ) . 'js/tui-pagination/tui-pagination.min.css', array (), $this->version, 'all' );
		// leaflet fullscreen
		$enable_fullscreenControl = unserialize (get_option ( 'locate-anything-option-enable_fullscreenControl' ));
		if($enable_fullscreenControl) {
			wp_enqueue_style ( $this->plugin_name . "-leaflet-fullscreen", plugin_dir_url ( __FILE__ ) . 'js/leaflet.fullscreen-2.0.0/Control.FullScreen.css', array (), $this->version, 'all' );
		}		
	}
	
	/**
	 * Register the scripts for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script ( $this->plugin_name . "-all", plugin_dir_url ( __FILE__ ) . 'js/locate-and-filter-public.js', array (
				'jquery' 
		), $this->version, false );
		// Google API, localized according to general settings
		$gmaps_key = Locate_And_Filter_Admin::getGmapsAPIKey();		
		
		//load additional js if you want
		$loadjs = unserialize (get_option ( 'locate-anything-option-loadjs' ));
		if(!is_array($loadjs)) $loadjs = array ();
		
		//google
		if (array_search ( 'google', $loadjs ) !== false):

			wp_enqueue_script ( $this->plugin_name . "-googleAPI", "https://maps.googleapis.com/maps/api/js?v=3.exp&key=".$gmaps_key."&libraries=places&language=" . unserialize ( get_option ( "locate-anything-option-map-language" ) ), array (
					$this->plugin_name . "-leaflet-filters" 
			), $this->version, false );
			
			// Google Tiles - derecated
			// wp_enqueue_script ( $this->plugin_name . "-googleTiles", plugin_dir_url ( __FILE__ ) . 'js/leaflet-plugins-master/layer/tile/Google.js', array (
			// 		$this->plugin_name . "-leaflet-filters" 
			// ), $this->version, false );

			// Google Mutant
			wp_enqueue_script ( $this->plugin_name . "-GoogleMutant", plugin_dir_url ( __FILE__ ) . 'js/Leaflet.GridLayer.GoogleMutant/Leaflet.GoogleMutant.js', array (
			), $this->version, false );

		endif;

		// Yandex Tiles
		if (array_search ( 'yandex', $loadjs ) !== false):
			wp_enqueue_script ( $this->plugin_name . "-yandexAPI", "http://api-maps.yandex.ru/2.0/?load=package.map&lang=" . unserialize ( get_option ( "locate-anything-option-map-language" ) ), array (
					$this->plugin_name . "-leaflet-filters" 
			), $this->version, false );
			wp_enqueue_script ( $this->plugin_name . "-yandexTiles", plugin_dir_url ( __FILE__ ) . 'js/leaflet-plugins-master/layer/tile/Yandex.js', array (
					$this->plugin_name . "-leaflet-filters" 
			), $this->version, false );
		endif;

		// Bing Tiles
		if (array_search ( 'bing', $loadjs ) !== false):
			wp_enqueue_script ( $this->plugin_name . "-bingTiles", plugin_dir_url ( __FILE__ ) . 'js/leaflet-plugins-master/layer/tile/Bing.js', array (
					$this->plugin_name . "-leaflet-filters" 
			), $this->version, false );
		endif;

		// leaflet JS
		// wp_enqueue_script ( $this->plugin_name . "-leaflet", plugin_dir_url ( __FILE__ ) . 'js/leaflet-0.7.3/leaflet.js', array (
		// 		'jquery' 
		// ), $this->version, false );

		// new leaflet JS
		wp_enqueue_script ( $this->plugin_name . "-leaflet", plugin_dir_url ( __FILE__ ) . 'js/leaflet-1.9.4/leaflet-src.js', array (
				'jquery' 
		), $this->version, false );

		// tui-pagination JS
		wp_enqueue_script ( $this->plugin_name . "-tui-pagination", plugin_dir_url ( __FILE__ ) . 'js/tui-pagination/tui-pagination.min.js', array (
				'jquery'
		), $this->version, false );

		// leaflet-canvas-markers JS


		// leaflet-filters JS
		if (array_search ( 'google', $loadjs ) !== false):
			wp_enqueue_script ( $this->plugin_name . "-leaflet-filters", plugin_dir_url ( __FILE__ ) . 'js/leaflet-filters/leaflet-filters.js', array (
					$this->plugin_name . "-leaflet",
					$this->plugin_name . "-tui-pagination",
					$this->plugin_name . "-GoogleMutant",
					"jquery",
			), $this->version, false );
		else:
			wp_enqueue_script ( $this->plugin_name . "-leaflet-filters", plugin_dir_url ( __FILE__ ) . 'js/leaflet-filters/leaflet-filters.js', array (
					$this->plugin_name . "-leaflet",
					$this->plugin_name . "-tui-pagination",
					"jquery",
			), $this->version, false );
		endif;
		
		// leaflet markerCluster JS
		// wp_enqueue_script ( $this->plugin_name . "-leaflet-marker-cluster", plugin_dir_url ( __FILE__ ) . 'js/leaflet.markercluster/leaflet.markercluster-src-min.js', array (
		// 		'jquery' 
		// ), $this->version, false );

		// leaflet new markerCluster JS
		wp_enqueue_script ( $this->plugin_name . "-leaflet-marker-cluster", plugin_dir_url ( __FILE__ ) . 'js/Leaflet.markercluster-1.4.1/leaflet.markercluster-src.js', array (
				'jquery' 
		), $this->version, false );

		// Tokenize JS
		wp_enqueue_script ( $this->plugin_name . "-tokenize", plugin_dir_url ( __FILE__ ) . 'js/Tokenize-2.2.1/jquery.tokenize.js', array (
				'jquery' 
		), $this->version, false );
		
		// Chosen JS
		$load_chosen = unserialize (get_option ( 'locate-anything-option-load-chosen' ));
		if($load_chosen) {
			wp_enqueue_script ( $this->plugin_name . "-chosen", plugin_dir_url ( __FILE__ ) . 'js/chosen_v1.8.7/chosen.jquery.min.js', array (
					'jquery' 
			), $this->version, false );
		}
		// jQuery Array JS
		wp_enqueue_script ( $this->plugin_name . "-arrayUtilities", plugin_dir_url ( __FILE__ ) . 'js/jquery.arrayUtilities.min.js', array (
				'jquery' 
		), $this->version, false );
		
		// leaflet Google automplete JS
		// wp_enqueue_script ( $this->plugin_name . "-googleautojs", plugin_dir_url ( __FILE__ ) . 'js/leaflet-google-autocomplete/js/leaflet-google-autocomplete.js', array (
		// 		$this->plugin_name . "-leaflet-filters" 
		// ), $this->version, false );
		wp_enqueue_script ( $this->plugin_name . "-google_autocomplete_js", plugin_dir_url ( __FILE__ ) . 'js/leaflet-google-places-autocomplete/js/leaflet-gplaces-autocomplete.js', array (
				$this->plugin_name . "-leaflet-filters" 
		), $this->version, false );

		// Awesome markers
		wp_enqueue_script ( $this->plugin_name . "-awesomemarkersjs", plugin_dir_url ( __FILE__ ) . 'js/leaflet.awesome-markers-2.0/leaflet.awesome-markers.min.js', array (
				$this->plugin_name . "-leaflet-filters" 
		), $this->version, false );
		//leaflet-omnivore.min.js
		wp_enqueue_script ( $this->plugin_name . "-omnivorejs", plugin_dir_url ( __FILE__ ) . 'js/leaflet-omnivore/leaflet-omnivore.min.js', array (
				$this->plugin_name . "-leaflet-filters" 
		), $this->version, false );

		// maxClusterRadius
		wp_localize_script( $this->plugin_name . "-leaflet-marker-cluster", 'ClusterOptions', array(
			'maxClusterRadius' =>  80,
		));

		// providers

		// fullscreen

		// leaflet markerBouncing
						
	}
	

	/**
	 * Checks the license key
	 */
	public static function check_license_key($type_license) {
		// disable check  if localhost
		if(strpos(site_url(), 'localhost')!==false) return true;

		$license = Locate_And_Filter_Admin::getLicence($type_license);			
		$seed = $license["seed"];
		if($type_license === "label") $license_key  =unserialize(get_option("locate-anything-option-license-key"));
		else  $license_key  = $license['key'];
		
		// disable check  if CC license key
		if(substr($license_key, 0,2)==='CC') return true;

		if( hash("sha256",site_url().$seed) === $license_key ) return true; else return false;
	}

	/**
	 * Sets up the shortcodes
	 */
	public static function setup_shortcodes() {
		add_shortcode ( "LocateAndFilter", "Locate_And_Filter_Public::createMap" );
		add_shortcode ( "LocateAndFilter_map", "Locate_And_Filter_Public::outputMapMarkup" );
		add_shortcode ( "LocateAndFilter_navlist", "Locate_And_Filter_Public::outputNavlistMarkup" );
		add_shortcode ( "LocateAndFilter_filters", "Locate_And_Filter_Public::outputFilters" );

		//add_shortcode ( "LocateAndFilter_single", "Locate_And_Filter_Public::createMap_single" );
		add_shortcode ( "LocateAndFilter_map_single", "Locate_And_Filter_Public::outputMapMarkup_single" );
		add_shortcode ( "LocateAndFilter_filters_single", "Locate_And_Filter_Public::outputFilters_single" );
	}

	/**
	 * Removes the shortcodes
	 */
	public static function remove_shortcodes(){
		remove_shortcode ( "LocateAndFilter" );
		remove_shortcode ( "LocateAndFilter_map");
		remove_shortcode ( "LocateAndFilter_navlist");
		remove_shortcode ( "LocateAndFilter_filters" );

		//remove_shortcode ( "LocateAndFilter_single" );
		remove_shortcode ( "LocateAndFilter_map_single" );
		remove_shortcode ( "LocateAndFilter_filters_single" );
	}
	
	/**
	 * Outputs the map markup and JS
	 * 
	 * @param [array] $atts
	 *        	shortcode arguments
	 * @param [string] $content	post content
	 * @return [void]
	 */
	public static function outputMapMarkup($atts, $content) {
		if(!isset($atts["map_id"])) return;	
		if(is_admin()) return;

		$plugin_public = new Locate_And_Filter_Public(null, null);      
    	$plugin_public->enqueue_scripts();
        $plugin_public->enqueue_styles();
        

		$params ["map-width"]=get_post_meta ( $atts ["map_id"], 'locate-anything-map-width', true ) ;
		$params ["map-height"]=get_post_meta ($atts ["map_id"] , 'locate-anything-map-height', true );		

		$content .= "<!-- Map container -->	
				<style>\n";
				if(get_post_meta ( $atts ["map_id"], 'locate-anything-tooltip-style', true )=="squared") 
				 $content .= ".leaflet-popup-content-wrapper {border-radius: 0 !important;}\n";				
				if(get_post_meta ( $atts ["map_id"], 'locate-anything-marker-size', true )) 
				 $content .= '#map-container-'.$atts ["map_id"]." .awesome-marker i {font-size:".get_post_meta ( $atts ["map_id"], 'locate-anything-marker-size', true )."px !important;}\n";	
				 $content .= '#map-container-'.$atts ["map_id"].'{width:'.$params ["map-width"].';height:'.$params ["map-height"].' !important; }
				</style>
						<div id="map-container-'.$atts ["map_id"].'" >
							<!-- Progress bar-->	
						<div id="progress-wrapper">					
						<div class="progress"  style="background-color:transparent" id="progress-'.$atts ["map_id"].'"><div class="progress-bar" id="progress-bar-'.$atts ["map_id"].'"></div></div>
						</div></div>' . Locate_And_Filter_Public::generateMapJS ( $atts ["map_id"], "map-container-".$atts ["map_id"], $atts );
		// apply filters on outputMapMarkup
		$content = apply_filters("locate_anything_alter_outputMapMarkup",$content);
		return $content;
	}
	
	/**
	 * Outputs the Navlist markup
	 * 
	 * @param [array] $atts
	 *        	shortcode arguments
	 * @param [type] $content
	 *        	post content
	 * @return [void]
	 */
	public static function outputNavlistMarkup($atts, $content) {
		return $content .= '<!-- Map Nav -->
				<div class="map-nav-wrapper" id="map-nav-wrapper-'.$atts["map_id"].'">
					<div id="results-found-'.$atts["map_id"].'" class="map-nav-results-found"></div>
					<div id="map-nav-'.$atts["map_id"].'" class="map-nav-lists map-nav-'.$atts["map_id"].'"></div>				
				</div>
				<div class="map-nav-pagination tui-pagination" id="map-nav-pagination-'.$atts["map_id"].'"></div>';
	}
	
	/**
	 * Outputs the filters markup
	 * 
	 * @param [array] $atts
	 *        	shortcode arguments
	 * @param [type] $content
	 *        	post content
	 * @return [void]
	 */
	public static function outputFilters($atts, $content) {
		if ( !isset($atts['categoryfilter'])) { $atts['categoryfilter'] = ''; }
		return $content .= '<div class="LA_filters">' . Locate_And_Filter_Public::generateFilterForm( sanitize_key( $atts['map_id'] ),  sanitize_key( $atts['categoryfilter'] )) . '</div>';
	}

	/**
	 * Outputs the filters markup
	 * 
	 * @param [array] $atts
	 *        	shortcode arguments
	 * @param [type] $content
	 *        	post content
	 * @return [void]
	 */
	public static function outputFilters_single($atts, $content) {
		return $content .= '<div class="LA_filters">' . Locate_And_Filter_Public::generateFilterForm_single ( sanitize_key ( $atts ['map_id'] ) ) . '</div>';
	}

	/**
	 * Outputs a map
	 * 
	 * @param [type] $atts
	 *        	shortcode arguments
	 * @param [type] $content
	 *        	post content
	 * @return [void]
	 */
	public static function createMap($atts, $content) {
		if(!isset($atts["map_id"])) return;	

		$plugin_public = new Locate_And_Filter_Public(null,null);  
        $plugin_public->enqueue_scripts();
        $plugin_public->enqueue_styles();
        
		extract ( $atts );
		//$filters = get_post_meta ( $map_id, "locate-anything-filters", true );
		$layout_id=		get_post_meta ( $map_id, "locate-anything-map-template", true );
		
		$template=get_post_meta($map_id,"locate-anything-map-template-html-".$layout_id,true);
	
		if($template==false){	
					//$template=file_get_contents(Locate_And_Filter_Assets::getMapTemplates($layout_id)->url);
					$template = Locate_And_Filter_Tools::get_local_file_contents(Locate_And_Filter_Assets::getMapTemplates($layout_id)->url);
			} 

		ob_start ();
		include plugin_dir_path ( __FILE__ ) . 'partials/locate-and-filter-public-display.php';
		$buffer = ob_get_contents ();
		ob_end_clean ();
		return $buffer;
	}

	/**
	 * Outputs a map
	 * 
	 * @param [type] $atts
	 *        	shortcode arguments
	 * @param [type] $content
	 *        	post content
	 * @return [void]
	 */
	public static function createMap_single($atts, $content) {
		if(!isset($atts["map_id"])) return;	

		$plugin_public = new Locate_And_Filter_Public(null,null);  
        $plugin_public->enqueue_scripts();
        $plugin_public->enqueue_styles();
        
		extract ( $atts );
		//$filters = get_post_meta ( $map_id, "locate-anything-filters", true );
		$layout_id=		get_post_meta ( $map_id, "locate-anything-map-template", true );
		
		$template=get_post_meta($map_id,"locate-anything-map-template-html-".$layout_id,true);
	
		if($template==false){	
					//$template=file_get_contents(Locate_And_Filter_Assets::getMapTemplates($layout_id)->url);
					$template = Locate_And_Filter_Tools::get_local_file_contents(Locate_And_Filter_Assets::getMapTemplates($layout_id)->url);
			} 

		ob_start ();
		include plugin_dir_path ( __FILE__ ) . 'partials/locate-and-filter-public-display_single.php';
		$buffer = ob_get_contents ();
		ob_end_clean ();
		return $buffer;
	}

	/**
	 * Outputs the JS required to setup and display the map, used in the template called by createMap()
	 * 
	 * @param [int] $map_id        	
	 * @param [string] $map_container
	 *        	: HTML id of the map container
	 * @return void
	 */
	public static function generateMapJS( $map_id, $map_container, $atts ) {
		/* in preview mode the parameters are transmitted via $_POST directly*/
		if ( $map_id == "preview" ) {								
				$settings = $_POST;	
				$filters = 	$settings["locate-anything-show-filters"];	
							
		} else {
			$settings = Locate_And_Filter_Public::getMapParameters($map_id);
			$filters = unserialize($settings["locate-anything-show-filters"]);
		}
		//echo "<pre>", var_dump($settings), "</pre>";//var_dump($settings);
		/* create parameter array */
		$params = array ();

		$params["bing-key"] = Locate_And_Filter_Admin::getBingAPIKey();
		$loadjs = unserialize (get_option ( 'locate-anything-option-loadjs' ));
		if(!is_array($loadjs)) $loadjs = array ();
		//google
		if (array_search ( 'google', $loadjs ) !== false){
			$params["load-google"] = true;
		} else {
			$params["load-google"] = false;
		}
		//bing
		if (array_search ( 'bing', $loadjs ) !== false){
			$params["load-bing"] = true;
		} else {
			$params["load-bing"] = false;
		}
		//yandex
		if (array_search ( 'yandex', $loadjs ) !== false){
			$params["load-yandex"] = true;
		} else {
			$params["load-yandex"] = false;
		}

		/* width & height*/
		$params ["map-width"]=$settings['locate-anything-map-width'] ;
		$params ["map-height"]=$settings['locate-anything-map-height'] ;
		/* hide splashscreen*/
		$params["hide-splashscreen"] = $settings["locate-anything-hide-splashscreen"] ;
		/* refresh navlist as you go*/
		$params ["display_only_inbound"]=$settings['locate-anything-display_only_inbound'] ;
		/* autogeocode */
		$params ["autogeocode"] = trim($settings['locate-anything-usergeolocation-zoom']);
		/* mousewheel*/
		$params ["scrollWheelZoom"] = trim($settings['locate-anything-scrollWheelZoom']);
		/* navlist_event*/
		$params ["navlist_event"] = trim($settings['locate-anything-navlist-event']);
		/* popup_event*/
		$params ["popup_event"] = trim($settings['locate-anything-popup-event']);
		/* Start position */
		$params ["start_position"] = $settings['locate-anything-start-position'];
		if (empty ( $params ["start_position"] ))
			$params ["start_position"] = "51.505, -0.09";
		$tmp = explode ( ",", $params ["start_position"] );
		$params ["initial-lat"] = trim ( $tmp [0] );
		$params ["initial-lon"] = trim ( $tmp [1] );
		/* Overlay */
		$params ["overlay"] = $settings['locate-anything-map-provider'];
		
		/* custom map provider*/		
		if($params ["overlay"]=="custom-0"){
			$params ["overlay"] = (object)array("id"=>1,
					"name"=> 'Custom',
					"url"=>$settings["locate-anything-custom-map-provider"],
					"attribution"=> '',
					"maxZoom"=>20,
					"minZoom"=>1,
					"zoom"=>10);
		} else if ( $params ["overlay"] == "addon-0" ) {
				$params ["overlay"] = (object)array(
					"attribution"=> 'overlay-addon',
				);
			$params ["overlay-addon"] = unserialize(get_option ("locate-anything-option-map-provider-addon"));
			$params ["overlay-addon-accessToken-jawg"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-jawg"));
			$params ["overlay-addon-customstyle-jawg"] = unserialize(get_option ("locate-anything-option-map-provider-addon-customstyle-jawg"));
			$params ["overlay-addon-accessToken-thunderforest"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-thunderforest"));
			$params ["overlay-addon-accessToken-mapbox"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-mapbox"));
			$params ["overlay-addon-accessToken-maptiler"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-maptiler"));
			$params ["overlay-addon-accessToken-openweathermap"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-openweathermap"));
			$params ["overlay-addon-accessToken-here"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-here"));			
		} else {
			$overlays = Locate_And_Filter_Assets::getMapOverlays ();			
			$params ["overlay"] = $overlays [$params ["overlay"]];
			$params ["overlay-addon"] = '';
			$params ["overlay-addon-accessToken-jawg"] = '';
			$params ["overlay-addon-customstyle-jawg"] = '';
			$params ["overlay-addon-accessToken-thunderforest"] = '';
			$params ["overlay-addon-accessToken-mapbox"] = '';
			$params ["overlay-addon-accessToken-maptiler"] = '';
			$params ["overlay-addon-accessToken-openweathermap"] = '';
			$params ["overlay-addon-accessToken-here"] = '';						
		}
		$maxZoom = $settings['locate-anything-max-zoom'];
		if (! $maxZoom)
			$maxZoom = $params ["overlay"]->maxZoom;
		$minZoom = $settings['locate-anything-min-zoom'];
		if (! $minZoom)
			$minZoom = $params ["overlay"]->minZoom;
		$params ["overlay"] = '{url:"' . $params ["overlay"]->url . '",attribution:"' . sanitize_text_field ( $params ["overlay"]->attribution ) . '" ,maxZoom:' . $maxZoom . ' ,minZoom:' . $minZoom . '}';
		$params ["initial-zoom"] = $settings['locate-anything-start-zoom'];
		$params ["single-zoom"] = $settings['locate-anything-single-zoom'];
		if (empty ( $params ["initial-zoom"] ))
			$params ["initial-zoom"] = 1;
		if (empty ( $params ["single-zoom"] ))
			$params ["single-zoom"] = 9;		
		$params ["googleplaces"] = $settings["locate-anything-googleplaces"];
		$params ["map-id"] = $map_id;
		$params ["map-container"] = $map_container;
		$params ["max_nav_item_per_page"] = $settings['locate-anything-nav-number'];
		if (empty ( $params ["max_nav_item_per_page"] ))
			$params ["max_nav_item_per_page"] = 10;
		$params ["style-hue"] = $settings['locate-anything-googlemaps-hue'];
		/* enable_fitBounds */
		$params ["enable_fitBounds"]=$settings['locate-anything-enable_fitBounds'];
		$params ["enable_zoom_to_marker"]=$settings['locate-anything-enable_zoom_to_marker'];
		?>

		<script type="text/javascript">
			(async() => {
			    //console.log("waiting for jQuery");

			    while(!window.hasOwnProperty("jQuery")) {
			        await new Promise(resolve => setTimeout(resolve, 100));
			    }

				var current_map;
				jQuery(window).on('load', function () {
						var map_id='<?php echo $map_id?>';
						<?php
							if (Locate_And_Filter_Public::check_license_key('label')===false) {?>
								<!-- jQuery("#<?php echo $map_container?>").append("<div style='background:grey;opacity:0.6;width:100%;height:1.5em;z-index:1500;position:absolute;bottom:0;text-align:left;padding-left:10px'><a style='cursor:pointer;text-decoration:none;color:#fff;' href='#' target='_blank'>Powered by LocateAndFilter</div>"); -->
						<?php	} ?>

							
						/* setting up the map */ 
					var params = {
						"instance_id":"locate_anything_map_<?php echo $map_id?>",
						"map-id": "<?php echo $map_id?>",
						"map-container":'<?php echo $map_container?>',
						"initial-lat": <?php echo $params["initial-lat"]?>,
						"initial-lon": <?php echo $params["initial-lon"]?>,
						"initial-zoom": <?php echo $params["initial-zoom"]?>,
						"single-zoom": <?php echo $params["single-zoom"]?>,
						"autogeocode" :'<?php echo $params["autogeocode"]?>',
						"display_only_inbound" : '<?php echo $params["display_only_inbound"]?>',
						"overlay" : <?php echo $params["overlay"]?>,
						"googleplaces" : <?php echo $params["googleplaces"]?>,
						"max_nav_item_per_page" : <?php echo $params["max_nav_item_per_page"]?>,
						<?php if($params["style-hue"]) echo '"style-hue":"'.$params["style-hue"].'",'?>
						"scrollWheelZoom" : <?php echo $params["scrollWheelZoom"]?>,
						"navlist_event" : '<?php echo  $params["navlist_event"]?>',
						"popup_event" : '<?php echo  $params["popup_event"]?>',
						"hide-splashscreen" : '<?php echo $params["hide-splashscreen"]?>',
						"kml_file" :  '<?php echo $settings["locate-anything-kml-file"]?>',
						"kml_fillColor" :  '<?php echo $settings["locate-anything-kml_fillColor"]?>',
						"kml_weight" :  '<?php echo $settings["locate-anything-kml_weight"]?>',
						"kml_opacity" :  '<?php echo $settings["locate-anything-kml_opacity"]?>',
						"kml_color" :  '<?php echo $settings["locate-anything-kml_color"]?>',
						"kml_dashArray" :  '<?php echo $settings["locate-anything-kml_dashArray"]?>',
						"kml_fillOpacity" :  '<?php echo $settings["locate-anything-kml_fillOpacity"]?>',
						"bing-key"  :	'<?php echo $params["bing-key"]?>',
						"load-google"	:	'<?php echo $params["load-google"]?>',
						"load-bing"	:	'<?php echo $params["load-bing"]?>',
						"load-yandex"	:	'<?php echo $params["load-yandex"]?>',
						"overlay-addon"	:	'<?php echo $params ["overlay-addon"]?>',
						"overlay-addon-accessToken-jawg"	:	'<?php echo $params ["overlay-addon-accessToken-jawg"]?>',
						"overlay-addon-customstyle-jawg"	:	'<?php echo $params ["overlay-addon-customstyle-jawg"]?>',
						"overlay-addon-accessToken-thunderforest"	:	'<?php echo $params ["overlay-addon-accessToken-thunderforest"]?>',
						"overlay-addon-accessToken-mapbox"	:	'<?php echo $params ["overlay-addon-accessToken-mapbox"]?>',
						"overlay-addon-accessToken-maptiler"	:	'<?php echo $params ["overlay-addon-accessToken-maptiler"]?>',
						"overlay-addon-accessToken-openweathermap"	:	'<?php echo $params ["overlay-addon-accessToken-openweathermap"]?>',
						"overlay-addon-accessToken-here"	:	'<?php echo $params ["overlay-addon-accessToken-here"]?>',
						"enable_fitBounds"	:	'<?php echo $params ["enable_fitBounds"]?>',
						"enable_zoom_to_marker"	:	'<?php echo $params ["enable_zoom_to_marker"]?>'			
					};

						/* define instance name*/
						var map_instance="locate_anything_map_"+map_id;
						
						/* instanciate filter class */
					eval("var "+map_instance+"=new leaflet_filters_class(params);");				 
						/* loading ... */						
					 eval(map_instance).showLoader(true);
					 <?php if (has_filter("locate_anything_beforeCreateMap")) echo apply_filters("locate_anything_beforeCreateMap",$map_id);?>
					 	/* Initialize Map  */	
					eval(map_instance).createMap();
					/*   Register filters, property_name is the name of the property as shown in the JSON datas  */
					var custom_filters= [<?php if(is_array($filters)) foreach ($filters as $filter) echo '{"property_name":"'.$filter.'","html_id" : ".'.$filter.'-'.$map_id.'"},';?>];
					eval(map_instance).register_filters(custom_filters);
					/* Override nav item template */	 	
					eval(map_instance).template_nav_item = function(marker,LatLng) {	
						var template='<?php echo Locate_And_Filter_Public::getNavTemplate($map_id)?>';
						return template;
					};
					/*  define callback function */
					var createEverything_<?php echo $map_id?> = function(result){	
						var cpt=0;	
									 	
						for(var i in result["data"]){	
							var marker={};	
								/*  The JSON containing the markers data is indexed to save space and generation time 
								*	Rebuilds the object with original field names
								*/			
		 					var indexed_marker=result["data"][i];
		 					for(var k in indexed_marker) {
		 						marker[result["index"]["fieldnames"][k]]=indexed_marker[k]; 						
		 					}
								/* Marker creation : set timeout is used to allow the progressbar to update */
							setTimeout(function(marker){											
									/* define Tooltip HTML*/	
									<?php if($map_id=="preview") {?>
										var default_tooltip_template='<?php echo Locate_And_Filter_Public::decode_template ($settings['locate-anything-default-tooltip-template'])?>';
										<?php } else {?>
								var default_tooltip_template='<?php echo Locate_And_Filter_Public::getDefaultTooltipTemplate($map_id)?>';					
								<?php } ?>
									// length must be superior to 2 because of the inclusion of 2 single quotes to delimitate the output
								
								if(marker.tooltip_template.length>2) {									
									var html = eval(marker.tooltip_template);
									
								}
								else var html=default_tooltip_template;
									/* define icon*/
								var customIcon=null;
								if(marker.custom_marker){									
								 customIcon= eval(map_instance).getMarkerIcon(marker.custom_marker);		
								} else customIcon=false;					
									/* No custom icon, use default icon for this map */
								if(!customIcon) customIcon= eval(map_instance).getMarkerIcon(result["defaults"][0].default_marker);	
								
								/* updates progress bar */
								eval(map_instance).updateProgressBar(cpt++, result["data"].length, 1000);
								/* creates the marker */
								eval(map_instance).createMarker(marker.lat,marker.lng,html,marker,customIcon);
							},1,marker);							
						}	

						setTimeout(function() {						
							/* Render Map */							
							eval(map_instance).render_map(eval(map_instance).markers);						
							/*	Creation Nav */			
							eval(map_instance).updateNav(0);
							/* hide loader */
							eval(map_instance).showLoader(false);	
							/* stores the map in Jquery for easier access*/	
							current_map=eval(map_instance);
							<?php if ( has_filter("locate_anything_afterGenerateJS")) echo apply_filters("locate_anything_afterGenerateJS",$map_id); ?>
							<?php if ( isset($atts["categoryfilter"]) ) { ?>
								eval(map_instance).update_markers();
							<?php } ?>
							eval(map_instance).setup_range_sliders();					
							},250);
					}

					/*   JSON : Retrieve markers data */
					eval(map_instance).getData("<?php echo admin_url( 'admin-ajax.php'); ?>?action=getMarkers&map_id=<?php echo $map_id?>",createEverything_<?php echo $map_id?>)
					/* call Tokenize for nice selects */
					if(jQuery.tokenize){
					var token1=jQuery('#map-filters-'+map_id+' .tokenize-1').tokenize({maxElements:"1",onRemoveToken:function(e,f){eval(map_instance).update_markers();},onAddToken:function(e,f){eval(map_instance).update_markers();}});
					var token=jQuery('#map-filters-'+map_id+' .tokenize').tokenize({maxElements:"9999",onRemoveToken:function(e,f){eval(map_instance).update_markers();},onAddToken:function(e,f){eval(map_instance).update_markers();}});
						
					} 
					<?php if ( $settings['locate-anything-show-attribution-label'] == 0 ) {
						echo "/* Hide attribution */
						jQuery('.leaflet-control-attribution').hide();
						";
					} ?>					
					<?php $load_chosen = unserialize( get_option('locate-anything-option-load-chosen') );
					if ( $load_chosen ) {
						echo "jQuery('.filter-select select').chosen({width:'250px',allow_single_deselect:'true'});";	
					} ?>				
				});
    			//console.log("jQuery is loaded.");
			})();				
		</script>
	<?php
		
	}

	/**
	 * returns the filters HTML code
	 * 
	 * @param int $map_id        	
	 * @param array $filters        	
	 * @return html filter form HTML
	 */
	public static function generateFilterForm($map_id, $categoryfilter='') {
		//var_dump($categoryfilter);
		$filters = get_post_meta ( $map_id, "locate-anything-show-filters", true );	
		$type = get_post_meta ( $map_id, "locate-anything-source", true );
		$filter_terms_orderby = get_post_meta ( $map_id, "locate-anything-filter_terms_orderby", true );
		$filters_ = Locate_And_Filter_Tools::Order_Filters( $filters, $type, $map_id );			
		$r = '<form id="map-filters-'.$map_id.'" method="post" action="#"><ul id="category-filters-container1" class="category-filters-container">';
		if (is_array ( $filters_ ) && $type!=="user") {
			foreach ( $filters_ as $filter => $val ) {
				$allowed= get_post_meta($map_id,'locate-anything-allowed-filters-value-'.$filter,true);
				$taxonomy = get_taxonomy ( $filter );
				if(!$taxonomy) continue;
				$selector= get_post_meta ( $map_id, 'locate-anything-display-filter-' . $filter, true );
				$filter_selector_label = get_post_meta ( $map_id, 'locate-anything-filter-selector-label-' . $filter, true );
				$filter_selector_sort = get_post_meta ( $map_id, 'locate-anything-filter-selector-sort-' . $filter, true );
				$filter_selector_icon = get_post_meta ( $map_id, 'locate-anything-filter-selector-icon-' . $filter, true );
				if($filter_selector_label){
					$customlabel = $filter_selector_label;
				} else {
					$customlabel = $taxonomy->labels->name;
				}

				if ($taxonomy && $selector == "tokenize") {
					$r .= '<li class="filter-tokenize" data-sort="'.$filter_selector_sort.'"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getSelectForTaxonomy ( $filter, $filter."-$map_id", true,9999,$allowed, $categoryfilter, $selector ) . '</li>';
				} elseif ( $taxonomy &&  ($selector == "select"  || $selector == "selectmultiple") ) {
					$r .= '<li class="filter-select" data-sort="'.$filter_selector_sort.'"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getSelectForTaxonomy ( $filter, $filter."-$map_id", false,9999,$allowed, $categoryfilter, $selector ) . '</li>';
				} elseif ( $selector == "range" ) {
					$r .= '<li class="filter-range" data-sort="'.$filter_selector_sort.'"><label>' . $customlabel . '</label>
					<div id="rangedval-'.$filter.'-'.$map_id.'"><span id="rangeval-'.$filter.'-'.$map_id.'"></span></div>  
  					<div class="rangeslider '.$filter.'-'.$map_id.'" data-min="'.get_post_meta ( $map_id, "locate-anything-min-range-$filter", true ).'" data-max="'.get_post_meta ( $map_id, "locate-anything-max-range-$filter", true ).'" data-name="'.$filter.'-'.$map_id.'"  id="'.$filter.'-'.$map_id.'"></div></li>';
				
				} else {
					$pretty = get_post_meta( $map_id, 'locate-anything-load-pretty-checkbox', true );
					$r .= '<li class="filter-'.$selector.'" data-sort="'.$filter_selector_sort.'"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getCheckboxesForTaxonomy ( $filter, $filter."-$map_id" ,$allowed, $filter_selector_icon, $pretty, $categoryfilter, $selector, $filter_terms_orderby ) . '</li>';
				}
			}
		}
		$r = apply_filters( "locate_anything_add_custom_filters", $r, $map_id, $filters );
		$r .= '</ul></form>';
		return $r;
	}

	/**
	 * returns the filters HTML code
	 * 
	 * @param int $map_id        	
	 * @param array $filters        	
	 * @return html filter form HTML
	 */
	public static function generateFilterForm_single($map_id) {
		$filters = get_post_meta( $map_id, "locate-anything-show-filters", true );	
		$type = get_post_meta( $map_id, "locate-anything-source", true );
		$filter_terms_orderby = get_post_meta( $map_id, "locate-anything-filter_terms_orderby", true );			
		$r = '<form id="map-filters-'.$map_id.'" method="post" action="#"><ul id="category-filters-container1" class="category-filters-container">';
			if ( is_array( $filters ) && $type !== "user" ) {
				foreach ( $filters as $filter ) {
					$allowed = get_post_meta( $map_id, 'locate-anything-allowed-filters-value-'.$filter, true );
					$taxonomy = get_taxonomy( $filter );
					if ($type == $filter) { $post_type_filter = true; } else { $post_type_filter = false; } 
					if (!$post_type_filter) {
						if(!$taxonomy) continue;
						$selector= get_post_meta( $map_id, 'locate-anything-display-filter-' . $filter, true );
						$filter_selector_label = get_post_meta( $map_id, 'locate-anything-filter-selector-label-' . $filter, true );
						$filter_selector_icon = get_post_meta( $map_id, 'locate-anything-filter-selector-icon-' . $filter, true );
						if($filter_selector_label){
							$customlabel = $filter_selector_label;
						} else {
							$customlabel = $taxonomy->labels->name;
						}

						if ($taxonomy && $selector == "tokenize") {
							$r .= '<li class="filter-tokenize"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getSelectForTaxonomy( $filter, $filter."-$map_id", true, 9999, $allowed, $selector ) . '</li>';
						} elseif ($taxonomy &&  $selector== "select") {
							$r .= '<li class="filter-select"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getSelectForTaxonomy( $filter, $filter."-$map_id", false, 9999, $allowed, $selector ) . '</li>';
						} elseif ($selector == "range") {
							$r .= '<li class="filter-range"><label>' . $customlabel . '</label>
							<div id="rangedval-'.$filter.'-'.$map_id.'"><span id="rangeval-'.$filter.'-'.$map_id.'"></span></div>  
		  					<div class="rangeslider" min="'.get_post_meta ( $map_id, "locate-anything-min-range-$filter", true ).'" max="'.get_post_meta( $map_id, "locate-anything-max-range-$filter", true ).'" name="'.$filter.'-'.$map_id.'"  id="'.$filter.'-'.$map_id.'"></div></li>';
						
						} else {
							$pretty = get_post_meta( $map_id, 'locate-anything-load-pretty-checkbox', true );
							$r .= '<li class="filter-checkbox"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getCheckboxesForTaxonomy( $filter, $filter."-$map_id" ,$allowed, $filter_selector_icon, $pretty, '', $selector, $filter_terms_orderby ) . '</li>';
						}
					} else {
							$filter_selector_label = get_post_meta( $map_id, 'locate-anything-filter-selector-label-' . $filter, true );
							$filter_selector_icon = get_post_meta( $map_id, 'locate-anything-filter-selector-icon-' . $filter, true );
							if($filter_selector_label){
								$customlabel = $filter_selector_label;
							} else {
								$customlabel = $type;
							}
							$pretty = get_post_meta( $map_id, 'locate-anything-load-pretty-checkbox', true );
							$r .= '<li class="post-type-filter post-type-filter-'.$filter.' filter-checkbox"><label>' . $customlabel . '</label>' . Locate_And_Filter_Tools::getCheckboxesForPostType( $filter, $filter."-$map_id" ,$allowed, $filter_selector_icon, $pretty ) . '</li>';					
					}
				}
			}
		$r = apply_filters( "locate_anything_add_custom_filters", $r, $map_id, $filters );
		$r .= '</ul></form>';
		return $r;
	}
	
	/**
	 * returns Nav Template according to parameters
	 * 
	 * @param [int] $map_id
	 *        	map id
	 * @return html nav template html
	 */
	public static function getNavTemplate($map_id) {
		$div_tag = "<div name=\"NavMarker-' + marker.id+ '\" id=\"NavMarker-' + marker.id+ '\" class=\"map-nav-item\" data-latlng=\"' + LatLng + '\" data-marker-id=\"' + marker.id + '\">";
		$div_tag .= "<div class=\"map-nav-item-wrapper\">";
		$div_end = "</div></div>";
		$nav_template = get_post_meta ( $map_id, "locate-anything-default-nav-template", true );
		$nav_template = Locate_And_Filter_Public::decode_template ( $nav_template );
		return $div_tag . $nav_template . $div_end;
	}
	
	/**
	 * Returns Tooltip Template according to parameters
	 * 
	 * @param int $marker_id
	 *        	ID
	 * @return html hml of the tooltip template
	 */
	public static function getTooltipTemplate($marker_id) {
		$nav_template = get_post_meta ( $marker_id, "locate-anything-default-nav-template", true );
		$nav_template = Locate_And_Filter_Public::decode_template ( $nav_template );
		return $nav_template;
	}
	
	/**
	 * Returns Default Tooltip Template
	 * 
	 * @param int $map_id
	 *        	map ID
	 * @return HTML default template
	 */
	public static function getDefaultTooltipTemplate($map_id) {
		$nav_template = get_post_meta ( $map_id, "locate-anything-default-tooltip-template", true );
		$nav_template = Locate_And_Filter_Public::decode_template ( $nav_template );
		return $nav_template;
	}
	
	/**
	 * Returns basic markup list
	 * 
	 * @return array basic markup list and their template value
	 */
	public static function getBasicMarkupList($post_type=false) {
		$basic_markup= array (
				"title","post_link","street",
				"streetnum",
				"city",
				"country" ,
				"state" ,
				"zip",
				"content" ,
				"content_stripped",
				"excerpt"  ,
				"post_excerpt"  ,
				"small_thumbnail" ,
				"medium_thumbnail",
				"full_thumbnail",
				"author_name",
				"post_id",
				"lat",
				"lon",
				"dms"
		);
		/* Apply locate_anything_basic_markup hook */	
		if(!$post_type) $post_type = 'all';	
		
		/* If post type == basic return only the basic_markup array without applying filter */
		if($post_type!=="basic") $basic_markup=apply_filters("locate_anything_basic_markup",$basic_markup,$post_type);
		
		foreach ($basic_markup as $k=>$markup) {
			$markup=esc_attr($markup);
			$b["|".$markup."|"]="(marker.$markup?marker.$markup:'')" ;
		}
		return $b;
	}
	/**
	 * Decodes a template , returns template HTML/JS
	 * 
	 * @param string $template        	
	 * @return string template HTML/JS
	 */
	public static function decode_template($template) {		
		$template=implode("",explode("\\",$template));
		// Replaces linefeeds by BR and escaping single quotes
		$template = str_replace ( array ("\r\n","\r","\n","'" ,'"' ), array ("","",	"",	"\'" ,"\""), trim ( $template ) );
		/* get basic markup tags and decode them */
		$basic_markup_list = Locate_And_Filter_Public::getBasicMarkupList ();
		foreach ( $basic_markup_list as $tag => $subst ) {
			$subst = "'+decode(" . $subst . ")+'";
			$template = str_replace ( $tag, $subst, $template );
		}
		
		/* decode the additional fields */
		$additional_markup=array();
		$additional_field_list = Locate_And_Filter_Admin::getAdditional_field_list ();
		foreach ( $additional_field_list as $field ) {
			//$subst ="'+eval(map_instance).decodeTemplateVar(\"" . $field ["field_name"] . "\")";
			$subst = "'+(marker[\"" . $field ["field_name"] . "\"]?decode(marker[\"" . $field ["field_name"] . "\"]):'')+'";
			$template = str_replace ( '|' . $field ["post_type"] . "::" . sanitize_key ( remove_accents($field ["field_description"]) ) . '|', $subst, $template );
			$additional_markup[]=$field ["field_name"];
		}		
		/* decode the taxonomies */
		preg_match_all ( "/\|(.+?)\|/", $template, $tags );
		$tags = $tags [1];
		foreach ( $tags as $k => $tag ) {
			//if(array_search("|$tag|",array_keys($basic_markup_list))!==false || array_search($tag,$additional_markup)!==false || array_search($tag,$filters)!==false)
				$template = str_replace ( "|$tag|", "'+eval(map_instance).translateTaxonomy(\"" . $tag . "\",marker[\"" . $tag . "\"])+'", $template );
		}
		
		return $template;
	}
	
	/**
	 * Retrieves the markers' JSON from cache and outputs them
	 * expects $_REQUEST["map_id"]
	 * 
	 * @return void
	 */
	public function getMarkers() {		
		/* activate compression */
		header ( 'Content-type: application/json; charset=UTF-8' );
		//header ( 'Content-Encoding: gzip' );
		//ob_start ( 'ob_gzhandler' );
		
		/* cache mechanism */
		if (! isset ( $_REQUEST ["map_id"] ))
			return;
		else
			$map_id = sanitize_text_field($_REQUEST ["map_id"]);
		
		/* When in preview mode always disable cache */
		$isCacheEnabled = unserialize(get_option ( "locate-anything-option-enable-cache"));
		if ($isCacheEnabled == 0 && $map_id!=="preview") {
			/* cache disabled */
			Locate_And_Filter_Public::refresh_cache ( $map_id, true );
		} else {
			/* cache enabled */
			$cache_timeout = unserialize(get_option ( "locate-anything-option-cache-timeout"));			
			if (! $cache_timeout) $cache_timeout = 15;
			//$cache_file = plugin_dir_path ( __FILE__ ) . "../cache/cache-" . $map_id . ".json";
			$dir = wp_get_upload_dir();
			$cache_file = $dir['basedir'] ."/locateandfilter-cache/cache-" . $map_id . ".json";			
			$cache_life = 60 * $cache_timeout; // cache timeout, in seconds
			$filemtime = @filemtime ( $cache_file ); // returns FALSE if file does not exist
			if ($map_id!=="preview" && (! $filemtime || (time () - $filemtime >= $cache_life))) {
				Locate_And_Filter_Public::refresh_cache ($map_id, true );
			} else {
				echo Locate_And_Filter_Tools::get_local_file_contents( $cache_file );
			}
		}
		//ob_end_flush( 'ob_gzhandler');
		die ();
	}

/**
 * get the settings for this map
 * @param  int $map_id map ID
 * @return array    meta values for this map
 */
	public static function getMapParameters($map_id){			
		 $metas=array();
			foreach (get_post_meta($map_id) as $key => $value) {
					if(count($value)==1) $metas[$key]= current($value);
					else $metas[$key]=$value;
				}	
		  $metas["map_id"]=$map_id;
		  return $metas;
	}



public static function getTagsUsedInTemplate($posts,$post_type,$params,$basic_fields){
	$all_templates=$params["locate-anything-default-tooltip-template"];
	$all_templates.=" ".$params["locate-anything-default-nav-template"];
	foreach ( $posts as $post ) {
		if(Locate_And_Filter_Tools::getPostType($post_type)!==false) $post_params=Locate_And_Filter_Admin::getPostMetas($post->ID);
		$post_params=apply_filters("locate_anything_marker_params",$post_params,$post->ID,false);
		$all_templates.=" ".$post_params["locate-anything-marker-html-template"];
	}
	preg_match_all("/(.?)\|(.*?)\|/", $all_templates, $tags_used);
	$tags_used= array_merge(array_unique($tags_used[2]),$basic_fields);
	return $tags_used;
}


public static function defineMarkerIcon($post_params){
				/* define icon for this marker */
				$marker_type = $post_params['locate-anything-marker-type'] ;
				$awesome_marker = $post_params['locate-anything-marker-symbol'] ;
				$custom_marker = $post_params['locate-anything-custom-marker'] ;
				$symbolcolor = $post_params['locate-anything-marker-symbol-color'] ;
				$markercolor = $post_params['locate-anything-marker-color'] ;
				$customIconURL =$post_params['locate-anything-default-marker-media'];

				if ($marker_type == "standard") {
					if (! empty ( $custom_marker ))
						$marker = Locate_And_Filter_Assets::getMarkers ( $custom_marker );
				} elseif ($marker_type == "medialibrary"){
					$default_marker_id = 'basic-0';
					$marker  =Locate_And_Filter_Assets::getMarkers($default_marker_id);
				} else {
					if (! empty ( $awesome_marker )) {
						/* Awesome marker icon */
						$custom_marker = $awesome_marker . '-' . $markercolor . '-' . $symbolcolor;
						$marker  = ( object ) array (
								"id" => $custom_marker,
								"symbol" => $awesome_marker,
								"symbol-color" => $symbolcolor,
								"marker-color" => $markercolor 
						);
					}
				}				
				return array("id"=>$custom_marker,"marker"=>$marker);
}

public static function defineDefaultMarker($params){
		$marker_type = $params['locate-anything-marker-type'];
		$awesome_marker = $params['locate-anything-marker-symbol'];
		$symbolcolor =  $params['locate-anything-marker-symbol-color'];
		$markercolor = $params['locate-anything-marker-color'];
		$customIconURL = $params['locate-anything-default-marker-media'];


		if ($marker_type == "standard") {
			$default_marker_id = $params['locate-anything-default-marker'];
			$marker  =Locate_And_Filter_Assets::getMarkers($default_marker_id);
		} elseif ($marker_type == "medialibrary"){
			$default_marker_id = 'basic-0';
			$marker  =Locate_And_Filter_Assets::getMarkers($default_marker_id);
		} else {
			$default_marker_id = $params['locate-anything-marker-symbol'];
			$default_marker_id = $default_marker_id . '-' . $markercolor . '-' . $symbolcolor;
			$marker  = ( object ) array (
					"id" => $awesome_marker . '-' . $markercolor . '-' . $symbolcolor,
					"symbol" => $awesome_marker,
					"symbol-color" => $symbolcolor,
					"marker-color" => $markercolor
			);
		}
		return array("id"=>$default_marker_id,"marker"=>$marker);
	}

/**
 * AJAX handler for generateJSON
 * @param  int  $map_id map ID
 * @param  boolean $output  determines if the function outputs the cache file content or runs silently
 * @return void     
 */

	public function refresh_cache($map_id, $output = false) {
			if (! $map_id)	$map_id = sanitize_text_field( $_POST["map_id"] );
			Locate_And_Filter_Public::generateJSON(Locate_And_Filter_Public::getMapParameters( intval($map_id) ), $output);
	}

	/**
	 * Generates and saves a JSON encoded list of the markers to a file
	 * 
	 * @return void
	 */
	public static function generateJSON($params, $output = false) {		
		$map_id=$params['map_id'];
		//$cache_file = plugin_dir_path ( __FILE__ ) . "../cache/cache-" . $map_id . ".json";
		$dir = wp_get_upload_dir();
		$cache_file = $dir['basedir'] ."/locateandfilter-cache/cache-" . $map_id . ".json";			
		/* tries to set memory limit and timeout higher */
		try {
		ini_set ( 'memory_limit', '256M' );
		set_time_limit ( 900 );
		} catch(Exception $e) {}
		/* set up some variables */
		$locations = array ();
		$index = array ();
		$indexfields = array ();
		$in = array ();
		$markers = array ();
		$arrJSON = array ();
		
		if(!isset($params["locate-anything-source"],$params['locate-anything-googleplaces'], $params['locate-anything-marker-type'],$params['locate-anything-usergeolocation-zoom'])  ) die(_e("Preview not available yet.","locate-and-filter"));

		// get chosen post_type
		$post_type = $params["locate-anything-source"];
		if (! $post_type)	die ( );
			/* get filter list */
		$taxonomies =  $params["locate-anything-filters"];		
		$filters =  $params["locate-anything-show-filters"];		


		if(!is_array($taxonomies))	$taxonomies = unserialize($taxonomies);
		if(!is_array($filters))	$filters = unserialize($filters);
		

		if(is_array($taxonomies))foreach ($taxonomies as $taxonomy) {
		$allowed=$params['locate-anything-allowed-filters-value-'.$taxonomy];
		if(!is_array($allowed))$params['locate-anything-allowed-filters-value-'.$taxonomy]=unserialize($allowed);
		}	

		/* Define Default Marker icon */

	$defaultmarker=Locate_And_Filter_Public::defineDefaultMarker($params);
	$default_marker_id=$defaultmarker["id"];
	$markers[$default_marker_id]=$defaultmarker["marker"];




		/* retrieve the markers */
		if(Locate_And_Filter_Tools::getPostType($post_type)!==false) {
			/* Prepare the query for Locate_And_Filter_Tools::findSomething based on the  filters settings */
			$taxo_args=array();
			$query_args=array();
			$query_args =apply_filters("locate_anything_find_markers_query_args",$query_args ,$params);
			if(is_array($taxonomies) && $post_type!=="user") foreach ($taxonomies as $taxonomy) {
				$allowed=$params['locate-anything-allowed-filters-value-'.$taxonomy];
				if(is_array($allowed))$taxo_args[$taxonomy]=$allowed;
			}
			$posts = Locate_And_Filter_Tools::findSomething ( $post_type, $taxonomies,$taxo_args,$query_args);	
		}

		$posts =apply_filters("locate_anything_find_markers",$posts ,$params);

		/* Let's output JSON in chunks to avoid memory overload when there's a huge (>30000) numbers of markers */
		$cf = fopen ( $cache_file, "w" );
		fwrite ( $cf, '{"data":[' );
		$loop_counter = 0;
		/* get Tags actually used in the templates */
		$basic_fields=array("id","title","tooltip_template","lat","lng","street","streetnum","city","country","state" ,"zip","custom_marker","css_class");

		$tags_used=Locate_And_Filter_Public::getTagsUsedInTemplate($posts,$post_type,$params,$basic_fields);
		$tags_used=apply_filters("locate_anything_whitelist_params",$tags_used);
		// Loop : Generate Markers	
			foreach ( $posts as $post ) {
				$post_params=array();
				if($post_type!=="user") {
					$post_params=Locate_And_Filter_Admin::getPostMetas($post->ID);					
					$post_params["excerpt"]= $post->post_excerpt;
					$post_params["post_link"]=get_permalink ($post->ID);
					$post_params["post_excerpt"] = $post_params["post_excerpt"] ?? '';
				}
				$post_params["post_type"]=$post_type;
				$post_params = apply_filters("locate_anything_marker_params",$post_params,$post->ID,$map_id);

				$lat = $post_params["locate-anything-lat"];
				$lon = $post_params["locate-anything-lon"];
				/* no LatLng? No can do */
				if (! $lon || ! $lat) continue;

				if ($loop_counter > 0)	fwrite ( $cf, "," );
				
				$id = ( string ) $post->ID;
				/* define Marker icon for this element */
				$markerIcon=Locate_And_Filter_Public::defineMarkerIcon($post_params);	
				$custom_marker_id=	$markerIcon["id"];
				if(!empty($custom_marker_id)) {				
				$markers[$custom_marker_id]=$markerIcon["marker"];
				}
				
				/***********************/
				/*    PREPARE DATAS  */
				/********************/


				if($post_type!=="user") {
					/* apply WP filters on the content, then remove javascript script tags and inline styles */				
				remove_filter( 'the_content', 'wpautop' );
				
				// Removes temporarily the LocateAnything shortcodes
				Locate_And_Filter_Public::remove_shortcodes();

				$marker_content = apply_filters ( 'the_content', $post->post_content,7 );
				$marker_content = preg_replace ( '/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $marker_content );
				$marker_content = preg_replace ( '/<script\b[^>]*>(.*?)<\/script>/is', "", $marker_content );
			
				//Restores the shortcodes
				Locate_And_Filter_Public::setup_shortcodes();


				#prepare stripped content
				$stripped_content=strip_shortcodes(strip_tags($post->post_content,"<input><a></a><br><br/><p></p><b></b><em></em><i></i><span></span><ul><li></li></ul>"));
				$stripped_content=wp_trim_words($stripped_content,20, "..." );
				}

				/* add a css class to marker?*/
				$preset=$params["locate-anything-tooltip-preset"];
				$preset2=$post_params["locate-anything-tooltip-preset"];
				if($preset2!==false && !is_null($preset2) && $preset2!=="default") $css_preset=$preset2;
				else $css_preset=$preset;

				/* is it a nice tooltip? what the max height*/
				if($css_preset=="nice-tooltips"){
				$maxheight=$params["locate-anything-nice-tooltips-img-height"];
				$maxheight2=$post_params["locate-anything-nice-tooltips-img-height"];
				if(strlen($maxheight2)>2) $css_maxheight=$maxheight2;else $css_maxheight=$maxheight;
				$small_thumbnail="<div id='mask' style='max-height:".$css_maxheight."'>".get_the_post_thumbnail ( $id, 'thumbnail' )."</div>";
				$medium_thumbnail="<div id='mask' style='max-height:".$css_maxheight."'>".get_the_post_thumbnail ( $id, 'medium' )."</div>";
				} else {
					$small_thumbnail=get_the_post_thumbnail ( $id, 'thumbnail' );
					$medium_thumbnail=get_the_post_thumbnail ( $id, 'medium' );
				}
				
				

				/***********************/
				/*    ADD MARKER INFOS */
				/**********************/					

				/* basic marker infos */

				$add = array (
						"id" => $id ,
						"title" => $post->post_title,
						"tooltip_template" => "'" . Locate_And_Filter_Public::decode_template ( $post_params["locate-anything-marker-html-template"] ) . "'",
						"lat" => $lat,
						"lng" => $lon,						
						"street" =>  $post_params["locate-anything-street"] ,
						"streetnum" =>  $post_params["locate-anything-streetnumber"] ,
						"city" =>  $post_params["locate-anything-city"] ,
						"country" =>  $post_params["locate-anything-country"] ,
						"state" =>  $post_params["locate-anything-state"] ,
						"zip" =>  $post_params["locate-anything-zip"],
						"custom_marker" => $custom_marker_id,						
						"css_class"=> $css_preset
				);
				

				/* Type related marker infos */
				if($post_type!=="user") {
						$add["post_link"]=$post_params["post_link"];
						$add["author_name"]= get_the_author_meta( 'display_name', $post->post_author );
						$add["author_avatar"]= get_avatar($post->post_author);	
						$add["content"] =$marker_content;
						$add["content_stripped"]=  $stripped_content;
						$add["post_excerpt"]= sanitize_text_field ( $post_params["post_excerpt"] );
						$add["excerpt"]= sanitize_text_field ( $post_params["excerpt"] );
						$add["small_thumbnail"]=$small_thumbnail;
						$add["medium_thumbnail"]= $medium_thumbnail;
						$add["full_thumbnail"] =get_the_post_thumbnail ( $id, 'full' );
						$add["post_id"] = $id;
						if( get_post_meta( $id, 'locate-anything-lat')[0] ) {
							$add["lat"] = get_post_meta($id, 'locate-anything-lat')[0];
						} else {
							$add["lat"] = '';
						}
						if( get_post_meta( $id, 'locate-anything-lon')[0] ) {
							$add["lon"] = get_post_meta($id, 'locate-anything-lon')[0];
						} else {
							$add["lon"] = '';
						}
						if ( $add["lat"] && $add["lon"]){
							$add["dms"] =  Locate_And_Filter_Public::tag_addon_DECtoDMS( $add["lat"], $add["lon"] );
						} else {
							$add["dms"] = '';
						}
				}

				/* Add custom marker infos */
				$add=apply_filters("locate_anything_marker_vars",$add,$map_id,$id,$post_type);

				/* add additional fields for this post type */
				$additional_field_list = Locate_And_Filter_Admin::getAdditional_field_list ( get_post_type ( $post ) );
				foreach ( $additional_field_list as $field ) {
					$add [$field ["field_name"]] = $post_params[$field ["field_name"]] ;
					$tags_used[]=$field ["field_name"];
				}
					
					
			/* boil the markers info to the strict minimum*/

				foreach ($add as $tag=>$val) {
					if(array_search($tag,$tags_used)===false) unset($add[$tag]);
				}


				/* add custom filters vars */
				$add=apply_filters("locate_anything_filter_related_vars",$add,$map_id,$id,$post_type);
	

					/* add taxonomies for this post type */
				if($post_type!=="user") {
					/* both filters and taxonomies must appear in the marker's datas */
					if(is_array($taxonomies) && is_array($filters))$filter_taxonomies=array_unique(array_merge($filters,$taxonomies));
					else if(is_array($filters)) $filter_taxonomies=$filters;
					else if(is_array($taxonomies)) $filter_taxonomies=$taxonomies;
				}
				if (is_array ( $filter_taxonomies )) {
					foreach ( $filter_taxonomies as $taxonomy ) {
						if ( $taxonomy != $post_type ) {
							if(empty($taxonomy) || !taxonomy_exists($taxonomy)) continue;
							$arr_terms = array ();
							if($taxonomies===false || array_search($taxonomy,$taxonomies)===false) $allowed=false; else $allowed=$params['locate-anything-allowed-filters-value-'.$taxonomy];
												
							$terms = wp_get_post_terms ( $post->ID, $taxonomy,array ('fields' => 'all') );
							if (! is_array ( $terms ))
								$terms = array ();
							foreach ( $terms as $term ) {
								if(!$allowed || (is_array($allowed) && array_search($term->term_id,$allowed)!==false)){
								$arr_terms [] = $term->term_id;
								$in [$taxonomy] [$term->term_id] = '<span>'.$term->name.'</span>';
							}
							}
							$add [$taxonomy] = implode ( ",", $arr_terms );
							$index [$taxonomy] = $in [$taxonomy];
						} else {
							$allowed=$params['locate-anything-allowed-filters-value-'.$taxonomy];
							foreach ($allowed as $key => $allowed_value) {
								$arr_terms [] = $allowed_value;
								$in [$taxonomy] [$allowed_value] = '<span>'.get_post_field( 'post_name', $allowed_value ).'</span>';
								$add [$taxonomy] = strval($post->ID);
							}
							// $add [$taxonomy] = implode ( ",", $arr_terms );
							$index [$taxonomy] = $in [$taxonomy];
						}
					}
				}
				
				
				/* Indexes field names to save space */
				foreach ( $add as $k => $v ) {
					$newkey = array_search ( $k, $indexfields );
					if ($newkey === false) {
						$newkey = array_push ( $indexfields, $k ) - 1;
					}
					unset ( $add [$k] );
					$add [$newkey] = $v;
				}
				
				/* writes to cache */
				fwrite ( $cf, json_encode ( $add ) );
				$loop_counter ++;
			} /* end of loop */
		
		$defaults = array ();
		$defaults [] = array (
				"default_marker" => $default_marker_id 
		);		
		$index ["markers"] = $markers;
		$index ["fieldnames"] = $indexfields;
		// returns (array("data"=>$locations,"index"=>$index,"defaults"=>$defaults));
		fwrite ( $cf, '],"index": ' . json_encode ( $index ) );
		fwrite ( $cf, ',"defaults":' . json_encode ( $defaults ) );
		fwrite ( $cf, '}' );
		fclose ( $cf );
		if ($output) {
			echo Locate_And_Filter_Tools::get_local_file_contents( $cache_file );
			die ();
		}
		
	}

	/**
	 * tooltip tag addon
	 * pass in the latitude,longitude in DMS values and returns the converted DMS string.
	 * https://stackoverflow.com/questions/7927475/php-format-latitude-and-longitude-with-degrees-minuets-and-seconds
	 * @param  $latitude, $longitude
	 * @return 50° 6.578 N 29° 29.539 E
	 */
	public static function tag_addon_DECtoDMS($latitude, $longitude) {
	    $latitudeDirection = $latitude < 0 ? 'S': 'N';
	    $longitudeDirection = $longitude < 0 ? 'W': 'E';

	    $latitudeNotation = $latitude < 0 ? '-': '';
	    $longitudeNotation = $longitude < 0 ? '-': '';

	    $latitudeInDegrees = floor(abs($latitude));
	    $longitudeInDegrees = floor(abs($longitude));

	    $latitudeDecimal = abs($latitude)-$latitudeInDegrees;
	    $longitudeDecimal = abs($longitude)-$longitudeInDegrees;

	    $_precision = 3;
	    $latitudeMinutes = round($latitudeDecimal*60,$_precision);
	    $longitudeMinutes = round($longitudeDecimal*60,$_precision);

	    return sprintf('%s%s° %s %s %s%s° %s %s',
	        $latitudeNotation,
	        $latitudeInDegrees,
	        $latitudeMinutes,
	        $latitudeDirection,
	        $longitudeNotation,
	        $longitudeInDegrees,
	        $longitudeMinutes,
	        $longitudeDirection
	    );

	}

	/**
	 * Outputs the map markup and JS
	 * 
	 * @param [array] $atts
	 *        	shortcode arguments
	 * @param [string] $content	post content
	 * @return [void]
	 */
	public static function outputMapMarkup_single($atts, $content) {
		if(!isset($atts["map_id"])) return;	
		if(is_admin()) return;

		$plugin_public = new Locate_And_Filter_Public(null, null);      
    	$plugin_public->enqueue_scripts();
        $plugin_public->enqueue_styles();
        

		$params ["map-width"]=get_post_meta ( $atts ["map_id"], 'locate-anything-map-width', true ) ;
		$params ["map-height"]=get_post_meta ($atts ["map_id"] , 'locate-anything-map-height', true );		

		$content .= "<!-- Map container -->	
				<style>\n";
				if(get_post_meta ( $atts ["map_id"], 'locate-anything-tooltip-style', true )=="squared") 
				 $content .= ".leaflet-popup-content-wrapper {border-radius: 0 !important;}\n";				
				if(get_post_meta ( $atts ["map_id"], 'locate-anything-marker-size', true )) 
				 $content .= '#map-container-'.$atts ["map_id"]." .awesome-marker i {font-size:".get_post_meta ( $atts ["map_id"], 'locate-anything-marker-size', true )."px !important;}\n";	
				 $content .= '#map-container-'.$atts ["map_id"].'{width:'.$params ["map-width"].';height:'.$params ["map-height"].' !important; }
				</style>
						<div id="map-container-'.$atts ["map_id"].'" >
							<!-- Progress bar-->	
						<div id="progress-wrapper">					
						<div class="progress"  style="background-color:transparent" id="progress-'.$atts ["map_id"].'"><div class="progress-bar" id="progress-bar-'.$atts ["map_id"].'"></div></div>
						</div></div>' . Locate_And_Filter_Public::generateMapJS_single ( $atts ["map_id"], "map-container-".$atts ["map_id"] );
		// apply filters on outputMapMarkup
		$content = apply_filters("locate_anything_alter_outputMapMarkup",$content);
		return $content;
	}

	/**
	 * Outputs the JS required to setup and display the map, used in the template called by createMap()
	 * 
	 * @param [int] $map_id        	
	 * @param [string] $map_container
	 *        	: HTML id of the map container
	 * @return void
	 */
	public static function generateMapJS_single($map_id, $map_container) {
		/* in preview mode the parameters are transmitted via $_POST directly*/
		if($map_id=="preview"){											
				$settings = $_POST;	
				$filters = 	$settings["locate-anything-show-filters"];	
							
		} else {
			$settings=Locate_And_Filter_Public::getMapParameters($map_id);
			$filters = unserialize($settings["locate-anything-show-filters"]);
		}
		//echo "<pre>", var_dump($settings), "</pre>";
		/* create parameter array */
		$params = array ();

		$params["bing-key"] = Locate_And_Filter_Admin::getBingAPIKey();
		$loadjs = unserialize (get_option ( 'locate-anything-option-loadjs' ));
		if(!is_array($loadjs)) $loadjs = array ();
		//google
		if (array_search ( 'google', $loadjs ) !== false){
			$params["load-google"] = true;
		} else {
			$params["load-google"] = false;
		}
		//bing
		if (array_search ( 'bing', $loadjs ) !== false){
			$params["load-bing"] = true;
		} else {
			$params["load-bing"] = false;
		}
		//yandex
		if (array_search ( 'yandex', $loadjs ) !== false){
			$params["load-yandex"] = true;
		} else {
			$params["load-yandex"] = false;
		}

		/* width & height*/
		$params ["map-width"]=$settings['locate-anything-map-width'] ;
		$params ["map-height"]=$settings['locate-anything-map-height'] ;
		/* hide splashscreen*/
		$params["hide-splashscreen"] = $settings["locate-anything-hide-splashscreen"] ;
		/* refresh navlist as you go*/
		$params ["display_only_inbound"]=$settings['locate-anything-display_only_inbound'] ;
		/* autogeocode */
		$params ["autogeocode"] = trim($settings['locate-anything-usergeolocation-zoom']);
		/* mousewheel*/
		$params ["scrollWheelZoom"] = trim($settings['locate-anything-scrollWheelZoom']);
		/* navlist_event*/
		$params ["navlist_event"] = trim($settings['locate-anything-navlist-event']);	
			/* Start position */
		$params ["start_position"] = $settings['locate-anything-start-position'];
		if (empty ( $params ["start_position"] ))
			$params ["start_position"] = "51.505, -0.09";
		$tmp = explode ( ",", $params ["start_position"] );
		$params ["initial-lat"] = trim ( $tmp [0] );
		$params ["initial-lon"] = trim ( $tmp [1] );
		/* Overlay */
		$params ["overlay"] = $settings['locate-anything-map-provider'];
		
		/* custom map provider*/		
		if($params ["overlay"]=="custom-0"){
			$params ["overlay"] = (object)array("id"=>1,
					"name"=> 'Custom',
					"url"=>$settings["locate-anything-custom-map-provider"],
					"attribution"=> '',
					"maxZoom"=>20,
					"minZoom"=>1,
					"zoom"=>10);
		} else if ( $params ["overlay"] == "addon-0" ) {
				$params ["overlay"] = (object)array(
					"attribution"=> 'overlay-addon',
				);
			$params ["overlay-addon"] = unserialize(get_option ("locate-anything-option-map-provider-addon"));
			$params ["overlay-addon-accessToken-jawg"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-jawg"));
			$params ["overlay-addon-customstyle-jawg"] = unserialize(get_option ("locate-anything-option-map-provider-addon-customstyle-jawg"));
			$params ["overlay-addon-accessToken-thunderforest"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-thunderforest"));
			$params ["overlay-addon-accessToken-mapbox"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-mapbox"));
			$params ["overlay-addon-accessToken-maptiler"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-maptiler"));
			$params ["overlay-addon-accessToken-openweathermap"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-openweathermap"));
			$params ["overlay-addon-accessToken-here"] = unserialize(get_option ("locate-anything-option-map-provider-addon-accessToken-here"));			
		} else {
			$overlays = Locate_And_Filter_Assets::getMapOverlays ();			
			$params ["overlay"] = $overlays [$params ["overlay"]];
			$params ["overlay-addon"] = '';
			$params ["overlay-addon-accessToken-jawg"] = '';
			$params ["overlay-addon-customstyle-jawg"] = '';
			$params ["overlay-addon-accessToken-thunderforest"] = '';
			$params ["overlay-addon-accessToken-mapbox"] = '';
			$params ["overlay-addon-accessToken-maptiler"] = '';
			$params ["overlay-addon-accessToken-openweathermap"] = '';
			$params ["overlay-addon-accessToken-here"] = '';						
		}
		$maxZoom = $settings['locate-anything-max-zoom'];
		if (! $maxZoom)
			$maxZoom = $params ["overlay"]->maxZoom;
		$minZoom = $settings['locate-anything-min-zoom'];
		if (! $minZoom)
			$minZoom = $params ["overlay"]->minZoom;
		$params ["overlay"] = '{url:"' . $params ["overlay"]->url . '",attribution:"' . sanitize_text_field ( $params ["overlay"]->attribution ) . '" ,maxZoom:' . $maxZoom . ' ,minZoom:' . $minZoom . '}';
		$params ["initial-zoom"] = $settings['locate-anything-start-zoom'];
		$params ["single-zoom"] = $settings['locate-anything-single-zoom']; 
		if (empty ( $params ["initial-zoom"] ))
			$params ["initial-zoom"] = 1;
		if (empty ( $params ["single-zoom"] ))
			$params ["single-zoom"] = 9;
		$params ["googleplaces"] = $settings["locate-anything-googleplaces"];
		$params ["map-id"] = $map_id;
		$params ["map-container"] = $map_container;
		$params ["max_nav_item_per_page"] = $settings['locate-anything-nav-number'];
		if (empty ( $params ["max_nav_item_per_page"] ))
			$params ["max_nav_item_per_page"] = 10;
		$params ["style-hue"] = $settings['locate-anything-googlemaps-hue'];
		//var_dump($params);
		?>

		<script type="text/javascript">
			(async() => {
			    //console.log("waiting for jQuery");

			    while(!window.hasOwnProperty("jQuery")) {
			        await new Promise(resolve => setTimeout(resolve, 100));
			    }

				var current_map;
				jQuery(window).on('load', function () { 
						var map_id='<?php echo $map_id?>';
						<?php
							if (Locate_And_Filter_Public::check_license_key('label')===false) {?>
								<!-- jQuery("#<?php echo $map_container?>").append("<div style='background:grey;opacity:0.6;width:100%;height:1.5em;z-index:1500;position:absolute;bottom:0;text-align:left;padding-left:10px'><a style='cursor:pointer;text-decoration:none;color:#fff;' href='#' target='_blank'>Powered by LocateAndFilter</div>"); -->
						<?php	} ?>

							
						/* setting up the map */ 
					var params = {
						"instance_id":"locate_anything_map_<?php echo $map_id?>",
						"map-id": "<?php echo $map_id?>",
						"map-container":'<?php echo $map_container?>',
						"initial-lat": <?php echo $params["initial-lat"]?>,
						"initial-lon": <?php echo $params["initial-lon"]?>,
						"initial-zoom": <?php echo $params["initial-zoom"]?>,
						"single-zoom": <?php echo $params["single-zoom"]?>,
						"autogeocode" :'<?php echo $params["autogeocode"]?>',
						"display_only_inbound" : '<?php echo $params["display_only_inbound"]?>',
						"overlay" : <?php echo $params["overlay"]?>,
						"googleplaces" : <?php echo $params["googleplaces"]?>,
						"max_nav_item_per_page" : <?php echo $params["max_nav_item_per_page"]?>,
						<?php if($params["style-hue"]) echo '"style-hue":"'.$params["style-hue"].'",'?>
						"scrollWheelZoom" : <?php echo $params["scrollWheelZoom"]?>,
						"navlist_event" : '<?php echo  $params["navlist_event"]?>',
						"hide-splashscreen" : '<?php echo $params["hide-splashscreen"]?>',
						"kml_file" :  '<?php echo $settings["locate-anything-kml-file"]?>',
						"kml_fillColor" :  '<?php echo $settings["locate-anything-kml_fillColor"]?>',
						"kml_weight" :  '<?php echo $settings["locate-anything-kml_weight"]?>',
						"kml_opacity" :  '<?php echo $settings["locate-anything-kml_opacity"]?>',
						"kml_color" :  '<?php echo $settings["locate-anything-kml_color"]?>',
						"kml_dashArray" :  '<?php echo $settings["locate-anything-kml_dashArray"]?>',
						"kml_fillOpacity" :  '<?php echo $settings["locate-anything-kml_fillOpacity"]?>',
						"bing-key"  :	'<?php echo $params["bing-key"]?>',
						"load-google"	:	'<?php echo $params["load-google"]?>',
						"load-bing"	:	'<?php echo $params["load-bing"]?>',
						"load-yandex"	:	'<?php echo $params["load-yandex"]?>',
						"overlay-addon"	:	'<?php echo $params ["overlay-addon"]?>',
						"overlay-addon-accessToken-jawg"	:	'<?php echo $params ["overlay-addon-accessToken-jawg"]?>',
						"overlay-addon-customstyle-jawg"	:	'<?php echo $params ["overlay-addon-customstyle-jawg"]?>',
						"overlay-addon-accessToken-thunderforest"	:	'<?php echo $params ["overlay-addon-accessToken-thunderforest"]?>',
						"overlay-addon-accessToken-mapbox"	:	'<?php echo $params ["overlay-addon-accessToken-mapbox"]?>',
						"overlay-addon-accessToken-maptiler"	:	'<?php echo $params ["overlay-addon-accessToken-maptiler"]?>',
						"overlay-addon-accessToken-openweathermap"	:	'<?php echo $params ["overlay-addon-accessToken-openweathermap"]?>',
						"overlay-addon-accessToken-here"	:	'<?php echo $params ["overlay-addon-accessToken-here"]?>'						
					};

						/* define instance name*/
						var map_instance="locate_anything_map_"+map_id;
						
						/* instanciate filter class */
					eval("var "+map_instance+"=new leaflet_filters_class(params);");				 
						/* loading ... */						
					 eval(map_instance).showLoader(true);
					 <?php if (has_filter("locate_anything_beforeCreateMap")) echo apply_filters("locate_anything_beforeCreateMap",$map_id);?>
					 	/* Initialize Map  */	
					eval(map_instance).createMap();
					/*   Register filters, property_name is the name of the property as shown in the JSON datas  */
					var custom_filters= [<?php if(is_array($filters)) foreach ($filters as $filter) echo '{"property_name":"'.$filter.'","html_id" : "#'.$filter.'-'.$map_id.'"},';?>];
					
					eval(map_instance).register_filters(custom_filters);
					/* Override nav item template */	 	
					eval(map_instance).template_nav_item = function(marker,LatLng) {	
						var template='<?php echo Locate_And_Filter_Public::getNavTemplate($map_id)?>';
						return template;
					};
					/*  define callback function */
					var createEverything_<?php echo $map_id?> = function(result){	
						var cpt=0;
						var current_marker = {};	
						var current_marker_;
									 	
						for(var i in result["data"]){	
							var marker={};	
								/*  The JSON containing the markers data is indexed to save space and generation time 
								*	Rebuilds the object with original field names
								*/			
		 					var indexed_marker=result["data"][i];

		 					for(var k in indexed_marker) {
		 						marker[result["index"]["fieldnames"][k]]=indexed_marker[k]; 						
		 					}
		 					//console.log(marker);
								/* Marker creation : set timeout is used to allow the progressbar to update */
							setTimeout(function(marker){											
									/* define Tooltip HTML*/	
									<?php if($map_id=="preview") {?>
										var default_tooltip_template='<?php echo Locate_And_Filter_Public::decode_template ($settings['locate-anything-default-tooltip-template'])?>';
										<?php } else {?>
								var default_tooltip_template='<?php echo Locate_And_Filter_Public::getDefaultTooltipTemplate($map_id)?>';					
								<?php } ?>
									// length must be superior to 2 because of the inclusion of 2 single quotes to delimitate the output
								
								if(marker.tooltip_template.length>2) {									
									var html = eval(marker.tooltip_template);
									
								}
								else var html=default_tooltip_template;
									/* define icon*/
								var customIcon=null;
								if(marker.custom_marker){									
								 customIcon= eval(map_instance).getMarkerIcon(marker.custom_marker);		
								} else customIcon=false;					
									/* No custom icon, use default icon for this map */
								if(!customIcon) customIcon= eval(map_instance).getMarkerIcon(result["defaults"][0].default_marker);	
								
								/* updates progress bar */
								eval(map_instance).updateProgressBar(cpt++, result["data"].length, 1000);
								/* creates the marker */
								eval(map_instance).createMarker(marker.lat,marker.lng,html,marker,customIcon);
								if ( marker.id == <?php echo get_the_ID(); ?>) {
									current_marker['lat'] = marker.lat;
									current_marker['lng'] = marker.lng;
									current_marker_ = marker.lat +','+ marker.lng;
								}
								//console.log(current_marker);
							},1,marker);							
						}	

						setTimeout(function(){						
							/* Render Map */
							//console.log(current_marker);
							eval(map_instance).render_map_single(eval(map_instance).markers,current_marker);
							eval(map_instance).update_markers();						
							/*	Creation Nav */			
							eval(map_instance).updateNav(0);
							/* hide loader */
							eval(map_instance).showLoader(false);	
							/* stores the map in Jquery for easier access*/	
							current_map=eval(map_instance)	;
							<?php if (has_filter("locate_anything_afterGenerateJS")) echo apply_filters("locate_anything_afterGenerateJS",$map_id)?>
							},250);
					}

					/*   JSON : Retrieve markers data */
					eval(map_instance).getData("<?php echo admin_url( 'admin-ajax.php'); ?>?action=getMarkers&map_id=<?php echo $map_id?>",createEverything_<?php echo $map_id?>)
					//console.log(map_instance);
					/* call Tokenize for nice selects */
					if(jQuery.tokenize){
					var token1=jQuery('#map-filters-'+map_id+' .tokenize-1').tokenize({maxElements:"1",onRemoveToken:function(e,f){eval(map_instance).update_markers();},onAddToken:function(e,f){eval(map_instance).update_markers();}});
					var token=jQuery('#map-filters-'+map_id+' .tokenize').tokenize({maxElements:"9999",onRemoveToken:function(e,f){eval(map_instance).update_markers();},onAddToken:function(e,f){eval(map_instance).update_markers();}});
						
					} 
					<?php 
					if ( $settings['locate-anything-show-attribution-label'] == 0 )  {
						echo "/* Hide attribution */ 
						jQuery('.leaflet-control-attribution').hide();
						";
					} ?>					
					<?php $load_chosen = unserialize( get_option('locate-anything-option-load-chosen') );
					if ( $load_chosen ) {
						echo "/* load chosen */
						jQuery('.filter-select select').chosen({width:'250px',allow_single_deselect:'true'});
						";	
					} ?>				
				});
    			//console.log("jQuery is loaded.");
			})();				
		</script>
	<?php
		
	}



}