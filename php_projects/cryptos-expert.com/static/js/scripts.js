/*************COMBOBOX*************/
(function($) {
    $.fn.combobox = function() {
        $(this).each(function() {
            var $el = $(this);
            $el.hide();
            var $comboWrap = $('<div class="combobox-wrapper" />').insertAfter($el);
            var $text = $('<span class="combobox-text" />').appendTo($comboWrap);
            var $button = $('<span class="combobox-button" />').appendTo($comboWrap);
            var $options = $('<ul class="combobox-options" />').appendTo($comboWrap).hide();
            $('option', $el).each(function() {
                var $this = $(this);
                var $option = $('<li/>')
                    .appendTo($options)
                    .text($this.text())
                    .data('value', ($this.attr('value') != undefined ? $this.attr('value') : $this.text()))
                    .click(function() {
                        $el.val($(this).data('value')).trigger('change');
                    });
            });
            $el.change(function() {
                $text.text($('option:selected', $el).text());
                $options.clearQueue().animate({'height': 'hide'});
            }).trigger('change');
            var showTimeout;
            $text.add($button).click(function() {
                $options.clearQueue().animate({'height': 'toggle'});
            });
            $comboWrap.hover(
                function(){
                    clearTimeout(showTimeout);
                },
                function(){
                    showTimeout = setTimeout(function() {
                        $options.clearQueue().animate({'height': 'hide'});
                    }, 2000);
                }
            );
        });
    }
})(jQuery);

$(document).ready(function() {
    jQuery('.search_form_select').combobox();
});

/*************EASY SLIDER************/
$(document).ready(function(){
    $('ul#splash-media-review').easyPaginate({});
    $('ul#splash-media-video').easyPaginate({});
    $('ul#partners-people-list').easyPaginate({
        step: 4
    });
});

/*************LANG SELECT************/
$(function () {
    $('.lang-list .caption').click(function () {
        if ($('.lang-select li').is(':visible')) {
            $('.lang-select li').fadeOut('slow');
        }else{
            $('.lang-select li').fadeIn('slow');
        }
    });
});
/*************CALC SELECT************/
$(function () {
    $('.splash-calculator .invest-type .list ul li input').click(function () {
        if ($('.splash-calculator .invest-type .list ul li.invest-1 input').is(':checked')) {
            $('.invest-type-info.block-1').fadeIn('fast');
        } else {
            $('.invest-type-info.block-1').fadeOut('fast');
        }
        if ($('.splash-calculator .invest-type .list ul li.invest-2 input').is(':checked')) {
            $('.invest-type-info.block-2').fadeIn('fast');
        } else {
            $('.invest-type-info.block-2').fadeOut('fast');
        }
        if ($('.splash-calculator .invest-type .list ul li.invest-3 input').is(':checked')) {
            $('.invest-type-info.block-3').fadeIn('fast');
        } else {
            $('.invest-type-info.block-3').fadeOut('fast');
        }
        if ($('.splash-calculator .invest-type .list ul li.invest-4 input').is(':checked')) {
            $('.invest-type-info.block-4').fadeIn('fast');
        } else {
            $('.invest-type-info.block-4').fadeOut('fast');
        }
        if ($('.splash-calculator .invest-type .list ul li.invest-5 input').is(':checked')) {
            $('.invest-type-info.block-5').fadeIn('fast');
        } else {
            $('.invest-type-info.block-5').fadeOut('fast');
        }
    });
});

/*************DATEPICKER************/
$(document).ready(function(){
    $( "#datepicker-1" ).datepicker({
        buttonImageOnly: true,
        dateFormat: 'dd.mm.yy',
        dayNames: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        firstDay: 1,
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
    });
    $( "#datepicker-2" ).datepicker({
        buttonImageOnly: true,
        dateFormat: 'dd.mm.yy',
        dayNames: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        firstDay: 1,
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
    });
});

/*************REGISTRATION REQUIRE************/
function check_form_register(form) {
    requireFields(form);

    if (
        form['f1'].value == '' ||
        form['f2'].value == '' ||
        form['f3'].value == '' ||
        form['f4'].value == '' ||
        form['f5'].value == '' ||
        form['f7'].value == ''
    ) {
        alert('Заполните все поля!');
        return false;
    }

    /*if (form['f4'].value != form['f5'].value) {
        alert('Разные пароли!');
        return false;
    }*/

    return true;
}
/*************LOGINREQUIRE************/
function check_form_login(form) {
    requireFields(form);

    if (
        form['f1'].value == '' ||
        form['f2'].value == ''
    ) {
        alert('Заполните все поля!');
        return false;
    }

    return true;
}

