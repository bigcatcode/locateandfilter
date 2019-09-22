<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php wp_nonce_field ('I961JpJQTj0crLKH0mGB', 'locate_anything_class_nonce' );
//$post_params = Locate_And_Filter_Admin::getUserMetas( $object->ID );
if ( $post_type=="user" ) {
	$post_params=Locate_And_Filter_Admin::getUserMetas($object->ID);
} else {
	$post_params=Locate_And_Filter_Admin::getPostMetas($object->ID);
}  
 ?>
<div id="locate-anything-wrapper-post">
<h2 class="nav-tab-wrapper">
    <a  data-pane="1" class="active nav-tab"><?php _e("Geo settings","locate-and-filter")?></a>
    <a  class="nav-tab" data-pane="2"><?php _e("Marker","locate-and-filter")?></a>
    <a  class="nav-tab" data-pane="4"><?php _e("Tooltip","locate-and-filter")?></a>
   <a  class="nav-tab" data-pane="3"><?php _e("Additional Fields","locate-and-filter")?></a>

</h2>	
<div id="locate-anything-map-settings-page-1" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul" style="width:auto" >
<table>
<tr><td><h2><?php _e("Geo settings","locate-and-filter")?></h2></td></tr> 

				<tr>
				<td><?php _e("Street name","locate-and-filter")?></td>
				<td><input type="text"	name="locate-anything-street" value="<?php echo  $post_params['locate-anything-street'];?>"></td>
			
				</tr>
				<tr>
				<td><?php _e("Number","locate-and-filter")?></td>
				<td><input type="text" name="locate-anything-streetnumber" value="<?php echo $post_params['locate-anything-streetnumber'];?>"></td>
				</tr>
				<tr>
				<td><?php _e("City","locate-and-filter")?></td>
				<td><input type="text" name="locate-anything-city" value="<?php echo $post_params['locate-anything-city'];?>"></td>
				</tr>
				<tr>
				<td><?php _e("Zip code","locate-and-filter")?></td>
				<td><input type="text" name="locate-anything-zip" value="<?php echo $post_params['locate-anything-zip'];?>"></td>
				</tr>
				<tr>
				<td><?php _e("State / Province","locate-and-filter")?></td>
				<td><input type="text" name="locate-anything-state" value="<?php echo $post_params['locate-anything-state'];?>"></td>
				</tr>
				<tr>
				<td><?php _e("Country","locate-and-filter")?></td>
				<td><input type="text" name="locate-anything-country" value="<?php echo $post_params['locate-anything-country'];?>"></td>
				</tr>
				</table>
<br>
				<input class="button-admin" type="button" onclick="GetLocation()" value="Geolocate this address" />
				<br><br><?php _e("Latitude","locate-and-filter")?> <input type="text" name="locate-anything-lat" value="<?php echo   $post_params['locate-anything-lat'];?>">
				<?php _e("Longitude","locate-and-filter")?> <input type="text" name="locate-anything-lon" value="<?php echo    $post_params['locate-anything-lon'];?>">
				<input class="append-markers button-admin" type="button" value="View Latitude,Longitude on map">
				<!-- add a marker using the map -->
					<div id="map-marker" data-mode="" style="height:300px;margin: 15px 0;">
					    <input type="hidden" data-map-markers="" value="" name="map-geojson-data" />
					</div>
					<div>
					    <input class="get-markers button-admin" type="button" value="Get the Marker" />
					</div>
				<!-- end -->

			</div>
							
			      
  
     <table id="locate-anything-map-settings-page-4" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul" style='width:auto;display:none'>
           <tr><td><h2><?php _e("Customize Tooltip template","locate-and-filter")?></h2></td></tr>  
           <tr>
           <td><b><?php _e("Tooltip Preset","locate-and-filter")?> </b>:</td>
           <td><select name="locate-anything-tooltip-preset" id="locate-anything-tooltip-preset"><?php 
           $u=Locate_And_Filter_Admin::getDefaultTemplates();
