<?php
/**
 * 	Export functions
 *
 * 	@author		@Sebxx
 * 	@category	Admin
 * 	@package	SocialNetwork Plugin
 * 	@version	0.1
 * */

/*
 * Native WordPress functiones include
 */ 
function find_wp_config_path() {
	$dir = dirname(__FILE__);
	do {
		if (file_exists($dir . "/wp-config.php")) {
			return $dir;
		}
	} while ($dir = realpath("$dir/.."));
	return null;
}

if (!function_exists('add_action')) {
	include_once( find_wp_config_path() . '/wp-load.php' );
}

/*
 * Deny direct access
 */
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	wp_safe_redirect(home_url('/'));
}

/*
 * Gets export option
 */
if(isset($_POST['export'])) {
	$export = str_replace("Exportar ", "", $_POST['export']);
	switch($export) {
		case 'HTML':
		sns_html_function();
		break;
		case 'PDF':
		sns_pdf_function();
		break;
		case 'Excel':
		sns_excel_function();
		break;
	}
}

/*
 * Exports HTML
 */
function sns_html_function(){
	
	$fb = get_option('sns_facebook');
	$tw = get_option('sns_twitter');
	$pt = get_option('sns_pinterest');
	$in = get_option('sns_instagram');
	
	if(isset($fb) && $fb == 'true') { 
		$fb_info = sns_facebook_data(); ?>
		<div id="sns_red">
			<h1>Facebook</h1>
			<?php if($fb_info != false) { ?>
			<div id="sns_red_in">
				<h3>Mi p&aacute;gina: <small><?php echo $fb_info['client_name']; ?></small></h3>
				<strong>Likes: </strong><?php echo $fb_info['client_likes']; ?><br>
				<strong>Personas hablando de esto: </strong><?php echo $fb_info['client_talk']; ?><br>
			</div>
			<div id="sns_red_in">
				<h3>P&aacute;gina competencia: <small><?php echo $fb_info['comp_name']; ?></small></h3>
				<strong>Likes: </strong><?php echo $fb_info['comp_likes']; ?><br>
				<strong>Personas hablando de esto: </strong><?php echo $fb_info['comp_talk']; ?>
			</div>
			<div id="sns_red_in">
				<canvas id="chart_likes" width="200" height="200"></canvas>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						var ctx_likes_fb = jQuery("#chart_likes").get(0).getContext("2d");
						var data = [
						{
							value: <?php echo $fb_info['client_likes']; ?>,
							color: "#F7464A",
							highlight: "#FF5A5E",
							label: "<?php echo $fb_info['client_name']; ?>"	 
						},
						{
							value: <?php echo $fb_info['comp_likes']; ?>,
							color: "#46BFBD",
							highlight: "#5AD3D1",
							label: "<?php echo $fb_info['comp_name']; ?>"
						}
						];
						var chart_likes_fb = new Chart(ctx_likes_fb).Pie(data);
					});
				</script>
				<h3 align="center">Likes</h3>
			</div>
			<div id="sns_red_in">
				<canvas id="chart_talking" width="200" height="200"></canvas>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						var ctx_talking_fb = jQuery("#chart_talking").get(0).getContext("2d");
						var data = [
						{
							value: <?php echo $fb_info['client_talk']; ?>,
							color: "#F7464A",
							highlight: "#FF5A5E",
							label: "<?php echo $fb_info['client_name']; ?>"	 
						},
						{
							value: <?php echo $fb_info['comp_talk']; ?>,
							color: "#46BFBD",
							highlight: "#5AD3D1",
							label: "<?php echo $fb_info['comp_name']; ?>"
						}
						];
						var chart_talking_fb = new Chart(ctx_talking_fb).Pie(data);
					});
				</script>
				<h3 align="center">Personas hablando de esto</h3>
			</div>
			<?php } else { ?>
			<h3>Los datos ingresados de una o varias cuentas no corresponden a un perfil real o no se ha podido establecer conexi&oacute;n</h3>
			<?php } ?>
		</div>
		<?php } ?>
		
		<?php if(isset($tw) && $tw == 'true') { 
			$tw_info = sns_twitter_data(); ?>
			<div id="sns_red">
				<h1>Twitter</h1>
				<?php if($tw_info != false) { ?>
				<div id="sns_red_in">
					<h3>Mi Twitter: <small><?php echo $tw_info['name_client'] . ' (@' . $tw_info['user_client'] . ')'; ?></small></h3>
					<strong>Seguidores: </strong><?php echo $tw_info['followers_client']; ?><br>
					<strong>Siguiendo: </strong><?php echo $tw_info['following_client']; ?><br>
					<strong>Tweets: </strong><?php echo $tw_info['tweets_client']; ?><br>
					<strong>Favoritos: </strong><?php echo $tw_info['favourites_client']; ?><br>
					<strong>En listas: </strong><?php echo $tw_info['listed_client']; ?><br>
				</div>
				<div id="sns_red_in">
					<h3>Twitter competencia: <small><?php echo $tw_info['name_comp'] . ' (@' . $tw_info['user_comp'] . ')'; ?></small></h3>
					<strong>Seguidores: </strong><?php echo $tw_info['followers_comp']; ?><br>
					<strong>Siguiendo: </strong><?php echo $tw_info['following_comp']; ?><br>
					<strong>Tweets: </strong><?php echo $tw_info['tweets_comp']; ?><br>
					<strong>Favoritos: </strong><?php echo $tw_info['favourites_comp']; ?><br>
					<strong>En listas: </strong><?php echo $tw_info['listed_comp']; ?><br>
				</div>
				<div id="sns_red_in">
					<canvas id="chart_tw_followers" width="200" height="200"></canvas>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							var ctx_followers_tw = jQuery("#chart_tw_followers").get(0).getContext("2d");
							var data = [
							{
								value: <?php echo $tw_info['followers_client']; ?>,
								color: "#F7464A",
								highlight: "#FF5A5E",
								label: "<?php echo $tw_info['name_client']; ?>"	 
							},
							{
								value: <?php echo $tw_info['followers_comp']; ?>,
								color: "#46BFBD",
								highlight: "#5AD3D1",
								label: "<?php echo $tw_info['name_comp']; ?>"
							}
							];
							var chart_followers_tw = new Chart(ctx_followers_tw).Pie(data);
						});
					</script>
					<h3 align="center">Seguidores</h3>
				</div>
				<div id="sns_red_in">
					<canvas id="chart_following_tw" width="200" height="200"></canvas>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							var ctx_following_tw = jQuery("#chart_following_tw").get(0).getContext("2d");
							var data = [
							{
								value: <?php echo $tw_info['following_client']; ?>,
								color: "#F7464A",
								highlight: "#FF5A5E",
								label: "<?php echo $tw_info['name_client']; ?>"	 
							},
							{
								value: <?php echo $tw_info['following_comp']; ?>,
								color: "#46BFBD",
								highlight: "#5AD3D1",
								label: "<?php echo $tw_info['name_comp']; ?>"
							}
							];
							var chart_following_tw = new Chart(ctx_following_tw).Pie(data);
						});
					</script>
					<h3 align="center">Siguiendo</h3>
				</div>
				<div id="sns_red_in">
					<canvas id="chart_tweets" width="200" height="200"></canvas>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							var ctx_tweets = jQuery("#chart_tweets").get(0).getContext("2d");
							var data = [
							{
								value: <?php echo $tw_info['tweets_client']; ?>,
								color: "#F7464A",
								highlight: "#FF5A5E",
								label: "<?php echo $tw_info['name_client']; ?>"	 
							},
							{
								value: <?php echo $tw_info['tweets_comp']; ?>,
								color: "#46BFBD",
								highlight: "#5AD3D1",
								label: "<?php echo $tw_info['name_comp']; ?>"
							}
							];
							var chart_tweets = new Chart(ctx_tweets).Pie(data);
						});
					</script>
					<h3 align="center">Tweets</h3>
				</div>
				<div id="sns_red_in">
					<canvas id="chart_tw_fav" width="200" height="200"></canvas>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							var ctx_fav_tw = jQuery("#chart_tw_fav").get(0).getContext("2d");
							var data = [
							{
								value: <?php echo $tw_info['favourites_client']; ?>,
								color: "#F7464A",
								highlight: "#FF5A5E",
								label: "<?php echo $tw_info['name_client']; ?>"	 
							},
							{
								value: <?php echo $tw_info['favourites_comp']; ?>,
								color: "#46BFBD",
								highlight: "#5AD3D1",
								label: "<?php echo $tw_info['name_comp']; ?>"
							}
							];
							var chart_tw_fav = new Chart(ctx_fav_tw).Pie(data);
						});
					</script>
					<h3 align="center">Favoritos</h3>
				</div>
				<div id="sns_red_in">
					<canvas id="chart_tw_listed" width="200" height="200"></canvas>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							var ctx_tw_listed = jQuery("#chart_tw_listed").get(0).getContext("2d");
							var data = [
							{
								value: <?php echo $tw_info['listed_client']; ?>,
								color: "#F7464A",
								highlight: "#FF5A5E",
								label: "<?php echo $tw_info['name_client']; ?>"	 
							},
							{
								value: <?php echo $tw_info['listed_comp']; ?>,
								color: "#46BFBD",
								highlight: "#5AD3D1",
								label: "<?php echo $tw_info['name_comp']; ?>"
							}
							];
							var chart_tw_listed = new Chart(ctx_tw_listed).Pie(data);
						});
					</script>
					<h3 align="center">En listas</h3>
				</div>
				<?php } else { ?>
				<h3>Los datos ingresados de una o varias cuentas no corresponden a un perfil real o no se ha podido establecer conexi&oacute;n</h3>
				<?php } ?>
			</div>
			<?php } ?>
			
			<?php if(isset($pt) && $pt == 'true') { 
				$pt_info = sns_pinterest_data(); ?>
				<div id="sns_red">
					<h1>Pinterest</h1>
					<?php if($pt_info != false) { ?>
					<div id="sns_red_in">
						<h3>Mi Pinterest: <small><?php echo $pt_info['name_client']; ?></small></h3>
						<strong>Seguidores: </strong><?php echo $pt_info['followers_client']; ?><br>
						<strong>Siguiendo: </strong><?php echo $pt_info['following_client']; ?><br>
						<strong>Boards: </strong><?php echo $pt_info['boards_client']; ?><br>
						<strong>Pins: </strong><?php echo $pt_info['pins_client']; ?><br>
					</div>
					<div id="sns_red_in">
						<h3>Pinterest competencia: <small><?php echo $pt_info['name_comp']; ?></small></h3>
						<strong>Seguidores: </strong><?php echo $pt_info['followers_comp']; ?><br>
						<strong>Siguiendo: </strong><?php echo $pt_info['following_comp']; ?><br>
						<strong>Boards: </strong><?php echo $pt_info['boards_comp']; ?><br>
						<strong>Pins: </strong><?php echo $pt_info['pins_comp']; ?><br>
					</div>
					<div id="sns_red_in">
						<canvas id="chart_followers_pt" width="200" height="200"></canvas>
						<script type="text/javascript">
							jQuery(document).ready(function() {
								var ctx_followers_pt = jQuery("#chart_followers_pt").get(0).getContext("2d");
								var data = [
								{
									value: <?php echo $pt_info['followers_client']; ?>,
									color: "#F7464A",
									highlight: "#FF5A5E",
									label: "<?php echo $pt_info['name_client']; ?>"	 
								},
								{
									value: <?php echo $pt_info['followers_comp']; ?>,
									color: "#46BFBD",
									highlight: "#5AD3D1",
									label: "<?php echo $pt_info['comp_name']; ?>"
								}
								];
								var chart_followers_pt = new Chart(ctx_followers_pt).Pie(data);
							});
						</script>
						<h3 align="center">Seguidores</h3>
					</div>
					<div id="sns_red_in">
						<canvas id="chart_following_pt" width="200" height="200"></canvas>
						<script type="text/javascript">
							jQuery(document).ready(function() {
								var ctx_following_pt = jQuery("#chart_following_pt").get(0).getContext("2d");
								var data = [
								{
									value: <?php echo $pt_info['following_client']; ?>,
									color: "#F7464A",
									highlight: "#FF5A5E",
									label: "<?php echo $pt_info['name_client']; ?>"	 
								},
								{
									value: <?php echo $pt_info['following_comp']; ?>,
									color: "#46BFBD",
									highlight: "#5AD3D1",
									label: "<?php echo $pt_info['name_comp']; ?>"
								}
								];
								var chart_following_pt = new Chart(ctx_following_pt).Pie(data);
							});
						</script>
						<h3 align="center">Siguiendo</h3>
					</div>
					<div id="sns_red_in">
						<canvas id="chart_boards" width="200" height="200"></canvas>
						<script type="text/javascript">
							jQuery(document).ready(function() {
								var ctx_board = jQuery("#chart_boards").get(0).getContext("2d");
								var data = [
								{
									value: <?php echo $pt_info['boards_client']; ?>,
									color: "#F7464A",
									highlight: "#FF5A5E",
									label: "<?php echo $pt_info['name_client']; ?>"	 
								},
								{
									value: <?php echo $pt_info['boards_comp']; ?>,
									color: "#46BFBD",
									highlight: "#5AD3D1",
									label: "<?php echo $pt_info['name_comp']; ?>"
								}
								];
								var chart_boards = new Chart(ctx_board).Pie(data);
							});
						</script>
						<h3 align="center">Boards</h3>
					</div>
					<div id="sns_red_in">
						<canvas id="chart_pins" width="200" height="200"></canvas>
						<script type="text/javascript">
							jQuery(document).ready(function() {
								var ctx_pins = jQuery("#chart_pins").get(0).getContext("2d");
								var data = [
								{
									value: <?php echo $pt_info['pins_client']; ?>,
									color: "#F7464A",
									highlight: "#FF5A5E",
									label: "<?php echo $pt_info['name_client']; ?>"	 
								},
								{
									value: <?php echo $pt_info['pins_comp']; ?>,
									color: "#46BFBD",
									highlight: "#5AD3D1",
									label: "<?php echo $pt_info['name_comp']; ?>"
								}
								];
								var chart_pins = new Chart(ctx_pins).Pie(data);
							});
						</script>
						<h3 align="center">Pins</h3>
					</div>
					<?php } else { ?>
					<h3>Los datos ingresados de una o varias cuentas no corresponden a un perfil real o no se ha podido establecer conexi&oacute;n</h3>
					<?php } ?>
				</div>
				<?php } ?>
				
				<?php if(isset($in) && $in == 'true') { 
					$in_info = sns_instagram_data(); ?>
					<div id="sns_red">
						<h1>Instagram</h1>
						<?php if($in_info != false) { ?>
						<div id="sns_red_in">
							<h3>Mi Instagram: <small><?php echo $in_info['name_client']; ?></small></h3>
							<strong>Fotos: </strong><?php echo $in_info['pics_client']; ?><br>
							<strong>Seguidores: </strong><?php echo $in_info['followers_client']; ?><br>
							<strong>Siguiendo: </strong><?php echo $in_info['follows_client']; ?><br>		
						</div>
						<div id="sns_red_in">
							<h3>Instagram competencia: <small><?php echo $in_info['name_comp']; ?></small></h3>
							<strong>Fotos: </strong><?php echo $in_info['pics_comp']; ?><br>
							<strong>Seguidores: </strong><?php echo $in_info['followers_comp']; ?><br>
							<strong>Siguiendo: </strong><?php echo $in_info['follows_comp']; ?><br>		
						</div>
						<div id="sns_red_in">
							<canvas id="chart_in_pics" width="200" height="200"></canvas>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									var ctx_in_pics = jQuery("#chart_in_pics").get(0).getContext("2d");
									var data = [
									{
										value: <?php echo $in_info['pics_client']; ?>,
										color: "#F7464A",
										highlight: "#FF5A5E",
										label: "<?php echo $in_info['name_client']; ?>"	 
									},
									{
										value: <?php echo $in_info['pics_comp']; ?>,
										color: "#46BFBD",
										highlight: "#5AD3D1",
										label: "<?php echo $in_info['name_comp']; ?>"
									}
									];
									var chart_in_pics = new Chart(ctx_in_pics).Pie(data);
								});
							</script>
							<h3 align="center">Fotos</h3>
						</div>
						<div id="sns_red_in">
							<canvas id="chart_in_followers" width="200" height="200"></canvas>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									var ctx_in_followers = jQuery("#chart_in_followers").get(0).getContext("2d");
									var data = [
									{
										value: <?php echo $in_info['followers_client']; ?>,
										color: "#F7464A",
										highlight: "#FF5A5E",
										label: "<?php echo $in_info['name_client']; ?>"	 
									},
									{
										value: <?php echo $in_info['followers_comp']; ?>,
										color: "#46BFBD",
										highlight: "#5AD3D1",
										label: "<?php echo $in_info['name_comp']; ?>"
									}
									];
									var chart_in_followers = new Chart(ctx_in_followers).Pie(data);
								});
							</script>
							<h3 align="center">Seguidores</h3>
						</div>
						<div id="sns_red_in">
							<canvas id="chart_in_following" width="200" height="200"></canvas>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									var ctx_in_following = jQuery("#chart_in_following").get(0).getContext("2d");
									var data = [
									{
										value: <?php echo $in_info['follows_client']; ?>,
										color: "#F7464A",
										highlight: "#FF5A5E",
										label: "<?php echo $in_info['name_client']; ?>"	 
									},
									{
										value: <?php echo $in_info['follows_comp']; ?>,
										color: "#46BFBD",
										highlight: "#5AD3D1",
										label: "<?php echo $in_info['name_comp']; ?>"
									}
									];
									var chart_in_following = new Chart(ctx_in_following).Pie(data);
								});
							</script>
							<h3 align="center">Siguiendo</h3>
						</div>
						<?php } else { ?>
						<h3>Los datos ingresados de una o varias cuentas no corresponden a un perfil real o no se ha podido establecer conexi&oacute;n</h3>
						<?php } ?>
					</div>
					<?php }
					exit;
				}

