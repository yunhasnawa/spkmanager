<?php use framework\icf\library\Base; ?>

<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Yoppy Yunhasnawa" />
    <link rel="stylesheet" href="framework/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="framework/bootstrap/plugin/datepicker/css/datepicker.css" />
    <script type="text/javascript" src="framework/jquery/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="framework/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="framework/bootstrap/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<title><?php echo $this->windowTitle; ?></title>
</head>
<body>
<?php echo Base::css('style'); ?>
<?php echo Base::js('main'); ?>
<?php echo Base::js('MessageBox');?>
<div id="main_container" class="container-fluid">
<div id="main_wrapper" class="row-fluid">