/* tooltip presets */
$tooltip_presets=array((object)array("class"=>'default',"name"=>__('Default',"locate-and-filter"),"template"=>''),
       (object)array("class"=>'',"name"=>__('none',"locate-and-filter"),"template"=>$u["tooltip"]),
       (object)array("class"=>'nice-tooltips',"name"=>'Nice Tooltips',"template"=>$u["nice-tooltip"])
       );                       
 $tooltip_presets=apply_filters("locate_anything_tooltip_presets",$tooltip_presets);
 $selectedPreset=$post_params["locate-anything-tooltip-preset"];
 foreach ($tooltip_presets as  $preset) {
 	if($selectedPreset===$preset->class) $say="selected";else $say='';
 	echo '<option '.$say.' value="'.$preset->class.'" data-template="'.$preset->template.'">'.$preset->name.'</option>';
 }?>
</select></td>
           </tr>
           <tr id="nice-tooltips-settings">
<td><?php _e("Nice Tooltips settings","locate-and-filter")?> : &nbsp;<input type="button" data-target="nice-tooltips-settings" class="locate-anything-help"></td><td><?php _e("Main image max-height","locate-and-filter")?> : <input type="text" value="<?php echo $post_params["locate-anything-nice-tooltips-img-height"]?>" name="locate-anything-nice-tooltips-img-height">
</td></tr>
           <tr>
           <td id="customtemplate" width="40%">
           	<div id="locate-anything-marker-html-template">
				<b><?php _e("Custom HTML template","locate-and-filter");?></b>&nbsp;<input type="button" data-target="customtemplate" class="locate-anything-help">
				<div class="LA_custom_template_editor">
				<textarea name="locate-anything-marker-html-template" id="marker-html-template" style="width: 70%; height: 20em"><?php echo $post_params['locate-anything-marker-html-template'];?></textarea>
				</div>
			</div>
			</td>
			<td id="addifields">
			<div class="LA_additional_fields_notice">
				<b><?php _e("Available fields","locate-and-filter")?></b>&nbsp;<input type="button" data-target="addifields" class="locate-anything-help">
				<p><?php _e("Here is a list of the additional fields available for display in the template. To use them just copy/paste the corresponding tag in the template editor","locate-and-filter")?></p>
				<?php Locate_And_Filter_Admin::displayAdditionalFieldNotice($post_type)?>
			
			</div>
           </td>
           </tr>
           </table>
  
   
           <table id="locate-anything-map-settings-page-2" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul" style='display:none'>
           <tr><td><h2><?php _e("Choose a marker icon","locate-and-filter")?></h2></td></tr>  
           <tr>
           <td width="40%">               	
               	<input type="radio" name="locate-anything-marker-type" value="standard" <?php if ($post_params["locate-anything-marker-type"]=="standard" || $post_params["locate-anything-marker-type"]==false ) echo 'checked' ?>> <b><?php _e("Choose an icon","locate-and-filter")?></b> :  
			</td>
			<td>
			<select style="width: 50% !important" name="locate-anything-custom-marker" id="locate-anything-custom-marker">
				 <option value=""><?php _e("Use default marker","locate-and-filter")?></option>
				 <?php foreach (Locate_And_Filter_Assets::getMarkers() as $marker){?>
				 	<option value="<?php echo $marker->id?>" <?php if(esc_attr($post_params["locate-anything-custom-marker"])==$marker->id) echo "selected"?>><?php echo $marker->url?></option>	 		
		<?php }?>  
			</select>
		</td></tr>

<tr><td colspan="2">&nbsp;</td></tr>
<tr >
<td id="medialibrary"><input type="radio" <?php if ($post_params["locate-anything-marker-type"]=="medialibrary") echo 'checked' ?> name="locate-anything-marker-type" value="medialibrary"> <b><?php _e("Add an icon from the media library","locate-and-filter")?></b>&nbsp;<input type="button" data-target="medialibrary" class="locate-anything-help"></td>
<td><img id="default-marker-media">
	<div class="uploader">
	<input id="locate-anything-marker-type" name="locate-anything-default-marker-media" type="hidden" value="<?php  echo esc_attr($post_params["locate-anything-default-marker-media"])?>" /> <input id="locate-anything-marker-type_button" class="button-admin"  name="locate-anything-marker-type_button" type="text" value="<?php _e("Add","locate-and-filter")?>" />
