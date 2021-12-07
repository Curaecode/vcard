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
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
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
.flip-card:hover .flip-card-inner {
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
</html>  