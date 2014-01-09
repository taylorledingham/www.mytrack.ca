//$('#addMeetForm').trigger("reset");
		
		//$(document).ready(function()  {
		$(function() {
		$("#dialog").dialog({
		autoOpen:false,
		maxWidth:600,
		maxHeight: 500,
		width: 500,
		height: 240,
		close: function(){ 
		$('#addMeetForm').trigger("reset");
				$.ajax({
            	type: "GET",
            	url: "/Ajax/ajax_reset_id.php",
            	success: function(html){
                	$("#responce_event").html(html);
            }
        });
		}
		
		});
		$("#addMeet").on("click", function() 
		{
		
		$("#dialog").dialog("open");
		});
		
		
		
		$("#addMeetForm").submit(function(e)
		{ 
		e.preventDefault();
		var postData = jQuery(this).serialize();
		$("#dialog").dialog("close")
		$.ajax({
		type: "POST",
		url: "AddMeet.php",
		dataType: 'json',
		data: postData,
		success: function(data){
		 alert(data); 
		 //alert("success");
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
		
		
		$('[id^="editMeet"]').submit(function(e)
		{ 
		e.preventDefault();
		var editData = jQuery(this).serialize();
		$.ajax({
		type: "POST",
		url: "/Get/GetMeet.php",
		dataType: 'json',
		data: editData,
		success: function(data){
		
		var form = document.forms['addMeetForm'];
		form.id.value=data.id;
		form.MeetName.value=data.MeetName;
						
		}
		
		
		});
		
		$("#dialog").dialog("open");
		
		});
		})
		
/*
		$(".addproduct").click(function(){
		
		 var athleteID = $(this).attr('class')
		
		
		$("#dialog").dialog("open");
		
		
		});
		
		
*/



