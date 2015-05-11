/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') { prop = 'styleFloat'; }
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        };
        return this;
    };
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it, so be sure to research and find the one
    that works for you best.
    */
    
    /* getting viewport width */
    var responsive_viewport = $(window).width();
    
    /* if is below 481px */
    if (responsive_viewport < 481) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport > 481) {
        
    } /* end larger than 481px */
    
    /* if is above or equal to 768px */
    if (responsive_viewport >= 768) {
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {
        
    }
    
	// add all your scripts here

    // Buggyfill for viewport units in iOS7
    //window.viewportUnitsBuggyfill.init();

    // Ajax call for Instagram images

    function getInstagram(id, user, num) {
        var url = 'https://api.instagram.com/v1/users/' + user + '/media/recent?client_id=' + id + '&count=' + num;
        var $widgetcontent = jQuery('.widget_instagram_widget .widgetcontent:last-child');

        jQuery.ajax({
            url: url,
            dataType: 'jsonp'
        })
            .done(function(json) {
                for (var i = 0; i < json.data.length; i++) {
                    var image = json.data[i].images.low_resolution.url;
                    var link = json.data[i].link;
                    var caption = (json.data[i].caption !== null) ? json.data[i].caption.text : 'Instagram Image';
                    $widgetcontent.append(
                          '<a href=\"' + link + '\" title=\"' + caption + '\" class=\"instagram\">' +
                          '<img src=\"' + image + '\" />' + 
                          '</a>'
                    );
                }        
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                $widgetcontent.append('<p>' + 'Sorry, but we are unable to retrieve images from Instagram at this time.' + '</p>');
            });
    }

    var $key = jQuery('#insta-key');
    var $user = jQuery('#insta-user');
    var $count = jQuery('#insta-count');

    getInstagram($key.val(), $user.val(), $count.val());

    $key.remove();
    $user.remove();
    $count.remove();
 
}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );