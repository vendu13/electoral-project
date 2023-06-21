<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location: admin/home.php');
  	}

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" style="background-color:white !important;">
<div class="login-box" >
  	<div class="login-logo">
  		<b>Electoral</b>
  	</div>
  
 
  
  	<div class="login-box-body" style="background-image:url(images/tablet_PNG8590.png); background-size:cover; height: 532px;">
    	<p class="login-box-msg" style="margin-top: 60px;">Sign in to start your session</p>

    	<form action="login.php" style="padding: 20px;" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="Voter's ID" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
           <div class="form-group has-feedback">
           <input id="textBox" type="text" name="text" class="form-control">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback text-center">
           <canvas id="captcha" style="height:90px;">captcha text</canvas>
          </div>
          
      	
    			<div class="col-xs-12">
          			<button type="submit" class="btn btn-primary btn-block" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      	
    	</form>
  	</div>
   
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>

<footer>

</div>
</html>
<script>
    // document.querySelector() is used to select an element from the document using its ID
let captchaText = document.querySelector('#captcha');
var ctx = captchaText.getContext("2d");
ctx.font = "30px Roboto";
ctx.fillStyle = "#08e5ff";

let userText = document.querySelector('#textBox');
let submitButton = document.querySelector('#submitButton');
let output = document.querySelector('#output');
let refreshButton = document.querySelector('#refreshButton');

// alphaNums contains the characters with which you want to create the CAPTCHA
let alphaNums = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
let emptyArr = [];
// This loop generates a random string of 7 characters using alphaNums
// Further this string is displayed as a CAPTCHA
for (let i = 1; i <= 7; i++) {
 emptyArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
}
var c = emptyArr.join('');
ctx.fillText(emptyArr.join(''),captchaText.width/4, captchaText.height/2);

// This event listener is stimulated whenever the user press the "Enter" button
// "Correct!" or "Incorrect, please try again" message is
// displayed after validating the input text with CAPTCHA
userText.addEventListener('keyup', function(e) {
 // Key Code Value of "Enter" Button is 13
 if (e.keyCode === 13) {
 if (userText.value === c) {
 output.classList.add("correctCaptcha");
 output.innerHTML = "Correct!";
 } else {
 output.classList.add("incorrectCaptcha");
 output.innerHTML = "Incorrect, please try again";
 }
 }
});
// This event listener is stimulated whenever the user clicks the "Submit" button
// "Correct!" or "Incorrect, please try again" message is
// displayed after validating the input text with CAPTCHA
submitButton.addEventListener('click', function() {
 if (userText.value === c) {
 output.classList.add("correctCaptcha");
 output.innerHTML = "Correct!";
 } else {
 output.classList.add("incorrectCaptcha");
 output.innerHTML = "Incorrect, please try again";
 }
});
// This event listener is stimulated whenever the user press the "Refresh" button
// A new random CAPTCHA is generated and displayed after the user clicks the "Refresh" button
refreshButton.addEventListener('click', function() {
 userText.value = "";
 let refreshArr = [];
 for (let j = 1; j <= 7; j++) {
 refreshArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
 }
 ctx.clearRect(0, 0, captchaText.width, captchaText.height);
 c = refreshArr.join('');
 ctx.fillText(refreshArr.join(''),captchaText.width/4, captchaText.height/2);
 output.innerHTML = "";
});

</script>