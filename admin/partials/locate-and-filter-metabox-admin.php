<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php wp_nonce_field( "I961JpJQTj0crLKH0mGB" , 'locate_anything_class_nonce' );

function makeInput($type,$fieldname,$object_id,$default='') {?>
 <input type="<?php echo $type?>" value="<?php echo get_post_meta($object_id,$fieldname,true)?get_post_meta($object_id,$fieldname,true):$default; ?>" name="<?php echo $fieldname;?>">
<?php } ?>



<table id='locate-anything-main-table' style="width: 100%">
<tr><td id="map-preview" style="width: 100%">
<!-- Map preview -->
<iframe scrolling="no" seamless="seamless" name="map_preview" src="<?php echo plugin_dir_url(__FILE__)?>locate-and-filter-preview.php?id=preview"></iframe>			 	 
</td></tr></table>

<a class="refresh" onclick="refresh_preview()">Refresh preview</a>

<h2 class="nav-tab-wrapper">
    <a  data-pane="1"  data-animation="50%" class="active nav-tab"><?php _e("Map settings","locate-and-filter");?></a>
    <a class="nav-tab" data-pane="6" data-animation="50%"><?php _e("Filters","locate-and-filter");?></a>
    <a class="nav-tab" data-pane="4" data-animation="50%"><?php _e("Markers settings","locate-and-filter");?></a>   
    <a class="nav-tab" data-pane="2" data-animation="50%"><?php _e("Tooltip & Nav List","locate-and-filter");?></a>
   	<a class="nav-tab" data-pane="3" data-animation="50%"><?php _e("Map Layouts","locate-and-filter");?></a>
		<a class="nav-tab" data-pane="5" data-animation="50%"><?php _e("Tools & Shortcodes","locate-and-filter");?></a>
		<a class="nav-tab" data-pane="7" data-animation="50%"><?php _e("Support","locate-and-filter");?></a>
</h2>

<div id="locate-anything-wrapper">
<table id='locate-anything-main-table' style="width: 100%">
<tr>
<td style="width: 100%">
<table  id="locate-anything-map-settings-page-1" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul">
<tbody style="position: relative;">
<tr><td><h2><?php _e("General settings","locate-and-filter")?></h2></td></tr>  

  <!-- Map provider -->
<tr id="map-provider">
<td><?php _e("Map Overlay","locate-and-filter");?> &nbsp;<input type="button" data-target="map-provider" class="locate-anything-help"></td>
<td nowrap><select name="locate-anything-map-provider" id="locate-anything-map-provider">

<?php foreach (Locate_And_Filter_Assets::getMapOverlays() as $overlay){?>
	<option value="<?php echo $overlay->id;?>" data-url="<?php echo $overlay->url;?>" data-attribution="<?php echo $overlay->attribution;?>" <?php if(get_post_meta($object->ID,'locate-anything-map-provider',true)==$overlay->id) echo "selected";?> ><?php echo $overlay->name?></option>
<?php }?>

</select><br><small><?php _e("<b>Important : </b> if you choose GoogleMaps you MUST enter a GoogleMaps API key in the <a href='".admin_url()."edit.php?post_type=locateandfiltermap&page=locate-anything-settings'>options page</a>","locate-and-filter");?> </small>
</td></tr>	

