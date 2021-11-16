// page-handbook-card.js
(function( $ ) {
    'use strict';

    let tabs = [];
    function setTabs() {

        $( '.tabs' ).children().each( function() {
            const tab = $(this);
            const tab_button = tab.find('.tab-button');
            tabs.push( tab );

            tab_button.on('click', function(s){

                for (const t of tabs) {
                    t.removeClass('active');
                }

                tab.addClass('active');
            });
        });
    }

    setTabs();


    // TODO: Make a page able to have more than one expandable content section

    const containers = document.querySelectorAll(`.container-expandable`)
    const allExpandables = []
    const heights = []
    let openHeight = 0
    

    for (const [index, container] of containers.entries()) {

        const DURATION = 250

        const button = container.querySelector(`.button-expandable`)
        const expandable = container.querySelector(`.expandable`)

        allExpandables.push(expandable)
        heights.push(expandable.getBoundingClientRect().height)

        expandable.style.height = `0px`

        button.addEventListener(`click`, event => {
            const OFFSET = container.getBoundingClientRect().top

            const isOpen = expandable.style.height !== `0px`

            if (isOpen) {
                expandable.style.height = `0px`
            } else {
                expandable.style.height = `${heights[index]}px`
            }
        })

    }

})( jQuery );
