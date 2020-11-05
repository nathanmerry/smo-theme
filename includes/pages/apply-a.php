<div id="main">

	<div class="info-box"></div>
	<div id="form-error-box" class="error-box"></div>
	
	<form name="frmApply" id="frmApply" class="register" action="#" method="post">
	
		
			
			<div class="row">
				<div class="small-12 columns">
					<h1 style="margin-bottom: 10px;">Apply Now</h1>
					<img src="/img/steps.png" alt="Steps" class="margin-bottom-medium" />
				</div>
				
			</div>
			
	<div class="iframe-loading" id="loadImg">
 <img title="loading application form..." src="~/img/iframe-loading.gif" />
</div>

<div class="responsivewrapper">
   <iframe onload="document.getElementById('loadImg').style.display='none';" src="http://iframes.smartping.co.uk/v4.0/index.html?AFF_ID=373&CKM_CAMPAIGN_ID=764&CKM_KEY=TF3dKt6t6v4&CKM_SUBID=" ID="paydayIframe" frameborder="0"  height="3200" scrolling="no" seamless style="width: 100%" ></iframe>
</div>

<!--This resizes the iframe depending on its width-->
<script>
 function resizeIframe() {
  var iframeWidth = document.getElementById('paydayIframe').offsetWidth;
  if (iframeWidth > 800) {
   var iframeHeight = 1750;
   document.getElementById('paydayIframe').setAttribute('height', iframeHeight);
  }
  else {
   var iframeHeight = 3200;
   document.getElementById('paydayIframe').setAttribute('height', iframeHeight);
  }
 }​			
</div>

<div id="push"></div>
