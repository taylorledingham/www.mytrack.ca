<?php

if ($_POST['submited']==1){
  $u=trim($_POST["email"]);
  $p=trim($_POST["password1"]);
  if(strlen($u)>0 && strlen($p)>0){
    $db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
    if(!$db){
      exit("Error in database connection");
    }
    else{
    
    $encrypted_password = md5($p);
    
    $q = "SELECT `ManagerID`, `NameFirst` FROM `User` WHERE `Email`='$u' AND `Password`='$encrypted_password'";
	$q2 = "SELECT `ManagerID`, `NameFirst` FROM `Manager` WHERE `Email`='$u' AND `Password`='$encrypted_password'";
	$result = mysqli_query($db,$q);
	$result2 = mysqli_query($db,$q2);
	
	if(mysqli_num_rows($result)>0)
	{
		session_start();
	
		$_SESSION["logged_in"]=1;
		$row=mysqli_fetch_assoc($result);
	
		$_SESSION["user_id"]=$row["UserId"];
		$_SESSION["first_name"]=$row["NameFirst"];
		$_SESSION["manager_id"]=$row["ManagerID"];
		$_SESSION["type"]=$row["Type"];
	
		header("Location: http://www.mytrack.ca/Home.php");
		exit();
	}
	else if(mysqli_num_rows($result2)>0)
	{
		session_start();
	
		$_SESSION["logged_in"]=1;
		$row=mysqli_fetch_assoc($result2);
	
		$_SESSION["user_id"]=$row["ManagerId"];
		$_SESSION["first_name"]=$row["NameFirst"];
		$_SESSION["manager_id"]=$row["ManagerID"];
		$_SESSION["type"]=$row["Type"];
	
		header("Location: http://www.mytrack.ca/Home.php");
		exit();
	}
	else 
	{
		$error_message="Error with email or password";
	}
    }
  }
  else {
    $error_message="Form Must Be Filled In";
  }
}


?>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>
<link rel="stylesheet" type="text/css" href="../css/menu.css"> 
<link rel="shortcut icon" href="../pictures/icon.png">
<link rel="icon" href="../pictures/man.png">
<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css">
<link rel="stylesheet" type="text/css" media="all" href="../css/progression.min.css">
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/progression.min.js"></script>  
<script type="text/javascript" src="../js/websiteScript.js"></script>   
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
					<li><a href="" class="selected">LOGIN</a></li>  
					<li><a href="http://www.mytrack.ca/Index/Sign-up.php" >SIGN-UP</a></li>
					<li><a href="http://www.mytrack.ca/Index/Forget_Password.php">FORGET PASSWORD</a></li>  
					<li><a href="http://www.mytrack.ca/Index/Prices.php" >PRICES</a></li> 
					<li><a href="http://www.mytrack.ca/Index/Contact.php">CONTACT US</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

  
  <div id="w">
    <div id="content">
      <h1>Login Form</h1>
      
      <form id="loginform" method="post" action="http://www.mytrack.ca/Index/Login.php" >
        <div class="formrow">
          <label for="email">Email Address</label>
          <input data-progression="" type="email" name="email" id="email" class="basetxt">
          <p class="errmsg" id = "errEmail" >Invalid Email</p>
        </div>
        
        <div class="formrow">
          <label for="password1">Password</label>
          <input data-progression="" type="password" name="password1" id="password1" class="basetxt">
          <p class="errmsg">Invalid Password</p>
        </div>
        
        <div class="formrow">
          <p class="errmsg">Invalid Email/Password</p>
        </div> 
        <p class="error" style="color:red;"> <?php echo($error_message)  ?></p>     
        <input type="submit" id="submitformbtn" class="submitbtn" value="Login">
        <input type="hidden" name="submited" value=1 >
      </form>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script type="text/javascript">
$(function(){
 
 $("#loginform").submit(function(e){
 	var emailval =  document.getElementById("email").value;
 	var passwordval =  document.getElementById("password1").value;
 	var x =passwordval.search(/\d/);
	var y =passwordval.search(/\W/);
 	var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(emailval)|| emailval.length < 1) {
    	//alert("Please enter a valid Email");
    	//document.getElementById("errEmail").next('.errmsg').slideDown();
    	//alert("here");
    	e.preventDefault();
    }
    else if(passwordval.length < 6 ||(x == -1 &&  y == -1) ) {
    	//alert("Please enter a valid Password");
    	e.preventDefault();
    }  	
  });
  
  $('#email').on('blur', function(){
    var mailval = $(this).val();
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(mailval) || mailval.length < 1) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
  
   $('#password1').on('blur', function(){
    var pwone = $(this).val();
    var x =pwone.search(/\d/);
	var y =pwone.search(/\W/);
    if(pwone.length < 6 ||(x == -1 &&  y == -1) ) {
      $(this).next('.errmsg').slideDown();
    } else{
      $(this).next('.errmsg').slideUp();
    }
  });

	
});
</script>


</body>
</html>