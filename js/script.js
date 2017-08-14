/**
 * Will add class 'w3-opacity' to element with elementId and remove class 'w3-opacity-max' from that element.
 */
function addOpacity(elementId) {
	var elem = document.getElementById(elementId);
	elem.className = "w3-opacity";
}

/**
 * Will add class 'w3-opacity-max' to element with elementId and remove class 'w3-opacity' from that element.
 */
function removeOpacity(elementId) {
	var elem = document.getElementById(elementId);
	elem.className = "w3-opacity-max";
}

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = x.length} ;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
    }
    x[slideIndex-1].style.display = "block"; 
}