<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www.mytrack.ca/Index/Login.php");
else if($_SESSION["type"] == "general")
	header("Location: http://www.mytrack.ca");
else
{
	$managerID = $_SESSION["manager_id"];
	$meetID = $_SESSION["meet_id"];
	$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
		if(!$db)
			exit("Error with database connection");
	if ($_POST['Submited']==1){
		//$managerID = $_SESSION["manager_id"];
		//echo("here");
		$email=$_POST["email"];
		$emailformat = preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/",$_POST["email"]);
		$passwordformat = preg_match ("/\d/",$_POST["password1"]);
		$passwordformat1 = preg_match ("/\W/",$_POST["password1"]);
		$passwordformat2 = preg_match ("/\\s/",$_POST["password1"]);
		$firstname = $_POST["NameFirst"];
		$lastname = $_POST["NameLast"];
		if($_POST['NameFirst'][0]==" " || (strlen($_POST['NameFirst'])-1) == " "){
			$error_message="There is a problem with your form";
		}
		else if($_POST['NameFirst'] == null || $_POST['NameFirst'] ==""){
			$error_message="There is a problem with your form";
		}
		else if($_POST['NameLast'][0]==" " || (strlen($_POST['NameLast'])-1) == " "){
			$error_message="There is a problem with your form";
		}
		else if($_POST['NameLast'] == null || $_POST['NameLast'] ==""){
			$error_message="There is a problem with your form";
		}
		
		else if($emailformat !=1){
			$error_message="There is a problem with your form";
		}
	
	
		else if ($passwordformat2 == 1 ||strlen($_POST['password1']) < 6 ||($passwordformat == 0 &&  $passwordformat1 == 0)) {
			$error_message="There is a problem with your form";	
		}
	
		else if($_POST['password1'] !== $_POST['password2']){
			$error_message="There is a problem with your form";
		}
		else{
			//add saving into data base
			$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
			if(!$db){
				exit("Error in database connection:" .mysqli_error());
				}
			$encrypted_password = md5($_POST['password1']);	
			$sql="INSERT INTO `User`(`NameFirst`, `NameLast`, `Password`, `Type`, `Email`,`ManagerID`) VALUES ('$firstname','$lastname','$encrypted_password','manager','$_POST[email]', $managerID )"; // , $managerID)";
			$result = mysqli_query($db,$sql);
			
			if(mysqli_num_rows($result)<0){
				die('Error: ' . mysqli_error());
			}
			else{
				$added_message= "Employee Added";
			}
	
			mysqli_close($db);
	
			
		}
	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>
<link rel="shortcut icon" href="../pictures/logo.png">
<link rel="icon" href="../pictures/man.png">

<link rel="stylesheet" type="text/css" href="../css/menu.css"> 

<link rel="stylesheet" type="text/css" href="../css/tables.css">

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">
  
<script type = "text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>

<script type="text/javascript" src="../js/menu.js" > </script>

<script type="text/javascript" src="../js/changeMeet.js"> </script>

<link rel="stylesheet" type="text/css" media="all" href="../css/progression.min.css">
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/progression.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css"> 

</head>

<body onload="SelectedMeet();">
<div id="header">
<div id="demo_top_wrapper">
	<div id="demo_top">
		<div class="demo_container">
			<div id="my_logo"><img border="0" src="../pictures/logo.png" alt="logo" width="117" height="70" align="left" ></div>
		</div>
	</div>
	<div id="sticky_navigation_wrapper">
		<div id="sticky_navigation">
			<div class="demo_container">
				<ul>
					<li><a href="http://www.mytrack.ca/Home.php" >HOME</a></li>
					<li><a href="http://www.mytrack.ca/Home/AddEmployee.php" class="selected">ADD EMPLOYEE</a></li>  
					<li><a href="http://www.mytrack.ca/Home/About.php">ABOUT</a></li>
					<li><a href="http://www.mytrack.ca/Home/Prices.php">PRICES</a></li>  
					<li><a href="http://www.mytrack.ca/Home/ContactUs.php" >CONTACT US</a></li> 
					<li><a href="http://www.mytrack.ca/Home/Logout.php">SIGN-OUT</a></li>
				</ul>
			</div>
		</div>
	</div>
</div> 
<p id="noNewLine"> Meet Selected: </p>
<div class="styled-select" onchange="change_categoryMeet(this.value);">
	   	 <form id="selectMeetForm" name="myform" method="post" action="get">
	   	 <input type="hidden" id="MeetID" value="'<?php echo $meetID ?>'">
   	 		<select name="showMeet" id="showMeet" >
   	 		<option value="--" >Select An Option: </option>
   	 		
<?php
			$q = "SELECT * FROM Meet WHERE `ManagerID` = '$managerID'";
			$meetResults = mysqli_query($db,$q);
			
			if(mysqli_num_rows($meetResults) > 0){
				while($row = mysqli_fetch_assoc($meetResults))
				{
					$temp_meetID = $row['MeetID'];
					$temp_meet = $row['Meet'];?>
				<option value="'<?php echo $temp_meet ?>'"><?php echo $temp_meet ?></option>
				
				<?php
				
				}
			} 
?>
			</select>
   	 		</form> 
	</div>

<br>
</div>
<div id="main-wrap">
 	<?php include '../php/SideMenu.php'; ?>
	<div id="content-wrap">
	<div id="w">
    <div id="content">
      <h1>Add Employee Form</h1>
      
      <form id="registerform" method="post" action="http://www.mytrack.ca/Home/AddEmployee.php">
      	<p class="error" style="color:blue;"> <?php echo($added_message) ?></p>
         <div class="formrow">
          <label for="email">First Name</label>
          <input data-progression="" type="text" name="NameFirst" id="NameFirst" class="basetxt" tabindex="1" data-helper="First Name">
          <p class="errmsg">Please Enter First Name</p>
        </div>
        
        <div class="formrow">
          <label for="email">Last Name</label>
          <input data-progression="" type="text" name="NameLast" id="NameLast" class="basetxt" tabindex="2" data-helper="Last Name">
          <p class="errmsg">Please Enter Last Name</p>
        </div>
        
        <div class="formrow">
          <label for="username">Email Address</label>
          <input data-progression="" type="email" name="email" id="email" class="basetxt" tabindex="3" data-helper="Email, Used for Logging in">
          <p class="errmsg">Please Enter a Valid Email</p>
        </div>
        
        <div class="formrow">
          <label for="password1">Password</label>
          <input data-progression="" type="password" name="password1" id="password1" class="basetxt" tabindex="4" data-helper="Contain at Least One Letter and Number, Min 6 Characters">
          <p class="errmsg">Invalid Password</p>
        </div>
        
        <div class="formrow">
          <label for="password2">Password(again)</label>
          <input data-progression="" type="password" name="password2" id="password2" class="basetxt" tabindex="5" data-helper="Please Re-Enter the Password Again.">
          <p class="errmsg">Passwords do not match!</p>
        </div>
        <p class="error" style="color:red;"> <?php echo($error_message) ?></p>
        <input type="submit" id="submitformbtn" class="submitbtn" value="Add">
        <input type="hidden" name="Submited" value=1 >
      </form>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script type="text/javascript">
$(function(){
  $("#registerform").progression({
    tooltipWidth: '200',
    tooltipPosition: 'right',
    tooltipOffset: '0',
    showProgressBar: false,
    showHelper: true,
    tooltipFontSize: '14',
    tooltipFontColor: 'fff',
    progressBarBackground: 'fff',
    progressBarColor: '7ea2de',
    tooltipBackgroundColor: 'a5bce5',
    tooltipPadding: '7',
    tooltipAnimate: true
  }).submit(function(e){
  	var emailval =  document.getElementById("email").value;
 	var pwone =  document.getElementById("password1").value;
 	var pwtwo = document.getElementById("password2").value;
 	var x =pwone.search(/\d/);
	var y =pwone.search(/\W/);
 	var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    var first = document.getElementById("NameFirst").value;
    var last = document.getElementById("NameLast").value;
    
    if(first.length < 1){
    	alert("Please enter a first name");
	    e.preventDefault();
    }
    else if(last.length < 1){
    	alert("Please enter a last name");
	    e.preventDefault();
    }
    else if(!pattern.test(emailval)|| emailval.length < 1) {
    	alert("Please enter a valid Email");
    	//document.getElementById("errEmail").next('.errmsg').slideDown();
    	//alert("here");
    	e.preventDefault();
    }
    else if(pwone.length < 6 ||(x == -1 &&  y == -1) ) {
    	alert("Please enter a valid Password");
    	e.preventDefault();
    }   
    else if(pwtwo.length < 1 || pwone != pwtwo){
    	alert("Please enter a matching Password");
	    e.preventDefault();
    }
  
  });
  
  $('#NameFirst').on('blur', function(){
    var first = $(this).val();
    
    if(first.length < 1) {
      $(this).next('.errmsg').slideDown();
    } else {
      // hide error
      $(this).next('.errmsg').slideUp();
    }
  });
  
    $('#NameLast').on('blur', function(){
    var last = $(this).val();
    
    if(last.length < 1) {
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
   
  $('#password2').on('blur', function(){
    var pwone = $('#password1').val();
    var pwtwo = $(this).val();
    
    if(pwtwo.length < 1 || pwone != pwtwo) {
      $(this).next('.errmsg').slideDown();
    } else if(pwone == pwtwo) {
      $(this).next('.errmsg').slideUp();
    }
  });
});
</script>

	</div>
</div>
<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"></a></p>
</div>
</body>
</html>
<?php
}
?>