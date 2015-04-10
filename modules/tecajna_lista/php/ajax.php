<?php
	
	$xml_url = '../xml/tecajna_lista_local.xml';

	$tecajna_lista = file_get_contents($xml_url);

	$xml = simplexml_load_string($tecajna_lista, NULL, LIBXML_NOCDATA);
	
	if(isset($_POST['tecaj']) && !$_POST['lang']): ?>
		<?php if($_POST['tecaj'] == 'kupovni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Iznos" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">u valutu</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'srednji'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Iznos" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">u valutu</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'prodajni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Iznos" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">u valutu</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php endif?>
	<?php endif;?>
	
	<?php if($_POST['lang'] == 'en'):?>
	
		<?php if($_POST['tecaj'] == 'kupovni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'srednji'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'prodajni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php endif;?>
	
	<?php endif;?>
	
	
	<?php if($_POST['lang'] == 'de'):?>
	
		<?php if($_POST['tecaj'] == 'kupovni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'srednji'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'prodajni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php endif;?>
	
	<?php endif;?>
	
	
	<?php if($_POST['lang'] == 'it'):?>
	
		<?php if($_POST['tecaj'] == 'kupovni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'srednji'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'prodajni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php endif;?>
	
	<?php endif;?>
	
	
	<?php if($_POST['lang'] == 'fr'):?>
	
		<?php if($_POST['tecaj'] == 'kupovni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->BuyRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'srednji'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php elseif($_POST['tecaj'] == 'prodajni'):?>
		
			<input class="tecajna-iznos" type="text" name="iznos" value="Amount" />
			<select id="valuta1" name="valuta1">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			<span class="tecajna-tekst-1">curren.</span>
			<select id="valuta2" name="valuta2">
				<option class="1" value="1,00">HRK</option>
				<?php foreach($xml->ExchRate->Currency as $value): ?>
					<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->SellRateForeign, 0, -3);?>"><?php echo $value->Name;?></option>
				<?php endforeach;?>
			</select>
			
		<?php endif;?>
	
	<?php endif;?>