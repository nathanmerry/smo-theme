$(document).ready(function(e){



	/*
	**	Loan amount slider.
	*/
	setTimeout(function(){
	 	var Min_la= parseInt(document.getElementById('Min_la').value);
	 	var Max_la= parseInt(document.getElementById('Max_la').value);
	 if($("#loan-amount").length > 0)
	{
		$('#loan-amount').noUiSlider({
			start: [ 500 ],
			step: 10,
			range: {
				'min': [  Min_la ],
				'max': [ Max_la ]
			}
		});
		$('#loan-amount').Link('lower').to($('.show-loan-amount'), null,
			wNumb({
				decimals: 0,
				thousand: ',',
				prefix: '£',
			})
		);
		$("#loan-amount").noUiSlider_pips({
			mode: 'values',
			values: [Min_la,Max_la],
			//values: [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000],
			density: 4,
			format: wNumb({
				decimals: 0,
				prefix: '£'
			})
		});	
		
		$("#loan-amount").on('slide', function(){
			$(".show-loan-amount").html("£"+Math.round($(this).val()));
			slideUpdate(parseInt($(this).val()));
		});	

		$("document, body").on('change', 'input[name="loan-term"]', function(e){
			slideUpdate(parseInt($("#loan-amount").val()))		
		});
		
		slideUpdate(parseInt($("#loan-amount").val()));
	}
	},100)
	

	

	
	if($("#loan-amount-mobile").length > 0)
	{
		$("document, body").on('change', '#loan-amount-mobile', function(e){
			slideUpdateMobile();
		})
		.on('change', '#loan-term-mobile', function(e){
			slideUpdateMobile();
		});	

		slideUpdateMobile();
	}
	
	if($("#sidebox").length > 0)
	{
		if ($(window).width() > 970) {
		  var top = $('#sidebox').offset().top - parseFloat($('#sidebox').css('marginTop').replace(/auto/, 0));
		  var left = $("#sidebox").offset().left;
		  $(window).scroll(function (event) {
			// what the y position of the scroll is
			var y = $(this).scrollTop();
			$("#sidebox").css("left",left);
			// whether that's below the form
			if (y >= top) {
			  // if so, ad the fixed class
			  $('#sidebox').addClass('fixed');
			} else {
			  // otherwise remove it
			  $('#sidebox').removeClass('fixed');
			}
		  });
		}
	}
	
	$("document, body").on('click', '.read-more-toggle', function(e){
		
		var ele = $(this);
		var meth = $(this).attr('data-do');
		
		if(meth == "show")
		{
			$("#hidden-content").slideDown(function(e){
				ele.text('Read less.');
				ele.attr('data-do', 'hide');
			});
		}
		else 
		{
			$("#hidden-content").slideUp(function(e){
				ele.text('Read more.');
				ele.attr('data-do', 'show');
			});		
		}
		
		return false;
	});
});

function gotoApply(href){
	href += "?la=" + Math.round($("#loan-amount").val()) + "&lt=" + Math.round($('input[name="loan-term"]:checked').val());
	window.location.href = href;
}

function gotoApplyMobile(href){
	href += "?la=" + Math.round($("#loan-amount-mobile").val()) + "&lt=" + Math.round($("#loan-term-mobile").val());
	window.location.href = href;
}

