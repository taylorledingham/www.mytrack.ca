	
$('#addAthleteForm').trigger("reset");

//$(document).ready(function()  {
$(function() {
	$("#dialog").dialog({
				autoOpen: false,
				 maxWidth:600,
				 maxHeight: 500,
				 width: 500,
	            height: 460,
		});
$("#addAthlete").on("click", function() 
{

	$("#dialog").dialog("open");
			});



$("#addAthleteForm").submit(function(e)
	{ 
	e.preventDefault();
	$("#dialog").dialog("close")
	var postData = jQuery(this).serialize();
	$.ajax({
				type: "POST",
				url: "AddAthletes.php",
     			 data: postData,
     			 success: function(data){
	     			 alert(data); }


         });   
			});
		})
