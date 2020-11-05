<?php
	set_time_limit(60);

	// Initiate a session if needed
	if(!isset($_SESSION)){ session_start(); }

	$login = array();
	$login['email'] = $_POST['login_email'];
	$login['password'] = $_POST['login_password'];
	$login['ip'] = $_POST['login_ip'];
	$login['owner'] = $_POST['login_owner'];
	$login['user_agent'] = $_POST['login_user_agent'];
	
	/*
	$_POST['email'] = $_POST['login_email'];
	$_POST['password'] = $_POST['login_password'];
	$_POST['ip'] = $_POST['login_ip'];
	$_POST['owner'] = $_POST['login_owner'];
	$_POST['user_agent'] = $_POST['login_user_agent'];
	*/
	
	// Setup the request
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/login.php');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($login));
	curl_setopt($curl, CURLOPT_HEADER, 1);

	// Send the request
	$result = curl_exec($curl);
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($result, 0, $header_size);
	$body = substr($result, $header_size);
	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	// Response types
	// "invalid", "invalid_email", "invalid_password" or if all correct a json response of user details
	
	// Handle response - The response will be echoed, if successful login, session variables will also be set
	if($body[0] == "{" || $body[0] == "["){
		// Response is JSON, successful login detected
		$json = json_decode($body);
		foreach($json as $key => $value){
			$_SESSION[$key] = $value;
		}
		$_SESSION['is_logged_in'] = 1;
		
		setcookie("VML_FN", $_SESSION['first_name'], time() + 86400 * 30, "/");
		setcookie("VML_SU", $_SESSION['short_url'], time() + 86400 * 30, "/");
		
		echo 1;
		
		//header('Location: ./my-account');
	}
	else { /*echo $body; $_SESSION['failed_login'] = true; header('Location: ./'); */ echo 0; }
	
	//echo $body;

	curl_close($curl);
?>