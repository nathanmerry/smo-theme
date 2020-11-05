<?php
	set_time_limit(60);

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/check_email.php');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($_POST));
	curl_setopt($curl, CURLOPT_HEADER, 1);

	// Send the request
	$result = curl_exec($curl);
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($result, 0, $header_size);
	$body = substr($result, $header_size);
	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	//body responses
	// "existing" only if email exists
	
	echo $body;

	curl_close($curl);
?>