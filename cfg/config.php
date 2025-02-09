<?php

	// Database Credentials
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '6Anfang&');
	define('DB_NAME', 'cocktailbar');

	// Global Variables
	define('MAX_LOGIN_ATTEMPTS_PER_HOUR', 5);
	define('MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY', 3);
	
	define('MAX_PASSWORD_RESET_REQUESTS_PER_DAY', 3);
	define('PASSWORD_RESET_REQUEST_EXPIRY_TIME', 360);
	define('CSRF_TOKEN_SECRET', 'lucM1rIuhzqeF4QH0I8N1jEavXG10VU4');

	// Globale PHP Einstellungen
	//date_default_timezone_set('UTC'); 
	//error_reporting(0);
	//session_set_cookie_params(['samesite' => 'Strict']);
	
	function createToken() {
		$seed = urlSafeEncode(random_bytes(8));
		$t = time();
		$hash = urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, CSRF_TOKEN_SECRET, true));
		return urlSafeEncode($hash . '|' . $seed . '|' . $t);
	}

	function validateToken($token) {
		$parts = explode('|', urlSafeDecode($token));
		if(count($parts) === 3) {
			$hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], CSRF_TOKEN_SECRET, true);
			if(hash_equals($hash, urlSafeDecode($parts[0]))) {
				return true;
			}
		}
		return false;
	}

	function urlSafeEncode($m) {
		return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
	}
	function urlSafeDecode($m) {
		return base64_decode(strtr($m, '-_', '+/'));
	}
?>