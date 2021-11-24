// page-handbook.js
(function( $ ) {
    'use strict';

    const scrollTo = (element, duration = 250, delay = 0, offset = 0) => {
        setTimeout(() => {
            $([ document.documentElement, document.body ]).animate({
                scrollTop: $(element).offset().top - offset
            }, duration, `linear`)
        }, delay)
    }

    const button = document.querySelector(`.go-to`)

    button.addEventListener(`click`, () => {
        scrollTo(`.category`)
    })


    const cards = document.querySelectorAll(`.card`)

    for (const card of cards) {
        card.addEventListener(`click`, () => {

            location.href = card.querySelector(`.open`).href

        })
    }

})( jQuery );
