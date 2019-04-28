<?php
session_start();

if( isset( $_GET['username'] ) AND $_GET['username'] != '' ):

	require_once('oauth/twitteroauth.php'); //Path to twitteroauth library

	$username = $_GET['username'];
	$limit = ( isset( $_GET['count'] ) AND $_GET['count'] != '' ) ? $_GET['count'] : 2;
	$consumerkey = "uTjF2arLORUcjsBhuMmhQSSfv";
	$consumersecret = "9DRv0Hr6DFU5cjZLnb9c5TpOJIdDn13Nu46Qd719gtgCwKJHRV";
	$accesstoken = "1006025008932642822-10g3zyGbrDM4KupWXw6Cn8mzx0Iyv2";
	$accesstokensecret = "5F6mn97dhcEGcui02ejw0J8nXuyFKJyAgSjHKuASeu411";

	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}

	$interval = 600;

	$cache_file = dirname(__FILE__) . '/cache/' . $username . '_' . $limit;

	if (file_exists($cache_file)) {
		$last = filemtime($cache_file);
	} else { $last = false; }

	$now = time();

	if ( !$last || (( $now - $last ) > $interval) ) {

		$context = stream_context_create(array(
			'http' => array(
				'timeout' => 3
			)
		));

		$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		$twitter_feed = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$limit);

		$cache_rss = serialize($twitter_feed);

		if (!empty($cache_rss)) {
			$cache_static = fopen($cache_file, 'wb');
			fwrite($cache_static, $cache_rss);
			fclose($cache_static);
		}

		$rss = @unserialize(file_get_contents($cache_file));
	} else {
		$rss = @unserialize(file_get_contents($cache_file));
	}

	echo json_encode($rss);

endif;

?>