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
    // TODO: If one of the top panels is open, calculate of the onScroll() also the height of that closing

    const scrollTo = ( element, duration = 0, offset = 0 ) => {
        
        $( [document.documentElement, document.body] ).animate({
            scrollTop: window.scrollY + element.getBoundingClientRect().top - offset
        }, { duration, easing: `linear` })
        
    }
    

    const containers = document.querySelectorAll(`.container-expandable`)
    const allExpandables = []
    const heights = []
    let openHeight = 0
    

    for (const [index, container] of containers.entries()) {

        const button = container.querySelector(`.button-expandable`)
        const expandable = container.querySelector(`.expandable`)

        allExpandables.push(expandable)
        heights.push(expandable.getBoundingClientRect().height)

        expandable.style.height = `0px`

        button.addEventListener(`click`, event => {

            const DURATION = 250
            const OFFSET = container.getBoundingClientRect().top

            let isOpen = expandable.style.height !== `0px`

            if (isOpen) {
                expandable.style.height = `0px`

                // openHeight -= heights[index]
                // isOpen = expandable.style.height !== `0px`
            } else {
                expandable.style.height = `${heights[index]}px`

                // openHeight += heights[index]
                // isOpen = expandable.style.height !== `0px`
            }

            // const otherHeight = openHeight - (isOpen ? heights[index] : 0)
            // console.log(otherHeight)

            scrollTo(container, DURATION, OFFSET)
        })

    }

})( jQuery );
