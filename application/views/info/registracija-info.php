<!-- head -->
	<!-- SADRŽAJ -->
	<!-- Takeover left -->
	<div class="pocisti" id="takeover-wrapper">
		<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
		<div id="content-wrapper">
			<div id="content" class="content-registracija pocisti">
				<!-- Banner top -->
				<?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<div class="<?php echo $class; ?>">
						<p> <?php echo lang('registracija_info');?> </p>
					</div>
				</div>
				<div class="content-right">
					<!-- Login -->
					<?php require_once(APPPATH.'views/includes/modules/login.php');?>
					<!-- Tečajna lista -->
					<?php //require_once(APPPATH.'views/includes/modules/tecajna-lista.php');?>
					<!-- Social -->
					<?php //require_once(APPPATH.'views/includes/modules/social.php');?>
				</div>
				<!-- Banner bottom -->
				<?php require_once(APPPATH.'views/includes/banner-bottom.php'); ?>
			</div>
		</div>
		<!-- Takeover right -->
		<?php require_once(APPPATH.'views/includes/takeover-right.php'); ?>
	</div>
