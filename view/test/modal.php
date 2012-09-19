<?php use framework\icf\library\Base; ?>
<?php include Base::site_dir('/view/header.php'); ?>
<div class="container">
	<h2>Example of creating Modals with Twitter Bootstrap</h2>
	<script type="text/javascript">
	function retFalse(){return false;}
	function retTrue(){return true;}
	</script>
	<div id="example" class="modal hide fade in" style="display: none; ">
		<div class="modal-header" style="background-color: #FE9A2E;">
			<a class="close" data-dismiss="modal">x</a>
			<h3>Perhatian!</h3>
		</div>
		<div class="modal-body">
			<h4>Apakah Anda yakin akan menghapus data ini?</h4>
			<p>Data yang telah dihapus tidak bisa dikembalikan lagi.</p>		        
		</div>
		<div class="modal-footer">
			<a href="javascript:retTrue()" class="btn btn-danger" style="width: 50px;">Ya</a>
			<a href="javascript:retFalse()" class="btn btn-info" style="width: 50px;" data-dismiss="modal">Tidak</a>
		</div>
	</div>
	<p><a data-toggle="modal" href="#example" class="btn btn-primary btn-large">Launch demo modal</a></p>
</div>
<?php include Base::site_dir('/view/footer.php'); ?>