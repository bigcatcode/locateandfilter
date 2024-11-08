<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php wp_nonce_field ('I961JpJQTj0crLKH0mGB', 'locate_anything_class_nonce' ); ?>

<h1><?php echo esc_html__('LocateAndFilter - Options', 'locateandfilter'); ?></h1>

<h2 class="nav-tab-wrapper">
    <?php
      $tabs=array(__("Default settings","locateandfilter"));
      $tabs=apply_filters("locate_anything_add_option_tab",$tabs);   

    foreach ($tabs as $tab) {
    	?>
    	 <a data-pane="<?php echo md5($tab)?>"  class="nav-tab"><?php echo $tab;?></a>
    <?php }  ?>
</h2>


<form method="post" id="form-options" >

<div class="locate-anything-map-option-pane" id="locate-anything-map-settings-page-<?php echo md5(__("Default settings","locateandfilter"))?>">
<h1><?php esc_html_e("Default settings","locateandfilter")?></h1>
<h2><?php esc_html_e("Map Language","locateandfilter")?></h2>
<table>
<tr style="display:none;">
<td><?php esc_html_e("Purchase Code","locateandfilter");?>:</td>	<td><input type="text" style="max-width:auto" size="55" name="locate-anything-option-license-key" value="<?php echo unserialize(get_option("locate-anything-option-license-key"));?>"><br>
	<?php //esc_html_e(" &nbsp;<a  target='_blank' href='#'>Get a License Key for only $4.99!</a> (Removes the 'Powered by LocateAndFilter' label)","locateandfilter")?>
</td>
</tr>
	<tr>
<td><?php esc_html_e("GoogleMaps Key (only if you use GoogleMaps)","locateandfilter");?>:</td>	<td><input type="text" name="locate-anything-option-googlemaps-key" value="<?php echo unserialize(get_option("locate-anything-option-googlemaps-key"));?>"></td>
</tr>

<tr class="deprecated">
	<td><?php esc_html_e("BingMaps Key (only if you use BingMaps)","locateandfilter");?>:</td>	<td><input type="text" name="locate-anything-option-bingmaps-key" value="<?php echo unserialize(get_option("locate-anything-option-bingmaps-key"));?>"></td>
</tr>

<tr>
<td><?php esc_html_e("Map Language","locateandfilter");?>:</td>
<td><select name="locate-anything-option-map-language">
<?php foreach (Locate_And_Filter_Tools::getLocaleList() as $locale => $language) {?>
<option <?php if(unserialize(get_option('locate-anything-option-map-language'))==$locale) echo "selected";?> value="<?php echo  $locale;?>">
<?php echo $language ?></option>	
<?php }?>

</select>
 </td>
</tr></table>

<h2><?php esc_html_e("What do you want load JS? and add to Layers Control","locateandfilter")?></h2>
	<ul>
		<li>
<select multiple="multiple"	name="locate-anything-option-loadjs[]"	id="locate-anything-option-loadjs">
<?php

			$loadjs = array('google', 'none');

			$selected_items = unserialize (get_option ( 'locate-anything-option-loadjs' ));
			if(!is_array($selected_items)) $selected_items = array ();
			foreach ( $loadjs as $loadjs_ ) {
				echo '<option value="' . $loadjs_ . '"';
				if (array_search ( $loadjs_, $selected_items ) !== false) echo " selected ";
				echo '>' . $loadjs_ . '</option>';
			}
?>
</select>
		</li>
	</ul>


