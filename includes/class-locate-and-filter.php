<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://monothemes.com/
 * @since      1.0.0
 *
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/includes
 * @author     AMonin <monothemes@gmail.com>
 */
class Locate_And_Filter
{
    
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Locate_And_Filter_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;
    
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;
    
    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;
    
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        
        $this->plugin_name = 'locate-and-filter';
        $this->version = '1.3.19';
        
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->load_default_assets();

        $this->load_custom_term_field();
    }

    /**
     * Loads the assets of the basic pack
     * @return void
     */
    public function load_default_assets() {
        
        /* Load default layouts */
        $layouts = array((object)array("url" => plugin_dir_path(dirname(__FILE__)) . '/assets/mapTemplates/template-left.php', "name" => 'Default Layout left'), (object)array("url" => plugin_dir_path(dirname(__FILE__)) . '/assets/mapTemplates/template-right.php', "name" => 'Default Layout right'), (object)array("url" => plugin_dir_path(dirname(__FILE__)) . '/assets/mapTemplates/template-project.php', "name" => 'Layout for projects'),);
        Locate_And_Filter_Addon_Helper::add_map_layouts("basic", $layouts);
        
        /* Load default marker icons */
        $markers = array((object)array("url" => plugin_dir_url(dirname(__FILE__)) . 'public/js/leaflet-0.7.3/images/marker-icon.png', "description" => '', "width" => 25, "height" => 41, "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'public/js/leaflet-0.7.3/images/marker-shadow.png', "shadowWidth" => '25', "shadowHeight" => '41'), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-8.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-7.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-9.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-6.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-3.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-13.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-4.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-10.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-12.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"), 
        (object)array(
        "url" => plugin_dir_url(dirname(__FILE__)) . "assets/markers/48x48-marker-5.png", "description" => "", "width" => "48", "height" => "48", "shadowUrl" => plugin_dir_url(dirname(__FILE__)) . 'assets/markers/marker-shadow48.png', "shadowWidth" => '48', "shadowHeight" => "48"),);
        Locate_And_Filter_Addon_Helper::add_marker_icons("basic", $markers);
        
        /* Load default map overlays */
        $overlays = array((object)array("name" => 'OpenStreetMap', "url" => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', "attribution" => 'OpenStreetMap', "maxZoom" => 18, "minZoom" => 2), (object)array("name" => 'GoogleMaps TERRAIN', "url" => 'TERRAIN', "attribution" => 'GoogleMaps', "maxZoom" => 18, "minZoom" => 2), (object)array("name" => 'GoogleMaps ROADMAP', "url" => 'ROADMAP', "attribution" => 'GoogleMaps', "maxZoom" => 18, "minZoom" => 2), (object)array("name" => 'GoogleMaps SATELLITE', "url" => 'SATELLITE', "attribution" => 'GoogleMaps', "maxZoom" => 18, "minZoom" => 2));
        Locate_And_Filter_Addon_Helper::add_overlays("basic", $overlays);
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Locate_And_Filter_Loader. Orchestrates the hooks of the plugin.
     * - Locate_And_Filter_i18n. Defines internationalization functionality.
     * - Locate_And_Filter_Admin. Defines all hooks for the admin area.
     * - Locate_And_Filter_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
         /**
         * This class contains the Upgrader that addons will use
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class.upgrademe.php';    
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-locate-and-filter-loader.php';
        
        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-locate-and-filter-i18n.php';
        
        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-locate-and-filter-admin.php';
        
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-locate-and-filter-public.php';
        
        /**
         * This class holds utilitary functions
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-locate-and-filter-tools.php';
        
        /**
         * This class contains the Assets
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-locate-and-filter-assets.php';
        
        /**
         * This class contains the Addon helpers
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-locate-and-filter-addon-helper.php';
           
        $this->loader = new Locate_And_Filter_Loader();
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Locate_And_Filter_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {
        
        $plugin_i18n = new Locate_And_Filter_i18n();
        $plugin_i18n->set_domain($this->get_plugin_name());
        
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        
        $plugin_admin = new Locate_And_Filter_Admin($this->get_plugin_name(), $this->get_version());
        $plugin_public = new Locate_And_Filter_Public($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        
        /* additional hooks*/
        $this->loader->add_action('wp_ajax_LAgetTaxonomies', $plugin_admin, 'LA_getTaxonomies', 10, 0);
        $this->loader->add_action('wp_ajax_nopriv_LAgetTaxonomies', $plugin_admin, 'LA_getTaxonomies', 10, 0);

        /* additional hooks*/
        $this->loader->add_action('wp_ajax_LAgetTaxonomies_plus', $plugin_admin, 'LA_getTaxonomies_plus', 10, 0);
        $this->loader->add_action('wp_ajax_nopriv_LAgetTaxonomies_plus', $plugin_admin, 'LA_getTaxonomies_plus', 10, 0);

        /* additional hooks*/
        $this->loader->add_action('wp_ajax_LAgetPOST_id', $plugin_admin, 'LA_getPOST_id', 10, 0);
        $this->loader->add_action('wp_ajax_nopriv_LAgetPOST_id', $plugin_admin, 'LA_getPOST_id', 10, 0);

        $this->loader->add_action('wp_ajax_LAgetTaxonomyTerms', $plugin_admin, 'LA_getTaxonomyTerms', 10, 0);
        $this->loader->add_action('wp_ajax_nopriv_LAgetTaxonomyTerms', $plugin_admin, 'LA_getTaxonomyTerms', 10, 0);
        
        $this->loader->add_action('wp_ajax_refresh_cache', $plugin_public, 'refresh_cache', 10, 2);
        $this->loader->add_action('wp_ajax_nopriv_refresh_cache', $plugin_public, 'refresh_cache', 10, 2);
        
        $this->loader->add_action('wp_ajax_getLayoutCode', $plugin_admin, 'getLayoutCode', 10, 0);
        $this->loader->add_action('wp_ajax_nopriv_getLayoutCode', $plugin_admin, 'getLayoutCode', 10, 0);
        
        $this->loader->add_action('wp_ajax_LAgetFilters', $plugin_admin, 'getFilters', 10, 0);
        $this->loader->add_action('wp_ajax_nopriv_LAgetFilters', $plugin_admin, 'getFilters', 10, 0);
        
        //$this->loader->add_action('wp_loaded', $plugin_admin, 'clear_hooks_for_preview',100000);

        $this->loader->add_action('admin_menu', $plugin_admin, "setup_admin_menu", 10, 0);
        $this->loader->add_action('init', $plugin_admin, 'createCustomType',0);
        //$this->loader->add_action('admin_init', $plugin_admin, 'load_preview',0);

        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'add_post_meta_boxes');
        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'add_admin_meta_boxes',0);
        
        $this->loader->add_action('save_post', $plugin_admin, 'save_metabox_data', 10, 2);
        $this->loader->add_action('admin_init', $plugin_admin, 'save_options', 10, 2);

        $this->loader->add_action('admin_notices', $plugin_admin, 'check_cache_permissions', 10, 2);
        /* filters */
        $this->loader->add_filter('upload_mimes',$plugin_admin, 'add_mime_types', 1, 1);

        $this->loader->add_action('admin_menu',$plugin_admin, 'saveRootPath', 1000000, 0);
    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {        
        $plugin_public = new Locate_And_Filter_Public($this->get_plugin_name(), $this->get_version());
        $plugin_public->setup_shortcodes();
       
       // loading of styles and scripts has been moved to shortcode methods in order to avoid loading the scripts when not necessary

        //$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
       // $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        
        /* additional hooks*/
        $this->loader->add_action('wp_ajax_getMarkers', $plugin_public, 'getMarkers', 0);
        $this->loader->add_action('wp_ajax_nopriv_getMarkers', $plugin_public, 'getMarkers', 0);
    }


    
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }
    
    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }
    
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Locate_And_Filter_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }
    
    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    /**
     * Loads custom fields for term
     * @return locateanything_term_image_url
     * @return locateanything_checkbox_status
     */
    public function load_custom_term_field() {
        $locateanything_custom_field_for_tax = get_option('locateanything_custom_field_for_tax');
        if ($locateanything_custom_field_for_tax) {
            foreach ($locateanything_custom_field_for_tax as $key => $value) {
                if( $value == 'true' ) {
                    // $taxname = 'cat_place';
                    $taxname = $key;
                    //Поля при добавлении элемента таксономии
                    add_action("{$taxname}_add_form_fields", array( $this, 'add_new_custom_fields' ) );
                    //Поля при редактировании элемента таксономии
                    add_action("{$taxname}_edit_form_fields", array( $this, 'edit_new_custom_fields') );

                    //Сохранение при добавлении элемента таксономии
                    add_action("create_{$taxname}", array( $this, 'save_custom_taxonomy_meta') );
                    //Сохранение при редактировании элемента таксономии
                    add_action("edited_{$taxname}", array( $this, 'save_custom_taxonomy_meta') );
                }
            }
        }
        $locateanything_custom_field_for_tax_checkbox = get_option('locateanything_custom_field_for_tax_checkbox');
        if ($locateanything_custom_field_for_tax_checkbox) {
            foreach ($locateanything_custom_field_for_tax_checkbox as $key => $value) {
                if( $value == 'checkbox' ) {
                    // $taxname = 'cat_place';
                    $taxname = $key;
                    //Поля при добавлении элемента таксономии
                    add_action("{$taxname}_add_form_fields", array( $this, 'add_new_custom_fields_checkbox' ) );
                    //Поля при редактировании элемента таксономии
                    add_action("{$taxname}_edit_form_fields", array( $this, 'edit_new_custom_fields_checkbox') );

                    //Сохранение при добавлении элемента таксономии
                    add_action("create_{$taxname}", array( $this, 'save_custom_taxonomy_meta') );
                    //Сохранение при редактировании элемента таксономии
                    add_action("edited_{$taxname}", array( $this, 'save_custom_taxonomy_meta') );
                }
            }
        }
    }

    /**
     * Edit custom fields in term
     * @return locateanything_term_image_url
     */
    public function edit_new_custom_fields( $term ) {
        ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label>Image url</label></th>
                <td>
                    <input type="text" name="extra[locateanything_term_image_url]" value="<?php echo esc_attr( get_term_meta( $term->term_id, 'locateanything_term_image_url', 1 ) ) ?>"><br />
                    <span class="description">Image url for filter LocateAndFilter</span>
                </td>
            </tr>
        <?php
    }

    /**
     * Edit custom fields in term
     * @return ocateanything_checkbox_status
     */
    public function edit_new_custom_fields_checkbox( $term ) {
        $status = get_term_meta( $term->term_id, 'locateanything_checkbox_status', 1 );
        ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label>Checkbox status</label></th>
                <td>
                    <span>checked </span><input type="radio" name="extra[locateanything_checkbox_status]" value="0"  <?php if ( $status != 'unchecked') echo 'checked="checked"'; ?> >
                    <span> unchecked </span><input type="radio" name="extra[locateanything_checkbox_status]" value="unchecked" <?php if ( $status  == 'unchecked' ) echo 'checked="checked"'; ?> ><br />
                    <span class="description">Status for checkbox filter</span>
                </td>
            </tr>
        <?php
    }

    /**
     * Add new custom fields in term
     * @return locateanything_term_image_url
     */
    public function add_new_custom_fields( $taxonomy_slug ){
        ?>
        <div class="form-field">
            <label for="tag-locateanything_term_image_url">Image url</label>
            <input name="extra[locateanything_term_image_url]" id="tag-locateanything_term_image_url" type="text" value="" />
            <p>Image url for filter LocateAnything</p>
        </div>
        <?php
    }

    /**
     * Add new custom fields in term
     * @return locateanything_checkbox_status
     */
    public function add_new_custom_fields_checkbox( $taxonomy_slug ){
        ?>
        <div class="form-field">
            <label for="tag-locateanything_checkbox_status">Checkbox status</label>
                    <span>checked </span><input type="radio" name="extra[locateanything_checkbox_status]" value="0"  >
                    <span> unchecked </span><input type="radio" name="extra[locateanything_checkbox_status]" value="unchecked" checked="checked" ><br />
                    <span class="description">Status for checkbox filter</span>
        </div>
        <?php
    }

    /**
     * Save custom fields in term
     * @return extra[]
     */
    public function save_custom_taxonomy_meta( $term_id ) {
        if ( ! isset($_POST['extra']) ) return;
        if ( ! current_user_can('edit_term', $term_id) ) return;
        if (
            ! wp_verify_nonce( $_POST['_wpnonce'], "update-tag_$term_id" ) && // wp_nonce_field( 'update-tag_' . $tag_ID );
            ! wp_verify_nonce( $_POST['_wpnonce_add-tag'], "add-tag" ) // wp_nonce_field('add-tag', '_wpnonce_add-tag');
        ) return;

        // Все ОК! Теперь, нужно сохранить/удалить данные
        $extra = wp_unslash($_POST['extra']);

        foreach( $extra as $key => $val ){
            // проверка ключа
            $_key = sanitize_key( $key );
            if( $_key !== $key ) wp_die( 'bad key'. esc_html($key) );

            // очистка
            if( $_key === 'tag_posts_shortcode_links' )
                $val = sanitize_textarea_field( strip_tags($val) );
            else
                $val = sanitize_text_field( $val );

            // сохранение
            if( ! $val )
                delete_term_meta( $term_id, $_key );
            else
                update_term_meta( $term_id, $_key, $val );
        }

        return $term_id;
    } 

}