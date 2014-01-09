function change_categoryMeet(id)
{
		//alert("changing meet");
		var meet = document.getElementById("showMeet").value;
        $.ajax({
            type: "GET",
            url: "/Ajax/ajax_setMeet.php?meet_name="+meet,
            success: function(html){
            	//alert(meet);
                //$("#responseToChange").html(html);
            }
        });
        

}

function SelectedMeet()
{
//alert("onload");
var meet = document.getElementById("MeetID").value;
document.getElementById('showMeet').value=meet;
//alert(meet);		 

}