</div>

</td>
</tr>

		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
		<td><input type="radio" <?php if ($post_params["locate-anything-marker-type"]=="awesomemarker") echo 'checked' ?> name="locate-anything-marker-type" value="awesomemarker"> <b><?php _e("Create an icon","locate-and-filter")?> </b> </td>
		<td style="padding: 15px;line-height: 35px;">	
				<!-- Awesome marker creator -->
			
					<?php _e("Symbol","locate-and-filter")?> : <select name="locate-anything-marker-symbol" id="locate-anything-marker-symbol">
					<?php 
					$selected_awesome=$post_params["locate-anything-marker-symbol"];
					include plugin_dir_path ( __FILE__ ) . "../../includes/ionicon-options.php"?>
					</select>
					<br>
					<?php _e("Symbol color","locate-and-filter")?> : <input type="color" value="<?php echo $post_params["locate-anything-marker-symbol-color"]?>"  name="locate-anything-marker-symbol-color">
					<br>
					<?php _e("Marker color","locate-and-filter")?> : 
					<select name="locate-anything-marker-color">
					<?php foreach(array('red', 'darkred', 'orange', 'green', 'darkgreen', 'blue', 'purple', 'darkpurple', 'cadetblue') as $color){
						?>
						<option <?php if($color==$post_params["locate-anything-marker-color"]) echo "selected"; ?> value="<?php echo $color?>"><?php echo $color?></option>
					<?php }?>
					</select>

		</td>
			
			
			</tr>
			</table>		

<table id="locate-anything-map-settings-page-3" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul"  style='display:none' >
<tr><td><h2><?php _e("Additional fields","locate-and-filter")?></h2></td></tr>  
<tr><td>
			<div id="locate-anything-additional_fields">			
			<?php Locate_And_Filter_Admin::displayAdditionalFields($object);?>			  
			</div>   
			</td></tr>    
    </table>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	/* help texts */
	<?php include plugin_dir_path(__FILE__)."locate-and-filter-help.php";?>
			/* initializes marker selector */ 
			initialize_marker_selector("locate-anything-custom-marker");		
				/* initializes the media uploader*/
				initialize_media_uploader();

				jQuery("#locate-anything-tooltip-preset").change(function(e){locate_anything_select_preset(e)});

			});

function locate_anything_select_preset(e){
  if(confirm("<?php _e('Do you want to overwrite the current tooltip template?','locate-and-filter')?>"))jQuery("#marker-html-template").val(jQuery('#locate-anything-tooltip-preset :selected').attr("data-template"));
}
</script>   

