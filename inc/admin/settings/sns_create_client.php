<?php

/**
 * 	Creates new client
 *
 * 	@author		@Sebxx
 * 	@category	Admin
 * 	@package	SocialNetwork Plugin
 * 	@version	0.1
 * */

/*
 * Output
 */
function sns_crear_cliente() {
    ?>
    <h1>Crear cliente</h1>
    <p>Cree un nuevo cliente para analizar sus redes sociales y las de su competencia. Configure aqu&iacute; el nombre y las redes. M&aacute;s tarde puede configurar, si lo desea, las redes sociales de la competencia.<br/>
    <em>Debe ingresar el nombre de usuario, ID o perfil de la cuenta a analizar.</em></p>
    <?php
    if (isset($_GET['message']) && $_GET['message'] == '1') {
        ?>
        <div id="message" class="updated below-h2">
            <p>
                Cliente creado con &eacute;xito.
            </p>
        </div><br/><br/>
        <?php
    }
    ?>
	 
    <form id="redes_crear_cliente" name="redes_crear_cliente" method="post" action="#">
        <label for="sns_nombre_cliente">Nombre del cliente</label><br/>
        <input type="text" name="sns_nombre_cliente" id="sns_nombre_cliente">
        <br/>
        <input type="checkbox" name="sns_facebook" id="sns_facebook" onclick="sns_facebook_val()"  value="true">
        <label for="sns_facebook">Facebook</label>
        <div id="sns_facebook_urls">
            <label for="sns_facebook_client_user">https://facebook.com/</label>
            <input type="text" name="sns_facebook_client_user" id="sns_facebook_client_user"><br/>
        </div>
        <script type="text/javascript">
            function sns_facebook_val() {

                if (document.getElementById("sns_facebook").checked == true) {
                    document.getElementById("sns_facebook_urls").style.display = "block";
                } else {
                    document.getElementById("sns_facebook_urls").style.display = "none";
                }

            }
            jQuery(document).ready(function() {
                if (jQuery('#sns_facebook').is(':checked'))
                    jQuery('#sns_facebook_urls').show();

            });
        </script>
        <script type="text/javascript">
        		jQuery('#sns_facebook_client_user').blur(function () {
            	if (!jQuery(this).val()) {
            		if (!jQuery('#fb_client_alert').length) {
            			if (jQuery('#fb_client_url_alert').length) {
            				jQuery('#fb_client_url_alert').remove();
            			}
            			jQuery('<span id="fb_client_alert" class="sns_alert">Este campo no puede quedar vac&iacute;o</span>').insertAfter('#sns_facebook_client_user');
            		}
            	} else {
            		if (jQuery('#fb_client_alert').length) {
            			jQuery('#fb_client_alert').remove();
            		}
            	}
            	
            });
        </script>
        <br/>
        <input type="checkbox" name="sns_twitter" id="sns_twitter" onclick="sns_twitter_val()"  value="true">
        <label for="sns_twitter">Twitter</label>
        <div id="sns_twitter_urls">
            <label for="sns_twitter_client_user">https://twitter.com/</label>
            <input type="text" name="sns_twitter_client_user" id="sns_twitter_client_user"><br/>
        </div>
        <script type="text/javascript">
            function sns_twitter_val() {

                if (document.getElementById("sns_twitter").checked == true) {
                    document.getElementById("sns_twitter_urls").style.display = "block";
                } else {
                    document.getElementById("sns_twitter_urls").style.display = "none";
                }

            }
            jQuery(document).ready(function() {
                if (jQuery('#sns_twitter').is(':checked'))
                    jQuery('#sns_twitter_urls').show();

            });
        </script>
        <script type="text/javascript">
        		jQuery('#sns_twitter_client_user').blur(function () {
            	if (!jQuery(this).val()) {
            		if (!jQuery('#tw_client_alert').length) {
            			if (jQuery('#tw_client_url_alert').length) {
            				jQuery('#tw_client_url_alert').remove();
            			}
            			jQuery('<span id="tw_client_alert" class="sns_alert">Este campo no puede quedar vac&iacute;o</span>').insertAfter('#sns_twitter_client_user');
            		}
            	} else {
            		if (jQuery('#tw_client_alert').length) {
            			jQuery('#tw_client_alert').remove();
            		}
            	}
            	
            });
        </script>
        <br/>
        <input type="checkbox" name="sns_pinterest" id="sns_pinterest" onclick="sns_pinterest_val()"  value="true">
        <label for="sns_pinterest">Pinterest</label>
        <div id="sns_pinterest_urls">
            <label for="sns_pinterest_client_user">https://pinterest.com/</label>
            <input type="text" name="sns_pinterest_client_user" id="sns_pinterest_client_user"><br/>
        </div>
        <script type="text/javascript">
            function sns_pinterest_val() {

                if (document.getElementById("sns_pinterest").checked == true) {
                    document.getElementById("sns_pinterest_urls").style.display = "block";
                } else {
                    document.getElementById("sns_pinterest_urls").style.display = "none";
                }

            }
            jQuery(document).ready(function() {
                if (jQuery('#sns_pinterest').is(':checked'))
                    jQuery('#sns_pinterest_urls').show();

            });
        </script>
        <script type="text/javascript">
        		jQuery('#sns_pinterest_client_user').blur(function () {
            	if (!jQuery(this).val()) {
            		if (!jQuery('#pt_client_alert').length) {
            			if (jQuery('#pt_client_url_alert').length) {
            				jQuery('#pt_client_url_alert').remove();
            			}
            			jQuery('<span id="pt_client_alert" class="sns_alert">Este campo no puede quedar vac&iacute;o</span>').insertAfter('#sns_pinterest_client_user');
            		}
            	} else {
            		if (jQuery('#pt_client_alert').length) {
            			jQuery('#pt_client_alert').remove();
            		}
            	}
            	
            });
        </script>
        <br/>
        <input type="checkbox" name="sns_instagram" id="sns_instagram" onclick="sns_instagram_val()"  value="true">
        <label for="sns_instagram">Instagram</label>
        <div id="sns_instagram_urls">
            <label for="sns_instagram_client_user">https://instagram.com/</label>
            <input type="text" name="sns_instagram_client_user" id="sns_instagram_client_user"><br/>
        </div>
        <script type="text/javascript">
            function sns_instagram_val() {

                if (document.getElementById("sns_instagram").checked == true) {
                    document.getElementById("sns_instagram_urls").style.display = "block";
                } else {
                    document.getElementById("sns_instagram_urls").style.display = "none";
                }

            }
            jQuery(document).ready(function() {
                if (jQuery('#sns_instagram').is(':checked'))
                    jQuery('#sns_instagram_urls').show();

            });
        </script>
        <script type="text/javascript">
        		jQuery('#sns_instagram_client_user').blur(function () {
            	if (!jQuery(this).val()) {
            		if (!jQuery('#ins_client_alert').length) {
            			if (jQuery('#ins_client_url_alert').length) {
            				jQuery('#ins_client_url_alert').remove();
            			}
            			jQuery('<span id="ins_client_alert" class="sns_alert">Este campo no puede quedar vac&iacute;o</span>').insertAfter('#sns_instagram_client_user');
            		}
            	} else {
            		if (jQuery('#ins_client_alert').length) {
            			jQuery('#ins_client_alert').remove();
            		}
            	}
            	
            });
        </script>
        <br/>
        <br/>
        <input class="button" type="button" id="sns_enviar" name="sns_enviar" value="Guardar cambios">
        <input type="hidden" id="sns_validador" name="sns_validador" value="false">
    </form>
    <script type="text/javascript">
    	var validated = true;
		jQuery("#sns_enviar").click(function () {
			if (jQuery("#sns_facebook").is(':checked')) {
				if (!jQuery("#sns_facebook_client_user").val()) {
					validated = false;
				} else {
					validated = true;
				}
			}
			
			if (jQuery("#sns_twitter").is(':checked')) {
				if (!jQuery("#sns_twitter_client_user").val()) {
					validated = false;
				} else {
					validated = true;
				}
			}
			
			if (jQuery("#sns_pinterest").is(':checked')) {
				if (!jQuery("#sns_pinterest_client_user").val()) {
					validated = false;
				}  else {
					validated = true;
				}
			}
			
			if (jQuery("#sns_instagram").is(':checked')) {
				if (!jQuery("#sns_instagram_client_user").val()) {
					validated = false;
				} else {
					validated = true;
				}
			}
			
			if (!validated) {
				if (!jQuery('#form_alert').length) {
            	jQuery('<span id="form_alert" class="sns_alert">&nbsp;&nbsp;Hay campos obligatorios sin llenar o con datos inv&aacute;lidos</span>').insertAfter('#sns_enviar');
            }
			} else {
				if (jQuery('#form_alert').length) {
            	jQuery('#form_alert').remove();
            }
            jQuery("#sns_validador").val("true");
            jQuery("#redes_crear_cliente").submit();
			}
		});
    </script>
    <?php
}

