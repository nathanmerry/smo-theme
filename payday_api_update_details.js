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
    return this.optional(element) || value != $("input[name='home_phone']").val();
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
	

    jQuery.support.cors = true;
    $("form.update input[name='dob']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:-19",
        defaultDate: "-0d -33y",
        maxDate: "-19y"
    });
    $("form.update input[name='next_payday']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "c:c+1",
        minDate: "+1d"
    });
    $("form.update input[name='second_payday']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "c:c+1",
        minDate: "+2d"
    });
    $("form.update input[name='employment_start']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:c",
        maxDate: "0"
    });
    $("form.update input[name='residence_start']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:c",
        maxDate: "0"
    });
    $("form.update input[name='bank_start']").datepicker({
        dateFormat: "dd-M-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1910:c",
        maxDate: "0"
    });	
    $("form.update .prefix .calendar-icon").click(function () {
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
	
		//$('form.update nemp input, form.update .unemp select').val('');
		
    });

  //  $("select[name='IS']").trigger('change');

    $('form.update').submit(function (e) {
        e.preventDefault();

        var validator = $("form.update").validate({
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
                }			
            }
        });
		
        if (validator.form()) {
			
            $('form.update').css('z-index', '-1');

            $('#update-submit').html('Saving...');
			
            $.ajax({
                type: 'POST',
                crossDomain: true,
                data: {
                    dob: $("form.update [name='dob']").val(),
                    email: $("form.update [name='email']").val(),
                    title: $("form.update [name='title']").val(),
                    first_name: $("form.update [name='first_name']").val(),
                    last_name: $("form.update [name='last_name']").val(),
                    home_phone: $("form.update [name='home_phone']").val(),
                    work_phone: $("form.update [name='work_phone']").val(),
                    mobile_phone: $("form.update [name='mobile_phone']").val(),
                    employer_name: $("form.update [name='employer_name']").val(),
                    employer_industry: $("form.update [name='employer_industry']").val(),
                    employment_start: $("form.update [name='employment_start']").val(),
                    monthly_income: $("form.update [name='monthly_income']").val(),
                    income_source: $("form.update [name='income_source']").val(),
                    pay_frequency: $("form.update [name='pay_frequency']").val(),
                    residence_status: $("form.update [name='residence_status']").val(),
                    address_1: $("form.update [name='address_1']").val(),
                    address_2: $("form.update [name='address_2']").val(),
                    town: $("form.update [name='town']").val(),
                    post_code: $("form.update [name='post_code']").val(),
                    county: $("form.update [name='county']").val(),
                    country: "GB",
                    residence_start: $("form.update [name='residence_start']").val(),
                    debit_card: $("form.update [name='debit_card']").val(),
                    sort_code: $("form.update [name='sort_code']").val(),
                    bank_account: $("form.update [name='bank_account']").val(),
                    paid_direct: $("form.update [name='paid_direct']").val(),
                    bank_name: $("form.update [name='bank_name']").val(),
					bank_start: $("form.update [name='bank_start']").val(),
                    user_agent: $("form.update [name='user_agent']").val(),
                    ip: $("form.update [name='ip']").val(),
					user_id: $("form.update [name='user_id']").val(),
					login_hash: $("form.update [name='login_hash']").val(),
					owner: "GIANT" // Set owner here.
                },
                url: 'proxy_update.php',
                success: function (data) {
					//alert(data);
					$(".success-box").fadeIn();
					$('#update-submit').html('<i class="fa fa-lock left"></i> Update Details');
					$('#update-submit').removeAttr("disabled");
					$("html, body").animate({ scrollTop: 0 }, "fast");
                }

            });

        }

    });
});

function lookupAddress(){
	if($("input[name='address_1']").val() == "" || $("input[name='post_code']").val() == ""){ 
		if($("input[name='address_1']").val() == ""){ $(".housenumbererror").fadeIn(); } else { $(".housenumbererror").fadeOut(); }
		if($("input[name='post_code']").val() == ""){ $(".pcerror").fadeIn(); } else { $(".pcerror").fadeOut(); }
		return false;
	}
	 else { 
		$(".pcerror").fadeOut(); 
		$(".housenumbererror").fadeOut();
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
			$(".apierror").html(data.Items[0].Description);
			$(".apierror").fadeIn();
           // alert(data.Items[0].Description);
			$(".lookup").removeAttr("disabled");
			$(".lookup").text("Lookup Address");
        }
        else {
			$(".apierror").fadeOut();
            // Check if there were any items found
            if (data.Items.length == 0){
				$(".apierror").html("Oops we don't recognise your postcode, please enter your address manually or try again.");
				$(".apierror").fadeIn();
				$(".lookup").removeAttr("disabled");
				$(".lookup").text("Lookup Address");	
			}
            else {
				$(".apierror").fadeOut();
				$(".lookup").fadeOut();
				$("input[name='address_2']").val(data.Items[0].PrimaryStreet);
				$("input[name='town']").val(data.Items[0].PostTown);
				$("input[name='county']").val(data.Items[0].County);
            }
        }
    });
}