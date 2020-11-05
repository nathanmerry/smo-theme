<?php
	set_time_limit(180);
	
	if(!isset($_SESSION)){ session_start(); }

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/update_details.php');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($_POST));
	curl_setopt($curl, CURLOPT_HEADER, 1);

	// Send the request
	$result = curl_exec($curl);
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($result, 0, $header_size);
	$body = substr($result, $header_size);
	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	// Handle response - The response will be echoed, if successful login, session variables will also be set
	if($body[0] == "{" || $body[0] == "["){
		// Response is JSON, successful login detected
		$json = json_decode($body);
		foreach($json as $key => $value){
			$_SESSION[$key] = $value;
		}
		$_SESSION['is_logged_in'] = 1;
	}	
	
	echo $body;

	curl_close($curl);
?>