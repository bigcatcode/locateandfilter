<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
jQuery(".locate-anything-help").click(function(e){

var annotations=
{

"map-provider": new Anno({ 
  target : '#map-provider',
  content: '<?php esc_html_e("This setting will determine the overlay of the map. .<br/><br/>Each Map overlay will have a different \"look & feel\". Try them in the preview if unsure.<br><br>If you want to use a  map overlay that is not in the list, select \"Custom map overlay\" and enter its URL in the field just below.","locateandfilter")?>'
}),
"map-source": new Anno({ 
  target : '#map-source',
  content: '<?php esc_html_e("This setting controls which post type is used to create the markers for this map.<br/><br/> Please note that only the post types you selected in the options page are presented here.","locateandfilter")?>'
}),
"map-filters": new Anno({ 
  target : '#map-filters',
  content: '<?php esc_html_e("<b>Filter the markers</b><br><br><p>This setting lets you filter the markers received from the post type by choosing which taxonomy terms are allowed. <br><br> It permits you to display only markers of a specific category, or tagged with a specific term.<br><br> The effect on the markers displayed is cumulative meaning that if you select Category \"Night bars\" and post_tag \"Beer\" (category and post_tag being 2 different taxonomies) your map will show all the \"Night bars\" (even those that don\'t serve beer) AND all the places tagged as \"Beer\" (even those not open at night), along with the search options to filter them. <br><br> You can preview the result in real time on the preview map.</p>","locateandfilter")?>'
}),
"tr-show-filters": new Anno({ 
  target : '#tr-show-filters',
  content: '<?php esc_html_e("<b>Define the filters that will be available for this map</b><br><br><p><b>Types of filter</b> :<br>Filters using <b>checkboxes</b> are cumulative (OR operator), this means they will show markers tied to ANY of the checked terms.<br><br>Filters using <b>Tokenize</b> are \"mutually-exclusive\"  (AND operator), which means only markers that fit ALL the given terms will show.<br><br> <b>Range filters</b> will only work with simple numeric values. If the value is not numeric the markers will be unselected each time the range is updated.</p>","locateandfilter")?>'
}),
"map-hue": new Anno({ 
  target : '#map-hue',
  content: '<?php esc_html_e("This setting will determine the tone/color of the map. <br/><br/> Set the value to black (#000) to disable. <br/><br/>Works only with GoogleMaps","locateandfilter")?>'
}),

"map-width": new Anno({ 
  target : '#map-width',
  content: '<?php esc_html_e("This setting will determine the width of the map if no predefined layout is used.<b>Please note</b> that this setting doesn\'t apply to maps generated using the [LocateAndFilter map_id=...] shortcode<br/><br/> Pixels and % supported.","locateandfilter")?>'
}),
"map-height": new Anno({ 
  target : '#map-height',
  content: '<?php esc_html_e("This setting will determine the height of the map if no predefined layout is used. <b>Please note</b> that this setting doesn\'t apply to maps generated using the [LocateAndFilter map_id=...] shortcode<br/><br/> Pixel is the only unit supported","locateandfilter")?>'
}),
"startposition": new Anno({ 
  target : '#startposition',
  content: '<?php esc_html_e("This setting will determine the center of the map when it is first displayed. <br/><br/> You can set it manually (Format : <i>latitude</i>,<i>longitude</i>), or just drag the preview map to the desired point","locateandfilter")?>'
}),
"maxzoom": new Anno({ 
  target : '#maxzoom',
  content: '<?php esc_html_e("This setting will determine the maximum zoom allowed for this map.","locateandfilter")?>'
}),
"minzoom": new Anno({ 
  target : '#minzoom',
  content: '<?php esc_html_e("This setting will determine the minimum zoom allowed for this map.","locateandfilter")?>'
}),
"startzoom": new Anno({ 
  target : '#startzoom',
  content: '<?php esc_html_e("This setting will determine the initial zoom for this map. <br/><br/> You can set it manually or just zoom the preview map to the desired zoom level","locateandfilter")?>'
}),
"singlezoom": new Anno({ 
  target : '#singlezoom',
  content: '<?php esc_html_e("This setting will determine the initial zoom for map on single page.","locateandfilter")?>'
}),
"autogeocode": new Anno({ 
  target : '#autogeocode',
  content: '<?php esc_html_e("If this parameter is set to \"yes\" the plugin will try to locate the user and center the map on his current location","locateandfilter")?>'
}),
"googleplaces": new Anno({ 
  target : '#googleplaces',
  content: '<?php esc_html_e("Set this parameter to \"yes\" to add a a Google Places searchbox to this map","locateandfilter")?>'
}),
"navnumbers": new Anno({ 
  target : '#navnumbers',
  content: '<?php esc_html_e("This setting will determine the maximum number of items in the navigation list of this map","locateandfilter")?>'
}),
"addifields": new Anno({ 
  target : '#addifields',
  content: '<?php esc_html_e("Here is a list of the fields available for display in the templates. To use them just copy/paste the corresponding tag in the template editor. <br/><br/><strong>Please note that those are the global values for this map</strong>. if you don\'t see any change after modifying a tooltip template check that you haven\'t defined a custom tooltip template on the post, page or user associated with the marker.","locateandfilter")?>'
}),
"templates": new Anno({ 
  target : '#templates',
  content: '<?php esc_html_e("Templates are used to define the appearance of the navigation list items and the tooltips associated with each marker.Templates support simple HTML and additional field tags<br/><br/>For example, to display the title, content and thumbnail of a marker in the tooltips :<br/><code>&lt;b&gt;|title|&lt;/b&gt;<br/>|small_thumbnail|<br/>|content| </code> ","locateandfilter")?>'
}),
"customtemplate": new Anno({ 
  target : '#customtemplate',
  content: '<?php esc_html_e("Create a custom tooltip template if you want the appearance of the tooltip associated with this marker to be different from the default tooltip selected for this map.<br> Supports simple HTML and additional field tags<br/><br/>For example, to display the title, content and thumbnail of a marker in the tooltips :<br/><code>&lt;b&gt;|title|&lt;/b&gt;<br/>|small_thumbnail|<br/>|content| </code> ","locateandfilter")?>'
}),
"maplayout": new Anno({ 
  target : '#maplayout',
  content: '<?php esc_html_e("A predefined layout is only displayed  when the shortcode [LocateAndFilter map_id=...] is used. The layout determines the organization of the different elements : map, navlist and filters.<br/><br/> LocateAnything proposes several predefined layouts for your maps. You can use them as-is or modify them to fit your needs.","locateandfilter")?>'
}),
"nice-tooltips-settings": new Anno({ 
  target : '#nice-tooltips-settings',
  content: '<?php esc_html_e("Select the \"Nice Tooltips\" setting in the dropdown menu. You can set the maximum image height or just leave it blank.","locateandfilter")?>'
}),

"medialibrary": new Anno({ 
  target : '#medialibrary',
  content: '<?php esc_html_e("You can use an image from Wordpress media library as a marker icon. <br><b>Warning</b> : The image will NOT be resized. Please make sure its size is adequate.","locateandfilter")?>'
}),

"display_only_inbound": new Anno({ 
  target : '#display_only_inbound',
  content: '<?php esc_html_e("If this option is checked the navlist will only show the markers that are located in the bounds of the map. This means that for example if your map is zoomed and centered on NYC and your markers are in SF, the navlist will be empty","locateandfilter")?>'
}),
"custom-map-provider": new Anno({ 
  target : '#custom-map-provider',
  content: '<?php esc_html_e("You can specify here the URL for the custom map provider. A non-exhaustive list of compatible providers can be found  on  the excellent <a target=\'_blank\' href=\'http://leaflet-extras.github.io/leaflet-providers/preview/index.html\'>leaflet-providers</a> page.","locateandfilter")?>'
}),
"show-attr-label": new Anno({ 
  target : '#show-attr-label',
  content: '<?php esc_html_e("The attribution label is displayed on the bottom right side of the map. It states the source of the overlay you are using, for example OpenStreetMap","locateandfilter")?>'
}),
"display_load-pretty-checkbox": new Anno({ 
  target : '#display_load-pretty-checkbox',
  content: '<?php esc_html_e("A pure CSS library to beautify checkbox and radio buttons","locateandfilter")?>'
}),
"enable_fitBounds": new Anno({ 
  target : '#enable_fitBounds',
  content: '<?php esc_html_e("Sets a map view that contains the given Filters bounds with the maximum zoom level possible.","locateandfilter")?>'
}),
"enable_zoom_to_marker": new Anno({ 
  target : '#enable_zoom_to_marker',
  content: '<?php esc_html_e("Sets zoom map from single zoom options, on popup event.","locateandfilter")?>'
}),
"filter_terms_orderby": new Anno({ 
  target : '#filter_terms_orderby',
  content: '<?php esc_html_e(" No - Orderby=name . Yes - Orderby=description . You can use term description for custom sort.","locateandfilter")?>'
}),
"search_box_by_location": new Anno({ 
  target : '#search_box_by_location',
  content: '<?php esc_html_e(" Added to filters searchbox by address by <a href=\'https://nominatim.openstreetmap.org/ui/search.html\'>nominatim</a>","locateandfilter")?>'
}),
"search_box_by_location_structured": new Anno({ 
  target : '#search_box_by_location_structured',
  content: '<?php esc_html_e(" Added to filters searchbox by Structured address: House number/Street, City, County, State, Country, Postal Code","locateandfilter")?>'
}),
"search_box_by_radius": new Anno({ 
  target : '#search_box_by_radius',
  content: '<?php esc_html_e(" Added Radius options to address searchbox ","locateandfilter")?>'
}),
"search_box_by_radius_unit": new Anno({ 
  target : '#search_box_by_radius_unit',
  content: '<?php esc_html_e(" Enable search Radius by miles. Default kilometers","locateandfilter")?>'
}),
"enable_markerBouncing": new Anno({ 
  target : '#enable_markerBouncing',
  content: '<?php esc_html_e("Add animation of marker bouncing by hover or click on navlist. Tooltips will be disabled! You need enable Add marker bouncing js on global map options","locateandfilter")?>'
}),
"enable_singleshortcode": new Anno({ 
  target : '#enable_singleshortcode',
  content: '<?php esc_html_e("Activate this option if you need use shortcode for single page - and you get map with current page marker.","locateandfilter")?>'
}),
"enable_acf_for_filters": new Anno({ 
  target : '#enable_acf_for_filters',
  content: '<?php esc_html_e("Activate this option if you can use Advanced Custom Fields for filters such types as Number, Select, Checkbox, True / False, Radio Button</br>***Available only on extended version. more information on home page.","locateandfilter")?>'
}),
"enable_source_for_coordinates": new Anno({ 
  target : '#enable_source_for_coordinates',
  content: '<?php esc_html_e("Set different source for coordinates (Latitude,Longitude) from your custom fields<br>by default used plugin custom fields: locate-anything-lat <br> locate-anything-lon","locateandfilter")?>'
}),
"geosearch": new Anno({ 
  target : '#geosearch',
  content: '<?php esc_html_e("Set this parameter to \"yes\" to add a a Leaflet geosearch searchbox to this map","locateandfilter")?>'
}),
}

var target=jQuery(e.target).attr("data-target");
annotations[target].onShow= function (e) {
	jQuery(e.target).css('padding','10px');
	jQuery(e.target+ " .locate-anything-help").hide();
  };
annotations[target].onHide= function (e) {	
jQuery(e.target).css('padding','0px');

	jQuery(e.target+ " .locate-anything-help").show();
  };

annotations[target].show();

});