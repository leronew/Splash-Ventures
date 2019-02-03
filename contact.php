<?php
    include_once './header.php';
?>
  
<div class="container">
            <div class="row">
                <div class="col-md-4 contact-box">
                  <h1 class="thin-paint-brush-stroke">contact us</h1>
                  <a class="tel-number" href="tel://+1-869-664-6427">Tel: 1-869-664-6427</a>
                  <!--<a class="tel-number" href="tel://+1-869-760-6427">Cell: 1-869-760-6427</a>-->
                  <a class="" href="mailto:info@splashventureskn.com?Subject=Splash%20Ventures%20Customer" target="_top">Email: info@splashventureskn.com</a>
                  <img alt="woman walking on park" id="trampoline" src="./resources/images/splash-pic (1).jpeg"/>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <h2>We can't wait to hear from you!</h2>
                    <p> Send us your message and we will get back to you as soon as possible </p>
                    <form role="form" method="post" id="reused_form">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name"> First Name:</label>
                                <input type="text" class="form-control" id="firstname" required name="firstname" maxlength="50">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="name"> Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" maxlength="50">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="email"> Email:</label>
                                <input type="text" class="form-control" id="email" required name="email" maxlength="50">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email"> Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Please leave a number" maxlength="50">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="name"> Message:</label>
                                <textarea class="form-control" id="message" required name="message" placeholder="Your Message Here. You may specify a date and time when you would like to book your adventure." maxlength="6000" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button type="submit" class="btn btn-lg btn-block" id="btnContactUs">Send Email</button>
                            </div>
                        </div>
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                </div>
            </div>
        </div>
    
</div>
</div>

<?php
  include_once './footer.php';
