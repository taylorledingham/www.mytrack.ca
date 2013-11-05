$('#addAgeGroupForm').trigger("reset");

//$(document).ready(function()  {
$(function() {
	$("#dialog").dialog({
				autoOpen: false,
				 maxWidth:600,
				 maxHeight: 400,
				 width: 500,
	            height: 360,
		});
$("#addAgeGroup").on("click", function() 
{

	$("#dialog").dialog("open");
			});



$("addAgeGroupForm").submit(function(e)
	{ 
	e.preventDefault();
	$("#dialog").dialog("close")
	var postData = jQuery(this).serialize();
	$.ajax({
				type: "POST",
				url: "AddAgeGroups.php",
     			 data: postData,
     			 success: function(data){
	     			 alert(data); }


         });   
			});
		})