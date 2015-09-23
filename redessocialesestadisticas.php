<?php
/*
Plugin Name:	Estadísticas Redes Sociales
Plugin URI:		http://github.com/Sebxx/SocialNetwork
Description:	Una herramienta para medir el desempeño de tus redes sociales y compararlas con la competencia
Version:		0.1
Author:			Sebastián Pulgarín Yepes @Sebxx
Author URI:		https://www.github.com/Sebxx
License:		GPL2
*/


/*
 * includes
 */
include('inc/admin/settings/sns_config-menu.php');
//include('inc/sns_data.php');

/*
 * Enqueue styles & scripts
 */
add_action('admin_print_styles', 'sns_admin_styles');
function sns_admin_styles() {
	wp_register_style('sns_styles', plugins_url('redes/inc/style.css'));
	wp_enqueue_style('sns_styles');
}

add_action( 'admin_enqueue_scripts', 'sns_admin_script' );
function sns_admin_script() {
	wp_register_script('sns_chart', plugins_url('redes/inc/Chart.js-master/Chart.js'));
	wp_register_script('sns_excanvas', plugins_url('redes/inc/excanvas.js'));
	wp_enqueue_script('sns_chart');
	wp_enqueue_script('sns_excanvas');
} 

/*
 * Settings menu
 */
add_action('admin_menu', 'sns_menu_redes');

function sns_menu_redes() {
	add_menu_page(__('Agregar cliente', 'Agregar cliente'), __('Agregar cliente', 'Agregar cliente'), 'manage_options', 'sns_estadisticas-redes-sociales', function() { sns_conf_clien('conf_clientes'); }, '', '8' );
	//add_submenu_page('sns_estadisticas-redes-sociales', __('Agregar cliente', 'Agregar cliente'), __('Agregar cliente', 'Agregar cliente'), 'manage_options', 'sns_crear_cliente', function () { sns_conf_clien('conf_clientes'); });
	add_submenu_page('sns_estadisticas-redes-sociales', __('Ver clientes', 'Ver clientes'), __('Ver clientes', 'Ver clientes'), 'manage_options', 'sns_ver_clientes', function () { sns_conf_clien('ver_clientes'); });
}

/*
 * DB Tables
 * TODO: DB tables in another include file
 */
function sns_tables_install() {
	global $wpdb;
	global $sns_db_version;
	
	/*
	 * Tables names
	 */
	$sns_clientes = $wpdb->prefix . 'sns_clientes';
	$sns_redes = $wpdb->prefix . 'sns_redes';
	$sns_redes_cliente = $wpdb->prefix . 'sns_redes_cliente';
	$sns_estadisticas = $wpdb->prefix . 'sns_estadisticas';
	$sns_est_fb = $wpdb->prefix . 'sns_est_fb';
	$sns_est_tw = $wpdb->prefix . 'sns_est_tw';
	$sns_est_pt = $wpdb->prefix . 'sns_est_pt';
	$sns_est_ins = $wpdb->prefix . 'sns_est_ins';
	
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE $sns_clientes (
			id_cliente mediumint(9) NOT NULL AUTO_INCREMENT,
			nombre_cliente varchar(50) NOT NULL,
			UNIQUE KEY id_cliente (id_cliente)			
			) $charset_collate; 
			CREATE TABLE $sns_redes (
			id_redsocial varchar(2) NOT NULL,
			nombre_redsocial varchar(50) NOT NULL,
			UNIQUE KEY id_redsocial (id_redsocial)			
			) $charset_collate; 
			CREATE TABLE $sns_redes_cliente (
			id_red mediumint(9) NOT NULL AUTO_INCREMENT,
			id_cliente mediumint(9) NOT NULL,
			id_redsocial varchar(20) NOT NULL,
			username varchar(50) NOT NULL,
			nombre_profile varchar(50) NULL,
			is_competencia bit(1) NOT NULL,
			UNIQUE KEY id_red (id_red)			
			) $charset_collate; 
			CREATE TABLE $sns_estadisticas (
			id_estadisticas mediumint(9) NOT NULL AUTO_INCREMENT,
			id_red mediumint(9) NOT NULL,
			fecha date NOT NULL,
			UNIQUE KEY id_estadisticas (id_estadisticas)			
			) $charset_collate; 
			CREATE TABLE $sns_est_fb (
			id_est_fb mediumint(9) NOT NULL AUTO_INCREMENT,
			id_estadistica mediumint(9) NOT NULL,
			likes int NOT NULL,
			talking int NOT NULL,
			UNIQUE KEY id_est_fb (id_est_fb)			
			) $charset_collate; 
			CREATE TABLE $sns_est_tw (
			id_est_tw mediumint(9) NOT NULL AUTO_INCREMENT,
			id_estadistica mediumint(9) NOT NULL,
			followers int NOT NULL,
			following int NOT NULL,
			tweets int NOT NULL,
			fav int NOT NULL,
			listed int NOT NULL,
			UNIQUE KEY id_est_tw (id_est_tw)			
			) $charset_collate; 
			CREATE TABLE $sns_est_pt (
			id_est_pt mediumint(9) NOT NULL AUTO_INCREMENT,
			id_estadistica mediumint(9) NOT NULL,
			followers int NOT NULL,
			following int NOT NULL,
			boards int NOT NULL,
			pins int NOT NULL,
			UNIQUE KEY id_est_pt (id_est_pt)			
			) $charset_collate; 
			CREATE TABLE $sns_est_ins (
			id_est_ins mediumint(9) NOT NULL AUTO_INCREMENT,
			id_estadistica mediumint(9) NOT NULL,
			pics int NOT NULL,
			followers int NOT NULL,
			following int NOT NULL,
			UNIQUE KEY id_est_ins (id_est_ins)			
			) $charset_collate; ";
			
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			add_option('sns_db_version', $sns_db_version);
}
register_activation_hook(__FILE__, 'sns_tables_install');