// main.js
(function( $ ) {
    'use strict';

    // READ TIME JS - https://w3collective.com/calculate-reading-time-javascript/
    function readingTime() { // TODO: Make function better: variables, id
        var text = document.getElementById('main').innerText;
        var wpm = 175;
        var words = text.trim().split(/\s+/).length;
        var time = Math.ceil(words / wpm);
        document.getElementById('readtime').innerText = time;

        //console.log(words);
    }

    if( $('.page')[0] ) {
        readingTime();
    }



    // OPEN COMPANION CONTENT <- slide

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

    function setCompanionSlide() {
        $( '.slide.companion' ).each( function() {
            const slide = $(this);
            slide.addClass( 'started' );

            $(document).on(
                'click', 'button.open.companion', function() {

                    slide.toggleClass( 'opened' );
                }
            );

            $(document).on( 'click', function( e ) {

                if ( slide.hasClass('opened') ) {

                    let target = event.target;

                    if ( !target.closest( slide ).length() ) {

                    }

                    alert(target.tagName);


                }

            });





        });
    }
    setCompanionSlide();



})( jQuery );
