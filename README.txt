=== LocateAndFilter ===
Contributors: dgamoni
Donate link: http://locateandfilter.monothemes.com/
Tags: custom map, filter map, LocateAndFilter, search map, leaflet, directory plugin, wordpress city directory plugin, store locator, filterable map, custom post type filters, custom post type map, map layout
Requires at least: 4.5.0
Tested up to: 5.7
Stable tag: 1.4.9
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create Maps exactly the way you want using LocateAndFilter. 

== Description ==
LocateAndFilter is a versatile and highly customizable WordPress plugin aimed at creating searchable/filterable maps.

**Some of the features :**

* **Friendly** : 
LocateAndFilter has been built on the great library LeafletJs (http://leafletjs.com/) and coded with extensibility in mind : addons using LocateAndFilter in conjunction with another WP plugin. You no longer need Google API Key.  
* **Use just any taxonomy as a filter** : Easily use any taxonomy (custom taxonomies or regular taxonomies) to filter your maps.
* **Supports Custom Post Types** : Most of the WordPress plugins only support posts and pages. Not this one!Total support for any custom post type and their taxonomies!
* **Fully customizable marker icons** : You can define a custom marker icon for each location or choose to use the same marker for the whole map. It’s up to you! Choose between the plugin’s predefined marker icons, create your own markers using Ionicon or just use any image from the media library. Total flexibility!
* **Customizable Map Overlay** : Choose between 4 different map overlays… Or use any overlay you want with the Custom Overlay Addon
* **Additional fields** : Need to display a specific info on the map? Create additional fields! Additional fields are custom fields specifically designed to be displayed on the map. Let’s say your map is about coffeshops and you want to show the opening hours and the name of the nearest subway station? Create 2 additional fields : openingHours and nearestSubway. Done! Those informations are ready to be displayed in the marker list and the tooltips.
* **Fully customizable tooltips** : Customize the tooltips EXACTLY as you want them : HTML, audios, videos, images,post content… Tooltips can display nearly anything. Customize the tooltip template for each marker independently, you have total control on the information that appears…or use a tooltip preset for instant styling!
* **Fully customizable marker list** : Customize the marker list as you please : HTML, audios, videos, images,post content…
* **Ready to use** : Need a map NOW? choose a map Layout, click, you are done! Not exactly what you had in mind? No worries!Just edit the layout CSS directly in the
admin!
* **Robust** : LocateAndFilter has been tested with 10 000 markers containing images, videos and audio…and still ran smoothly
* **Responsive & Touch optimized** 

And many other features :

* Additional control layers by Bing satellite and Yandex satellite
* Detection of user’s location
* Rounded corners / Squared corners tooltips
* Map Localization :Choose your map language
* Optional cache system : ready to handle thousands of markers
* Marker Clustering, setup Max Cluster Radius
* Addons, Advanced filters, new marker icons, new map layouts
* Custom tags for map layouts
* Supports any shortcode in custom tag
* Availability shortcode for single page
* Available shortcode attribute for current category

Online Demo :
[example for projects](http://locateandfilter.monothemes.com/demo-map-default-right-down-layout/)

Documentation :
[See our website for more informations on how to configure the plugin](http://locateandfilter.monothemes.com/docs/locateandfilter-wp-plugin/)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/LocateAndFilter` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings in LocateAndFilter > Options to configure the plugin

See our website for more informations on how to configure the plugin : http://locateandfilter.monothemes.com/docs/locateandfilter-wp-plugin/

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

== Frequently Asked Questions ==

If you have any question and need help, please create topic on https://wordpress.org/support/plugin/locateandfilter/

**I installed the plugin, but I get this error. Error : Please add write permissions on the following directory**

you did not complete the installation
You need to create a folder ‘cache’ and add write permissions
on the plugin directory ‘/wp-content/plugins/locateandfilter/cache’
http://prntscr.com/t03ga1
see doc https://locateandfilter.monothemes.com/docs/locateandfilter-wp-plugin/install-plugin/

**after update plugin, map does not work**

Error : Please add write permissions on the following directory : /home1/llcigrou/public_html/wp-content/plugins/locateandfilter/cache
—-
After updating, make sure that you created the folder again
You need to create a folder ‘cache’ and add write permissions
on the following directory ‘locateandfilter.monothemes.com/wp-content/plugins/locateandfilter/cache’
see doc https://locateandfilter.monothemes.com/docs/locateandfilter-wp-plugin/install-plugin/update-plugin/

**I am install plugin and setup folder cahce, but map does not work**

You need create new topic https://wordpress.org/support/plugin/locateandfilter/
and send a detailed bug report
see How to write a good bug report?
https://locateandfilter.monothemes.com/support/how-to-write-a-good-bug-report/

**map does not work, js error**

Uncaught SyntaxError: Unexpected end of JSON input
—–
You need to create a folder ‘cache’ and add write permissions
on the following directory ‘locateandfilter.monothemes.com/wp-content/plugins/locateandfilter/cache’
see doc https://locateandfilter.monothemes.com/docs/locateandfilter-wp-plugin/install-plugin/update-plugin/

== Donations ==