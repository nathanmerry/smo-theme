<?php



if(isset($_SERVER['QUERY_STRING'])){

	if(!isset($_SESSION)){ session_start(); }



	// Autologin

	if(substr($_SERVER['QUERY_STRING'], 0, 2) == "k=")

	{

		$_SESSION['remarketing'] = 1;

		$key = explode("=", $_SERVER['QUERY_STRING']);

		$key = $key[1];

		$_SESSION['auto_key'] = $key;

		die(header('Location: /get-loan'));

	}



}



// Detect login status.

$loggedin = false;

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1){ $loggedin = true; }

// Create mobile detection object.

require_once 'Mobile_Detect.php';

$detect = new Mobile_Detect;



// IP detection functions.

function validate_ip($ip){

	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false){
		return false;
	}

	return true;

}



function get_ip_address() {

	$ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

	foreach($ip_keys as $key){

		if(array_key_exists($key, $_SERVER) === true){

			foreach(explode(',', $_SERVER[$key]) as $ip){

				$ip = trim($ip);

				if(validate_ip($ip)){

					return $ip;

				}

			}

		}

	}

	return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;

}
?>





<?php
	require './globals.php';
	require './Controller/Company.php';

	$cmsCompany = new Company();
	$cmsCompany = $cmsCompany->get();




if ($cmsCompany) {

	// output data of each row


		/*  echo "Min_la: " . $row["min_la"]. " - Max_la: " . $row["max_la"].

          "Max_lt " . $row["max_lt"]. "Min_lt " . $row["min_lt"]."apr " . $row["apr"]."legal " . $row["legal"] ."repexample " . $row["rep_example"]  ;*/

		$GLOBALS['rapr'] = $cmsCompany["apr"];

		$GLOBALS['max_lt'] = $cmsCompany["max_lt"];

		$GLOBALS['min_lt'] = $cmsCompany["min_lt"];

		$GLOBALS['max_la'] = $cmsCompany["max_la"];

		$GLOBALS['min_la'] = $cmsCompany["min_la"];

		$GLOBALS['interestrates'] = $cmsCompany["interestrates"];

		$GLOBALS['legal'] = $cmsCompany["legal"];

		$GLOBALS['how_it_works'] = $cmsCompany["how_it_works"];

		$GLOBALS['terms'] = $cmsCompany["terms"];

		$GLOBALS['privacy'] = $cmsCompany["privacy"];

		$GLOBALS['rep_example'] = $cmsCompany["rep_example"];

		$GLOBALS['increments'] = $cmsCompany["increments"];



		?>



		<!-- <input id="Min_la" type="hidden" value="<?php echo $row["min_la"]; ?>" />

		<input id="Max_la" type="hidden" value="<?php echo $row["max_la"]; ?>" />

		<input id="interestrates" type="hidden" value="<?php echo $row["interestrates"]; ?>" />
 -->
	<?php }

?>



<!doctype html>

<html class="no-js" lang="en">

<head>

	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php echo $title; ?></title>

	<link rel="stylesheet" href="/css/foundation.min.css" />

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

	<link href='https://fonts.googleapis.com/css?family=Raleway:600,700,800,400,300' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	<?php

	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	if (strpos($url,'blue') !== false) {

		echo '<link rel="stylesheet" href="/css/blue.css" />';

	}

	elseif (strpos($url,'pink') !== false) {

		echo '<link rel="stylesheet" href="/css/pink.css" />';

	}

	else {

		echo '<link rel="stylesheet" href="/css/grey.css" />';

	}



	?>

	<link rel="stylesheet" href="/css/slider.css" />

	<link rel="stylesheet" href="/css/pb.css" />

	<link rel="stylesheet" href="/css/jqueryui.css" />

	<script src="/js/vendor/modernizr.js"></script>

	<script src="/js/vendor/jquery.js"></script>

	<link rel="manifest" href="/manifest.json">

	<meta name="msapplication-TileColor" content="#ffffff">

	<meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">

	<meta name="theme-color" content="#ffffff">

</head>



