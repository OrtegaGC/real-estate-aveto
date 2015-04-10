<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Administrator :: <?php echo $page_title; ?> </title>
		<meta name="robots" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width">
		<link rel="icon" href="<?php echo base_url(); ?>includes/images/favicon.ico" type="image/x-icon">	
		<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/reset.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/administrator-layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="<?php echo base_url();?>includes/js/jq-cookie.js"></script>
		<script src="<?php echo base_url();?>includes/js/jq-ui.js"></script>
		<?php if ($this->uri->segment(3) == 'novi_oglas' OR $this->uri->segment(3) == 'dodaj_slike' OR $this->uri->segment(3) == 'uredi_oglas' OR $this->uri->segment(3) == 'spremi_promjene_oglasa'): ?>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key=<?php echo $head['gmAPIkey'][0]['API_key']; ?>&sensor=false"> </script>
		<?php endif;?>
	</head>
	
	<body <?php if ($this->uri->segment(3) == 'novi_oglas' OR $this->uri->segment(3) == 'dodaj_slike') { echo 'onload="initialize()"'; } elseif($this->uri->segment(3) == 'uredi_oglas' OR $this->uri->segment(3) == 'spremi_promjene_oglasa') {echo 'onload="uredi()"'; }?>>