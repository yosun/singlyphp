<?php

// test @ http://AReality3d.com/ext/singly-test/

define('CLIENT_ID','[INSERT client_id]');
define('CLIENT_SECRET','[INSERT client_secret]');
define('REDIRECT_URI','[INSERT redirect_uri]');

if(strlen($_REQUEST['code'])>2){

	// oauth2 auth code return received!
	
	// curl back for auth_token
	$blurb='client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET.'&code='.$_REQUEST['code'];
	$url='https://api.singly.com/oauth/access_token';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $blurb);
	$return = curl_exec($ch);
	
	// [do whatever you want with the return token <<<<<<<<<<<<<<<<<<<<<<<<<<]
	$arr = json_decode($return);
	print_r($return);

}else if(strlen($_REQUEST['service'])>2){

	// we got a 2bit string describing what kind of service we want to auth, so redirect the auth...
	$url = 'https://api.singly.com/oauth/authorize?client_id='.CLIENT_ID.'&redirect_uri='.REDIRECT_URI.'&service='.$_REQUEST['service'];
	header('Location: '.$url);
	echo '<a href="'.$url.'">You should be redirected here.</a>';

}else{

	// disp auth options
	dispe('img/facebook.png','facebook');
	dispe('img/foursquare.png','foursquare');
	dispe('img/instagram.png','instagram');
	dispe('img/linkedin.png','linkedin');
	dispe('img/tumblr.png','tumblr');
	dispe('img/twitter.png','twitter');
	dispe('img/github.png','github');
	dispe('img/googleplus.png','gcontacts'); 
	
	echo '<div><a href="http://dev.singly.com"><img src="img/singly-button.png" alt="Standard Singly
Button"></a></div>';	

}

function dispe($img,$txt){
	$alt='Log into '.$txt;
	echo '<span class="login_icon"><a href="?service='.$txt.'" title="'.$alt.'"><img alt="'.$alt.'" src="'.$img.'" /></a></span>';
}

?>