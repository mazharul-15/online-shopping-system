<?php
    // including top.php
    include_once("top.php");

	// // Register Section
	// if(isset($_POST['register-btn'])) {
	// 	$register_msg = user_register($con, $_POST);
	// }

	// // login Section
	// if(isset($_POST['login-btn'])) {
	// 	$login_msg = user_login($con, $_POST);
	// }
?>

        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login/Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<!-- LogIn Area -->
								<form method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" id = "login_email" name="email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" id = "login_password" name="password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="login_password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type= "button" name = "login-btn" class="fv-btn" onclick = "user_login()">Login</button>
										<!-- Forgot Password Link -->
										<a href="forgot_password.php" class = "forgot-password">Forgot Password?</a>
									</div>
								</form>
								<div class="form-output">
									<p class="login_message field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
				
					<!-- Registration Area -->
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" id = "name" name="name" placeholder="Your Name*" style="width:100%" >
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" id = "email" name="email" placeholder="Your Email*" style="width: 60%;" >
											
											<!-- Send OTP -->
											<button type = "button" id = "send-otp-btn" onclick = "send_otp()" class="btn-style">Send OTP</button>
											<!-- <input type="text" class = "verify-email" id="send-otp" placeholder = "verify email"> -->
											<!-- Verify OTP -->
											<button type = "button" id = "verify-otp-btn" onclick = "verify_otp()" class="fv-btn verify-otp btn-style">Verify OTP</button>
											<input type="text" class = "verify-otp" id="verify-otp" placeholder = "verify OTP">
										
											<!-- verified message -->
											<span id = "otp-result"></span>
										</div>
										<span class="field_error" id="email_error"></span>
									</div>

									<!-- OTP Verification Testing for submit button -->
									<div class="single-contact-form">
										<input type="hidden" id = "otp-submit" value = "NO">
									</div>

									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" id = "mobile" name="mobile" placeholder="Your Mobile*" style="width:100%" >
										</div>
										<span class="field_error" id="mobile_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" id = "password" name="password" placeholder="Your Password*" style="width:100%" >
										</div>
											<span class="field_error" id="password_error"></span>
								</div>
									
									<div class="contact-btn">
										<button type="button" name = "register-btn" class="fv-btn" onclick = "user_register()">Register</button>
									</div>
								</form>
								<div class="form-output" style = "color: red">
									<p class="register-messege">
									</p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
        <!-- End Contact Area -->

		<!-- Javascript Section -->
		<script>
			function send_otp() {
				var email = jQuery("#email").val();
				if(email == '') {
					jQuery("#email_error").html("Please enter email!");
				}else {
					jQuery("#send-otp-btn").html("Please Wait..");
					jQuery("#send-otp-btn").attr("disabled", true);
					jQuery.ajax({
						url: 'send_otp.php',
						type: 'post',
						data: 'email='+email,
						success: function(result) {
							if(result == 'done') {

								jQuery("#email").attr("disabled", true);
								jQuery("#send-otp-btn").hide();
								jQuery("#email_error").hide();
								jQuery(".verify-otp").show();
								
							}else {
								jQuery("#email_error").show();
								jQuery("#email_error").html("Please enter valid email!!");
							}
							
						}
					});
					
				}
			}

			function verify_otp() {
				var otp = jQuery("#verify-otp").val();
				if(otp == '') {
					jQuery("#email_error").show();
					jQuery("#email_error").html("Please enter otp");
				}else {

					jQuery.ajax({
						url: 'verify_otp.php',
						type: 'post',
						data: 'otp='+otp,
						success: function(result) {
							if(result == 'done') {

								jQuery(".verify-otp").hide();
								jQuery("#email_error").hide();
								jQuery("#otp-result").css("display", "block");
								jQuery("#otp-result").html("Email is Varified");
								jQuery("#otp-submit").val("YES");
							}else {
								jQuery("#email_error").show();
								jQuery("#email_error").html("Please enter right otp");
							}
						}
					});
				}
			}
		</script>

<?php
    // including footer.php
    include_once("footer.php");
?>