		//$('#addAgeGroupForm').trigger("reset");
		
		//$(document).ready(function()  {
		$(function() {
		$("#dialog").dialog({
		autoOpen:false,
		maxWidth:600,
		maxHeight: 500,
		width: 500,
		height: 350,
		close: function(){ 
		$('#addAgeGroupForm').trigger("reset");
			$.ajax({
            	type: "GET",
            	url: "/Ajax/ajax_reset_id.php",
            	success: function(html){
                	$("#responce_event").html(html);
            }
        });
		}
		
		});
		$("#addAgeGroup").on("click", function() 
		{
		
		$("#dialog").dialog("open");
		});
		
		
		
		$("#addAgeGroupForm").submit(function(e)
		{ 
		e.preventDefault();
		var postData = jQuery(this).serialize();
		$("#dialog").dialog("close")
		$.ajax({
		type: "POST",
		url: "/Add/AddAgeGroups.php",
		dataType: 'json',
		data: postData,
		success: function(data){
		 //alert(data); 
		 //alert("success");
		 $('#ageGroups').load('Tables/agegroupTable.php').fadeIn("slow");
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
		
		
		$('[id^="editAgeGroup"]').submit(function(e)
		{ 
		e.preventDefault();
		var editData = jQuery(this).serialize();
		$.ajax({
		type: "POST",
		url: "/Get/GetAgeGroup.php",
		dataType: 'json',
		data: editData,
		success: function(data){
		
		var form = document.forms['addAgeGroupForm'];
		form.id.value=data.id;
		form.agegroup.value=data.agegroup;
		form.abbrev.value=data.abbrev;
		form.sort.value=data.sort;
		
						
		}
		
		
		});
		
		$("#dialog").dialog("open");
		
		});
		})
		
