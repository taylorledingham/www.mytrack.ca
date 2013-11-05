

	
$('#addSchoolForm').trigger("reset");

//$(document).ready(function()  {
$(function() {
	$("#dialog").dialog({
				autoOpen: false,
				 maxWidth:600,
				 maxHeight: 350,
				 width: 500,
	            height: 300,
		});
$("#addSchool").on("click", function() 
{

	$("#dialog").dialog("open");
			});



$("#addSchoolForm").submit(function(e)
	{ 
	e.preventDefault();
	$("#dialog").dialog("close")
	var postData = jQuery(this).serialize();
	$.ajax({
				type: "POST",
				url: "AddSchools.php",
     			 data: postData,
     			 success: function(data){
	     			 alert(data); }


         });   
			});
		

$("#editSchool").submit(function(e)
	{ 
	e.preventDefault();
	var editData = jQuery(this).serialize();
	$.ajax({
				type: "POST",
				url: "GetSchoolID.php",
     			 data: editData,
     			// dataType: 'json',
     			 success: function(data){
     			 
     			 var schoolID = data; 
	     			 alert(data); 
	     			 
			     	//document.addSchoolForm[sname].value = data[name];
			     	//document.addSchoolForm[abbrev].value = data[abbrev];
			     			 					
	     			 
	     			 }


         });   
			});
	})





