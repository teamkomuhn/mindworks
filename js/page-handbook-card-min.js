import Swiper from"https://unpkg.com/swiper@7/swiper-bundle.esm.browser.min.js";!function($){"use strict";const e=(e,{duration:t=250,delay:o=0,offset:n=0,timing:l="linear",viewport:s=!1}={})=>{setTimeout((()=>{$([document.documentElement,document.body]).animate({scrollTop:$(e).offset().top-n},t,l)}),o)};window.matchMedia("(any-hover: none)").matches&&$(window).on("load",(function(){const e=document.querySelector(".cards-nav");let t=[...e.querySelectorAll("a")];if(t.length>5){const o=t.shift(),n=t.findIndex((e=>e.classList.contains("active")));if(n<t.length-6)t.splice(n+3,t.length-1-(n+3)-1,"..."),t.splice(1,n-1);else{const e=t.length-2-n;t.splice(1,n-5+e)}e.innerHTML=null,t=[o,...t];for(const o of t)e.append(o)}}));let t=[];$(".tabs").children().each((function(){const e=$(this),o=e.find(".tab-button");t.push(e),o.on("click",(function(){for(const e of t)e.removeClass("active");e.addClass("active")}))}));const o=document.querySelectorAll(".container-expandable"),n=[];for(const[t,l]of o.entries()){const o=l.querySelector("h3"),s=l.querySelector(".button-expandable"),i=l.querySelector(".expandable");n.push(i.getBoundingClientRect().height),i.style.setProperty("--height","0px"),s.addEventListener("click",(()=>{"0px"!==i.style.getPropertyValue("--height")?(i.style.setProperty("--height","0px"),e(o,{viewport:!0})):i.style.setProperty("--height",`${n[t]}px`),l.classList.toggle("expanded")}))}document.querySelectorAll(".swiper-slide").length>1&&new Swiper(".swiper",{speed:500,spaceBetween:100,autoHeight:!0,loop:!0,paginationClickable:!0,pagination:{el:".swiper-pagination",clickable:!0,renderBullet:(e,t)=>`<li class="${t}"></li>`},keyboard:{enabled:!0,onlyInViewport:!0},mousewheel:{forceToAxis:!0}});const l=new URLSearchParams(location.search).get("tool"),s=document.querySelector(".tab.tools"),i=document.querySelectorAll(".tab:not(.tools)");if(l){for(const e of i)e.classList.remove("active");s.classList.add("active");const t=document.querySelector(`#tool-${l}`);t&&e(t,{duration:0})}}(jQuery);