<div id="main">



	<div class="info-box"></div>

	<div id="form-error-box" class="error-box"></div>



	<form name="frmApply" id="frmApply" class="register" action="#" method="post">



		<?php

		if(isset($loggedin))

		{

			?>

			<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>" />

			<input type="hidden" name="login_hash" id="login_hash" value="<?php echo $_SESSION['password']; ?>" />

		<?php } ?>



		<input type="hidden" id="ip" name="ip" value="<?php echo get_ip_address(); ?>"/>

		<input type="hidden" id="user_agent" name="user_agent" value="<?php echo substr($_SERVER['HTTP_USER_AGENT'],0,200); ?>"/>



		<?php

		function queryToArray($qry)

		{

			$result = array();

			//string must contain at least one = and cannot be in first position

			if(strpos($qry,'=')) {



				if(strpos($qry,'?')!==false) {

					$q = parse_url($qry);

					$qry = $q['query'];

				}

			}else {

				return false;

			}



			foreach (explode('&', $qry) as $couple) {

				list ($key, $val) = explode('=', $couple);

				$result[$key] = $val;

			}



			return empty($result) ? false : $result;

		}

		$query = queryToArray($_SERVER['REQUEST_URI']);

		?>



		<div class="row">

			<div class="small-12 columns"><!--

					<h1 style="margin-bottom: 10px;">Apply Now</h1>--><br>

				<?php

				$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

				if (strpos($url,'blue') !== false) {

					echo '<img src="/img/apply-blue.png" alt="Steps" class="margin-bottom-medium" />';

				}

				elseif (strpos($url,'pink') !== false) {

					echo '<img src="/img/apply.png" alt="Steps" class="margin-bottom-medium" />';

				}

				else {

					echo '<img src="/img/apply-splash.png" alt="Steps" class="margin-bottom-medium" />';

				}



				?>

			</div>

		</div>



		<div class="row">

			<!--<div class="small-12 medium-4 medium-push-8 columns">

            </div>	-->

			<div class="small-12 medium-12 columns">



				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-money"></i> Create an account</h3>

					</div>

					<div class="small-12 medium-4 columns end">

						<label for="email">Email.

							<input type="email" name="email" id="email" placeholder="email@website.com" value="<?php if(isset($_SESSION['email']) && $_SESSION['email'] != ""){ echo $_SESSION['email']; } ?>" />

						</label>

					</div>

					<?php if(!$loggedin){ ?>

						<div class="small-12 medium-4 columns">

							<label for="password_1">Password.

								<input type="password" name="password_1" id="password_1" placeholder="Choose a password." />

							</label>

						</div>

						<div class="small-12 medium-4 columns end">

							<label for="password_2">Confirm Password.

								<input type="password" name="password_2" id="password_2" placeholder="Confirm password." />

							</label>

						</div>

					<?php } ?>

				</div>



























				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-money"></i> Loan Details</h3>

					</div>

					<div class="small-12 medium-4 columns">

						<label for="loan_purpose">Loan Purpose

							<select name="loan_purpose" id="loan_purpose">

								<option value="" disabled="" selected="">Please Select</option>

								<option value="Payday"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Payday"){ echo ' selected'; } ?>>Payday</option>

								<option value="Debt Consolidation"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Debt Consolidation"){ echo ' selected'; } ?>>Debt Consolidation</option>

								<option value="Home Improvements"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Home Improvements"){ echo ' selected'; } ?>>Home Improvements</option>

								<option value="Business"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Business"){ echo ' selected'; } ?>>Business</option>

								<option value="Car Purchase"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Car Purchase"){ echo ' selected'; } ?>>Car Purchase</option>

								<option value="Car Other"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Car Other"){ echo ' selected'; } ?>>Car Other</option>

								<option value="Holiday"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Holiday"){ echo ' selected'; } ?>>Holiday</option>

								<option value="House Purchase"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "House Purchase"){ echo ' selected'; } ?>>House Purchase</option>

								<option value="Student Loan"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Student Loan"){ echo ' selected'; } ?>>Student Loan</option>

								<option value="Electrical Item"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Electrical Item"){ echo ' selected'; } ?>>Electrical Item</option>

								<option value="New Baby"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "New Baby"){ echo ' selected'; } ?>>New Baby</option>

								<option value="Motorcycle"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Motorcycle"){ echo ' selected'; } ?>>Motorcycle</option>

								<option value="Wedding"<?php if(isset($_SESSION['loan_purpose']) && $_SESSION['loan_purpose'] == "Wedding"){ echo ' selected'; } ?>>Wedding</option>

							</select>

						</label>

					</div>

					<div class="small-12 medium-4 columns">

						<label for="loan-amount-mobile">Loan Amount

							<select name="loan_amount" id="loan-amount-mobile">

								<option value="">Please select...</option>

								<?php







								for($i = $min_la; $i <= $max_la; $i += $increments)

								{

									echo '<option value="' . $i . '"'; if($i == $query['la']){ echo ' selected'; } echo '>&pound;' . $i . '</option>';

								}



								?>

							</select>

						</label>

					</div>

					<div class="small-12 medium-4 columns end">

						<label for="loan-term-mobile">Loan Term

							<select name="loan_term" id="loan-term-mobile">

								<option value="">Please select...</option>

								<?php



								for($i = $min_lt; $i <= $max_lt; $i++)

								{

									echo '<option value="' . $i . '"'; if($i == $query['lt']){ echo ' selected'; } echo '>' . $i . ' Months</option>';

								}



								?>

							</select>

						</label>

					</div>

				</div>







































				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-user"></i> Your personal details.</h3>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="title">Title.

									<select name="title" id="title">

										<option value="Please Select" disabled="" selected="">Please Select</option>

										<option value="Mr."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Mr."){ echo ' selected'; } ?>>Mr.</option>

										<option value="Ms."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Ms."){ echo ' selected'; } ?>>Ms.</option>

										<option value="Mrs."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Mrs."){ echo ' selected'; } ?>>Mrs.</option>

										<option value="Miss."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Miss."){ echo ' selected'; } ?>>Miss.</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="first_name">First Name.

									<input type="text" name="first_name" id="first_name" placeholder="Your name." value="<?php if(isset($_SESSION['first_name']) && $_SESSION['first_name'] != ""){ echo $_SESSION['first_name']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="last_name">Last Name.

									<input type="text" name="last_name" id="last_name" placeholder="Your surname." value="<?php if(isset($_SESSION['last_name']) && $_SESSION['last_name'] != ""){ echo $_SESSION['last_name']; } ?>" />

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns end">

								<label for="dob">Date of Birth.

									<input type="text" name="dob" id="dob" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['dob']) && $_SESSION['dob'] != ""){ echo date('d-M-Y', $_SESSION['dob']); } ?>">

								</label>

							</div>



						</div>

					</div>

				</div>



				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-home"></i> Your residence details.</h3>

						<span style="font-size:12px;"><i class="fa fa-lock"></i> <strong>We don't need to post you anything, but we do need to check that you have a permanent address.</strong></span><br><br>





						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="home_phone">Home Phone.

									<input type="tel" name="home_phone" id="home_phone" placeholder="01234567890" value="<?php if(isset($_SESSION['home_phone']) && $_SESSION['home_phone'] != ""){ echo $_SESSION['home_phone']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="mobile_phone">Mobile Phone.

									<input type="tel" name="mobile_phone" id="mobile_phone" placeholder="07701234567" value="<?php if(isset($_SESSION['mobile_phone']) && $_SESSION['mobile_phone'] != ""){ echo $_SESSION['mobile_phone']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="address_1">House No / Name.

									<input type="text" name="address_1" id="address_1" placeholder="Your house no / name." value="<?php if(isset($_SESSION['address_1']) && $_SESSION['address_1'] != ""){ echo $_SESSION['address_1']; } ?>" />

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="address_2">Street Name.

									<input type="text" name="address_2" id="address_2" placeholder="Your street name" value="<?php if(isset($_SESSION['address_2']) && $_SESSION['address_2'] != ""){ echo $_SESSION['address_2']; } ?>">

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="town">Town.

									<input type="text" name="town" id="town" placeholder="Your town" value="<?php if(isset($_SESSION['town']) && $_SESSION['town'] != ""){ echo $_SESSION['town']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="county">County.

									<input type="text" name="county" id="county" placeholder="Your county" value="<?php if(isset($_SESSION['county']) && $_SESSION['county'] != ""){ echo $_SESSION['county']; } ?>" />

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="post_code">Post Code.

									<input type="text" name="post_code" id="post_code" placeholder="Your postcode" value="<?php if(isset($_SESSION['post_code']) && $_SESSION['post_code'] != ""){ echo $_SESSION['post_code']; } ?>">

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="residence_status">Home Status.

									<select name="residence_status" id="residence_status">

										<option value="Please Select" disabled>Please Select</option>

										<option value="Home Owner"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Home Owner"){ echo ' selected'; } ?>>Home Owner</option>

										<option value="Living with Relatives"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Living with Relatives"){ echo ' selected'; } ?>>Living with Relatives</option>

										<option value="Council Tenant"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Council Tenant"){ echo ' selected'; } ?>>Council Tenant</option>

										<option value="Private Tenant"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Private Tenant"){ echo ' selected'; } ?>>Private Tenant</option>

										<option value="Housing Association Tenant"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Housing Association Tenant"){ echo ' selected'; } ?>>Housing Association Tenant</option>

										<option value="Military Accommodation"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Military Accommodation"){ echo ' selected'; } ?>>Military Accommodation</option>

										<option value="Work Accommodation"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Work Accommodation"){ echo ' selected'; } ?>>Work Accommodation</option>

										<option value="Other"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Other"){ echo ' selected'; } ?>>Other</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="residence_start">Date you moved in.

									<input type="text" name="residence_start" id="residence_start" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['residence_start']) && $_SESSION['residence_start'] != ""){ echo date('d-M-Y', $_SESSION['residence_start']); } ?>" />

								</label>

							</div>

						</div>

					</div>

				</div>



				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-briefcase"></i> Employment details.</h3>

						<span style="font-size:12px;"><i class="fa fa-lock"></i> <strong>Don't worry, WE WILL NEVER CONTACT YOUR EMPLOYER OR WORKPLACE - we just need to know your regular income.</strong></span><br>

						<br>



						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="income_source">Employment Status.

									<select name="income_source" id="em-status">

										<option value="" disabled="" selected="">Please Select</option>

										<option value="Full-Time Employment"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Full-Time Employment"){ echo ' selected'; } ?>>Full-Time Employment</option>

										<option value="Part-Time Employment"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Part-Time Employment"){ echo ' selected'; } ?>>Part-Time Employment</option>

										<option value="Temporary Employment"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Temporary Employment"){ echo ' selected'; } ?>>Temporary Employment</option>

										<option value="Self Employed"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Self Employed"){ echo ' selected'; } ?>>Self Employed</option>

										<option value="Unemployed"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Unemployed"){ echo ' selected'; } ?>>Unemployed</option>

										<option value="Benefits"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Benefits"){ echo ' selected'; } ?>>Benefits</option>

										<option value="Disability Benefits"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Disability Benefits"){ echo ' selected'; } ?>>Disability Benefits</option>

										<option value="Other"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Other"){ echo ' selected'; } ?>>Other</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-emp-ind">

								<label for="employer_industry">Employer Industry.

									<select id="ei" name="employer_industry">

										<option value="" disabled="" selected="">Please Select</option>

										<option value="Construction/Manufacturing"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Construction/Manufacturing"){ echo ' selected'; } ?>>Construction/Manufacturing</option>

										<option value="Military"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Military"){ echo ' selected'; } ?>>Military</option>

										<option value="Health"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Health"){ echo ' selected'; } ?>>Health</option>

										<option value="Banking/Insurance"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Banking/Insurance"){ echo ' selected'; } ?>>Banking/Insurance</option>

										<option value="Education"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Education"){ echo ' selected'; } ?>>Education</option>

										<option value="Civil Service"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Civil Service"){ echo ' selected'; } ?>>Civil Service</option>

										<option value="Supermarket/Retail"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Supermarket/Retail"){ echo ' selected'; } ?>>Supermarket/Retail</option>

										<option value="Utilities/Telecom"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Utilities/Telecom"){ echo ' selected'; } ?>>Utilities/Telecom</option>

										<option value="Hotel, Restaurant and Leisure"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Hotel, Restaurant and Leisure"){ echo ' selected'; } ?>>Hotel, Restaurant and Leisure</option>

										<option value="Other, office based"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Other, office based"){ echo ' selected'; } ?>>Other, office based</option>

										<option value="Other, non office based"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Other, non office based"){ echo ' selected'; } ?>>Other, non office based</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-emp-name">

								<label for="employer_name">Employer Name.

									<input type="text" name="employer_name" id="employer_name" placeholder="Your employers name." value="<?php if(isset($_SESSION['employer_name']) && $_SESSION['employer_name'] != ""){ echo $_SESSION['employer_name']; } ?>" />

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns emp-emp-start">

								<label for="employment_start">Employment Start.

									<input type="text" name="employment_start" id="employment_start" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['employment_start']) && $_SESSION['employment_start'] != ""){ echo date('d-M-Y', $_SESSION['employment_start']); } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-work-phone">

								<label for="work_phone">Work Phone.

									<input type="text" name="work_phone" id="work_phone" placeholder="01234567890" value="<?php if(isset($_SESSION['work_phone']) && $_SESSION['work_phone'] != ""){ echo $_SESSION['work_phone']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-pay-freq">

								<label for="pay_frequency">Payment Frequency.

									<select id="pay_frequency" name="pay_frequency">

										<option value="" disabled="" selected="">Please Select</option>

										<option value="Weekly"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Weekly"){ echo ' selected'; } ?>>Weekly</option>

										<option value="Bi-Weekly"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Bi-Weekly"){ echo ' selected'; } ?>>Bi-Weekly</option>

										<option value="Four Weekly"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Four Weekly"){ echo ' selected'; } ?>>Four Weekly</option>

										<option rel="1" value="Last Monday of month"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Last Monday of month"){ echo ' selected'; } ?>>Last Monday of month</option>

										<option rel="2" value="Last Tuesday of month"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Last Tuesday of month"){ echo ' selected'; } ?>>Last Tuesday of month</option>

										<option rel="3" value="Last Wednesday of month"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Last Wednesday of month"){ echo ' selected'; } ?>>Last Wednesday of month</option>

										<option rel="4" value="Last Thursday of month"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Last Thursday of month"){ echo ' selected'; } ?>>Last Thursday of month</option>

										<option rel="5" value="Last Friday of month"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Last Friday of month"){ echo ' selected'; } ?>>Last Friday of month</option>

										<option value="Last Working Day of month"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Last Working Day of month"){ echo ' selected'; } ?>>Last Working Day of month</option>

										<option value="Specific Date"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Specific Date"){ echo ' selected'; } ?>>Specific Date</option>

										<option value="Other"<?php if(isset($_SESSION['pay_frequency']) && $_SESSION['pay_frequency'] == "Other"){ echo ' selected'; } ?>>Other</option>

									</select>

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns emp-next-pay">

								<label for="next_payday">Next Pay Date.

									<input type="text" name="next_payday" id="next_payday" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['next_payday']) && $_SESSION['next_payday'] != ""){ echo date('d-M-Y', $_SESSION['next_payday']); } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-sec-pay">

								<label for="second_payday">Second Pay Date.

									<input type="text" name="second_payday" id="second_payday" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['second_payday']) && $_SESSION['second_payday'] != ""){ echo date('d-M-Y', $_SESSION['second_payday']); } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-monthly-income">

								<label for="monthly_income" class="has-gbp">Monthly Income.

									<input type="text" name="monthly_income" id="monthly_income" placeholder="900" value="<?php if(isset($_SESSION['monthly_income']) && $_SESSION['monthly_income'] != ""){ echo $_SESSION['monthly_income']; } ?>" />

								</label>

							</div>

						</div>

					</div>

				</div>



				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-cc-visa"></i> Your financial details.</h3>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="debit_card">Debit Card.

									<select id="debit_card" name="debit_card">

										<option value="" disabled="" selected="">Please Select</option>

										<option value="MasterCard Debit"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "MasterCard Debit"){ echo ' selected'; } ?>>MasterCard Debit</option>

										<option value="Switch / Maestro"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "Switch / Maestro"){ echo ' selected'; } ?>>Switch / Maestro</option>

										<option value="Visa Debit"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "Visa Debit"){ echo ' selected'; } ?>>Visa Debit</option>

										<option value="Visa Electron"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "Visa Electron"){ echo ' selected'; } ?>>Visa Electron</option>

										<option value="No Debit Card"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "No Debit Card"){ echo ' selected'; } ?>>No Debit Card</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="paid_direct">Paid as Direct Debit.

									<select id="paid_direct" name="paid_direct">

										<option value="" disabled="" selected="">Please Select</option>

										<option value="Yes, UK Account"<?php if(isset($_SESSION['paid_direct']) && $_SESSION['paid_direct'] == "Yes, UK Account"){ echo ' selected'; } ?>>Yes, UK Account</option>

										<option value="Yes, Non UK Account"<?php if(isset($_SESSION['paid_direct']) && $_SESSION['paid_direct'] == "Yes, Non UK Account"){ echo ' selected'; } ?>>Yes, Non UK Account</option>

										<option value="No"<?php if(isset($_SESSION['paid_direct']) && $_SESSION['paid_direct'] == "No"){ echo ' selected'; } ?>>No</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="bank_account">Account Number.

									<input type="text" name="bank_account" id="bank_account" placeholder="12345678" maxlength="8" value="<?php if(isset($_SESSION['bank_account']) && $_SESSION['bank_account'] != ""){ echo $_SESSION['bank_account']; } ?>" />

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="sort_code">Sort Code.

									<input type="text" name="sort_code" id="sort_code" placeholder="123456" maxlength="6" value="<?php if(isset($_SESSION['sort_code']) && $_SESSION['sort_code'] != ""){ echo $_SESSION['sort_code']; } ?>">

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="bank_name">Bank Name.

									<select id="bank_name" name="bank_name" class="form-input">

										<option value="" disabled="" selected="">Please Select</option>

										<option value="BOS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "BOS"){ echo ' selected'; } ?>>BOS</option>

										<option value="BARCLAYS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "BARCLAYS"){ echo ' selected'; } ?>>BARCLAYS</option>

										<option value="HALIFAX"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "HALIFAX"){ echo ' selected'; } ?>>HALIFAX</option>

										<option value="LLOYDS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "LLOYDS"){ echo ' selected'; } ?>>LLOYDS</option>

										<option value="NATWEST"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "NATWEST"){ echo ' selected'; } ?>>NATWEST</option>

										<option value="RBS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "RBS"){ echo ' selected'; } ?>>RBS</option>

										<option value="SANTANDER"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "SANTANDER"){ echo ' selected'; } ?>>SANTANDER</option>

										<option value="NATIONWIDE"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "NATIONWIDE"){ echo ' selected'; } ?>>NATIONWIDE</option>

										<option value="HSBC"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "HSBC"){ echo ' selected'; } ?>>HSBC</option>

										<option value="FIRSTDIRECT"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "FIRSTDIRECT"){ echo ' selected'; } ?>>FIRSTDIRECT</option>

										<option value="COOP"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "COOP"){ echo ' selected'; } ?>>COOP</option>

										<option value="OTHER"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "OTHER"){ echo ' selected'; } ?>>OTHER</option>

									</select>

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-sec-pay">

								<label for="bank_start">Account Open Date.

									<input type="text" name="bank_start" id="bank_start" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['bank_start']) && $_SESSION['bank_start'] != ""){ echo date('d-M-Y', $_SESSION['bank_start']); } ?>" />

								</label>

							</div>

						</div>

					</div>

				</div>



				<div class="row margin-bottom-medium applyblock">

					<div class="small-12 columns">

						<h3><i class="fa fa-bar-chart"></i> Monthly Expenditure Information.</h3>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="housing_exp" class="has-gbp">Housing Expenditure.

									<input type="text" name="housing_exp" id="housing_exp" placeholder="0" maxlength="4" value="<?php if(isset($_SESSION['housing_exp']) && $_SESSION['housing_exp'] != ""){ echo $_SESSION['housing_exp']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="utility_exp" class="has-gbp">Utility Outgoings.

									<input type="text" name="utility_exp" id="utility_exp" placeholder="0" maxlength="4" value="<?php if(isset($_SESSION['utility_exp']) && $_SESSION['utility_exp'] != ""){ echo $_SESSION['utility_exp']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="food_exp" class="has-gbp">Food Expenditure.

									<input type="text" name="food_exp" id="food_exp" placeholder="0" maxlength="4" value="<?php if(isset($_SESSION['food_exp']) && $_SESSION['food_exp'] != ""){ echo $_SESSION['food_exp']; } ?>" />

								</label>

							</div>

						</div>

						<div class="row">

							<div class="small-12 medium-4 columns">

								<label for="transport_exp" class="has-gbp">Transport Expenditure.

									<input type="text" name="transport_exp" id="transport_exp" placeholder="0" maxlength="4" value="<?php if(isset($_SESSION['transport_exp']) && $_SESSION['transport_exp'] != ""){ echo $_SESSION['transport_exp']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns">

								<label for="credit_exp" class="has-gbp">Credit Expenditure.

									<input type="text" name="credit_exp" id="credit_exp" placeholder="0" maxlength="4" value="<?php if(isset($_SESSION['credit_exp']) && $_SESSION['credit_exp'] != ""){ echo $_SESSION['credit_exp']; } ?>" />

								</label>

							</div>

							<div class="small-12 medium-4 columns emp-sec-pay">

								<label for="other_exp" class="has-gbp">Other Expenditure.

									<input type="text" name="other_exp" id="other_exp" placeholder="0" maxlength="4" value="<?php if(isset($_SESSION['other_exp']) && $_SESSION['other_exp'] != ""){ echo $_SESSION['other_exp']; } ?>" />

								</label>

							</div>

						</div>

					</div>

				</div>



				<?php

				$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

				if (strpos($url,'extra1') !== false) {

					echo '<div class="row margin-bottom-medium applyblock">

						<div class="small-12 columns">

							<h3><i class="fa fa-bar-chart"></i> Utilities.</h3>

							<div class="row">

								<div class="small-12 medium-4 columns">

									<label for="broadband">Who is your current broadband provider?

										<input type="text" name="broadband" id="broadband" placeholder="Type here" maxlength="50" />						

									</label>

								</div>

								</div>

							

						</div>

					</div>	';

				}





				?>



				<div class="row">

					<div class="small-12 columns">

						<input id="terms" name="terms" value="agree" type="checkbox" style="margin:0;"><label for="terms" style="display:inline;color:#333;">You have read and agreed to our <a href="/terms-and-conditions" target="_blank">terms and conditions</a> and <a href="/privacy-policy" target="_blank">privacy policy</a> and confirm that your income and expenditure information is correct and you have also considered potential future income and outgoings in determining your ability to repay your loan.</label>

						</label>

					</div>

				</div>

				<div class="row">

					<div class="small-12 columns">

						<input id="terms3" name="terms3" value="agree" type="checkbox" style="margin:0;"><label for="terms3" style="display:inline;color:#333;">I am happy for JH Marketing Ltd to send me information by email and SMS about products, services and offers that might be of interest to me (you can unsubscribe at any time).</label>

					</div>

				</div>

				<div class="row margin-bottom-medium">

					<div class="small-12 columns">

						<input id="terms2" name="terms2" value="agree" type="checkbox" style="margin:0;"><label for="terms2" style="display:inline;color:#333;">I agree that JH Marketing Ltd trusted 3rd party partners may contact me by email, phone, SMS or automated messages (you can unsubscribe at any time).</label>

					</div>

				</div>



				<div class="row">

					<div class="small-12 columns">

						<button type="submit" id="register-submit" class="button submit page-apply">Submit Application <i class="fa fa-play"></i></button>

					</div>

				</div>

			</div>

		</div>



	</form>





</div>



<div id="push"></div>

<script src="/js/foundation.min.js"></script>

<script src="/js/bpopup.js"></script>

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="/payday_api<?php $_GET['owner'];?>.js"></script>

<script src="/js/slider.min.js"></script>

<script src="/js/lg.js"></script>

<script>

	$("document, body").on('submit', '#frmLogin', function(e){

		e.preventDefault();



		$("#frmLogin h5").hide();



		$('#frmLogin input[type="submit"]').attr("disabled", "disabled").val("Please wait...");



		$.post('/ajax/proxy_login.php', $(this).serialize(), function(r){

			if(r == 1)

			{

				window.location.href = "/my-account";

			}

			else

			{

				$('#frmLogin input[type="submit"]').removeAttr("disabled").val("Login");

				$("#frmLogin h5").show();

			}

		});

	});

</script>



<script>

	$(document).foundation();

</script>