<tr id='show-attr-label' >
<td><?php _e("Show attribution label","locate-and-filter")?> &nbsp;<input type="button" data-target="show-attr-label" class="locate-anything-help"> </td>
<td>	 
			  <input type="radio" name="locate-anything-show-attribution-label" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-show-attribution-label', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-show-attribution-label" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-show-attribution-label', true )=="0" ||  get_post_meta( $object->ID, 'locate-anything-show-attribution-label', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?></td>
</tr>

<?php echo do_action("LocateAnything-general-settings-form",$object->ID)?>



<!-- Map Style for GoogleMaps -->
<tr id="map-hue">
<td><?php _e("Map hue (GoogleMaps only)","locate-and-filter");?> &nbsp;<input type="button" data-target="map-hue" class="locate-anything-help"></td>
<td><input type="color" name="locate-anything-googlemaps-hue" value="<?php echo  esc_attr( get_post_meta( $object->ID, 'locate-anything-googlemaps-hue', true ) );?>"></td>
</tr>


<!-- Map Settings -->
<tr id="map-width">
<td><?php _e("Map width","locate-and-filter");?>&nbsp;<input type="button" data-target="map-width" class="locate-anything-help"></td>
<td> <input type="text" size="5" placeholder="100%,850px,..."  name="locate-anything-map-width" value="<?php if(get_post_meta( $object->ID, 'locate-anything-map-width', true )) echo  esc_attr(get_post_meta( $object->ID, 'locate-anything-map-width', true )); else echo "100%";?>"></td>
</tr>
<tr id="map-height">
<td><?php _e("Map height","locate-and-filter");?> &nbsp;<input type="button" data-target="map-height" class="locate-anything-help"></td>
<td> <input type="text" size="5" placeholder="500px"  name="locate-anything-map-height" value="<?php if(get_post_meta( $object->ID, 'locate-anything-map-height', true )) echo  esc_attr(get_post_meta( $object->ID, 'locate-anything-map-height', true)); else echo "500px";?>"></td>
</tr>
<tr id="startposition">
<td><?php _e("Default start position","locate-and-filter");?> &nbsp;<input type="button" data-target="startposition" class="locate-anything-help"></td>
<td> <input type="text" size="12" placeholder="lat,lon"  name="locate-anything-start-position" id="locate-anything-start-position" value="<?php echo  esc_attr( get_post_meta( $object->ID, 'locate-anything-start-position', true ) );?>"></td>
</tr>
<tr id="maxzoom">
<td><?php _e("Max zoom","locate-and-filter")?> &nbsp;<input type="button" data-target="maxzoom" class="locate-anything-help"> </td>
<td>
<input name="locate-anything-max-zoom" type ="range" min ="1" max="18" step ="1" value ="<?php   $v= esc_attr( get_post_meta( $object->ID, 'locate-anything-max-zoom', true ) );echo $v?$v:18?>"/>
</td>
</tr>

<tr id="minzoom">
<td><?php _e("Min zoom","locate-and-filter")?> &nbsp;<input type="button" data-target="minzoom" class="locate-anything-help"> </td>
<td>
<input name="locate-anything-min-zoom" type ="range" min ="1" max="18" step ="1" value ="<?php   $v= esc_attr( get_post_meta( $object->ID, 'locate-anything-min-zoom', true ) );echo $v?$v:2?>"/>
</tr>
<tr id="startzoom">
<td><?php _e("Initial zoom","locate-and-filter")?> &nbsp;<input type="button" data-target="startzoom" class="locate-anything-help"> </td>
<td>
<input name="locate-anything-start-zoom" id="locate-anything-start-zoom" type ="range" min ="1" max="18" step ="1" value ="<?php $v= esc_attr( get_post_meta( $object->ID, 'locate-anything-start-zoom', true ) );echo $v?$v:5?>"/>
</td>
</tr>

<tr id="singlezoom">
<td><?php _e("Single zoom","locate-and-filter")?> &nbsp;<input type="button" data-target="singlezoom" class="locate-anything-help"> </td>
<td>
<input name="locate-anything-single-zoom" id="locate-anything-single-zoom" type ="range" min ="1" max="18" step ="1" value ="<?php $v= esc_attr( get_post_meta( $object->ID, 'locate-anything-single-zoom', true ) );echo $v?$v:5?>"/>
</td>
</tr>

<tr >
<td><?php _e("Zoom using mousewheel","locate-and-filter")?> &nbsp; </td>
<td>	 
			  <input type="radio" name="locate-anything-scrollWheelZoom" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-scrollWheelZoom', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-scrollWheelZoom" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-scrollWheelZoom', true )=="0" ||  get_post_meta( $object->ID, 'locate-anything-scrollWheelZoom', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>

</td>
</tr>

<tr id="autogeocode">
<td><?php _e("Enable user geolocation","locate-and-filter")?> &nbsp;<input type="button" data-target="autogeocode" class="locate-anything-help"> </td>
<td>	 
			  <input type="radio" name="locate-anything-usergeolocation-zoom" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-usergeolocation-zoom', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-usergeolocation-zoom" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-usergeolocation-zoom', true )=="0" ||  get_post_meta( $object->ID, 'locate-anything-usergeolocation-zoom', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>

</td>
</tr>

<tr id="googleplaces">
<td><?php _e("Enable Google Places searchbox","locate-and-filter")?>  &nbsp;<input type="button" data-target="googleplaces" class="locate-anything-help"></td>
<td>			 
			  <input type="radio" name="locate-anything-googleplaces" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-googleplaces', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-googleplaces" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-googleplaces', true )=="0" || get_post_meta( $object->ID, 'locate-anything-googleplaces', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
			</td>
</tr>

<tr>
<td><a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a>(<a href='https://demo-top.locateandfilter.com/' class='proversion2' target='_blank'>see demo</a>)</td>
</tr>

<tr id="geosearch" class="group_by_location only_pro">
<td><?php _e("Enable Leaflet geosearch searchbox","locate-and-filter")?>  &nbsp;<input type="button" data-target="geosearch" class="locate-anything-help"></td>
<td>			 
			  <input type="radio" name="locate-anything-geosearch" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-geosearch', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-geosearch" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-geosearch', true )=="0" || get_post_meta( $object->ID, 'locate-anything-geosearch', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
			</td>
</tr>


<tr id="search_box_by_location" class="group_by_location only_pro">
<td><?php _e("Enable searchbox by address","locate-and-filter")?> &nbsp;<input type="button" data-target="search_box_by_location" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-search_box_by_location" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_location', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-search_box_by_location" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_location', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_location', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="search_box_by_location_structured" class="group_by_location only_pro <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_location', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_location', true )==false) echo "noactive" ;?>">
<td><?php _e("Searchbox by Structured address","locate-and-filter")?> &nbsp;<input type="button" data-target="search_box_by_location_structured" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-search_box_by_location_structured" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_location_structured', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-search_box_by_location_structured" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_location_structured', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_location_structured', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="search_box_by_radius" class="group_by_location only_pro">
<td><?php _e("Enable searchbox by Radius","locate-and-filter")?> &nbsp;<input type="button" data-target="search_box_by_radius" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-search_box_by_radius" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-search_box_by_radius" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="search_box_by_radius_unit" class="group_by_location only_pro <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )==false) echo "noactive" ;?>">
<td><?php _e("Enable Radius by miles","locate-and-filter")?> &nbsp;<input type="button" data-target="search_box_by_radius_unit" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-search_box_by_radius_unit" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_radius_unit', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-search_box_by_radius_unit" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_radius_unit', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_radius_unit', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="search_box_by_radius_value" class="group_by_location only_pro <?php if (get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )=="0" || get_post_meta( $object->ID, 'locate-anything-search_box_by_radius', true )==false) echo "noactive" ;?>">
<td><?php _e("Set default Radius value","locate-and-filter")?></td>
<td>
							<select id="locate-anything-search_box_by_radius_value" class="locate-anything-search_box_by_radius_value" name="locate-anything-search_box_by_radius_value" >
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==1) echo 'selected="selected"';?> value="1">1</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==5) echo 'selected="selected"';?> value="5">5</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==10) echo 'selected="selected"';?> value="10">10</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==25) echo 'selected="selected"';?>  value="25">25</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==50) echo 'selected="selected"';?> value="50">50</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==75) echo 'selected="selected"';?> value="75">75</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==100) echo 'selected="selected"';?> value="100">100</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==200) echo 'selected="selected"';?> value="200">200</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==300) echo 'selected="selected"';?> value="300">300</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-search_box_by_radius_value',true)==500) echo 'selected="selected"';?> value="500">500</option>
							</select>
</td>	
</tr>


<tr id="navnumbers">
<td><?php _e("Max number of results displayed in the list","locate-and-filter")?> &nbsp;<input type="button" data-target="navnumbers" class="locate-anything-help"></td>
<td><input type="text"  size="5" name="locate-anything-nav-number" value="<?php $v=get_post_meta($object->ID, 'locate-anything-nav-number', true );echo $v?$v:10;?>"></td>
</tr>

