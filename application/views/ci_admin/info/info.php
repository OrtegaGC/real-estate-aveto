<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="info">
				<p> <?php echo $info?> </p>
				<p> <a href="<?php echo base_url();?>ci_admin/opcija/<?php echo $uri_segment;?>">Povratak</a></p>
			</div>
		</div>
	</div>
<!-- footer -->
	