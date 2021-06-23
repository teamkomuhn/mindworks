// READ TIME JS - https://w3collective.com/calculate-reading-time-javascript/

function readingTime() {
    var text = document.getElementById("content").innerText;
    var wpm = 225;
    var words = text.trim().split(/\s+/).length;
    var time = Math.ceil(words / wpm);
    document.getElementById("time").innerText = time;
}
readingTime();