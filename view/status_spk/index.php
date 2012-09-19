<?php use framework\icf\library\Base; ?>
<?php include Base::site_dir('/view/header.php'); ?>
<?php include Base::site_dir('/view/nav.php'); ?>
<?php echo Base::js('StatusSpk'); ?>
<script type="text/javascript">
app = new StatusSpk('<?php echo 'http://'. Base::site_url('/status/ajax_change_status'); ?>');
function filterByDate(url)
{
	var from = $("#from_date")[0];
	var to = $("#to_date")[0];
	var f = from.value;
	var t = to.value;
	var spltF = f.split('-');
	var spltT = t.split('-');
	var df = spltF[2] + '-' + spltF[1] + '-' + spltF[0];
	var dt = spltT[2] + '-' + spltT[1] + '-' + spltT[0];
	var tgt = url + '?df=' + df + '&dt=' + dt;
	window.location = tgt;
}
</script>
<div class="spkmgr-container" style="height: 1280px;">
	<div style="text-align: center;">
		<h2>Status SPK</h2>
		<hr class="soften" />
		<div class="spkmgr-toolbar">
			<div class="span7">
				<form method="post" action="<?php echo "http://" . Base::site_url('/status'); ?>">
					<fieldset class="spkmgr-toolbar-fieldset">
						<div class="span4 spkmgr-toolbar-span-input" style="margin-left: 10px;">
  							<select name="search_field" class="input input-medium">
  								<?php foreach($full_heading as $field) { ?>
									<option value="<?php echo $field; ?>"><?php echo Base::spucfirst(str_replace('_', ' ', $field)); ?></option>
								<?php } ?>
  							</select>  
  						</div>
						<div class="span4 spkmgr-toolbar-span-input">
  							<input type="text" class="input input-large spkmgr-input" placeholder="masukkan kata kunci" name="keyword">  
  						</div>
  						<div class="span2 spkmgr-toolbar-span-input-right">
  							<input type="submit" class="btn btn-primary" value="Cari" />
  						</div>
  					</fieldset>  
				</form> 
			</div>
			<div class="span5">
				<div class="spkmgr-sw">
					<div class="span12">
						<input type="text" class="input input-small datepicker" placeholder="dari tanggal" id="from_date" name="from_date" value="<?php Base::savecho($tanggal, date("d-m-Y")); ?>" />
						s.d.
						<input type="text" class="input input-small datepicker" placeholder="tanggal" id="to_date" name="to_date" value="<?php Base::savecho($tanggal, date("d-m-Y")); ?>" />
						<a style="margin-right:10px; float:right;" class="btn btn-success" href="#" onclick="filterByDate('<?php echo 'http://' . Base::site_url('/status'); ?>');">Saring</a>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="span12">
			<table class="table table-striped">
				<thead>
					<tr>
						<?php foreach($heading as $field) { ?>
  						<?php if($field == 'status') $field = 'jenis'; ?>
  						<?php if($field == 'status_produksi') $field = 'status'; ?>
						<th><?php echo Base::spucfirst(str_replace('_', ' ', $field)); ?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $row) { ?>
						<?php $id = $row['nomor']; ?>
						<tr>
							<?php foreach ($heading as $field) { ?>
								<?php if($field !== 'status') { ?>
									<td><?php echo $row[$field]; ?></td>
								<?php } else { ?>
									<td><input class="input input-small" type="text" value="<?php echo $row[$field]; ?>" readonly="readonly" ondblclick="app.enableEdit(this);" onkeypress="app.changeStatus(event.keyCode, <?php echo $id; ?>);" /></td>
								<?php } ?>
							<?php } ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include Base::site_dir('/view/footer.php'); ?>