const nav = document.querySelector("#main");
const topOfNav = nav.offsetTop;

function fixNav() {
	if(window.scrollY >= topOfNav) {
		document.body.style.paddingTop = nav.offsetHeight + "px";
		document.body.classList.add("fixed-nav");
	}
	else {
		document.body.style.paddingTop = 0;
		document.body.classList.remove("fixed-nav");
	}
}
window.addEventListener("scroll", fixNav);

$(document).ready(function() {
    $("nav > ul > li").mouseover(function() {
        var the_width = $(this).find("a").width();
        var child_width = $(this).find("ul").width();
        var width = parseInt((child_width - the_width)/2);
        $(this).find("ul").css('left', -width);
    });
});

//logo

const lwrapper = document.querySelector('.logo-wrapper');
const logo = document.querySelector('#logo');
const walk = 100; //100px

function shadow(e) {
	const width = lwrapper.offsetWidth;
	const height = lwrapper.offsetHeight;
	let x = e.offsetX;
	let y = e.offsetY;

	if(this !== e.target) {
		x = x + e.target.offsetLeft;
		y = y + e.target.offsetTop;
	}

	const xWalk = Math.round((x / width * walk) - (walk / 2));
	const yWalk = Math.round((y / height * walk) - (walk / 2));

	logo.style.textShadow = `${xWalk}px ${yWalk}px 0 rgba(0,0,0,0.17)`;
}

lwrapper.addEventListener('mousemove', shadow);