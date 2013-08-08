// custom bitters+bottles javascript, written by Dennis Yang
var bb = {};

bb.subscription = (function() {
  function init() {
    console.log('initing subscription form', price_per_month);

    $('.subscription-choices a').click(function(e) {
      e.preventDefault();

      if ($(this).hasClass('disabled')) {

      } else {
        // navigate up and remove the 'picked' class from all siblings, and then set this one to picked
        $(this).parents('ul').find('a').removeClass('picked');
        $(this).addClass('picked');     
        update_price();   
      }
      return false;
    });

    $('a#subfor_me').click(function(e) {
      $('#whofor').hide();
    });
    $('a#subfor_gift').click(function(e) {
      $('#whofor').show('fast');
    });    

    $('a#subfreq_monthly').click(function(e) {
      $('a#subduration_inf').removeClass('disabled');
    });
    $('a#subfreq_once').click(function(e) {
      $('a#subduration_inf').addClass('disabled');
    });

    $('a#substart_yes').click(function(e) {
      $('#starter_price').show();
    });
    $('a#substart_no').click(function(e) {
      $('#starter_price').hide();
    });

    $('a#subscribe-process').click(function(e) {
      e.preventDefault();
      process();
      return false;
    });    
  }

  function update_product_code() {
    var product_code = '';
    product_code += subscription_type.toUpperCase();
    product_code += subscription_type.toUpperCase();
    product_code += subscription_type.toUpperCase();

  }

  function update_price() {
    var total_price;
    var product_code = '';

    product_code += subscription_type.toUpperCase();

    if ($('a#subfreq_monthly').hasClass('picked')) {
      total_price = price_per_month;
      product_code += '-MONTHLY';
      // turn on subscription form values
      $('form#buy-subscription [name=sub_frequency]').val('1m');
      $('form#buy-subscription [name=sub_startdate]').val('15');
      $('form#buy-subscription [name=sub_enddate]').val('20131216');   

      if ($('a#subduration_3').hasClass('picked')) {
        $('#price_desc').html("$" + total_price.toFixed(2) + " / month for 3 months");
        product_code += '-3';
      } else if ($('a#subduration_6').hasClass('picked')) {
        $('#price_desc').html("$" + total_price.toFixed(2) + " / month for 6 months");
        product_code += '-6';
      } else if ($('a#subduration_12').hasClass('picked')) {
        $('#price_desc').html("$" + total_price.toFixed(2) + " / month for 12 months");
        product_code += '-12';
      } else {
        $('#price_desc').html("$" + total_price.toFixed(2) + " / month until you cancel");
        product_code += '-INF';
      }   
    } else {
      product_code += '-ONCE';
      if ($('a#subduration_3').hasClass('picked')) {
        total_price = price_per_month * 3;
        product_code += '-3';
      } else if ($('a#subduration_6').hasClass('picked')) {
        total_price = price_per_month * 6;
        product_code += '-6';
      } else if ($('a#subduration_12').hasClass('picked')) {
        total_price = price_per_month * 12;
        product_code += '-12';
      }
      $('#price_desc').html("$" + total_price.toFixed(2));        

      // turn off subscription form values
      $('form#buy-subscription [name=sub_frequency]').val('');
      $('form#buy-subscription [name=sub_startdate]').val('');
      $('form#buy-subscription [name=sub_enddate]').val('');

    }
    
    // set the form values    
    $('form#buy-subscription [name=price]').val(total_price);
    $('form#buy-subscription [name=code]').val(product_code);

  }

  function process() {
      console.log('Processing order...');
      if ($('a#subfor_gift').hasClass('picked')) {
        $('form#buy-subscription [name=shipto]').val($('#whofor input').val());   
      } else {
        $('form#buy-subscription [name=shipto]').val('');           
      }

      if ($('a#subfreq_monthly').hasClass('picked')) {

      }

      // submit the form
      $('form#buy-subscription').submit(); 
  }


  return {
    init:init
  }

})();