/*
 * Saves data
 * TODO
 */ 
/*
if (isset($_POST['sns_validador']) && $_POST['sns_validador'] == "true") {
    if (isset($_POST['sns_facebook']) && $_POST['sns_facebook'] != '') {
        update_option('sns_facebook', 'true');
        update_option('sns_facebook_client_url', $_POST['sns_facebook_client_url']);
        update_option('sns_facebook_comp_url', $_POST['sns_facebook_comp_url']);
    } else {
        update_option('sns_facebook', '');
        update_option('sns_facebook_client_url', '');
        update_option('sns_facebook_comp_url', '');
    }
    if (isset($_POST['sns_twitter']) && $_POST['sns_twitter'] != '') {
        update_option('sns_twitter', 'true');
        update_option('sns_twitter_client_url', $_POST['sns_twitter_client_url']);
        update_option('sns_twitter_comp_url', $_POST['sns_twitter_comp_url']);
    } else {
        update_option('sns_twitter', '');
        update_option('sns_twitter_client_url', '');
        update_option('sns_twitter_comp_url', '');
    }
    if (isset($_POST['sns_pinterest']) && $_POST['sns_pinterest'] != '') {
        update_option('sns_pinterest', 'true');
        update_option('sns_pinterest_client_url', $_POST['sns_pinterest_client_url']);
        update_option('sns_pinterest_comp_url', $_POST['sns_pinterest_comp_url']);
    } else {
        update_option('sns_pinterest', '');
        update_option('sns_pinterest_client_url', '');
        update_option('sns_pinterest_comp_url', '');
    }
    if (isset($_POST['sns_instagram']) && $_POST['sns_instagram'] != '') {
        update_option('sns_instagram', 'true');
        update_option('sns_instagram_client_url', $_POST['sns_instagram_client_url']);
        update_option('sns_instagram_comp_url', $_POST['sns_instagram_comp_url']);
    } else {
        update_option('sns_instagram', '');
        update_option('sns_instagram_client_url', '');
        update_option('sns_instagram_comp_url', '');
    }
    echo "<script> window.location.href='admin.php?page=sns_estadisticas-redes-sociales&tab=gral_conf&message=1'; </script>";
}
*/