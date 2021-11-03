// main.js
'use strict';

/**
 * Debounce functions for better performance
 * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com/debouncing-your-javascript-events/
 * @param  {Function} fn The function to debounce
 */
var debounce = function (fn) {
	// Setup a timer
	let timeout;

	// Return a function to run debounced
	return function () {

		// Setup the arguments
		let context = this;
		let args = arguments;

		// If there's a timer, cancel it
		if (timeout) {
			window.cancelAnimationFrame(timeout);
		}

		// Setup the new requestAnimationFrame()
		timeout = window.requestAnimationFrame(function () {
			fn.apply(context, args);
		});

	}

};

// CAN jQuery
(function( $ ) {
    $('.card').on('click', function(){

        //var cardID = $(this).attr('ID');
        var cardCat = $(this).data('cat');

        fetch('http://localhost:8888/mindworks/wp-json/wp/v2/cards?categories=' + cardCat + '').then(function(response) {
            // When the page is loaded convert it to text
            return response.text()
        })
        .then(function(html) {
            // Initialize the DOM parser
            var parser = new DOMParser();
    
            // Parse the text
            var doc = parser.parseFromString(html, "text/html");
    
            // You can now even select part of that html as you would in the regular DOM 
            // Example:
            // var docArticle = doc.querySelector('article').innerHTML;
    
            console.log(doc);
        })
        .catch(function(err) {  
            console.log('Failed to fetch page: ', err);  
        });


    });

    //SMOOTH SCROLL TO FUNCTION >> duplicated on page.js for now, need to check how to call it there from here
    function scrollToMain( element, duration, delay ) {
        setTimeout(function() {
            $( [document.documentElement, document.body] ).animate({
                scrollTop: $( element ).offset().top
            }, duration, 'swing');
        }, delay);
    }

    //SMOOTH SCROLL FOR ANY .SCROLL-TO ELEMENT
    function smoothScrollAnchors() {
        $('a.scroll-to[href^="#"]').on('click', function(event) {
            event.preventDefault();
            scrollToMain($($.attr(this, 'href')), 300, 0);
        });
    }
    smoothScrollAnchors();


    // READ TIME JS - https://w3collective.com/calculate-reading-time-javascript/
    function readingTime() { // TODO: Make function better: variables, id
        var text = document.getElementById('main').innerText;
        var wpm = 175;
        var words = text.trim().split(/\s+/).length;
        var time = Math.ceil(words / wpm);
        document.getElementById('readtime').innerText = time;

        //console.log(words);
    }

    // CONTENT SLIDE

    // pinchzomm.js https://github.com/manuelstofer/pinchzoom // TODO: Try this to zoom only the image
    // var myElement = document.getElementById("zoom");
    // var pz = new PinchZoom.default(myElement, {
    //     draggableUnzoomed: false,
    //     minZoom: 1,
    //     onZoomStart: function(object, event){
    //         // Do something on zoom start
    //         // You can use any Pinchzoom method by calling object.method()
    //         console.log('startzoom');
    //     },
    //     onZoomEnd: function(object, event){
    //         // Do something on zoom end
    //         console.log('endzoom');
    //     }
    // })

    const content_slide = $( '.slide.companion' );

    function setContentSlide() {
        content_slide .each( function() {
            content_slide.addClass( 'started' );

            $(document).on(
                'click', 'button.open.companion', function() {

                    content_slide.toggleClass( 'opened' );
                }
            );

        });
    }
    setContentSlide();

    // Add a click outside function if browser window is smaller than 2 x the main width
    function addClickOutsideSlide() {
        let window_width = window.innerWidth;
        let main_width = $('main').outerWidth();

        if ( window_width <= (main_width * 2) ) {
            // If click outside
            $('body').on( 'click', function() {
                if ( !$(event.target.parentNode.parentNode).hasClass('slide') && content_slide.hasClass('opened') ) {
                    $(content_slide).toggleClass( 'opened' );
                }
            });
        } else {
            $('body').off();
        }
    }
    addClickOutsideSlide();

    // Only works if !NOT mobile
    if( !window.matchMedia( '(any-hover: none)' ).matches ) {

        // Adjust things if browser sizes change
        window.addEventListener('resize', debounce(function() {
            addClickOutsideSlide();
        }, true));

        //
        const main_header_height = getComputedStyle(document.documentElement).getPropertyValue('--main-header-height');
        const main_header_height_num = parseFloat(main_header_height) * 16; // Transfrom rem to px in integral number

        window.addEventListener('scroll', function() {

            let current_scroll = $(window).scrollTop();
            let snap_scroll = Math.abs( current_scroll - main_header_height_num );

            if ( current_scroll >= main_header_height_num ) {
                content_slide.css({
                    top: 0
                });
            } else {
                content_slide.css({
                    top: snap_scroll
                })
            }

            // console.log(current_scroll + ' / ' + snap_scroll);

        }, true);


    } // If NOT mobile

    // Format-menu explore button
    $(document).on(
        'click', '.format-menu .explore a', function() {
            // console.log('click');
            content_slide.toggleClass( 'opened' );
            event.preventDefault();
        }
    );

})( jQuery );
