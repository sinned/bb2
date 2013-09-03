
	<div class="row">
		<div class="large-12 column">
			<hr />
      <ul class="inline-list">
        <li><a href="<?php echo WEBROOT; ?>blog/about-us/">About Us</a></li>
        <li><a href="<?php echo WEBROOT; ?>terms/">Terms of Service</a></li>
        <li><a href="<?php echo WEBROOT; ?>privacy/">Privacy</a></li>
        <li><a href="<?php echo WEBROOT; ?>contact/">Contact Us</a></li>
        <li class="right hide-for-small">Prepared for Now.</li>
      <ul>
		</div>
	</div>


  <div id="ageModal" class="reveal-modal">
    <img src="img/bb-logo.png" alt="Bitters+Bottles" />
    <h3>Are you over 21 years of age?</h3>
    <a href="#" class="button">Yes</a>
    <a href="#" class="button">No</a>

  </div>
  <div id="subModal" class="reveal-modal">
    <img src="<?php echo WEBROOT; ?>img/bb-logo.png" alt="Bitters+Bottles" />
    <?php include "mailchimp-form.php"; ?>
    <p class="right" style="font-size:12px;">
        <a class="close-sub" href="#">No thanks.</a>
    </p>

  </div>
  <div id="thxModal" class="reveal-modal">
    <h2>Thanks for signing up!</h2>
    <h3>Please check your email and click on the confirmation link.</h3>
    <h3>Welcome to Bitters+Bottles.</h3>
    <p>        <a class="button close-sub" href="#">Onward! &gt;&gt;</a></p>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  <div id="myModal" class="reveal-modal"></div>

  <script src="<?php echo WEBROOT; ?>js/vendor/zepto.js"></script>  
  <script src="<?php echo WEBROOT; ?>js/foundation.min.js"></script>

  <!--
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.topbar.js"></script>
    <script src="js/foundation/foundation.orbit.js"></script>    
    <script src="js/foundation/foundation.alerts.js"></script>
    <script src="js/foundation/foundation.clearing.js"></script>
    <script src="js/foundation/foundation.cookie.js"></script>
    <script src="js/foundation/foundation.dropdown.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    <script src="js/foundation/foundation.forms.js"></script>
    <script src="js/foundation/foundation.joyride.js"></script>
    <script src="js/foundation/foundation.magellan.js"></script>
    <script src="js/foundation/foundation.section.js"></script>
    <script src="js/foundation/foundation.tooltips.js"></script>
    <script src="js/foundation/foundation.interchange.js"></script>
    <script src="js/foundation/foundation.placeholder.js"></script>
    <script src="js/foundation/foundation.abide.js"></script>
  -->
  
  <script>
    $(document).foundation();
  </script>