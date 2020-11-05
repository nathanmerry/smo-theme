
<div id="main" class="home">
	<div id="home_page_intro">
	<div class="row">
		<div class="small-12 medium-6 columns">
		<?php $time= date("H:i");
$time = date('H:i', strtotime($time.'+15 minutes'));
?>
			<h1>Loans Online.</h1>
			</div>
			</div>
			
			<div class="row">
		<div class="small-12 medium-6 columns">
			
            <h3 class="light"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $Home_CTA_One ; ?></h3>
			<h3 class="light"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $Home_CTA_Two ; ?></h3>
			<h3 class="light"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $Home_CTA_Three ; ?></h3>
			
		<div id="late_repayment" class="show-for-medium-up">
		<div class="row">
			<div class="small-12 column">
				<p><span><?php echo $rep_example;?></span></p>
				<p><span><b>We are a licensed credit broker, not a lender.</b></span></p>
			</div>
		</div>	
		</div>	
		</div>
	
	
					<div class="small-12 medium-6 columns end">	
						<div class="panel">

					<div class="row">
					
			<div class="small-12 medium-12 columns">
						<label for="loan-amount-mobile">Loan Amount
			<select name="loan_amount" id="loan-amount-mobile">
				<option value="">Please select...</option>
				<?php


					
					for($i = $min_la; $i <= $max_la; $i += $increments)
					{
						echo '<option value="' . $i . '" selected'; if($i == $query['min_la']){ echo ' selected'; } echo '>&pound;' . $i . '</option>';
					}
				
				?>
			</select>
		</label>
						</div>
				
				
				
							
<div class="small-12 medium-12 columns">
						<label for="loan-term-mobile">Loan Term
			<select name="loan_term" id="loan-term-mobile">
			    	<option value="">Please select...</option>
				<?php


					
				for($i = $min_lt; $i <= $max_lt; $i++)
					{
						echo '<option value="' . $i . '" selected'; if($i == $query['lt']){ echo ' selected'; } echo '>' . $i . ' Months</option>';
					}
				
				?>
										
					</select>
		</label>
						
				
				</div> <!-- end of row -->							
					
</div>
					<div id="" class="">
					<div class="row loan_info">
					<div class="small-12 medium-12 columns">
						
							<div class="row">	
								<div class="small-12 medium-6 columns">
									<div class="key-value">
										<span class="key">Loan Amount:</span>
										<span class="value show-loan-amount"></span>
									</div>
									<div class="key-value">
										<span class="key">Loan Term:</span>
										<span class="value show-loan-term">3 months</span>	
									</div>
									
								</div>
								<div class="small-12 medium-6 columns">
								<div class="key-value last">
										<span class="key">RAPR:</span>
										<span class="value"><?php echo $rapr; ?>%</span>
									</div>
									</div>
							<!--	<div class="small-12 medium-6 columns">
									<div class="key-value">
										<span class="key">Interest:</span>
										<span class="value show-loan-interest">&pound;</span>
									</div>
									<div class="key-value last">
										<span class="key">Repayable:</span>
										<span class="value show-loan-total"></span>
									</div>									
								</div>	-->									
							</div>
						</div>
					</div>
				</div> <!-- end of row -->		
				<a href="/apply" class="button submit text-center" style="width:100% !important; margin-top:16px;" onclick="gotoApply(this.href);return false;">Get Loan</a>
				
			</div>
	
	
	
	
	
	
	
	
										
		</div>
			
	</div> <!-- end of big row -->			
	
	</div> <!-- end of home_page_intro -->
			<!-- </div> -->
	<div class="row">
		<div class="small-12 columns">
			<div class="row image_row">
				<div class="small-4 medium-4 large-3 columns text-center">
					<img src="<?php echo $Home_Image_One ; ?>" alt="Step 1" />
					<?php echo $home_step_one ; ?>
				</div>
				<div class="small-4 medium-4 large-3 columns text-center">
					<img src="<?php echo $Home_Image_Two ; ?>" alt="Step 2" />
					<?php echo $home_step_two ; ?>
				</div>
				<div class="small-4 medium-4 large-3 columns text-center">
					<img src="<?php echo $Home_Image_Three ; ?>" alt="Step 3" />
					<?php echo $home_step_three ; ?>
				</div>
				<div id="top_lender" class="small-8 small-centered large-uncentered medium-4 large-3 columns">
					<ul class="no-bullet">
					<?php echo $home_ctas ; ?>
					</ul>					
				</div>											
			</div> 
			<!-- end of row -->
			
		</div>				
	</div> <!-- end of row -->
    <!-- Credit Report Block -->
	
	 <!-- End Of Credit Report Block -->
</div><!--  end of main -->
<div id="push"></div>
<script type="text/javascript">
	function gotoApply(href){
		//var href = $("#homeApplyButton").attr("href");
		href += "?la=" + Math.round($("#loan-amount").val()) + "&lt=" + Math.round($('input[name="loan-term"]').val());
		window.location.href = href;
	}
</script>