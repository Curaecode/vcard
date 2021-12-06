var system = require('system');
var webPage = require('webpage'); 
var page = webPage.create();

var args = system.args;
 


if (args.length < 2 || args.length > 3) {
    console.log('Usage: rasterize.js URL filename');
    phantom.exit();
} else {
    address = args[1];
    
    output = args[2];
	 
  
page.viewportSize = {
width: 300,
height: 400
};    


var requestsArray = [];
page.paperSize = { 
					format: 'A4', 
					orientation: 'portrait', 
					margin: '0cm',
					footer: {
						height: "0.8cm",
						contents: phantom.callback(function(pageNum, numPages) {
							
								var monthNames = [
									"January", "February", "March",
									"April", "May", "June", "July",
									"August", "September", "October",
									"November", "December"
								  ];
								  var date=new Date();
								  var day = date.getDate();
								  var monthIndex = date.getMonth();
								  var year = date.getFullYear();
								  
								  var hour = date.getHours();
								  var minute = date.getMinutes();
								  var second = date.getSeconds();
								  var ampm = hour < 12 ? 'AM' : 'PM';
								  var hours = hour % 12;	
						  return "";
						})
					  } 
				};
page.zoomFactor = 0.95;	

page.settings.userAgent = 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:94.0) Gecko/20100101 Firefox/94.0'; 
/* page.settings.userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36';  */
/* page.settings.userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36';  */
/* page.settings.userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';  */ 			
page.onResourceRequested = function(requestData, networkRequest) {
requestsArray.push(requestData.id);
};

page.onResourceReceived = function(response) {
var index = requestsArray.indexOf(response.id);
requestsArray.splice(index, 1);
};
 
page.open(address, function(status) { 
	var interval = setInterval(function () { 
		if (requestsArray.length === 0) { 
			clearInterval(interval);
			if(output.substr(-4) !== ".png"){
				var time = Math.rnd();
				output=output+"_"+time+".png"
			}
			page.render(output);
			phantom.exit();
		}
	}, 3000);
});	

}