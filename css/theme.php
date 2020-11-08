<?php
    header("Content-type: text/css; charset: UTF-8");
    $brandColor = "#990000";
    $linkColor = "#555555";
    
?>
<?php

/*$dbServerName = "vmo1.co.uk";
$dbUsername = "vmo1co_sam";
$dbPassword = "gambling911";
$dbName = "vmo1co_co";
*/

require '../globals.php';



$cmsSmo = new cmsSMO();
$conn = $cmsSmo->sqlQuery();

$sql = "SELECT * FROM website WHERE id=" . $cmsSmo->websiteID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) { 
		/*  echo "Min_la: " . $row["min_la"]. " - Max_la: " . $row["max_la"]. 
		"Max_lt " . $row["max_lt"]. "Min_lt " . $row["min_lt"]."apr " . $row["apr"]."legal " . $row["legal"] ."repexample " . $row["rep_example"]  ;*/
			 
     $GLOBALS['h1c'] = $row["h1c"]; 
     $GLOBALS['h2c'] = $row["h2c"]; 
     $GLOBALS['h3c'] = $row["h3c"]; 
     $GLOBALS['Button_Colour'] = $row["button_colour"]; 
     $GLOBALS['Button_Colour_Border'] = $row["button_colour_border"]; 
     $GLOBALS['Button_Colour_Hover'] = $row["button_colour_hover"]; 
     $GLOBALS['Header_Colour'] = $row["header_colour"]; 
     $GLOBALS['Warning_Block'] = $row["warning_block"]; 
     $GLOBALS['Homepage_Block_Colour'] = $row["homepage_block_colour"]; 
     $GLOBALS['Footer_Background_Colour'] = $row["footer_background_colour"]; 
     $GLOBALS['Footer_Font_Colour'] = $row["footer_font_colour"]; 
     $GLOBALS['Header_Font_Colour'] = $row["header_font_colour"]; 
     $GLOBALS['Header_Font_Colour_Hover'] = $row["header_font_colour_hover"]; 
     $GLOBALS['Homepage_Heading_Colour'] = $row["homepage_heading_colour"]; 
     $GLOBALS['Homepage_Reasons_Colour'] = $row["homepage_reasons_colour"]; 
     $GLOBALS['Homepage_Block_Border'] = $row["homepage_block_border"]; 
     $GLOBALS['Homepage_Span_Colour'] = $row["homepage_span_colour"]; 
     $GLOBALS['Slider_Colour'] = $row["slider_colour"]; 
     $GLOBALS['Brand_Colour'] = $row["brand_colour"]; 
		 $GLOBALS['Loan_Information_Colour'] = $row["loan_information_colour"]; 
		 

		 
        ?>
   <?php }
} else {
    echo "results";
}

?>
/**************************************************************/
/*                   Loan Paramount CSS                    */
/**************************************************************/

html, body {height: 100%;}
/*
** Fonts
*/
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800);
@font-face {
  font-family: Delicious;
  src: url('/fonts/delicious-heavy.woff') format('woff');
}
@font-face {
  font-family: Roman;
  src: url('/fonts/delicious-roman.woff') format('woff');
}
@font-face {
 font-family: 'Aller_RG';
  src: url(/fonts/Aller_Rg.ttf);
}

