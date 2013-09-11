// custom bitters+bottles javascript, written by Dennis Yang
var bb = {};

bb.subscription = (function() {
  function init() {
    console.log('initing subscription form', price_per_month);

    $('.show-subscription-choices button').click(function(e) { 
      $('.subscription-choices').show('fast');
      $('.show-subscription-choices').hide();
      _gaq.push(['_trackPageview', '/' + subscription_type + '/subscribe/']);
      ga('send', 'pageview', '/' + subscription_type + '/subscribe/');
    });

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
      if ($('a#subduration_inf').hasClass('picked')) {
        $('a#subduration_12').click();
      }
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
    var startdate;

    // if it's after the 10th, then start on the next month.
    if (d > 10) {
      if (m == 12) {
        m = 1;
      } else {
        m = m + 1;
      }
    }

    var enddate= new Date(y, m+sub_duration-1, 16);
    var enddate_string =enddate.getFullYear();
    enddate_string += ("0" + String(enddate.getMonth()+1)).slice(-2); // to make a 2 digit month string add a 0 and then slice the last 2 characters.
    enddate_string += "11"; // finish the subscription on the 11th.
    return enddate_string;
  }

  function update_price() {
    var total_price;
    var product_code = '';
    var months_paid = 1;
    var product_name;

    product_code += subscription_type.toUpperCase(); // start the product code

    if ($('a#subfreq_once').hasClass('picked')) {
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

    } else if ($('a#subfreq_monthly').hasClass('picked')) {
      total_price = price_per_month;
      product_code += '-MONTHLY';
      // turn on subscription form values
      $('form#buy-subscription [name=sub_frequency]').val('1m');
      $('form#buy-subscription [name=sub_startdate]').val('10'); // start on the 10th of the month
      
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
      $('#price_desc').html('TBD, depending on your selections.');
    }
    
    // set the form values    
    $('form#buy-subscription [name=price]').val(total_price);
    $('form#buy-subscription [name=code]').val(product_code);

  }

  function process() {
      //console.log('Processing order...');
      var whofor = '';
      
      // validate that all selections have been made

      if ($('.choice1').hasClass('picked') && $('.choice2').hasClass('picked') && $('.choice3').hasClass('picked') && $('.choice4').hasClass('picked')) {
        if ($('a#subfor_gift').hasClass('picked')) {
          whofor = $('#whofor input').val();
          $('form#buy-subscription [name=shipto]').val(whofor);   
        } else {
          $('form#buy-subscription [name=shipto]').val('');           
        }

        // add the barware caboodle if it's selected.
        if ($('a#substart_yes').hasClass('picked')) {
          // get the URL https://bittersandbottles.foxycart.com/cart?name=Barware+Caboodle&price=20&shipto=bob&category=DEFAULT&code=CABOODLE
          var carturl = 'https://bittersandbottles.foxycart.com/cart?name=Barware+Caboodle&price=20&shipto='+whofor+'&category=BARGOODS&code=BARWARE-CABOODLE' +fcc.session_get()+'&output=json&callback=?';
          $.getJSON(carturl, function(data) {
            // callback function goes here
          });
        }

        // submit the form
        $('form#buy-subscription').submit(); 
      } else {
        //alert('Before we add your subscription to the cart, please make all selections.');
        $('#myModal').html('Before we add your subscription to the cart, please make all selections.<a class="close-reveal-modal">&#215;</a>');
        $('#myModal').foundation('reveal', 'open');
      }
  }

  return {
    init:init
  }

})();

bb.age_verify = (function() {

  var age_verified_check = 'aug20a';

  function init() {
    console.log('initing the age verification');

    $('#ageModal a').click(function(e) {
      e.preventDefault();
      console.log('CLICKY', $(this).html());
      if ($(this).html().toLowerCase() == 'yes') {
        age_verified();
      }
    });

    verify();
  }

  function age_verified() {
    // set the cookie
    $.cookie('age_verified', age_verified_check, { expires: 14 });
    // close the modal
    $('#ageModal').foundation('reveal', 'close');
    // show the newsletter sub modal.
    /* don't show the newsletter sub modal anymore DY 9/3/2013
    $('#subModal').foundation('reveal', 'open' ,
      {
        animationSpeed: 250,
        closeOnBackgroundClick: true
      }
    );
    $('.reveal-modal-bg').css('background-color','rgba(0,0,0,.65)');
    */
  }

  function verify() {
    console.log('Reading age cookie', $.cookie('age_verified'));
    if ($.cookie('age_verified') != age_verified_check || document.location.search == '?verify') {
      showmodal();
    }
  }

  function showmodal() {
    $('#ageModal').foundation('reveal', 'open' ,
      {
        animationSpeed: 250,
        closeOnBackgroundClick: false
      }
    );
    $('.reveal-modal-bg').css('background-color','#000');
  }

  return {
    init: init,
    verify:verify
  }

})();

bb.mailinglist = (function() {

  function init () {
    console.log('init mailinglist stuff');
    $('.close-sub').click(function (e) {
      e.preventDefault();
      $('.reveal-modal').foundation('reveal', 'close');
    });
    $('.open-sub').click(function (e) {
      e.preventDefault();
      $('#subModal').foundation('reveal', 'open');
      $('.reveal-modal-bg').css('background-color','rgba(0,0,0,.65)');
    });    
  }

  return {
    init: init
  }
})();

bb.cards = (function() {

  function init() {
    $('.card').mouseenter(function (e) {
      var hoverimg = $(this).find('img');
      var origsrc = hoverimg.attr('src');
      var newsrc = origsrc.replace('.jpg','-hover.jpg');
      hoverimg.attr('src', newsrc);
    }).mouseleave(function (e) {
      var hoverimg = $(this).find('img');
      var origsrc = hoverimg.attr('src');
      var newsrc = origsrc.replace('-hover.jpg','.jpg');      
      hoverimg.attr('src',newsrc);
    });
  }

  return {
    init: init
  }

})();
