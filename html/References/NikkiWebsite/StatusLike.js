function updateStatusLike(event)
{
	xhr = new XMLHttpRequest();
	
	var likeon = event.currentTarget.src.search("http://www2.cs.uregina.ca/~stonge3n/like.png");
	
	if(likeon < 0)
		enabled = false;
	else
		enabled = true;
	
	// extract the id from "like##"
	var status_id = event.currentTarget.id.substr(4);
	xhr.onreadystatechange = function ()
	{
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			var result = xhr.responseText;
			document.getElementById(status_id).innerHTML = result;
		}
	}
//	alert("StatusLiketoDatabase.php?status_id=" + status_id + "&enabled=" + enabled);
	xhr.open("GET", "StatusLiketoDatabase.php?status_id=" + status_id + "&enabled=" + enabled, true);
	xhr.send(null);
}