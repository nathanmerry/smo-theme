<?php
	require './globals.php';

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

	require_once('api.php');

    $api = new Portal();
	
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

	$page = "home";
		if(isset($_GET['page'])){ $page = $_GET['page']; }
	
	// Create a title and set body class.
	switch($page)
	{
		case "home":
			$body_class = "home";
			$title = "Payday Loans";
			break;		
		case "how-it-works":
			$body_class = "inner";
			$title = "How it Works | Pinky Loans";
			break;	
		case "faq":
			$body_class = "inner";
			$title = "Frequently Asked Questions | Pinky Loans";
			break;
		case "help-and-advice":
			$body_class = "inner";
			$title = "Help & Advice | Pinky Loans";
			break;
		case "contact-us":
			$body_class = "inner";
			$title = "Contact Us | Pinky Loans";
			break;			
		case "terms-and-conditions":
			$body_class = "inner";
			$title = "Terms & Conditions | Pinky Loans";
			break;
		case "privacy-policy":
			$body_class = "inner";
			$title = "Privacy Policy | Pinky Loans";
			break;	
		case "apply":
			$body_class = "inner";
			$title = "Apply Now | Pinky Loans";
			break;	
		case "my-account":
			$body_class = "inner";
			$title = "My Account | Pinky Loans";
			break;		
		case "settings":
			$body_class = "inner";
			$title = "Account Settings | Pinky Loans";
			break;			
		default:
			$title = "Meet The Giant | Pinky Loans";
	}

	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$newTrackingLInk = false;
	if ($_GET && preg_match('/[?](a|b|d|s|e|o|aff)[0-9]+/', $actual_link, $matches)) {
		$trackingCode = str_replace('?', '', $matches[0]);
		$newTrackingLInk = $_SESSION['tracking_code'] != $trackingCode;
		$_SESSION['tracking_code'] = $trackingCode;
	}

	if ($_GET && $trackingCode = $_SESSION['tracking_code']) {
		$newTrackingLInk = $_SESSION['tracking_code'] != $trackingCode;
		$_SESSION['tracking_code'] = $trackingCode;
	}

	$owner = !empty($_GET['owner'])?$_GET['owner']:'BABY';

    $isSmsBot = false;

    if($trackingCode && strtolower($trackingCode[0]) == 's' && strpos($_SERVER['HTTP_USER_AGENT'], "Ubuntu") !== false){
        $isSmsBot = true;

    }
    if(!$isSmsBot && !$api->isBot($_SERVER['HTTP_USER_AGENT'])){

        if (!isset($_SESSION['visitor']) || $_SESSION['visitor'] != $owner || $newTrackingLInk) {
            //Information

	        $data = [
	            'owner' => $owner,
	            'short_url' => !empty($_SESSION['auto_key'])?$_SESSION['auto_key']:!empty($_GET['k'])?$_GET['k']:'',
				'tracking_code' => $_SESSION['tracking_code'],
				'pageUrl' => $actual_link,
				'ip' => get_ip_address(),
				'userAgent' => substr($_SERVER['HTTP_USER_AGENT'],0,200),
				'date' => date('Y-m-d H:i:s'),
			];


			$visit_api = 'api/api/add-visit';

	        $api->requestApi($visit_api, $data);

			$_SESSION['visitor'] = $owner;
		}
	
	}
	// Authorisation.
	if(
		$page == "history" ||
		$page == "settings" || 
		$page == "my-account"
	)	
	{
		if(!$loggedin){ header('Location: /'); }
	}
	require './Controller/Page.php';

	$cmsPage = new Page();
	$cmsError = 'Something went wrong';
	$GLOBALS['how_it_works'] = $cmsPage->get('how-it-works') ?? $cmsError;
	$GLOBALS['faq'] = $cmsPage->get('faq') ?? $cmsError;
	$GLOBALS['faq'] = $cmsPage->get('faq') ?? $cmsError;
	$GLOBALS['scams'] = $cmsPage->get('scams') ?? $cmsError;
	

	$info_url = 'api/api/get-info';
	
	$body = $api->requestApi($info_url, array('id'=>1));
	
	$json = json_decode($body);
	
	if($json->success) {
		// $GLOBALS['faq'] = $json->faq;

		$GLOBALS['rapr'] = $json->apr;
		$GLOBALS['max_lt'] = $json->max_lt;
		$GLOBALS['min_lt'] = $json->min_lt;
		$GLOBALS['min_la'] = $json->min_la;
		$GLOBALS['max_la'] = $json->max_la;
		$GLOBALS['interestrates'] = $json->interestrates;
		$GLOBALS['increments'] = $json->increments;
		$GLOBALS['legal'] = $json->legal;
		$GLOBALS['terms'] = $json->terms;
		$GLOBALS['privacy'] = $json->privacy;
		$GLOBALS['rep_example'] = $json->rep_example;
		$GLOBALS['Warning'] = $json->Warning;
		$GLOBALS['company_name'] = $json->company_name;
		$GLOBALS['company_address'] = $json->company_address;
		$GLOBALS['company_number'] = $json->company_number;
		$GLOBALS['fca_number'] = $json->fca_number;
		$GLOBALS['ico_number'] = $json->ico_number;
		$GLOBALS['homepage_legal_block'] = $json->homepage_legal_block;
		$GLOBALS['home_step_one'] = $json->home_step_one;
		$GLOBALS['home_step_two'] = $json->home_step_two;
		$GLOBALS['home_step_three'] = $json->home_step_three;
		$GLOBALS['home_ctas'] = $json->home_ctas;
		$GLOBALS['terms_url'] = $json->terms_url;
	}