.applyblock {background:<?php echo $Header_Colour ; ?>; padding:20px; color: #fff; border-radius:7px;}
.applyblock:focus {background:#fff; padding:20px; color: #fff; border-radius:7px;}
input:invalid {
    background-color: green;
}
/*
** Typography
*/
h1, h2, h3, h4, div, body, html, h5, h6, span, a, strong, li, td { 
/* 	font-family: 'Raleway', sans-serif !important; */
/* 	font-family: 'Aller_RG', sans-serif !important; */
	font-family: 'Lato', sans-serif;
}
.fa { 
	font-family: FontAwesome !important;
}
h1 {
	color: <?php echo $h1c; ?>;
	font-family: 'Aller_RG', sans-serif !important;
/* 	font-size: 50px; */
	font-size: 46px;
	line-height: 50px;
	font-weight: 600;
	
	margin-bottom: 30px;
}
h1 span { color: <?php echo $Homepage_Span_Colour ; ?>; }
h2 {
/* 	color: #0b476e; */
	color: <?php echo $h2c ; ?>;
	font-size: 30px;
	font-weight: 600;
	line-height: 36px;
	margin-bottom: 10px;
}
h3 {
/* 	color: #0b476e; */
	color: #333;
	font-size: 26px;
	line-height: 24px;
	font-weight: 400;
	margin-bottom: 20px;
}
h3.light {
	font-weight: 200;
	
}
h3 > i { 
	color: <?php echo $Homepage_Reasons_Colour ; ?>;
	margin-right: 20px;
	font-size: 20px;
}
h4 {
/* 	color: #0b476e; */
	color: #333;
/* 	font-size: 26px; */
	font-size: 18px;
	line-height: 18px;
	margin-bottom: 50px;	
}
h5 {
/* 	color: #0b476e; */
	color: #333;
	margin: 15px 0 10px 0;
	font-weight: 600;
/* 	font-size: 22px; */
	font-size: 16px;
}
p {
	font-family: 'Aller_RG', sans-serif !important;
	font-size: 16px;
	line-height: 22px;
	color: #7c7c7c;
}
p.large {
	font-size: 18px;
	line-height: 24px;
}

#top h3 {
	color: #777;
	margin-bottom: 10px;
}

.page-inner h1 {
	color: <?php echo $h1c; ?>;
	text-transform: none;
	margin-top: 40px;
}
.page-inner h2 {
	color: #333;
	font-weight: 400;
	font-size: 26px;
	line-height: 30px;
	margin-bottom: 50px;
}
.page-inner h3 {
	color: <?php echo $h3c ; ?>;
	font-weight: 600;
}

.page-inner p { 
	color: #636363;
}

h5 > a { color: #f7941d; }
h5 > a:hover, h5 > a:active, h5 > a:focus { color: #f7941d; text-decoration: underline; }

/*
**	History Table
*/
table.history {
	border: 0;
	width: 100%;
}
table.history th { 
	text-align: center;
	background: #333;
	color: #fff;
}

/*
** Top Bar
*/
.contain-to-grid-container {
	padding-top:99px;
	margin-bottom: 70px;
}


.contain-to-grid {
	background: <?php echo $Header_Colour ; ?>;
}
.top-bar { 
	background: <?php echo $Header_Colour ; ?>;

	height: 94px;
}
.top-bar .name {
	height: 90px;
	padding-left: 20px;
}
.top-bar .name a {
	line-height: 90px;
}
.top-bar .title-area {
	padding-right: 30px;
}
.top-bar.expanded .title-area {
	background: <?php echo $Header_Colour ; ?>;
}
.top-bar-section ul li {
	background: <?php echo $Header_Colour ; ?>;
}
.top-bar-section ul li > a.button { 
	top: 25px;
	background: #fff;
	color: #000;
	border-radius: 5px;
	font-weight: 600;
}
.top-bar-section ul li > a.button:hover {
	background: #dadada;
	color: #000;
}
.top-bar-section li:not(.has-form) a:not(.button) {
	background: <?php echo $Header_Colour ; ?>;
	line-height: 90px;
	font-weight: 600;
	font-size: 16px;
	color:  <?php echo $Header_Font_Colour ; ?>;
}
.top-bar-section li:not(.has-form) a:not(.button):hover{
	background: <?php echo $Header_Colour ; ?>;
	text-decoration: underline;
	color: <?php echo $Header_Font_Colour_Hover ; ?>;
}
.top-bar.expanded .toggle-topbar a {
	color: #fff;
}
.top-bar.expanded .toggle-topbar a span::after {
	box-shadow: 0 0px 0 1px #fff,0 7px 0 1px #fff,0 14px 0 1px #fff;
}
.top-bar .button {
	font-weight: 400;
	font-size: 16px;
	padding: 10px 35px;
	width: 110px;
	top: 25px;
}
.top-bar .button.signin {
	background: #322c4f;
	border: 1px solid #87DBB9;
	color: #fff;
}
.top-bar .button.applynow {
	background: <?php echo $Button_Colour; ?>;
	border-bottom: 1px solid <?php echo $Button_Colour_Border; ?>;
	color: #fff;
	margin-left: 10px;
}
.top-bar .button.signin:hover, .top-bar .button.signin:active, .top-bar .button.signin:focus {
	background: #408c16;
	color: #fff;
}
.top-bar .button.applynow:hover, .top-bar .button.applynow:focus, .top-bar .button.applynow:active {
	background: <?php echo $Button_Colour_Hover; ?>;
	border: 1px solid  <?php echo $Button_Colour_Border; ?>;
	color: #fff;
}
.top-bar .highlight {
	background: #f7941d !important;
	text-align: center;
}
@media only screen and (max-width: 40.063em)
{
	.top-bar-section li:not(.has-form) a:not(.button) {
		line-height: 20px;
	}
}

/*
** Wrapper
*/
#wrapper {
	min-height: 100%;
	height: auto !important;
	height: 100%;
}
#push { height: 100px; }

/*
** Main
*/
#main {

}

/*
** Main
*/
#top {
	padding-top: 50px;
	padding-bottom: 20px;
	margin-bottom: 40px;	
	background: url('/img/bg.png');
	border-bottom: 2px solid #ececec;
}

