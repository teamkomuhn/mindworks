"use strict";var debounce=function(n){let e;return function(){let t=this,o=arguments;e&&window.cancelAnimationFrame(e),e=window.requestAnimationFrame((function(){n.apply(t,o)}))}};!function(n){var e,t;n(".page")[0]&&(e=document.getElementById("main").innerText.trim().split(/\s+/).length,t=Math.ceil(e/175),document.getElementById("readtime").innerText=t);const o=n(".slide.companion");function i(){window.innerWidth<=2*n("main").outerWidth()?n("body").on("click",(function(){!n(event.target.parentNode.parentNode).hasClass("slide")&&o.hasClass("opened")&&n(o).toggleClass("opened")})):n("body").off()}o.each((function(){o.addClass("started"),n(document).on("click","button.open.companion",(function(){o.toggleClass("opened")}))})),i(),window.addEventListener("resize",debounce((function(){window.matchMedia("(any-hover: none)").matches||i()}),!0))}(jQuery);