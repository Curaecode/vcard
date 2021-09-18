<!doctype html>
<html lang="en">
  <head>
  	<title>Curaechoice | Your Ally in Care Coordination</title>
    
	</head>
	<body class="detail" style="display: flex;justify-content: center;">
		<img src="" alt="Card" id="cardimage" style="margin:0 auto;"/>
		<script src="<?php echo base_url();?>resources/codebase/assets/js/jquery.min.js"></script>
		<script type="text/javascript"> 
		function openlink(linkid){
			$('#linktype').val(linkid); 
			document.getElementById("linkform").submit();
			return false
		}
		 $(document).ready(function() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (p) { 
					   
					 $.ajax({
						url: "<?php echo base_url();?>curaechoice/savecardview",
						type: "post",
						data: {latitude:p.coords.latitude, longitude:p.coords.longitude,card:'<?php echo $filename;?>'} ,
						success: function (response) {

						   // You will get response from your PHP page (what you echo or print)
						},
						error: function(jqXHR, textStatus, errorThrown) {
						   console.log(textStatus, errorThrown);
						}
					});
					
					
					 $('#cardimage').attr('src',"<?php echo 'data:image/' . $type . ';base64,' . base64_encode($image);?>");
					 
				});
			} 
		 });
	   </script>
	   <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-G9E7HV7G7R"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-G9E7HV7G7R');
		</script>
	</body>
</html> 