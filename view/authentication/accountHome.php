<?php use framework\icf\library\Base; ?>
<?php include Base::site_dir('/view/header.php'); ?>
<div class="span4">&nbsp;</div>
<div class="span4">
	<form class="spkmgr-login-form" method="post" action="<?php echo "http://" . Base::site_url('auth/login'); ?>">
		<div class="span2">&nbsp;</div>
		<div class="span9">
		<fieldset>
			<br/>
			<br/>
			<br/>
			<h1 class="spkmgr-main-title">SPK Manager v1.0</h1>
			<h3>Login to Access</h3>
			<hr class="soften" />
			<?php if(!empty($message)) { ?>
			<div class="alert alert-error">
				<a class="close" data-dismiss="alert">x</a>
				<strong>Error: </strong><?php echo $message; ?>
			</div>
			<?php } ?>
			<div class="control-group">
				<label class="control-label spkmgr-label" for="username">Username</label>
				<div class="control">
					<input type="text" name="username" placeholder="type a username" value="" class="input-xlarge spkmgr-input"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label spkmgr-label" for="password">Password</label>
				<div class="control">
					<input type="password" name="password" placeholder="type the password" value="" class="input-xlarge spkmgr-input" />
				</div>
			</div>
			<div class="control-group">
				<div class="control">
					<input type="submit" name="submit" value="Submit" class="btn btn-primary spkmgr-login-button" />
				</div>
			</div>
			<br class="clear"/>
			<br class="clear"/>
			<br class="clear"/>
			<br class="clear"/>
			<p />
			<!--p class="copyright">&copy 2012 <strong>Centralindo Jaya Software + Yunhasnawa</strong></p-->
		</fieldset>
		</div>
		<div class="span1">&nbsp;</div>
	</form>
	</div>
<div class="span4">&nbsp;</div>

<?php include Base::site_dir('/view/footer.php'); ?>