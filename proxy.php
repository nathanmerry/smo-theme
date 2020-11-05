<?php
session_start();
	set_time_limit(180);
error_reporting(0);
	//////////// Update user details for logged in users /////////////
	if(isset($_SESSION["is_logged_in"]))
	{
		$curl = curl_init();

	curl_setopt($curl, CURLOPT_POST, 1); //91.109.5.44/~dmopd
	curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/update_details.php');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($_POST));
	curl_setopt($curl, CURLOPT_HEADER, 1);

	// Send the request
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
	
	curl_close($curl);
	}
	//////////// Update user details for logged in users /////////////

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/apiv1.php');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($_POST));
	curl_setopt($curl, CURLOPT_HEADER, 1);

	// Send the request
	$result = curl_exec($curl);
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($result, 0, $header_size);
	$body = substr($result, $header_size);
	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	echo $body;
	curl_close($curl);
	// SimplyCastAPI
	/*
	require_once dirname(__FILE__) . '/lib/SimplyCastAPI.php';
	$public = "c347d911982b5da3b8217e5efde8ef0d39cbb6c1";
	$secret = "4a92f873431558b6e91ca65fee230b04f8947fa9";
	$api = new SimplyCastAPI($public, $secret);
	$listId = 4; 
	$mob = substr($_POST['mobile_phone'],1);
	$mob = "+44" . $mob;	
	$fields = array(
		'name' => ucwords($_POST['first_name'] . ' ' . $_POST['last_name']),
		'email' => $_POST['email'],
		'mobile' => $mob,
		'first_name' => ucwords($_POST['first_name']),
		'last_name' => ucwords($_POST['last_name']),
		'loan_amount_wanted' => $_POST['loan_amount']
	);
	$api->contactlist->createContact($listId, $fields);	
	*/
	//New API
	
	/*
	$Title    = urlencode($_POST['title']);
	$FirstName   = urlencode($_POST['first_name']);
	$Surname    = urlencode($_POST['last_name']);
	$ResidentialStatus    = urlencode($_POST['residence_status']);
	$MobileTel    = urlencode($_POST['mobile_phone']);
	$LoanAmount    = urlencode($_POST['loan_amount']);
	
	$str = "?campid=VERY-MERRY-LOANS&firstname=".$FirstName."&phone1=".$MobileTel."&loan+amount=".$LoanAmount;

	 $ch=curl_init();
	 curl_setopt($ch,CURLOPT_URL,'http://neo.leadbyte.co.uk/api/submit.php'.$str);
	  //curl_setopt($ch,CURLOPT_URL,'http://api.neomediamarketing.co.uk/data/9nnmE0uD3F/apifeed/data5005.php'.$str);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $rdata = curl_exec($ch);
	 curl_close($ch);
	//End of new API
	*/

	$json = json_decode($body);
	
	/** Send mail to user **/
	/*$user_subject = "Still Waiting For Your Answer?";
	$user_receiver = $_POST['email'];
	$sender = "news@verymerryloans.com";
	$mailbody = file_get_contents('https://www.verymerryloans.com/newsletters/confirm.html');
	$user_mailheader = "From: $sender\r\n";
	$user_mailheader .= "MIME-Version: 1.0" . "\r\n";
	$user_mailheader .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	mail($user_receiver,$user_subject,$mailbody,$user_mailheader);*/
	/** End of send mail to user **/	
	
	if($json->status != "success"){
		$eBody = '';
		$eBody .= 'Date of birth: '.$_POST['dob'].'<br/>';
		$eBody .= 'Email: '.$_POST['email'].'<br/>';
		$eBody .= 'Title: '.$_POST['title'].'<br/>';
		$eBody .= 'First Name: '.$_POST['first_name'].'<br/>';
		$eBody .= 'Last Name: '.$_POST['last_name'].'<br/>';
		$eBody .= 'Home Phone: '.$_POST['home_phone'].'<br/>';
		$eBody .= 'Work Phone: '.$_POST['work_phone'].'<br/>';
		$eBody .= 'Mobile Phone: '.$_POST['mobile_phone'].'<br/>';
		$eBody .= 'Employer Name: '.$_POST['employer_name'].'<br/>';
		$eBody .= 'Employer Industry: '.$_POST['employer_industry'].'<br/>';
		$eBody .= 'Date Employment Started: '.$_POST['employment_start'].'<br/>';
		$eBody .= 'Net Monthly Income - after tax: '.$_POST['monthly_income'].'<br/>';
		$eBody .= 'Income Source: '.$_POST['income_source'].'<br/>';
		$eBody .= 'Payment frequency: '.$_POST['pay_frequency'].'<br/>';
		$eBody .= 'Loan Amount: '.$_POST['loan_amount'].'<br/>';
		$eBody .= 'Residence Status: '.$_POST['residence_status'].'<br/>';
		$eBody .= 'Address 1: '.$_POST['address_1'].'<br/>';
		$eBody .= 'Address 2: '.$_POST['address_2'].'<br/>';
		$eBody .= 'Town: '.$_POST['town'].'<br/>';
		$eBody .= 'Postcode: '.$_POST['post_code'].'<br/>';
		$eBody .= 'County: '.$_POST['county'].'<br/>';
		$eBody .= 'Date applicant living at current address: '.$_POST['residence_start'].'<br/>';
		$eBody .= 'Next Pay Date: '.$_POST['next_payday'].'<br/>';
		$eBody .= 'Second Pay Date: '.$_POST['second_payday'].'<br/>';
		$eBody .= 'Primary Debit Card: '.$_POST['debit_card'].'<br/>';
		$eBody .= 'Sort Code: '.$_POST['sort_code'].'<br/>';
		$eBody .= 'Bank Account Number: '.$_POST['bank_account'].'<br/>';
		$eBody .= 'Applicant Paid by Direct Credit: '.$_POST['paid_direct'].'<br/>';
		$eBody .= 'Bank Name: '.$_POST['bank_name'].'<br/>';
		$eBody .= 'Loan Purpose: '.$_POST['loan_purpose'].'<br/>';
		//$eBody .= 'UserAgent: '.$_POST['user_agent'].'<br/>';
		//$eBody .= 'IP: '.$_POST['ip'].'<br/>';

		$emailarr = array();
		$emailarr['email'] = $_POST['email'];
		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_POST, 1); //91.109.5.44/~dmopd
		curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/get_ip_useragent.php');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($emailarr));
		curl_setopt($curl, CURLOPT_HEADER, 1);
		
		// Send the request
		// Send the request
		$result = curl_exec($curl);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$header = substr($result, 0, $header_size);
		$body1 = substr($result, $header_size);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		// Handle response - The response will be echoed, if successful login, session variables will also be set
		if($body1[0] == "{" || $body1[0] == "["){
			// Response is JSON, successful login detected
			$json = json_decode($body1);
			$eBody .= 'IP: '.$json->orig_ip.'<br/>';
			$eBody .= 'UserAgent: '.$json->user_agent.'<br/>';
		}
		
		curl_close($curl);


		$eBody .= 'Response: '.$body;

		
		$to = "sammerrycatch@gmail.com";
		$subject = "LOAN PARAMOUNT Loans Rejected Submission via Central System ";
		$from = "no-reply@loanparamount.com";
		$headers = "From:" . $from."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$eBody,$headers);		
	}	
	$interest = "No";
	if(isset($_POST['interest']) && $_POST['interest'] == "interest"){ $interest = "Yes"; }
	
	$eBody = '';
	$eBody .= 'Date of birth: '.$_POST['dob'].'<br/>';
	$eBody .= 'Email: '.$_POST['email'].'<br/>';
	$eBody .= 'Title: '.$_POST['title'].'<br/>';
	$eBody .= 'First Name: '.$_POST['first_name'].'<br/>';
	$eBody .= 'Last Name: '.$_POST['last_name'].'<br/>';
	$eBody .= 'Home Phone: '.$_POST['home_phone'].'<br/>';
	$eBody .= 'Work Phone: '.$_POST['work_phone'].'<br/>';
	$eBody .= 'Mobile Phone: '.$_POST['mobile_phone'].'<br/>';
	$eBody .= 'Employer Name: '.$_POST['employer_name'].'<br/>';
	$eBody .= 'Employer Industry: '.$_POST['employer_industry'].'<br/>';
	$eBody .= 'Date Employment Started: '.$_POST['employment_start'].'<br/>';
	$eBody .= 'Net Monthly Income - after tax: '.$_POST['monthly_income'].'<br/>';
	$eBody .= 'Income Source: '.$_POST['income_source'].'<br/>';
	$eBody .= 'Payment frequency: '.$_POST['pay_frequency'].'<br/>';
	$eBody .= 'Loan Amount: '.$_POST['loan_amount'].'<br/>';
	$eBody .= 'Residence Status: '.$_POST['residence_status'].'<br/>';
	$eBody .= 'Address 1: '.$_POST['address_1'].'<br/>';
	$eBody .= 'Address 2: '.$_POST['address_2'].'<br/>';
	$eBody .= 'Town: '.$_POST['town'].'<br/>';
	$eBody .= 'Postcode: '.$_POST['post_code'].'<br/>';
	$eBody .= 'County: '.$_POST['county'].'<br/>';
	$eBody .= 'Date applicant living at current address: '.$_POST['residence_start'].'<br/>';
	$eBody .= 'Next Pay Date: '.$_POST['next_payday'].'<br/>';
	$eBody .= 'Second Pay Date: '.$_POST['second_payday'].'<br/>';
	$eBody .= 'Primary Debit Card: '.$_POST['debit_card'].'<br/>';
	$eBody .= 'Sort Code: '.$_POST['sort_code'].'<br/>';
	$eBody .= 'Bank Account Number: '.$_POST['bank_account'].'<br/>';
	$eBody .= 'Applicant Paid by Direct Credit: '.$_POST['paid_direct'].'<br/>';
	$eBody .= 'Bank Name: '.$_POST['bank_name'].'<br/>';
	$eBody .= 'Loan Purpose: '.$_POST['loan_purpose'].'<br/>';
	//$eBody .= 'UserAgent: '.$_POST['user_agent'].'<br/>';
	//$eBody .= 'IP: '.$_POST['ip'].'<br/>';

	$emailarr = array();
		$emailarr['email'] = $_POST['email'];
		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_POST, 1); //91.109.5.44/~dmopd
		curl_setopt($curl, CURLOPT_URL, 'http://139.162.218.108/~vmonlineltd/api/get_ip_useragent.php');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($emailarr));
		curl_setopt($curl, CURLOPT_HEADER, 1);
		
		// Send the request
		// Send the request
		$result = curl_exec($curl);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$header = substr($result, 0, $header_size);
		$body2 = substr($result, $header_size);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		// Handle response - The response will be echoed, if successful login, session variables will also be set
		if($body2[0] == "{" || $body2[0] == "["){
			// Response is JSON, successful login detected
			$json = json_decode($body2);
			$eBody .= 'IP: '.$json->orig_ip.'<br/>';
			$eBody .= 'UserAgent: '.$json->user_agent.'<br/>';
		}
		
		curl_close($curl);

	$eBody .= 'Raffle Interest: '.$interest.'<br/><br/>';
	$eBody .= 'Response: '.$body;

	//echo $eBody;
	$to = "no-reply@loanparamount.com";
	//$to = "wordpress@mailinator.com";
	$subject = "Loan Paramount Application Received";
	$from = "no-reply@loanparamount.com";
	$headers = "From:" . $from."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($to,$subject,$eBody,$headers);	

?>