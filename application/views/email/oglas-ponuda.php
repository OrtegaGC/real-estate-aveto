<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html> 
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<p>Korisnik <strong><?php echo $korisnicko_ime;?></strong> objavio je novi oglas.</p>
		<p> <a href="<?php echo base_url();?>index.php/oglas/detalji/<?php echo $id;?>"> <?php echo base_url();?>index.php/oglas/detalji/<?php echo $id;?> </a> </p>
	</body>
</html>