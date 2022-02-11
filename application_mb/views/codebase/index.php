<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
		<h3 class="text-themecolor mb-0">Dashboard</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>
	</div> 
</div>

<div class="container-fluid">
	<div class="row">
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex align-items-center justify-content-center rounded-circle bg-info">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card fill-white feather-lg"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo  number_format($contacts); ?></h3>
							<h6 class="text-muted mb-0">Total Contacts</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex align-items-center justify-content-center rounded-circle bg-warning">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor fill-white feather-lg"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo number_format($emails->Recipients); ?></h3>
							<h6 class="text-muted mb-0">Total Recipients</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex align-items-center justify-content-center rounded-circle bg-warning">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor fill-white feather-lg"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo number_format($emails->EmailTotal); ?></h3>
							<h6 class="text-muted mb-0">Total Emails</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex align-items-center justify-content-center rounded-circle bg-primary">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag fill-white feather-lg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo number_format($emails->Delivered); ?></h3>
							<h6 class="text-muted mb-0">Email Delivered</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex justify-content-center align-items-center rounded-circle bg-danger">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield fill-white feather-lg"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo number_format($emails->Bounced); ?></h3>
							<h6 class="text-muted mb-0">Email Bounced</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex justify-content-center align-items-center rounded-circle bg-danger">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield fill-white feather-lg"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo number_format($emails->Opened); ?></h3>
							<h6 class="text-muted mb-0">Email Opened</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="round round-lg text-white d-flex justify-content-center align-items-center rounded-circle bg-danger">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield fill-white feather-lg"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
						</div>
						<div class="ms-2 align-self-center">
							<h3 class="mb-0"><?php echo number_format($emails->NotDelivered); ?></h3>
							<h6 class="text-muted mb-0">Email Not Delivered</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
	</div>
</div> 