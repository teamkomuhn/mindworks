// page.js
(function( $ ) {
    'use strict';

    //BLOCK SIDENOTE
    const sidebar = $('body').children('aside.sidebar');

    function getSidenotes() {
        $( '.sidenote' ).each( function() {
            const sidenote = $(this);
            sidebar.append( sidenote );
        });
    }

    let sidenote_sups = [];

    function getSups() {
        $( 'sup' ).each( function( i ) {
            sidenote_sups.push([]);

            const sup = $(this);
            let sup_pos_y = sup.offset().top;
            let sup_pos_x = sup.offset().left;
            sidenote_sups[i].push( sup_pos_x );
            sidenote_sups[i].push( sup_pos_y );

        });
    }

    function setSidenotes() {

        getSidenotes();
        getSups();

        $( '.sidenote' ).each( function( i ) {
            const sidenote = $(this);
            const close_button = sidenote.find('button.close');
            let sidenote_pos_x = sidenote_sups[i][0];
            let sidenote_pos_y = sidenote_sups[i][1];
            const index = i + 1;

            sidenote.prepend( '<span class="sup">' + index + '</span>' );

            close_button.on('click', function(){
                sidenote.removeClass('opened');
            });

            // On mobile
            if( window.matchMedia( '(any-hover: none)' ).matches ) {

            } else { // On desktop
                // sidenote.css({
                //     top: sidenote_pos_y,
                //     left: sidenote_pos_x
                // });
            }


        });

        $( 'sup' ).each( function( i ) {
            const sup = $(this);

            const related_sidenote = $('aside.sidebar > *')[i];

            sup.on('click', function(){
                related_sidenote.classList.toggle('opened');
            });

        });

        console.table( sidenote_sups );

    }

    setSidenotes();


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
                        const buttons = button.parent();

                        if ( isExpanded ) {
                            buttons.hide();

                            block.stop().animate({
                                height: expandable_blocks_heights[i]
                            }, 300, 'swing', function() {
                                // Animation complete.
                                block.removeClass( 'expanded' );
                                buttons.fadeIn();
                            });

                        } else { // Expand
                            block.addClass( 'expanded' );
                            buttons.hide();

                            block.stop().animate({
                                height: 1000
                            }, 300, 'swing', function() {
                                // Animation complete.
                                block.height( 'auto' );
                                buttons.fadeIn();
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
    window.addEventListener('resize', debounce(function() {
        if( !window.matchMedia( '(any-hover: none)' ).matches ) { // Only works if !NOT mobile
            setExpandingBlocks();
        }
    }, true));

    window.addEventListener('orientationchange', debounce(function() {
        setExpandingBlocks();
    }, true));


})( jQuery );
