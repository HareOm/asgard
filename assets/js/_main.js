/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

//SOCIAL ASYNC
(function(doc, script) {
  var js,
      fjs = doc.getElementsByTagName(script)[0],
      frag = doc.createDocumentFragment(),
      add = function(url, id) {
          if (doc.getElementById(id)) {return;}
          js = doc.createElement(script);
          js.src = url;
          if(id) {js.id = id;}
          frag.appendChild( js );
      };

    // Google+ button
    add('http://apis.google.com/js/plusone.js');
    // Facebook SDK
    add('//connect.facebook.net/en_US/all.js#xfbml=1&appId=200103733347528', 'facebook-jssdk');
    // Twitter SDK
    add('//platform.twitter.com/widgets.js');

    fjs.parentNode.insertBefore(frag, fjs);
}(document, 'script'));


$(document).ready(UTIL.loadEvents);

  //Fluid Videos
  $('.vid-res').fitVids();

  //Tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  //Stick FAQ MENU
  $('#nav-faq').waypoint('sticky', {
    offset: 20 // Apply "stuck" when element 30px from top
  });

  var lastId,
    topMenu = $('#nav-faq'),
    //topMenuHeight = topMenu.outerHeight(),
    topMenuHeight = 20,
    // All list items
    menuItems = topMenu.find('a'),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr('href'));
      if (item.length) { return item; }
    });

  // Bind click handler to menu items
  // so we can get a fancy scroll animation
  menuItems.click(function(e){
    var href = $(this).attr('href'),
      offsetTop = href === '#' ? 0 : $(href).offset().top-topMenuHeight+1;
    $('html, body').stop().animate({
      scrollTop: offsetTop
    }, 300);
    e.preventDefault();
  });

  // Bind to scroll
  $(window).scroll(function(){
     // Get container scroll position
     var fromTop = $(this).scrollTop()+topMenuHeight;

     // Get id of current scroll item
     var cur = scrollItems.map(function(){
       if ($(this).offset().top < fromTop) {
         return this;
       }
     });
     // Get the id of the current element
     cur = cur[cur.length-1];
     var id = cur && cur.length ? cur[0].id : '';

     if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
       .parents('li').removeClass('active')
       .end().filter('[href=#'+id+']').parents('li').addClass('active');
     }
  });

})(jQuery); // Fully reference jQuery after this point.


function initialize() {
  var myLatlng = new google.maps.LatLng(45.400914, -73.376678);
  var mapOptions = {
    zoom: 12,
    center: myLatlng
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;
