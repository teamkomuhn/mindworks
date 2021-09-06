// page.js
(function( $ ) {
    'use strict';

    //
    function scrollTo( element, duration, delay ) {
        setTimeout(function() {
            $( [document.documentElement, document.body] ).animate({
                scrollTop: $( element ).offset().top
            }, duration, 'swing');
        }, delay);
    }

    // EXPANDING BLOCKS INTERACTION -> JQUERY
    let expandable_blocks_heights = [];
    let blocks_are_set = false;

    function setExpandingBlocks() {
        expandable_blocks_heights = []; // Reset array

        $( '.expandable' ).each( function( i ) {
            const block = $(this);

            const header_height = block.find( '.main > header' ).height();
            const block_height_closed = header_height;

            expandable_blocks_heights.push( block_height_closed );
            block.height( expandable_blocks_heights[i] );
            block.removeClass( 'expanded' );

            if ( !blocks_are_set ) {

                block.on(
                    'click', 'button.expand', function() {
                        let isExpanded = block.hasClass( 'expanded' );
                        const button = $(this);
                        const menu = button.parent();

                        if ( isExpanded ) {
                            menu.hide();

                            block.stop().animate({
                                height: expandable_blocks_heights[i]
                            }, 300, 'swing', function() {
                                // Animation complete.
                                block.removeClass( 'expanded' );
                                menu.fadeIn();
                            });

                        } else { // Expand
                            block.addClass( 'expanded' );
                            menu.hide();

                            block.stop().animate({
                                height: 1000
                            }, 300, 'swing', function() {
                                // Animation complete.
                                block.height( 'auto' );
                                menu.fadeIn();
                            });

                        }

                        if ( button.hasClass( 'go-to' ) ) {
                            scrollTo( block.children( 'section' ), 300, 300 );
                        } else {
                            scrollTo( block, 300, 0 );
                        }

                    }
                );
            } // if ( !blocks_are_set )

        });

        blocks_are_set = true;

        // console.table( expandable_blocks_heights );
        // console.log( expandable_blocks_heights[0][0], expandable_blocks_heights[0][1] );

    }
    setExpandingBlocks();


    // Adjust dimensions if browser sizes change
    window.onresize = function() {
       if( !window.matchMedia( '(any-hover: none)' ).matches ) { // Only works if !NOT mobile
           setExpandingBlocks();
           // alert('onresize');
       }
    };

    window.onorientationchange = function() { // Especially for mobile
       setExpandingBlocks();
       // alert('onorientationchange');
    };

})( jQuery );
