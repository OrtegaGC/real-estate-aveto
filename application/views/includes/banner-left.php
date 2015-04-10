<div id="banner-left">
	<?php foreach ($banner as $value): ?>
	<div class="banner">
		<a target="_blank" href="<?php echo base_url(); ?>banner/id/<?php echo $value['bannerID'];?>"><img src="<?php echo base_url();?>uploads/banneri/<?php echo $value['slika'];?>" width="180" height="150" alt="<?php echo $value['naziv'];?>"/> </a>
	</div>
	<?php endforeach; ?>
</div>