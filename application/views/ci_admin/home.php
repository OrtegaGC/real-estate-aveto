<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<p> <a href="<?php echo base_url();?>ci_admin/opcija/db_backup_desktop">Backup baze na lokalno računalo</a></p>
			<p> <a href="<?php echo base_url();?>ci_admin/opcija/db_backup_server">Backup baze na server</a></p>
		</div>
	</div>
<!-- footer -->
	
