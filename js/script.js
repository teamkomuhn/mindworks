// ZOOM INFOGRAPHIC
let infographic;

function openInfographic() {
    infographic.classList.toggle('closed');
    event.preventDefault();
}

function setInfographic() {
    infographic = document.querySelector('section.infographic.popup');
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


// READ TIME JS - https://w3collective.com/calculate-reading-time-javascript/

function readingTime() {
    var text = document.getElementById('content').innerText;
    var wpm = 225;
    var words = text.trim().split(/\s+/).length;
    var time = Math.ceil(words / wpm);
    document.getElementById('time').innerText = time;
}

// Vanilla JavaScript Scroll to Anchor
// @ https://perishablepress.com/vanilla-javascript-scroll-anchor/

function scrollTo() {
	var links = document.getElementsByTagName('a');
	for (var i = 0; i < links.length; i++) {
		var link = links[i];
		if ((link.href && link.href.indexOf('#') !== -1) && ((link.pathname === location.pathname) || ('/' + link.pathname === location.pathname)) && (link.search === location.search)) {
			link.onclick = scrollAnchors;
		}
	}
}

function scrollAnchors(e, respond = null) {
	const distanceToTop = el => Math.floor(el.getBoundingClientRect().top);
	e.preventDefault();
	var targetID = (respond) ? respond.getAttribute('href') : this.getAttribute('href');
	const targetAnchor = document.querySelector(targetID);
	if (!targetAnchor) {return;}
	const originalTop = distanceToTop(targetAnchor);
	window.scrollBy({ top: originalTop, left: 0, behavior: 'smooth' });
	const checkIfDone = setInterval(function() {
		const atBottom = window.innerHeight + window.pageYOffset >= document.body.offsetHeight - 2;
		if (distanceToTop(targetAnchor) === 0 || atBottom) {
			targetAnchor.tabIndex = '-1';
			targetAnchor.focus();
			window.history.pushState('', '', targetID);
			clearInterval(checkIfDone);
		}
	}, 100);
}

//
(function() {
    scrollTo();
    readingTime();
})();
