<br>
<p style="color:rgb(0,100,200);font-size:25px;">CROATIA AVETO Portal za oglašavanje u turizmu</p>
<br>
<div class="content-left">
				<br>
<br>
<p style="color:rgb(0,100,200);font-size:25px;">Ispostava računa:</p>
				<br>
<p style="color:rgb(0,100,200);font-size:25px;">ScandiEuro d.o.o.</p>
<br>
<p style="line-height:2;font-size:14px;">DIREKCIJA
<br>
Remetinečka cesta 75
<br>
10 020 (Novi Zagreb)</p>
<br>
<br>
<p style="color:rgb(0,100,200);font-size:25px;">Radno vrijeme:</p>
<br>
<p style="line-height:2;font-size:14px;">Ponedjeljak - Petak: 8 - 16 h</p>
<br>				
<p style="color:rgb(0,100,200);font-size:25px;">Uprava:</p>
<br>
<p style="line-height:2;font-size:14px;">
Tel: <span style="float: right;margin-right: 450px;">+385 1/ 888 77 00</span>
<br>
Fax:<span style="float:right;margin-right:450px;"> +385 1 / 777 81 20</span>
<br>
E-mail:<span style="float:right;margin-right:450px;"> info@scandieuro.hr</span>
<br>
OIB: <span style="float:right;margin-right:450px;"> 82441801113</span>
<br>
MB: <span style="float:right;margin-right:450px;"> 0244023</span>
<br>
IBAN: <span style="float:right;margin-right:450px;"> HR2123600001101307437</span>
<br>
SWIFT: <span style="float:right;margin-right:450px;"> ZABAHR2X</span></p>
<br>
<br>
<form id="kontakt" method="post" title="Kontakt forma" >
<p style="color:rgb(0,100,200);font-size:25px;">Pošaljite nam poruku</p>
<br>
<br>
<p style="font-size:14px;font-weight:bold;margin-bottom:5px;">Ime i prezime*</p>
<input type="text" maxlength="40" style="width:200px;font-family:Arial;"  name="ime" required="required" placeholder="Polje obavezno popunite!" />
<br>
<br>
<p style="font-size:14px;font-weight:bold;margin-bottom:5px;">E-mail adresa*</p>
<input type="text" maxlength="40" style="width:200px;font-family:Arial;" name="email" required="required" placeholder="Polje obavezno popunite!" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"/>
<br>
<br>
<img src="/includes/images/email.png" style="float: right;margin-top:-250px;margin-right:50px;">
<p style="font-size:14px;font-weight:bold;margin-bottom:5px;">Tekst poruke*</p>
<textarea name="poruka" cols="40" rows="8" style="height:250px;width:550px;font-family:Arial;font-size:13px;" placeholder="Polje obavezno popunite!"></textarea>
<br />
<br />
<input type="submit" name="posalji" id="submit" value="Pošalji" />
</form>
<?php
if(isset($_POST['email'])) {
     
    $email_to = "info@scandieuro.hr";
    $email_subject = "Croatia Aveto-Kontakt";
      
    function died($error) {

        echo "Žao nam je ali desile su se neke pogreške u Vašoj poruci. ";
        echo "Desile su se ove greške.<br /><br />";
        echo $error."<br /><br />";
        echo "Molimo Vas vratite se nazad i ispravite greške.<br /><br />";
        die();
    }
     
    if(!isset($_POST['ime']) ||
        !isset($_POST['email']) ||
        !isset($_POST['poruka'])) {
        died('Žao nam je ali desile su se neke pogreške u Vašoj poruci.');      
    }
     
    $ime = $_POST['ime']; 
    $email_from = $_POST['email']; 
    $poruka = $_POST['poruka']; 
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Vaša email adresa nije validna.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$ime)) {
    $error_message .= 'Vaše ime nije validno.<br />';
  }
  if(strlen($poruka) < 2) {
    $error_message .= 'Vaša poruka nije validna.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Detalji poruke:\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Ime: ".clean_string($ime)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Tekst: ".clean_string($poruka)."\n";
     
     
// raspored elemenata poruke
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
?>
<br>
<br> 
<p style="font-size:20px;color:red;">Hvala Vam što ste nas kontaktirali! Odgovoriti ćemo Vam u što kraćem roku!</p>
 
<?php
}
?>
</div>