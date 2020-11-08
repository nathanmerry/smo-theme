<?php
include('api.php');

$api = new Portal();


if (isset($_SERVER['QUERY_STRING'])) {
	if (!isset($_SESSION)) {
		session_start();
	}

	// Autologin
	if (substr($_SERVER['QUERY_STRING'], 0, 2) == "k=") {
		$_SESSION['remarketing'] = 1;
		$key = explode("=", $_SERVER['QUERY_STRING']);
		$key = $key[1];
		$_SESSION['auto_key'] = $key;
		die(header('Location: /get-loan'));
	}
}

// Detect login status.
$loggedin = false;
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1) {
	$loggedin = true;
}

// Create mobile detection object.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

// IP detection functions.
function validate_ip($ip)
{
	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
		return false;
	}
	return true;
}

function get_ip_address()
{
	$ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
	foreach ($ip_keys as $key) {
		if (array_key_exists($key, $_SERVER) === true) {
			foreach (explode(',', $_SERVER[$key]) as $ip) {
				$ip = trim($ip);
				if (validate_ip($ip)) {
					return $ip;
				}
			}
		}
	}
	return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}

$page = "home";
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}

// Create a title and set body class.
switch ($page) {
	case "home":
		$body_class = "home";
		$title = "Payday Loans | Quick Instant Loans By LoanParamount.com";
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
$trackingCode = '';
if ($_GET && preg_match('/[?](a|b|d|s|e|o|aff)[0-9]+/', $actual_link, $matches)) {
	$trackingCode = str_replace('?', '', $matches[0]);
	$newTrackingLInk = $_SESSION['tracking_code'] != $trackingCode;
	$_SESSION['tracking_code'] = $trackingCode;
}

if ($_GET && $trackingCode = $_SESSION['tracking_code']) {
	$newTrackingLInk = $_SESSION['tracking_code'] != $trackingCode;
	$_SESSION['tracking_code'] = $trackingCode;
}

$sites = array(
	'BLUE' => 1,
	'SWISH' => 2,
	'VIVA' => 3,
	'HP' => 4,
	'JUNGLE' => 5,
	'PINKY' => 6,
	'VML' => 9,
	'MRPAY' => 15,

	'SHUTTLE' => 32
);

if (isset($_GET['owner']) && isset($sites[$_GET['owner']])) {
	$site_id = $sites[$_GET['owner']];
} else {
	$site_id = 15;
}

if (!$_SESSION['visitor'] || $_SESSION['visitor'] != $site_id || $newTrackingLInk) {
	//Information

	$data = [
		'site_id' => $site_id,
		'tracking_code' => $_SESSION['tracking_code'],
		'pageUrl' => $actual_link,
		'ip' => get_ip_address(),
		'userAgent' => substr($_SERVER['HTTP_USER_AGENT'], 0, 200),
		'date' => date('Y-m-d H:i:s'),
	];

	$visit_api = 'api/api/add-visit';

	$api->requestApi($visit_api, $data);

	$_SESSION['visitor'] = $site_id;
}

// Authorisation.
if (
	$page == "history" ||
	$page == "settings" ||
	$page == "my-account"
) {
	if (!$loggedin) {
		header('Location: /');
	}
}

require './globals.php';
$cmsSmo = new cmsSMO();
$cmsSmoConn = $cmsSmo->sqlQuery();

$sql = "SELECT * FROM website WHERE id=" . $cmsSmo->websiteID;
$result = $cmsSmoConn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$GLOBALS['h1c'] = $row["h1c"] ?? null;
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


require './Controller/Company.php';

$cmsCompany = new Company();
$cmsCompany = $cmsCompany->get();


if ($cmsCompany) {

	$GLOBALS['rapr'] = $cmsCompany['apr'];
	$GLOBALS['max_lt'] = $cmsCompany['max_lt'];
	$GLOBALS['min_lt'] = $cmsCompany['min_lt'];
	$GLOBALS['min_la'] = $cmsCompany['min_la'];
	$GLOBALS['max_la'] = $cmsCompany['max_la'];
	$GLOBALS['interestrates'] = $cmsCompany['interestrates'];
	$GLOBALS['increments'] = $cmsCompany['increments'];
	$GLOBALS['legal'] = $cmsCompany['legal'];
	$GLOBALS['terms'] = $cmsCompany['terms'];
	$GLOBALS['privacy'] = $cmsCompany['privacy'] ?? null;
	$GLOBALS['rep_example'] = $cmsCompany['rep_example'];
	$GLOBALS['Warning'] = $cmsCompany['Warning'];
	$GLOBALS['company_name'] = $cmsCompany['company_name'];
	$GLOBALS['company_address'] = $cmsCompany['company_address'];
	$GLOBALS['company_number'] = $cmsCompany['company_number'];
	$GLOBALS['fca_number'] = $cmsCompany['fca_number'];
	$GLOBALS['ico_number'] = $cmsCompany['ico_number'];
	$GLOBALS['homepage_legal_block'] = $cmsCompany['homepage_legal_block'];
	$GLOBALS['home_step_one'] = $cmsCompany['home_step_one'];
	$GLOBALS['home_step_two'] = $cmsCompany['home_step_two'];
	$GLOBALS['home_step_three'] = $cmsCompany['home_step_three'];
	$GLOBALS['home_ctas'] = $cmsCompany['home_ctas'];
}

?>

<?php

$errors = array();

$alerts = array();

if (!empty($_POST['submit'])) {

	if (!empty($_POST['mobile_number']) && !empty($_POST['post_code'])) {

		$un_subscribe_api = 'api/api/un-subscribe';
		$res = $api->requestApi($un_subscribe_api, array(
			'mobile_number' => $_POST['mobile_number'],
			'post_code' => $_POST['post_code'],
			'tracking_code' => $trackingCode,
			'site_id' => $sites['PINKY']
		));

		$json = json_decode($res);

		if ($json && !empty($json->success) && $json->success) {
			$alerts['success'] = 'Unsubscribe successfully!';
		} else {
			$alerts['error'] = 'Unsubscribe failed!';
		}
	} else {
		if (empty($_POST['mobile_number']) || !$_POST['mobile_number']) {
			$errors['mobile_number'] = 'Mobile number can not be blank!';
		}

		if (empty($_POST['post_code']) || !$_POST['post_code']) {
			$errors['post_code'] = 'Post code can not be blank!';
		}
	}
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<?php require_once 'includes/head.php'; ?>
</head>

<body>


	<div id="wrapper" style="min-height: 170px;">
		<?php include 'includes/topbar.php'; ?>
	</div>
	<form class="register" id="opt-out-form" action="" method="post">

		<?php if (!empty($alerts['success'])) { ?>
			<div class="row">
				<div class="alert success-box" style="color: #fff; font-size: 30px; display: block">
					<?php echo $alerts['success']; ?>
				</div>
			</div>
		<?php } else if (!empty($alerts['error'])) { ?>
			<div class="row">
				<div class="alert error-box" style="color: #fff; font-size: 30px; display: block">
					<?php echo $alerts['error']; ?>
				</div>
			</div>
		<?php } ?>
		<div class="row">
			<h1>Opt Out of Marketing</h1>
		</div>
		<div class="row">
			<iframe src="https://st0p.uk/stop.php" width="100%" height="700px" border="0px" style="border:0px;"></iframe>
		</div>
		</div>


		<?php require_once 'includes/footer.php'; ?>

		<div id="modal-login" class="reveal-modal tiny" data-reveal>

			<form name="frmLogin" id="frmLogin" method="post" action="#" class="margin-bottom-30">
				<input name="login_owner" value="GIANT" type="hidden">
				<input name="login_ip" value="<?php echo get_ip_address(); ?>" type="hidden">
				<input id="login_user_agent" name="login_user_agent" value="<?php echo substr($_SERVER['HTTP_USER_AGENT'], 0, 200); ?>" type="hidden">
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
		<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="/js/slider.min.js"></script>
		<script>
			$("document, body").on('submit', '#frmLogin', function(e) {
				e.preventDefault();

				$("#frmLogin h5").hide();

				$('#frmLogin input[type="submit"]').attr("disabled", "disabled").val("Please wait...");

				$.post('/ajax/proxy_login.php', $(this).serialize(), function(r) {
					if (r == 1) {
						window.location.href = "/my-account";
					} else {
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