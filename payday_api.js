jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
}

function showPopupLoader(){
	$("#waitPopUp").center();
	$('#waitPopUp').bPopup({
		modalClose: false,
		opacity: 0.6,
		positionStyle: 'fixed' //'fixed' or 'absolute'
	});

	var pb_width = 0;

	window.setInterval(function(){
		pb_width = parseFloat(pb_width) + parseFloat(0.8);
		if(pb_width >= 100){ pb_width = 100; }
		
		$("#pb_percent").html(Math.round(pb_width)+"%");
		
		$(".meter > span").animate({
			width: pb_width+"%"
		},1000);
	}, 1000);
}

// Validation Methods

jQuery.validator.addMethod("lettersonly", function (value, element) {
    return value.match(new RegExp("^[a-zA-Z ]+$"));
}, "Letters only.");

jQuery.validator.addMethod("hpvalidate", function (value, element) {
    return this.optional(element) || /^01/.test(value) || /^02/.test(value);
}, "Must start with '01' or '02'");

jQuery.validator.addMethod("wpvalidate", function (value, element) {
    return this.optional(element) || /^01/.test(value) || /^02/.test(value) || /^08/.test(value);
}, "Must start with '01', '02' or '08'");

jQuery.validator.addMethod("mpvalidate", function (value, element) {
    return this.optional(element) || /^07/.test(value);
}, "Must start with '07'");

jQuery.validator.addMethod("wpvhp", function (value, element) {
    return this.optional(element) || value != $("input[name='hp']").val();
}, "Must be different from Home Phone");

jQuery.validator.addMethod('postcodeUK', function (value, element) {
    return this.optional(element) || /^((([A-PR-UWYZ][0-9])|([A-PR-UWYZ][0-9][0-9])|([A-PR-UWYZ][A-HK-Y][0-9])|([A-PR-UWYZ][A-HK-Y][0-9][0-9])|([A-PR-UWYZ][0-9][A-HJKSTUW])|([A-PR-UWYZ][A-HK-Y][0-9][ABEHMNPRVWXY]))\s?([0-9][ABD-HJLNP-UW-Z]{2})|(GIR)\s?(0AA))$/i.test(value);
}, 'Please specify a valid UK postcode');

jQuery.validator.addMethod("greaterThan",
    function (value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
    }, 'Must be greater than Next Pay Date.');
	
// End of Validation Methods



