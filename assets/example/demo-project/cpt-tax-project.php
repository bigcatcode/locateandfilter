<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cptui_register_my_cpts() {

	/**
	 * Post Type: Project.
	 */

	$labels = array(
		"name" => __( "Project", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
		"taxonomies" => array( "project_expertises", "project_areas" ),
	);

	register_post_type( "project", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_my_cpts_project() {

	/**
	 * Post Type: Project.
	 */

	$labels = array(
		"name" => __( "Project", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
		"taxonomies" => array( "project_expertises", "project_areas" ),
	);

	register_post_type( "project", $args );
}

add_action( 'init', 'cptui_register_my_cpts_project' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Expertises.
	 */

	$labels = array(
		"name" => __( "Expertises", "wp-bootstrap-starter" ),
		"singular_name" => __( "Expertises", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Expertises", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_expertises', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_expertises",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_expertises", array( "project" ), $args );

	/**
	 * Taxonomy: Werkvelden.
	 */

	$labels = array(
		"name" => __( "Werkvelden", "wp-bootstrap-starter" ),
		"singular_name" => __( "Werkvelden", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Werkvelden", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_areas', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_areas",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_areas", array( "project" ), $args );

	/**
	 * Taxonomy: Project date start.
	 */

	$labels = array(
		"name" => __( "Project date start", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project date start", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project date start", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_date_start', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_date_start",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_date_start", array( "project" ), $args );

	/**
	 * Taxonomy: Project date finish.
	 */

	$labels = array(
		"name" => __( "Project date finish", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project date finish", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project date finish", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_date_finish', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_date_finish",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_date_finish", array( "project" ), $args );

	/**
	 * Taxonomy: Project locatie.
	 */

	$labels = array(
		"name" => __( "Project locatie", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project locatie", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project locatie", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_locatie', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_locatie",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_locatie", array( "project" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes' );


function cptui_register_my_taxes_project_expertises() {

	/**
	 * Taxonomy: Expertises.
	 */

	$labels = array(
		"name" => __( "Expertises", "wp-bootstrap-starter" ),
		"singular_name" => __( "Expertises", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Expertises", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_expertises', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_expertises",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_expertises", array( "project" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes_project_expertises' );


function cptui_register_my_taxes_project_areas() {

	/**
	 * Taxonomy: Werkvelden.
	 */

	$labels = array(
		"name" => __( "Werkvelden", "wp-bootstrap-starter" ),
		"singular_name" => __( "Werkvelden", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Werkvelden", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_areas', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_areas",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_areas", array( "project" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes_project_areas' );

function cptui_register_my_taxes_project_date_start() {

	/**
	 * Taxonomy: Project date start.
	 */

	$labels = array(
		"name" => __( "Project date start", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project date start", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project date start", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_date_start', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_date_start",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_date_start", array( "project" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes_project_date_start' );


function cptui_register_my_taxes_project_date_finish() {

	/**
	 * Taxonomy: Project date finish.
	 */

	$labels = array(
		"name" => __( "Project date finish", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project date finish", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project date finish", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_date_finish', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_date_finish",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_date_finish", array( "project" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes_project_date_finish' );

function cptui_register_my_taxes_project_locatie() {

	/**
	 * Taxonomy: Project locatie.
	 */

	$labels = array(
		"name" => __( "Project locatie", "wp-bootstrap-starter" ),
		"singular_name" => __( "Project locatie", "wp-bootstrap-starter" ),
	);

	$args = array(
		"label" => __( "Project locatie", "wp-bootstrap-starter" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_locatie', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "project_locatie",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "project_locatie", array( "project" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes_project_locatie' );
