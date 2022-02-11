<style type="text/css">
@font-face {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: normal;
		src: local('Roboto'), url('<?php echo base_url();?>cardassets/Roboto-Regular.woff') format('woff');
    }
     .card {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		border: 1px solid rgba(0,0,0,.125);
		border-radius: 0.25rem;
	}
	*, ::after, ::before {
		box-sizing: border-box;
	}
	body {
		<?php /* margin: 0;
		font-family: var(--bs-body-font-family);
		font-size: var(--bs-body-font-size);
		font-weight: var(--bs-body-font-weight);
		line-height: var(--bs-body-line-height);
		color: var(--bs-body-color);
		text-align: var(--bs-body-text-align);
		background-color: var(--bs-body-bg);
		-webkit-text-size-adjust: 100%;
		-webkit-tap-highlight-color: transparent; */ ?>
	}
	.card-body {
		flex: 1 1 auto;
		padding: 1rem 1rem;
	}
	.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
		margin-top: 0;
		margin-bottom: 0.5rem;
		font-weight: 500;
		line-height: 1.2;
	}
	.row {
		 --bs-gutter-x: 1.5rem;
		--bs-gutter-y: 0;
		display: flex;
		flex-wrap: wrap;
	} 
	.row>* {
		flex-shrink: 0;
		width: 100%;
		max-width: 100%;
		padding-right: calc(var(--bs-gutter-x) * .5);
		padding-left: calc(var(--bs-gutter-x) * .5);
		margin-top: var(--bs-gutter-y);
	}
	.col-sm-6 {
		flex: 0 0 auto;
		width: 50%; 
	}
	.col-sm-2 {
		flex: 0 0 auto;
		width: 16.66667%;
	}
	.col-sm-3 {
		flex: 0 0 auto;
		width: 25%;
	}
	.col-sm-5 {
		flex: 0 0 auto;
		width: 41.66667%;
	}
	.col-sm-8 {
		flex: 0 0 auto;
		width: 66.66667%;
	}
	.col-sm-7 {
		flex: 0 0 auto;
		width: 58.33333%;
	} 
	.col-sm-9 {
		flex: 0 0 auto;
		width: 75%;
	}
	.col-sm-12 {
		flex: 0 0 auto;
		width: 100%;
	}
	dt {
		font-weight: 700;
	} 
	.text-danger {
		--bs-text-opacity: 1;
		color: rgb(220, 53, 69) !important;
	}
		body{
			background:#f6f6f6;
			font-family: 'Roboto', sans-serif;
		}
		img, svg {
			vertical-align: middle;
		}
		.xcard{
			margin:25px;
			width:330px;
			background-color: #fff;
			transition: all .5s ease-in-out;
			position: relative;
			border: 0px solid transparent;
			border-radius: 8px;
			box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
			overflow:hidden;
			height:450px;
			float:left;
		}
		.xcard .card-head{
			background-image:url(<?php echo base_url();?>cardassets/bg.jpg);
			height:100px;
			width:100%; 
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
			    z-index: 9;
		}
		.xcard .card-head .avatar{
			width:241px;
			height:100px;
			display:block;
			margin: 5px auto 10px;
			border: 5px solid #fff;
			border-radius: 6px;
			box-shadow: 0px 2px 4px 2px rgb(0 0 0 / 15%);
		}
		.qravatar{
			width: 123px;
			height: 123px;
			display: block;
			margin: 0px auto 20px;
			border: 0px solid #fff;
		}
		.xcard .card-head .avatar img{
			width:100%;
			height: 100%;
		}
		.xcard .card-body{
			padding:60px 5px 5px 5px;
			background:#fff; 
			 
		}
		.xcard.back .card-body{
			padding:60px 5px 5px 5px;
			background:#fff;
			background-image:url(<?php echo base_url();?>cardassets/bg-texture-2.png);
			 
		}
		.xcard .card-body .card-heading{
			text-align:center;
			margin-bottom:15px;
		}
		.xcard .card-body .card-heading .card-title{
			margin:0px;
			font-weight:700;
			font-size:24px;
		}
		.xcard .card-body .card-heading .card-text{
			margin:0px;
			font-size:12px;
		}
		.xcard .card-body .user-data dl{
			margin:0px;
		}
		.xcard .card-body .user-data dt{
			font-size:12px;
		}
		.xcard .card-body .user-data dd{
			font-size:14px;
			text-align: left;
			margin: 0px;
			padding: 0px;
		}
		.xcard  .card-highlight{
			background:#242424;
			padding:10px 10px;
			text-align:center;
		}
		.xcard  .card-highlight p{
			font-size:10px;
			color:#fff;
			margin:0px;
		}
</style>		