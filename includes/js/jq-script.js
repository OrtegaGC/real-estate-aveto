// get base url
var baseUrl = $("base").attr("href");

$(document).ready(function () {

    console.log("Base URL is " + baseUrl);

    // -- popis mjesta u županiji - tražilica
    $('#zupanija-trazilica').change(function () {
        var id = $(this).val();
        var dataString = 'id=' + id;
        console.log("Id zupanije: " + id);

        $.ajax
                ({
                    type: "POST",
                    url: baseUrl + "ajax/mjesto_trazilica",
                    beforeSend: function (html)
                    {
                        $('.loading-0').css('display', 'block');
                        $('#mjesto-trazilica').removeAttr('disabled');
                    },
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $("#mjesto-trazilica").html(html);
                        $('.loading-0').css('display', 'none');
                        if (id === '0')
                        {
                            $('#mjesto-trazilica').attr('disabled', 'disabled');
                        } else {
                            $('#mjesto-trazilica').removeAttr('disabled');
                        }
                    },
                    error: function () {
                        console.log("Error fetching mjesto_trazilica ID");
                    }
                });
    });

    // -- popis mjesta u županiji
    $('#zupanija').change(function () {
        var id = $(this).val();
        var dataString = 'id=' + id;

        $.ajax
                ({
                    type: "POST",
                    url: baseUrl + "ajax/mjesto",
                    beforeSend: function (html)
                    {
                        $('.loading').css('display', 'block');
                    },
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $("#mjesto").html(html);
                        $('.loading').css('display', 'none');
                    }
                });
    });

    // -- prikazi mjesta
    $('#prikazi-mjesta').click(function () {
        var id = $('[name=regijaID]').val();
        var dataString = 'id=' + id;

        $.ajax
                ({
                    type: "POST",
                    url: "../../ajax/popis_mjesta",
                    beforeSend: function (html)
                    {
                        $('.loading').css('display', 'block');
                    },
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $('#popis-mjesta').html(html);
                        $('#popis-mjesta').css('display', 'block');
                        $('#sakrij-mjesta').css('display', 'inline-block');
                        $('#prikazi-mjesta').css('display', 'none');
                        $('.loading').css('display', 'none');
                    }
                });
    });

    // -- prikazi mjesta potražnja
    $('#prikazi-mjesta-potraznja').click(function () {
        var id = $('[name=regijaID]').val();
        var dataString = 'id=' + id;

        $.ajax
                ({
                    type: "POST",
                    url: "../../ajax/popis_mjesta_potraznja",
                    beforeSend: function (html)
                    {
                        $('.loading').css('display', 'block');
                    },
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $('#popis-mjesta').html(html);
                        $('#popis-mjesta').css('display', 'block');
                        $('#sakrij-mjesta-potraznja').css('display', 'inline-block');
                        $('#prikazi-mjesta-potraznja').css('display', 'none');
                        $('.loading').css('display', 'none');
                    }
                });
    });

    // -- sakrij popis mjesta
    $('#sakrij-mjesta').click(function () {
        $('#sakrij-mjesta, #popis-mjesta').css('display', 'none');
        $('#prikazi-mjesta').css('display', 'inline-block');
    });

    // -- sakrij popis mjesta potražnja
    $('#sakrij-mjesta-potraznja').click(function () {
        $('#sakrij-mjesta-potraznja, #popis-mjesta').css('display', 'none');
        $('#prikazi-mjesta-potraznja').css('display', 'inline-block');
    });

    $('input[type="button"], input[type="submit"]').hover(function () {
        $(this).css('cursor', 'pointer');
    });


    // -- prikazi detalje apartmana
    $('.tab').click(function () {
        var id = $(this).attr('id');
        var dataString = 'id=' + id;
        $('.tab').removeClass('active');
        $(this).addClass('active');
        $.ajax
                ({
                    type: "POST",
                    url: "../../../ajax/detalji_apartmana",
                    beforeSend: function (html)
                    {
                        $('.loading').css('display', 'block');
                    },
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $('.apartman-detalji').html(html);
                        $('#gallery-apartman a').lightBox();
                        $('.loading').css('display', 'none');
                    }
                });
    });

    // -- sakrij detalje
    $('#hide-details').click(function () {
        $('.ostale-informacije').hide('slow');
        $('#show-details').removeClass('active');
        $(this).addClass('active');
    });

    // -- pokaži detalje
    $('#show-details').click(function () {
        $('.ostale-informacije').show('slow');
        $('#hide-details').removeClass('active');
        $(this).addClass('active');
    });

    // -- sakrij kartu
    $('#hide-map').click(function () {
        $('#map-canvas').hide('slow');
        $('#show-map').removeClass('active');
        $(this).addClass('active');
    });

    // -- pokaži kartu
    $('#show-map').click(function () {
        $('#map-canvas').show('slow');
        $('#hide-map').removeClass('active');
        $(this).addClass('active');
    });

    // -- upload images
    $('#upload-images').click(function () {
        $('.loading').css('display', 'block');
    });

    // -- izbrisi sliku usluge
    $('.izbrisi-sliku-usluge').click(function () {
        var slika = $(this).attr('id');
        var id = $(this).attr('name');
        $("#dialog-confirm").dialog({
            resizable: false,
            modal: true,
            buttons: {
                "Izbriši": function () {
                    var dataString = 'slika=' + slika + '&id=' + id;
                    $.ajax
                            ({
                                type: "POST",
                                url: baseUrl + "ajax/izbrisi_sliku_usluge",
                                beforeSend: function (html)
                                {
                                    $('.loading').css('display', 'block');
                                    $('.izbrisi-sliku-usluge').attr('disabled', 'disabled'); // -- ne radi
                                },
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $('.result').html(html);
                                    $('.loading').css('display', 'none');
                                    window.setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                    $('.izbrisi-sliku-usluge').removeAttr('disabled'); // -- ne radi
                                }
                            });
                    $(this).dialog("close");
                },
                "Odustani": function () {
                    $(this).dialog("close");
                }
            }
        });
    });



    // -- added by stiiv - uredi slike
    var $addSlikaBtn = $("button#addSlikaBtn"),
            $slikeWrapper = $("div#uredi-slike-wrapper"),
            $slikeCount = $slikeWrapper.children("img").length
    $inputFileCount = $(".form-uredi-slike input[type='file']").length,
            maxImg = 6;

    $addSlikaBtn.css("display", "block");
    // if the number of images is zero (1 file element is alreay on the web by default)
    if ($slikeCount === 0)
        $slikeCount = 1;
    // if max images has been reached - don't display upload form
    if ($slikeCount >= maxImg) {
        $(".form-uredi-slike").css("display", "none");
    } else if ($slikeCount === (maxImg - 1)) { // you can add just one more image
        $addSlikaBtn.parent().css("display", "none");
    }
    //console.log("Broj slika: "+$slikeCount);
    //console.log("Broj inputa: "+$inputFileCount);
    $slikeCount += $inputFileCount;

    $addSlikaBtn.on("click", function () {
        $slikeCount += 1;
        var element = '<input type="file" name="slika_' + $slikeCount + '" />';
        //console.log("Nastavak Broj slika: "+$slikeCount);

        $("input[type='submit']").before(element);
        //console.log("Broj inputa i slika: "+$total);

        if ($slikeCount >= maxImg) {
            $addSlikaBtn.parent().css("display", "none");
            return;
        }
    });


    // -- izbrisi sliku objekt
    $('.izbrisi-sliku-oglas').click(function () {
        var slika = $(this).attr('id');
        var id = $(this).attr('name');
        $("#dialog-confirm").dialog({
            resizable: false,
            modal: true,
            buttons: {
                "Izbriši": function () {
                    var dataString = 'slika=' + slika + '&id=' + id;
                    $.ajax
                            ({
                                type: "POST",
                                url: baseUrl + "ajax/izbrisi_sliku_oglas",
                                beforeSend: function (html)
                                {
                                    $('.loading').css('display', 'block');
                                    $('.izbrisi-sliku-oglas').attr('disabled', 'disabled'); // -- ne radi
                                },
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $('.result').html(html);
                                    $('.loading').css('display', 'none');
                                    window.setTimeout(function () {
                                        location.reload();
                                    }, 500);
                                    $('.izbrisi-sliku-oglas').removeAttr('disabled'); // -- ne radi
                                }
                            });
                    $(this).dialog("close");
                },
                "Odustani": function () {
                    $(this).dialog("close");
                }
            }
        });
    });

    // -- datepicker
    $(function () {
        $("#from").datepicker({
            changeMonth: true,
            minDate: 0,
            onSelect: function (selectedDate) {
                //var fromDate = new Date(selectedDate);
                var input = selectedDate;
                var arrInput = input.split('.');
                var fromDate = new Date(arrInput[1] + '/' + arrInput[0] + '/' + arrInput[2]);
                var minDate = new Date(fromDate.setDate(fromDate.getDate() + 1));
                //var maxDate  = new Date(fromDate.setDate(fromDate.getDate() + 1));

                //$('#to').datepicker('option', 'maxDate', maxDate);
                $("#to").datepicker("option", "minDate", minDate);
            }
        });

        $("#to").datepicker({
            changeMonth: true,
            onSelect: function (selectedDate) {

                //var toDate    = new Date(selectedDate);
                var input1 = selectedDate;
                var arrInput1 = input1.split('.');
                var toDate = new Date(arrInput1[1] + '/' + arrInput1[0] + '/' + arrInput1[2]);
                //var minDate   = new Date(toDate.setDate(toDate.getDate() - 1));
                //$('#from').datepicker('option', 'minDate', minDate);
                //$("#from").datepicker("option", "maxDate", toDate);
            }
        });

        $("#from2").datepicker({
            changeMonth: true,
            minDate: 0,
            onSelect: function (selectedDate) {
                //var fromDate = new Date(selectedDate);
                var input = selectedDate;
                var arrInput = input.split('.');
                var fromDate = new Date(arrInput[1] + '/' + arrInput[0] + '/' + arrInput[2]);
                var minDate = new Date(fromDate.setDate(fromDate.getDate() + 1));
                //var maxDate  = new Date(fromDate.setDate(fromDate.getDate() + 1));

                //$('#to').datepicker('option', 'maxDate', maxDate);
                $("#to2").datepicker("option", "minDate", minDate);
            }
        });

        $("#to2").datepicker({
            changeMonth: true,
            onSelect: function (selectedDate) {

                //var toDate    = new Date(selectedDate);
                var input1 = selectedDate;
                var arrInput1 = input1.split('.');
                var toDate = new Date(arrInput1[1] + '/' + arrInput1[0] + '/' + arrInput1[2]);
                //var minDate   = new Date(toDate.setDate(toDate.getDate() - 1));
                //$('#from').datepicker('option', 'minDate', minDate);
                //$("#from").datepicker("option", "maxDate", toDate);
            }
        });

    });

    function toTop() {
        var y = $(window).scrollTop();
        if (y > $('#header').height()) {
            $('#to-top').show('slow');
        } else {
            $('#to-top').hide('slow');
        }
    }
    ;

    $(window).scroll(toTop);
    $(window).resize(toTop);

    $("a[href='#top']").click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

});