<h2><?php esc_html_e("What do you want to localize?","locateandfilter")?></h2>
	<ul>
		<li>
			<a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion' target='_blank'>USERS - available only for PRO (user version)</a>
		</li>		
		<li>
			<select multiple="multiple"	name="locate-anything-option-sources[]"	id="locate-anything-option-sources">
				<?php
							$args = array ('publicly_queryable' => true);
							$post_types = get_post_types ( $args, 'objects' );

							$selected_items = unserialize (get_option ( 'locate-anything-option-sources' ));
							if(!is_array($selected_items)) $selected_items = array ();
							foreach ( $post_types as $post_type ) {	
								if($post_type->name == "locateandfiltermap")	 continue;		
								echo '<option value="' . $post_type->name . '"';
								if (array_search ( $post_type->name, $selected_items ) !== false) echo " selected ";
								echo '>' . $post_type->labels->name . '</option>';
							}			
				?>
			</select>
		</li>
	</ul>

	<h2><?php esc_html_e("Additional Fields","locateandfilter")?></h2>
	<p><?php esc_html_e("Additional fields are useful when you need to display a specific information that will vary from marker to marker. For example, if your map is about Restaurants, you could create an additional field \"opening hours\" to store the opening hours of the place. <br/> You can add as many additional field as you want. They will appear in the marker's page.","locateandfilter")?></p>
				<div id="locate-anything-additional_fields">				
					 <?php 
					 /* gets the additional fields*/
					$additional_field_list= Locate_And_Filter_Admin::getAdditional_field_list();					

					 /* Displays a custom field box for each  type, show only selected types*/
					foreach ( $post_types as $post_type ) {?>
						<div id="addi_fields_<?php echo $post_type->name; ?>" class="additional_fields" style='display:none'>
						<h3><?php esc_html_e("Additional fields for","locateandfilter")?> : <?php echo $post_type->labels->name?></h3>
							<ul id="LA_custom_field_box_<?php echo $post_type->name?>" class="LA_custom_field_box">
									<?php 
									foreach ($additional_field_list as $field) {										
										if($field["post_type"]==$post_type->name) {?>
											<li><input type="text" data-post-type="<?php echo $field["post_type"]?>" name="<?php echo $field["field_name"]?>" id="<?php echo $field["field_name"]?>" class="locate-anything-additional-field" value="<?php echo $field["field_description"]?>"> <input type="button"  class='button-admin' value="delete" onclick="LA_removeRow('#<?php echo $field["field_name"]?>')"></li>
									<?php	}
									}?>							
							</ul>
							<input type="button" class="button-admin" onclick="LA_appendRow('#LA_custom_field_box_<?php echo $post_type->name?>','<?php echo $post_type->name?>')" value="<?php esc_html_e("Add a field","locateandfilter")?>">
							</div>
					<?php }?>					
				  <textarea style='display:none' id="locate-anything-option-additional-field-list" name="locate-anything-option-additional-field-list"><?php echo json_encode($additional_field_list)?></textarea>
				</div>
	


<h2><?php esc_html_e("Cache settings","locateandfilter")?></h2>
<ul>
<li><?php esc_html_e("Cache timeout (minutes)","locateandfilter")?> <input type="text" name="locate-anything-option-cache-timeout" value="<?php echo unserialize(get_option("locate-anything-option-cache-timeout"));?>"></li>
<li> <?php esc_html_e("Enable cache","locateandfilter")?> : <input type="radio" name="locate-anything-option-enable-cache" value="1" <?php if (unserialize(get_option("locate-anything-option-enable-cache"))==1) echo "checked";?> > <?php esc_html_e("yes","locateandfilter")?> <input type="radio" <?php if (unserialize(get_option("locate-anything-option-enable-cache"))==0) echo "checked";?> name="locate-anything-option-enable-cache" value="0" > <?php esc_html_e("no","locateandfilter")?>  </li>

</ul>

<h2><?php esc_html_e("Max Cluster Radius","locateandfilter")?></h2>
<a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion' target='_blank'>available only for PRO version</a>
<ul>
<li>
<input type="text" name="locate-anything-option-maxclusterradius" value="<?php echo unserialize(get_option("locate-anything-option-maxclusterradius"));?>">
<label><?php esc_html_e("A cluster will cover at most this many pixels from its center, default 80. Set 0 for disable","locateandfilter")?></label>
</li>
</ul>

<h2><?php esc_html_e("Load Chosen","locateandfilter")?></h2>
<ul id="display_load-chosen">

<li> <input type="radio" name="locate-anything-option-load-chosen" value="1" <?php if (unserialize(get_option("locate-anything-option-load-chosen"))==1) echo "checked";?> > <?php esc_html_e("yes","locateandfilter")?> <input type="radio" <?php if (unserialize(get_option("locate-anything-option-load-chosen"))==0) echo "checked";?> name="locate-anything-option-load-chosen" value="0" > <?php esc_html_e("no","locateandfilter")?>  </li>
<label><?php esc_html_e("Chosen is a jQuery plugin that makes long, unwieldy select boxes much more user-friendly","locateandfilter")?></label>
</ul>

<h2><?php esc_html_e("Enable fullscreen Control","locateandfilter")?></h2>
<a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion' target='_blank'>available only for PRO version</a>
<ul id="enable_fullscreenControl" class="">
<li> <input type="radio" name="locate-anything-option-enable_fullscreenControl" value="1" <?php if (unserialize(get_option("locate-anything-option-enable_fullscreenControl"))==1) echo "checked";?> > <?php esc_html_e("yes","locateandfilter")?> <input type="radio" <?php if (unserialize(get_option("locate-anything-option-enable_fullscreenControl"))==0) echo "checked";?> name="locate-anything-option-enable_fullscreenControl" value="0" > <?php esc_html_e("no","locateandfilter")?>  </li>
<label><?php esc_html_e("Add button for toggling fullscreen on and off","locateandfilter")?></label>
</ul>

</div>

<?php echo apply_filters("locate_anything_add_option_pane","")?>
<div style="text-align: right"><input type="submit" class='button-admin' value="<?php esc_html_e("Save","locateandfilter");?>"></div>
</form>