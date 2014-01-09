		
		//$('#addCommentForm').trigger("reset");
		
		//$(document).ready(function()  {
		$(function() {
		$("#dialog").dialog({
		autoOpen:false,
		maxWidth:600,
		maxHeight: 500,
		width: 480,
		height: 370,
		close: function(){ 
		$('#addCommentForm').trigger("reset");
		}
		
		});
		$("#addComment").on("click", function() 
		{
			$("#dialog").dialog("open");
		});

		$("#addCommentForm").submit(function(e)
		{ 
		e.preventDefault();
		var postData = jQuery(this).serialize();
		$("#dialog").dialog("close")
		$.ajax({
		type: "POST",
		url: "AddAthletes.php",
		dataType: 'json',
		data: postData,
		success: function(data){
		 alert(data); 
		 //alert("success");
		}
		});   
		});	
		
		
		})
		