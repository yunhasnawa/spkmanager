<?php use framework\icf\library\Base; ?>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#"><?php echo $this->pageTitle; ?></a>
			<div class="btn-group pull-right">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-user"></i>&nbsp;<?php echo $this->_auth->getUsername(); ?>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="#">Profil</a>
					</li>
					<li class="devider"></li>
					<li>
						<a href="<?php echo 'http://' . Base::site_url('/auth/logout'); ?>">Keluar</a>
					</li>
				</ul>
			</div>
			<div class="nav-collapse">
				<ul class="nav">
					<li>
						<a href="<?php echo 'http://' . Base::site_url(); ?>">Dashboard</a>
					</li>
					<li>
						<a href="<?php echo 'http://' . Base::site_url('spk'); ?>">Buat SPK</a>
					</li>
					<li>
						<a href="<?php echo 'http://' . Base::site_url('status'); ?>">Status SPK</a>
					</li>
					<li>
						<a href="<?php echo 'http://' . Base::site_url('cetak'); ?>">Cetak SPK</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
