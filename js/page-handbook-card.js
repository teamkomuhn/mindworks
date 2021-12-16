// page-handbook-card.js

import Swiper from 'https://unpkg.com/swiper@7/swiper-bundle.esm.browser.min.js'

(function( $ ) {

    'use strict';

    const scrollTo = (element, duration = 250, delay = 0, offset = 0, timing = `linear`) => {
        
        setTimeout(() => {
            $([ document.documentElement, document.body ]).animate({
                scrollTop: $(element).offset().top - offset
            }, duration, timing)
        }, delay)
        
    }
    

    // Cards navigation

    const isMobile = window.matchMedia( '(any-hover: none)' ).matches

    if (isMobile) {

        $(window).on('load', function() {

            // TODO: 🧹 Clean up @ayoreis

            const nav = document.querySelector(`.cards-nav`)
            let cards = [ ...nav.querySelectorAll(`a`) ]

            if (cards.length > 5) {

                const first = cards.shift()
                const active = cards.findIndex(card => card.classList.contains(`active`))

                if (active < (cards.length - 6)) {
                    cards.splice(active + 3, cards.length - 1 - (active + 3) - 1, `...`)
                    cards.splice(1, active - 1)
                } else {
                    const difference = cards.length - 2 - active

                    cards.splice(1, active - 5 + difference)
                }

                nav.innerHTML = null

                cards = [ first, ...cards ]

                for (const card of cards) nav.append(card)
            }
        })

    }


    // Tabs

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


    // 🪜 Expandable steps

    const containers = document.querySelectorAll(`.container-expandable`)

    for (const container of containers) {

        const button = container.querySelector(`.button-expandable`)
        const expandable = container.querySelector(`.expandable`)

        const { scrollHeight } = expandable

        button.addEventListener(`click`, event => {
            
            let height = scrollHeight

            const isOpen = container.classList.contains(`expanded`)

            if (isOpen) height = 0

            scrollTo(container)

            container.style.setProperty(`--height`, height)
            container.classList.toggle(`expanded`)
        })
    }


    // Examples carousel

    const slides = document.querySelectorAll(`.swiper-slide`)

    if (slides.length > 1) {

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

            mousewheel: {
                forceToAxis: true
            }
        })

    }


    // Link to tool

    const toolName = new URLSearchParams(location.search).get(`tool`)
    const toolsTab = document.querySelector(`.tab.tools`)
    const otherTabs = document.querySelectorAll(`.tab:not(.tools)`)

    if (toolName) {

        for (const tab of otherTabs) tab.classList.remove(`active`)
        toolsTab.classList.add(`active`)

        const tool = document.querySelector(`#tool-${toolName}`)

        if (tool) scrollTo(tool, { duration: 0 })
    }

})( jQuery );