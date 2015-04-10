<!-- header -->
	<div id="login-wrapper">
	<h1 style="font-size:30px;text-align:center;"><span style="color:#0064c8;">Croatia</span>-<span style="color:#ea3d15;">Aveto</span><br><br> ADMINISTRACIJA</h1>
		<div class="login-content">
			<?php if(isset($greska)) echo '<p class="error">'.$greska.'</p>'; ?>
			<?php echo form_open('index.php/ci_admin/prijava/provjera'); ?>
			<br>
			<br>
			<br>
			<p class="form-label"style="font-size:12pt;"> Korisničko ime  </p>
			<?php echo form_error('prijava_korisnicko_ime'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="prijava_korisnicko_ime"/> </p>
			<p class="form-label" style="font-size:12pt;"> Lozinka  </p>
			<?php echo form_error('prijava_lozinka'); ?>
			<p class="form-field"> <input class="type-text" type="password" name="prijava_lozinka"/> </p>
			<br>
			<br>
			<p class="submit"> <input type="submit" name="prijava" value="Prijava" /> </p>
		</form>
		</div>
	</div>
<!-- footer -->
	
