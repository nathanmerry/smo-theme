    <div id="warning-line" class="legal-banner">    <p id="text">   <center> <strong>Warning:</strong> Late repayment can cause you serious money problems. For help and advice go to <a href="http://www.moneyadviceservice.org.uk" target="_blank" rel="nofollow" style="color:#fff;">moneyadviceservice.org.uk</a></center></p>
   <p style="color:#fff;">We are aware of a scam circulating. BabyLoans.co.uk do not charge any fees to customers. Please be aware of suspicious phone calls from anyone claiming to be from BabyLoans.co.uk.</p>
    </div>

<?php ?>

<div class="contain-to-grid <?php if($body_class != "home"){echo"not_home";}?>">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<a href="/"><img src="<?php $logo = new cmsSMO(); echo $logo->getLogo() ?>" alt="Lily Loans" width="170" style="margin-top:9px;" /></a>
			</li>
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
		</ul>

		<section class="top-bar-section">
			<ul class="left">
				<li><a <?php if($page == "home"){echo" class=\"active\"";} ?> href="/">Home</a></li>
				<li><a <?php if($page == "how-it-works"){echo" class=\"active\"";} ?> href="/how-it-works">How It Works</a></li>				
				<li><a <?php if($page == "faq"){echo" class=\"active\"";} ?> href="/faq">FAQ's</a></li>
		    	<li><a <?php if($page == "scams"){echo" class=\"active\"";} ?> href="/scams">Loan Scams</a></li>
		    		<li><a <?php if($page == "opt-out"){echo" class=\"active\"";} ?> href="/opt-out">Opt Out</a></li>
				<!--<?php
					if($loggedin){ echo '<li><a href="/my-account" class="">My Account</a></li>'; }
					else { echo '<li><a href="#" class="" data-reveal-id="modal-login">Sign In</a></li>'; }
				?>
				-->
				<li><a href="/apply" class="highlight hide-for-medium-up">Apply Now</a></li>
			</ul>			
			<ul class="right">
				<?php
				//	if($loggedin){ echo '<li><a href="/my-account" class="button signin  show-for-medium-up">My Account</a></li>'; }
				//	else { echo '<li><a href="#" id="been_here_before" class="show-for-medium-up" data-reveal-id="modal-login">Been here before?</a></li>'; }
				?>							
				<li><a href="/apply" class="button applynow show-for-medium-up">Get Loan</a></li>
			</ul>
			 
		</section>
	</nav>	
</div>
<?php 
	if($page != "apply")
	{
	?>
	<div id="mobile-cta">
		<div class="row">
			<div class="small-12 columns">
				<span>Get an instant decision today:</span>
				<a href="/apply" class="button submit">Get Loan</a>
			</div>
		</div>
	</div>	
	<?php
	}
?>