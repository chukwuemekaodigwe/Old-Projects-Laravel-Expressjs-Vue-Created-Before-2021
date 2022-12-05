/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
 *
 * Youxi v1.3 - Template Setup Script
 *
 * This file is part of Youxi, a HTML5 Business Theme build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * March 26, 2013
 *
 */

;(function( $, window, document, undefined ) {

	$( window ).load(function() {

		/*	--------------------------------------------------------------------
		Google Maps
		------------------------------------------------------------------------ */
		if( $.fn.gmap3 ) {
			(function() {
				var wf = document.createElement('script');
				wf.src = 'http://maps.google.com/maps/api/js?v=3&sensor=false&language=en&callback=load_gmap';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);			
			})();

			window.load_gmap = function() {
				$( '.gmap' ).each(function() {

					var options = {
						map: {
							options: {
								zoom: $( this ).data( 'zoom' ) || 1, 
								center: [ $( this ).data( 'center-lat' ), $( this ).data( 'center-lng' ) ], 
								scrollwheel: false, 
								mapTypeControl: false, 
								streetViewControl: false
							}
						}, 
						marker: {
							latLng:[ $( this ).data( 'marker-lat' ), $( this ).data( 'marker-lng' ) ]
						}
					};

					$( this ).gmap3( options );
				});
			}
		}


		/*	--------------------------------------------------------------------
		Twitter Widget
		------------------------------------------------------------------------ */
		if( $.fn.tweet ) {
			$( '.tweets' ).each(function() {
				var username = $( this ).data( 'twitter-username' );
				var count = $( this ).data( 'count' ) || 1;
				$( this ).tweet({
					modpath: 'php/twitter/index.php', 
					username: username, 
					template: '{text}{time}', 
					count: count, 
					loading_text: 'Loading Tweets...'
				});
			});
		}


		/*	--------------------------------------------------------------------
		Flickr Widget
		------------------------------------------------------------------------ */
		if( $.fn.jflickrfeed ) {
			$( '.flickr-stream' ).each(function() {
				var flickrId = $( this ).data( 'flickr-id' );
				var limit = $( this ).data( 'limit' ) || 9;
				$( document.createElement( 'ul' ) )
					.prependTo( this ).jflickrfeed({
						qstrings: {
							id: flickrId
						}, 
						limit: limit, 
						itemTemplate: '<li><a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
					});
			});
		}

	});

	$( document ).ready(function() {

		/*	--------------------------------------------------------------------
		Moving Line Under Menu
		------------------------------------------------------------------------ */
		(function() {
			var guide = $( '<li class="nav-guide"></li>' );
			var active = $( '.navigation > ul' ).find( ' > li.active' ).first();

			function posGuide( el ) {
				if( el.length ) {
					var pos = el.position();
					guide.css({
						'left': pos.left, 
						'top': pos.top + $( el ).outerHeight() - 1, 
						'width': $( el ).outerWidth()
					});
				}
			}

			$( '.navigation > ul' ).prepend( guide ).on( 'mouseenter.snaky', ' > li', function( ) {
				posGuide( $( this ) );
			}).on( 'mouseleave.snaky', function() {
				posGuide( active );
			});

			$( '.navigation > ul' ).on( 'mouseover.snaky', function( e ) {
				guide.addClass( 'animate' );
				$( this ).off( 'mouseover.snaky' );
			});

			posGuide( active );
			$( window ).on( 'resize.snaky', function() {
				posGuide( active );
			});
		})();


		/*	--------------------------------------------------------------------
		TinyNav Navigation
		------------------------------------------------------------------------ */
		if( $.fn.tinyNav ) {
			$( '.header .navigation > ul' ).tinyNav({
				active: 'active', 
				header: '-- Menu --'
			});
		}


		/*	--------------------------------------------------------------------
		Skill Widget
		------------------------------------------------------------------------ */
		$( '.skill' ).each(function() {
			var bar = $( this ).find( '.bar' );
			var percent = $( this ).data( 'percent' );
			var progress = $( '<span></span>' ).appendTo( $( this ).find( '.label' ) );
			if( percent ) {
				bar.find( '.inner' ).stop().css({ 'width': 0 })
					.animate({ 'width': percent + '%' }, {
						'duration': 1000, 
						'progress': function( a, b ) {
							progress.text( Math.ceil( b * percent ) + '%' );
						}
					});
			}
		});


		/*	--------------------------------------------------------------------
		Layer Slider
		------------------------------------------------------------------------ */
		if( $.fn.layerSlider ) {
			$( '.layerslider' ).each(function() {
				$( this ).layerSlider( $.extend( true, {
					responsive: true, 
					skin: 'youxi', 
					skinsPath: 'plugins/layerslider/skins/', 
					responsiveUnder: 1024, 
					sublayerContainer: 1024
				}, $( this ).data() ) );
			});
		}


		/*	--------------------------------------------------------------------
		Nivo Slider
		------------------------------------------------------------------------ */
		if( $.fn.nivoSlider ) {
			$( '.nivoslider' ).each(function() {
				$( this ).nivoSlider( $.extend( true, {}, {
				}, $( this ).data() ) );
			});
		}


		/*	--------------------------------------------------------------------
		FlexSlider
		------------------------------------------------------------------------ */
		if( $.fn.flexslider) {
			$( '.flexslider' ).each(function() {
				$( this ).flexslider( $.extend( true, {}, {
					smoothHeight: true
				}, $( this ).data() ) );
			});
		}


		/*	--------------------------------------------------------------------
		Direction Aware Portfolio
		------------------------------------------------------------------------ */
		if( $.fn.hoverdir ) {

			$( '.portfolio-item' ).each(function() {
				$( this ).hoverdir();
			});

		}


		/*	--------------------------------------------------------------------
		Filterable Portfolio
		------------------------------------------------------------------------ */
		if( $.fn.isotope ) {

			$( '.portfolio-isotope' ).each(function() {

				var $container = $( this ).find( '.portfolio-items' );
				var $filter = $( this ).find( '.portfolio-filter' );
				var $filterActive = $( '<span class="active-label" data-toggle="dropdown"></span>' ).prependTo( $filter );

				$container.imagesLoaded(function() {

					$container.isotope({
						masonry: {
							columnWidth: $container.width() / 12
						}
					});

					$( window ).on( 'smartresize.portfolio', function(){
						$container.isotope({
							masonry: {
								columnWidth: $container.width() / 12
							}
						});
					});

					$filter.on( 'click', 'a', function( e ) {
						$container.isotope({
							filter: $( this ).data( 'filter' )
						});

						$( this ).closest( 'li' ).addClass( 'active' ).siblings( 'li' ).removeClass( 'active' );

						$( '.active-label', $filter ).text( $( this ).text() );

						e.preventDefault();
					});

					$filter.find( 'li a[data-filter="*"]' ).parent().addClass( 'active' );
					$filterActive.text( $filter.find( 'li a[data-filter="*"]' ).text() );

				});

			});

		}


		/*	--------------------------------------------------------------------
		Carousel (CarouFredSel)
		------------------------------------------------------------------------ */
		if( $.fn.caroufredsel ) {

			$( '.carousel' ).each(function() {
				$( this ).imagesLoaded(function() {
					var items = $( this ).children().wrapAll( '<div class="carousel-items"></div>' ).parent();
					var navWrap = $( '<div class="carousel-nav"></div>' ).prependTo( this );
					var prevNav = $( '<div class="carousel-prev"></div>' ).appendTo( navWrap );
					var nextNav = $( '<div class="carousel-next"></div>' ).appendTo( navWrap );

					items.carouFredSel({
						items: {
							height: 'auto', 
							visible: {
								min: 1, 
								max: 16
							}
						}, 
						responsive: true, 
						auto: {
							play: false
						}, 
						scroll: {
							items: 1
						}, 
						swipe: {
							onTouch: true, 
							onMouse: true
						}, 
						next: {
							button: nextNav
						}, 
						prev: {
							button: prevNav
						}
					});
				});
			});
		}


		/*	--------------------------------------------------------------------
		Form Validation and Ajax Submit
		------------------------------------------------------------------------ */
		if( $.fn.validate && $.fn.ajaxSubmit ) {

			$( '#contact-form' ).validate({
				submitHandler: function( form ) {
					$( '#ajax-loader', form ).show();
					$( form ).ajaxSubmit(function( response ) {
						response = $.parseJSON( response );

						$( '#contact-message', form )
							.removeClass( 'alert-error alert-success alert-info' )
							.toggleClass( 'alert-error', !response.success )
							.toggleClass( 'alert-success', response.success )
							.html( response.message ).slideDown();

						if( response.success ) {
							$( form ).resetForm();
						}

						$( '#ajax-loader', form ).hide();
					});
				}
			});
		}


		/*	--------------------------------------------------------------------
		Testimonial
		------------------------------------------------------------------------ */
		if( $.fn.testimonialSwitcher ) {

			$( '.testimonial' ).testimonialSwitcher();
		}


		/*	--------------------------------------------------------------------
		Magnific Popup (v0.0.9)
		------------------------------------------------------------------------ */
		if( $.fn.magnificPopup ) {

			$( '.img-gallery, .portfolio-items' ).magnificPopup({
				delegate: '[rel="magnific-popup"]', 
				type: 'image', 
				gallery: {
					enabled: true, 
					navigateByImgClick: true, 
					preload: [ 0, 1 ]
				}, 
				image: {
					titleSrc: function( item ) {
						return item.el.attr( 'title' );
					}
				}
			});
		}


		/*	--------------------------------------------------------------------
		Tooltips
		------------------------------------------------------------------------ */
		if( $.fn.tooltip ) {
			$( '[rel="tooltip"]' ).tooltip({
				container: 'body'
			});
		}


		/*	--------------------------------------------------------------------
		Timeline
		------------------------------------------------------------------------ */
		if( $.fn.timeline ) {
			$( '.timeline' ).timeline();
		}


		/*	--------------------------------------------------------------------
		Fluid Videos
		------------------------------------------------------------------------ */
		if( $.fn.fitVids ) {
			$( '.media' ).fitVids();
		}

	});

}) ( jQuery, window, document );