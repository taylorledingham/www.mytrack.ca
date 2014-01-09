$(function() {
		$("#dialog").dialog({
		autoOpen:false,
		maxWidth:600,
		maxHeight: 500,
		width: 500,
		height: 450,
		close: function(){ 
		$('#addEnrolmentForm').trigger("reset");

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
        $.ajax({
            type: "GET",
            url: "/Ajax/ajax_reset_age_group.php",
            success: function(html){
                $("#responce_event0").html(html);
            }
        });
		}
		
		});
		$("#addEnrolment").on("click", function() 
		{
		
		$("#dialog").dialog("open");
		});
		
		
		
		$("#addEnrolmentForm").submit(function(e)
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
		
		
		$('[id^="editEnrolment"]').submit(function(e)
		{ 
		e.preventDefault();
		var editData = jQuery(this).serialize();
		$.ajax({
		type: "POST",
		url: "/Get/GetEnrolment.php",
		dataType: 'json',
		data: editData,
		success: function(data){
		
		var form = document.forms['addEnrolmentForm'];
		form.id.value=data.id;
		form.school.value=data.school;
		alert(data.school);
		change_category2(data.school);
		$.ajax({
			type: "POST",
			url: "/Get/GetEnrolment.php",
			dataType: 'json',
			data: editData,
			success: function(data){
				form.agegrp.value=data.agegrp;
				alert(data.agegrp);
				change_category(data.agegrp);
				$.ajax({
					type: "POST",
					url: "/Get/GetEnrolment.php",
					dataType: 'json',
					data: editData,
					success: function(data){
						form.event.value=data.event;
						alert(data.event);
						form.athlete.value=data.athlete;
						alert(data.athlete);	
						//alert(form.athlete.value);
		}});		
		}});
		
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