/*
** Lists
*/
ul.checks {
	list-style: none;
	margin-top: 40px; 
	margin-left: 35px;
}
ul.checks > li {
	font-size: 18px;
	font-weight: 600;
	margin-bottom: 5px;
	color: #3d3d3d;
}
ul.checks > li:before {
	font-family: FontAwesome;
	font-size: 18px;
	font-weight: 600;
	content: "\f04b";
	color: #333;
	padding-right: 15px;
}

@media only screen and (max-width: 40.063em)
{
	ul.checks { margin-left: 0px; }
}

/*
** Panels
*/
.panel {
	background: <?php echo $Slider_Colour ; ?>;
	border-radius: 5px;
	border: 5px solid <?php echo $Homepage_Block_Border ; ?>;
}
.panel .key-value:(.last) {
	margin-bottom: 20px;
}
.panel .key-value:not(.last) {
	margin-bottom: 8px;
}
.panel .key {
	font-size: 16px;
	line-height: 20px;
	color: <?php echo $Loan_Information_Colour ; ?>;
	font-weight: 400;
}
.panel .value {
	font-size: 26px;
	line-height: 26px;
	color: #fff;
	font-weight: 600;
}

@media only screen and (max-width: 40.063em)
{
	.panel .key-value.last {
		margin-bottom: 20px;
	}
}

/*
** Buttons 
*/
.button.submit {
	display: block;
	margin: 0px auto 5px auto;
	font-size: 26px;
	font-weight: 600;
	line-height: 26px;
background: <?php echo $Button_Colour; ?>;	
border-bottom: 8px solid <?php echo $Button_Colour_Border ; ?>;
border-radius: 5px;
	width: 80%;
}
.button.submit:hover {
background: <?php echo $Button_Colour_Hover; ?>;	
border-bottom: 8px solid <?php echo $Button_Colour_Border ; ?>;
}

a.terms { 
	color: #434343;
	font-size: 13px;
}
a.terms:hover, a.terms:focus, a.terms:active { 
	color: #494949; 
	text-decoration: underline;
}
.button.smaller { 
	width: 100% !important;
	font-size: 16px;
	padding: 10px;
	margin-top: 35px;
}
.button.submit.signin {
	width: 100%;
	box-shadow: none;
	margin-top: 10px;
	margin-bottom: 20px;
}

/*
** Loan Slider
*/
#loan-amount {
	margin-bottom: 65px;
	margin-top: 30px;
}
.noUi-slider {
/* 	background: #662d91; */
	background: <?php echo $Slider_Colour; ?>;
}
.noUi-background {
	box-shadow: none;
}
.noUi-target {
	border: 0;
}
.noUi-value {
	color: #222;
	font-size: 18px;
	font-weight: 600;
}
.noUi-marker-large, .noUi-marker-sub {
	background: #fff;
}
.noUi-horizontal {
	height: 40px;
	border-radius: 10px;
}
.noUi-origin {
	border-radius: 10px;
}
.noUi-horizontal .noUi-handle {
	width: 30px !important;
	height: 30px !important;
	border-radius: 50% 50% 50% 50%;
	position: absolute;
	transform: rotate(-45deg);
	top: 10px !important;
	left: 4px !important;
	margin: -20px 0 0 -20px;
	box-shadow: none;
	border: 0;
/* 	background: #333; */
	background: <?php echo $Slider_Colour; ?>;
}
.noUi-handle:after, .noUi-handle:before {
	display: none !important;
}
.noUi-handle span {
	font-size: 26px;
	color: #fff;
	font-weight: 600;
	line-height: 46px;
	text-align: center;
	display: block;
}
.noUi-handle:hover, .noUi-handle:focus, .noUi-handle:active { cursor: pointer; }
.noUi-base { 
	background: #ff5400;
	height: 50%;
}