$(document).ready(function () {
	function nextSession(date) {
		var ret = new Date(date||new Date());
		ret.setDate(ret.getDate() + (3 - 1 - ret.getDay() + 7) % 7 + 1);
		return ret;
	}
	function nextSession2(date) {
		var ret = new Date(date||new Date());
		ret.setDate(ret.getDate() + (4 - 1 - ret.getDay() + 7) % 7 + 1);
		return ret;
	}	
	$.date = function(dateObject) {
		var mon=new Array();
		mon[0]="JAN";
		mon[1]="FEB";
		mon[2]="MAR";
		mon[3]="APR";
		mon[4]="MAY";
		mon[5]="JUN";
		mon[6]="JUL";
		mon[7]="AUG";
		mon[8]="SEP";
		mon[9]="OCT";
		mon[10]="NOV";
		mon[11]="DEC";    
		var d = new Date(dateObject);
		var day = d.getDate();
		var month = d.getMonth();
		var year = d.getFullYear();
		if (day < 10) {
			day = "0" + day;
		}
		var date = day + "-" + mon[month] + "-" + year;

		return date;
	};
	
	
	$(".notlogged input[name='email']").on("blur",function(){
		$.ajax({
			type: 'POST',
			crossDomain: true,
			data: {email: $("input[name='email']").val(),owner: 'ZEN'}, // Change Owner Here
			url: 'proxy_email_check.php',
			success: function (data) {
				//alert(data);
				if(data == "existing"){
					$(".info-box").html('It appears you have applied for a loan through us before, please login to apply with one click.');
					$(".info-box").fadeIn();
					$("html, body").animate({ scrollTop: 0 }, "fast");
					$("input[name='email']").focus();
					$('form.register').css('z-index', '-1');
					$('form.register').css('position', 'relative');		
				}
			}

		});	
	});
	

    jQuery.support.cors = true;
	
    $("form.register input[name='dob']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:-19",
        defaultDate: "-0d -33y",
        maxDate: "-19y"
    });
    $("form.register input[name='next_payday']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "c:c+1",
        minDate: "+1d"
    });
    $("form.register input[name='second_payday']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "c:c+1",
        minDate: "+2d"
    });
    $("form.register input[name='employment_start']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:c",
        maxDate: "0"
    });
    $("form.register input[name='residence_start']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:c",
        maxDate: "0"
    });
    $("form.register input[name='bank_start']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:c",
        maxDate: "0"
    });	
	
    $("form.register .prefix .calendar-icon").click(function () {
        $(this).next().datepicker('show');
    });

    $("select[name='income_source']").on('change', function (){
	
		switch($(this).val()){
			case "Full-Time Employment":
			case "Part-Time Employment":
			case "Temporary Employment":
			case "Other":
				$(".emp-work-phone").fadeIn('slow');
				$(".emp-emp-start").fadeIn('slow');
				$(".emp-pay-freq").fadeIn('slow');
				$(".emp-emp-ind").fadeIn('slow');
				$(".emp-next-pay").fadeIn('slow');
				$(".emp-sec-pay").fadeIn('slow');
				$(".emp-paid-direct").fadeIn('slow');
				$(".emp-emp-name").fadeIn('slow');
				$(".emp-monthly-income").fadeIn('slow');				
				break;
			case "Self Employed":
				$(".emp-work-phone").fadeIn('slow');
				$(".emp-emp-start").fadeIn('slow');
				$(".emp-pay-freq").fadeIn('slow');
				$(".emp-emp-ind").fadeIn('slow');
				$(".emp-next-pay").fadeIn('slow');
				$(".emp-sec-pay").fadeIn('slow');
				$(".emp-paid-direct").fadeIn('slow');
				$(".emp-monthly-income").fadeIn('slow');
				$(".emp-emp-name").fadeOut('slow', function(){ $("input[name='employer_name']").val("Self Employed"); });
				break;
			case "Unemployed":
				$(".emp-work-phone").fadeOut('slow');
				$(".emp-emp-start").fadeOut('slow');
				$(".emp-emp-ind").fadeOut('slow');
				$(".emp-emp-name").fadeOut('slow');			
				$(".emp-pay-freq").fadeOut('slow');	
				$(".emp-next-pay").fadeOut('slow');
				$(".emp-sec-pay").fadeOut('slow');
				$(".emp-paid-direct").fadeOut('slow');
				$(".emp-monthly-income").fadeOut('slow');
				$("input[name='work_phone']").val("01234567890");
				$("input[name='monthly_income']").val("0");
				$("input[name='employer_name']").val("Not Employed");
				$("input[name='employment_start']").val("01-JAN-2000");
				$("select[name='employer_industry']").val("Other, non office based");
				$("select[name='pay_frequency']").val("Other");				
				$("input[name='next_payday']").val($.date(nextSession()));	
				$("input[name='second_payday']").val($.date(nextSession2()));		
				$("select[name='paid_direct']").val("No");
				break;
			case "Benefits":
			case "Disability Benefits":
				$(".emp-work-phone").fadeOut('slow');
				$(".emp-emp-start").fadeOut('slow');
				$(".emp-pay-freq").fadeIn('slow');
				$(".emp-emp-ind").fadeOut('slow');
				$(".emp-next-pay").fadeIn('slow');
				$(".emp-sec-pay").fadeIn('slow');
				$(".emp-paid-direct").fadeIn('slow');
				$(".emp-emp-name").fadeOut('slow');	
				$(".emp-monthly-income").fadeOut('slow');	
				$("input[name='work_phone']").val("01234567890");
				$("input[name='employer_name']").val("Not Employed");
				$("input[name='employment_start']").val("01-JAN-2000");
				$("select[name='employer_industry']").val("Other, non office based");
				break;
		}
	
		//$('form.register nemp input, form.register .unemp select').val('');
		
    });

  //  $("select[name='IS']").trigger('change');

    $('form.register').submit(function (e) {
        e.preventDefault();

        var validator = $("form.register").validate({
            rules: {
                title: "required",
                first_name: {
                    required: true,
                    minlength: 2,
                    lettersonly: true
                },
                last_name: {
                    required: true,
                    minlength: 2,
                    lettersonly: true
                },
                email: {
                    required: true,
                    email: true
                },
                home_phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    hpvalidate: true,
                    digits: true
                },
                work_phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    wpvalidate: true,
                    wpvhp: true,
                    digits: true
                },
                mobile_phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    mpvalidate: true,
                    digits: true
                },
                dob: {
                    required: true
                },
                bank_account: {
                    required: true,
                    minlength: 8,
                    maxlength: 8
                },
                sort_code: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
                bank_name: "required",
                debit_card: "required",
                employer_name: "required",
                employer_industry: "required",
                employment_start: {
                    required: true
                },
                monthly_income: {
                    required: true,
                    digits: true
                },
                income_source: "required",
                pay_frequency: "required",
                next_payday: "required",
                second_payday: "required",
                paid_direct: "required",
                terms: "required",
                post_code: {
                    required: true,
                    postcodeUK: true
                },
                address_1: "required",
                address_2: "required",
                town: "required",
                county: "required",
                residence_status: "required",
                residence_start: {
                    required: true
                },
                loan_purpose: "required",
				password_1: {
					required: true,
					minlength: 5
				},
				password_2: {
					required: true,
					minlength: 5,
					equalTo: "#password_1"
				},
				// New fields
                housing_exp: {
                    required: true,
                    digits: true
                },
                utility_exp: {
                    required: true,
                    digits: true
                },
                food_exp: {
                    required: true,
                    digits: true
                },
                transport_exp: {
                    required: true,
                    digits: true
                },
                credit_exp: {
                    required: true,
                    digits: true
                },
                other_exp: {
                    required: true,
                    digits: true
                }				
            }
        });
        $("input[name='second_payday']").rules('add', {
            greaterThan: "input[name='next_payday']"
        });

        if (validator.form()) {
			
            $('form.register').css('z-index', '-1');
			
            $('#register-submit').val('Loading...').attr("disabled","disabled");
			
			// Replace loading image here
            //$("#register-submit").after('<img src="img/ajax-loader.gif" style="margin:50px auto;display:block;" id="form-loader" class="loader" />');
			//$("#loading-loader").fadeIn();
			
			showPopupLoader();
			
            $.ajax({
                type: 'POST',
                crossDomain: true,
                data: {
                    dob: $("form.register [name='dob']").val(),
                    email: $("form.register [name='email']").val(),
                    title: $("form.register [name='title']").val(),
                    first_name: $("form.register [name='first_name']").val(),
                    last_name: $("form.register [name='last_name']").val(),
                    home_phone: $("form.register [name='home_phone']").val(),
                    work_phone: $("form.register [name='work_phone']").val(),
                    mobile_phone: $("form.register [name='mobile_phone']").val(),
                    employer_name: $("form.register [name='employer_name']").val(),
                    employer_industry: $("form.register [name='employer_industry']").val(),
                    employment_start: $("form.register [name='employment_start']").val(),
                    monthly_income: $("form.register [name='monthly_income']").val(),
                    income_source: $("form.register [name='income_source']").val(),
                    pay_frequency: $("form.register [name='pay_frequency']").val(),
                    loan_amount: $("form.register [name='loan_amount']").val(),
                    loan_term: $("form.register [name='loan_term']").val(),
                    loan_purpose: $("form.register [name='loan_purpose']").val(),
                    residence_status: $("form.register [name='residence_status']").val(),
                    address_1: $("form.register [name='address_1']").val(),
                    address_2: $("form.register [name='address_2']").val(),
                    town: $("form.register [name='town']").val(),
                    post_code: $("form.register [name='post_code']").val(),
                    county: $("form.register [name='county']").val(),
                    country: "GB",
                    residence_start: $("form.register [name='residence_start']").val(),
                    next_payday: $("form.register [name='next_payday']").val(),
                    second_payday: $("form.register [name='second_payday']").val(),
                    debit_card: $("form.register [name='debit_card']").val(),
                    sort_code: $("form.register [name='sort_code']").val(),
                    bank_account: $("form.register [name='bank_account']").val(),
                    paid_direct: $("form.register [name='paid_direct']").val(),
                    bank_name: $("form.register [name='bank_name']").val(),
					bank_start: $("form.register [name='bank_start']").val(),
                    user_agent: $("form.register [name='user_agent']").val(),
                    ip: $("form.register [name='ip']").val(),
					password_1: $("#password_1").val(),
					password_2: $("#password_2").val(),
					// New fields
					housing_exp: $("#housing_exp").val(),
					utility_exp: $("#utility_exp").val(),
					food_exp: $("#food_exp").val(),
					transport_exp: $("#transport_exp").val(),
					credit_exp: $("#credit_exp").val(),
					other_exp: $("#other_exp").val(),					
user_id: $("#user_id").val(),
					login_hash: $("#login_hash").val(),
					owner: "ZEN" // Set owner here.
                },
                url: 'proxy.php',
                success: function (data) {
					//alert(data);
                    var result = jQuery.parseJSON(data);

                    if (result.status == "failed") {
						$('#form-error-box').fadeIn();
						$('form.register').css('z-index', '1');
                        $('html, body').animate({
                            scrollTop: $("#form-error-box").offset().top - 80
                        }, 2000);
                        $('#form-error-box').html('An error occured. Please ensure that the form is filled in correctly or refresh the page and try again.');
						
						$('#register-submit').val('Apply').removeAttr("disabled");
						$('#loading-loader').css('display', 'none');						
                    } 
					else {
                        var num = parseFloat(result.price).toFixed(2);

						// Google Conversion Here
						$('body').prepend('<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/979946162/?value='+num+'&amp;label=_yD_CJ6p5wkQspWj0wM&amp;guid=ON&amp;script=0"/>');
						
						// Bing Conversion Here
						$('body').prepend('<iframe src="//flex.msn.com/mstag/tag/c3d5d9e1-3667-4c2e-a590-4d38697752de/analytics.html?dedup=1&domainId=2822803&type=1&revenue='+num+'&actionid=242602" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe>');

						// SMS Conversion Here
						$('body').prepend('<img height="1" width="1" border="0" src="https://www.clickmeter.com/conversion.aspx?id=2272CA4741224F0AB7F18106021A99D5&val='+num+'&param=empty&com='+num+'" />');

						var go_url = "";
							
						if(typeof result.detail === 'object'){
							go_url = result.detail[0];
							go_url = go_url.replace(":80", "");						
						}
						else {
							go_url = result.detail;
						}
						
                        setTimeout(function(){ window.location.href = go_url ; }, 2000);
                    }
                }

            });

        }

    });
});