<tr id="display_only_inbound">
<td><?php _e("Refresh list as you go","locate-and-filter")?> &nbsp;<input type="button" data-target="display_only_inbound" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-display_only_inbound" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-display_only_inbound', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-display_only_inbound" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-display_only_inbound', true )=="0" || get_post_meta( $object->ID, 'locate-anything-display_only_inbound', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="hide-splashscreen">
<td><?php _e("Hide loader screen","locate-and-filter")?></td>
<td>
		  <input type="radio" name="locate-anything-hide-splashscreen" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-hide-splashscreen', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-hide-splashscreen" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-hide-splashscreen', true )=="0" || get_post_meta( $object->ID, 'locate-anything-hide-splashscreen', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="display_load-pretty-checkbox">
<td><?php _e("Load Pretty checkbox","locate-and-filter")?> &nbsp;<input type="button" data-target="display_load-pretty-checkbox" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-load-pretty-checkbox" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-load-pretty-checkbox', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-load-pretty-checkbox" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-load-pretty-checkbox', true )=="0" || get_post_meta( $object->ID, 'locate-anything-load-pretty-checkbox', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr>
<td><a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a></td>
</tr>

<tr id="enable_fitBounds" class="only_pro">
<td><?php _e("Enable fitBounds","locate-and-filter")?> &nbsp;<input type="button" data-target="enable_fitBounds" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-enable_fitBounds" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_fitBounds', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-enable_fitBounds" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_fitBounds', true )=="0" || get_post_meta( $object->ID, 'locate-anything-enable_fitBounds', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="enable_zoom_to_marker" class="only_pro">
<td><?php _e("Enable Zoom to marker","locate-and-filter")?> &nbsp;<input type="button" data-target="enable_zoom_to_marker" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-enable_zoom_to_marker" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_zoom_to_marker', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-enable_zoom_to_marker" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_zoom_to_marker', true )=="0" || get_post_meta( $object->ID, 'locate-anything-enable_zoom_to_marker', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="filter_terms_orderby" class="only_pro">
<td><?php _e("Sorting method for filter elements","locate-and-filter")?> &nbsp;<input type="button" data-target="filter_terms_orderby" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-filter_terms_orderby" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-filter_terms_orderby', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-filter_terms_orderby" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-filter_terms_orderby', true )=="0" || get_post_meta( $object->ID, 'locate-anything-filter_terms_orderby', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<!-- <tr id="">
<td><?php _e("Remove the 'Powered by LocateAndFilter' label","locate-and-filter")?></td>
<td><?php _e(" &nbsp;<a target='_blank' href=#'>Get a License Key for only $4.99!</a>","locate-and-filter")?></td>
</tr> -->


</table>
			 
<table id="locate-anything-map-settings-page-6" class="locate-anything-map-settings-list-ul locate-anything-map-option-pane" style="display:none" >	
<!-- Post Type / Source -->
<tbody style="position: relative;">
<tr><td colspan="2"><h2><?php _e("Choose a post type","locate-and-filter");?></h2></td></tr>
<tr id="map-source">
<td>
<b><?php _e("Post Type","locate-and-filter");?></b>&nbsp;<input type="button" data-target="map-source" class="locate-anything-help"></td>
<td>
<input type="hidden" name="locate-anything-filters" value='' >			 
<select name="locate-anything-source" id="locate-anything-source"> 
		<?php 
		/* Sources */
		$sources=array();		
		$sources=apply_filters("locate_anything_add_sources",$sources);
		$selected_element=get_post_meta( $object->ID, 'locate-anything-source', true );
		foreach ($sources as $key => $value) {
			if ($selected_element==$key) $sel="selected";else $sel='';
			?>
			<option <?php echo $sel?> value="<?php echo $key?>"><?php echo $value?></option>
		<?php }	

		$post_types = unserialize (get_option ( 'locate-anything-option-sources' ));			  
			  foreach ( $post_types as $post_type ) { ?>
			  	<option value="<?php echo $post_type?>" <?php if ($selected_element==$post_type) echo " selected ";?> ><?php echo get_post_type_object($post_type)->labels->singular_name?></option>
			  <?php	} ?>
</select></td>
</tr>

<tr id="enable_singleshortcode" class="only_pro">
<td><?php _e("Enable Single shortcode","locate-and-filter")?> &nbsp;<input type="button" data-target="enable_singleshortcode" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-enable_singleshortcode" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_singleshortcode', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			<input type="radio" name="locate-anything-enable_singleshortcode" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_singleshortcode', true )=="0" || get_post_meta( $object->ID, 'locate-anything-enable_singleshortcode', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="enable_acf_for_filters" class="group_by_location only_pro">
<td><?php _e("Enable ACF for filters","locate-and-filter")?> &nbsp;<input type="button" data-target="enable_acf_for_filters" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-enable_acf_for_filters" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_acf_for_filters', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			<input type="radio" name="locate-anything-enable_acf_for_filters" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_acf_for_filters', true )=="0" || get_post_meta( $object->ID, 'locate-anything-enable_acf_for_filters', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<!-- Filters -->
<tr><td colspan="2"><h2><?php _e("Filter the markers (optional)","locate-and-filter");?></h2></td></tr>
<tr>
<td colspan="2"><b><?php _e("Filter the markers ","locate-and-filter");?></b> &nbsp;<input type="button" data-target="map-filters" class="locate-anything-help"></td>
</tr>
<?php echo do_action("LocateAnything-general-settings-form-filters",$object->ID)?>
<tr  id="map-filters">
<td colspan="2"><span id='filters'></span></td>
</tr>

<tr><td colspan="2"><h2><?php _e("How is this map filterable ?","locate-and-filter");?></h2></td></tr>
<tr  id="tr-show-filters">
<!-- defines show filters to empty, will be overwritten by the real show filters if all checkboxes are not unchecked -->
<input type="hidden" name="locate-anything-show-filters[]" value=''>
<td><b><?php _e("Make this map filterable by","locate-and-filter");?></b>:&nbsp;<input type="button" data-target="tr-show-filters" class="locate-anything-help"></td>
<td ><span id='show-filters'></span></td>
</tr>
</tbody>
</table>	 
			
<table id="locate-anything-map-settings-page-4" class="locate-anything-map-settings-list-ul locate-anything-map-option-pane" style="display:none" >	
<tbody style="position: relative;">
<tr><td colspan="2"><h2><?php _e("Choose the default marker icon","locate-and-filter")?></h2></td></tr>  
<tr>
<td><input type="radio" <?php if (get_post_meta($object->ID,"locate-anything-marker-type",true)=="standard" || get_post_meta($object->ID,"locate-anything-marker-type",true)==false) echo 'checked' ?> name="locate-anything-marker-type" value="standard"> <b><?php _e("Choose an icon","locate-and-filter")?></b></td>

<td> 
			   <!-- marker selector -->
			   <div id="locate-anything-marker-selector">			
			<select style='width:80px !important' name="locate-anything-default-marker" id="locate-anything-default-marker">				 
				 <?php foreach (Locate_And_Filter_Assets::getMarkers() as $marker){?>
				 	<option value="<?php echo $marker->id?>" <?php if(esc_attr(get_post_meta($object->ID,"locate-anything-default-marker",true))==$marker->id) echo "selected"?>><?php echo $marker->url?></option>	 		
		<?php }?>  
			</select>		
</div></td>
</tr>



<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td><input type="radio" <?php if (get_post_meta($object->ID,"locate-anything-marker-type",true)=="awesomemarker") echo 'checked' ?> name="locate-anything-marker-type" value="awesomemarker"> <b><?php _e("Create an icon","locate-and-filter")?></b></td>

<td >
<!-- Awesome marker creator -->
			<div id="locate-anything-marker-creator">		
					<?php _e("Symbol","locate-and-filter")?> : <select style='width:80px !important'  name="locate-anything-marker-symbol" id="locate-anything-marker-symbol">
					<?php 
					$selected_awesome=get_post_meta($object->ID,"locate-anything-marker-symbol",true);
					include plugin_dir_path ( __FILE__ ) . "../../includes/ionicon-options.php"?>
					</select>
					<br>
					<?php _e("Symbol color","locate-and-filter")?> : <input type="color" value="<?php echo get_post_meta($object->ID,"locate-anything-marker-symbol-color",true)?>"  name="locate-anything-marker-symbol-color">
					<br>
					<?php _e("Marker color","locate-and-filter")?> : 
					<select name="locate-anything-marker-color">
					<?php foreach(array('red', 'darkred', 'orange', 'green', 'darkgreen', 'blue', 'purple', 'darkpurple', 'cadetblue') as $color){
						?>
						<option <?php if($color==get_post_meta($object->ID,"locate-anything-marker-color",true)) echo "selected"; ?> value="<?php echo $color?>"><?php echo $color?></option>
					<?php }?>
					</select>
					</div>
</td>
</tr>

<tr><td><b><?php _e("Icon size for AwesomeMarkers","locate-and-filter")?></b></td><td><input name="locate-anything-marker-size" type="range" min="10" max="20" step="1" value="<?php echo get_post_meta($object->ID,"locate-anything-marker-size",true)?>"></td></tr>


	<!-- medialibrary -->
	<tr>
		<td colspan="2">&nbsp;</td></tr>
	<tr>
		<td><a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a></td>
	</tr>
	<tr>
		<td id="medialibrary" class="only_pro"><input type="radio" <?php if (get_post_meta($object->ID,"locate-anything-marker-type",true)=="medialibrary") echo 'checked' ?> name="locate-anything-marker-type" value="medialibrary"> <b><?php _e("Add an icon from the media library","locate-and-filter")?></b>&nbsp;<input type="button" data-target="medialibrary" class="locate-anything-help"></td>
		<td>
			<img id="default-marker-media">
			<div class="uploader">
				<input id="locate-anything-marker-type" name="locate-anything-default-marker-media" type="hidden" value="<?php  echo esc_attr(get_post_meta($object->ID,"locate-anything-default-marker-media",true))?>" /> <input id="locate-anything-marker-type_button" class="button-admin"  name="locate-anything-marker-type_button" type="text" value="<?php _e("Add","locate-and-filter")?>" />
			</div>
		</td>
	</tr><!-- /medialibrary -->

<!-- different source lat lon -->
<tr><td colspan="2"><h2><?php _e("Set different source for coordinates","locate-and-filter");?></h2></td></tr>
<tr id="enable_source_for_coordinates" class="group_by_location">
<td class="only_pro"><?php _e("Enable different source for coordinates","locate-and-filter")?> &nbsp;<input type="button" data-target="enable_source_for_coordinates" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-enable_source_for_coordinates" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_source_for_coordinates', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			<input type="radio" name="locate-anything-enable_source_for_coordinates" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_source_for_coordinates', true )=="0" || get_post_meta( $object->ID, 'locate-anything-enable_source_for_coordinates', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>


</tbody>
</table>

<table id="locate-anything-map-settings-page-5" class="locate-anything-map-settings-list-ul locate-anything-map-option-pane" style='display:none' >	

<!-- deprecated  -->
<tr class="deprecated">
	<td><h2><?php _e("Load a KML file (beta)")?></h2></td>
</tr>
<tr class="deprecated">
	<td id="kml"><b><?php _e("KML Style Options","locate-and-filter")?></b></td>
	<td>
		<ul>
			<li>Fill Color : <?php makeInput("color","locate-anything-kml_fillColor",$object->ID,'#cbbdfb') ?></li>
			<li>Opacity : <?php makeInput("text","locate-anything-kml_opacity",$object->ID,'1') ?></li>
			<li>Line width : <?php makeInput("number","locate-anything-kml_weight",$object->ID,'2') ?></li>
			<li>Color :  <?php makeInput("color","locate-anything-kml_color",$object->ID,'#000') ?></li>
			<li>Fill Opacity :  <?php makeInput("text","locate-anything-kml_fillOpacity",$object->ID,'0.5') ?></li>
			<li>Dash array :  <?php makeInput("number","locate-anything-kml_dashArray",$object->ID,'2') ?></li>
		</ul>
		<div class="uploader">
			<input id="locate-anything-kml-file" name="locate-anything-kml-file" type="text" value="<?php  echo esc_attr(get_post_meta($object->ID,"locate-anything-kml-file",true))?>" /> <input id="locate-anything-kml-file_button" class="button-admin"  name="locate-anything-kml-file_button" type="text" value="<?php _e("Select file","locate-and-filter")?>" />
	  </div>
  </td>
</tr>



<tr><td><h2><?php _e("Shortcodes")?></h2></td></tr>
<tr><td>	
<ul>
<li><b><?php _e("Display the map with a predefined layout","locate-and-filter")?></b> : [LocateAndFilter map_id=<?php echo $object->ID?>]</li>
<li><b><?php _e("Display the map separately","locate-and-filter")?></b> : [LocateAndFilter_map map_id=<?php echo $object->ID?>]</li>
<li><b><?php _e("Display the filters separately","locate-and-filter")?></b> : [LocateAndFilter_filters map_id=<?php echo $object->ID?>]</li>
<li><b><?php _e("Display the navigation list separately","locate-and-filter")?></b> : [LocateAndFilter_navlist map_id=<?php echo $object->ID?>]</li>
<a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a>
<li class="only_pro"><b><?php _e("Display the map for single Post type","locate-and-filter")?></b> : [LocateAndFilter_single map_id=<?php echo $object->ID?>]</li>
<li class="only_pro"><b><?php _e("Display the map for current category","locate-and-filter")?></b> : [LocateAndFilter map_id=<?php echo $object->ID?> categoryfilter="51"]</li>
</ul>
</td></tr>

<tr><td><h2><?php _e("Cache")?></h2></td></tr>
<tr>
<td><?php  if(unserialize(get_option("locate-anything-option-enable-cache"))==0) _e("The cache is currently disabled. You can activate it in the options page","locate-and-filter"); else {?>
<a onclick='refresh_cache()'><?php _e("Refresh cache for this map","locate-and-filter")?></a><br/><?php _e("Status","locate-and-filter")?> : <span id="result_cache"><?php _e("ready","locate-and-filter")?></span>
<?php }?>
</td>
</tr>
</tbody>
</table>
   <!-- Tooltips -->
<table id="locate-anything-map-settings-page-2" class="locate-anything-map-settings-list-ul locate-anything-map-option-pane" style='display:none' >
<tbody style="position: relative;">
<tr><td><h2><?php _e("Navlist Settings","locate-and-filter")?></h2></td></tr> 
<tr><td><?php _e("Event","locate-and-filter")?></td><td><input type="radio" <?php if(get_post_meta($object->ID,"locate-anything-navlist-event",true)=="click") echo "checked" ?> name="locate-anything-navlist-event" value="click">Click <input type="radio" <?php if(get_post_meta($object->ID,"locate-anything-navlist-event",true)=="hover" || get_post_meta($object->ID,"locate-anything-navlist-event",true)==false) echo "checked" ?> name="locate-anything-navlist-event" value="hover">Hover</radio></td></tr>

<tr>
	<td><a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a></td>
</tr>
<tr id="enable_markerBouncing" class="only_pro">
<td><?php _e("Enable Marker Bouncing","locate-and-filter")?> &nbsp;<input type="button" data-target="enable_markerBouncing" class="locate-anything-help"></td>
<td>
		  <input type="radio" name="locate-anything-enable_markerBouncing" value="1" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_markerBouncing', true )=="1") echo "checked" ;?>> <?php _e("yes","locate-and-filter")?>
			  <input type="radio" name="locate-anything-enable_markerBouncing" value="0" <?php if (get_post_meta( $object->ID, 'locate-anything-enable_markerBouncing', true )=="0" || get_post_meta( $object->ID, 'locate-anything-enable_markerBouncing', true )==false) echo "checked" ;?>> <?php _e("no","locate-and-filter")?>
</td>
</tr>

<tr id="navlist_orderby" class="navlist_orderby only_pro">
<td><?php _e("Set orderby for navlist","locate-and-filter")?></td>
<td>
							<select id="locate-anything-navlist_orderby" class="locate-anything-navlist_orderby" name="locate-anything-navlist_orderby" >
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='none') echo 'selected="selected"';?> value="none">none</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='title') echo 'selected="selected"';?> value="title">title</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='name') echo 'selected="selected"';?> value="name">name</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='date') echo 'selected="selected"';?>  value="date">date</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='modified') echo 'selected="selected"';?> value="modified">modified</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='relevance') echo 'selected="selected"';?> value="relevance">relevance</option>
								<option <?php if(get_post_meta($object->ID,'locate-anything-navlist_orderby',true)=='menu_order') echo 'selected="selected"';?> value="menu_order">menu_order</option>
							</select>
