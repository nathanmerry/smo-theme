<div id="main">



		<div class="row">
			<div class="small-12 columns">
				<h1>History</h1>
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
			

		<table class="history">
			<thead>
				<tr>
					<th>Date Applied</th>
					<th>Status</th>
					<th class="text-center">Loan Amount</th>
					<th class="text-center">Loan Term</th>
					<th class="show-for-medium-up">Loan Purpose</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//get application history
					$postme = array();
					$postme['id'] = $_SESSION['id'];
					$postme['login_hash'] = $_SESSION['password'];
					$postme['owner'] = "GIANT";
					
					$curl = curl_init();

					curl_setopt($curl, CURLOPT_POST, 1);
					curl_setopt($curl, CURLOPT_URL, 'http://46.32.238.192/~vmonlineltd/api/get_history.php');
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postme));
					curl_setopt($curl, CURLOPT_HEADER, 1);

					// Send the request
					$result = curl_exec($curl);
					$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
					$header = substr($result, 0, $header_size);
					$body = substr($result, $header_size);
					$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);									
					
					$json = json_decode($body);
					
					foreach($json as $row){
						$loan_status = $row->status;
						if($loan_status == "Accepted"){ $loan_status = "Accepted By Partner"; }
						echo '<tr>
								<td>' . date('d-M-Y g:ia', $row->date) . '</td>
								<td>' . $loan_status . '</td>
								<td class="text-center">' . $row->loan_amount . $row->currency . '</td>
								<td class="text-center">' . $row->loan_term . ' Days</td>
								<td class="show-for-medium-up">' . $row->loan_purpose . '</td>
							</tr>';
					}
				?>			
			</tbody>
		</table>
			
		</div>
	</div>	
	
		
	
</div>

<div id="push"></div>
