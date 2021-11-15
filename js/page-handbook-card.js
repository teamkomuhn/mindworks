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
    // TODO: Break scrollTo() if user scrolls manualy
    // TODO: If one of the top panels is open, colculate of the onScroll() also the height of that closing

    const scrollTo = ( element, duration = 0, offset = 0 ) => {

        $( [document.documentElement, document.body] ).animate({
            scrollTop: window.scrollY + element.getBoundingClientRect().top - offset
        }, { duration, easing: `linear` })

    }

    const collapse = (element, duration = 0) => {
        open = !open

        element.style.setProperty(`--height`, `0px`)
    }

    const expand = (element, duration = 0, height = 100) => {
        open = !open

        element.style.setProperty(`--height`, `${height}px`)
    }


    const steps = document.querySelectorAll(`.step`)
    const allContents = []
    const heights = []

    for (const [index, step] of steps.entries()) {

        const header = step.querySelector(`.expandable__header`)
        const content = step.querySelector(`.expandable__content`)

        allContents.push(content)
        heights.push(content.getBoundingClientRect().height)

        collapse(content)

        header.addEventListener(`click`, event => {
            const DURATION = 250
            const OFFSET = header.getBoundingClientRect().top

            for (const content of allContents) collapse(content, DURATION)

            if (window.getComputedStyle(content).height === `0px`) {
                expand(content, DURATION, heights[index])

                scrollTo(header, DURATION, OFFSET)
            }
        })

    }

})( jQuery );