/*
 * TODO exports PDF
 */
function sns_pdf_function(){
	exit;
}

/*
 * TODO exports Excel
 */
function sns_excel_function(){
	echo "Le pegó al Excel";
	exit;
}

/*
 * Manage Facebook's info
 */
function sns_facebook_data() {
	$url_client = get_option('sns_facebook_client_url');
	$url_client = 'https://graph.facebook.com/' . $url_client;	
	$curl_client = curl_init();
	curl_setopt($curl_client, CURLOPT_URL, $url_client);
	curl_setopt($curl_client, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_client, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl_client, CURLOPT_SSL_VERIFYPEER, false);
	$auth_client = curl_exec($curl_client);
	if($auth_client) {
		$data_client = json_decode($auth_client);
	}
	
	$url_comp = get_option('sns_facebook_comp_url');
	$url_comp = 'https://graph.facebook.com/' . $url_comp;
	$curl_comp = curl_init();
	curl_setopt($curl_comp, CURLOPT_URL, $url_comp);
	curl_setopt($curl_comp, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_comp, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl_comp, CURLOPT_SSL_VERIFYPEER, false);
	$auth_comp = curl_exec($curl_comp);
	if($auth_comp) {
		$data_comp = json_decode($auth_comp);
	}	
	
	if((!isset($data_client) || !$data_client || is_null($data_client)) || (!isset($data_comp) || !$data_comp || is_null($data_comp)))
		return false;
	
	if((!isset($data_client->{ 'likes' }) || $data_client->{ 'likes' } == '') || (!isset($data_comp->{ 'likes' }) || $data_comp->{ 'likes' } == ''))
		return false;
	
	$return = array(
		'client_name'	=>	$data_client->{ 'name' },
		'client_likes'	=>	$data_client->{ 'likes' },
		'client_talk'	=>	$data_client->{ 'talking_about_count' },
		'comp_name'		=>	$data_comp->{ 'name' },
		'comp_likes'	=>	$data_comp->{ 'likes' },
		'comp_talk'		=>	$data_comp->{ 'talking_about_count' },
		);
	
	return $return;

}

