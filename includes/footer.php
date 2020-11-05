<?php

	$curl = curl_init();

	$info_url = 'https://portal.seasonmarketing.co.uk/api/api/get-info';

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, $info_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		'secret' => 'CH5RQ7kOvPMwkNnPwEkQoQtNe7wjyisoJxNy0lt2oy7cFEcXJPWbghbr6mcrDxg8qmgAGODUGQCxTpvAZcDLPVzMimfJU6q1wyjA',
		'data' => array('id'=>1))));
	curl_setopt($curl, CURLOPT_HEADER, 1);

	// Send the request
	$result = curl_exec($curl);

	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$body = substr($result, $header_size);


	curl_close($curl);


	$json = json_decode($body);

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
		$GLOBALS['home_step_one'] = $json->home_step_one;
		$GLOBALS['home_step_two'] = $json->home_step_two;
		$GLOBALS['home_step_three'] = $json->home_step_three;
		$GLOBALS['home_ctas'] = $json->home_ctas;
		$GLOBALS['terms_url'] = $json->terms_url;
	}

?>

<div id="footer">
	<div class="row">
		<div class="small-12 columns">
			<ul>
				<li><a <?php if($page == "terms-and-conditions"){echo" class=\"active\"";} ?> href="http://www.<?php echo $terms_url ; ?>/complaints-policy.php">Complaints Policy</a></li>
				<li><a <?php if($page == "terms-and-conditions"){echo" class=\"active\"";} ?> href="http://www.<?php echo $terms_url ; ?>/tcf.php">Treating Customers Fairly</a></li>
				<li><a <?php if($page == "terms-and-conditions"){echo" class=\"active\"";} ?> href="http://www.<?php echo $terms_url ; ?>/terms.php">Terms & Conditions</a></li>
				<li><a <?php if($page == "privacy-policy"){echo" class=\"active\"";} ?> href="http://www.<?php echo $terms_url ; ?>/privacy-policy.php">Privacy Policy</a></li>
				<li><a <?php if($page == "privacy-policy"){echo" class=\"active\"";} ?> href="http://www.<?php echo $terms_url ; ?>/cookies-policy.php">Cookies Policy</a></li>
<li><a <?php if($page == "privacy-policy"){echo" class=\"active\"";} ?> href="https://st0p.uk">Opt Out</a></li>
				<li><a <?php if($page == "contact-us"){echo" class=\"active\"";} ?> href="/contact-us">Contact Us</a></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<strong>Copyright <?php echo date('Y'); ?> <?php echo $Website_Address ; ?>. All rights reserved.</strong>
			<p class="smaller">
<span style="font-size:20px;">	
<?php echo $rep_example ; ?>	<br><br>	
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