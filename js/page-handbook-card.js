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

})( jQuery );