/*
 * Manage Twitter's info
 */
function sns_twitter_data() {
	require_once('twitter/TwitterAPIExchange.php');
	
	$url_client = get_option('sns_twitter_client_url');
	
	$url_comp = get_option('sns_twitter_comp_url');
	
	$settings = array(
		'oauth_access_token' => "390474976-lLFKfuzgTQ3TYCqvE6bScacZisOvszlH8zppI1ju",
		'oauth_access_token_secret' => "y7WXXnp03RY09iUrbprqZIiQJjEmav8mer7YWlKwft7LT",
		'consumer_key' => "YQNjA75h1IQpZzM3kzvKK84OH",
		'consumer_secret' => "BBfaWae9NhdhWwd6BYdzQZVt71hUl0D3wOao8jEMCF6uEzhlYk"
		);
	
	$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	
	$getfield_client = '?screen_name=' . $url_client;
	$getfield_comp = '?screen_name=' . $url_comp;
	
	$info_client = $twitter->setGetfield($getfield_client)->buildOauth($ta_url, $requestMethod)->performRequest();
	$data_client = json_decode($info_client, true);
	
	$info_comp = $twitter->setGetfield($getfield_comp)->buildOauth($ta_url, $requestMethod)->performRequest();
	$data_comp = json_decode($info_comp, true);
	
	if((!isset($data_client) || !$data_client || is_null($data_client)) || (!isset($data_comp) || !$data_comp || is_null($data_comp)))
		return false;
	
	if((!isset($data_client[0]['user']['followers_count']) || $data_client[0]['user']['followers_count'] == '') || (!isset($data_comp[0]['user']['followers_count']) || $data_comp[0]['user']['followers_count'] == ''))
		return false;
	
	$return = array(
		'user_client'			=>		$data_client[0]['user']['screen_name'],
		'name_client'			=>		$data_client[0]['user']['name'],
		'followers_client'	=>		$data_client[0]['user']['followers_count'],
		'following_client'	=>		$data_client[0]['user']['friends_count'],
		'listed_client'		=>		$data_client[0]['user']['listed_count'],
		'favourites_client'	=>		$data_client[0]['user']['favourites_count'],
		'tweets_client'		=>		$data_client[0]['user']['statuses_count'],
		'user_comp'				=>		$data_comp[0]['user']['screen_name'],
		'name_comp'				=>		$data_comp[0]['user']['name'],
		'followers_comp'		=>		$data_comp[0]['user']['followers_count'],
		'following_comp'		=>		$data_comp[0]['user']['friends_count'],
		'listed_comp'			=>		$data_comp[0]['user']['listed_count'],
		'favourites_comp'		=>		$data_comp[0]['user']['favourites_count'],
		'tweets_comp'			=>		$data_comp[0]['user']['statuses_count']
		);
	
	
	return $return;
}

