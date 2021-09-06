(function( $ ) {
    // main.js
    if($('.page')[0]) {
        readingTime();
    }
/*
    // Hide Infographic popoup when clicking outside the infographic section
    function clickInfographic(){
        $(document).click(function() {
            var obj = $('.infographic.popup');
            if (!obj.is(event.target) && !obj.has(event.target).length) {
                $('.infographic.popup').addClass('closed');
            } else {
                $(this).next('.infographic.popup').removeClass('closed');
            }
        });
    }*/

})( jQuery );


// READ TIME JS - https://w3collective.com/calculate-reading-time-javascript/

function readingTime() {
    var text = document.getElementById('main').innerText;
    var wpm = 175;
    var words = text.trim().split(/\s+/).length;
    var time = Math.ceil(words / wpm);
    document.getElementById('readtime').innerText = time;

    //console.log(words);
}

// ZOOM INFOGRAPHIC
let infographic;

function openInfographic() {
    infographic.classList.toggle('closed');
}

function setInfographic() {
    infographic = document.querySelector('section.infographic.popup.closed');
    const buttonClose = infographic.querySelector('header nav > button.close');

    buttonClose.addEventListener('click', openInfographic);

}

setInfographic();

//
function bindZoomButtons() {
    function bindClick() {
        return function() {
            openInfographic();
        };
    }

    const buttons = document.getElementsByClassName('zoom infographic');
    for ( var i = 0; i < buttons.length; i++ ) {
        buttons[i].addEventListener('click', bindClick(i));
    }
}

bindZoomButtons();