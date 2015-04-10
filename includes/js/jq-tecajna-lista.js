// -- 
// -- @ Tečajna lista
// -- @ datum: 06.03.2013.
// -- @ autor: Sinisa Vrbancic
// -- @ e-mail: sinisa.vrbancic@gmail.com
// --

$(document).ready(function(){

	var url = window.location.pathname;
	var result = new Array();
	result[1] = url.search('/en/');
	result[2] = url.search('/de/');
	result[3] = url.search('/it/');
	result[4] = url.search('/fr/');
	
	
	$('[name=tecaj]').change(function(){
		$('.rezultat').html(''); // brisanje prethodnih rezultata
		$('.greska').html(''); // brisanje prethodnih rezultata
		var tecaj = $('[name=tecaj]:checked').val();
		var dataString = 'tecaj='+tecaj;
		$.ajax
		({
			type: "POST",
			url: 'modules/mod_tecajna_lista/includes/php/ajax.php',
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".tecaj").html(html);
			} 
		});
	});
	
	$('.tecajna-iznos').click(function(){
		$('.tecajna-iznos').val('');
	});
	
	$('#izracunaj').click(function(){
		var iznos = $('.tecajna-iznos').val();
		var val1 = $('#valuta1 option:selected').text();
		var val2 = $('#valuta2 option:selected').text();
		var unit1 = parseInt($('#valuta1 option:selected').attr('class'));
		var unit2 = parseInt($('#valuta2 option:selected').attr('class'));
		var valuta1 = $('#valuta1 option:selected').val().replace(',', '.');
		var valuta2 = $('#valuta2 option:selected').val().replace(',', '.');
		
		if(iznos == '')
		{
			$('.greska').html('<p>Unesite iznos!</p>');
			$('.rezultat').html('');
		}else{
			$('.greska').html('');
			var greska = false;
			var regex = /^[0-9]+(\.[0-9]{1,4})?$/;

			if( ! (iznos.match(regex))) {   
				greska = true;
			}

			if(greska == true) {
				$('.rezultat').html('');
				$('.greska').html('<p>Unos mora biti broj!</p>');
			} else {
				var rezultat = parseFloat( (iznos / unit1) * (valuta1 / valuta2) * unit2 ).toFixed(3);
				$('.rezultat').html('<p> <strong>'+iznos+'</strong> '+val1+' = <strong>'+rezultat+'</strong> '+val2+'.</p>');
			}
		}
	});
	
	if(result[1] != -1) // -- engleski
	{
		$('[name=tecaj]').change(function(){
			$('.rezultat').html(''); // brisanje prethodnih rezultata
			$('.greska').html(''); // brisanje prethodnih rezultata
			var tecaj = $('[name=tecaj]:checked').val();
			var dataString = 'tecaj='+tecaj+'&lang=en';
			$.ajax
			({
				type: "POST",
				url: '../modules/mod_tecajna_lista/includes/php/ajax.php',
				data: dataString,
				cache: false,
				success: function(html)
				{
					$(".tecaj").html(html);
				} 
			});
			
		});
	
		$('.tecajna-iznos').click(function(){
			$('.tecajna-iznos').val('');
		});
	
		$('#izracunaj').click(function(){
			var iznos = $('.tecajna-iznos').val();
			var val1 = $('#valuta1 option:selected').text();
			var val2 = $('#valuta2 option:selected').text();
			var unit1 = parseInt($('#valuta1 option:selected').attr('class'));
			var unit2 = parseInt($('#valuta2 option:selected').attr('class'));
			var valuta1 = $('#valuta1 option:selected').val().replace(',', '.');
			var valuta2 = $('#valuta2 option:selected').val().replace(',', '.');
		
			if(iznos == '')
			{
				$('.greska').html('<p>Enter the amount!</p>');
				$('.rezultat').html('');
			}else{
				$('.greska').html('');
				var greska = false;
				var regex = /^[0-9]+(\.[0-9]{1,4})?$/;

				if( ! (iznos.match(regex))) {   
					greska = true;
				}

				if(greska == true) {
					$('.rezultat').html('');
					$('.greska').html('<p>Input must be a number!</p>');
				} else {
					var rezultat = parseFloat( (iznos / unit1) * (valuta1 / valuta2) * unit2 ).toFixed(3);
					$('.rezultat').html('<p> <strong>'+iznos+'</strong> '+val1+' = <strong>'+rezultat+'</strong> '+val2+'.</p>');
				}
			}
		});
	}else if (result[2] != -1){ // -- njemački
		$('[name=tecaj]').change(function(){
			$('.rezultat').html(''); // brisanje prethodnih rezultata
			$('.greska').html(''); // brisanje prethodnih rezultata
			var tecaj = $('[name=tecaj]:checked').val();
			var dataString = 'tecaj='+tecaj+'&lang=de';
			$.ajax
			({
				type: "POST",
				url: '../modules/mod_tecajna_lista/includes/php/ajax.php',
				data: dataString,
				cache: false,
				success: function(html)
				{
					$(".tecaj").html(html);
				} 
			});
		});
	
		$('.tecajna-iznos').click(function(){
			$('.tecajna-iznos').val('');
		});
	
		$('#izracunaj').click(function(){
			var iznos = $('.tecajna-iznos').val();
			var val1 = $('#valuta1 option:selected').text();
			var val2 = $('#valuta2 option:selected').text();
			var unit1 = parseInt($('#valuta1 option:selected').attr('class'));
			var unit2 = parseInt($('#valuta2 option:selected').attr('class'));
			var valuta1 = $('#valuta1 option:selected').val().replace(',', '.');
			var valuta2 = $('#valuta2 option:selected').val().replace(',', '.');
		
			if(iznos == '')
			{
				$('.greska').html('<p>Unesite iznos!</p>');
				$('.rezultat').html('');
			}else{
				$('.greska').html('');
				var greska = false;
				var regex = /^[0-9]+(\.[0-9]{1,4})?$/;

				if( ! (iznos.match(regex))) {   
					greska = true;
				}

				if(greska == true) {
					$('.rezultat').html('');
					$('.greska').html('<p>Unos mora biti broj!</p>');
				} else {
					var rezultat = parseFloat( (iznos / unit1) * (valuta1 / valuta2) * unit2 ).toFixed(3);
					$('.rezultat').html('<p> <strong>'+iznos+'</strong> '+val1+' = <strong>'+rezultat+'</strong> '+val2+'.</p>');
				}
			}
		});
	}else if (result[3] != -1){ // --talijanski
		$('[name=tecaj]').change(function(){
			$('.rezultat').html(''); // brisanje prethodnih rezultata
			$('.greska').html(''); // brisanje prethodnih rezultata
			var tecaj = $('[name=tecaj]:checked').val();
			var dataString = 'tecaj='+tecaj+'&lang=it';
			$.ajax
			({
				type: "POST",
				url: '../modules/mod_tecajna_lista/includes/php/ajax.php',
				data: dataString,
				cache: false,
				success: function(html)
				{
					$(".tecaj").html(html);
				} 
			});
		});
	
		$('.tecajna-iznos').click(function(){
			$('.tecajna-iznos').val('');
		});
	
		$('#izracunaj').click(function(){
			var iznos = $('.tecajna-iznos').val();
			var val1 = $('#valuta1 option:selected').text();
			var val2 = $('#valuta2 option:selected').text();
			var unit1 = parseInt($('#valuta1 option:selected').attr('class'));
			var unit2 = parseInt($('#valuta2 option:selected').attr('class'));
			var valuta1 = $('#valuta1 option:selected').val().replace(',', '.');
			var valuta2 = $('#valuta2 option:selected').val().replace(',', '.');
		
			if(iznos == '')
			{
				$('.greska').html('<p>Unesite iznos!</p>');
				$('.rezultat').html('');
			}else{
				$('.greska').html('');
				var greska = false;
				var regex = /^[0-9]+(\.[0-9]{1,4})?$/;

				if( ! (iznos.match(regex))) {   
					greska = true;
				}

				if(greska == true) {
					$('.rezultat').html('');
					$('.greska').html('<p>Unos mora biti broj!</p>');
				} else {
					var rezultat = parseFloat( (iznos / unit1) * (valuta1 / valuta2) * unit2 ).toFixed(3);
					$('.rezultat').html('<p> <strong>'+iznos+'</strong> '+val1+' = <strong>'+rezultat+'</strong> '+val2+'.</p>');
				}
			}
		});
	}else if (result[4] != -1){ // -- francuski
		$('[name=tecaj]').change(function(){
			$('.rezultat').html(''); // brisanje prethodnih rezultata
			$('.greska').html(''); // brisanje prethodnih rezultata
			var tecaj = $('[name=tecaj]:checked').val();
			var dataString = 'tecaj='+tecaj+'&lang=fr';
			$.ajax
			({
				type: "POST",
				url: '../modules/mod_tecajna_lista/includes/php/ajax.php',
				data: dataString,
				cache: false,
				success: function(html)
				{
					$(".tecaj").html(html);
				} 
			});
		});
	
		$('.tecajna-iznos').click(function(){
			$('.tecajna-iznos').val('');
		});
	
		$('#izracunaj').click(function(){
			var iznos = $('.tecajna-iznos').val();
			var val1 = $('#valuta1 option:selected').text();
			var val2 = $('#valuta2 option:selected').text();
			var unit1 = parseInt($('#valuta1 option:selected').attr('class'));
			var unit2 = parseInt($('#valuta2 option:selected').attr('class'));
			var valuta1 = $('#valuta1 option:selected').val().replace(',', '.');
			var valuta2 = $('#valuta2 option:selected').val().replace(',', '.');
		
			if(iznos == '')
			{
				$('.greska').html('<p>Unesite iznos!</p>');
				$('.rezultat').html('');
			}else{
				$('.greska').html('');
				var greska = false;
				var regex = /^[0-9]+(\.[0-9]{1,4})?$/;

				if( ! (iznos.match(regex))) {   
					greska = true;
				}

				if(greska == true) {
					$('.rezultat').html('');
					$('.greska').html('<p>Unos mora biti broj!</p>');
				} else {
					var rezultat = parseFloat( (iznos / unit1) * (valuta1 / valuta2) * unit2 ).toFixed(3);
					$('.rezultat').html('<p> <strong>'+iznos+'</strong> '+val1+' = <strong>'+rezultat+'</strong> '+val2+'.</p>');
				}
			}
		});
	}
});