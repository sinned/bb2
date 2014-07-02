
	<div class="row">
		<div class="large-12 column">
			<hr />
      <ul class="footerlist inline-list">
        <li><a href="<?php echo WEBROOT; ?>about-us/">About Us</a></li>
        <li><a href="<?php echo WEBROOT; ?>terms/">Terms of Service</a></li>
        <li><a href="<?php echo WEBROOT; ?>privacy/">Privacy</a></li>
        <li><a href="<?php echo WEBROOT; ?>contact/">Contact Us</a></li>

        <li class="right hide-for-small">
          Prepared for Now.
        </li>
        <li class="right">
          <a href="http://instagram.com/bittersandbottles/">
            <img src="http://i.bittersandbottles.com/img/instagram.png" alt="Follow @BittersAndBottles on Instagram" title="Follow @BittersAndBottles on Instagram" />
          </a>          
        </li>
      <ul>
		</div>
	</div>

<?php if (!isset($notcheckout)) { ?>
  <div id="ageModal" class="reveal-modal small">
    <img src="http://i.bittersandbottles.com/img/bb-logo.png" alt="Bitters+Bottles" />
    <h3 style="font-weight:300;">Are you over 21 years of age?</h3>
    <a href="#" class="button">Yes</a>
    <a href="#" class="button">No</a>

  </div>
  <div id="subModal" class="reveal-modal small">
    <img src="http://i.bittersandbottles.com/img/bb-logo.png" alt="Bitters+Bottles" style="width:97%"/>
    <?php include "mailchimp-form.php"; ?>
    <p class="right" style="font-size:12px;">
        <a class="close-sub" href="#">No thanks.</a>
    </p>

  </div>
  <div id="thxModal" class="reveal-modal medium">
    <h2>Thanks for signing up!</h2>
    <h3>Please check your email and click on the confirmation link.</h3>
    <h3>Welcome to Bitters+Bottles.</h3>
    <p>        <a class="button close-sub" href="#">Onward! &gt;&gt;</a></p>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  <div id="myModal" class="reveal-modal medium text-center"></div>

  <script src="<?php echo WEBROOT; ?>js/vendor/zepto.js"></script>
  <script type="text/javascript" charset="utf-8">
  fcc.events.cart.preprocess.add(function(e, arr) {
    if (arr['cart'] == 'checkout' || arr['cart'] == 'updateinfo' || arr['output'] == 'json') {
      return true;
    }
    if (arr['cart'] == 'checkout_paypal_express') {
      _gaq.push(['_trackPageview', '/paypal_checkout']);
      return true;
    }
    _gaq.push(['_trackPageview', '/cart']);
    return true;
  });
  fcc.events.cart.process.add_pre(function(e, arr) {
    var pageTracker = _gat._getTrackerByName();
    jQuery.getJSON('https://' + storedomain + '/cart?' + fcc.session_get() + '&h:ga=' + escape(pageTracker._getLinkerUrl('', true)) + '&output=json&callback=?', function(data){});
    return true;
  });
  </script>
<?php } // if notcheckout ?>
  <script src="<?php echo WEBROOT; ?>js/foundation.min.js"></script>
  
  <script>
    $(document).foundation();
  </script>