// page.js
(function () {
    'use strict';

    //
    function expandBlock( block ) {

        const blockHeader = block.querySelector('header');
        let blockHeaderHeight = blockHeader.offsetHeight;

        block.style.height = blockHeaderHeight + 'px';

    }

    function makeExpand( container_block ) {
        // Find all expanding content blocks
        const blocks = container_block.querySelectorAll('.expandable');

        for ( let i = 0; i < blocks.length; i++ ) {
            expandBlock( blocks[i] );
        }
    }

    function setExpandingBlocks() {
        // Find all expanding content container blocks
        const container_blocks = document.querySelectorAll('.block.expanding-content');

        // Collapse blocks
        for ( let i = 0; i < container_blocks.length; i++ ) {
            makeExpand( container_blocks[i] );
        }

    }

    setExpandingBlocks();
    // window.onresize = setExpandingBlocks; //MAKE THIS WORK ON MOBILE

})();

// jQuery
(function( $ ) {
    'use strict';

    // EXPANDING BLOCKS INTERACTION
    $( 'button.expand' ).click( function() {
        const block = $( this ).parents( '.expandable' );

        //console.log(header_height);
        if ( block.hasClass( 'expanded' ) ) {
            let header_height = block.children( 'header:first-child' ).outerHeight() + 120;

            block.animate({
                height: header_height
            }, 300, function() {
            // Animation complete.
            });

        } else {
            block.animate({
                height: '100vh'
            }, 300, function() {
                // Animation complete.
                block.height('auto');
            });
        }

        block.toggleClass( 'expanded' );

    });

    $(window).on('resize', function(){

    });


})( jQuery );
