var globalTimer;

function startTimer()
{
	globalTimer = setInterval(update, 2000);
}

function update()
{
	checkLikes();
	checkComments();
}

function timerFunction(event)
{
	var button = document.getElementById("ajax");
	if(button.value == "ENABLED")
	{
		clearInterval(globalTimer);
		button.value = "DISABLED";
	}
	else
	{
		startTimer();
		button.value = "ENABLED";		
	}
}

function checkLikes(event)
{
	//alert("checkingLikes");
	xhr = new XMLHttpRequest();
	
	var topStatus = document.getElementById("comments").getElementsByTagName("div"); // get the 1st div in the surrounding div tag
	var topStatus_id = topStatus[0].id;
	topStatus_id = topStatus_id.substr(6);
	
	xhr.onreadystatechange = function ()
	{
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			var result = xhr.responseText;
			var responseObj = JSON.parse(result);
			for(var i=0; i < responseObj.updateLikesStatusDetail.length; i++)
			{
				var comment_id = responseObj.updateLikesStatusDetail[i].comment_id;
				var total_likes = responseObj.updateLikesStatusDetail[i].likenum;
				if(document.getElementById(comment_id))
					document.getElementById(comment_id).innerHTML = total_likes;
			}		
		}
	}
			
	xhr.open("GET", "UpdateLikeStatusDetail.php?topStatus_id=" + topStatus_id, true);
	xhr.send(null);	
}

function checkComments(event)
{	
	//alert("checkingComments");
	xhr2 = new XMLHttpRequest();
	
	var post = document.getElementById("comments").getElementsByTagName("div"); // get the 1st div in the surrounding div tag
	
	var status_id = post[0].id.substr(6);
	var newcomment_id = post[1].id.substr(5); // get the second post, the 1st is the status being commented on

	xhr2.onreadystatechange = function ()
	{
		if(xhr2.readyState == 4 && xhr2.status == 200) 
		{
			var result = JSON.parse(xhr2.responseText);	
			var length = result.UpdateCommentsStatusDetail.length;
			
			for(var i = length - 1; i >= 0; i--)
			{
				var comment_id = result.UpdateCommentsStatusDetail[i].comment_id;
				var commentdetail = result.UpdateCommentsStatusDetail[i].commentdetail;
								
				var newDiv = document.createElement("div");							
				newDiv.id = "divId" + comment_id;
				newDiv.innerHTML = commentdetail;
								
				var parent = document.getElementById("comments");	
				parent.insertBefore(newDiv, post[1]);
				
				var like_idDOM = document.getElementById("like" + comment_id);
	 		 	like_idDOM.addEventListener("click", change, false);
	 		 	like_idDOM.addEventListener("click", updateCommentLike, false);		
			}
		}
	}
					
	xhr2.open("GET", "UpdateCommentsStatusDetail.php?newcomment_id=" + newcomment_id + "&status_id=" + status_id, true);
	xhr2.send(null);
}

		

		

