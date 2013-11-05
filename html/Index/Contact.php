
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>
<link rel="stylesheet" type="text/css" href="../css/menu.css"> 
<link rel="shortcut icon" href="../pictures/logo.png">
<link rel="icon" href="../pictures/man.png">
<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css">
<link rel="stylesheet" type="text/css" media="all" href="../css/progression.min.css">
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/progression.min.js"></script>      
</head>

<body>
<div id="demo_top_wrapper">
 
	<!-- a header with a logo just to have some content before the menu -->
	<div id="demo_top">
		<div class="demo_container">
			<div id="my_logo"><img border="0" src="../pictures/logo.png" alt="logo" width="117" height="70" align="left" ></div>
		</div>
	</div>
	<!-- this will be our navigation menu -->
	<div id="sticky_navigation_wrapper">
		<div id="sticky_navigation">
			<div class="demo_container">
				<ul>
					<li><a href="http://www.mytrack.ca" >HOME</a></li>
					<li><a href="http://www.mytrack.ca/Index/Login.php">LOGIN</a></li>  
					<li><a href="http://www.mytrack.ca/Index/Sign-up.php" >SIGN-UP</a></li>
					<li><a href="http://www.mytrack.ca/Index/Forget_Password.php">FORGET PASSWORD</a></li>  
					<li><a href="http://www.mytrack.ca/Index/Prices.php">PRICES</a></li> 
					<li><a href="" class="selected">CONTACT US</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="w">
    <div id="content">
      <h1>Contact Us</h1>
      
      <form id="registerform" method="post" action="#">
        
        
        <div class="formrow">
          <label for="username">Email Address</label>
          <input data-progression="" type="email" name="email" id="email" class="basetxt">
          <p class="errmsg">Please Enter a Valid Email</p>
        </div>
        
        <div class="formrow">
          <label for="username">Comment</label>
          <input data-progression="" type="text" name="comment" id="comment" class="basetxt">
          <p class="errmsg">Please add some more characters</p>
        </div>
                
        <input type="submit" id="submitformbtn" class="submitbtn" value="Submit">
      </form>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script type="text/javascript">
$(function(){  
  $('#username').on('blur', function(){
    var currval = $(this).val();
    
    if(currval.length < 6) {
      $(this).next('.errmsg').slideDown();
    } else {
      // the username is 6 or more characters and we hide the error
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#email').on('blur', function(){
    // email regex source http://stackoverflow.com/a/17968929/477958
    var mailval = $(this).val();
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(mailval)) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#password2').on('blur', function(){
    var pwone = $('#password1').val();
    var pwtwo = $(this).val();
    
    if(pwtwo.length < 1 || pwone != pwtwo) {
      $(this).next('.errmsg').slideDown();
    } else if(pwone == pwtwo) {
      // both passwords match and we hide the error
      $(this).next('.errmsg').slideUp();
    }
  });
});
</script>

</body>
</html>