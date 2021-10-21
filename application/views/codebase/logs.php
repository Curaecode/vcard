<?php $this->load->view('codebase/template/sidebar'); ?>
<?php $this->load->view('codebase/template/header'); ?>
<div class="block animated fadeIn">
	<div class="block-header block-header-default">
		<h3 class="block-title">
			Logs
		</h3>
	</div>
	 
	<!-- row #1 -->
	<!-- Dynamic Table Full -->
	<div class="block">
		<div class="block-content "> 
			<div class="row">
				 <div class='col-sm-12'>
					<textarea name="logs" wrap="off" readonly="readonly" class="form-control" rows="20" style="width:100%">
						<?php echo $logs; ?>
					</textarea>
				 </div>
			</div>  
		</div>
	</div>
</div> 
<footer id="page-footer" class="opacity-0">
	<div class="content py-20 font-size-xs clearfix">
	   <?php /*  <div class="float-right">
			Design and Developed  by <a class="font-w600" href="https://www.itvision.com.pk/" target="_blank">Itvision</a> 
		</div> */ ?>
		<div class="float-left">
			<a class="font-w600" href="#" target="_blank">Curaechoice</a> &copy; <span class="js-year-copy"><?php echo date('Y');?></span>
		</div>
	</div>
</footer>
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