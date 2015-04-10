$(document).ready(function() {
	// -- brisanje oglasa
	(function( $ ){ 
		$.fn.izbrisiOglas = function(selector) { 
			$(selector).click(function() {
		var id = $(this).attr('id');
		$("#dialog-confirm").dialog({
			resizable : false,
			modal : true,
			buttons : {
				"Izbriši" : function() {
					var dataString = 'id=' + id;
					$.ajax({
						type : "POST",
						url : "../../../ajax/izbrisi_korisnika",
						data : dataString,
						cache : false,
						success : function(html) {
							$(".info").html(html);
							$('.info').css('display', 'block');
							window.setTimeout(function(){location.reload();}, 2000);
						}
					});
					$(this).dialog("close");
				},
				"Odustani" : function() {
					$(this).dialog("close");
				}
			}
		});
	});
		}; 
	})( jQuery );
	
	// -- izbriši korisnika
	$('.izbrisi-korisnika').click(function() {
		var id = $(this).attr('id');
		$("#dialog-confirm").dialog({
			resizable : false,
			modal : true,
			buttons : {
				"Izbriši" : function() {
					var dataString = 'id=' + id;
					$.ajax({
						type : "POST",
						url : "../../../ajax/izbrisi_korisnika",
						data : dataString,
						cache : false,
						success : function(html) {
							$(".info").html(html);
							$('.info').css('display', 'block');
							window.setTimeout(function(){location.reload();}, 2000);
						}
					});
					$(this).dialog("close");
				},
				"Odustani" : function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	// -- filter korisnika po datumu
	/*$(function() {
		$('.popis-korisnika #datum_od, .popis-korisnika #datum_do').datepicker({minDate: null, maxDate: 0 });
	}); */
	
	
	$(function() {
		$(".popis-korisnika #datum_od").datepicker({
            changeMonth: true,
            minDate: null,
            maxDate: 0,
            onSelect: function (selectedDate) {
                //var fromDate = new Date(selectedDate);
                var input = selectedDate;
				var arrInput = input.split('.');
				var fromDate = new Date(arrInput[1] + '/' + arrInput[0] + '/' + arrInput[2]);
				var minDate  = new Date(fromDate.setDate(fromDate.getDate()));

                $(".popis-korisnika #datum_do").datepicker("option", "minDate", minDate);
                $(".popis-korisnika #datum_do").datepicker("option", "maxDate", 0);
                
                var datum = '/'+$('#datum_od').val();
				var url = $('#filtriraj').attr('href');
				$('#filtriraj').attr('href', url+datum);
            }
        });
        
        $(".popis-korisnika #datum_do").datepicker({
            changeMonth: true,
            onSelect: function(selectedDate) {
            
                var input1 = selectedDate;
				var arrInput1 = input1.split('.');
				var toDate = new Date(arrInput1[1] + '/' + arrInput1[0] + '/' + arrInput1[2]);
				
				var datum = '/'+$('#datum_do').val()+'/';
				var url = $('#filtriraj').attr('href');
				$('#filtriraj').attr('href', url+datum);
            }
        });
		
	});
	
	// -- izbriši oglas
	$('.izbrisi-oglas').click(function() {
		var id = $(this).attr('id');
		$("#dialog-izbrisi").dialog({
			resizable : false,
			modal : true,
			buttons : {
				"Izbriši" : function() {
					var dataString = 'id=' + id;
					$.ajax({
						type : "POST",
						url : "../../ajax/izbrisi_oglas",
						data : dataString,
						cache : false,
						success : function(html) {
							$(".info").html(html);
							$('.info').css('display', 'block');
							window.setTimeout(function(){location.reload();}, 2000);
						}
					});
					$(this).dialog("close");
				},
				"Odustani" : function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	// -- aktiviraj oglas
	$('.aktiviraj-oglas').click(function() {
		var id = $(this).attr('id');
		$("#dialog-aktiviraj").dialog({
			resizable : false,
			modal : true,
			buttons : {
				"Aktiviraj" : function() {
					var dataString = 'id=' + id;
					$.ajax({
						type : "POST",
						url : "../../ajax/aktiviraj_oglas",
						data : dataString,
						cache : false,
						success : function(html) {
							$(".info").html(html);
							$('.info').css('display', 'block');
							window.setTimeout(function(){location.reload();}, 2000);
						}
					});
					$(this).dialog("close");
				},
				"Odustani" : function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	// -- deaktiviraj oglas
	$('.deaktiviraj-oglas').click(function() {
		var id = $(this).attr('id');
		$("#dialog-deaktiviraj").dialog({
			resizable : false,
			modal : true,
			buttons : {
				"Deaktiviraj" : function() {
					var dataString = 'id=' + id;
					$.ajax({
						type : "POST",
						url : "../../ajax/deaktiviraj_oglas",
						data : dataString,
						cache : false,
						success : function(html) {
							$(".info").html(html);
							$('.info').css('display', 'block');
							window.setTimeout(function(){location.reload();}, 2000);
						}
					});
					$(this).dialog("close");
				},
				"Odustani" : function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	// -- datepicker
	$(function() {
		$('[name=datum_isteka]').datepicker();
	}); 
	
	// -- popis mjesta u županiji
	$('#zupanija').change(function() {
		var id=$(this).val();
		var dataString = 'id='+ id;
		var homeUrl = 'http://croatia-aveto.com.hr/';

		$.ajax
		({
			type: "POST",
			url: homeUrl+"ajax/mjesto",
			beforeSend: function(html)
			{
				$('.loading').css('display', 'block');
			},
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#mjesto").html(html);
				$('.loading').css('display', 'none');
			} 
		});
	});
	
	// -- prikazi mjesta
	$('#prikazi-mjesta').click(function() {
		var id=$('[name=regijaID]').val();
		var dataString = 'id='+ id;
		var homeUrl = 'http://croatia-aveto.com.hr/';

		$.ajax
		({
			type: "POST",
			url: homeUrl+"ajax/popis_mjesta",
			beforeSend: function(html)
			{
				$('.loading').css('display', 'block');
			},
			data: dataString,
			cache: false,
			success: function(html)
			{
				$('#popis-mjesta').html(html);
				$('#popis-mjesta').css('display', 'block');
				$('#sakrij-mjesta').css('display', 'inline-block');
				$('#prikazi-mjesta').css('display', 'none');
				$('.loading').css('display', 'none');
			} 
		});
	});
	
	// -- live search (korisnikID)
	$('#ime_korisnika').keyup(function() {
		$('#korisnik-rezultati').css('display', 'block');
		if($(this).val().length > 2) {
			var ime = $(this).val();
			var dataString = 'ime_korisnika='+ime;
			var homeUrl = 'http://croatia-aveto.com.hr/';
			
			$.ajax
			({
				type: "POST",
				url: homeUrl+"ajax/korisnik",
				beforeSend: function(html)
				{
					$('.loading-0').css('display', 'block');
				},
				data: dataString,
				cache: false,
				success: function(html)
				{
					$('.loading-0').css('display', 'none');
					$('#korisnik-rezultati').html(html);
					$('.izaberi').on("click", function() {
						var id = $(this).attr('id');
						var string = $(this).text();
						$('.reset').show('slow');
						$('#ime_korisnika').val(string);
						$('#korisnik_id').val(id);
					})
					
					$('.hide').on("click", function() {
						$('#korisnik-rezultati').hide('slow');
					})
				} 
			});
		} else {
			$('#korisnik-rezultati').html('<p class="result-info">Premalo znakova</p>'+"\n");
		}

	});
	
	// -- live search (oglasID)
	$('.ime_korisnika').keyup(function() {
		$('#oglas-rezultati').css('display', 'block');
		if($(this).val().length > 2) {
			var ime = $(this).val();
			var dataString = 'ime_korisnika='+ime;
			var homeUrl = 'http://croatia-aveto.com.hr/';
			
			$.ajax
			({
				type: "POST",
				url: homeUrl+"ajax/oglas",
				beforeSend: function(html)
				{
					$('.loading-0').css('display', 'block');
				},
				data: dataString,
				cache: false,
				success: function(html)
				{
					$('.loading-0').css('display', 'none');
					$('#oglas-rezultati').html(html);
					$('.izaberi').on("click", function() {
						var id = $(this).attr('id');
						var string = $(this).text();
						$('.reset').show('slow');
						$('.ime_korisnika').val(string); // -- postavlja naziv oglasa u input
						$('#oglas_id').val(id);
					})
					
					$('.hide').on("click", function() {
						$('#oglas-rezultati').hide('slow');
					})
				} 
			});
		} else {
			$('#oglas-rezultati').html('<p class="result-info">Premalo znakova</p>'+"\n");
		}

	});
	
	// -- pretraga oglasa
	$('.popis-oglasa .trazilica .ime_korisnika').keyup(function() {
		$('#oglas-rezultati').css('display', 'block');
		if($(this).val().length > 2) {
			var ime = $(this).val();
			var dataString = 'ime_korisnika='+ime;
			var homeUrl = 'http://croatia-aveto.com.hr/';
			
			$.ajax
			({
				type: "POST",
				url: homeUrl+"ajax/oglas",
				beforeSend: function(html)
				{
					$('.loading-0').css('display', 'block');
				},
				data: dataString,
				cache: false,
				success: function(html)
				{
					$('.loading-0').css('display', 'none');
					$('#oglas-rezultati').html(html);
					$('.izaberi').izbrisiOglas('.izbrisi-korisnika');
					
					$('.hide').on("click", function() {
						$('#oglas-rezultati').hide('slow');
					})
				} 
			});
		} else {
			$('#oglas-rezultati').html('<p class="result-info">Premalo znakova</p>'+"\n");
		}

	});
	
	// -- ukloni izabranog korisnika
	$('.reset').click(function() {
		$('#ime_korisnika').val('');
		$('#korisnik_id').val('');
		$('#korisnik-rezultati').hide('slow');
		$('.ime_korisnika').val('');
		$('#oglas_id').val('');
		$('#oglas-rezultati').hide('slow');
		$('.reset').hide('slow');
	});


});

