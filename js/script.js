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

/**
 * This function will load image metadata from <figure> elements in galery.
 */
function getSlidesFromGalleryElement(gallerySelector) {
    var thumbs = document.querySelectorAll('.zakosta-gallery-item'),
        thumbCount = thumbs.length,
        items = [],
        figureElem,
        figIndex = 0;

    // loop through figure elements and load needed data
    for(var i = 0; i < thumbCount; i++) {
        figureElem = thumbs[i];

        // check that it's really a <figure> element
        if(!figureElem.tagName || figureElem.tagName.toUpperCase() !== 'FIGURE') {
            continue;
        }

        // load needed data
        var source = figureElem.getAttribute('data-source');
        var size = figureElem.getAttribute('data-size');

        // simple check
        if(source == null || source === "") {
            console.log('No source attribute for <figure> '+i);
            continue;
        }
        if(size == null || size === "" || size.split("x").length != 2) {
            console.log('No or wrong size attribute for <figure> '+i);
            continue;
        }
        size = size.split("x");

        // add item
        var item = {
            src: source,
            w: parseInt(size[0], 10),
            h: parseInt(size[1], 10),
            el: figureElem
        };

        items.push(item);
        figIndex = figIndex + 1;
    }
    console.log('Images in gallery found: '+figIndex);

    return items;
}

/**
 * Open photoswipe.
 */
function openPhotoSwipe(index, galleryElement, disableAnimation, fromURL) {
    var pswpElement = document.querySelectorAll('.pswp')[0],
        gallery,
        options,
        items;

    items = getSlidesFromGalleryElement('.zakosta-gallery');

    // define options (if needed)
    options = {

        // define gallery index (for URL)
        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

        getThumbBoundsFn: function(index) {
            // See Options -> getThumbBoundsFn section of documentation for more info
            var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                rect = thumbnail.getBoundingClientRect(); 

            return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
        }

    };

    // PhotoSwipe opened from URL
    if(fromURL) {
        if(options.galleryPIDs) {
            // parse real index when custom PIDs are used 
            // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
            for(var j = 0; j < items.length; j++) {
                if(items[j].pid == index) {
                    options.index = j;
                    break;
                }
            }
        } else {
            // in URL indexes start from 1
            options.index = parseInt(index, 10) - 1;
        }
    } else {
        options.index = parseInt(index, 10);
    }

    // exit if index not found
    if( isNaN(options.index) ) {
        return;
    }

    if(disableAnimation) {
        options.showAnimationDuration = 0;
    }

    // Pass data to PhotoSwipe and initialize it
    gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
};

/**
 * Find closes parent element.
 */
function closest(el, fn) {
    return el && ( fn(el) ? el : closest(el.parentNode, fn) );
};


/**
 * Display photoswipe on thumbnail click.
 */
var onThumbnailsClick = function(e) {
    e = e || window.event;
    e.preventDefault ? e.preventDefault() : e.returnValue = false;

    var eTarget = e.target || e.srcElement;

    // find root element of slide
    var clickedListItem = closest(eTarget, function(el) {
        return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
    });

    if(!clickedListItem) {
        return;
    }


    // find index of clicked item by looping through all child nodes
    // alternatively, you may define index via data- attribute
    // var clickedGallery = clickedListItem.parentNode,
    //     childNodes = clickedListItem.parentNode.childNodes,
    //     numChildNodes = childNodes.length,
    //     nodeIndex = 0,
    //     index;

    // for (var i = 0; i < numChildNodes; i++) {
    //     if(childNodes[i].nodeType !== 1) { 
    //         continue; 
    //     }

    //     if(childNodes[i] === clickedListItem) {
    //         index = nodeIndex;
    //         break;
    //     }
    //     nodeIndex++;
    // }
    var clickedGallery = clickedListItem.parentNode;
    var index = clickedListItem.getAttribute('data-index');



    if(index >= 0) {
        // open PhotoSwipe if valid index found
        openPhotoSwipe( index, clickedGallery );
    }
    return false;
};



