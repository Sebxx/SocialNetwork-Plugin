<?php

/**
 *  Export options
 *
 * 	@author		@Sebxx
 * 	@category	Admin
 * 	@package	SocialNetwork Plugin
 * 	@version	0.1
 * */

/*
 * Output
 */
function sns_exportar_estadisticas() {
	?>
	<h1>Exportar informes</h1>
	<p>Seleccione en qu&eacute; formato desea exportar los informes estad&iacute;sticos de las redes sociales configuradas<br/>
		<em>Tenga en cuenta que si no configur&oacute; bien las redes sociales o lo ingresado no corresponde a los perfiles reales, no se exportar&aacute; ning&uacute;n informe.</em></p>
		<?php
		$sns_facebook = get_option('sns_facebook'); 
		$sns_twitter = get_option('sns_twitter');
		$sns_gplus = get_option('sns_gplus');
		$sns_pinterest = get_option('sns_pinterest');
		$sns_instagram = get_option('sns_instagram');
		
		if((!$sns_facebook || $sns_facebook == '') && (!$sns_twitter || $sns_twitter == '') && (!$sns_gplus || $sns_gplus == '') && (!$sns_pinterest || $sns_pinterest == '') && (!$sns_instagram || $sns_instagram == '')) {
			?>
			<h2>Usted no ha configurado ninguna red social. Por favor, <a href='?page=sns_estadisticas-redes-sociales&tab=gral_conf'>haga click aqu&iacute; y configure al menos una.</a></h2>
			<?php		
		} else {
			?>
			<div id="sns_export_buttons">
				<div id="sns_export_html" class="export_button">
					<input type="button" class="button export_html" id="sns_export_html" value="Exportar HTML">			
				</div>
				<div id="sns_export_pdf" class="export_button">
					<input type="button" class="button export_pdf" id="sns_export_pdf" value="Exportar PDF">			
				</div>
				<div id="sns_export_excel" class="export_button">
					<input type="button" class="button export_excel" id="sns_export_excel" value="Exportar Excel">			
				</div>
			</div>
			<div id="sns_response_container"></div>
			<script type="text/javascript">
				jQuery(document).ready(function () {
					jQuery('.export_html').click(function () {
						var btnValue = jQuery(this).val();
						var functionURL = '<?php echo plugins_url("redes/inc/functions.php"); ?>';
						var request = jQuery.ajax({
							type: "POST",
							url: functionURL,
							async: true,
							data: { 'export' : btnValue },
							beforeSend: function() {
								jQuery('#spinner').show();
							},
						});
						request.done(function (data) {
							jQuery('#spinner').hide();
							jQuery("#sns_response_container").html(data);
						});
					});
					jQuery('.export_pdf').click(function () {
						var btnValue = jQuery(this).val();
						var functionURL = '<?php echo plugins_url("redes/inc/functions.php"); ?>';
						var request = jQuery.ajax({
							type: "POST",
							url: functionURL,
							async: true,
							data: { 'export' : btnValue },
							beforeSend: function() {
								jQuery('#spinner').show();
							},
						});
						request.done(function (data) {
							jQuery('#spinner').hide();
							jQuery("#sns_response_container").html(data);
						});
					});
					jQuery('.export_excel').click(function () {
						var btnValue = jQuery(this).val();
						var functionURL = '<?php echo plugins_url("redes/inc/functions.php"); ?>';
						var request = jQuery.ajax({
							type: "POST",
							url: functionURL,
							async: true,
							data: { 'export' : btnValue },
							beforeSend: function() {
								jQuery('#spinner').show();
							},
						});
						request.done(function (data) {
							jQuery('#spinner').hide();
							jQuery("#sns_response_container").html(data);
						});
					});
				});
</script>
<div id="spinner">
	<img src="<?php echo plugins_url('redes/inc/ajax-loader.gif'); ?>" alt="Cargando...">	
</div>
<?php
}

}