<?php
/**
*	Settings Menu
*	@author		@Sebxx
*	@category	Admin
*	@package	SocialNetwork Plugin
*	@version	0.1
**/


/*
 * Includes
 */
include('sns_gral_conf.php');
include('sns_export_stat.php');
include('sns_create_client.php');

/*function sns_gral_conf($actual){
	$tabs = array('gral_conf' =>	'Configuraci&oacute;n General', 'export_stat' => 'Exportar informes');
	echo '<div id="icon-themes" class="icon32"><br></div>';
   echo '<h2 class="nav-tab-wrapper">';
   foreach ($tabs as $tab => $name) {
   	echo "<a class='nav-tab' href='?page=sns_estadisticas-redes-sociales&tab=$tab'>$name</a>";
   }
   echo '</h2>';
   
	if($actual && $actual != '') {
   	if((isset($_GET['tab']) && $_GET['tab'] == 'export_stat') || $actual == 'export_stat') {
    		sns_exportar_estadisticas();
    	} else {
    		sns_configuracion_general();
    	}
  }   
   
}*/

/*
 * Settings tabs
 * TODO improve
 */

function sns_conf_clien($actual) {
	$tabs = array('conf_clientes' =>	'Agregar cliente', 'ver_clientes' => 'Ver clientes');
	echo '<div id="icon-themes" class="icon32"><br></div>';
  echo '<h2 class="nav-tab-wrapper">';
  foreach ($tabs as $tab => $name) {
    echo "<a class='nav-tab' href='?page=sns_estadisticas-redes-sociales&tab=$tab'>$name</a>";
  }
  echo '</h2>';

  if($actual && $actual != '') {
    if((isset($_GET['tab']) && $_GET['tab'] == 'ver_clientes') || $actual == 'ver_clientes') {
    	//sns_ver_clientes();
    } else {
      sns_crear_cliente();
    }
  }   
}