.radios label { 
	font-size: 20px; 
}
.show-loan-amount.large {
	color: #333;
	font-weight: 600;
	font-size: 60px;
	line-height: 105px;
	display: block;
	text-align: center;
}
.apply-arrow {
	position: absolute;
	top: -110px;
	left: -105px;
}

.noUi-pips > .noUi-value:nth-child(8), .noUi-pips > .noUi-value:nth-child(24){ font-size: 14px; }
.noUi-marker-horizontal.noUi-marker {
/* 	width: 0px !important; */
}
@media only screen and (max-width: 64.063em)
{
	.noUi-horizontal {
		margin: 20px;
	}
}

/*
**  Forms and radio buttons
*/
.button.submit.page-apply {
	width: 100%;
	font-size: 22px;
	font-weight: 400;
}
.button.submit.page-apply > i { margin-left: 15px; }
input[type=radio].css-checkbox {
	position:absolute; z-index:-1000; left:-1000px; overflow: hidden; clip: rect(0 0 0 0); height:1px; width:1px; margin:-1px; padding:0; border:0;
}

input[type=radio].css-checkbox + label.css-label {
	padding-left:24px;
	height:19px; 
	display:inline-block;
	line-height:19px;
	background-repeat:no-repeat;
	background-position: 0 0;
	font-size:19px;
	vertical-align:middle;
	cursor:pointer;

}

input[type=radio].css-checkbox:checked + label.css-label {
	background-position: 0 -19px;
	background:#ff5400 !important;
	color:#fff !important;
}
label.css-label {
	background-image:url(/img/radio.svg);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
label { font-size: 14px; color: #fff; }
.row.radios {
	margin-top: 30px;
	margin-bottom: 30px;
}

.has-shadow {
	-webkit-box-shadow: 0px 5px 5px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    0px 5px 5px 0px rgba(50, 50, 50, 0.75);
	box-shadow:         0px 5px 5px 0px rgba(50, 50, 50, 0.75);
}

input, select { border-radius: 5px !important; }

.has-gbp { position: relative; }
.has-gbp:before {
	position: absolute;
	content: "\f154";
	font-family: FontAwesome;
	color: #636363;
	top: 34px;
	left: 10px;
}
.has-gbp > input { padding-left: 30px; }

#mobile-cta {
	display: none;
	width: 100%;
	background: #ccc;
	color: #636363;
}
#mobile-cta .button {
	width: auto;
	display: inline-block;
	padding: 5px 25px;
	font-size: 16px;
	font-weight: 400;
	margin: 14px 0 0 0;
	float: right;
}
#mobile-cta span {
	line-height: 64px;
}
@media only screen and (max-width: 40.063em)
{
	#mobile-cta { display: block; }
}

/*
** Footer 
*/
#footer {
	min-height: 60px;
	background: <?php echo $Footer_Background_Colour ; ?>;
	color: #fff;	
}
#footer p {
	color: <?php echo $Footer_Font_Colour ; ?>;
	line-height: 55px;
	font-size: 16px;
	margin-bottom: 0px;
	padding-top: 5px;
}
#footer p.smaller {
	font-size: 11px;
	padding-top: 15px;
	line-height: 20px;
	margin-bottom: 10px;
}
#footer p .fa { 
	font-size: 22px;
	padding-right: 10px;
}
#footer p .warning { 
	font-weight: 600;
}
#footer ul {
	list-style: none;
	margin-left: 0;
}
#footer ul > li {
	display: inline-block;
	margin-top: 20px;
	margin-right: 20px;	
}
#footer ul > li > a {
	color: #fff;
	font-size: 15px;
}
#footer ul > li > a:hover, #footer ul > li > a:active, #footer ul > li > a:focus {
	text-decoration: underline;
}

.is-warning { 
	border-top: 1px solid #333; 
	padding-top: 20px;
	color: #333 !important;
}
@media only screen and (max-width: 40.063em)
{
	#footer p { 
		line-height: 20px;
	}
}

