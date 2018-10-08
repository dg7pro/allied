<?php
require 'tmhOAuth.php'; // Get it from: https://github.com/themattharris/tmhOAuth

// Use the data from http://dev.twitter.com/apps to fill out this info
// notice the slight name difference in the last two items)

/*$connection = new tmhOAuth(array(
    'consumer_key' => 'mAOyz69EOZnQ1pv51Pep4JxcT',
	'consumer_secret' => 't5uuaN99U9JZ66jCD0SODfAJOIGVxp9aZ90x89q9AOzD6ur9pB',
	'user_token' => '555504889-Q3C4YsrYhXhwrQQK5doEmNFH8OxwHRSsMDrRvPk0', //access token
	'user_secret' => 'ZXBslC2rGQt8NPs1uvJ2b00Z0sx6UeVwEFmxrYl4rRbId' //access token secret
));*/

$connection = new tmhOAuth(array(
    'consumer_key' => 'ziLsE5DepCYEGwlXJ109bvb88',
    'consumer_secret' => 'zLNg7OXv4aT2BNPbbz5WqL7HRCOyOD8RRFBXW1XriT4jdTww2l',
    'user_token' => '460465607-5QdBsldUKcayPwUCq6XorxjpMu9vlvDP8j11IBCU', //access token
    'user_secret' => 'mRb0CqitKlTxRXjwsO0fy7VYL5jdwDNQS7FIaCiI3PE52' //access token secret
));

// set up parameters to pass
$parameters = array();

if ($_GET['count']) {
	$parameters['count'] = strip_tags($_GET['count']);
}

if ($_GET['screen_name']) {
	$parameters['screen_name'] = strip_tags($_GET['screen_name']);
}

if ($_GET['twitter_path']) { $twitter_path = $_GET['twitter_path']; }  else {
	$twitter_path = '1.1/statuses/user_timeline.json';
}

$http_code = $connection->request('GET', $connection->url($twitter_path), $parameters );

if ($http_code === 200) { // if everything's good
	$response = strip_tags($connection->response['response']);

	if ($_GET['callback']) { // if we ask for a jsonp callback function
		echo $_GET['callback'],'(', $response,');';
	} else {
		echo $response;	
	}
} else {
	echo "Error ID: ",$http_code, "<br>\n";
	echo "Error: ",$connection->response['error'], "<br>\n";
}

// You may have to download and copy http://curl.haxx.se/ca/cacert.pem