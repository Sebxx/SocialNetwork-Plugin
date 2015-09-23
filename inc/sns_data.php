<?php
/**
 * 	DataBase Tables
 *
 * 	@author		@Sebxx
 * 	@category	Admin
 * 	@package	SocialNetwork Plugin
 * 	@version	0.1
 * */

global $sns_db_version;
$sns_db_version = '1.0';

/*
 * Creates tables
 */
function sns_tables_install() {
	global $wpdb;
	global $sns_db_version;
	
	/*
	 * Set tables name
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
			id_redsocial varchar(20) NOT NULL,
			nombre_redsocial(50) NOT NULL,
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
			listed int NOT NULL
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