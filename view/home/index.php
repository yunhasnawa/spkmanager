<?php use framework\icf\library\Base; ?>
<?php include Base::site_dir('/view/header.php'); ?>
<?php include Base::site_dir('/view/nav.php'); ?>
<div class="spkmgr-container">
	<div style="text-align: center;">
		<h1 class="spkmgr-main-title">SPK Manager v1.0</h1>
		<h3>Dashboard / Summary</h3>
		<hr class="soften" />
		<?php echo $message; ?>
		<br />
		<br/>
		<a class="btn btn-warning" href="<?php echo 'http://' . Base::site_url('spk'); ?>">Buat SPK</a>
		<a class="btn btn-info" href="<?php echo 'http://' . Base::site_url('status'); ?>">Status SPK</a>
		<a class="btn btn-success" href="<?php echo 'http://' . Base::site_url('cetak'); ?>">Cetak SPK</a>
		<br/>
		<hr class="soften" />
		<br />
		<div class="span4"></div>
		<div class="span4">
			<table class="table table-striped">
				<tr>
					<th>Sekarang</th>
					<td><?php echo $this->date . ' ' . $this->time; ?></td>
				</tr>
				<tr>
					<th>Jumlah SPK</th>
					<td><?php echo $count; ?></td>
				</tr>
			</table>
		</div>
		<div class="span4"></div>
	</div>
</div>
<?php include Base::site_dir('/view/footer.php'); ?>