</td>	
</tr>

<tr><td><h2><?php _e("Tooltips Settings","locate-and-filter")?></h2></td></tr>
<tr>
	<td><a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a></td>
</tr>
<tr class="only_pro" ><td><?php _e("Open popup by Event:","locate-and-filter")?></td><td><input type="radio" <?php if(get_post_meta($object->ID,"locate-anything-popup-event",true)=="click" || get_post_meta($object->ID,"locate-anything-popup-event",true)==false) echo "checked" ?> name="locate-anything-popup-event" value="click">Click <input type="radio" <?php if(get_post_meta($object->ID,"locate-anything-popup-event",true)=="hover") echo "checked" ?> name="locate-anything-popup-event" value="hover">Hover</radio></td></tr> 
<tr>
<td><b><?php _e("Tooltip style","locate-and-filter")?> </b>:</td>
<td><select name="locate-anything-tooltip-style"><option <?php if(get_post_meta($object->ID,"locate-anything-tooltip-style",true)=="rounded") echo "selected" ?> value="rounded"><?php _e("Rounded corners","locate-and-filter")?></option><option <?php if(get_post_meta($object->ID,"locate-anything-tooltip-style",true)=="squared") echo "selected" ?> value="squared"><?php _e("Squared corners","locate-and-filter")?></option></select></td>
</tr>
<tr>
<td><b><?php _e("Tooltip Preset","locate-and-filter")?> </b>:</td>
<td><select name="locate-anything-tooltip-preset" id="locate-anything-tooltip-preset">
<?php 
$u=Locate_And_Filter_Admin::getDefaultTemplates();
/* tooltip presets */
$tooltip_presets=array(
       (object)array("class"=>'',"name"=>__('none',"locate-and-filter"),"template"=>$u["tooltip"]),
       (object)array("class"=>'nice-tooltips',"name"=>'Nice Tooltips',"template"=>$u["nice-tooltip"])
       );                       
 $tooltip_presets=apply_filters("locate_anything_tooltip_presets",$tooltip_presets);
 $selectedPreset=get_post_meta($object->ID,"locate-anything-tooltip-preset",true);
 foreach ($tooltip_presets as  $preset) {
 	if($selectedPreset==$preset->class) $say="selected";else $say='';
 	echo '<option '.$say.' value="'.$preset->class.'" data-template="'.$preset->template.'">'.$preset->name.'</option>';
 }?>