function lookupAddress(){
	var pc_error = "";
	
	if($("input[name='address_1']").val() == "" || $("input[name='post_code']").val() == ""){ 
		if($("input[name='address_1']").val() == ""){ pc_error = "Please enter your house number or name."; }
		if($("input[name='post_code']").val() == ""){ pc_error = "Please enter your postcode."; }
		$("#postcode-error-box").html(pc_error);
		$("#postcode-error-box").fadeIn();		
		
		return false;
	}
	 else { 
		$("#postcode-error-box").fadeOut(); 
	}
	
	$(".lookup").attr("disabled","disabled");
	$(".lookup").text("Searching...");
	
	PostcodeAnywhere("FY43-UG93-UR77-TX26",$("input[name='post_code']").val(),$("input[name='address_1']").val(),"DMOIN11111");
}

function PostcodeAnywhere(Key, Postcode, Building, UserName) {
    $.getJSON("https://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/RetrieveByPostcodeAndBuilding/v1.30/json3.ws?callback=?",
    {
        Key: Key,
        Postcode: Postcode,
        Building: Building,
        UserName: UserName
    },
    function (data) {
        // Test for an error
        if (data.Items.length == 1 && typeof(data.Items[0].Error) != "undefined") {
            // Show the error message
			$("#postcode-error-box").html(data.Items[0].Description);
			$("#postcode-error-box").fadeIn();
           // alert(data.Items[0].Description);
			$(".lookup").removeAttr("disabled");
			$(".lookup").text("Lookup Address");
        }
        else {
			$(".apierror").fadeOut();
            // Check if there were any items found
            if (data.Items.length == 0){
				$("#postcode-error-box").html("Oops we don't recognise your postcode, please enter your address manually or try again.");
				$("#postcode-error-box").fadeIn();
				$(".lookup").removeAttr("disabled");
				$(".lookup").text("Lookup Address");	
			}
            else {
				$("#postcode-error-box").fadeOut();
				$(".lookup").fadeOut();
				$("input[name='address_2']").val(data.Items[0].PrimaryStreet);
				$("input[name='town']").val(data.Items[0].PostTown);
				$("input[name='county']").val(data.Items[0].County);
            }
        }
    });
}




