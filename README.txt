=== LocateAndFilter ===
Contributors: dgamoni
Donate link: https://locateandfilter.com/
Tags: LocateAndFilter, search map, leaflet, filterable map, filters by taxonomy
Requires at least: 4.5.0
Tested up to: 6.8
Stable tag: 1.6.17
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create Maps exactly the way you want using LocateAndFilter. 

== Description ==
LocateAndFilter is a versatile and highly customizable WordPress plugin aimed at creating searchable/filterable maps.

**Some of the features :**

* **Friendly** : 
LocateAndFilter has been built on the great library LeafletJs (https://leafletjs.com/) and coded with extensibility in mind : addons using LocateAndFilter in conjunction with another WP plugin. You no longer need Google API Key.  
* **Use just any taxonomy as a filter** : Easily use any taxonomy (custom taxonomies or regular taxonomies) to filter your maps.
* **Supports Custom Post Types** : Most of the WordPress plugins only support posts and pages. Not this one! Total support for any custom post type and their taxonomies! Post type USERS - available on pro version.
* **Fully customizable marker icons** : You can define a custom marker icon for each location or choose to use the same marker for the whole map. It’s up to you! Choose between the plugin’s predefined marker icons, create your own markers using Ionicon or just use any image from the media library. Total flexibility!
* **Customizable Map Overlay** : Choose between 4 different map overlays… Or use any overlay you want with the Custom Overlay Addon
* **Additional fields** : Need to display a specific info on the map? Create additional fields! Additional fields are custom fields specifically designed to be displayed on the map. Let’s say your map is about coffeshops and you want to show the opening hours and the name of the nearest subway station? Create 2 additional fields : openingHours and nearestSubway. Done! Those informations are ready to be displayed in the marker list and the tooltips.
* **Fully customizable tooltips** : Customize the tooltips EXACTLY as you want them : HTML, audios, videos, images,post content… Tooltips can display nearly anything. Customize the tooltip template for each marker independently, you have total control on the information that appears…or use a tooltip preset for instant styling!
* **Fully customizable marker list** : Customize the marker list as you please : HTML, audios, videos, images,post content…
* **Ready to use** : Need a map NOW? choose a map Layout, click, you are done! Not exactly what you had in mind? No worries! Just edit the layout CSS directly in the
admin!
* ** Add your Custom tags to tooltip and navlist template: Use any functionality or shortcode
* **Robust** : LocateAndFilter has been tested with 10 000 markers containing images, videos and audio… and still ran smoothly


And many other features :

* Detection of user’s location
* Rounded corners / Squared corners tooltips
* Map Localization : Choose your map language
* Optional cache system : ready to handle thousands of markers
* Addons, Advanced filters, new marker icons, new map layouts
* Custom tags for map layouts
* Supports any shortcode in custom tag
* Geolocate address from nominatim
* Reset filters function
* Customizable select and Pretty checkbox
* Search location by google or leaflet autocomplete
* full HTML validation for all type filters

Online Demo :
[demo map - PROJECTS](https://locateandfilter.com/demo-map-default-right-down-layout/)
[demo map – ACF FILTERS](https://demo-top.locateandfilter.com/demo-map-acf-filters/)
[demo map – SEARCH LOCATION BY AUTOCOPLETE AND RADIUS](https://demo-top.locateandfilter.com/demo-map-search-location-by-google-autocoplete-and-radius/)
[demo map – USERS](https://demo-user.locateandfilter.com/)

Documentation :
[See our website for more informations on how to configure the plugin](https://locateandfilter.com/docs/locateandfilter-wp-plugin/)

Pro version:
[LocateAndFilter PRO version](https://locateandfilter.com/locateandfilter-pro-version/)

* Addon overlays
* Fullscreen control
* FitBounds option
* Zoom to marker option
* Canvas Markers - faster load more then 10000 markers
* Custom marker icon from media library   
* Sorting for filters
* Additional control layers by Bing satellite and Yandex satellite
* Marker Clustering, setup Max Cluster Radius
* Availability shortcode for single page
* Available shortcode attribute for current category
* Search markers by location
* Animation of marker bouncing
* Popup and navlist event
* ACF field on filters
* Sortby options for filters and nav list
* Wordpress Users added to map source
* use your custom fields for source coordinates

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/LocateAndFilter` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings in LocateAndFilter > Options to configure the plugin

See our website for more informations on how to configure the plugin : https://locateandfilter.com/docs/locateandfilter-wp-plugin/

== Upgrade Notice ==

== Screenshots ==

1. front view
2. admin global settings
3. map settings
4. filter settings
5. markers settings
6. tooltip settings
7. layaut settings
8. shortcodes settings
9. marker page


== Changelog ==

= 1.0 =
* First version
= 1.1.0 =
* heavily modified Addon_Helper class
* css fixes
* added hide splashscreen option
= 1.1.1 =
* added addon upgrader class
= 1.1.2 =
* added "Powered By" text
= 1.1.4 =
* added KML import function
* fixed some minor bugs
= 1.1.5 =
* added hooks
* fixed Google Places selector bug
= 1.1.6 =
* added hooks for compat addons
= 1.1.7 =
* optimized loading of styles and scripts
= 1.1.71 =
* bug fix
= 1.1.72 =
* Sometimes the preview mode was in conflict with 3rd party plugins. This update should fix that problem
= 1.1.8 =
* Added nice textarea editors
= 1.1.93 =
* Added radio button, select multiple as filters
= 1.3.00 =
* setup a new branch plugin
= 1.3.01 =
* update readme
= 1.3.02 =
* add new map layout template
= 1.3.03 =
* add a marker using the map 
= 1.3.04 =
* add custom labels for tax filter 
= 1.3.05 =
* fix height for template popup 
= 1.3.06 =
* add icon option to tax term 
= 1.3.07 =
* fix bug update options for icon term 
= 1.3.08 = 
* add mime type svg 
= 1.3.09 =
* add icon to checkbox filter 
= 1.3.10 =
* change orderby for checkbox public filter 
= 1.3.11 =
* add new option checkbox status 
= 1.3.12 =
* add excerpt to tooltip template 
= 1.3.13 =
* add new tooltip tag - lat lon dms post_id 
= 1.3.14 =
* add new options Max Cluster Radius 
= 1.3.15 =
* fix bug load public js in admin
= 1.3.16 =
* added compatibility github updater 
* add id to chekbox filter
= 1.3.17 =
* add control layers Bing and Yandex 
= 1.3.18 =
* fix editArea
= 1.3.19 =
* update readme
= 1.3.5 =
* fix js error in admin
* update templates nav-list
* added nice-tooltip style
* added pretty js and choosen css for filter
* added neww button on admin map - view from latlng
* added new map template - project
= 1.3.51 =
* update readme
= 1.3.52 =
* update readme
= 1.3.53 =
* sanitaze options value
* sanitaze post and request map_id
* update getLayoutCode
* security fix
* delete Including a zip file
* remove jquery ui
= 1.3.54 =
* security fix
* remove deprecated functions
* remove cdn script
* add alternative funct file_get_contents
= 1.3.55 =
* remove deprecated functions
= 1.3.56 =
* fix js error in admin
= 1.3.57 =
* fix HTTPS support
= 1.3.573 =
* add new shortcode for single page
* add atribute to shortcode categoryfilter
= 1.3.574 =
* fix bug
= 1.3.575 = 
* sorting filters
= 1.3.576 = 
* fix range filter
= 1.3.577 = 
* update get_terms and enable hide_emty
= 1.3.578 = 
* fix bug js sort
= 1.3.579 = 
* update ver
= 1.3.58 = 
* update ver
= 1.3.59 = 
* add short pagination style
= 1.3.6 = 
* update ver
= 1.4.0 =
* update ver
= 1.4.1 =
* fix bug separately shortcodes + pagination
= 1.4.2 =
* fix popup position, fix single shorcode
= 1.4.3 =
* add support additional overlays
= 1.4.4 =
* fix single shortcode
= 1.4.5 =
* add order filters
= 1.4.6 =
* fix deprecated fn
= 1.4.7 =
* fix popup position
= 1.4.8 =
* fix deprecated php fn
= 1.4.9 =
* added support custom style map
= 1.4.10 =
* fix jQuery loaded error
= 1.4.11 =
* fix loading js
= 1.4.12 =
* bug fix, php8 support, add many fetaures from pro version
= 1.5.00 =
* migrate to new ver leaflet-1.7.1, new type filter radio button, new geolocate from nominatim, reset for filters, tested last WP ver 5.9 
= 1.5.01 =
* rangeslider filter fixed
= 1.5.02 =
* replace google layer by GoogleMutant js, added 'hybrid' style
= 1.5.03 =
* fix load google js
= 1.5.04 =
* minor updates 
= 1.5.05 =
* update google autocomplete, add new map layout top template 
= 1.5.06 =
* update navlist by google autocomplete, bug fix
= 1.6.1 =
* fix HTML validation for all type filters
* fix multiselect (AND logic)
* move cache dir to uploads
= 1.6.11 =
* fix range, bug fix
= 1.6.12 =
* update leaflet 1.9.4
= 1.6.13 =
* update readme, update admin page
= 1.6.14 = 
* add loader to navlist
* add result found to navlist
= 1.6.15 = 
* disable svg mime_types
= 1.6.16 = 
* update code by WordPress.Security standarts
= 1.6.17 = 
* fix vulnerable to Broken Access Control

PRO
= 1.4.11.1 =
* added Pro class
= 1.4.11.3 =
* added Addon overlays
= 1.4.11.4 =
* added fullscreen control
= 1.4.11.5 =
* added fitBounds option
= 1.4.11.6 =
* added reset fn and zoom to marker
= 1.4.11.7 =
* added fullscreen option to admin
= 1.4.11.8 =
* update nav list by soom
= 1.4.11.9 =
* fix loading js and css
= 1.4.11.10 =
* migrate to new ver leaflet-1.7.1
= 1.4.11.11 =
* add plugin canvas-markers for faster load many markers
= 1.4.11.12 =
* add radio type and orderby options
= 1.4.11.13 =
* update project html template and fix js errors
= 1.4.11.14 =
* bug fix, add new geolocate
= 1.4.11.15 =
* bug fix, category filter
= 1.4.11.16 =
* bug fix, single shortcode
= 1.5.17 =
* rangeslider filter fix
= 1.5.18 =
* replace google layer by GoogleMutant js, added 'hybrid' style
= 1.5.19 =
* fix load google js
= 1.5.20 =
* add new map template top, fix php notice
= 1.5.21 =
* add custom style for mapbox
= 1.5.30 =
* update leaflet v1.8.0 
* update select2
= 1.5.40 =
* add location search options
* update google autocomplete
= 1.5.41 =
* add new shortcode for location searchbox
= 1.5.42 =
* Add new options - animation of marker bouncing
= 1.5.43 =
* Add new options - popup event
= 1.6.02 =
* Add ACF to filters
* Add new optins - sortby for nav list
* fix HTML validation for all type filters
* fix multiselect (AND logic)
* fix rangeslider (float type)
* fix addon json - load localy
= 1.6.1 =
* move cache dir to uploads
= 1.6.12 =
* update leaflet 1.9.4

ACF version
= 1.6.14.acf = 
* added support ACF number - dropdown checkbox
= 1.6.15.acf =
* fix single shortcode, add Pages to filters
= 1.7.acf = 
* add different source for coordinates
= 1.8.acf = 
* add leaflet autocomplete geosearch to map
* add new shortcode searchbylocation by autocomplete geosearch
= 1.8.1.acf = 
* add new control user geolocations and result found
* add new map template - half
= 1.8.2.acf = 
* fix map loader
* add loader to navlist
= 1.8.3.acf =
* rangeslider fix - not save val on admin, use float val, reset
= 1.8.4.acf =
* add acf date to filter - dropdown
= 1.8.5.acf =
* fix single shortcode, add support tab to admin
= 1.8.6.acf =
* acf - add repeater support to date field
= 1.8.7.acf =
* categoryfilter - multi value for tax and ACF, new option - jQuery ready or load
= 1.8.8.acf =
* add license
= 1.8.9.acf =
* fullscreen control - disable for iphone
= 1.9.0.acf =
* add new param countrycodes to geosearch-autocomplete
= 1.9.0.acf.lifetime_version =
* removed check license
= 1.9.1.acf =
* acf repeater - add support taxonomy
= 1.9.2.acf =
* addon - fix load json for localhost, project template - new css, enable show in rest for map, new tooltip template and add display filters to post_meta, geo seach - if one result, select automatically
= 1.9.3.acf =
* add new option - combine nav item by tax
= 1.9.4.acf =
* disable license
= 1.9.5.acf =
* add new option - google json style, markercluster-color
= 1.9.6.acf =
* add new option - single popup event, reset for single shortcode
= 1.9.7.acf =
* add new option - scrollNavTo
= 1.9.8.acf =
* fix multi map - nav resetbutton rangeslider
= 1.9.81.acf =
* fix save json
= 1.9.91.acf =
* fix filtering if geoseach active
= 1.9.92.acf =
* fix load google json
= 1.9.93.acf =
* reset - search locations, acf radio - value and label
= 1.9.94.acf =
* acf add support array value for checkbox
= 2.0.0.acf =
* acf add support Users
= 2.0.1.acf_cf_user =
* add support all Custom field
= 2.0.2.acf_cf_user =
* add new option - placeholder to select
= 2.0.3.acf_cf_user =
* localize_script for Translation
= 2.0.4.acf_cf_user =
* multiple_markers
= 2.0.5.acf_cf_user =
* add searchbox _by_tytle
= 2.0.6.acf_cf_user
* localize search html

== Frequently Asked Questions ==

[How Add new Custom tags](https://locateandfilter.com/docs/locateandfilter-wp-plugin/developers-guide/add-new-custom-tags/)
[How Use ACF field on map filter](https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/acf-field-on-filters/)
[How Set different source for coordinates](https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/set-different-source-for-coordinates/)
[How add Post type USERS on map source](https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/users-on-map-source/)
[How Search markers by location](https://locateandfilter.com/docs/locateandfilter-wp-plugin/pro-version/search-markers-by-location/)
[How Customize your own Map visual style](https://locateandfilter.com/locateandfilter-addon-overlays/)
[How Show markers for current category](https://locateandfilter.com/examples/categoryfilter/)
[How Use any shortcode in markers and list](https://locateandfilter.com/custom_shortcode_filed/)

If you have any question and need help, please create topic on https://wordpress.org/support/plugin/locateandfilter/

**I installed the plugin, but I get this error. Error : Please add write permissions on the following directory**

you did not complete the installation
You need to create a folder ‘cache’ and add write permissions
on the plugin directory ‘/wp-content/plugins/locateandfilter/cache’
http://prntscr.com/t03ga1
see doc https://locateandfilter.com/docs/locateandfilter-wp-plugin/install-plugin/

**after update plugin, map does not work**

Error : Please add write permissions on the following directory : /home1/---/public_html/wp-content/plugins/locateandfilter/cache
—-
After updating, make sure that you created the folder again
You need to create a folder ‘cache’ and add write permissions
on the following directory ‘locateandfilter.com/wp-content/plugins/locateandfilter/cache’
see doc https://locateandfilter.com/docs/locateandfilter-wp-plugin/install-plugin/update-plugin/

**I am install plugin and setup folder cache, but map does not work**

You need create new topic https://wordpress.org/support/plugin/locateandfilter/
and send a detailed bug report
see How to write a good bug report?
https://locateandfilter.com/support/how-to-write-a-good-bug-report/

**map does not work, js error**

Uncaught SyntaxError: Unexpected end of JSON input
—–
You need to create a folder ‘cache’ and add write permissions
on the following directory ‘locateandfilter.com/wp-content/plugins/locateandfilter/cache’
see doc https://locateandfilter.com/docs/locateandfilter-wp-plugin/install-plugin/update-plugin/

== Donations ==

[Paid Support](https://locateandfilter.com/paid-support/)
