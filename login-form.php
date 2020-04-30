<?php include_once "config.php";?>

<?php
session_start();
if(!isset($_SESSION['is_login']))
{
if(isset($_POST['login-btn'])){
    $email=$_POST['email'];
    //$uname=$_POST['username'];
    $password=$_POST['signup-password'];
    
    $sql="select * from reg_details1 where   email='".$email."'AND signup_password='".$password."' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
	if(mysqli_num_rows($result)==1)
	{	
		$_SESSION['is_login']=true;
		$_SESSION['email']=$email;
		echo"welcome".$_SESSION['email'];
		echo " You Have Successfully Logged in";
		header("Location: welcome1.php");
		exit();
    }
    else{
			echo "Incorrect Email and password";
		}
        
}
}
else{
    header("location:welcome1.php");

}
?>
<!Doctype html>
<head>
<link rel="stylesheet" type="text/css" href="Css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<div class="sign-up-container">
			<div class="login-signup">
				<a href="user-registration-form.php">Sign up</a>
			</div>
			<div class="signup-align">
				<form name="login"  method="post" 
					onsubmit="return loginValidation()" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
					<div class="signup-heading">Login</div>
					<div class="error-msg" id="error-msg"></div>

					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Email<span class="required error" id="email-info"></span>
							</div>
							<input class="input-box-330" type="email" name="email" id="email">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error" id="signup-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="signup-password" id="signup-password">
						</div>
					</div>
					<div class="row">
						<input class="sign-up-btn" type="submit" name="login-btn"
							id="login-btn" value="Login">
					</div>

				</form>
			</div>
        </div>
        <script>
	function loginValidation() {
	var valid = true;
	// $("#username").removeClass("error-field");
	// $("#password").removeClass("error-field");
	$("#email").removeClass("error-field");

	var email = $("#email").val();
	var Password = $('#signup-password').val();
	var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

	$("#email-info").html("").hide();
	$("#email-info").html("").hide();

	if (email == "") {
		$("#email-info").html("required").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (email.trim() == "") {
		$("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (!emailRegex.test(email)) {
		$("#email-info").html("Invalid email address.").css("color", "#ee0000")
				.show();
		$("#email").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#signup-password-info").html("required.").css("color", "#ee0000").show();
		$("#signup-password").addClass("error-field");
		valid = false;
	}
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;	
}
 </script>
</body>

</html>