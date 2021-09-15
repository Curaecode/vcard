<div class="row animated fadeIn fix_nw_box" >
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="1500"><?php echo  number_format($contacts); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Total Contacts</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="4252"><?php echo  number_format($groups); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Total Groups</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="4252"><?php echo  number_format($companies); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Total Companies</div>
			</div>
		</a>
	</div>
</div>

<div class="row animated fadeIn fix_nw_box" >
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="1500"><?php echo number_format($emails->Recipients); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Total Recipients</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?php echo number_format($emails->EmailTotal); ?>"><?php echo number_format($emails->EmailTotal); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Total Email</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?php echo number_format($emails->EmailTotal); ?>"><?php echo number_format($emails->Delivered); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Email Delivered</div>
			</div>
		</a>
	</div>
</div>	
<div class="row animated fadeIn fix_nw_box" >
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?php echo number_format($emails->EmailTotal); ?>"><?php echo number_format($emails->Bounced); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Email Bounced</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?php echo number_format($emails->EmailTotal); ?>"><?php echo number_format($emails->Opened); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Email Opened</div>
			</div>
		</a>
	</div>
	<div class="col-6 col-xl-3 box_f">
		<a class="block block-link-shadow text-right" href="javascript:void(0)">
			<div class="block-content block-content-full clearfix">
				<div class="float-left mt-10 d-none d-sm-block">
					<i class="si si-users fa-3x text-body-bg-dark"></i>
				</div>
				<div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?php echo number_format($emails->EmailTotal); ?>"><?php echo number_format($emails->NotDelivered); ?></div>
				<div class="font-size-sm font-w600 text-uppercase text-muted">Email Not Delivered</div>
			</div>
		</a>
	</div>
</div>