var fakeElement = {};

fakeElement.constanants = 'b c d f g k l m n p q r s t v x z'.split(' ');
fakeElement.vowels = 'a e i o u y'.split(' ');
fakeElement.categories = 'alkali alkaline-earth lanthanoid actinoid transition post-transition'.split(' ');
fakeElement.suffices = 'on ium ogen'.split(' ');

fakeElement.getRandom = function( property ) {
    var values = fakeElement[ property ];
    return values[ Math.floor( Math.random() * values.length ) ];
};

fakeElement.create = function() {
    var widthClass = Math.random()*10 > 6 ? 'width2' : 'width1';
    heightClass = Math.random()*10 > 6 ? 'height2' : 'height1';
    category = fakeElement.getRandom('categories');
    className = 'element fake metal ' + category + ' ' + widthClass + ' ' + heightClass;
    letter1 = fakeElement.getRandom('constanants').toUpperCase();
    letter2 = fakeElement.getRandom('constanants');
    symbol = letter1 + letter2;
    name = letter1 + fakeElement.getRandom('vowels') + letter2 + fakeElement.getRandom('vowels') + fakeElement.getRandom('constanants') + fakeElement.getRandom('suffices');
    number = ~~( 21 + Math.random() * 100 );
    weight = ~~( number * 2 + Math.random() * 15 );

    return '<div class="' + className + '" data-symbol="' + symbol +
        '" data-category="' + category + '"><p class="number">' + number +
        '</p><h3 class="symbol">' + symbol + '</h3><h2 class="name">' + name +
        '</h2><p class="weight">' + weight + '</p></div>';
};

fakeElement.getGroup = function() {
    var i = Math.ceil( Math.random()*3 + 1 ),
        newEls = '';
    while ( i-- ) {
        newEls += fakeElement.create();
    }
    return newEls;
};

$(function(){

    var $container = $('.news-inner-list ul');


    // add randomish size classes
    $container.find('.masonry-list ul li').each(function(){
        var $this = $(this),
            number = parseInt( $this.find('.number').text(), 10 );
        if ( number % 7 % 2 === 1 ) {
            $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
            $this.addClass('height2');
        }
    });

    $container.isotope({
        itemSelector : '.news-inner-list ul li',
        masonry : {
            columnWidth : 20
        },
        masonryHorizontal : {
            rowHeight: 0
        },
        cellsByRow : {
            columnWidth : 0,
            rowHeight : 0
        },
        cellsByColumn : {
            columnWidth : 0,
            rowHeight : 0
        },
        getSortData : {
            symbol : function( $elem ) {
                return $elem.attr('data-symbol');
            },
            category : function( $elem ) {
                return $elem.attr('data-category');
            },
            number : function( $elem ) {
                return parseInt( $elem.find('.number').text(), 10 );
            },
            weight : function( $elem ) {
                return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
            },
            name : function ( $elem ) {
                return $elem.find('.name').text();
            }
        }
    });


    var $optionSets = $('#options .option-set'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
            return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
            // changes in layout modes need extra logic
            changeLayoutMode( $this, options )
        } else {
            // otherwise, apply new options
            $container.isotope( options );
        }

        return false;
    });



    // change layout
    var isHorizontal = false;
    function changeLayoutMode( $link, options ) {
        var wasHorizontal = isHorizontal;
        isHorizontal = $link.hasClass('horizontal');

        if ( wasHorizontal !== isHorizontal ) {
            // orientation change
            // need to do some clean up for transitions and sizes
            var style = isHorizontal ?
            { height: '80%', width: $container.width() } :
            { width: 'auto' };
            // stop any animation on container height / width
            $container.filter(':animated').stop();
            // disable transition, apply revised style
            $container.addClass('no-transition').css( style );
            setTimeout(function(){
                $container.removeClass('no-transition').isotope( options );
            }, 100 )
        } else {
            $container.isotope( options );
        }
    }



    // change size of clicked element
    $container.delegate( '.element', 'click', function(){
        $(this).toggleClass('large');
        $container.isotope('reLayout');
    });

    // toggle variable sizes of all elements
    $('#toggle-sizes').find('a').click(function(){
        $container
            .toggleClass('variable-sizes')
            .isotope('reLayout');
        return false;
    });



    $('#insert a').click(function(){
        var $newEls = $( fakeElement.getGroup() );
        $container.isotope( 'insert', $newEls );

        return false;
    });

    $('#append a').click(function(){
        var $newEls = $( fakeElement.getGroup() );
        $container.append( $newEls ).isotope( 'appended', $newEls );

        return false;
    });


    var $sortBy = $('#sort-by');
    $('#shuffle a').click(function(){
        $container.isotope('shuffle');
        $sortBy.find('.selected').removeClass('selected');
        $sortBy.find('[data-option-value="random"]').addClass('selected');
        return false;
    });


});
