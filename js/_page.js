// page.js
(function () {

    // EXPANDING CONTENT BLOCK
    // class ExpandingBlocks {
    //     constructor() {
    //         const container =
    //         const buttons = document.querySelectorAll('button');
    //         // const block = this.parentElement.parentElement;
    //         // const blockHeader = block.querySelector('header');
    //         // let blockHeight = blockHeader.offsetHeight;
    //     }
    //
    //     get block() {
    //         // buttons =
    //     }
    //
    // }
    //
    // const expandingBlocks = new ExpandingBlocks();


    // let expanded_blocks = [];
    function expandBlock( block ) {
        block.classList.toggle('expanded');

        const blockHeader = block.querySelector('header');
        let blockHeight = block.offsetHeight;
        let blockHeaderHeight = blockHeader.offsetHeight;

        if ( block.classList.contains('expanded') ) {
            block.style.maxHeight = blockHeaderHeight + 'px';
        }


        // block.style.clip = `rect(auto, auto, ${blockHeight}px, auto)`;

        // let blockHeaderHeight = blockHeader.offsetHeight;
        // const factorY = blockHeaderHeight / block.offsetHeight;
        //
        // block.style.transform = `scaleY(${factorY})`;

        // block.style.maxHeight = blockHeight;
    }

    function bindExpandButtons( block ) {
        const buttons = block.querySelectorAll('button');

        for ( let i = 0; i < buttons.length; i++ ) {
            buttons[i].addEventListener('click', function() {
                expandBlock(block);
            }, false );
        }

    }

    function makeExpand( container_block ) {
        // Find all expanding content blocks
        const blocks = container_block.querySelectorAll('.expandable');

        for ( let i = 0; i < blocks.length; i++ ) {
            expandBlock( blocks[i] );
            bindExpandButtons( blocks[i] );
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



})();