function slideUpdate(money)
{	
	try {
	
		var days = $('input[name="loan-term"]:checked').val();
		
		//var total = money*(2.04)*(days/365);
		
		var total = money*(parseInt(document.getElementById('interestrates').value))*(days/365);
		
		var total_repay = (money + total).toFixed(2);
		
		var d = new Date();
		d.setDate(d.getDate() + days);
		var nd = new Date(d);
		
		if(nd.getMonth() == 11){
			nd.setMonth(0);
		}else{
			nd.setMonth(nd.getMonth()+1);
		}
		if(nd.getDay()==0){fullDay = 'Sunday';}
		else if(nd.getDay()==1){fullDay = 'Monday';}
		else if(nd.getDay()==2){fullDay = 'Tuesday';}
		else if(nd.getDay()==3){fullDay = 'Wednesday';}
		else if(nd.getDay()==4){fullDay = 'Thursday';}
		else if(nd.getDay()==5){fullDay = 'Friday';}
		else if(nd.getDay()==6){fullDay = 'Saturday';}
		
		if(nd.getMonth() == 1){fullMonth = 'January';}
		else if(nd.getMonth() == 2){fullMonth = 'February';}
		else if(nd.getMonth() == 3){fullMonth = 'March';}
		else if(nd.getMonth() == 4){fullMonth = 'April';}
		else if(nd.getMonth() == 5){fullMonth = 'May';}
		else if(nd.getMonth() == 6){fullMonth = 'June';}
		else if(nd.getMonth() == 7){fullMonth = 'July';}
		else if(nd.getMonth() == 8){fullMonth = 'August';}
		else if(nd.getMonth() == 9){fullMonth = 'September';}
		else if(nd.getMonth() == 10){fullMonth = 'October';}
		else if(nd.getMonth() == 11){fullMonth = 'November';}
		else if(nd.getMonth() == 0){fullMonth = 'December';}
		
		$('.show-loan-date').html(fullDay+', '+nd.getDate()+' '+fullMonth+', '+nd.getFullYear());		
		$('.show-loan-total').html("£"+total_repay);
		$('.show-loan-term').html(days + " Months");
		$('.show-loan-interest').html("£"+(total).toFixed(2));			
	} 
	catch (e) {}
}

function slideUpdateMobile()
{	
	try {

		var money = parseFloat($("#loan-amount-mobile").val());
		var days = parseFloat($("#loan-term-mobile").val());
		
		var total = money*(2.04)*(days/365);
		var total_repay = (money + total).toFixed(2);
		
		var d = new Date();
		d.setDate(d.getDate() + days);
		var nd = new Date(d);
		
		if(nd.getMonth() == 11){
			nd.setMonth(0);
		}else{
			nd.setMonth(nd.getMonth()+1);
		}
		if(nd.getDay()==0){fullDay = 'Sunday';}
		else if(nd.getDay()==1){fullDay = 'Monday';}
		else if(nd.getDay()==2){fullDay = 'Tuesday';}
		else if(nd.getDay()==3){fullDay = 'Wednesday';}
		else if(nd.getDay()==4){fullDay = 'Thursday';}
		else if(nd.getDay()==5){fullDay = 'Friday';}
		else if(nd.getDay()==6){fullDay = 'Saturday';}
		
		if(nd.getMonth() == 1){fullMonth = 'January';}
		else if(nd.getMonth() == 2){fullMonth = 'February';}
		else if(nd.getMonth() == 3){fullMonth = 'March';}
		else if(nd.getMonth() == 4){fullMonth = 'April';}
		else if(nd.getMonth() == 5){fullMonth = 'May';}
		else if(nd.getMonth() == 6){fullMonth = 'June';}
		else if(nd.getMonth() == 7){fullMonth = 'July';}
		else if(nd.getMonth() == 8){fullMonth = 'August';}
		else if(nd.getMonth() == 9){fullMonth = 'September';}
		else if(nd.getMonth() == 10){fullMonth = 'October';}
		else if(nd.getMonth() == 11){fullMonth = 'November';}
		else if(nd.getMonth() == 0){fullMonth = 'December';}

		$('.show-loan-date').html(fullDay+', '+nd.getDate()+' '+fullMonth+', '+nd.getFullYear());
		
		$('.show-loan-total').html("£"+total_repay);
		$('.show-loan-term').html(days + " Months");
		$('.show-loan-amount').html("£"+money);
		$('.show-loan-interest').html("£"+(total).toFixed(2));			
	} 
	catch (e) {}
}
