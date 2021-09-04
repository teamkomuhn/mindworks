// page.js
(function () {

    //


    // EXPANDING BLOCKS
    // let expandable_blocks = [];
    // let menu_space = 0;

    // function expandBlock( block, container_i, i, target ) {
    //
    //     // Scroll to
    //     if ( target.classList.contains( 'go-to' ) ) {
    //         scrollTo( block.querySelector( 'section.dark' ) );
    //     } else {
    //         scrollTo( block );
    //     }
    //
    //     // Space for menu
    //     if( window.matchMedia( '(any-hover: none)' ).matches ) { // If mobile
    //         menu_space = 152; // TODO: How to calculate this better?
    //     } else { // If desktop
    //         menu_space = 240; //+32?
    //     }
    //
    //     // console.table( expandable_blocks );
    //     // console.log( expandable_blocks[0][0][0], expandable_blocks[0][0][1] );
    //     // console.log( expandable_blocks[0][1][0], expandable_blocks[0][1][1] );
    //
    //     //
    //     let isExpanded = block.classList.contains( 'expanded' );
    //     if ( isExpanded ) {
    //         block.style.height = expandable_blocks[container_i][i][1] + 'px';
    //
    //     } else {
    //         block.style.height = expandable_blocks[container_i][i][0] - menu_space + 'px';
    //     }
    //
    //     block.classList.toggle( 'expanded' );
    //
    //     if ( target.classList.contains( 'go-to' ) ) {
    //         scrollTo( block.querySelector( 'section.dark' ) );
    //     } else {
    //         scrollTo( block );
    //     }
    //
    // }
    // 
    // function getBlockHeaderHeight( block ) {
    //     // Calculate the block header height
    //     const block_header = block.querySelector('header');
    //     const block_header_height = block_header.offsetHeight;
    //     return block_header_height;
    //
    // }
    // //
    // // function bindExpandButtons( block, container_i, i ) {
    // //     const buttons = block.querySelectorAll('button');
    // //
    // //     for ( let n = 0; n < buttons.length; n++ ) {
    // //         buttons[n].addEventListener('click', function() {
    // //             expandBlock( block, container_i, i, event.target );
    // //
    // //         }, false );
    // //     }
    // // }
    //
    // function collapseBlock( block ) {
    //     block.style.height = getBlockHeaderHeight( block ) + 'px';
    //     block.classList.remove( 'expanded' );
    // }
    //
    // function makeExpand( container_block, container_i ) {
    //     // Find all expandable blocks inside the container
    //     const blocks = container_block.querySelectorAll('.expandable');
    //
    //     // Add a space in array for each container
    //     // expandable_blocks.push( [] );
    //     // For each expandable block do something
    //     for ( let i = 0; i < blocks.length; i++ ) {
    //         // Add the block as an object to the array
    //         // expandable_blocks[container_i].push( [ blocks[i].offsetHeight, getBlockHeaderHeight( blocks[i] ) ] );
    //
    //         collapseBlock( blocks[i] );
    //
    //         // bindExpandButtons( blocks[i], container_i, i ); // TODO: Fix re-binding issue with window changes
    //
    //     }
    //
    // }
    //
    // function setExpandingBlocks() {
    //     // Find all expanding content container blocks
    //     const container_blocks = document.querySelectorAll('.block.expanding-content');
    //
    //     // For each container do something
    //     for ( let i = 0; i < container_blocks.length; i++ ) {
    //         makeExpand( container_blocks[i], i );
    //     }
    // }
    //
    // setExpandingBlocks();
    //
    //
    // // Adjust dimensions if browser sizes change
    // window.onresize = function() {
    //     if( !window.matchMedia( '(any-hover: none)' ).matches ) { // Only works if !NOT mobile
    //         setExpandingBlocks();
    //         // alert('onresize');
    //     }
    // };
    //
    // window.onorientationchange = function() { // Especially for mobile
    //     setExpandingBlocks();
    //     // alert('onorientationchange');
    // };
    //
    // function scrollTo( element, offset ) {
    //
    //     // console.log( element.prop('offsetTop') );
    //
    //     $( [document.documentElement, document.body] ).animate({ //jQuery
    //         scrollTop: $( element ).offset().top
    //     }, 500);
    //
    //     // window.scrollTo({
    //     //     top: element.offsetTop,
    //     //     left: 0,
    //     //     behavior: 'smooth'
    //     // });
    // }


})();
