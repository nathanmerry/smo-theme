<?php
if(!isset($_SESSION)){ session_start(); }

    require_once('api.php');

    $api = new Portal();

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

    $domain = 'https://www.cmlo.uk';

	$info_url = 'get-info';

	$res = $api->requestApi($info_url, array('id'=>1));

	$json = json_decode($res);

	if($json->success) {

		$GLOBALS['rapr'] = $json->apr;
		$GLOBALS['max_lt'] = $json->max_lt;
		$GLOBALS['min_lt'] = $json->min_lt;
		$GLOBALS['min_la'] = $json->min_la;
		$GLOBALS['max_la'] = $json->max_la;
		$GLOBALS['interestrates'] = $json->interestrates;
		$GLOBALS['increments'] = $json->increments;
		$GLOBALS['legal'] = $json->legal;
		$GLOBALS['how_it_works'] = $json->how_it_works;
		$GLOBALS['faq'] = $json->faq;
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
		$GLOBALS['terms_url'] = $json->terms_url;
	}



    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $trackingCode = '';
    $newTrackingLInk = false;
    if ($_GET && preg_match('/[?](a|b|d|s|e|o|aff)[0-9]+/', $actual_link, $matches)) {
        $trackingCode = str_replace('?', '', $matches[0]);
        $newTrackingLInk = $_SESSION['tracking_code'] != $trackingCode;
        $_SESSION['tracking_code'] = $trackingCode;
    }

    $owner = !empty($_GET['owner'])?$_GET['owner']:'BABY';

    $short_url = !empty($_SESSION['auto_key'])?$_SESSION['auto_key']:!empty($_GET['k'])?$_GET['k']:'';

    
    if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']){

     $urlIframe = $domain . $_SERVER['REQUEST_URI'];

     if(!isset($_GET['owner'])){
        $urlIframe = $urlIframe . "&owner=" . $owner;
     }

    }else{
        $urlIframe =  $domain . "?owner=" . $owner;
    }

    $isSmsBot = false;

    if($trackingCode && strtolower($trackingCode[0]) == 's' && strpos($_SERVER['HTTP_USER_AGENT'], "Ubuntu") !== false){
        $isSmsBot = true;

    }
    if(!$isSmsBot && !$api->isBot($_SERVER['HTTP_USER_AGENT'])){

        if (!$_SESSION['visitor'] || $_SESSION['visitor'] != $owner || $newTrackingLInk) {
            //Information

            $data = [
                'owner' => $owner,
                'short_url' => $short_url,
                'tracking_code' => $trackingCode,
                'pageUrl' => $actual_link,
                'ip' => get_ip_address(),
                'userAgent' => substr($_SERVER['HTTP_USER_AGENT'],0,200),
                'date' => date('Y-m-d H:i:s'),
            ];

            $visit_api = 'add-visit';

            $api->requestApi($visit_api, $data);

            $_SESSION['visitor'] = $owner;
        }
    }    

?>
<?php

/*$dbServerName = "vmo1.co.uk";
$dbUsername = "vmo1co_sam";
$dbPassword = "gambling911";
$dbName = "vmo1co_co";
*/
$dbServerName = "127.0.0.1";
$dbUsername = "terms13_dan";
$dbPassword = "TuC2oDQ@9LV9";
$dbName = "terms13_cmlo";

