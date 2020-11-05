<div class="panel sidebar">
	<div class="head">
		Quick Loan
	</div>
	<div class="main">
		<div id="loan-amount" class="noui-slider"></div>		
		<div class="row">
				<div class="small-4 medium-4 columns">
					<input type="radio" name="loan-term" id="loan-term-14" value="1" class="css-checkbox"/>
					<label for="loan-term-14" class="css-label">1 month</label>
				</div>
				<div class="small-4 medium-4 columns">
					<input type="radio" name="loan-term" id="loan-term-28" value="3" class="css-checkbox" checked />
					<label for="loan-term-28" class="css-label">3 months</label>
				</div>
				<div class="small-4 medium-4 columns">
					<input type="radio" name="loan-term" id="loan-term-42" value="6" class="css-checkbox"/>
					<label for="loan-term-42" class="css-label">6 months</label>
				</div>			
		</div>			
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
				<span class="value"><?php echo $rapr; ?>%</span>
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
				<span class="key">Total Repayable:</span>
			</div>
			<div class="small-12 medium-5 columns text-right">
				<span class="value show-loan-total"></span>
			</div>			
		</div>		
		<a href="/apply" class="button submit" onclick="gotoApply(this.href);return false;">Apply Now ></a>
		<a href="/terms-and-conditions" class="terms">Read terms & conditions</a>		
	</div>
</div>