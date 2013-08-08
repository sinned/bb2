// custom bitters+bottles javascript, written by Dennis Yang
var bb = {};

bb.subscription = (function() {
  function init() {
    console.log('initing subscription form');

    $('.subscription-choices a').click(function(e) {
      e.preventDefault();

      // navigate up and remove the 'picked' class from all siblings, and then set this one to picked
      $(this).parents('ul').find('a').removeClass('picked');
      $(this).addClass('picked');

      return false;
    });

    $('#subfor_me').click(function(e) {
      $('#whofor input').val('');
      $('#whofor').hide();
    });
    $('#subfor_gift').click(function(e) {
      $('#whofor').show();
    });    

    $('#buy-subscription').submit(function() {
      console.log('Handler for .submit() called.');

      if ($('#subfor_me').hasClass('picked')) {

      }


      $('form#buy-subscription [name=shipto]').val($('#whofor input').val());
      //return false;
    });    
  }
  return {
    init:init
  }

})();
