<?php use framework\icf\library\Base; ?>
<?php include Base::site_dir('/view/header.php'); ?>
<?php include Base::site_dir('/view/nav.php'); ?>
<?php echo Base::js('CetakSpk'); ?>
<script type="text/javascript">
app = new CetakSpk('<?php echo 'http://'. Base::site_url('/cetak/preview?id=' . $nomor); ?>');
</script>
<div class="spkmgr-container">
	<div style="text-align: center;">
		<h2>Cetak SPK</h2>
		<hr class="soften" />
		<div class="spkmgr-toolbar">
			<div class="span8">
				<form>
					<fieldset class="spkmgr-toolbar-fieldset">
						<div class="span2 spkmgr-toolbar-span-label">
  							<label for="nomor">Nomor SPK: </label>  
  						</div>
						<div class="span6 spkmgr-toolbar-span-input">
  							<input type="text" class="input input-xlarge spkmgr-input" placeholder="masukkan nomor spk" name="nomor" value="<?php echo $nomor; ?>" />  
  						</div>
  						<div class="span3 spkmgr-toolbar-span-input-right">
  							<a class="btn btn-primary" href="<?php echo "http://" . Base::site_url('/status'); ?>">Cari</a>
  						</div>
  					</fieldset>  
				</form> 
			</div>
			<div class="span4">
				<div class="spkmgr-sw">
					<div class="span6"></div>
					<div class="span6">
						<div class="btn-group">
							<button id="btn_lihat" class="btn btn-warning" onclick="app.getReport();">Lihat</button>
							<button id="btn_cetak" class="btn btn-success" onclick="app.printReport();">Cetak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include Base::site_dir('/view/footer.php'); ?>