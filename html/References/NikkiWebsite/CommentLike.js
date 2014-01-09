function updateCommentLike(event)
{
	xhr = new XMLHttpRequest();

	var likeon = event.currentTarget.src.search("http://www2.cs.uregina.ca/~stonge3n/like.png");

	if(likeon < 0)
		enabled = false;
	else
		enabled = true;
	
	// extract the id from "like##"
	var comment_id = event.currentTarget.id.substr(4);
	xhr.onreadystatechange = function ()
	{
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			var result = xhr.responseText;
			document.getElementById(comment_id).innerHTML = result;			
		}
	}
//	alert("CommentLiketoDatabase.php?comment_id=" + comment_id + "&enabled=" + enabled);		
	xhr.open("GET", "CommentLiketoDatabase.php?comment_id=" + comment_id + "&enabled=" + enabled, true);
	xhr.send(null);
}