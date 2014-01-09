$(function() {
		$("#dialog").dialog({
		autoOpen:false,
		maxWidth:600,
		maxHeight: 500,
		width: 500,
		height: 450,
		close: function(){ 
		$('#addResultForm').trigger("reset");

		$.ajax({
            	type: "GET",
            	url: "/Ajax/ajax_reset_event.php",
            	success: function(html){
                	$("#responce_event").html(html);
            }
        });

		}
		
		});
		$("#addResult").on("click", function() 
		{
		
		$("#dialog").dialog("open");
		});
		
		
		
		$("#addResultForm").submit(function(e)
		{ 
		e.preventDefault();
		var postData = jQuery(this).serialize();
		$("#dialog").dialog("close")
		$.ajax({
		type: "POST",
		url: "AddEnrolment.php",
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
		
		
		$('[id^="editResult"]').submit(function(e)
		{ 
		e.preventDefault();
		var editData = jQuery(this).serialize();
		$.ajax({
		type: "POST",
		url: "/Get/GetResults.php",
		dataType: 'json',
		data: editData,
		success: function(data){
		
		var form = document.forms['addResultForm'];
		form.id.value=data.id;
		form.type.value=data.type;
		if(data.type=='Track')
			alert("is track");
		else
			alert("is Field");
		

		
		}
		});
		
		
			
		

		$("#dialog").dialog("open");
		
		});
		})
		
function change_category(id)
{
		//var temp_id = id;
		//alert(temp_id);
        $.ajax({
            type: "GET",
            url: "/Ajax/ajax_get_event.php?age_group_name="+id,
            data:   id,
            success: function(html){
                $("#responce_event").html(html);
            }
        });
		var school = document.getElementById("school").value;
		//alert (school);
        $.ajax({
            type: "GET",
            url: "/Ajax/ajax_get_athlete.php?age_group_name="+id+"&school_name="+school,
            data:   id,
            success: function(html){
                $("#responce_event2").html(html);
            }
        });
}
function change_category2(id)
{
		
        $.ajax({
            type: "GET",
            url: "/Ajax/ajax_get_age_group.php",
            success: function(html){
                $("#responce_event0").html(html);
            }
        });
        $.ajax({
            	type: "GET",
            	url: "/Ajax/ajax_reset_event.php",
            	success: function(html){
                	$("#responce_event").html(html);
            }
        });
        $.ajax({
            type: "GET",
            url: "/Ajax/ajax_reset_athlete.php",
            success: function(html){
                $("#responce_event2").html(html);
            }
        });
}
