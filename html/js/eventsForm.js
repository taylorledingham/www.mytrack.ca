
		$(function() {
		$("#dialog").dialog({
		autoOpen:false,
		maxWidth:600,
		maxHeight: 500,
		width: 500,
		height: 400,
		close: function(){ 
		$('#addEventForm').trigger("reset");
			$.ajax({
            	type: "GET",
            	url: "/Ajax/ajax_reset_id.php",
            	success: function(html){
                	$("#responce_event").html(html);
            }
        });
		}
		
		});
		$("#addEvent").on("click", function() 
		{
		
		$("#dialog").dialog("open");
		});
		
		
		
		$("#addEventForm").submit(function(e)
		{ 
		e.preventDefault();
		var postData = jQuery(this).serialize();
		$("#dialog").dialog("close")
		$.ajax({
		type: "POST",
		url: "/Add/AddEvents.php",
		dataType: 'json',
		data: postData,
		success: function(data){
		 //alert(data); 
		 //alert("success");
		 $('#event').load('Tables/eventTable.php').fadeIn("slow");
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
		
		
		$('[id^="editEvent"]').submit(function(e)
		{ 
		e.preventDefault();
		var editData = jQuery(this).serialize();
		$.ajax({
		type: "POST",
		url: "/Get/GetEvent.php",
		dataType: 'json',
		data: editData,
		success: function(data){
		
		var form = document.forms['addEventForm'];
		form.id.value=data.id;
		form.event.value=data.event;
		form.agegroup.value=data.agegroup;
		if(form.eventType1.value==data.eventType)
			$("#eventType1").prop("checked", true);
		else
			$("#eventType2").prop("checked", true);
							
		}
		
		
		});
		
		$("#dialog").dialog("open");
		
		});
		})
		
