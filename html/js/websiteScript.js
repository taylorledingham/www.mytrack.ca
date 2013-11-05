
function validateForm()
{
  
    var email = document.getElementById("email").value;
    var pwone = document.getElementById("password1").value;
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
   
    if(!pattern.test(email)) {
    //something wrong
    }
    else if(email==null || email=="")
    //something wrong
    }    
    else if(pwone.length < 6 ||(x == -1 &&  y == -1) ) {
      //something wrong
    )
	else
		return true;
	
	return false;
	
	
	
}
function validateWeb()
{
	// webpage
	var email = document.getElementById("email_id").value
	var wemail=document.getElementById("wEmail");
	var password = document.getElementById("Passwd").value
	var wpass=document.getElementById("wPasswd");
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	var error1=false;

	wemail.innerHTML = "";
	wpass.innerHTML = "";	
	
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
	  {
		error1=true;
		wemail.innerHTML = "Please Enter a Valid Email";
		document.getElementById("email_id").value="";
	  }
	
	if (password.indexOf(" ") > -1) {
		wpass.innerHTML = ("Please Enter a valid Password");
		error1=true;
		document.getElementById("Passwd").value = "";
	}
	

	if(password.length < 6){
		error1=true;
		wpass.innerHTML = "Please Enter a valid Password";
		document.getElementById("Passwd").value="";
	}
	
	if(error1)
	{
		return false;
	}
}