</select>
</td>
</tr>

<tr>
<td><b><?php _e("Navlist Preset","locate-and-filter")?> </b>:</td>
<td><select name="locate-anything-navlist-preset" id="locate-anything-navlist-preset">
<?php 
$u=Locate_And_Filter_Admin::getDefaultTemplates();
/* navlist presets */
$navlist_presets=array(
       (object)array("class"=>'',"name"=>__('none',"locate-and-filter"),"template"=>'')     
       );                       
 $navlist_presets=apply_filters("locate_anything_navlist_presets",$navlist_presets);
 $selectedPreset=get_post_meta($object->ID,"locate-anything-navlist-preset",true);
 foreach ($navlist_presets as  $preset) {
 	if($selectedPreset==$preset->class) $say="selected";else $say='';
 	echo '<option '.$say.' value="'.$preset->class.'" data-template="'.$preset->template.'">'.$preset->name.'</option>';
 }?>
</select>
</td>
</tr>
<tr id="nice-tooltips-settings">
<td><?php _e("Nice Tooltips settings","locate-and-filter")?> : &nbsp;<input type="button" data-target="nice-tooltips-settings" class="locate-anything-help"></td><td><?php _e("Main image max-height","locate-and-filter")?> : <input type="text" value="<?php echo get_post_meta($object->ID,"locate-anything-nice-tooltips-img-height",true)?get_post_meta($object->ID,"locate-anything-nice-tooltips-img-height",true):"150px"?>" name="locate-anything-nice-tooltips-img-height">
</td></tr>
<tr><td><h2><?php _e("Templates","locate-and-filter")?></h2></td></tr> 
<tr>
<td colspan="2" id="addifields"><div class="LA_additional_fields_notice">
				<b><?php _e("Available fields","locate-and-filter")?> &nbsp;<input type="button" data-target="addifields" class="locate-anything-help"></b>	
				<p></p>			
				<?php Locate_And_Filter_Admin::displayAdditionalFieldNotice($selected_element)?>			
			</div></td>
