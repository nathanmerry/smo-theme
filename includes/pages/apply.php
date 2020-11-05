<?php
	$domain = 'https://www.cmlo.uk';
	$urlIframe = $domain. '/iframe.php';
	$owner = isset($_GET['owner'])? '?owner=' .$_GET['owner']:'?owner=BABY&color=pink';
	$urlIframe .= $owner;

	if(isset($GLOBALS['max_lt']) && $GLOBALS['max_lt']){
		$urlIframe .= '&max_lt=' .$GLOBALS['max_lt'];
	}

	if(isset($GLOBALS['max_lt']) && $GLOBALS['max_lt']){
		$urlIframe .= '&max_lt=' .$GLOBALS['max_lt'];
	}

	if(isset($GLOBALS['min_lt']) && $GLOBALS['min_lt']){
		$urlIframe .= '&min_lt=' .$GLOBALS['min_lt'];
	}

	if(isset($GLOBALS['min_la']) && $GLOBALS['min_la']){
		$urlIframe .= '&min_la=' .$GLOBALS['min_la'];
	}

	if(isset($GLOBALS['max_la']) && $GLOBALS['max_la']){
		$urlIframe .= '&max_la=' .$GLOBALS['max_la'];
	}

	if(isset($GLOBALS['increments']) && $GLOBALS['increments']){
		$urlIframe .= '&increments=' .$GLOBALS['increments'];
	}
?>
<script type="text/javascript">
	window.addEventListener('message', function (e) {

		var iframe = $("#cmloIframe");
		var eventName = e.data[0];
		var data = e.data[1];
		switch (eventName) {

			case 'setHeight':
				console.log('recieved setHeight' + data);
				iframe.css({"height": data + 'px'});
				break;

			case 'goUp':
				$('body').scrollTop(0);
				break;
		}
	}, false);


	$(document).ready(function () {

		var domain = '<?php echo $domain; ?>';
		var iframe = document.getElementById('cmloIframe').contentWindow;

		setInterval(function(){
			var message = 'getHeight';
			iframe.postMessage(message,domain);
		},6000);

	});
</script>
<div id="main">
	<div class="row">
		<!--<div class="small-12 medium-4 medium-push-8 columns">
		</div>	-->
		<div class="small-12 medium-12 columns">
			<iframe id="cmloIframe" frameborder="0" scrolling="no" style="display: block;  border: none; width: 100%; height: 2500px;" src="<?php echo $urlIframe; ?>"></iframe>
		</div>
	</div>
</div>