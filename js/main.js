(function( $ ) {
    // main.js
    if($('.page')[0]) {
        readingTime();
    }


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