/*
**  Sidebar
*/
.sidebar.panel {
	background: #fff;
	padding: 0;
	border: 1px solid #333;
}
.sidebar.panel > .head {
	background: #333;
	border-radius: 5px 5px 0 0;
	color: #fff;
	font-weight: 600;
	font-size: 20px;
	padding: 10px 20px;
}
.sidebar.panel > .main {
	padding: 0px 10px;
}
.sidebar.panel > .main > h5 {
	color: #636363;
	font-weight: 400;
	font-size: 18px;
}
.sidebar.panel > .main > h5 > i {
	color: #333;
	margin-right: 10px;
}
.sidebar.panel .noUi-pips-horizontal {
	padding: 0;
}
.sidebar.panel .noUi-value-horizontal {
	padding-top: 10px;
	font-size: 14px;
	font-weight: 400;	
}
.sidebar.panel .noUi-pips > .noUi-value:nth-child(2){
	padding-left: 15px;
	font-weight: 600;
}
.sidebar.panel .noUi-pips > .noUi-value:nth-child(16){
	font-weight: 600;
}
.sidebar.panel .noUi-pips > .noUi-value:nth-child(32){
	left: 95% !important;
	font-weight: 600;
}
.sidebar.panel #loan-amount {
	margin-bottom: 45px;
}
.sidebar.panel input[type=radio].css-checkbox + label.css-label { font-size: 16px; }
.sidebar.panel .key {
	color: #636363;
	font-size: 16px;
}
.sidebar.panel .value {
	color: #333;
	font-size: 20px;
}
.sidebar.panel .submit {
	margin: 10px auto 5px auto;
	font-size: 20px;
}
.sidebar.panel .terms {
	display: block;
	color: #636363;
	font-size: 14px;
	text-align: center;
	margin-bottom: 10px;
}
.sidebar.panel .terms:hover, .sidebar.panel .terms:focus, .sidebar.panel .terms:active {
	text-decoration: underline;
}

/*
** Alert boxes
*/
.info-box {
	background: #A6D1F7;
	border: 1px solid #4385BF;
	color: #4385BF;
	text-align: center;
	padding: 15px;
	margin-bottom: 25px;
	display: none;
	border-radius: 10px;
}
.error-box {
	background: #C98F8F;
	border: 1px solid #912727;
	color: #912727;
	text-align: center;
	padding: 15px;
	margin-bottom: 25px;
	display: none;
	border-radius: 10px;
}
.success-box {
	background: #D5EDAD;
	border: 1px solid #2B801C;
	color: #2B801C;
	text-align: center;
	padding: 15px;
	display: none;
	margin-bottom: 20px;
	border-radius: 10px;
}

/*
** Fixed sidebar
*/
@media only screen and (min-width: 60.063em)
{
	#sidebox.fixed{
		position:fixed;
		top:50px;
		width:303px;
	}
}

/*
**  Utility
*/
.margin-top { margin-top: 20px !important; }
.margin-top-large { margin-top: 50px !important; }
.margin-bottom { margin-bottom: 20px !important; }
.margin-bottom-medium { margin-bottom: 30px !important; }
.margin-bottom-medium { margin-bottom: 30px !important; }
.padding-top { padding-top: 20px !important; }
.padding-bottom { padding-bottom: 10px !important; }
#hidden-content { display: none; }

.read-more-toggle {
	font-weight: 600;
	font-size: 20px;
	color: #636363;
}
.read-more-toggle:hover, .read-more-toggle:active, .read-more-toggle:focus {
	text-decoration: underline;
	color: #c24e15;
}


/*
**  Mobile tweaks
*/
@media only screen and (max-width: 40.063em)
{
	h1 {
		font-size: 22px;
		line-height: 26px;
		margin: 20px 0;
	}
	h2 {
		font-size: 20px;
		line-height: 20px;
		margin-bottom: 10px;
	}
	h3 {
/* 		font-size: 14px; */
		font-size: 18px;
		line-height: 16px;
		margin-bottom: 10px;
	}
	h5 {
		font-size: 18px;
	}
	.button.submit {
		width: 100%;
		margin-top: 0px;
		margin-bottom: 20px;
	}
	.button.green { 
		border-radius: 5px;
		color: #fff;
		background: #333;
		width: 100%;
		padding-left: 10px;
		padding-right: 10px;
	}
}

