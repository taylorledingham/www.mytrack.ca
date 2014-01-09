var globalTimer;

function startTimer()
{
	globalTimer = setInterval(update, 2000);  //2 second updating time
}

function update()
{
//	checkLikes();
	if(loading == "detail")
		checkStatusDetail();
	else
		checkStatus();
}
/*
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
*/

function checkStatusDetail(event)
{
	alert("checkingStatusDetail");
	if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr2 = new XMLHttpRequest();
	else // code for IE6, IE5
		xhr2 = new ActiveXObject("Microsoft.XMLHTTP");
	
	var post = document.getElementById("comments").getElementsByTagName("div"); // get the 1st div in the surrounding div tag
	
	var statusID = post[0].id.substr(6);
	var newcommentID = post[1].id.substr(5); // get the second post, the 1st is the status being commented on
		
	xhr2.onreadystatechange = function ()
	{
		if(xhr2.readyState == 4 && xhr2.status == 200) 
		{
			var result = JSON.parse(xhr2.responseText);	
			var length = result.UpdateStatusDetail.length;

			for(var i = length - 1; i >= 0; i--)
			{
				var commentID = result.UpdateStatusDetail[i].CommentID;
				var commentDetail = result.UpdateStatusDetail[i].CommentDetail;
				
				var newDiv = document.createElement("div");							
				newDiv.id = "divId" + statusID;
				newDiv.innerHTML = commentDetail;
								
				var parent = document.getElementById("comments");	
				parent.insertBefore(newDiv, post[1]);
				
//				var like_idDOM = document.getElementById("like" + comment_id);
//	 		 	like_idDOM.addEventListener("click", change, false);
//	 		 	like_idDOM.addEventListener("click", updateCommentLike, false);
			}
		}
	}
			
	xhr2.open("GET", "http://www.mytrack.ca/Updating/DatabaseQueries/UpdateStatusDetail.php??newcomment_id=" + newcommentID + "&status_id=" + statusID, true);
	xhr2.send(null);
}

function checkStatus(event)
{
//	alert("checkingStatus");
	if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr3 = new XMLHttpRequest();
	else // code for IE6, IE5
		xhr3 = new ActiveXObject("Microsoft.XMLHTTP");
	
	var post = document.getElementById("statuses").getElementsByTagName("div"); // get the 1st div in the surrounding div tag
	var postID = post[0].id;
	var status_postID = postID.substr(5);  //get the status ID number
		
	xhr3.onreadystatechange = function ()
	{
		if(xhr3.readyState == 4 && xhr3.status == 200) 
		{
			var result = JSON.parse(xhr3.responseText);	
			var length = result.UpdateStatus.length;

			for(var i = length - 1; i >= 0; i--)
			{
				var statusID = result.UpdateStatus[i].StatusID;
				var statusDetail = result.UpdateStatus[i].StatusDetail;
				
				var newDiv = document.createElement("div");							
				newDiv.id = "divId" + statusID;
				newDiv.innerHTML = statusDetail;
								
				var parent = document.getElementById("statuses");	
				parent.insertBefore(newDiv, post[0]);
				
//				var like_idDOM = document.getElementById("like" + statusID);	 			
//	 		 	like_idDOM.addEventListener("click", change, false);
//	 		 	like_idDOM.addEventListener("click", updateStatusLike, false);
			}
		}
	}
			
	xhr3.open("GET", "http://www.mytrack.ca/Updating/DatabaseQueries/UpdateStatus.php?postID=" + status_postID, true);
	xhr3.send(null);
}