/*
 * Manage Pinterest's info
 */
function sns_pinterest_data() {
	$url_client = get_option('sns_pinterest_client_url');
	$url_client = 'https://pinterest.com/' . $url_client;
	$url_comp = get_option('sns_pinterest_comp_url');	
	$url_comp = 'https://pinterest.com/' . $url_comp;
	
	$data_client = @get_meta_tags($url_client);
	$data_comp = @get_meta_tags($url_comp);
	
	if((!isset($data_client) || !$data_client || is_null($data_client) || $data_client == '') || (!isset($data_comp) || !$data_comp || is_null($data_comp) || $data_comp == ''))
		return false;
	
	$return = array(
		'name_client'		=>		$data_client['og:title'],
		'boards_client'	=>		$data_client['pinterestapp:boards'],
		'pins_client'		=>		$data_client['pinterestapp:pins'],
		'followers_client'=>		$data_client['pinterestapp:followers'],
		'following_client'=>		$data_client['pinterestapp:following'],
		'name_comp'			=>		$data_comp['og:title'],
		'boards_comp'		=>		$data_comp['pinterestapp:boards'],
		'pins_comp'			=>		$data_comp['pinterestapp:pins'],
		'followers_comp'	=>		$data_comp['pinterestapp:followers'],
		'following_comp'	=>		$data_comp['pinterestapp:following']
		);
	
	return $return;
}

