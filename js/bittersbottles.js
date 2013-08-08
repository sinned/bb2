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

  function capitaliseFirstLetter(string)
  {
      return string.charAt(0).toUpperCase() + string.slice(1);
  }

  function update_product_code() {
    var product_code = '';
    product_code += subscription_type.toUpperCase();
    product_code += subscription_type.toUpperCase();
    product_code += subscription_type.toUpperCase();

  }

  function calculate_enddate(sub_duration) {
    var today = new Date();
    var d = today.getDate();
    var m = today.getMonth();
    var y = today.getFullYear();  
    var enddate= new Date(y, m+sub_duration, 16);
    var enddate_string =enddate.getFullYear();
    enddate_string += ("0" + String(enddate.getMonth()+1)).slice(-2); // to make a 2 digit month string add a 0 and then slice the last 2 characters.
    enddate_string += "16"; // finish the subscription on the 16th.
    return enddate_string;
  }

  function update_price() {
    var total_price;
    var product_code = '';
    var months_paid;
    var product_name;

    product_code += subscription_type.toUpperCase(); // start the product code

    if ($('a#subfreq_monthly').hasClass('picked')) {
      total_price = price_per_month;
      product_code += '-MONTHLY';
      // turn on subscription form values
      $('form#buy-subscription [name=sub_frequency]').val('1m');
      $('form#buy-subscription [name=sub_startdate]').val('15'); // start on the 15th of the month
      
      if ($('a#subduration_3').hasClass('picked')) {
        months_paid = 3;
      } else if ($('a#subduration_6').hasClass('picked')) {
        months_paid = 6;
      } else if ($('a#subduration_12').hasClass('picked')) {
        months_paid = 12;
      } else {
        $('#price_desc').html("$" + total_price.toFixed(2) + " / month until you cancel");
        product_code += '-INF';
        months_paid = 0;
        product_name = 'Monthly ' +capitaliseFirstLetter(subscription_type)+ ' Subscription';
        $('form#buy-subscription [name=sub_enddate]').val('');
      }   

      if (months_paid > 0) {
        $('#price_desc').html("$" + total_price.toFixed(2) + " / month for " +months_paid+ " months");
        $('form#buy-subscription [name=sub_enddate]').val(calculate_enddate(months_paid));   
        product_code += '-' +months_paid;        
        product_name = 'Monthly ' +capitaliseFirstLetter(subscription_type)+ ' Subscription, ' +months_paid+ ' months';
      }

      $('form#buy-subscription [name=name]').val(product_name);

    } else {
      product_code += '-ONCE';
      if ($('a#subduration_3').hasClass('picked')) {
        months_paid = 3;
      } else if ($('a#subduration_6').hasClass('picked')) {
        months_paid = 6;
      } else if ($('a#subduration_12').hasClass('picked')) {
        months_paid = 12;
      }

      total_price = price_per_month * months_paid;
      product_code += '-' + months_paid;
      $('form#buy-subscription [name=name]').val('Prepaid ' +capitaliseFirstLetter(subscription_type)+ ' Subscription, ' +months_paid+ ' months');
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
      //console.log('Processing order...');
      
      if ($('a#subfor_gift').hasClass('picked')) {
        $('form#buy-subscription [name=shipto]').val($('#whofor input').val());   
      } else {
        $('form#buy-subscription [name=shipto]').val('');           
      }

      // submit the form
      $('form#buy-subscription').submit(); 
  }


  return {
    init:init
  }

})();
