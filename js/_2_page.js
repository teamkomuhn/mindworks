// page.js
(function( $ ) {
    'use strict';

    // EXPANDING BLOCKS INTERACTION -> JQUERY
    let expandable_blocks_heights = [];
    let blocks_are_set = false;

    function setExpandingBlocks() {
        expandable_blocks_heights = []; // Reset array

        $( '.expandable' ).each( function( i ) {
            const block = $(this);

            const block_padding = parseInt( block.parent().css( 'padding-top' ) );
            const header_height = block.children( 'header' ).height();
            const header_padding = parseInt( block.children( 'header' ) .css( 'padding-bottom' ) );
            const block_height_closed = header_height; // + header_padding + block_padding;
            const block_height = block.height() - header_padding - block_padding;


            expandable_blocks_heights.push( [ block_height, block_height_closed ] );


            // TODO: Test without this
            if ( !blocks_are_set ) {
                block.height( block_height_closed );

                block.on(
                    'click', 'button.expand', function() {
                        let isExpanded = block.hasClass( 'expanded' );

                        if ( isExpanded ) {

                            block.animate({
                                height: expandable_blocks_heights[i][1]
                            }, 300, function() {
                                // Animation complete.
                                block.removeClass( 'expanded' );
                            });

                        } else {
                            block.addClass( 'expanded' );

                            block.animate({
                                height: expandable_blocks_heights[i][0]
                            }, 300, function() {
                                // Animation complete.

                            });

                        }

                        //
                        if ( $(this).hasClass( 'go-to' ) ) {
                            scrollTo( block.children( 'section' ) );
                        } else {
                            scrollTo( block );
                        }

                    }
                );
            } // if ( !blocks_are_set )

        });

        blocks_are_set = true;

        console.table( expandable_blocks_heights );
        // console.log( expandable_blocks_heights[0][0], expandable_blocks_heights[0][1] );

    }
    setExpandingBlocks();

    //
    // function resetBlocks() {
    //
    //     expandable_blocks_heights = [];
    //
    //     $( '.expandable' ).each( function( i ) {
    //         const block = $(this);
    //
    //         const block_padding = parseInt( block.parent().css( 'padding-top' ) );
    //         const header_height = block.children( 'header' ).height();
    //         const header_padding = parseInt( block.children( 'header' ) .css( 'padding-bottom' ) );
    //         const block_height_closed = header_height; // + header_padding + block_padding;
    //         const block_height = block.height() - header_padding - block_padding;
    //
    //         // console.log( block_height );
    //
    //         expandable_blocks_heights.push( [ block_height, block_height_closed ] );
    //         block.height( block_height_closed );
    //
    //     });
    //
    //     console.table( expandable_blocks_heights );
    // }

    //
    function scrollTo( element ) {
        $( [document.documentElement, document.body] ).animate({
            scrollTop: $( element ).offset().top
        }, 500);
    }

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
