<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The file that defines the addon plugin class
 *
 * @since      1.0.0
 * @package    Locate_And_Filter
 * @subpackage Locate_And_Filter/addon
 * @author     AMonin <monothemes@gmail.com>
 */

class Locate_And_Filter_Addons_Demo
{
    
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
     * Define the core functionality of the addons.
     *
     * @since    1.0.0
     */
    public function __construct() {
        
        $this->plugin_name = 'locate-and-filter';
        $this->version = '1.4.12';
        
        $this->init_locateandfilter_addon_overlays();

    }


    /**
     * Register addon settings
     * @return void
     */
    public function init_locateandfilter_addon_overlays() {
  
			$overlays = array(
				(object)array("name" => 'Addon overlays')
			);

			//register new overlays
			//Locate_And_Filter_Addon_Helper::add_overlays("addon", $overlays);

			// add addons option tab
			$addon_name = "Addon overlays";

	        add_filter("locate_anything_add_option_tab", function ($tabs) use ($addon_name) {
	            $tabs[] = $addon_name;
	            return $tabs;
	        } , 1000, 1);

	        add_filter("locate_anything_add_option_pane", function ($h) use ( $addon_name ) {    
				$html = $this->addon_pane_settings_html();
	            $h.= "<div id='locate-anything-map-settings-page-" . md5($addon_name) . "' class='locate-anything-map-option-pane' style='display:none'>
	            		<a href='https://locateandfilter.monothemes.com/locateandfilter-pro-version/' class='proversion' target='_blank'>available only for PRO version</a>
	                    <h1>$addon_name Settings</h1>" . $html . " </div>";
	            return $h;
	        } , 1000, 1);

		}

    /**
     * Addon options
     * @return void
     */
    public function addon_pane_settings_html() {

			$html = '';
	        $providers_ = wp_remote_get( plugin_dir_url( __FILE__ ) . 'assets/etc/leaflet-providers.json');
	        $providers =  json_decode($providers_['body'], true);

					ob_start(); ?>

						<!-- Map provider addon-->
						<ul id="map-provider-addon" class="only_pro">
							<li>
								<?php _e("Addon Map Overlay","locate-and-filter");?>
								<select name="locate-anything-option-map-provider-addon" id="locate-anything-option-map-provider-addon">

									<?php foreach ($providers as $name => $overlay ) { ?>
										
										<?php if ( $overlay['load'] ) { ?>

											<option value="<?php echo $name;?>" data-variants="" <?php if( unserialize(get_option("locate-anything-option-map-provider-addon")) == $name) echo "selected"; ?> ><?php echo $name; ?></option>

											<?php if ( isset( $overlay[ 'variants' ] ) ) { ?>
												<?php foreach ($overlay[ 'variants' ] as $variants_name => $variants ) { ?>
													<option value="<?php echo $name.'.'.$variants_name;?>" data-variants="<?php echo $variants_name; ?>" <?php if(  unserialize(get_option("locate-anything-option-map-provider-addon")) == $name.'.'.$variants_name ) echo "selected"; ?> ><?php echo $name.' - '.$variants_name; ?></option>
												<?php } ?>
											<?php } ?>

										<?php } ?>

									<?php }?>

								</select>
							</li>

							<li>
								<?php _e("Jawg accessToken","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-accessToken-jawg" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-accessToken-jawg"));?>">
								<p>In order to use Jawg Maps, you must <a href="https://www.jawg.io/lab" target="_blank" rel="nofollow">register</a>. Once registered, your access token will be located <a href="https://www.jawg.io/lab/access-tokens" target="_blank">here</a></p>
								<?php _e("Jawg custom Style id","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-customstyle-jawg" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-customstyle-jawg"));?>">
								<p>eg: a7aff445-ca75-4600-b0bf-e00c81ee84cb</p>					
							</li>

							<li>
								<?php _e("Thunderforest apikey","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-accessToken-thunderforest" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-accessToken-thunderforest"));?>">
								<p>In order to use Thunderforest Maps, you must <a href="https://manage.thunderforest.com/" target="_blank" rel="nofollow">register</a>. Once registered, your access token will be located <a href="https://manage.thunderforest.com/dashboard" target="_blank">here</a></p>
							</li>

							<li>
								<?php _e("Mapbox accessToken","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-accessToken-mapbox" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-accessToken-mapbox"));?>">
								<p>In order to use Mapbox Maps, you must <a href="https://account.mapbox.com/auth/signup/" target="_blank" rel="nofollow">register</a>. Once registered, your access token will be located <a href="https://account.mapbox.com/" target="_blank">here</a></p>
							</li>

							<li>
								<?php _e("MapTiler key","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-accessToken-maptiler" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-accessToken-maptiler"));?>">
								<p>In order to use MapTiler Maps, you must <a href="https://cloud.maptiler.com/auth/widget?mode=select&next=https%3A%2F%2Fcloud.maptiler.com%2Fstart" target="_blank" rel="nofollow">register</a>. Once registered, your access token will be located <a href="https://cloud.maptiler.com/account/keys/" target="_blank">here</a></p>
							</li>

							<li>
								<?php _e("OpenWeatherMap apiKey","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-accessToken-openweathermap" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-accessToken-openweathermap"));?>">
								<p>In order to use OpenWeatherMap Maps, you must <a href="https://home.openweathermap.org/users/sign_up" target="_blank" rel="nofollow">register</a>. Once registered, your access token will be located <a href="https://home.openweathermap.org/api_keys" target="_blank">here</a></p>
							</li>

							<li>
								<?php _e("HEREv3 apiKey","locate-anything");?>:
								<input type="text" size="100" name="locate-anything-option-map-provider-addon-accessToken-here" value="<?php echo unserialize(get_option("locate-anything-option-map-provider-addon-accessToken-here"));?>">
								<p>In order to use HEREv3 Maps, you must <a href="https://developer.here.com/login" target="_blank" rel="nofollow">register</a>. Once registered, your access token will be located <a href="https://developer.here.com/projects/" target="_blank">here</a></p>
							</li>

						</ul>

						<?php 				
					$html .= ob_get_contents();
					ob_end_clean();
				 
			return $html; 
		}

}
