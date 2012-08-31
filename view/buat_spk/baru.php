<?php use framework\icf\library\Base; ?>
<?php include Base::site_dir('/view/header.php'); ?>
<?php include Base::site_dir('/view/nav.php'); ?>
<div class="spkmgr-container" style="height: 1500px;">
	<div style="text-align: center;">
		<h2><?php echo isset($nomor) ? 'Edit SPK Nomor #' . $nomor : 'Buat SPK Baru' ?></h2>
		<hr class="soften" />
		<form enctype="multipart/form-data" method="post" action="<?php echo "http://" . Base::site_url('spk/save'); ?>">
			<fieldset>
				<div>
					<div class="hero-unit spkmgr-group span8">
						<div>
							<div class="span4">
							</div>
							<div class="span8">
								<h2 style="text-align: left;">SPK</h2>
							</div>
						</div>
						<div>
							<div class="span8">
								<div class="control-group">
									<label class="control-label spkmgr-label" for="nomor">Nomor</label>
									<div class="control">
									<input type="text" name="nomor" placeholder="nomor SPK" value="<?php Base::savecho($nomor, ''); ?>" class="input-xlarge spkmgr-input" readonly="readonly" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label spkmgr-label" for="tanggal">Tanggal</label>
									<div class="control">
									<input type="text" name="tanggal" placeholder="tanggal dibuat" value="<?php Base::savecho($tanggal, date("d-m-Y")); ?>" class="input-xlarge spkmgr-input datepicker"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label spkmgr-label" for="ref">Ref</label>
									<div class="control">
									<input type="text" name="ref" placeholder="ref" value="<?php Base::savecho($ref, ''); ?>" class="input-xlarge spkmgr-input"/>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label spkmgr-label" for="status">Status</label>
									<div class="control">
									<input type="text" name="status" placeholder="status" value="<?php Base::savecho($status, ''); ?>" class="input-xlarge spkmgr-input" onclick="this.value='';"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="hero-unit spkmgr-group span4">
						<table class="table">
							<tr>
								<td><strong style="color: white;">PUTIH</strong></td>
								<td>PRODUKSI</td>
							</tr>
							<tr>
								<td><strong style="color: red;">MERAH</strong></td>
								<td>PPIC</td>
							</tr>
							<tr>
								<td><strong style="color: yellow;">KUNING</strong></td>
								<td>BAHAN</td>
							</tr>
							<tr>
								<td><strong style="color: green;">HIJAU</strong></td>
								<td>MARKETING</td>
							</tr>
						</table>
					</div>
				</div>
				<div>
					<div class="hero-unit spkmgr-group span7">
						<div class="control-group">
							<label class="control-label spkmgr-label" for="customer">Customer</label>
							<div class="control">
							<input type="text" name="customer" placeholder="nama customer" value="<?php Base::savecho($customer, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="alamat_kirim">Alamat Kirim</label>
							<div class="control">
							<textarea name="alamat_kirim" placeholder="alamat pengiriman" class="input-xlarge spkmgr-input"><?php Base::savecho($alamat_kirim, ''); ?></textarea>
							</div>
						</div>
						<br style="margin-bottom:8px" />
						<hr class="soften" />
						<div class="control-group">
							<label class="control-label spkmgr-label" for="item">Item</label>
							<div class="control">
							<input type="text" name="item" placeholder="item" value="<?php Base::savecho($item, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="order">Order</label>
							<div class="control">
							<input type="text" name="order" placeholder="jumlah pesanan" value="<?php Base::savecho($order, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="toleransi">Toleransi</label>
							<div class="control">
							<input type="text" name="toleransi" placeholder="toleransi" value="<?php Base::savecho($toleransi, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="bahan">Bahan</label>
							<div class="control">
							<input type="text" name="bahan" placeholder="bahan yang digunakan" value="<?php Base::savecho($bahan, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="ukuran">Ukuran</label>
							<div class="control">
							<input type="text" name="ukuran" placeholder="PxL mm" value="<?php Base::savecho($ukuran, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="warna">Warna</label>
							<div class="control">
							<input type="text" name="warna" placeholder="warna yang digunakan" value="<?php Base::savecho($warna, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="finishing">Finishing</label>
							<div class="control">
							<input type="text" name="finishing" placeholder="finishing" value="<?php Base::savecho($finishing, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="bentuk_potongan">Bentuk Potongan</label>
							<div class="control">
							<input type="text" name="bentuk_potongan" placeholder="bentuk potongan" value="<?php Base::savecho($bentuk_potongan, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="catatan_stiker">Catatan</label>
							<div class="control">
							<input type="text" name="catatan_stiker" placeholder="catatan stiker" value="<?php Base::savecho($catatan_stiker, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="file_stiker">Stiker</label>
							<div class="control">
								<input type="file" name="file_stiker" placeholder="file stiker" class="input-xlarge spkmgr-input"/>
								<?php if(isset($file_stiker) && !empty($file_stiker)) { ?>
								<br />
								<br />
								<img style="border: 1px solid black;" src="<?php echo $file_stiker; ?>" width="185" height="185" />
								<?php } ?>
							</div>
						</div>
					</div>
					<!-- END OF LEFT BOTTOM GROUP -->
					<div class="hero-unit spkmgr-group span5">
						<div class="control-group">
							<label class="control-label spkmgr-label" for="nomor_po">No. PO</label>
							<div class="control">
							<input type="text" name="nomor_po" placeholder="nomor PO" value="<?php Base::savecho($nomor_po, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="permintaan_kirim">Permintaan Kirim</label>
							<div class="control">
							<input type="text" name="permintaan_kirim" placeholder="permintaan pengiriman" value="<?php Base::savecho($permintaan_kirim, date("d-m-Y")); ?>" class="input-xlarge spkmgr-input datepicker" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="tanggal_kirim">Tanggal Kirim</label>
							<div class="control">
							<input type="text" name="tanggal_kirim" placeholder="tanggal pesanan dikirim" value="<?php Base::savecho($tanggal_kirim, date("d-m-Y")); ?>" class="input-xlarge spkmgr-input datepicker" />
							</div>
						</div>
						<hr class="soften" />
						<!-- RIGHT BOTTOM GROUP -->
						<div class="control-group">
							<label class="control-label spkmgr-label" for="mesin">Mesin</label>
							<div class="control">
							<input type="text" name="mesin" placeholder="mesin yang digunakan" value="<?php Base::savecho($mesin, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="data">Data</label>
							<div class="control">
							<input type="text" name="data" placeholder="data" value="<?php Base::savecho($data, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="bentuk_pisau">Bentuk Pisau</label>
							<div class="control">
							<input type="text" name="bentuk_pisau" placeholder="bentuk pisau" value="<?php Base::savecho($bentuk_pisau, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="list">List</label>
							<div class="control">
							<input type="text" name="list" placeholder="list" value="<?php Base::savecho($list, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="nomor_pisau">No. Pisau</label>
							<div class="control">
							<input type="text" name="nomor_pisau" placeholder="nomor pisau" value="<?php Base::savecho($nomor_pisau, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="nomor_silinder">No. Silinder</label>
							<div class="control">
							<input type="text" name="nomor_silinder" placeholder="cylinder" value="<?php Base::savecho($nomor_silinder, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="nomor_piringan">No. Piringan</label>
							<div class="control">
							<input type="text" name="nomor_piringan" placeholder="plate" value="<?php Base::savecho($nomor_piringan, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="alokasi_bahan">Alokasi Bahan</label>
							<div class="control">
							<input type="text" name="alokasi_bahan" placeholder="alokasi bahan" value="<?php Base::savecho($alokasi_bahan, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label spkmgr-label" for="catatan">Catatan</label>
							<div class="control">
							<input type="text" name="catatan" placeholder="catatan" value="<?php Base::savecho($catatan, ''); ?>" class="input-xlarge spkmgr-input"/>
							</div>
						</div>
					</div>
				</div>
				<div class="span12">
					<div>
						<input class="btn btn-success" type="submit" name="submit" value="Simpan" />
						<input class="btn btn-warning" type="reset" name="reset" value="Reset" />
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<br class="clear" />
<br class="clear" />
<?php include Base::site_dir('/view/footer.php'); ?>