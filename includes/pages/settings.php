<div id="main">


		<div class="row">
			<div class="small-12 columns">
				<h1>Account Settings</h1>
				<h2>Duis et dui rhoncus, molestie nisi nec, porta ipsum. Suspendisse vel est nisi. Nunc dapibus urna quis felis ullamcorper vestibulum. </h2>
			</div>
		</div>	

	
	<div class="row">
		<div class="small-12 columns">
			<h3>Curabitur nec diam felis. Fusce eget euismod ex.</h3>
			<p>
				Curabitur nec diam felis. Fusce eget euismod ex, at pharetra lacus. Nulla vitae feugiat massa. Morbi ipsum urna, malesuada sed justo non, maximus rutrum felis. 
				Aliquam pellentesque dapibus tortor et ullamcorper. Aenean orci mauris, iaculis sit amet faucibus in, auctor eget sapien. Donec rutrum mauris vitae bibendum 
				rhoncus.
			</p>
			

			<div class="info-box"></div>
			<div class="success-box">Your account details were updated successfully.</div>
			<div id="form-error-box" class="error-box"></div>
			
			<form name="frmApply" id="frmApply" class="register update" action="#" method="post">

				<?php 
					if(isset($loggedin))
					{
					?>
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>" />
					<input type="hidden" name="login_hash" id="login_hash" value="<?php echo $_SESSION['password']; ?>" />
				<?php } ?>		
				
				<input type="hidden" id="ip" name="ip" value="<?php echo get_ip_address(); ?>"/>
				<input type="hidden" id="user_agent" name="user_agent" value="<?php echo substr($_SERVER['HTTP_USER_AGENT'],0,200); ?>"/>				
			
				<h5>Your personal details.</h5>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="title">Title.
							<select name="title" id="title">
								<option value="Please Select" disabled="" selected="">Please Select</option>
								<option value="Mr."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Mr."){ echo ' selected'; } ?>>Mr.</option>
								<option value="Ms."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Ms."){ echo ' selected'; } ?>>Ms.</option>
								<option value="Mrs."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Mrs."){ echo ' selected'; } ?>>Mrs.</option>
								<option value="Miss."<?php if(isset($_SESSION['title']) && $_SESSION['title'] == "Miss."){ echo ' selected'; } ?>>Miss.</option>
							</select>								
						</label>
					</div>
					<div class="small-12 medium-4 columns">
						<label for="first_name">First Name.
							<input type="text" name="first_name" id="first_name" placeholder="Your name." value="<?php if(isset($_SESSION['first_name']) && $_SESSION['first_name'] != ""){ echo $_SESSION['first_name']; } ?>" />
						</label>
					</div>		
					<div class="small-12 medium-4 columns">
						<label for="last_name">Last Name.
							<input type="text" name="last_name" id="last_name" placeholder="Your surname." value="<?php if(isset($_SESSION['last_name']) && $_SESSION['last_name'] != ""){ echo $_SESSION['last_name']; } ?>" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="dob">Date of Birth.
							<input type="text" name="dob" id="dob" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['dob']) && $_SESSION['dob'] != ""){ echo date('d-M-Y', $_SESSION['dob']); } ?>">							
						</label>
					</div>
					<div class="small-12 medium-4 columns end">
						<label for="email">Email.
							<input type="email" name="email" id="email" placeholder="email@website.com" value="<?php if(isset($_SESSION['email']) && $_SESSION['email'] != ""){ echo $_SESSION['email']; } ?>" />
						</label>
					</div>		
				</div>			
			
			
				<h5>Your residence details.</h5>
				<strong>We don't need to post you anything, but we do need to check that you have a permanent address.</strong>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="home_phone">Home Phone.
							<input type="tel" name="home_phone" id="home_phone" placeholder="01234567890" value="<?php if(isset($_SESSION['home_phone']) && $_SESSION['home_phone'] != ""){ echo $_SESSION['home_phone']; } ?>" />
						</label>
					</div>	
					<div class="small-12 medium-4 columns">
						<label for="mobile_phone">Mobile Phone.
							<input type="tel" name="mobile_phone" id="mobile_phone" placeholder="07701234567" value="<?php if(isset($_SESSION['mobile_phone']) && $_SESSION['mobile_phone'] != ""){ echo $_SESSION['mobile_phone']; } ?>" />
						</label>
					</div>		
					<div class="small-12 medium-4 columns">
						<label for="address_1">House No / Name.
							<input type="text" name="address_1" id="address_1" placeholder="Your house no / name." value="<?php if(isset($_SESSION['address_1']) && $_SESSION['address_1'] != ""){ echo $_SESSION['address_1']; } ?>" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="address_2">Street Name.
							<input type="text" name="address_2" id="address_2" placeholder="Your street name" value="<?php if(isset($_SESSION['address_2']) && $_SESSION['address_2'] != ""){ echo $_SESSION['address_2']; } ?>">							
						</label>
					</div>
					<div class="small-12 medium-4 columns">
						<label for="town">Town.
							<input type="text" name="town" id="town" placeholder="Your town" value="<?php if(isset($_SESSION['town']) && $_SESSION['town'] != ""){ echo $_SESSION['town']; } ?>" />
						</label>
					</div>		
					<div class="small-12 medium-4 columns">
						<label for="county">County.
							<input type="text" name="county" id="county" placeholder="Your county" value="<?php if(isset($_SESSION['county']) && $_SESSION['county'] != ""){ echo $_SESSION['county']; } ?>" />
						</label>
					</div>						
				</div>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="post_code">Post Code.
							<input type="text" name="post_code" id="post_code" placeholder="Your postcode" value="<?php if(isset($_SESSION['post_code']) && $_SESSION['post_code'] != ""){ echo $_SESSION['post_code']; } ?>">							
						</label>
					</div>
					<div class="small-12 medium-4 columns">
						<label for="residence_status">Home Status.
							<select name="residence_status" id="residence_status">
								<option value="Please Select" disabled>Please Select</option>
								<option value="Home Owner"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Home Owner"){ echo ' selected'; } ?>>Home Owner</option>
								<option value="Living with Relatives"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Living with Relatives"){ echo ' selected'; } ?>>Living with Relatives</option>
								<option value="Council Tenant"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Council Tenant"){ echo ' selected'; } ?>>Council Tenant</option>
								<option value="Private Tenant"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Private Tenant"){ echo ' selected'; } ?>>Private Tenant</option>
								<option value="Housing Association Tenant"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Housing Association Tenant"){ echo ' selected'; } ?>>Housing Association Tenant</option>
								<option value="Military Accommodation"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Military Accommodation"){ echo ' selected'; } ?>>Military Accommodation</option>
								<option value="Work Accommodation"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Work Accommodation"){ echo ' selected'; } ?>>Work Accommodation</option>
								<option value="Other"<?php if(isset($_SESSION['residence_status']) && $_SESSION['residence_status'] == "Other"){ echo ' selected'; } ?>>Other</option>
							</select>
						</label>
					</div>		
					<div class="small-12 medium-4 columns">
						<label for="residence_start">Date you moved in.
							<input type="text" name="residence_start" id="residence_start" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['residence_start']) && $_SESSION['residence_start'] != ""){ echo date('d-M-Y', $_SESSION['residence_start']); } ?>" />
						</label>
					</div>						
				</div>			
				
				<h5>Employment details.</h5>
				<strong>Don't worry, WE WILL NEVER CONTACT YOUR EMPLOYER OR WORKPLACE - we just need to know your regular income.</strong>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="income_source">Employment Status.
							<select name="income_source" id="em-status">
								<option value="" disabled="" selected="">Please Select</option>
								<option value="Full-Time Employment"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Full-Time Employment"){ echo ' selected'; } ?>>Full-Time Employment</option>
								<option value="Part-Time Employment"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Part-Time Employment"){ echo ' selected'; } ?>>Part-Time Employment</option>
								<option value="Temporary Employment"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Temporary Employment"){ echo ' selected'; } ?>>Temporary Employment</option>
								<option value="Self Employed"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Self Employed"){ echo ' selected'; } ?>>Self Employed</option>
								<option value="Unemployed"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Unemployed"){ echo ' selected'; } ?>>Unemployed</option>
								<option value="Benefits"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Benefits"){ echo ' selected'; } ?>>Benefits</option>
								<option value="Disability Benefits"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Disability Benefits"){ echo ' selected'; } ?>>Disability Benefits</option>
								<option value="Other"<?php if(isset($_SESSION['income_source']) && $_SESSION['income_source'] == "Other"){ echo ' selected'; } ?>>Other</option>
							</select>							
						</label>
					</div>	
					<div class="small-12 medium-4 columns emp-emp-ind">
						<label for="employer_industry">Employer Industry.
							<select id="ei" name="employer_industry">
								<option value="" disabled="" selected="">Please Select</option>
								<option value="Construction/Manufacturing"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Construction/Manufacturing"){ echo ' selected'; } ?>>Construction/Manufacturing</option>
								<option value="Military"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Military"){ echo ' selected'; } ?>>Military</option>
								<option value="Health"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Health"){ echo ' selected'; } ?>>Health</option>
								<option value="Banking/Insurance"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Banking/Insurance"){ echo ' selected'; } ?>>Banking/Insurance</option>
								<option value="Education"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Education"){ echo ' selected'; } ?>>Education</option>
								<option value="Civil Service"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Civil Service"){ echo ' selected'; } ?>>Civil Service</option>
								<option value="Supermarket/Retail"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Supermarket/Retail"){ echo ' selected'; } ?>>Supermarket/Retail</option>
								<option value="Utilities/Telecom"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Utilities/Telecom"){ echo ' selected'; } ?>>Utilities/Telecom</option>
								<option value="Hotel, Restaurant and Leisure"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Hotel, Restaurant and Leisure"){ echo ' selected'; } ?>>Hotel, Restaurant and Leisure</option>
								<option value="Other, office based"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Other, office based"){ echo ' selected'; } ?>>Other, office based</option>
								<option value="Other, non office based"<?php if(isset($_SESSION['employer_industry']) && $_SESSION['employer_industry'] == "Other, non office based"){ echo ' selected'; } ?>>Other, non office based</option>
							</select>
						</label>
					</div>		
					<div class="small-12 medium-4 columns emp-emp-name">
						<label for="employer_name">Employer Name.
							<input type="text" name="employer_name" id="employer_name" placeholder="Your employers name." value="<?php if(isset($_SESSION['employer_name']) && $_SESSION['employer_name'] != ""){ echo $_SESSION['employer_name']; } ?>" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 columns emp-emp-start">
						<label for="employment_start">Employment Start.
							<input type="text" name="employment_start" id="employment_start" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['employment_start']) && $_SESSION['employment_start'] != ""){ echo date('d-M-Y', $_SESSION['employment_start']); } ?>" />
						</label>
					</div>
					<div class="small-12 medium-4 columns emp-work-phone">
						<label for="work_phone">Work Phone.
							<input type="text" name="work_phone" id="work_phone" placeholder="01234567890" value="<?php if(isset($_SESSION['work_phone']) && $_SESSION['work_phone'] != ""){ echo $_SESSION['work_phone']; } ?>" />
						</label>
					</div>		
					<div class="small-12 medium-4 columns emp-pay-freq">
						<label for="pay_frequency">Payment Frequency.
							<select id="pay_frequency" name="pay_frequency">
								<option value="" disabled="" selected="">Please Select</option>
								<option value="Weekly"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Weekly"){ echo ' selected'; } ?>>Weekly</option>
								<option value="Bi-Weekly"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Bi-Weekly"){ echo ' selected'; } ?>>Bi-Weekly</option>
								<option value="Four Weekly"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Four Weekly"){ echo ' selected'; } ?>>Four Weekly</option>
								<option value="Last Monday of month"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Last Monday of month"){ echo ' selected'; } ?>>Last Monday of month</option>
								<option value="Last Tuesday of month"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Last Tuesday of month"){ echo ' selected'; } ?>>Last Tuesday of month</option>
								<option value="Last Wednesday of month"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Last Wednesday of month"){ echo ' selected'; } ?>>Last Wednesday of month</option>
								<option value="Last Thursday of month"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Last Thursday of month"){ echo ' selected'; } ?>>Last Thursday of month</option>
								<option value="Last Friday of month"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Last Friday of month"){ echo ' selected'; } ?>>Last Friday of month</option>
								<option value="Last Working Day of month"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Last Working Day of month"){ echo ' selected'; } ?>>Last Working Day of month</option>
								<option value="Specific Date"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Specific Date"){ echo ' selected'; } ?>>Specific Date</option>
								<option value="Other"<?php if(isset($_SESSION['payment_frequency']) && $_SESSION['payment_frequency'] == "Other"){ echo ' selected'; } ?>>Other</option>
							</select>								
						</label>
					</div>						
				</div>
				<div class="row">
					<div class="small-12 medium-4 columns emp-next-pay">
						<label for="next_payday">Next Pay Date.
							<input type="text" name="next_payday" id="next_payday" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['next_payday']) && $_SESSION['next_payday'] != ""){ echo date('d-M-Y', $_SESSION['next_payday']); } ?>" />								
						</label>
					</div>
					<div class="small-12 medium-4 columns emp-sec-pay">
						<label for="second_payday">Second Pay Date.
							<input type="text" name="second_payday" id="second_payday" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['second_payday']) && $_SESSION['second_payday'] != ""){ echo date('d-M-Y', $_SESSION['second_payday']); } ?>" />								
						</label>
					</div>		
					<div class="small-12 medium-4 columns emp-monthly-income">
						<label for="monthly_income">Monthly Income (&pound;).
							<input type="text" name="monthly_income" id="monthly_income" placeholder="900" value="<?php if(isset($_SESSION['monthly_income']) && $_SESSION['monthly_income'] != ""){ echo $_SESSION['monthly_income']; } ?>" />
						</label>
					</div>						
				</div>		


				<h5>Your financial details.</h5>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="debit_card">Debit Card.
							<select id="debit_card" name="debit_card">
								<option value="" disabled="" selected="">Please Select</option>
								<option value="MasterCard Debit"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "MasterCard Debit"){ echo ' selected'; } ?>>MasterCard Debit</option>
								<option value="Switch / Maestro"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "Switch / Maestro"){ echo ' selected'; } ?>>Switch / Maestro</option>
								<option value="Visa Debit"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "Visa Debit"){ echo ' selected'; } ?>>Visa Debit</option>
								<option value="Visa Electron"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "Visa Electron"){ echo ' selected'; } ?>>Visa Electron</option>
								<option value="No Debit Card"<?php if(isset($_SESSION['debit_card']) && $_SESSION['debit_card'] == "No Debit Card"){ echo ' selected'; } ?>>No Debit Card</option>
							</select>							
						</label>
					</div>
					<div class="small-12 medium-4 columns">
						<label for="paid_direct">Paid as Direct Debit.
							<select id="paid_direct" name="paid_direct">
								<option value="" disabled="" selected="">Please Select</option>
								<option value="Yes, UK Account"<?php if(isset($_SESSION['paid_direct']) && $_SESSION['paid_direct'] == "Yes, UK Account"){ echo ' selected'; } ?>>Yes, UK Account</option>
								<option value="Yes, Non UK Account"<?php if(isset($_SESSION['paid_direct']) && $_SESSION['paid_direct'] == "Yes, Non UK Account"){ echo ' selected'; } ?>>Yes, Non UK Account</option>
								<option value="No"<?php if(isset($_SESSION['paid_direct']) && $_SESSION['paid_direct'] == "No"){ echo ' selected'; } ?>>No</option>
							</select>
						</label>
					</div>		
					<div class="small-12 medium-4 columns">
						<label for="bank_account">Account Number.
							<input type="text" name="bank_account" id="bank_account" placeholder="12345678" maxlength="8" value="<?php if(isset($_SESSION['bank_account']) && $_SESSION['bank_account'] != ""){ echo $_SESSION['bank_account']; } ?>" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 columns">
						<label for="sort_code">Sort Code.
							<input type="text" name="sort_code" id="sort_code" placeholder="123456" maxlength="6" value="<?php if(isset($_SESSION['sort_code']) && $_SESSION['sort_code'] != ""){ echo $_SESSION['sort_code']; } ?>">							
						</label>
					</div>
					<div class="small-12 medium-4 columns">
						<label for="bank_name">Bank Name.
							<select id="bank_name" name="bank_name" class="form-input">
								<option value="" disabled="" selected="">Please Select</option>
								<option value="BOS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "BOS"){ echo ' selected'; } ?>>BOS</option>
								<option value="BARCLAYS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "BARCLAYS"){ echo ' selected'; } ?>>BARCLAYS</option>
								<option value="HALIFAX"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "HALIFAX"){ echo ' selected'; } ?>>HALIFAX</option>
								<option value="LLOYDS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "LLOYDS"){ echo ' selected'; } ?>>LLOYDS</option>
								<option value="NATWEST"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "NATWEST"){ echo ' selected'; } ?>>NATWEST</option>
								<option value="RBS"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "RBS"){ echo ' selected'; } ?>>RBS</option>
								<option value="SANTANDER"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "SANTANDER"){ echo ' selected'; } ?>>SANTANDER</option>
								<option value="NATIONWIDE"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "NATIONWIDE"){ echo ' selected'; } ?>>NATIONWIDE</option>
								<option value="HSBC"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "HSBC"){ echo ' selected'; } ?>>HSBC</option>
								<option value="FIRSTDIRECT"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "FIRSTDIRECT"){ echo ' selected'; } ?>>FIRSTDIRECT</option>
								<option value="COOP"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "COOP"){ echo ' selected'; } ?>>COOP</option>
								<option value="OTHER"<?php if(isset($_SESSION['bank_name']) && $_SESSION['bank_name'] == "OTHER"){ echo ' selected'; } ?>>OTHER</option>
							</select>
						</label>
					</div>	
					<div class="small-12 medium-4 columns emp-sec-pay">
						<label for="bank_start">Account Open Date.
							<input type="text" name="bank_start" id="bank_start" placeholder="DD/MMM/YYYY" value="<?php if(isset($_SESSION['bank_start']) && $_SESSION['bank_start'] != ""){ echo date('d-M-Y', $_SESSION['bank_start']); } ?>" />								
						</label>
					</div>							
				</div>
				
				<div class="row margin-bottom-medium">
					<div class="small-12 columns">
						<input id="terms" name="terms" value="agree" type="checkbox" style="margin:0;"><label for="terms" style="display:inline;">By submitting this form, I declare that all the details above are correct.</label> 
					</div>
				</div>
				
				<div class="row">
					<div class="small-12 columns">
						<button type="submit" id="update-submit" class="button submit">Submit</button>
					</div>
				</div>				

					
			</form>
			
		</div>
	</div>	
	
		
	
</div>

<div id="push"></div>