function check_form_review(form) {
    requireFields(form);

    if (
        form['f1'].value == '' ||
        form['f2'].value == ''
    ) {
        alert('Заполните все поля!');
        return false;
    }

    return true;
}
/*************LOGINREQUIRE************/
function check_form_contact(form) {
    requireFields(form);

    if (
        form['f1'].value == '' ||
        form['f2'].value == '' ||
        form['f3'].value == ''
    ) {
        alert('Заполните все поля!');
        return false;
    }

    return true;
}

/*************ACCORDION*************/
$(function() {
    $( ".faq-accordion-box" ).accordion({
        collapsible: true,
        active:false,
        animate: 300
    });
});

/*************CHECKBOX / RADIOBUTTON*************/
$( function() {
    $( ".current-input" ).checkboxradio();
    $( ".current-input-group" ).controlgroup();
} );
$( function() {
    $( "#checkbox-1" ).checkboxradio();
    $( "#checkbox-2" ).checkboxradio();
    $( "#checkbox-3" ).checkboxradio();
    $( "#checkbox-4" ).checkboxradio();
} );

/*************INVESTOR LIST*************/
$("#invest-summ-1").bind("change paste keyup", function() {
    $("#dep-sum-1" ).val($(this).val() + "$");
});

/*************TABS*************/
$(document).ready(function(){
    $( "#company-stat-tabs" ).tabs();
});
$(document).ready(function(){
    $( "#cabinet-deposit-tabs" ).tabs();
});
$(document).ready(function(){
    $( "#cabinet-partner-tabs" ).tabs();
});

$(function () {
    $('.tarife-list ul li a').click(function () {
        $('.tarife-list ul li a').removeClass('active');
        $(this).addClass('active');
    });
});

/*************SLIDER*************/
$(document).ready(function() {
    $( "#sliderrangemin-1" ).slider({
        range: "min",
        value: 70,
        min: 20,
        max: 250,

        slide: function( event, ui ) {
            $("#view-1").css("left",($("#sliderrangemin-1 .ui-slider-handle").css("left")));
            $("#amount-1").val( ui.value );
            $("#result-1").val( ui.value + "$");
        }
    });
    $( "#amount-1" ).val( $( "#sliderrangemin-1" ).slider( "value" ));
    $( "#result-1" ).val( "$" + $( "#sliderrangemin-1" ).slider( "value" ));
});


/*************TIME AND DATE*************/
function clock() {
    var d = new Date();
    var month_num = d.getMonth()
    var day = d.getDate();
    var hours = d.getHours();
    var minutes = d.getMinutes();
    var seconds = d.getSeconds();

     month=new Array("January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December");

    if (day <= 9) day = "0" + day;
    if (hours <= 9) hours = "0" + hours;
    if (minutes <= 9) minutes = "0" + minutes;
    if (seconds <= 9) seconds = "0" + seconds;

    time_site = hours + ":" + minutes;
    time_site_cab = hours + ":" + minutes;

    if (document.layers) {
        document.layers.doc_time.document.write(date_time);
        document.layers.doc_time.document.close();
    }
    else
    if(document.getElementById("time_site")){ document.getElementById("time_site").innerHTML = time_site;}
    if(document.getElementById("time_site_cab")){ document.getElementById("time_site_cab").innerHTML = time_site_cab;}
    setTimeout("clock()", 1000);
}

$(document).ready(function() {
    clock();
});

function dates() {
    var d = new Date();
    var month_num = d.getMonth();
    var day = d.getDate();
    var hours = d.getHours();
    var minutes = d.getMinutes();
    var seconds = d.getSeconds();

    month=new Array("January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December");
    days=new Array("Sun", "Mon", "Tue", "Wed",
        "Thu", "Fri", "Sat");

    if (day <= 9) day = "0" + day;
    if (hours <= 9) hours = "0" + hours;
    if (minutes <= 9) minutes = "0" + minutes;
    if (seconds <= 9) seconds = "0" + seconds;

    date_site =  month[d.getMonth()] + "." + d.getDate() + "." + d.getFullYear();
    date_site_cab = d.getDate() + " " + d.getMonth() + " " + d.getFullYear();
    if (document.layers) {
        document.layers.doc_time.document.write(date_time);
        document.layers.doc_time.document.close();
    }
    else
    if(document.getElementById("date_site")){document.getElementById("date_site").innerHTML = date_site;}
    if(document.getElementById("date_site_cab")){document.getElementById("date_site_cab").innerHTML = date_site_cab;}
    setTimeout("dates()", 1000);
}

		function myFunction(key) {
			// Declare variables
			var input, filter, table, tr, td, key, i;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don\'t match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[key];
				if (td) {
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	
	
$(document).ready(function() {
    dates();
});

