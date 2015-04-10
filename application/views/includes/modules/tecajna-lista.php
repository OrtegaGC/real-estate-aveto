					<div id="tecajna-lista" class="pocisti">
						<div class="tecajna-naslov"> <?php echo lang('com_mod_tecajna_lista'); ?> </div>
							<table>
								<tr class="row_bg-podnaslov">
									<td class="tecajna-podnaslov-glavni"> <?php echo lang('com_mod_tecajna_lista_valuta'); ?> </td>
									<td class="tecajna-podnaslov-glavni"> # </td>
									<td class="tecajna-podnaslov-glavni"> <?php echo lang('com_mod_tecajna_lista_kupovni'); ?> </td>
									<td class="tecajna-podnaslov-glavni"> <?php echo lang('com_mod_tecajna_lista_prodajni'); ?> </td>
									<td class="tecajna-podnaslov-glavni"> <?php echo lang('com_mod_tecajna_lista_srednji'); ?> </td>
								</tr>
								<?php 
									$i = 0;
									foreach ($tecajna->ExchRate->Currency as $value): 
										$i ++;
										if ($i % 2 == 0): 
								?>
								<tr class="row row_bg">
									<td class="tecajna-podnaslov row_bg"><?php echo $value->Name;?> <img src="<?php echo base_url();?>modules/tecajna_lista/images/<?php echo $value->Name;?>.png" width="16" height="11" alt="flag" /> </td>
									<td class="row_bg"><?php echo $value->Unit;?></td>
									<td class="row_bg"><?php echo substr ($value->BuyRateForeign, 0, -3);?></td>
									<td class="row_bg"><?php echo substr ($value->SellRateForeign, 0, -3);?></td>
									<td class="row_bg"><?php echo substr ($value->MeanRate, 0, -3);?></td>
								</tr>
									<?php else: ?>
								<tr class="row">
									<td class="tecajna-podnaslov"><?php echo $value->Name;?> <img src="<?php echo base_url();?>modules/tecajna_lista/images/<?php echo $value->Name;?>.png" width="16" height="11" alt="flag" /> </td>
									<td><?php echo $value->Unit;?></td>
									<td><?php echo substr ($value->BuyRateForeign, 0, -3);?></td>
									<td><?php echo substr ($value->SellRateForeign, 0, -3);?></td>
									<td><?php echo substr ($value->MeanRate, 0, -3);?></td>
								</tr>
									<?php endif; ?>
							<?php endforeach;?>
							</table>
							
							<div id="tecajna-kalkulator">
								<div class="vrsta-tecaja">
									<p class="pocisti">
										<span> <label class="tecaj-1"><?php echo lang('com_mod_tecajna_lista_kupovni'); ?></label> <input type="radio" name="tecaj" value="kupovni" /> </span>
										<span> <label class="tecaj-2"><?php echo lang('com_mod_tecajna_lista_prodajni'); ?></label> <input type="radio" name="tecaj" value="prodajni" /> </span>
										<span> <label class="tecaj-3"><?php echo lang('com_mod_tecajna_lista_srednji'); ?></label> <input type="radio" name="tecaj" value="srednji" checked="checked"/> </span>
									</p>
								</div>
								<div class="tecaj">
									<input class="tecajna-iznos" type="text" name="iznos" value="<?php echo lang('com_mod_tecajna_lista_iznos'); ?>" />
									<select id="valuta1" name="valuta1">
										<option class="1" value="1,00">HRK</option>
									<?php foreach($tecajna->ExchRate->Currency as $value): ?>
										<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
									<?php endforeach;?>
									</select>
									<span class="tecajna-tekst-1"><?php echo lang('com_mod_tecajna_lista_u_valutu'); ?></span>
									<select id="valuta2" name="valuta2">
										<option class="1" value="1,00">HRK</option>
									<?php foreach($tecajna->ExchRate->Currency as $value): ?>
										<option class="<?php echo $value->Unit;?>" value="<?php echo substr ($value->MeanRate, 0, -3);?>"><?php echo $value->Name;?></option>
									<?php endforeach; ?>
									</select>
								</div>
								<div class="kalkulator-button"> 
									<p> <input id="izracunaj" type="button" value="<?php echo lang('com_mod_tecajna_lista_izracunaj'); ?>" /> </p>
								</div>
								<div class="greska"></div>
							<div class="rezultat"></div>
						</div>
					</div>