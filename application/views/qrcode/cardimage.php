<?php $this->load->view('qrcode/widgets/header'); ?>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'>
<style>
body {
    background: transparent;
	background-image: none;
} 
 
.flip-card {
  background-color: transparent;
  width: 315px;
  height: 429px;
  border: 1px solid #f1f1f1;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
  margin: 20px auto;
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card.flip .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #bbb;
  color: black;
}

/* Style the back side */
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
} 
 
.quick-detail { 
  box-shadow:inset 0px 1px 3px 0px #91b8b3;
	background:linear-gradient(to bottom, #1fa1d5 5%, #1fa1d5 100%);
	background-color:#1fa1d5;
	border-radius:5px;
	border:1px solid #1fa1d5;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:11px 23px;
	text-decoration:none;
	text-shadow:0px -1px 0px #2b665e;
	width: 100%;
	margin:20px auto;
}
.quick-detail i{
	margin-right:5px;
  -webkit-transform: translate(0px);
          transform: translate(0px);
  -webkit-transition: -webkit-transform 0.2s ease-in-out;
  transition: -webkit-transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
}
.quick-detail:hover i {
  -webkit-transform: translateX(3px);
          transform: translateX(3px);
}

 .flip-card .flip-card-back .description .quick-detail i {
    -webkit-transform: rotate(180deg) translateX(0px);
    transform: rotate(180deg) translateX(0px);
}
.flip-card .flip-card-back .description .quick-detail {
    background-color:#242424; 
}
</style>
<body>
  <div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="<?php echo base_url();?>curaechoice/cardimage/cc_ex_f_<?php echo md5($contactid);?>.png" alt="Avatar" did="<?php echo $contactid;?>"> 
	  <div class="description clearfix"> 
			<div class="quick-detail">
				<i class="fa fa-repeat"></i> Click here to view the back
			</div>
		</div>
    </div>
    <div class="flip-card-back">
       <img src="<?php echo base_url();?>curaechoice/cardimage/cc_ex_b_<?php echo md5($contactid);?>.png" alt="Avatar">  
	   <div class="description clearfix"> 
			<div class="quick-detail">
				<i class="fa fa-undo"></i> Click here to view the front
			</div>
		</div>
    </div>
  </div>
</div>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G9E7HV7G7R"></script>
<script >
$(document).ready(function(){
	  
	$('.quick-detail').click(function(){
		$('.flip-card').toggleClass('flip');
	});
	
	
});
//# sourceURL=pen.js
 
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G9E7HV7G7R');
</script> 
</body>
</html>