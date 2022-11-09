<?php
    // including top.php
    include_once("top.php");
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
                                <span class="breadcrumb-item active">Forgot Password</span>
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
								<h2 class="title__line--6">Forgot Password</h2>
							</div>
						</div>
						<div class="col-xs-12">
							<!-- LogIn Area -->
							<form method="post">
							    <div class="single-contact-form">
									<div class="contact-box name">
										<input type="email" id = "email" name="email" placeholder="Your Email*" style="width:100%" required>
									</div>
									<span class="field_error" id="email_error"></span>
								</div>

                                <!-- Submit Button -->
								<div class="contact-btn">
									<button type= "button" name = "login-btn" class="fv-btn" id = "submit-btn" onclick = "forgot_password()">Submit</button>
								</div>
							</form>
							<div class="form-output">
								<p class="forgot_password_message field_error"></p>
							</div>
                        </div>
					</div>
				</div> 
			</div>
        </div>
    </section>

    <!-- jQuery Function -->
    <script>
        function forgot_password() {
            var email = jQuery("#email").val();
            if(email == '') {
                jQuery("#email_error").html("Please enter an email");
            }else {
                jQuery("#submit-btn").attr("disabled", true);
                jQuery("#submit-btn").html("Please wait....");
                jQuery.ajax({
                    url: 'forgot_password_submit.php',
                    type: 'post',
                    data: 'email='+email,
                    success: function(result) {
                        jQuery("#submit-btn").hide();
                        jQuery(".forgot_password_message").html(result);
                    }
                });
            }
        }
    </script>


<?php
    // including footer.php
    include_once("footer.php");
?>