/*
 * Manage Instagram's info
 */

function sns_instagram_data(){
	set_include_path(__DIR__. '/ZendFramework/library');
	require_once 'Zend/Loader.php';
	Zend_Loader::loadClass('Zend_Http_Client');
	
	$APP_ID = '58426dc53dd94106b859c984fb103fd8';
	$APP_SECRET = '74ec1823ee824c5b9325a5fc5b5c9cd0';
	
	$url_client = get_option('sns_instagram_client_url');
	$url_comp = get_option('sns_instagram_comp_url');   

	try {
		$client = new Zend_Http_Client('https://api.instagram.com/v1/users/search');
		$client->setParameterGet('client_id', $APP_ID);
		$client->setParameterGet('q', $url_client);
		$client->setParameterGet('count', '1');
		
		$response_client = $client->request();
		$result_client = json_decode($response_client->getBody());
		
		$comp = new Zend_Http_Client('https://api.instagram.com/v1/users/search');
		$comp->setParameterGet('client_id', $APP_ID);
		$comp->setParameterGet('q', $url_comp);
		$comp->setParameterGet('count', '1');
		
		$response_comp = $comp->request();
		$result_comp = json_decode($response_comp->getBody());

		if (count($result_client->data) != 1) {
			return false;
		} else {
			$id_client = $result_client->data[0]->id;
			$client->setUri('https://api.instagram.com/v1/users/' . $id_client);
			$client->setParameterGet('client_id', $APP_ID);
			$response_client = $client->request();
			$result_client = json_decode($response_client->getBody());
			$data_client = $result_client->data;  
		}
		if(count($result_comp->data) != 1) {
			return false;
		} else {
			$id_comp = $result_comp->data[0]->id;
			$comp->setUri('https://api.instagram.com/v1/users/' . $id_comp);
			$comp->setParameterGet('client_id', $APP_ID);
			$response_comp = $comp->request();
			$result_comp = json_decode($response_comp->getBody());
			$data_comp = $result_comp->data; 
		}
		
		
		$return = array(
			'name_client'			=>		!empty($result_client->data->full_name) ? $result_client->data->full_name : 'No especificado',
			'pics_client'			=>		$result_client->data->counts->media,
			'followers_client'	=>		$result_client->data->counts->followed_by,
			'follows_client'		=>		$result_client->data->counts->follows,
			'name_comp'				=>		!empty($result_comp->data->full_name) ? $result_comp->data->full_name : 'No especificado',
			'pics_comp'				=>		$result_comp->data->counts->media,
			'followers_comp'		=>		$result_comp->data->counts->followed_by,
			'follows_comp'			=>		$result_comp->data->counts->follows,
			);
		
		return $return;
		
	} catch (Exception $e) {
		return false;
	}
}