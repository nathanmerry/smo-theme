<div id="sidebox" class="panel sidebar padding-bottom">
	<div class="head">
		Quick Loan
	</div>
	<div class="main">
		<h5><i class="fa fa-check-square-o"></i> Borrow up to &pound;1000 today!</h5>
		<label for="loan-amount-mobile">Loan Amount:
			<select name="loan_amount" id="loan-amount-mobile">
				<option value="">Please select...</option>
				<?php 
				
					for($i = 100; $i <= 1000; $i += 10)
					{
						echo '<option value="' . $i . '"'; if($i == $query['la']){ echo ' selected'; } echo '>&pound;' . $i . '</option>';
					}
				
				?>
			</select>
		</label>
		
		<label for="loan-term-mobile">Loan Term:
			<select name="loan_term" id="loan-term-mobile">
				<option value="">Please select...</option>
				<?php 
				
					for($i = 1; $i <= 6; $i++)
					{
						echo '<option value="' . $i . '"'; if($i == $query['lt']){ echo ' selected'; } echo '>' . $i . ' Months</option>';
					}
				
				?>
			</select>
		</label>
		
		<div class="row margin-top">
			<div class="small-12 medium-7 columns">
				<span class="key">Loan Amount:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value show-loan-amount"></span>
			</div>			
		</div>
		
		<div class="row">
			<div class="small-12 medium-7 columns">
				<span class="key">Loan Term:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value show-loan-term"></span>
			</div>			
		</div>

		<div class="row">
			<div class="small-12 medium-7 columns">
				<span class="key">Representative APR:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value">305.9%</span>
			</div>			
		</div>	

		<div class="row">
			<div class="small-12 medium-7 columns">
				<span class="key">Interest:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value show-loan-interest"></span>
			</div>			
		</div>

		<div class="row">
			<div class="small-12 medium-7 columns">
				<span class="key">Fees:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value">&pound;0</span>
			</div>			
		</div>		
		
		<div class="row">
			<div class="small-12 medium-7 columns">
				<span class="key">Total Repayable:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value show-loan-total"></span>
			</div>			
		</div>		

	</div>
</div>