</tr>
<tr >		
<td colspan="2" id="templates"><br><b ><?php _e("Default navigation list template","locate-and-filter")?>&nbsp;<input type="button" data-target="templates" class="locate-anything-help"></b> <br> <textarea style='width:90%;height:20em'  name="locate-anything-default-nav-template" id="locate-anything-default-nav-template"><?php  $ct=esc_attr( get_post_meta( $object->ID, 'locate-anything-default-nav-template', true ) ); if(!$ct) echo $u["navlist"];else echo $ct;?></textarea>
			  <br/>
			  <b><?php _e("Default Tooltip template","locate-and-filter")?>&nbsp;<input type="button" data-target="templates" class="locate-anything-help"> </b> <br> <textarea style='width:90%;height:20em' name="locate-anything-default-tooltip-template" id="locate-anything-default-tooltip-template"><?php  $ct=esc_attr( get_post_meta( $object->ID, 'locate-anything-default-tooltip-template', true ) ); if(!$ct) echo $u["tooltip"];else echo $ct;?>
			  </textarea>

			  </td>

</tr>
</tbody>
</table>



 <table id="locate-anything-map-settings-page-3" class="locate-anything-map-settings-list-ul locate-anything-map-option-pane" style='display:none' >
<!-- Map Layout -->
<tbody style="position: relative;">
<tr><td colspan="2"><h2><?php _e("Map Layout","locate-and-filter")?>&nbsp;<input type="button" data-target="maplayout" class="locate-anything-help"></h2></td></tr>
<tr>
	<td>
		Available shortcode: <strong>[map]</strong> <strong>[navlist]</strong> and <strong>[filters]</strong><br>
		on Pro version available additional new shortcodes <strong>[search]</strong> and <strong>[searchbylocation]</strong><br>
		<br>
		<div>for RESET button you need use any tag with id="reset-filters" 
		<pre class="lang:default decode:true " >&lt;a href="#" id="reset-filters" class="reset"&gt;Reset&lt;/a&gt;</pre> </div>

		<div>for ERROR message you need use any tag with class="LA_search_location_result_error"
		<pre class="lang:default decode:true " >&lt;div class="LA_search_location_result_error"&gt;&lt;/div&gt;</pre> </div>
	</td>
</tr>
<tr id="maplayout">
<td><?php _e("Map Layout","locate-and-filter")?> </td>
<td><select name="locate-anything-map-template" id="locate-anything-map-template"><?php foreach (Locate_And_Filter_Assets::getMapTemplates() as $template){?>
			 	 	  <option data-url='<?php echo json_encode($template->url);?>' value="<?php echo $template->id;?>" <?php if(get_post_meta($object->ID,'locate-anything-map-template',true)==$template->id) echo "selected";?> ><?php echo $template->name?></option>
			 	 	  		<?php }?></select></td></tr>
<tr>				 	 	  		
<td colspan="2" id="layout_editor"></td>
</tr>	
</tbody>	
</table>

<!-- support tab-->
<table id="locate-anything-map-settings-page-7" class="locate-anything-map-settings-list-ul locate-anything-map-option-pane" style="display:none" >	

<tbody style="position: relative;">

	<tr>
		<td>
			<h2>You need help for setup map?</h2>
			<div>Free support available on plugin page forum <a href="https://wordpress.org/support/plugin/locateandfilter/" target="_blank">https://wordpress.org/support/plugin/locateandfilter/</a> (response 1-3 days)</div>
			<div>for PRO version support available by email: <a href="mailto:monothemes@gmail.com" target="_blank">monothemes@gmail.com</a> (response 1-3 hours)</div>
		</td>
	</tr>
	<tr>
		<td>
			<h2>if you cannot configure the map or you need a function that is not supported in the plugin?</h2>

			<div>I am available to customize the map template to suit your design</div>
			<div>I am available to adding any new functionality to the map</div>
			<div>Please contact me to email <a href="mailto:monothemes@gmail.com" target="_blank">monothemes@gmail.com</a> with the subject 'paid support'</div>
		</td>
	</tr>
	<tr>
		<td>
			<h2>Quick links to help you</h2>
			<div><a href="https://locateandfilter.com/docs/locateandfilter-wp-plugin/" target="_blank">Documentation</a></div>
			<div><a href="https://wordpress.org/support/plugin/locateandfilter/" target="_blank">Searh by forum</a></div>
			<div><a href="https://locateandfilter.com/docs/locateandfilter-wp-plugin/developers-guide/add-new-custom-tags/" target="_blank">Add new Custom tags</a></div>
			<div><a href="https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/acf-field-on-filters/" target="_blank">Use ACF field on map filter</a></div>
			<div><a href="https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/set-different-source-for-coordinates/" target="_blank">Set different source for coordinates</a></div>
			<div><a href="https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/users-on-map-source/" target="_blank">Post type USERS on map source</a></div>
			<div><a href="https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/search-markers-by-location/" target="_blank">Search markers by location</a></div>
			<div><a href="https://locateandfilter.com/locateandfilter-addon-overlays/" target="_blank">Customize your own Map visual style</a></div>
			<div><a href="https://locateandfilter.com/examples/categoryfilter/" target="_blank">Show markers for current category</a></div>
			<div><a href="https://locateandfilter.com/custom_shortcode_filed/" target="_blank">Use any shortcode in markers and list</a></div>
			<div><a href="" target="_blank"></a></div>
			<div><a href="" target="_blank"></a></div>
			<div><a href="" target="_blank"></a></div>
			
		</td>		
	</tr>

