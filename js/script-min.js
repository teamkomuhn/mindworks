function readingTime(){var e=document.getElementById("content").innerText.trim().split(/\s+/).length,t=Math.ceil(e/225);document.getElementById("time").innerText=t}readingTime();