<!-- add a marker using the map -->
<script>
	jQuery(document).ready(function($){

	  // We’ll add a OSM tile layer to our map
	  var osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
	      osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	      osm = L.tileLayer(osmUrl, {
	          maxZoom: 18,
	          attribution: osmAttrib
	      });


	  // initialize the map on the "map" div with a given center and zoom
	  var map = L.map('map-marker').setView([44.510275, 10.767032], 1).addLayer(osm);
	  var markersLayer = new L.LayerGroup(); // NOTE: Layer is created here!
	  markersLayer.addTo(map);
	  
	  //console.log($("input[name='locate-anything-lat']").val() );
	  //console.log($("input[name='locate-anything-lon']").val());
	  
	  //init marker
	  if( $("input[name='locate-anything-lat']").val() || $("input[name='locate-anything-lon']").val() ) {
	  	initMarker();
	  }

	  $('.append-markers').click(function(event) {
	  		//if( $('#acf-field_5b854a3d60cd8').val() || $('#acf-field_5b854a8760cd9').val() ) {
	  		if( $("input[name='locate-anything-lat']").val() || $("input[name='locate-anything-lon']").val() ) {
	  			markersLayer.clearLayers();
	  			initMarker();
	  		}
	  });

	  // attaching function on map click
	  map.on('click', onMapClick);

		function initMarker() {
					
				  var input_lat = $("input[name='locate-anything-lat']").val();
				  var input_lon = $("input[name='locate-anything-lon']").val();

				  var geojsonFeature = {
			          "type": "Feature",
			              "properties": {},
			              "geometry": {
			                  "type": "Point",
			                  "coordinates": [input_lat, input_lon]
			          }
			      }

			      var marker;

			      L.geoJson(geojsonFeature, {
			          
			          pointToLayer: function(feature, latlng){
			              
			              marker = L.marker([input_lat, input_lon], {
			                  
			                  title: "Resource Location",
			                  alt: "Resource Location",
			                  riseOnHover: true,
			                  draggable: true,

			              }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-button'/>");

			              marker.on("popupopen", onPopupOpen);
			              markersLayer.addLayer(marker);
			         
			              return marker;
			          }
			      }).addTo(map);

		}

	  // Script for adding marker on map click
	  function onMapClick(e) {

	      var allMarkersObjArray = [];//new Array();
	      var allMarkersGeoJsonArray = [];//new Array();

	  	$.each(map._layers, function (ml) {
	          //console.log(map._layers)
	          if (map._layers[ml].feature) {
	              
	              allMarkersObjArray.push(this)
	                                      allMarkersGeoJsonArray.push(JSON.stringify(this.toGeoJSON()))
	          }
	    });
	    //console.log(allMarkersGeoJsonArray.length);

		if(allMarkersGeoJsonArray.length == 0) {

	      var geojsonFeature = {
	          "type": "Feature",
	              "properties": {},
	              "geometry": {
	                  "type": "Point",
	                  "coordinates": [e.latlng.lat, e.latlng.lng]
	          }
	      }

	      var marker;

	      L.geoJson(geojsonFeature, {
	          
	          pointToLayer: function(feature, latlng){
	              
	              marker = L.marker(e.latlng, {
	                  
	                  title: "Resource Location",
	                  alt: "Resource Location",
	                  riseOnHover: true,
	                  draggable: true,

	              }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-button'/>");

	              marker.on("popupopen", onPopupOpen);
	         
	              return marker;
	          }
	      }).addTo(map);

	    }//end if

	  }


	  // Function to handle delete as well as other events on marker popup open
	  function onPopupOpen() {

	      var tempMarker = this;

	      //var tempMarkerGeoJSON = this.toGeoJSON();

	      //var lID = tempMarker._leaflet_id; // Getting Leaflet ID of this marker

	      // To remove marker on click of delete
	      $(".marker-delete-button:visible").click(function () {
	          map.removeLayer(tempMarker);
	      });
	  }


	  // getting all the markers at once
	  function getAllMarkers() {
	      
	      var allMarkersObjArray = [];//new Array();
	      var allMarkersGeoJsonArray = [];//new Array();

	      $.each(map._layers, function (ml) {
	          //console.log(map._layers)
	          if (map._layers[ml].feature) {
	              
	              allMarkersObjArray.push(this)
	                                      allMarkersGeoJsonArray.push(JSON.stringify(this.toGeoJSON()))
	          }
	      })

	      console.log(allMarkersObjArray);
	      //alert("total Markers : " + allMarkersGeoJsonArray.length + "\n\n" + allMarkersGeoJsonArray + "\n\n Also see your console for object view of this array" );
	  	
	  	if(allMarkersGeoJsonArray.length>0){
			$(this).parent().parent().find("input[name='locate-anything-lat']").val( allMarkersObjArray[0]['_latlng']['lat'] );
			$(this).parent().parent().find("input[name='locate-anything-lon']").val( allMarkersObjArray[0]['_latlng']['lng'] );
	  	}




	  }

	  $(".get-markers").on("click", getAllMarkers);

	}); 
</script>    