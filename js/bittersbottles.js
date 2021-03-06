// custom bitters+bottles javascript, written by Dennis Yang
var bb = {};

bb.subscription = (function() {
  function init() {
    //console.log('initing subscription form', price_per_month);

    // set the right column to the same height as the left
    var leftheight = $("#subscription-left").height();
    // each row of bottles is 192 high, so snap to each 192 with the remainder.
    var rightheight = Math.ceil(leftheight / 192) * 192 ;
    $("#subscription-right").height(rightheight);

    $('.show-subscription-choices-button').click(function(e) { 
      e.preventDefault();
      $('.subscription-choices').show('fast', function () {
          // set the right column to the same height as the left
          var leftheight = $("#subscription-left").height();
          // each row of bottles is 192 high, so snap to each 192 with the remainder.
          var rightheight = Math.ceil(leftheight / 192) * 192 ;
          $("#subscription-right").height(rightheight);
      });
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
    var enddate = new Date();
    enddate.setMonth(enddate.getMonth() + sub_duration - 1); // end the subscription minus one month, plus one day 

    var enddate_string =enddate.getFullYear();
    enddate_string += ("0" + String(enddate.getMonth()+1)).slice(-2); // to make a 2 digit month string add a 0 and then slice the last 2 characters.
    enddate_string += ("0" + String(enddate.getDate()+1)).slice(-2); // to make a 2 digit date string add a 0 and then slice the last 2 characters.
    return enddate_string;
  }

  function update_price() {
    var total_price;
    var product_code = '';
    var months_paid = 0;
    var product_name;

    product_code += subscription_type.toUpperCase(); // start the product code

    if ($('a#subduration_1').hasClass('picked')) {
      $('a#subfreq_once').addClass('picked');
      $('a#subfreq_monthly').removeClass('picked');
    } 

    if ($('a#subfreq_once').hasClass('picked')) {
      product_code += '-ONCE';
      if ($('a#subduration_3').hasClass('picked')) {
        months_paid = 3;
      } else if ($('a#subduration_6').hasClass('picked')) {
        months_paid = 6;
      } else if ($('a#subduration_12').hasClass('picked')) {
        months_paid = 12;
      } else if ($('a#subduration_1').hasClass('picked')) {
        months_paid = 1;
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
      
      if ($('a#subduration_3').hasClass('picked')) {
        months_paid = 3;
      } else if ($('a#subduration_6').hasClass('picked')) {
        months_paid = 6;
      } else if ($('a#subduration_12').hasClass('picked')) {
        months_paid = 12;
      } else if ($('a#subduration_inf').hasClass('picked')) {
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
      var giftmessage = '';
      
      // validate that all selections have been made

      if ($('.choice1').hasClass('picked') && $('.choice2').hasClass('picked') && $('.choice3').hasClass('picked') && $('.choice4').hasClass('picked')) {
        if ($('a#subfor_gift').hasClass('picked')) {
          whofor = $('#whofor input').val();
          giftmessage = $('#whofor textarea').val();
          $('form#buy-subscription [name=shipto]').val(whofor);   
          $('form#buy-subscription [name=Gift_Message]').val(giftmessage);   

        } else {
          $('form#buy-subscription [name=shipto]').val('');  
          $('form#buy-subscription [name=Gift_Message]').val('');   
        }

        // add the starter kit if it's selected.
        if ($('a#substart_yes').hasClass('picked')) {
          var carturl = '';
          if (subscription_type == 'cocktails') {
            carturl = 'https://bittersandbottles.foxycart.com/cart?name=Bar+Tools+Starter+Kit&price=35&shipto='+whofor+'&category=BARGOODS&code=BAR-TOOLS-STARTER-KIT' +fcc.session_get()+'&output=json&callback=?';
          } else if (subscription_type == 'spirits') {
            carturl = 'https://bittersandbottles.foxycart.com/cart?name=Barware+Starter+Kit&price=35&shipto='+whofor+'&category=BARGOODS&code=BARWARE-STARTER-KIT' +fcc.session_get()+'&output=json&callback=?';
          }

          if (carturl != '') {
            $.getJSON(carturl, function(data) {
              // callback function goes here
            });            
          }
        }

        // submit the form
        $('form#buy-subscription').submit(); 

        //reset the form
        $('.picked').removeClass('picked');
        $('#whofor').hide();
        $('#whofor input').val('');
        $('#whofor textarea').val('');
        $('form#buy-subscription [name=shipto]').val('');  
        $('form#buy-subscription [name=Gift_Message]').val('');   

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
   // console.log('initing the age verification');

    $('#ageModal a').click(function(e) {
      e.preventDefault();
      //console.log('CLICKY', $(this).html());
      if ($(this).html().toLowerCase() == 'yes') {
        _gaq.push(['_trackEvent', 'Age Verification', 'Yes', age_verified_check]);
        age_verified();
      } else {
        window.location.assign("http://www.caprisun.com/");
        _gaq.push(['_trackEvent', 'Age Verification', 'No', age_verified_check]);
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
    //console.log('Reading age cookie', $.cookie('age_verified'));
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
    _gaq.push(['_trackPageview', window.location.pathname + '?verify']);
    ga('send', 'pageview', window.location.pathname + '?verify');    
  }

  return {
    init: init,
    verify:verify
  }

})();

bb.mailinglist = (function() {

  function init () {
    //console.log('init mailinglist stuff');
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
