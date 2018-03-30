<?php
/*function isRecaptchaValid($code, $ip = null)
{
	if (empty($code)) {
		return false; // Si aucun code n'est entré, on ne cherche pas plus loin
	}
	$params = [
		'secret'    => '6LdrfE8UAAAAACRrx7lrAYeAvMuDJyLieeEx0-Sp',
		'response'  => $code
	];
	if( $ip ){
		$params['remoteip'] = $ip;
	}
	$url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
	if (function_exists('curl_version')) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
		$response = curl_exec($curl);
	} else {
		// Si curl n'est pas dispo, un bon vieux file_get_contents
		$response = file_get_contents($url);
	}

	if (empty($response) || is_null($response)) {
		return false;
	}

	$json = json_decode($response);
	return $json->success;
}*/
foreach ($_POST as $key => $value) {
    echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
  }

// grab recaptcha library
require_once "recaptchalib.php";
// your secret key
$secret = "6LdrfE8UAAAAACRrx7lrAYeAvMuDJyLieeEx0-Sp";

// empty response
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($secret);
// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
if ($response != null && $response->success) {
	 echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";
 } else {
?>