/*
**  Homepage tweaks
*/
.top-bar-section ul li a.active, #footer ul li .active{
	color: #fff;
	text-decoration:underline;
}
#been_here_before {
/*
	position: absolute;
	top: 0;
	right: 0;
*/
	font-size: 10px;
	color: #979797;
}
#home_page_intro {
	background:<?php echo $Homepage_Block_Colour ; ?>;
	margin-bottom: 20px;
}
#home_page_intro h1 {
	color: <?php echo $Homepage_Heading_Colour ; ?>;
	margin-bottom: 30px;
	margin-top:30px;
}
#home_page_intro h3 {
	color: <?php echo $Homepage_Reasons_Colour ; ?>;
}
#home_page_intro .noUi-value {
	color: white;
}
#home_page_intro .radios label { 
	color: #333;
	background:#fff;
	border-radius:5px;
	text-align:center;
	width:150px;
	padding-top:9px;
	padding-bottom:32px;
	padding-left:10px;
	padding-right:10px;
	font-family: 'Aller_RG', sans-serif !important;
}
#home_page_intro .radios label[checked] { 
	color: #fff;
	background:#ff5400;
	border-radius:5px;
	text-align:center;
	width:150px;
	padding-top:9px;
	padding-bottom:32px;
	padding-left:10px;
	padding-right:10px;
	font-family: 'Aller_RG', sans-serif !important;
}
#home_page_intro .loan_info .key {
	font-size: 16px;
}
#home_page_intro .loan_info .value {
	font-size: 20px;
	padding-left: 6px;
}
#home_page_intro .key-value {
/* 	display: none; */
}
#home_page_intro .key-value span {
	font-size: 18px;
}
#apply_now {
	background: white;
}
#apply_now h3 {
	color: #fff;
	font-weight: bold;
}
#apply_now ol li {
	color: #ff5400;
	font-weight: bold;
}
#apply_now ol li span {
	color: #494949;
	font-weight: normal;
}
#late_repayment {
	background: <?php echo $Warning_Block ; ?>;
	padding: 30px;
	width: 100%;
	border: 5px solid <?php echo $Homepage_Block_Border ; ?>;
	border-radius: 5px;	
	margin-bottom:20px;
}
#warning-line p#text{
	margin-top:-20px;
}
.legal-banner {width:100%; position:fixed; background-color:<?php echo $Brand_Colour ; ?>; border-top:1px solid #fff; z-index:9999; color:#fff; font-size:16px; padding:12px 10px 0 10px; text-align: center}

#late_repayment p {
	font-family: 'Lato', sans-serif;
	font-size: 18px;
}
#late_repayment span {
	color: white;
}
.image_row h5{
	color: #494949;
	font-size: 16px;
}
#top_lender ul li {
	line-height: 3;
}
#top_lender i {
		color: <?php echo $Homepage_Span_Colour ; ?>;
	}	
}
h2.lato_light {
	font-family: 'Lato', sans-serif;
	font-weight: 200;
}
/*
**  Responsive overides
*/
/* // Small screens */
@media only screen { } /* Define mobile styles */

@media only screen and (max-width: 40em) { 
	#top_lender {
		text-align: center;

		
	}
			.legal-banner {width:100%; position:fixed; top: 0; background-color:<?php echo $Brand_Colour ; ?>; border-top:1px solid #fff; z-index:9999; color:#fff; font-size:10px; padding:12px 10px 0 10px; text-align: center}
			
			.contain-to-grid-container {
				margin-bottom: 0;
			}

			.contain-to-grid {
				background: <?php echo $Header_Colour ; ?>;
				padding-top:97px;
			}
					

} /* max-width 640px, mobile-only styles, use when QAing mobile issues */

/* // medium screens */
@media only screen and (min-width: 40.063em) and (max-width: 64em) { 
	.top-bar .title-area {
		width: 100%;
	}
	.top-bar-section ul li {
	background: none;
	}
	.top-bar-section li:not(.has-form) a:not(.button) {
		background: none;
	}
	.top-bar-section li:not(.has-form) a:not(.button):hover {
		background: none;
	}	
	.not_home .top-bar-section ul li {
	background: none;
	}
	.not_home .top-bar-section li:not(.has-form) a:not(.button) {
		background: none;
		color: #494949;
	}		
} /* min-width 641px and max-width 1024px, use when QAing tablet-only issues */

/* // Large screens */
@media only screen and (min-width: 64.063em) { 
	#top_lender {
		padding-top: 10px;
	}
	#apply_now {
		margin-top: 40px;
	}
} /* min-width 1025px, large screens */
