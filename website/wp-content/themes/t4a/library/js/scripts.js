/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function

/*
 * Menu toggles
 */
function openOffcanvasNav() {
    document.body.style.overflow = "hidden";

    document.getElementById("responsive-header").style.width = "250px";
    document.getElementById("container").classList.add("offcanvas-expanded");
    document.getElementById("container").style.left = "250px";
    document.getElementById("content").style.opacity = "0.5";
    document.getElementById("footer").style.opacity = "0.5";
}

function closeOffcanvasNav() {
    document.body.style.overflow = "scroll";

    document.getElementById("responsive-header").style.width = "0";
    document.getElementById("container").classList.remove("offcanvas-expanded");
    document.getElementById("container").style.left= "0";
    document.getElementById("content").style.opacity = "1";
    document.getElementById("footer").style.opacity = "1";
}

/*
 * Put all your regular jQuery in here.
*/
(function($) {
    // set parent active
    $('li.current-menu-item.current_page_item').each(function(e) {
        $this = $(this);
        $this.parent().parent().addClass('current-menu-ancestor current-menu-parent');
    });

    $(document).ready(function($) {
        /*
         * Let's fire off the gravatar function
         * You can remove this if you don't need it
         */
        loadGravatars();
    }); /* end of as page load scripts */

    // toggle offcanvas
    $('#offcanvas-toggle').click(function(e) {
        $this = $(this);
        if ($this.hasClass('opened')) {
            closeOffcanvasNav();
        } else {
            openOffcanvasNav();
        }
        $this.toggleClass('opened');
    });

    // close offcanvas of container gets clicked
    $('#container').click(function(e) {
        if ((e.target != $('.offcanvas')[0]) && (e.target != $('#offcanvas-toggle')[0])
            && (e.target != $('.offcanvas-hamburger')[0]) && (e.target != $('.offcanvas-toggle-label')[0])
            && (e.target != '<span></span>') && ($('#container').hasClass('offcanvas-expanded'))) {

            var liTags = $($('.offcanvas')[0]).find('li');
            var aTags = $($('.offcanvas')[0]).find('a');
            for (var i = 0; i < liTags.length; i++) {
                if (e.target == liTags[i] || e.target == aTags[i]) {
                    return;
                }
            }

            // container was clicked so close
            $('#offcanvas-toggle').click();
        }
    });

    $('.nav li.menu-toggle > a').click(function(e) {
        $this = $(this);
        $this.parent().toggleClass('toggled');
        return false;
    });

    $('.t4a-newsletter-link a').click(function(e) {
        $('html, body').animate({ scrollTop: $(document).height() }, '1000');
        $('input[name=frm_email]').focus();
        return false;
    });

    var ycoord = $(window).scrollTop();
    var triggerPos = 'true';

    //$(".elementor-post__thumbnail__link").click(function() {  //use a class, since your ID gets mangled
    //  $('body').addClass('bodyLocked');     //add the class to the clicked element
    //  ycoord = $(window).scrollTop();
    //  ycoord = ycoord * -1;
    //});

    $('body').click(function(e) {
    var target = $(e.target);

    if(triggerPos == 'true' ){
      ycoord = $(window).scrollTop();
      ycoord = ycoord * -1;
      //console.info(ycoord);
      }
    if($('.dialog-lightbox-widget').size() == 0 ){
//      console.info("nix");
      return;
      }
    if($('.dialog-lightbox-widget').is(':visible')){
      //console.info(target);
      if(target.is('.elementor-lightbox-prevent-close') || target.is('.eicon-chevron-right') || target.is('.eicon-chevron-left')){
        //console.info("nix tun");
        return;
      } else {
        $('body').removeClass('bodyLocked');
        $('body').css('top', 'auto');
        $(window).scrollTop($('body').data('ycoord'));
        triggerPos = 'true';
      //  console.info("remove Class");
      }
    }
    });

    $(window).scroll(function(){

    if($('.dialog-lightbox-widget').size() == 0 ){
      return;
      }
    if($('.dialog-lightbox-widget').is(':visible') && $('body:not(.bodyLocked)')){
      $('body').css('top',ycoord + 'px');
      $('body').addClass('bodyLocked');
      triggerPos = 'false';
    }
    });

})(jQuery);
