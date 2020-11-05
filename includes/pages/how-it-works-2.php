<div id="main">

	<div class="row">
		<div class="small-12 columns">
			<h1>How It Works</h1>
			<h2>Understanding how <?php include 'php/name.php' ?> works couldn't be easier. In just 3 simple steps, your loan could be 15 minutes away.</h2>
		</div>
	</div>
	
	<div class="row">
	
		<div class="small-12 medium-8 columns">
	
<?php

$urlPlusKey = $_SERVER['REQUEST_URI'];
$urlArray = explode('?', $urlPlusKey); // array(Code, LT1234)
$param = end($urlArray);
$codeIf = prev($urlArray);

if ($codeIf == 'Code') {
$key = $param;
} else {
$key = 'null';
}
echo $key;
?>


<iframe src="http://www.prlo.uk/<?php echo '' . htmlspecialchars($_GET["code"]) . '';?>"></iframe>
			<div class="row margin-bottom-medium">
				<div class="small-12 medium-3 large-2 columns text-center">
					<img src="/img/hiw-select.png" alt="Select amount" />
				</div>
				<div class="small-12 medium-9 large-10 columns">
					<h3>Select Your Loan Amount &amp; Term</h3>
					<p>
						First and formost, you must select how much you need to borrow and for how long. <?php include 'php/name.php' ?> allows you to borrow for <?php include 'php/amounts.php' ?> Please ensure you are comfortable repaying the interest, no additional fees are added unless you fail to repay your loan on your repayment date. Once you are happy, please click Apply Now.
					</p>
				</div>
			</div>
			
			<div class="row">
				<div class="small-12 medium-3 large-2 columns text-center">
					<img src="/img/hiw-app.png" alt="Begin application" />
				</div>
				<div class="small-12 medium-9 large-10 columns">
					<h3>Complete Our Secure Application</h3>
					<p>
						Our application form takes just 5 minutes to complete, and we only ask for the details we need. All information transmitted on <?php include 'php/name.php' ?> uses a secure 256-bit connection and is used to determine your loan decision. 
					</p>
					<p>
						Decisions are made within a flash and all applications are thoroughly checked for fraud using state of the art technology.
					</p>				
				</div>
			</div>		
						
			<br>

		
			<div class="row">
				<div class="small-12 medium-3 large-2 columns text-center">
					<img src="/img/hiw-mail.png" alt="Get your response" />
				</div>
				<div class="small-12 medium-9 large-10 columns">
					<h3>If Approved, Recieve Within 15 Minutes</h3>
					<p>
						Your application will now be processed on-screen. This will take 30-60 seconds however in certain cases your decision will take longer, please be patient and never cross off the window as this may harm your decision.
					</p>
					<p>
						<strong>If you are approved by one of the lenders in our panel, you can now arrange the payout of your loan. If you are declined you will have the option to use another broker.</strong>
					</p>				
				</div>
			</div>
		
		</div>
		
		<div class="small-12 medium-4 columns">
			<?php require_once dirname(dirname(__FILE__)) . '/sidebar.php'; ?>
		</div>
		
	</div>
	
</div>

<div id="push"></div>
