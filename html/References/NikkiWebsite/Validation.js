function change(item)
{
	var source=item.currentTarget;
	var likeon = source.src.search("http://www2.cs.uregina.ca/~stonge3n/like.png");
	
	if(likeon < 0)
	{
		source.src = "http://www2.cs.uregina.ca/~stonge3n/like.png";
		return false;
	}
	else
	{
		source.src = "http://www2.cs.uregina.ca/~stonge3n/dislike.png";
		return true;
	}
}

function validateCommentForm()
{
	var comment=document.getElementById("commenttextarea").value;
	var commenterror=document.getElementById("commenterror");
	if (comment==null || comment=="")
		commenterror.innerHTML = "Please fill in your comment";
	else if (comment.length > 1000 )
		commenterror.innerHTML = "Comment must be less that 1000 characters";
	else
		return true;
	
	return false;
}

function validateStatusForm()
{
	var status=document.getElementById("statustextarea").value;
	var statuserror=document.getElementById("statuserror");
	if (status==null || status=="")
		statuserror.innerHTML = "Please fill in your status";
	else if (status.length > 1000 )
		statuserror.innerHTML = "Status must be less that 1000 characters";
	else
		return true;
	
	return false;
}

function validateSignUp()
{

	var firstname=document.getElementById("firstname").value;
	var firstnameerror=document.getElementById("firstnameerror");
	var firstnameformat= firstname.search(/^[A-Za-z -]+$/);
	
	var lastname=document.getElementById("lastname").value;
	var lastnameerror=document.getElementById("lastnameerror");
	var lastnameformat= lastname.search(/^[A-Za-z ,.'-]+$/);

	var email=document.getElementById("email").value;
	var emailerror=document.getElementById("emailerror");
	var emailformat= email.search(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/);
	
	var password=document.getElementById("password").value;
	var passworderror=document.getElementById("passworderror");
	var passwordformat= password.search(/^.*(?=.*[\W\d])(?=.*[a-zA-Z]).*$/);

	var passwordcheck=document.getElementById("passwordcheck").value;
	var passwordcheckerror=document.getElementById("passwordcheckerror");
	
	var birthdateerror=document.getElementById("birthdateerror");
	var month=document.getElementById("month").value;
	var day=document.getElementById("day").value;
	var year=document.getElementById("year").value;
	
	if(firstname==null || firstname=="")
		firstnameerror.innerHTML = "Please fill in your first name";
	else if(firstnameformat != 0)
		firstnameerror.innerHTML = "Your first name is not in the correct form";
	
	else if(lastname==null || lastname=="")
		lastnameerror.innerHTML = "Please fill in your last name";
	else if(lastnameformat != 0)
		lastnameerror.innerHTML = "Your last name is not in the correct form";
	
	else if(month=="February" && (day=="29" || day=="30" || day=="31"))
		birthdateerror.innerHTML = "Febuary does not have that many days";
	else if(month=="April" && day=="31")
		birthdateerror.innerHTML = "April does not have that many days";
	else if(month=="June" && day=="31")
		birthdateerror.innerHTML = "June does not have that many days";
	else if(month=="September" && day=="31")
		birthdateerror.innerHTML = "September does not have that many days";
	else if (month=="November" && day=="31")
		birthdateerror.innerHTML = "November does not have that many days";
	else if(year==null || year =="")
		birthdateerror.innerHTML = "Please fill in the year";
	else if(year<1900 || year>1999)
		birthdateerror.innerHTML = "Your must be 13 to sign up for this site. The year is not valid";
	
	else if (email==null || email=="")
  		emailerror.innerHTML = "Please fill in your email";
	else if (emailformat != 0)
		emailerror.innerHTML = "Your email is not in the correct form";	
	
	else if (password==null || password=="")
  		passworderror.innerHTML = "Please fill in your password";
	else if (passwordformat != 0)
		passworderror.innerHTML = "Password does not have a non-letter character or has spaces in it";
	else if (password.length <= 8)
		passworderror.innerHTML = "Password is not 8 characters long"
	else if(password != passwordcheck)
		passwordcheckerror.innerHTML = "Passwords are not the same";
	else
		return true;
	
	return false;
}

function validateLogin()
{
	var email=document.getElementById("email").value;
	var emailerror=document.getElementById("emailerror");
	var emailformat= email.search(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/);
	var password=document.getElementById("password").value;
	var passworderror=document.getElementById("passworderror");
	var passwordformat= password.search(/^\S+$/);
	
	if (email==null || email=="")
		emailerror.innerHTML = "Please fill in your email";
	else if (emailformat != 0)
		emailerror.innerHTML = "Email address is not in the correct form";
		
	else if (password==null || password=="")
  		passworderror.innerHTML = "Please fill in your password";
	else if (password.length < 8)
		passworderror.innerHTML = "Password is not correct length. Must be greater than 8 characters";
	else if(passwordformat != 0)
		passworderror.innerHTML = "Password has spaces in it and should not"
	else
		return true;
	
	return false;
}