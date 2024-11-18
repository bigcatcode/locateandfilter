<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://monothemes.com/
 * @since      1.0.0
 *
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package Locate_And_Filter
 * @subpackage Locate_And_Filter/admin
 * @author AMonin <monothemes@gmail.com>
 */
class Locate_And_Filter_Admin
{
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
	 * The Gmaps key for this app, used for geocoding in the admin
	 *
	 * @since 1.0.1
	 * @access private
	 * @var string $app_Gmaps_key
	 		 The GoogleMaps key.
	 */
	 static $Gmaps_API_key = 'AIzaSyC0lZ7MbGfowxNTZva7fAyeTJ18dAWMUp0';
	 static $Bing_API_key = 'An5y6EfmR_Tmk0nMXSWFQD7JZ2sc5Zv793InR2eKkVmMpwxfa_XOzlEmIEPXIol9';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name
	 *        	The name of this plugin.
	 * @param string $version
	 *        	The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
		$this->plugin_name = $plugin_name;
		$this->version = '1.4.128';		
	}


	/**
	 * Savezs WP root path for use in preview file
	 * 
	 *
	 * @since    1.1.98
	 * @access   private
	 */

	public static function saveRootPath() {
	    global $wp_filesystem;

	    // Initialize WP Filesystem
	    if (empty($wp_filesystem)) {
	        require_once( ABSPATH . 'wp-admin/includes/file.php' );
	        WP_Filesystem();
	    }

	    // Get the upload directory
	    $dir = wp_get_upload_dir();
	    $path = $dir['basedir'] . "/locateandfilter-cache";

	    // Check if the path is writable using WP Filesystem methods
	    if (!$wp_filesystem->is_writable($path)) {
	        // Try changing permissions if not writable
	        if (!$wp_filesystem->chmod($path, 0777)) {
	            return;
	        }
	    }

	    // Construct the path to the file
	    $file_path = $path . '/path2root';

	    // Get the real path of wp-load.php
	    $fpath = realpath(get_home_path()) . "/wp-load.php";

	    if (is_file($fpath)) {
	        // Write the path to the file using WP_Filesystem
	        $wp_filesystem->put_contents($file_path, $fpath);
	    } else {
	        // Try prefixes in case wp-load.php is not in the default location
	        $try_those_prefixes = array("admin", "private");
	        foreach ($try_those_prefixes as $prefix) {
	            $fpath = realpath(get_home_path()) . "/$prefix/wp-load.php";
	            if (is_file($fpath)) {
	                $wp_filesystem->put_contents($file_path, $fpath);
	                break;
	            }
	        }
	    }
	}



	/**
	 * Register new  mime types
	 * 
	 *
	 * @since    1.1.4
	 * @access   private
	 */
	public function add_mime_types($mime_types){
	    $mime_types['kml'] = 'application/vnd.google-earth.kml+xml'; //Adding kml extension   
	    $mime_types['svg'] = 'image/svg+xml';    
	    return $mime_types;
	}

	/**
	 * serves the Gmaps Key
	 *
	 * @since 1.0.0
	 */
	public static function getGmapsAPIKey() {
		$key = unserialize (get_option("locate-anything-option-googlemaps-key"));
		if($key===false || empty($key)) $key = Locate_And_Filter_Admin::$Gmaps_API_key;		
		return $key;
	}

	/**
	 * serves the Bing Key
	 *
	 * @since 1.0.0
	 */
	public static function getBingAPIKey() {
		$key = unserialize (get_option("locate-anything-option-bingmaps-key"));
		if($key===false || empty($key)) $key = Locate_And_Filter_Admin::$Bing_API_key;
		return $key;
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();
		$allowed_post_types = unserialize (get_option ( 'locate-anything-option-sources' ));		
		if(!is_array($allowed_post_types)) $allowed_post_types=array();
		$allowed_post_types[]="locateandfiltermap";
		$allowed_post_types[]="locateanythingmarker";
		if(strpos($screen->base,'user')===false && !in_array($screen->post_type,$allowed_post_types)) return;

		wp_enqueue_media();
		wp_enqueue_script($this->plugin_name . "-adminjs", plugin_dir_url(__FILE__) . 'js/locate-and-filter-admin.js', array (
			'jquery'
		) , $this->version, false);
		// leaflet JS
		wp_enqueue_script($this->plugin_name . "-leaflet", plugin_dir_url(__FILE__) . '../public/js/leaflet-0.7.3/leaflet.js', array (
			'jquery'
		) , $this->version, false);
		// leaflet-filters JS
		wp_enqueue_script($this->plugin_name . "-leaflet-filters", plugin_dir_url(__FILE__) . '../public/js/leaflet-filters/leaflet-filters.js', array(
			$this->plugin_name . "-leaflet"
		) , $this->version, false);
		wp_enqueue_script($this->plugin_name . "-googleAPI", "https://maps.googleapis.com/maps/api/js?key=".$this->getGmapsAPIKey()."&v=3.exp&libraries=places&language=en" . unserialize(get_option("locate-anything-option-map-language")) , array(
			$this->plugin_name . "-leaflet-filters"
		) , $this->version, false);
		wp_enqueue_script($this->plugin_name . "-select2", plugin_dir_url(__FILE__) . 'js/select2_4.0.6-rc.1/js/select2.min.js');
		// Awesome markers
		wp_enqueue_script($this->plugin_name . "-awesomemarkers", plugin_dir_url(__FILE__) . '../public/js/leaflet.awesome-markers-2.0/leaflet.awesome-markers.js', array(
			$this->plugin_name . "-leaflet"
		) , $this->version, false);
		// annotation plugin
		wp_enqueue_script($this->plugin_name . "-anno", plugin_dir_url(__FILE__) . 'js/anno/anno.js', array(
			'jquery'
		) , $this->version, false);
		wp_enqueue_script($this->plugin_name . "-anno-dependency", plugin_dir_url(__FILE__) . 'js/anno/scrollintoview/jquery.scrollintoview.min.js', array() , $this->version, false);
		// Google Tiles
		wp_enqueue_script($this->plugin_name . "-googleTiles", plugin_dir_url(__FILE__) . '../public/js/leaflet-plugins-master/layer/tile/Google.js', array(
			$this->plugin_name . "-leaflet"
		) , $this->version, false);
		// leaflet markerCluster JS
		wp_enqueue_script($this->plugin_name . "-leaflet-marker-cluster", plugin_dir_url(__FILE__) . '../public/js/leaflet.markercluster/leaflet.markercluster.js', array(
			'jquery'
		) , $this->version, false);
		// google autocomplete
		wp_enqueue_script($this->plugin_name . "-googleautojs", plugin_dir_url(__FILE__) . '../public/js/leaflet-google-autocomplete/js/leaflet-google-autocomplete.js', array(
			$this->plugin_name . "-googleAPI") , $this->version, false);
		// Edit Area js
		wp_enqueue_script($this->plugin_name . "-editArea", plugin_dir_url(__FILE__) . '../admin/js/edit_area/edit_area_full.js' , array('jquery') , $this->version, false);
		// providers
		wp_enqueue_script ( $this->plugin_name . "-leaflet-providers", plugin_dir_url ( __FILE__ ) . '../public/js/leaflet-providers/leaflet-providers.js', array (
				'jquery' 
		), $this->version, false );	
		
		

	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		$screen = get_current_screen();
		
		$allowed_post_types = unserialize (get_option ( 'locate-anything-option-sources' ));		
		if(!is_array($allowed_post_types)) $allowed_post_types=array();
		
		$allowed_post_types[]="locateandfiltermap";
		$allowed_post_types[]="locateanythingmarker";
		if(strpos($screen->base,'user')===false && !in_array($screen->post_type,$allowed_post_types)) return;
		
		wp_enqueue_style($this->plugin_name . "-admincss", plugin_dir_url(__FILE__) . 'css/locate-and-filter-admin.css', array() , $this->version, 'all');
		wp_enqueue_style($this->plugin_name . "-annocss", plugin_dir_url(__FILE__) . 'js/anno/anno.css', array() , $this->version, 'all');
		
		wp_enqueue_style($this->plugin_name . "-select2css", plugin_dir_url(__FILE__) . "js/select2_4.0.6-rc.1/css/select2.min.css", array() , $this->version, 'all');
		// Ionicons
		wp_enqueue_style($this->plugin_name . "-ioniconscss", 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array() , $this->version, 'all');
		// Awesome markers
		wp_enqueue_style($this->plugin_name . "-awesomemarkerscss", plugin_dir_url(__FILE__) . '../public/js/leaflet.awesome-markers-2.0/leaflet.awesome-markers.css', array() , $this->version, 'all');
		// leaflet css
		wp_enqueue_style($this->plugin_name . "-leaflet", plugin_dir_url(__FILE__) . '../public/js/leaflet-0.7.3/leaflet.css', array() , $this->version, 'all');
		// leaflet-filters css
		wp_enqueue_style($this->plugin_name . "-leaflet-filters", plugin_dir_url(__FILE__) . '../public/js/leaflet-filters/leaflet-filters.css', array() , $this->version, 'all');
		// leaflet markerCluster css
		wp_enqueue_style($this->plugin_name . "-leaflet-marker-cluster-default", plugin_dir_url(__FILE__) . '../public/js/leaflet.markercluster/MarkerCluster.Default.css', array() , $this->version, 'all');
		wp_enqueue_style($this->plugin_name . "-leaflet-marker-cluster", plugin_dir_url(__FILE__) . '../public/js/leaflet.markercluster/MarkerCluster.css', array() , $this->version, 'all');
		// leaflet Google automplete CSS
		wp_enqueue_style($this->plugin_name . "-googleauto", plugin_dir_url(__FILE__) . '../public/js/leaflet-google-autocomplete/css/leaflet-google-autocomplete.css', array() , $this->version, 'all');		
	}
	/**
	 * Adds metaboxes to the post types selected in the options page
	 */
	public function add_post_meta_boxes() {
		// fetch the post types where LocateAnything will be active
		$selected_post_types = unserialize(get_option('locate-anything-option-sources'));
		// add the LocateAnything Metabox for each of them
		if (is_array($selected_post_types)) $selected_post_types[] = "locateanythingmarker";
		else $selected_post_types = array(
			"locateanythingmarker"
		);
		
		foreach ($selected_post_types as $type) {
			add_meta_box('locate-and-filter-class', // Unique ID
			esc_html__('LocateAndFilter', 'locateandfilter') , // Title
			'Locate_And_Filter_Admin::post_class_meta_box', // Callback function
			$type, // Admin page (or post type)
			'normal', // Context
			'high'); // Priority
			
		}
	}



	public function remove_anonymous_object_action( $tag, $class, $method, $priority=null ){

	    if( empty($GLOBALS['wp_filter'][ $tag ]) ){
	        return;
	    }

	    foreach ( $GLOBALS['wp_filter'][ $tag ] as $filterPriority => $filter ){
	       /* if( !($priority===null || $priority==$filterPriority) )
	            continue;*/

	        foreach ( $filter as $identifier => $function ){
	        	try {
	            if( is_array( $function) && !is_a($function['function'],'Closure')
	                and is_a( $function['function'][0], $class )
	                and $method === $function['function'][1]
	            ){
	                remove_action(
	                    $tag,
	                    array ( $function['function'][0], $method ),
	                    $filterPriority
	                );
	            }
	        }
	     catch(Exception $e) {	$done =false;}
	    }
	}
	}

	/**
	 * DEPRECATED : unload all conflicting 3rd party plugin actions before preview
	 */
	public function clear_hooks_for_preview() {	
		if(isset($_GET["locateAnything_preview"])){	
			// Lifter LMS	
			Locate_And_Filter_Admin::remove_anonymous_object_action( 'wp_enqueue_scripts','LLMS_Frontend_Assets', 'enqueue_styles');
			Locate_And_Filter_Admin::remove_anonymous_object_action( 'wp_enqueue_scripts','LLMS_Frontend_Assets', 'enqueue_scripts');
			Locate_And_Filter_Admin::remove_anonymous_object_action( 'wp_loaded','LLMS_AJAX', 'register_script');
			Locate_And_Filter_Admin::remove_anonymous_object_action( 'wp_footer','LLMS_Frontend_Assets', 'wp_footer' );	
	}
}

	/**
	 * DEPRECATED : Loads the preview pane
	 */
	public function load_preview() {	
		if(isset($_GET["locateAnything_preview"])){	
			include(plugin_dir_path(dirname(__FILE__)).'/admin/partials/locate-and-filter-preview.php');
			die();
		}	
	}

	/**
	 * Adds metaboxes to the post types selected in the options page
	 */
	public function add_admin_meta_boxes() {
		add_meta_box('locate-and-filter-class', // Unique ID
		esc_html__('LocateAndFilter - Wordpress Plugin', 'locateandfilter') , // Title
		'Locate_And_Filter_Admin::admin_class_meta_box', // Callback function
		'locateandfiltermap', // Admin page (or post type)
		'normal', // Context
		'high'); // Priority
		
	}
	
	/**
	 * Checks cache permissions, called on action admin_notices
	 *
	 */
	public static function check_cache_permissions() {
	    global $wp_filesystem;

	    // Initialize WP Filesystem
	    if (empty($wp_filesystem)) {
	        require_once( ABSPATH . 'wp-admin/includes/file.php' );
	        WP_Filesystem();
	    }

	    $dir = wp_get_upload_dir();
	    $path = $dir['basedir'] . "/locateandfilter-cache";

	    // Check if the directory exists, if not create it using WP_Filesystem
	    if (!$wp_filesystem->exists($path)) {
	        if (!$wp_filesystem->mkdir($path, 0777)) {
	            echo '<div class="notice notice-error"><p>' . sprintf(
	                /* translators: %s is the directory path that needs write permissions */
	                esc_html__('<b>Error</b> : Could not create directory. Please add write permissions on the following directory: %s', 'locateandfilter'),
	                esc_html($path)
	            ) . '</p></div>';
	            return;
	        }
	    }

	    // Check if the directory is writable
	    if (!$wp_filesystem->is_writable($path)) {
	        if (!$wp_filesystem->chmod($path, 0777)) {
	            echo '<div class="notice notice-error"><p>' . sprintf(
	                /* translators: %s is the directory path that needs write permissions */
	                esc_html__('<b>Error</b> : Please add write permissions on the following directory: %s', 'locateandfilter'),
	                esc_html($path)
	            ) . '</p></div>';
	        }
	    }
	}


	/**
	 * Displays the settings page
	 *
	 */
	public static function admin_settings_page() {		
		include (plugin_dir_path(__FILE__) . 'partials/locate-and-filter-settings-admin.php');
	}
	/**
	 * Display the admin meta box.
	 *
	 */
	public static function admin_class_meta_box($object, $box) {
		include (plugin_dir_path(__FILE__) . 'partials/locate-and-filter-metabox-admin.php');
	}
	/**
	 * Display the post meta box.
	 *
	 */
	public static function post_class_meta_box($object) {
		include (plugin_dir_path(__FILE__) . 'partials/locate-and-filter-metabox-post.php');
	}
	/**
	 * Display the user meta box.
	 *
	 */
	public static function user_class_meta_box($object) {
		$post_type = "user";
		include (plugin_dir_path(__FILE__) . 'partials/locate-and-filter-metabox-post.php');
	}
	/**
	 * saves metabox fields
	 * @param  int $post_id [description]
	 * @param  WP Post Object $post
	 * @return int post_id
	 */
	public function save_metabox_data($post_id, $post) {
		/* Verify the nonce before proceeding. */
		if (!isset($_POST['locate_anything_class_nonce']) || !wp_verify_nonce($_POST['locate_anything_class_nonce'], "I961JpJQTj0crLKH0mGB")) return $post_id;
		/* Get the post type object. */
		$post_type = get_post_type_object($post->post_type);
		/* Check if the current user has permission to edit the post. */
		if (!current_user_can($post_type->cap->edit_post, $post_id)) return $post_id;
		foreach ($_POST as $meta_key => $new_meta_value) {
			if (strpos($meta_key, "locate-anything") !== false) Locate_And_Filter_Admin::add_update_metas($post_id, $meta_key, $new_meta_value);
		}

		if (isset($_POST['locate-anything-filters'])){
			$locate_anything_filters = $_POST['locate-anything-filters'];
			$locateanything_custom_field_for_tax_elment = array();
			$locateanything_custom_field_for_tax = get_option('locateanything_custom_field_for_tax');
			
			//status checkbox
			$locateanything_custom_field_for_tax_elment_checkbox = array(); 
			$locateanything_custom_field_for_tax_checkbox = get_option('locateanything_custom_field_for_tax_checkbox');
			//end status checkbox
			foreach ($locate_anything_filters as $key => $value) {
				$enable_icon = get_post_meta( $post_id, 'locate-anything-filter-selector-icon-'.$value, true );
				$locateanything_custom_field_for_tax_elment[$value] = $enable_icon;
				
				//status checkbox
				$status = get_post_meta( $post_id, 'locate-anything-display-filter-'.$value, true );
				if($status == 'checkbox') {
					$locateanything_custom_field_for_tax_elment_checkbox[$value] = 'checkbox';
				} else {
					$locateanything_custom_field_for_tax_elment_checkbox[$value] = $status;
				} //end status checkbox
			}
			if($locateanything_custom_field_for_tax){
				$result = array_merge($locateanything_custom_field_for_tax, $locateanything_custom_field_for_tax_elment);
			} else {
				$result = $locateanything_custom_field_for_tax_elment;
			}
			update_option('locateanything_custom_field_for_tax', $result);
			
			//status checkbox
			if($locateanything_custom_field_for_tax_checkbox){
				$result_ = array_merge($locateanything_custom_field_for_tax_checkbox, $locateanything_custom_field_for_tax_elment_checkbox);
			} else {
				$result_ = $locateanything_custom_field_for_tax_elment_checkbox;
			}
			update_option('locateanything_custom_field_for_tax_checkbox', $result_);
			//end status checkbox

		}

		return $post_id;
	}
	/**
	 * Save the settings set in Option page
	 */
	public static function save_options() {
		foreach ($_POST as $k => $v) {
			if (strpos($k, "locate-anything-option-") !== false) {
				$v = self::locate_anything_sanitaze_option($k,$v);
				update_option($k, serialize($v) , '', 'yes');
			}
		}
	}
	/**
	 * Utilitary function to add, delete, update metas
	 */
	public function add_update_metas($post_id, $meta_key, $new_meta_value) {
		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta($post_id, $meta_key, true);
		/* If a new meta value was added and there was no previous value, add it. */
		if ($new_meta_value !== false && '' == $meta_value) {
			add_post_meta($post_id, $meta_key, $new_meta_value, true);
			update_post_meta($post_id, $meta_key, $new_meta_value);
		}
		/* If the new meta value does not match the old value, update it. */
		elseif ($new_meta_value !== false && $new_meta_value != $meta_value) update_post_meta($post_id, $meta_key, $new_meta_value);
		/* If there is no new meta value but an old value exists, delete it. */
		elseif ('' == $new_meta_value && $meta_value) delete_post_meta($post_id, $meta_key, $meta_value);
	}
	/**
	 * creates Admin Page in WP admin menu
	 */
	public function setup_admin_menu() {
		add_submenu_page("edit.php?post_type=locateandfiltermap", "Options", "Options", "edit_posts", "locate-anything-settings", "Locate_And_Filter_Admin::admin_settings_page");
	}
	/**
	 * defines a custom types for the maps
	 */
	public function createCustomType() {
		$labels = array(
			'name' => __('LocateAndFilter', 'locateandfilter') ,
			'singular_name' => __('Map', 'locateandfilter') ,
			'add_new' => __('Add New', 'locateandfilter') ,
			'add_new_item' => __('Add New Map', 'locateandfilter') ,
			'edit_item' => __('Edit Map', 'locateandfilter') ,
			'new_item' => __('New Map', 'locateandfilter') ,
			'all_items' => __('All Map', 'locateandfilter') ,
			'view_item' => __('View Map', 'locateandfilter') ,
			'search_items' => __('Search Maps', 'locateandfilter') ,
			'not_found' => __('No map found', 'locateandfilter') ,
			'not_found_in_trash' => __('No map found in Trash', 'locateandfilter') ,
			'menu_name' => __('LocateAndFilter', 'locateandfilter')
		);
		$supports = array(
			'title'
		);
		$slug = "locateandfilterMap";
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => 'dashicons-admin-site',
			'query_var' => true,
			'rewrite' => array(
				'slug' => $slug
			) ,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => $supports
		);
		register_post_type('locateandfilterMap', $args);
		/* marker custom post type*/
		
		$labels = array(
			'name' => __('Marker Categories', "locateandfilter") ,
			'singular_name' => __('Marker Category', "locateandfilter") ,
			'search_items' => __('Search Categories', "locateandfilter") ,
			'all_items' => __('All Categories', "locateandfilter") ,
			'parent_item' => __('Parent Category', "locateandfilter") ,
			'parent_item_colon' => __('Parent Category:', "locateandfilter") ,
			'edit_item' => __('Edit Category', "locateandfilter") ,
			'update_item' => __('Update Category', "locateandfilter") ,
			'add_new_item' => __('Add New Category', "locateandfilter") ,
			'new_item_name' => __('New Category Name', "locateandfilter") ,
			'menu_name' => __('Categories', "locateandfilter") ,
		);
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'locateanythingmarkercategory'
			) ,
		);
		register_taxonomy('locateanythingmarkercategory', 'locateanythingMarker', $args);

		$labels = array(
			'name' => __('Marker Tags', "locateandfilter") ,
			'singular_name' => __('Marker Tag', "locateandfilter") ,
			'search_items' => __('Search Tags', "locateandfilter") ,
			'all_items' => __('All Tags', "locateandfilter") ,
			'parent_item' => __('Parent Tag', "locateandfilter") ,
			'parent_item_colon' => __('Parent Tag:', "locateandfilter") ,
			'edit_item' => __('Edit Tag', "locateandfilter") ,
			'update_item' => __('Update Tag', "locateandfilter") ,
			'add_new_item' => __('Add New Tag', "locateandfilter") ,
			'new_item_name' => __('New Tag Name', "locateandfilter") ,
			'menu_name' => __('Tags', "locateandfilter") ,
		);
		
		$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'locateanythingmarkertag'
			) ,
		);
		register_taxonomy('locateanythingmarkertag', 'locateanythingMarker', $args);

		$labels = array(
			'name' => __('Markers', 'locateandfilter') ,
			'singular_name' => __('Marker', 'locateandfilter') ,
			'add_new' => __('Add New', 'locateandfilter') ,
			'add_new_item' => __('Add New Marker', 'locateandfilter') ,
			'edit_item' => __('Edit Marker', 'locateandfilter') ,
			'new_item' => __('New Marker', 'locateandfilter') ,
			'all_items' => __('All Marker', 'locateandfilter') ,
			'view_item' => __('View Marker', 'locateandfilter') ,
			'search_items' => __('Search Markers', 'locateandfilter') ,
			'not_found' => __('No Marker found', 'locateandfilter') ,
			'not_found_in_trash' => __('No Marker found in Trash', 'locateandfilter') ,
			'menu_name' => __('Markers', 'locateandfilter')
		);
		$supports = array(
			'title',
			'editor',
			'excerpt','thumbnail'
		);
		$slug = "locateanythingMarker";
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => $slug
			) ,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => $supports,
			'taxonomies' => array(
				'locateanythingmarkercategory','locateanythingmarkertag'				
			)
		);
		register_post_type('locateanythingMarker', $args);
	}
	/**
	 * Returns the additional field list stored in options
	 * @param  boolean $post_type [description]
	 * @return [type]             [description]
	 */
	public static function getAdditional_field_list($post_type = false) {
		$additional_field_list_json = stripslashes(unserialize(get_option('locate-anything-option-additional-field-list', '')));
		if ($additional_field_list_json) {
			$additional_field_list = json_decode($additional_field_list_json, true);
		} else {
			$additional_field_list = array();
		}
		if (!is_array($additional_field_list)) $additional_field_list = array();
		
		if ($post_type !== false) {
			foreach ($additional_field_list as $key => $field) {
				if ($field["post_type"] !== $post_type) unset($additional_field_list[$key]);
			}
		}
		return $additional_field_list;
	}
	
	/**
	 * displays additional fields and their tags
	 *
	 */
	public static function displayAdditionalFieldNotice($post_type) {		
		$additional_field_list_json = stripslashes(unserialize(get_option('locate-anything-option-additional-field-list', '')));
		if ($additional_field_list_json) $additional_field_list = json_decode($additional_field_list_json, true); ?>
		
		<div id="basic_fields_notice">									
			<?php	  
				$post_types = array("basic"=>"basic");
				$post_types += unserialize (get_option ( 'locate-anything-option-sources' ));
				$post_types = apply_filters("locate_anything_add_sources",$post_types);	

				$already_displayed_tags =array();
				  		
				foreach ( $post_types as $posttype =>$postTypeName ) {
				 	if($postTypeName=="Users") $postTypeName = 'user';			 	
				 	$markups = Locate_And_Filter_Public::getBasicMarkupList($postTypeName);

						foreach ($markups as $tag => $nothing) {	
						    if (in_array($tag, $already_displayed_tags)) continue;

						    // Mark this tag as already displayed
						    array_push($already_displayed_tags, $tag);
						    ?>
						    <div class="basic-markup basic-markup-<?php echo esc_attr($postTypeName); ?>">
						        <b><?php echo esc_html(ucfirst(str_replace(array("|", "_"), array("", " "), $tag))); ?></b> : 
						        <?php echo esc_html($tag); ?>
						    </div>
					<?php } 
		
				} ?>
		</div>

		<div id="additional_fields_notice">				
			<table id="additional_fields_notice">							

				<?php
					if (is_array($additional_field_list)) {
					    foreach ($additional_field_list as $field) {
					        // Skip invalid or mismatched fields
					        if (is_null($field["field_description"]) || is_null($field["field_name"]) || $field['post_type'] !== $post_type) continue;
					        ?>
					        <tr class="basic-markup basic-markup-<?php echo esc_attr($field['post_type']); ?>">
					            <td><b><?php echo esc_html($field["field_description"]) . " (" . esc_html($field['post_type']) . ")"; ?></b></td>
					            <td>|<?php echo esc_html($field['post_type']) . "::" . esc_attr(sanitize_key(remove_accents($field["field_description"]))); ?>|</td>
					        </tr>
					        <?php
					    }
					}
				?>

				<tfoot id="filter_fields_notice"></tfoot>
			</table>
		</div>
		<?php
	}

	/** 
	 * Display additional fields form
	 *
	 */
	public static function displayAdditionalFields($post) {
	    // If the post type is not valid, exit the function
	    if (get_post_type($post) == false) return;
	    ?>
	    <ul id="additional_fields">
	        <?php
	        // Get the additional field list and decode the JSON
	        $additional_field_list_json = stripslashes(unserialize(get_option('locate-anything-option-additional-field-list', '')));
	        if ($additional_field_list_json) $additional_field_list = json_decode($additional_field_list_json, true);

	        // Check if additional fields exist
	        if ($additional_field_list) {
	            if (is_array($additional_field_list) && $post !== "user") {
	                foreach ($additional_field_list as $field) {
	                    // Check if the post type matches
	                    if ($field["post_type"] == get_post_type($post)) { ?>
	                        <li>
	                            <b><?php echo esc_html($field["field_description"]); ?></b><br/>
	                            <textarea name="<?php echo esc_attr($field["field_name"]); ?>">
	                                <?php echo esc_textarea(get_post_meta($post->ID, $field["field_name"], true)); ?>
	                            </textarea>
	                        </li>
	                    <?php
	                    }
	                }
	            }
	        }
	        ?>
	    </ul>
	    <?php
	}

	/** 
	 * returns default templates for new map
	 *
	 */
	public static function getDefaultTemplates() {
		return array(
			"tooltip" => "<div class='tooltip-wrap'>
     <div class='tooltip-thumb'>|small_thumbnail|</div>
     <div class='tooltip-content'>|content_stripped|</div>
</div>
<a class='tooltip-link' href='|post_link|'>read more</a>",
			"nice-tooltip" => "<div class='tooltip-wrap'>
     <div class='tooltip-thumb'>|medium_thumbnail|</div>
     <div class='tooltip-content'>|content_stripped|</div>
</div>
<a class='tooltip-link' href='|post_link|'>read more</a>",
			"navlist" => "<div class='navlist-title'><b>|title|</b></div>
<div class='navlist-content'>
    <div class='navlist-thumbnail'>|small_thumbnail|</div>
    <div class='navlist-stripp-content'>
       |content_stripped|
       <a class='navlist-link' href='|post_link|'>read more</a>
   </div>
</div>"
		);
	}
	/**
	 * Returns all the metas for this post
	 * @param  [int] $id [post ID]
	 * @return [array]  array [metaname]=metavalue
	 */
	public static function getPostMetas($id) {
		$t = array();
		foreach (get_post_meta($id) as $k => $v) {
			$t[$k] = current($v);
		}
		return $t;
	}
	/**
	 * Returns all the metas for this user
	 * @param  [int] $id [post ID]
	 * @return [array]  array [metaname]=metavalue
	 */
	public static function getUserMetas($id) {
		$t = array();
		foreach (get_user_meta($id) as $k => $v) {
			$t[$k] = current($v);
		}
		return $t;
	}
	/**
	 * Returns select licences seed
	 * @param  [int] $id [licence id]
	 * @return [string]  seed
	 */
	public static function getLicence($id) {
		$licences = array('label'=>"-license-lvl1");
		$licences = apply_filters("add_seed_licence",$licences);		
		$license_key  =unserialize(get_option("locate-anything-option-".$licences[$id]."-license"));
		return array('seed'=>$licences[$id],'key'=>$license_key);
	}





	/**
	 * Geocodes address,
	 * @param  [string] $address
	 * @return [false | array]  returns false if unable to geocode address
	 */
	public static function geocode($address) {
		// url encode the address
		$address = urlencode($address);
		// google map geocode api url
		$gmaps_key = Locate_And_Filter_Admin::getGmapsAPIKey();
		$url = "https://maps.google.com/maps/api/geocode/json?key=$gmaps_key&sensor=false&address={$address}";
		// get the json response
		$resp_json = Locate_And_Filter_Tools::file_get_contents_wp($url);
		// decode the json
		$resp = json_decode($resp_json, true);		
		// response status will be 'OK', if able to geocode given address
		if ($resp['status'] == 'OK') {
			// get the important data
			$lati = $resp['results'][0]['geometry']['location']['lat'];
			$longi = $resp['results'][0]['geometry']['location']['lng'];
			$formatted_address = $resp['results'][0]['formatted_address'];
			// verify if data is complete
			if ($lati && $longi && $formatted_address) {
				// put the data in the array
				$data_arr = array();
				array_push($data_arr, $lati, $longi, $formatted_address);
				return $data_arr;
			} 
			else return false;
		} 
		else return false;
	}
	/**
	 * AJAX function : returns JSON encoded array of taxonomies tied to a post type
	 */
	/* get Taxonomies associated with type passed in request */
	public function LA_getTaxonomies() {
		echo wp_json_encode(get_object_taxonomies(sanitize_text_field($_REQUEST['type'])));
		die();
	}
	/**
	 * AJAX function : returns JSON encoded array of taxonomies tied to a post type
	 */
	/* get Taxonomies associated with type passed in request */
	public function LA_getTaxonomies_plus() {
		$tax = get_object_taxonomies(sanitize_text_field($_REQUEST['type']));
		//array_push($tax, $_REQUEST['type']);
		echo wp_json_encode($tax);
		die();
	}	
	/**
	 * AJAX function : returns JSON encoded array of taxonomies tied to a post type
	 */
	/* get Taxonomies associated with type passed in request */
	public function LA_getPOST_id() {
		$all_post_ids = get_posts(array(
		    'fields'          => 'ids',
		    'posts_per_page'  => -1,
		    'post_type' => $_REQUEST['type']
		));
		echo wp_json_encode( $all_post_ids );
		die();
	}

	/**
	 * AJAX function : returns JSON encoded array of taxonomies tied to a post type
	 */
	/* get Taxonomy terms associated with type passed in request */
	public function LA_getTaxonomyTerms() {
		$selected = get_post_meta( sanitize_text_field($_REQUEST['map_id']), "locate-anything-allowed-filters-value-" . sanitize_text_field($_REQUEST['type']), true);
		//$terms = get_terms(sanitize_text_field($_REQUEST['type']));
		$terms = get_terms([
			'taxonomy' => sanitize_text_field($_REQUEST['type']),
			'hide_empty' => false,
		]);
		if ($terms) foreach ($terms as $in => $term) {
			if (is_array($selected) && array_search($term->term_id, $selected) !== false) $terms[$in]->selected = 1;
			else $terms[$in]->selected = 0;
			if (!$selected) $terms[$in]->selected = 1;
		}
		echo wp_json_encode($terms);
		die();
	}

	/**
	 * AJAX function : returns JSON encoded html code for layout
	 */
	public function getLayoutCode() {
		$map_id = sanitize_text_field($_POST["map_id"]);
		$layout_id = sanitize_text_field($_POST["layout_id"]);
		$record = get_post_meta( intval($map_id) , "locate-anything-map-template-html-" . $layout_id, true);
			if ($record == false) {
				//echo json_encode(file_get_contents(Locate_And_Filter_Assets::getMapTemplates( $layout_id )->url));
				echo wp_json_encode(Locate_And_Filter_Tools::get_local_file_contents(Locate_And_Filter_Assets::getMapTemplates( $layout_id )->url));
			} else {
				echo wp_json_encode($record);
			}
		die();
	}

	/**
	 * AJAX function : returns HTML of current filters
	 */
	public function getFilters() {
		echo esc_html(apply_filters("locate_anything_add_filter_choice", '', sanitize_text_field($_POST["map_id"]), sanitize_text_field($_POST["type"]) ));
		die();
	}

	/**
	 *  function : sanitaze options value
	 */
	private static function locate_anything_sanitaze_option($key, $var){
		if ( is_array( $var ) ) {
			return array_map( 'sanitize_text_field', $var );
		} else {
			return sanitize_text_field( $var );
		}

	}

}