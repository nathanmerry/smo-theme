<?php

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
	$GLOBALS['terms_url'] = $cmsCompany['terms_url'];
}

?>

<div id="footer">
	<div class="row">
		<div class="small-12 columns">
			<ul>
				<li><a <?php if ($page == "terms-and-conditions") {
									echo " class=\"active\"";
								} ?> href="http://www.<?php echo $terms_url; ?>/complaints-policy.php">Complaints Policy</a></li>
				<li><a <?php if ($page == "terms-and-conditions") {
									echo " class=\"active\"";
								} ?> href="http://www.<?php echo $terms_url; ?>/tcf.php">Treating Customers Fairly</a></li>
				<li><a <?php if ($page == "terms-and-conditions") {
									echo " class=\"active\"";
								} ?> href="http://www.<?php echo $terms_url; ?>/terms.php">Terms & Conditions</a></li>
				<li><a <?php if ($page == "privacy-policy") {
									echo " class=\"active\"";
								} ?> href="http://www.<?php echo $terms_url; ?>/privacy-policy.php">Privacy Policy</a></li>
				<li><a <?php if ($page == "privacy-policy") {
									echo " class=\"active\"";
								} ?> href="http://www.<?php echo $terms_url; ?>/cookies-policy.php">Cookies Policy</a></li>
				<li><a <?php if ($page == "privacy-policy") {
									echo " class=\"active\"";
								} ?> href="https://st0p.uk">Opt Out</a></li>
				<li><a <?php if ($page == "contact-us") {
									echo " class=\"active\"";
								} ?> href="/contact-us">Contact Us</a></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<strong>Copyright <?php echo date('Y'); ?> <?php echo $Website_Address; ?>. All rights reserved.</strong>
			<p class="smaller">
				<span style="font-size:20px;">
					<?php echo $rep_example; ?> <br><br>
					<?php echo $Website_Address; ?> is a registered trading name of <?php echo $company_name; ?> registered in England and Wales (Company number <?php echo $company_number; ?>). <?php echo $company_name; ?> registered office; <?php echo $company_address; ?>. <?php echo $company_name; ?> is authorized and regulated by the Financial Conduct Authority and entered on is the Consumer Credit Register under reference number: <?php echo $fca_number; ?>. Licensed by the Information Commissioners Office, (registration number <?php echo $ico_number; ?>). <br><br>
					<?php echo $legal; ?>

				</span></p>

		</div>
	</div>
</div>
<script>
	(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

	ga('create', '<?php echo $ga_id; ?>', 'auto');
	ga('send', 'pageview');
</script>