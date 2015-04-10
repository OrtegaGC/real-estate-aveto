<!DOCTYPE html>
<html> 
	<head>
		<?php echo meta('Content-type', 'text/html; charset='.config_item('charset'), 'equiv');?>
		<title>Nekretnine Aveto</title>
                <base href="<?php echo base_url(); ?>" />
		<meta name="robots" content="index, follow">
		<meta name="description" content="<?php echo $head['meta'][0]['description']; ?>">
		<meta name="keywords" content="<?php echo $head['meta'][0]['keywords']; ?>" >
		<meta name="viewport" content="width=device-width">
		<link rel="icon" href="<?php echo base_url(); ?>includes/images/favicon.ico" type="image/x-icon">	
		<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/layout.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<?php if ($this->uri->segment(1) == 'korisnik'): ?>
		<script src="<?php echo base_url();?>includes/js/jq-ui.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.css" />
		<?php endif;?>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key=<?php echo $head['gmAPIkey'][0]['API_key']; ?>&sensor=false"> </script>
		<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
	</head>
	<?php
		$js = '';
		if($this->uri->segment(2) == 'novi_oglas' OR $this->uri->segment(2) == 'dodaj_slike') {
			$js .=' onload="initialize()"'; 
		} elseif ($this->uri->segment(1) == 'oglas' AND $this->uri->segment(2) == 'regija' OR $this->uri->segment(1) == 'potraznja' AND $this->uri->segment(2) == 'regija') {
			 $js .= ' onload="mjesta();"'; 
		} elseif ($this->uri->segment(1) == 'oglas' AND $this->uri->segment(2) == 'detalji') {
			 $js .=' onload="objekt();"'; 
		} elseif ($this->uri->segment(1) == 'korisnik' AND $this->uri->segment(2) == 'uredi_oglas' OR $this->uri->segment(1) == 'korisnik' AND $this->uri->segment(2) == 'spremi_promjene' ) {
			 $js .=' onload="uredi();"'; 
		}
	?>
	<body<?php echo $js;?>>