</tbody>
</table>
<!-- /support tab-->


	
</td></tr></table>
</div>	
<script type="text/javascript">
	var AJAX_URL= "<?php echo admin_url( 'admin-ajax.php'); ?>";
	var PARTIAL_DIR= "<?php echo  plugin_dir_url(__FILE__); ?>";
	var ADMIN_URL= "<?php echo  admin_url() ?>";
	var OBJECT_ID='<?php echo $object->ID?>';
jQuery(document).ready(function(){

	/* initializes media uploader*/
		initialize_media_uploader();
	/* refreshes Layout code editor*/
	refresh_layout_code()
	/* Layout code editor event*/
jQuery("#locate-anything-map-template").change(function(e){	refresh_layout_code();});

	/* if something changes refresh preview */
	jQuery("input, select, textarea").change(function(){
		refresh_preview();
	});
	/* help texts */
	<?php include plugin_dir_path(__FILE__)."locate-and-filter-help.php";?>
		/* initializes taxonomies */
			locate_anything_refresh_filters();			
		/* Listener : on change of post type,refresh taxonomies */
			jQuery('#locate-anything-source').change(locate_anything_refresh_filters);
		/* initializes marker selector */ 
		initialize_marker_selector("locate-anything-default-marker");
		jQuery("#locate-anything-navlist-preset").change(function(e){locate_anything_select_navpreset(e)});	
		jQuery("#locate-anything-tooltip-preset").change(function(e){locate_anything_select_preset(e)});			
  });



 /* Displays the taxonomies associated with a post type or the user filters */
