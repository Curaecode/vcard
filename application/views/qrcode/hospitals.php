<?php $this->load->view('qrcode/widgets/header'); ?>
	<body class="detail"> 
		<div class="container-flex">  
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="<?php echo $url;?>" allowfullscreen  name="iFrame1"></iframe>
			</div> 
		</div> 
<?php $this->load->view('qrcode/widgets/footer'); ?> 
	</body>
</html> 