<!DOCTYPE html><html class=''>
<head>   
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700'>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

<style>
body {
  background-color: #f9f9f9;
  font-family: lato;
}

.product {
  position: relative;
  width: 400px;
  margin: 50px auto;
}
.product.flip .fornt {
  -webkit-transform: perspective(400px) rotateY(-180deg);
          transform: perspective(400px) rotateY(-180deg);
}
.product.flip .back {
  -webkit-transform: perspective(400px) rotateY(0deg);
          transform: perspective(400px) rotateY(0deg);
  height: 400px;
}
.product > div {
  width: 400px;
  position: absolute;
  box-shadow: 0px 0px 6px 0px #ddd;
}
.product .fornt, .product .back {
  background-color: #fafafa;
  -webkit-transform: perspective(1000px) rotateY(0deg);
          transform: perspective(1000px) rotateY(0deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: -webkit-transform 0.5s ease-in-out;
  transition: -webkit-transform 0.5s ease-in-out;
  transition: transform 0.5s ease-in-out;
  transition: transform 0.5s ease-in-out, -webkit-transform 0.5s ease-in-out;
}
.product .fornt span.new, .product .back span.new {
  position: absolute;
  background: #77d596;
  color: #fff;
  font-size: 14px;
  left: 0;
  top: 0;
  cursor: pointer;
  padding: 11px 0 0 7px;
  width: 45px;
  height: 45px;
  display: inline-block;
  border-radius: 0% 0% 75% 0%;
  font-weight: 300;
}
.product .fornt .img-wrap, .product .back .img-wrap {
  padding: 50px 20px 30px;
  background-color: #fff; 
}
.product .fornt .img-wrap img, .product .back .img-wrap img {
  width: 341px;
  height:428px;
}
.product .fornt .img-wrap i, .product .back .img-wrap i {
  position: absolute;
  top: 13px;
  right: 13px;
  font-size: 20px;
  color: #EAEAEA;
  -webkit-transform: scale(1);
          transform: scale(1);
  cursor: pointer;
  -webkit-transition: -webkit-transform 0.15s ease-in-out;
  transition: -webkit-transform 0.15s ease-in-out;
  transition: transform 0.15s ease-in-out;
  transition: transform 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
}
.product .fornt .img-wrap i:hover, .product .back .img-wrap i:hover {
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
}
.product .fornt .img-wrap i.fav, .product .back .img-wrap i.fav {
  color: #fe7676;
}
.product .fornt .description, .product .back .description {
  position: relative;
  padding: 30px 15px 15px;
}
.product .fornt .description span.discount, .product .back .description span.discount {
  position: absolute;
  top: -24px;
  right: 15px;
  background-color: #FF6F6F;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  color: #fff;
  text-align: center;
  line-height: 40px;
  border-style: outset;
  border: 3px solid rgba(255, 255, 255, 0.55);
  box-sizing: content-box;
  font-weight: 300;
  font-size: 15px;
}
.product .fornt .description .content h3, .product .back .description .content h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 300;
  color: #696969;
}
.product .fornt .description .content p, .product .back .description .content p {
  margin: 10px 0 15px;
  font-size: 14px;
  font-weight: 300;
  color: #909090;
}
.product .fornt .description .price, .product .back .description .price {
  float: left;
}
.product .fornt .description .price .old-price, .product .back .description .price .old-price {
  font-size: 18px;
  color: #C3C3C3;
  font-weight: 300;
  margin-right: 10px;
}
.product .fornt .description .price .new-price, .product .back .description .price .new-price {
  font-size: 30px;
  font-weight: 300;
  color: #48AF6A;
}
.product .fornt .description .quick-detail, .product .back .description .quick-detail {
  background-color: #77d596;
  position: absolute;
  bottom: 0;
  right: 0;
  width: 40px;
  height: 40px;
  text-align: center;
  color: #fff;
  font-size: 27px;
  cursor: pointer;
}
.product .fornt .description .quick-detail i, .product .back .description .quick-detail i {
  -webkit-transform: translate(0px);
          transform: translate(0px);
  -webkit-transition: -webkit-transform 0.2s ease-in-out;
  transition: -webkit-transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
}
.product .fornt .description .quick-detail:hover i, .product .back .description .quick-detail:hover i {
  -webkit-transform: translateX(3px);
          transform: translateX(3px);
}
.product .fornt.back .img-wrap, .product .back.back .img-wrap {
  padding: 30px 20px 40px;
  position: relative;
}
.product .fornt.back .img-wrap .colors, .product .back.back .img-wrap .colors {
  position: absolute;
  right: 5px;
  top: 5px;
}
.product .fornt.back .img-wrap .colors .main-color, .product .back.back .img-wrap .colors .main-color {
  width: 18px;
  height: 18px;
  display: inline-block;
  border-radius: 50%;
  background-color: red;
  cursor: pointer;
}
.product .fornt.back .img-wrap .colors ul, .product .back.back .img-wrap .colors ul {
  margin: 0;
  padding: 0;
  width: 20px;
}
.product .fornt.back .img-wrap .colors ul li, .product .back.back .img-wrap .colors ul li {
  list-style: none;
  width: 18px;
  height: 18px;
  display: inline-block;
  border-radius: 50%;
  background-color: red;
}
.product .fornt.back .img-wrap ul.indicator, .product .back.back .img-wrap ul.indicator {
  position: absolute;
  bottom: -25px;
  left: 0;
  right: 0;
  margin: 0;
  padding: 0;
  text-align: center;
}
.product .fornt.back .img-wrap ul.indicator li, .product .back.back .img-wrap ul.indicator li {
  list-style: none;
  display: inline-block;
  width: 60px;
  height: 45px;
  border: 2px solid #ddd;
  margin: 0 3px;
  padding: 3px;
  line-height: 30px;
}
.product .fornt.back .img-wrap ul.indicator li img, .product .back.back .img-wrap ul.indicator li img {
  max-width: 100%;
}
.product .fornt.back .description .quick-detail, .product .back.back .description .quick-detail {
  background-color: #77d596;
  position: absolute;
  bottom: 0;
  left: 0;
}
.product .fornt.back .description .quick-detail:hover i, .product .back.back .description .quick-detail:hover i {
  -webkit-transform: rotate(180deg) translateX(3px);
          transform: rotate(180deg) translateX(3px);
}
.product .fornt.back .description .quick-detail i, .product .back.back .description .quick-detail i {
  -webkit-transform: rotate(180deg) translateX(0px);
          transform: rotate(180deg) translateX(0px);
}
.product .back {
  -webkit-transform: perspective(1000px) rotateY(180deg);
          transform: perspective(1000px) rotateY(180deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: -webkit-transform 0.5s ease-in-out;
  transition: -webkit-transform 0.5s ease-in-out;
  transition: transform 0.5s ease-in-out;
  transition: transform 0.5s ease-in-out, -webkit-transform 0.5s ease-in-out;
}
</style></head><body>
<div class="product"> 
	<!-- Fornt face of product -->
	<div class="fornt"> 
		<div class="img-wrap">
			 <img src="<?php echo base_url();?>curaechoice/cardimage/cc_ex_f_<?php echo md5($contactid);?>.png" alt="Avatar" did="<?php echo $contactid;?>"> 
		</div>
		<div class="description clearfix"> 
			<div class="quick-detail">
				<i class="fa fa-angle-right"></i>
			</div>
		</div>
	</div><!-- fornt -->
	
	<!-- Back face of product -->
	<div class="back">
		<div class="img-wrap">
				 <img src="<?php echo base_url();?>curaechoice/cardimage/cc_ex_b_<?php echo md5($contactid);?>.png" alt="Avatar">  
		</div><!-- /img-wrap --> 
		<div class="description clearfix">
			<div class="quick-detail">
				<i class="fa fa-angle-right"></i>
			</div>
		</div><!-- /description -->
		
	</div><!-- /back -->
	
</div><!-- /product -->
 
<script >$(document).ready(function(){
	 
	// flop
	$('.quick-detail').click(function(){
		$('.product').toggleClass('flip');
	});
	
	
});
//# sourceURL=pen.js
</script>
</body></html><?php /*


<?php $this->load->view('qrcode/widgets/header'); ?>
<style>
body {
    background: transparent;
	background-image: none;
}
</style>
	<body>
<style> 
.flip-card {
  background-color: transparent;
  width: 300px;
  height: 429px;
  border: 1px solid #f1f1f1;
  perspective: 1000px;  
}
 
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}
 
 
 
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;  
  backface-visibility: hidden;
}
 
.flip-card-front {
  background-color: #bbb;
  color: black;
}
 
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}

.flip-card.flip .flip-card-front {
  -webkit-transform: perspective(400px) rotateY(-180deg);
          transform: perspective(400px) rotateY(-180deg);
}
.flip-card.flip .flip-card-back {
  -webkit-transform: perspective(400px) rotateY(0deg);
          transform: perspective(400px) rotateY(0deg);
  height: 400px;
}

</style>

  <div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="<?php echo base_url();?>curaechoice/cardimage/cc_ex_f_<?php echo md5($contactid);?>.png" alt="Avatar" did="<?php echo $contactid;?>"> 
    </div>
    <div class="flip-card-back">
       <img src="<?php echo base_url();?>curaechoice/cardimage/cc_ex_b_<?php echo md5($contactid);?>.png" alt="Avatar">  
    </div>
  </div>
</div>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G9E7HV7G7R"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G9E7HV7G7R');
</script> 
</body>
</html>  */?>