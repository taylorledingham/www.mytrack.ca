var globalTimer;

function startTimer()
{
	globalTimer = setInterval(update, 2000);
}

function update()
{
	checkLikes();
	checkStatus();
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
	xhr.onreadystatechange = function ()
	{
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			var result = xhr.responseText;
			var responseObj = JSON.parse(result);
			for(var i = 0; i < responseObj.updateLikesStatus.length; i++)
			{
				var status_id = responseObj.updateLikesStatus[i].status_id;
				var total_likes = responseObj.updateLikesStatus[i].likenum;
				var total_comments = responseObj.updateLikesStatus[i].commentnum;
				if(document.getElementById(status_id))
				{
					document.getElementById(status_id).innerHTML = total_likes;				
					document.getElementById("button" + status_id).value = total_comments + " Comment(s)";
				}
			}		
		}
	}
			
	xhr.open("GET", "UpdateLikeHome.php", true);
	xhr.send(null);	
}

function checkStatus(event)
{
	//alert("checkingStatus");
	xhr2 = new XMLHttpRequest();
	var post = document.getElementById("statuses").getElementsByTagName("div"); // get the 1st div in the surrounding div tag
	
	var post_id = post[0].id;
	var status_post_id = post_id.substr(5);
		
	xhr2.onreadystatechange = function ()
	{
		if(xhr2.readyState == 4 && xhr2.status == 200) 
		{
			var result = JSON.parse(xhr2.responseText);	
			var length = result.UpdateStatusHome.length;
			for(var i = length - 1; i >= 0; i--)
			{
				var status_id = result.UpdateStatusHome[i].status_id;
				var newstatus = result.UpdateStatusHome[i].statusdetail;
				
				var newDiv = document.createElement("div");							
				newDiv.id = "divId" + status_id;
				newDiv.innerHTML = newstatus;
								
				var parent = document.getElementById("statuses");	
				parent.insertBefore(newDiv, post[0]);
				
				var like_idDOM = document.getElementById("like" + status_id);	 			
	 		 	like_idDOM.addEventListener("click", change, false);
	 		 	like_idDOM.addEventListener("click", updateStatusLike, false);		
			}
		}
	}
				
	xhr2.open("GET", "UpdateStatusHome.php?post_id=" + status_post_id, true);
	xhr2.send(null);
}

		

		

