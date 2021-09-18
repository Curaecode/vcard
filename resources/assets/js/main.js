function isValidDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  if(!dateString.match(regEx)) return false;  // Invalid format
  var d = new Date(dateString);
  var dNum = d.getTime();
  if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
  return d.toISOString().slice(0,10) === dateString;
}
/*
console.log(isValidDate("0000-00-00"));  // false
console.log(isValidDate("2015-01-40"));  // false
console.log(isValidDate("2016-11-25"));  // true
console.log(isValidDate("1970-01-01"));  // true = epoch
console.log(isValidDate("2016-02-29"));  // true = leap day
console.log(isValidDate("2013-02-29"));  // false = not leap day
*/

function getcode(){
	var phone = $("#area_code").val()+''+$("#phone_first").val()+''+$("#phone_second").val();
	if(phone.length != 10){
		alert('not a valid Phone number');
	  return false;
	}	
	$.ajax({
		type: 'post',
		url: MAINURL+'subscriptions/getcode',
		data: $('#subscriptionform').serialize(),
		dataType:"json",
		success: function (result) {
			 console.log(result);
			 if(result.returned == false) {
				 alert('Please enter a valid phone number');
			 }else{
				 alert('A unique security code has been sent to your phone'); 
			 }
		}
	}); 
}
function getimagecode(){
	var phone = $("#area_code").val()+''+$("#phone_first").val()+''+$("#phone_second").val();
	if(phone.length != 10){
		alert('not a valid Phone number');
	  return false;
	}	
	$.ajax({
		type: 'post',
		url: MAINURL+'subscriptions/getimagecode',
		data: $('#cardform').serialize(),
		dataType:"json",
		success: function (result) {
			 console.log(result);
			 if(result.returned == false) {
				 alert('Please enter a valid phone number');
			 }else{
				 alert('A unique security code has been sent to your phone'); 
			 }
		}
	}); 
}

(function($) {

	"use strict";
	$('#submitbtn').prop('disabled', true); 
	if($("#area_code").length > 0){
		$("#area_code").keydown(function(event){
			if(event.which != 8){
				var charcters = $(this).val();
				console.log(charcters);
				if(charcters.length >=3){
					$('#phone_first').focus();
				}
			}
		});
		$("#area_code").keyup(function(event){
			if(event.which != 8){
				var charcters = $(this).val();
				console.log(charcters);
				if(charcters.length >=3){
					$('#phone_first').focus();
				}
			}
		});
	}
	if($("#phone_first").length > 0){
		$("#phone_first").keydown(function(event){ 
			if(event.which != 8){
				var charcters = $(this).val();
				if(charcters.length >=3){
					$('#phone_second').focus();
				}
			} 
		});
		$("#phone_first").keyup(function(event){
			if(event.which != 8){
				var charcters = $(this).val();
				if(charcters.length >=3){
					$('#phone_second').focus();
				}
			}
		});
	}
	if($("#phone_second").length > 0){
		$("#phone_second").keydown(function(event){ 
			if(event.which != 8){
				var charcters = $(this).val();
				if(charcters.length >=4){
					if($('#cardform').length > 0){
						$('#vcode').focus();
					}else{
						$('#dob').focus();
					}
				}
			}
		});
		$("#phone_second").keyup(function(event){
			if(event.which != 8){
				var charcters = $(this).val();
				if(charcters.length >=4){
					if($('#cardform').length > 0){
						$('#vcode').focus();
					}else{
						$('#dob').focus();
					}
				}
			}
		});
	}
	if($("#vcode").length > 0){
		$("#vcode").keydown(function(event){ 
			if(event.which != 8){
				var charcters = $(this).val();
				if(charcters.length >=6){
					$('#submitbtn').removeProp('disabled');
					$('#submitbtn').prop('disabled', false); 
				}else{
					$('#submitbtn').prop('disabled', true); 
				}
			}
		});
		$("#vcode").keyup(function(event){
			if(event.which != 8){
				var charcters = $(this).val();
				if(charcters.length >=6){
					$('#submitbtn').removeProp('disabled');
					$('#submitbtn').prop('disabled', false); 
				}else{
					$('#submitbtn').prop('disabled', true); 
				}
			}
		});
	}
	 
	
	if($('#subscriptionform').length > 0){
		$('#subscriptionform').on('submit', function (e) {
			 e.preventDefault();
			 var userinput = $('#email').val();
			var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

			if(!pattern.test(userinput)){
			  alert('not a valid e-mail address');
			  return false;
			}
			
			var phone = $("#area_code").val()+''+$("#phone_first").val()+''+$("#phone_second").val();
			 if(phone.length != 10){
				alert('not a valid Phone number');
			  return false;
			 }
			 /* var date = $("#year").val()+'-'+$("#month").val()+'-'+$("#day").val();*/
			 
			 var date = $("#dob").val();
			 var dob = date.split('/');
			 var orgdob = dob[2]+'-'+dob[0]+'-'+dob[1];
			 if(!isValidDate(orgdob)){
				 alert('Date of Birth is invalid.');
				 return false;
			 } 
			
		  $.ajax({
			type: 'post',
			url: MAINURL+'subscriptions/index',
			data: $('#subscriptionform').serialize(),
			dataType:"json",
			success: function (result) {
				if(result.returned == true) {
					 document.getElementById('subscriptionform').reset();
					alert('your data has been saved successfully');
					window.location.href=MAINURL+'qrcode/detail'; 
				}else{
					alert(result.msg);
				}
			}
		  });
		  return false;
		});
	}
	
	if($('#cardform').length > 0){
		$('#cardform').on('submit', function (e) {
			 e.preventDefault();
			 
			
			var phone = $("#area_code").val()+''+$("#phone_first").val()+''+$("#phone_second").val();
			 if(phone.length != 10){
				alert('not a valid Phone number');
			  return false;
			 }
			  
			
		  $.ajax({
			type: 'post',
			url: MAINURL+'curaechoice/card',
			data: $('#cardform').serialize(),
			dataType:"json",
			success: function (result) {
				if(result.returned == true) {
					 document.getElementById('cardform').reset();
					alert('your data has been saved successfully');
					window.location.href=MAINURL+''+result.path; 
				}else{
					alert(result.msg);
				}
			}
		  });
		  return false;
		});
	}
})(jQuery);
