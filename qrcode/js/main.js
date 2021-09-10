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

(function($) {

	"use strict";
	
	$("#area_code").keyup(function(){
		var charcters = $(this).val();
		console.log(charcters);
		if(charcters.length ==3){
			$('#phone_first').focus();
		}
	});
	$("#phone_first").keyup(function(){
		var charcters = $(this).val();
		if(charcters.length ==3){
			$('#phone_second').focus();
		}
	});
	$("#phone_second").keyup(function(){
		var charcters = $(this).val();
		if(charcters.length ==4){
			$('#day').focus();
		}
	});
	
	
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
		 var date = $("#year").val()+'-'+$("#month").val()+'-'+$("#day").val();
		 console.log(date);
		 if(!isValidDate(date)){
			 alert('Date of Birth is invalid.');
			 return false;
		 }
		
	  $.ajax({
		type: 'post',
		url: 'https://www.curaechoice.net/subscriptions/index',
		data: $('#subscriptionform').serialize(),
		success: function () {
			document.getElementById('subscriptionform').reset();
			alert('form was submitted');
			window.location.href='detail.php';
		}
	  });
	  return false;
	});
})(jQuery);
