(function($) {

  $(document).ready(function(){

    //SHARE MESSAGE
    var message = $("#m-helpout-message").val();

    $(".m-helpout-share").click(function(){
      var network = $(this).attr('data-rel');
      //alert("Share on" + network + "with message " + message);
      var messageEncoded = encodeURIComponent(message);
      var shareURL;

      if( network === "facebook" ) {
        shareURL = "https://www.facebook.com/dialog/feed?app_id=134530986736267&link=http%3A%2F%2Fvalhallamovement.com%2F&picture=http%3A%2F%2Fvalhallamovement.com%2Fwp-content%2Fthemes%2Fvalhalla%2Fimg%2Ffb.png&name=The+Valhalla+Movement&description="+messageEncoded+"&redirect_uri=http://facebook.com/";
      } else if ( network === "twitter" ) {
        shareURL = "https://twitter.com/intent/tweet?text="+messageEncoded;
      } else if ( network === "googleplus" ) {
        shareURL = "https://plus.google.com/share?url=http://valhallamovement.com";
      }
      window.open(shareURL, '_blank', 'toolbar=0,location=0,menubar=0');

    });

    //STEP BY STEP
    //Initiate first step with active classes
    $('.m-helpout-nav li:eq(1)').addClass('active visited'); //omits first prev button
    $('.m-helpout .step:eq(0)').addClass('step-active'); //first step

    //number of li except for first and last
    var totalSteps = $('.m-helpout-nav li').length - 2;

    //CHANGE STEP FUNCTION
    function stepChange( index ){
      $('.m-helpout-nav li').removeClass('active');
      $('.m-helpout-nav li:eq('+index+')').addClass('active visited');

      index = index - 1;
      $('.m-helpout .step').removeClass('step-active');
      $('.m-helpout .step:eq('+index+')').addClass('step-active');
    }

    //NEXT
    $('.m-helpout-nav .next').on('click',function(){
      console.log("next clicked");
      var nextIndex = $('.m-helpout .active').index() + 1;
      if(nextIndex > totalSteps) {
        nextIndex = 1;
      }
      stepChange(nextIndex);
    });

    //PREVIOUS
    $('.m-helpout-nav .prev').on('click',function(){
      var prevIndex = $('.m-helpout .active').index() - 1;
      if(prevIndex === 0) {
        return false;
      }

      stepChange(prevIndex);
    });

    //CLICK, but only once visited
    $(document).on('click', '.m-helpout-nav li.visited', function(){
      //USE the selector below to allow skipping ahead
      //$(document).on('click', '.helpout-nav li:not(.nav)', function(){
      var activeNav = $(this);
      if(activeNav.hasClass('active')){
        return false;
      } else {
        $('.m-helpout-nav li').removeClass('active');
        $(this).addClass('active');
        var stepIndex = activeNav.index();
        stepChange(stepIndex);
      }
    });

  });

})(jQuery); // Fully reference jQuery after this point.
