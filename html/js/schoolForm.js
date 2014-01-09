	
	
	
	//$('#addSchoolForm').trigger("reset");
	
	//$(document).ready(function()  {
	$(function() {
	$("#dialog").dialog({
	autoOpen: false,
	maxWidth:600,
	maxHeight: 350,
	width: 500,
	height: 300,
	close: function(){ 
	$('#addSchoolForm').trigger("reset");
	$.ajax({
          type: "GET",
          url: "/Ajax/ajax_reset_id.php",
          success: function(html){
               $("#responce_event").html(html);
          }
    });
	}
	
	});
	$("#addSchool").on("click", function() 
	{
	
	$("#dialog").dialog("open");
	});
	
	
	
	$("#addSchoolForm").submit(function(e)
	{ 
	e.preventDefault();
	var postData = jQuery(this).serialize();
	$("#dialog").dialog("close")
	$.ajax({
	type: "POST",
	url: "Add/AddSchools.php",
	dataType: 'json',
	data: postData,
	success: function(data)
	{
	//alert("success");
	$('#school').load('Tables/schoolTable.php').fadeIn("slow");
	},
	
	error: function(jqXHR, exception) {
		if (jqXHR.status === 0) {
		alert('Not connect.\n Verify Network.');
		} else if (jqXHR.status == 404) {
		alert('Requested page not found. [404]');
		} else if (jqXHR.status == 500) {
		alert('Internal Server Error [500].');
		} else if (exception === 'parsererror') {
		alert('Requested JSON parse failed.');
		} else if (exception === 'timeout') {
		alert('Time out error.');
		} else if (exception === 'abort') {
		alert('Ajax request aborted.');
		} else {
		alert('Uncaught Error.\n' + jqXHR.responseText);
		}
		
		}

	
	
	});   
	});
	
	
	$('[id^="editSchool"]').submit(function(e)
	{ 
	e.preventDefault();
	var editData = jQuery(this).serialize();
	$.ajax({
	type: "POST",
	url: "/Get/GetSchoolID.php",
	dataType: 'json',
	data: editData,
	success: function(data){
	
	
	var form = document.forms['addSchoolForm'];
	   form.id.value=data.id;
       form.sname.value=data.schoolname;
       form.abbrev.value=data.schoolabbrev;
       form.school_id.value = data.id;
	

		 						
	}
	
	
	
	});
	
	$("#dialog").dialog("open");
	
	});
	})

    