// create connection
$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Websites WHERE id=50";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { 
      /*  echo "Min_la: " . $row["min_la"]. " - Max_la: " . $row["max_la"]. 
        "Max_lt " . $row["max_lt"]. "Min_lt " . $row["min_lt"]."apr " . $row["apr"]."legal " . $row["legal"] ."repexample " . $row["rep_example"]  ;*/
       
     $GLOBALS['h1c'] = $row["h1c"]; 
     $GLOBALS['Button_Colour'] = $row["Button_Colour"]; 
     $GLOBALS['Button_Colour_Border'] = $row["Button_Colour_Border"]; 
     $GLOBALS['Header_Colour'] = $row["Header_Colour"]; 
     $GLOBALS['Warning_Block'] = $row["Warning_Block"]; 
     $GLOBALS['Website_Address'] = $row["Website_Address"]; 
     $GLOBALS['Homepage_Block_Colour'] = $row["Homepage_Block_Colour"]; 
     $GLOBALS['Footer_Background_Colour'] = $row["Footer_Background_Colour"]; 
     $GLOBALS['Footer_Font_Colour'] = $row["Footer_Font_Colour"]; 
     $GLOBALS['Header_Font_Colour'] = $row["Header_Font_Colour"]; 
     $GLOBALS['Header_Font_Colour_Hover'] = $row["Header_Font_Colour_Hover"]; 
     $GLOBALS['Homepage_Heading_Colour'] = $row["Homepage_Heading_Colour"]; 
     $GLOBALS['Homepage_Reasons_Colour'] = $row["Homepage_Reasons_Colour"]; 
     $GLOBALS['Homepage_Block_Border'] = $row["Homepage_Block_Border"]; 
     $GLOBALS['Home_CTA_One'] = $row["Home_CTA_One"]; 
     $GLOBALS['Home_CTA_Two'] = $row["Home_CTA_Two"]; 
     $GLOBALS['Home_Image_One'] = $row["Home_Image_One"]; 
     $GLOBALS['Home_Image_Two'] = $row["Home_Image_Two"]; 
     $GLOBALS['Home_Image_Three'] = $row["Home_Image_Three"]; 
        ?>
   <?php }
} else {
    echo "results";
}

?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Baby Loans</title>
<link rel="stylesheet" href="/css/foundation.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway:600,700,800,400,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/theme.php" />
<link rel="stylesheet" href="/css/slider.css" />
<link rel="stylesheet" href="/css/pb.css" />
<link rel="stylesheet" href="/css/jqueryui.css" />
<script src="/js/vendor/modernizr.js"></script>
<script src="/js/vendor/jquery.js"></script>
<link rel="apple-touch-icon" sizes="57x57" href="/img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">	</head>
<body>
<script type="text/javascript" src="js/vendor/jquery.js"></script>
<script type="text/javascript">
	window.addEventListener('message', function (e) {

		var iframe = $("#cmloIframe");
		var eventName = e.data[0];
		var data = e.data[1];
		switch (eventName) {

			case 'setHeight':
				console.log('recieved setHeight' + data);
				iframe.css({"height": data + 'px'});
				break;

			case 'goUp':
				$('body').scrollTop(0);
				break;
		}
	}, false);


	$(document).ready(function () {

		var domain = '<?php echo $domain; ?>';
		var iframe = document.getElementById('cmloIframe').contentWindow;

		setInterval(function(){
			var message = 'getHeight';
			iframe.postMessage(message,domain);
		},6000);

	});
</script>
    <div id="warning-line" class="legal-banner">    <p id="text">   <center> <strong>Warning:</strong> Late repayment can cause you serious money problems. For help and advice go to <a href="http://www.moneyadviceservice.org.uk" target="_blank" rel="nofollow" style="color:#fff;">moneyadviceservice.org.uk</a></center></p></div>

<div class="contain-to-grid <?php if($body_class != "home"){echo"not_home";}?>">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<a href="#"><img src="/img/logo.png" alt="Logo" width="150" /></a>
			</li>
		</ul>

	
	</nav>	
</div>
<div id="main">
	<div class="row" style="max-width:100% !important;">
		<!--<div class="small-12 medium-4 medium-push-8 columns">
		</div>	-->
			<iframe id="cmloIframe" frameborder="0" scrolling="no" style="display: block;  border: none; width: 100%; height: 500px;" src="<?php echo $urlIframe; ?>"></iframe>
	</div>
</div>
	
<div id="footer" style="background:#fff; color:#333;">
	
	<div class="row">
		<div class="small-12 columns">
			<p class="smaller" style="color:#333;">
<span style="font-size:20px; color:#333;">
<br><br><?php echo $rep_example ; ?>
			<?php echo $Footer_Text ; ?> <br><br>
			*subject to lenders requirement and approval<br><br>
<?php echo $Website_Address ; ?> is a registered trading name of <?php echo $company_name ; ?> registered in England and Wales (Company number <?php echo $company_number ; ?>). <?php echo $company_name ; ?> registered office; <?php echo $company_address ; ?>. <?php echo $company_name ; ?> is authorized and regulated by the Financial Conduct Authority and entered on is the Consumer Credit Register under reference number: <?php echo $fca_number ; ?>. Licensed by the Information Commissioners Office, (registration number <?php echo $ico_number ; ?>). <br><br>
<?php echo $legal ; ?>

</span></p>

		</div>
	</div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $ga_id ; ?>', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