?>

<?php
$cmsSmo = new cmsSMO();
$cmsSmoConn = $cmsSmo->sqlQuery();

$sql = "SELECT * FROM website WHERE id=" . $cmsSmo->websiteID;
$result = $cmsSmoConn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { 
			$GLOBALS['h1c'] = $row["h1c"]; 
			$GLOBALS['Button_Colour'] = $row["button_colour"]; 
     $GLOBALS['Button_Colour_Border'] = $row["button_colour_border"]; 
     $GLOBALS['Header_Colour'] = $row["header_colour"]; 
     $GLOBALS['Warning_Block'] = $row["warning_block"]; 
     $GLOBALS['Website_Address'] = $row["website_address"]; 
     $GLOBALS['Homepage_Block_Colour'] = $row["homepage_block_colour"]; 
     $GLOBALS['Footer_Background_Colour'] = $row["footer_background_colour"]; 
     $GLOBALS['Footer_Font_Colour'] = $row["footer_font_colour"]; 
     $GLOBALS['Header_Font_Colour'] = $row["header_font_colour"]; 
     $GLOBALS['Header_Font_Colour_Hover'] = $row["header_font_colour_hover"]; 
     $GLOBALS['Homepage_Heading_Colour'] = $row["homepage_heading_colour"]; 
     $GLOBALS['Homepage_Reasons_Colour'] = $row["homepage_reasons_colour"]; 
     $GLOBALS['Homepage_Block_Border'] = $row["homepage_block_border"]; 
     $GLOBALS['Home_CTA_One'] = $row["home_cta_one"]; 
     $GLOBALS['Home_CTA_Two'] = $row["home_cta_two"]; 
     $GLOBALS['Home_CTA_Three'] = $row["home_cta_three"]; 
     $GLOBALS['Home_Image_One'] = $row["home_image_one"]; 
     $GLOBALS['Home_Image_Two'] = $row["home_image_two"]; 
		 $GLOBALS['Home_Image_Three'] = $row["home_image_three"];
		 $GLOBALS['Website_Short_Address'] = $row["website_short_address"]; 
        ?>
   <?php }
} else {
    echo "results";
}

?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php require_once 'includes/head.php'; ?>
	</head>
	<body class="page-<?php echo $body_class; if(!$loggedin){ echo ' notlogged'; } ?>">


	<div id="wrapper">
			<?php require_once 'includes/topbar.php'; ?>
	
			<?php 
			require_once 'includes/pages/' . $page . '.php'; 
			?>
		</div>	
 
		<div style="display: none">
			<?php if(isset($GLOBALS['min_la']) && isset($GLOBALS['max_la']) && isset($GLOBALS['interestrates'])) { ?>
			<input id="Min_la" type="hidden" value="<?php echo$GLOBALS['min_la']; ?>" />
			<input id="Max_la" type="hidden" value="<?php echo $GLOBALS['max_la']; ?>" />
			<input id="interestrates" type="hidden" value="<?php echo $GLOBALS['interestrates']; ?>" />

			<?php } ?>
		</div>
		<?php require_once 'includes/footer.php'; ?>
		<div id="waitPopUp" style="height:200px;background:#fff;margin-left:auto;margin-right:auto;border-radius:5px;text-align:center;display:none;">
			<div style="padding:30px;text-align:center;font-size:30px;color:#ff5400;">
				Your application is being processed...
			</div>
			<div style="width:100%;text-align:center;">
				
				<div class="meter animate orange" style="width:360px;display:inline-block;">
					<span style="width: 0%"><span></span></span>
				</div>
				<div id="pb_percent" style="display:inline-block;padding-left:10px;font-size:27px; font-family: 'Lato',sans-serif;color:#ff5400;">0%</div>
				<center>
				<span style="font-size:12px;">Please be patient as this process will take a few minutes.</span>
				</center>			
			</div>
		</div>		
		<div id="modal-login" class="reveal-modal tiny" data-reveal>
			
			<form name="frmLogin" id="frmLogin" method="post" action="#" class="margin-bottom-30">
				<input name="login_owner" value="GIANT" type="hidden">
				<input name="login_ip" value="<?php echo get_ip_address(); ?>" type="hidden">
				<input id="login_user_agent" name="login_user_agent" value="<?php echo substr($_SERVER['HTTP_USER_AGENT'],0,200); ?>" type="hidden">
				<div class="row">
					<div class="small-12 columns">
						<label for="login_email">Email address
							<input type="email" name="login_email" id="login_email" placeholder="Email address">
						</label>
					</div>
					<div class="small-12 columns">
						<label for="login_password">Password
							<input type="password" name="login_password" id="login_password" placeholder="Password">
						</label>				
					</div>
					<div class="small-12 columns">
						<input type="submit" class="button submit signin" value="Login">
						<center><a href="/forgot-password">Forgoten your password?</a><br>
						Don't have an account? <a href="/forgot-password">Sign up here</a></center>
						<h5 style="display:none;color:#ff0000;margin-top:10px;">The login credentials you entered were invalid, please check and try again.</h5>
					</div>
				</div>
			</form>
		<a class="close-reveal-modal">&#215;</a>
		</div>	
		<script src="/js/foundation.min.js"></script>
		<script src="/js/bpopup.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
		<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<?php
		
			if($page == "settings"){ echo '<script src="/payday_api_update_details.js"></script>'; }
			else { echo '<script src="/payday_api.js"></script>'; }
		
		?>
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
	</body>
</html>