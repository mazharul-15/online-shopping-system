<?php
    // Including top.php
    include_once("top.php");

    // user details
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $res = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>

<section class="htc__contact__area ptb--100 bg__white">
        <div class="container">
            <div class="row">
				<div class="col-md-6">
					<div class="contact-form-wrap mt--60">
						<div class="col-xs-12">
							<div class="contact-title">
								<h2 class="title__line--6">Profile</h2>
							</div>
						</div>
						<div class="col-xs-12">
							<!-- LogIn Area -->
							<form method="post">
                                <!-- User Id -->
                                <input type="hidden" name="user-id" id = "user-id" value = "<?php echo $res['id']; ?>">

                                <!-- Name -->
                                <div class="single-contact-form">
									<div class="contact-box name">
										<input type="text" id = "name" name="name" value = "<?php echo $res['name'];?>" style="width:100%" required>
									</div>
									<span class="field_error" id="email_error"></span>
								</div>

                                <!-- Email -->
							    <div class="single-contact-form">
									<div class="contact-box name">
										<input type="email" id = "email" name="email" value = "<?php echo $res['email']; ?>" style="width:100%" required>
									</div>
									<span class="field_error" id="email_error"></span>
								</div>

                                <!-- Password -->
                                <div class="single-contact-form">
									<div class="contact-box name">
										<input type="text" id = "password" name="password" value = "<?php echo $res['password']; ?>" style="width:100%" required>
									</div>
									<span class="field_error" id="email_error"></span>
								</div>

                                <!-- Mobile -->
                                <div class="single-contact-form">
									<div class="contact-box name">
										<input type="text" id = "mobile" name="mobile" value = "<?php echo $res['mobile']; ?>" style="width:100%" required>
									</div>
									<span class="field_error" id="email_error"></span>
								</div>

                                <!-- Submit Button -->
								<div class="contact-btn">
									<button type= "button" name = "submit-btn" class="fv-btn" id = "submit-btn" onclick = "profileUdate()">Save Changes</button>
								</div>

							</form>
							<div class="form-output">
								<p class="save-changes-msg field_error"></p>
							</div>
                        </div>
					</div>
				</div> 
			</div>
        </div>
    </section>

<!-- User Details -->


<!-- Javascript Code -->
<script>
    function profileUdate() {
        var id = jQuery("#user-id").val();
        var name = jQuery("#name").val();
        var email = jQuery("#email").val();
        var password = jQuery("#password").val();
        var mobile = jQuery("#mobile").val();

        // console.log(name);

        jQuery("#submit-btn").attr("disabled", true);
        jQuery("#submit-btn").html("Please Wait...");

        jQuery.ajax({
            url: 'profile_update.php',
            type: 'POST',
            data: 'id='+id+'&name='+name+'&email='+email+'&password='+password+'&mobile='+mobile,
            success: function(result) {
                console.log(result);
                if(result == 'done') {
                    jQuery("#submit-btn").hide();
                    jQuery(".save-changes-msg").html("Successfully Updated!!");
                }
            }
        });
    }
</script>

<?php
    // Including footer.php
    include_once("footer.php");

?>