function locate_anything_refresh_filters(){
	jQuery("#filters").html('');
	jQuery("#show-filters").html('');
	if(jQuery('#locate-anything-source').val()!=='user'){

	
				var posttype = jQuery('#locate-anything-source').val();
				var enable_singleshortcode = <?php if (get_post_meta( $object->ID,"locate-anything-enable_singleshortcode",true)) { echo get_post_meta( $object->ID,"locate-anything-enable_singleshortcode",true); } else { echo '0'; } ?>;
				var enable_acf_for_filters = <?php if (get_post_meta( $object->ID,"locate-anything-enable_acf_for_filters",true)) { echo get_post_meta( $object->ID,"locate-anything-enable_acf_for_filters",true); } else { echo '0'; } ?>;
		
		/* Post filters */
		      jQuery.ajax({
			          type: 'POST',
			          url: AJAX_URL,
			          data: {
			          	"action": "LAgetTaxonomies_plus",
			          	"type":jQuery('#locate-anything-source').val()
			      },
			          success: function(data){
			          	//console.log(data);
			          	var selected='|<?php 
			          		$the_filters=get_post_meta( $object->ID, 'locate-anything-filters',true);
			          		if(is_array($the_filters)) echo implode("|",$the_filters)?>|';
			          	var selectedShow='|<?php 
			          		$the_filters=get_post_meta( $object->ID, 'locate-anything-show-filters',true);
			          		if(is_array($the_filters)) echo implode("|",$the_filters)?>|';	
			          	<?php 
			          	$jsObj='';			          	
			          	if(is_array($the_filters))foreach($the_filters as $filter){
			          		 $r=get_post_meta( $object->ID,"locate-anything-display-filter-".$filter,true);
			          		 if(!empty($r)) $jsObj.= "'$filter':'$r',";
			          		 
			          		 $r_label=get_post_meta( $object->ID,"locate-anything-filter-selector-label-".$filter,true);
			          		 if(  !empty( get_post_meta( $object->ID,"locate-anything-filter-selector-label-".$filter,true) ) ) $jsObj.= "'filter_label-$filter':'$r_label',";

							 $r_sort=get_post_meta( $object->ID,"locate-anything-filter-selector-sort-".$filter,true);
			          		 if(  !empty( get_post_meta( $object->ID,"locate-anything-filter-selector-sort-".$filter,true) ) ) $jsObj.= "'filter_sort-$filter':'$r_sort',";

			          		 $r_icon=get_post_meta( $object->ID,"locate-anything-filter-selector-icon-".$filter,true);
			          		 if(!empty( get_post_meta( $object->ID,"locate-anything-filter-selector-icon-".$filter,true) )) $jsObj.= "'filter_icon-$filter':'$r_icon',";

			          		 $m=get_post_meta( $object->ID,"locate-anything-min-range-".$filter,true) ;	
			          		 $M=get_post_meta( $object->ID,"locate-anything-max-range-".$filter,true);	
			          		 if(!empty($m)) {
			          		  	$jsObj.= "'locate-anything-min-range-$filter':'$m',";
			          		  	$jsObj.= "'locate-anything-max-range-$filter':'$M',";
			          		  }	          		 
			          	}	
			          	echo 'var display_filters={'.$jsObj.'};';	

			          	?>
                           
			          	
			          	data=JSON.parse(data);
			          	//console.log(data);

			          		for(var i=0;i<data.length;i++) {
			          			var item=data[i];
			          			var isChecked='';  
			          			var isCheckedShow=''; 
			          			if(selected.indexOf("|"+item+"|")>-1) isChecked=' checked="checked" ';
			          			if(selectedShow.indexOf("|"+item+"|")>-1) isCheckedShow=' checked="checked" ';
			          			jQuery("#filters").append('<br><input onclick="locate_anything_refresh_template_tags(\''+item+'\')" class="locate-anything-filter-checkbox" type="checkbox" name="locate-anything-filters[]" '+isChecked+' value=\"'+item+'\">Refine by '+item);
			          			jQuery("#show-filters").append('<div style=""><br><input onclick="locate_anything_manage_selector(\''+item+'\')" '+isCheckedShow+' type=\"checkbox\" name=\"locate-anything-show-filters[]\"  value=\"'+item+'\">'+item+'</div>' );

			          			var isCheckbox='', isSelect='',isTokenize='',isRange='',isRadio='',isSelectM='';

			          			if(display_filters[item]=="radio")  isRadio="selected";else if(display_filters[item]=="checkbox")  isCheckbox="selected";else if(display_filters[item]=="select")  isSelect="selected";else if(display_filters[item]=="selectmultiple")  isSelectM="selected"; else if(display_filters[item]=="tokenize") isTokenize="selected";else if(display_filters[item]=="range") isRange="selected";

			          			if(isCheckedShow.length==0) var displaynone="display:none;";else var displaynone="";
			          			if(display_filters["filter_label-"+item]) {
			          				var filter_label = display_filters["filter_label-"+item];
			          			} else {
			          				var filter_label = '';
			          			}

			          			if(display_filters["filter_sort-"+item]) {
			          				var filter_sort = display_filters["filter_sort-"+item];
			          			} else {
			          				var filter_sort = '9999';
			          			}

			          			if(display_filters["filter_icon-"+item]) {
			          				var filter_icon = display_filters["filter_icon-"+item];
			          			} else {
			          				var filter_icon = '';
			          			}
			          			
			          			if(display_filters["filter_icon-"+item] == 'true') {
			          				var filter_icon_check = 'checked';
			          				var filter_icon_check_ = '';
			          			} else {
			          				var filter_icon_check = '';
			          				var filter_icon_check_ = 'checked';
			          			}			          			
			          			jQuery("#show-filters").append('<div style="'+displaynone+'" class="hide-if-'+item+' filter-selector-'+item+'"><b> Selector </b> : <select class="locate-anything-display-filter-" id="locate-anything-display-filter-'+item+'" item="'+item+'" name="locate-anything-display-filter-'+item+'"><option '+isRadio+' value="radio">Radio buttons</option><option '+isCheckbox+' value="checkbox">Checkboxes</option><option '+isSelect+' value="select">Dropdown</option><option '+isSelectM+' value="selectmultiple">Select Multiple</option><option '+isTokenize+' value="tokenize">Tokenize</option><option '+isRange+' value="range">Range</option></select></div>');
			          			/*jQuery("#show-filters").append('<div style="'+displaynone+'" class="hide-if-'+item+' filter-selector-'+item+'"><b> Selector </b> : <select class="locate-anything-display-filter-" id="locate-anything-display-filter-'+item+'" item="'+item+'" name="locate-anything-display-filter-'+item+'"><option '+isCheckbox+' value="checkbox">Checkboxes</option><option '+isSelect+' value="select">Dropdown</option><option '+isSelectM+' value="selectmultiple">Select Multiple</option><option '+isTokenize+' value="tokenize">Tokenize</option><option '+isRange+' value="range">Range</option></select></div>');*/
			          			
			          			/* adding range options */
			          			var rangeOptionsVisible;
			          			if(isRange) rangeOptionsVisible='';else rangeOptionsVisible='style="display:none"';
			          			jQuery("#show-filters").append('<span '+rangeOptionsVisible+' id="range-options-'+item+'"> Min : <input type="text" size="4" id="locate-anything-min-range-'+item+'" name="locate-anything-min-range-'+item+'" value="'+(display_filters['locate-anything-min-range-'+item]|| "")+'"> Max : <input value="'+(display_filters['locate-anything-max-range-'+item] || "")+'" type="text" size="4" id="locate-anything-max-range-'+item+'" name="locate-anything-max-range-'+item+'"></span>');
			          			
			          			/* custom label and icon*/
			          			jQuery("#show-filters").append('<div style="'+displaynone+'" class="hide-if-'+item+' filter-selector-sort-'+item+'"><b> Sort </b> : <input type="number" size="2" id="locate-anything-filter-selector-sort-'+item+'" name="locate-anything-filter-selector-sort-'+item+'" value="'+filter_sort+'"></div>');
			          			jQuery("#show-filters").append('<div style="'+displaynone+'" class="hide-if-'+item+' filter-selector-label-'+item+'"><b> Custom label </b> : <input type="text" size="20" id="locate-anything-filter-selector-label-'+item+'" name="locate-anything-filter-selector-label-'+item+'" value="'+filter_label+'"></div>');
			          			jQuery("#show-filters").append('<div style="'+displaynone+'" class="hide-if-'+item+' filter-selector-icon-'+item+'"><b> Enable icon </b> : <label for="locate-anything-filter-selector-icon-'+item+'-2">yes </label><input type="radio" size="20" id="locate-anything-filter-selector-icon-'+item+'-2" name="locate-anything-filter-selector-icon-'+item+'" value="true" '+filter_icon_check+' ><label for="locate-anything-filter-selector-icon-'+item+'-1">no </label><input type="radio" size="20" id="locate-anything-filter-selector-icon-'+item+'-1" name="locate-anything-filter-selector-icon-'+item+'" value="false" '+filter_icon_check_+' ></div>');
			          			
			          			/* allowed terms */	
			          			jQuery("#filters").append('<div style="'+displaynone+'" class="refine-hide-if-'+item+'"><b>Allowed terms  :</b> <select multiple class="locate-anything-allowed-filters" name="locate-anything-allowed-filters-value-'+item+'[]" id="locate-anything-allowed-filters-value-'+item+'"></select></div></div>');
			          			

			          			

			          			if ( posttype == item && enable_singleshortcode == 1 ) {

			          			} else {
			          				locate_anything_refresh_taxonomy_terms(item);
			          			}
			          			
			          			/* if something changes refresh preview */
								jQuery("input, select, textarea").change(function(){
									refresh_preview();
								});

			          		}
			          locate_anything_refresh_template_tags();
			          /* Event on range selection*/
			          register_range_events();
			          }
			      });
	} 
		/* addon filters*/
		     locate_anything_get_addon_filters();    			
	
		     
}


function locate_anything_select_navpreset(e){
  if(confirm("<?php _e('Do you want to overwrite the current navlist template?','locate-and-filter')?>")) {
  	editAreaLoader.setValue('locate-anything-default-nav-template',jQuery('#locate-anything-navlist-preset :selected').attr("data-template") );
	refresh_textarea('locate-anything-default-nav-template');
  }
}

function locate_anything_select_preset(e){
  if(confirm("<?php _e('Do you want to overwrite the current tooltip template?','locate-and-filter')?>")) {
	editAreaLoader.setValue('locate-anything-default-tooltip-template',jQuery('#locate-anything-tooltip-preset :selected').attr("data-template") );
	refresh_textarea('locate-anything-default-tooltip-template');
  }
}
</script>