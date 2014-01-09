
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
      
      <form id="contactform" method="post" action="#">
        
        
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
$("#contactform").submit(function(e){
 	var emailval =  document.getElementById("email").value;
 	var commentval = document.getElementById("comment").value;
 	var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(emailval)|| emailval.length < 1) {
    	//alert("Please enter a valid Email");
    	//document.getElementById("errEmail").next('.errmsg').slideDown();
    	//alert("here");
    	e.preventDefault();
    }
    else if(commentval.length < 6)
    {
	    e.preventDefault();
    }
    else
    {
	    alert("Thank You");
    } 	
  });
  
    $('#comment').on('blur', function(){
    var comment = $(this).val();
    
    if(comment.length < 6) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#email').on('blur', function(){
    var emailval = $(this).val();
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(emailval)|| emailval.length < 1) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
});
</script>

</body>
</html>