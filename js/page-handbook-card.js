//Add color picker global var
function colorPicker() {
    
    var card        = document.querySelector('.cards-slider');
    var cardColor   = card.dataset.color;
    document.querySelector(':root').style.setProperty('--card-color', ''+cardColor+'');
    //console.log(colorVar);

}
colorPicker();

// page-handbook-card.js

import Swiper from 'https://unpkg.com/swiper@7/swiper-bundle.esm.browser.min.js'

(function( $ ) {
    'use strict';

    //CARDS NAV on mobile
    // Only works if mobile
    if( window.matchMedia( '(any-hover: none)' ).matches ) {

        // Adjust things if browser sizes change
        window.addEventListener('resize', debounce(function() {
          addClickOutsideSlide();
        }, true));

            $(window).on('load', function() {
                const activeItemIndex = $('.cards-nav').find('a.active').index();
                const activeItemPrev = activeItemIndex - 1;
                const activeItemNext = activeItemIndex + 1;
                
                console.log(activeItemPrev); 
            });



    } // If mobile


    //TABS
    let tabs = [];
    function setTabs() {

        $( '.tabs' ).children().each( function() {
            const tab = $(this);
            const tab_button = tab.find('.tab-button');
            tabs.push( tab );

            tab_button.on('click', function(){

                for (const t of tabs) {
                    t.removeClass('active');
                }

                tab.addClass('active');
            });
        });
    }

    setTabs();


    // TODO: Make a page able to have more than one expandable content section

    const scrollTo = (element, duration = 250, delay = 0, offset = 0) => {
        setTimeout(() => {
            $([ document.documentElement, document.body ]).animate({
                scrollTop: $(element).offset().top - offset
            }, duration, `linear`)
        }, delay)
    }

    const containers = document.querySelectorAll(`.container-expandable`)
    const allExpandables = []
    const heights = []

    for (const [index, container] of containers.entries()) {

        const button = container.querySelector(`.button-expandable`)
        const expandable = container.querySelector(`.expandable`)

        allExpandables.push(expandable)
        heights.push(expandable.getBoundingClientRect().height)

        expandable.style.height = `0px`

        button.addEventListener(`click`, () => {

            const isOpen = expandable.style.height !== `0px`

            if (isOpen) {
                expandable.style.height = `0px`

                scrollTo(expandable, 250, 0, 250)
            } else {
                expandable.style.height = `${heights[index]}px`
            }

            containers[index].classList.toggle(`expanded`)
        })

    }

    //SWIPER
    new Swiper(`.swiper`, {

        speed: 500,
        spaceBetween: 100,
        autoHeight: true,

        loop: true,

        paginationClickable: true,

        pagination: {
            el: `.swiper-pagination`,
            clickable: true,

            renderBullet: (index, className) => `<li class="${className}"></li>`
        },

        keyboard: {
            enabled: true,
            onlyInViewport: true
        },

        mousewheel: true,
    })

})( jQuery );
