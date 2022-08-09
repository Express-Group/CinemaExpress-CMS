<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/additional-methods.min.js"></script>
<style>
label.error {
	color:#F00;
	border:none !important;
}
.AskPrabhuForm button{background-color: #019c94;border-color:#019c94;}
.AskPrabhuForm button:hover,.AskPrabhuForm button:active,.AskPrabhuForm button:focus{background-color: #019c94;border-color:#019c94;outline:none;}
.padding-right-10{padding-right:10px;}
</style>
<script>
$(document).ready(function()
	{
	$('sup').css({'color':'#ff0000','top':'0'});
	$('.group-margin').css({'margin-top':'23px'});
	
	
		$("#AskPrabhuForm").validate({
		rules: 
		{			
			txtQuestion: 
			{ 
				required: true,
				//alphanumeric : true,
				//maxlength:255,
			},
			txtEmail: 
			{ 
				required: true,
				number: true,
				//email:true,
				//alphanumeric : true,
				maxlength:50,
			},
			txtName: 
			{ 
				required: true,
				//alphanumeric : true,
				maxlength:50,
			},
			captcha:
			{
				required: true,
			}
			
		},
		messages: 
		{
			txtQuestion:
			{
				required: "Please enter your question",
				//alphanumeric:"Please enter valid characters",
				//maxlength:"Please do not enter more than 255 characters."
			},
			txtEmail:
			{
				required: "Please enter your Mobile number",
				number:"Please enter valid mobile number",
				maxlength:"Please do not enter more than 50 characters."
			},
			txtName:
			{
				required: "Please enter your name",
				//alphanumeric:"Please enter valid characters",
				maxlength:"Please do not enter more than 50 characters."
			},
			captcha:
			{
				required: "Please enter captcha",
			}
			
		},
		errorPlacement: function (error, element) 
		{
        	if(element.attr("name") == 'captcha')
         	{   
				error.insertAfter($("#capcha_error"));
		 	}
		 	else
		 	{
			 	//alert(element.attr("name"));
			 	error.insertAfter($("#"+element.attr("name")));
		 	}
		},

	});
	
	$("#btnPost").click(function() 
		{
			if($("#AskPrabhuForm").valid())
			{
				var capicha=$('#captcha').val();
				
				$.ajax({
						type: "POST",
						data: {"capichatext":capicha},
						url:"<?php echo base_url(); ?>user/commonwidget/check_captcha",
						success: function(result)
						{
							if(result=="incorrect")
							{
								$("#captcha").val('');
								//alert('Please enter correct captcha');
								
								$("#capcha_error").text("Please enter correct captcha");
							}
							else
							{
								post_questions();
							}
							//alert(result);
							
						}
						});
	
			}
				
		});
	
	$("#btnrefresh").on("click", function()
	{
		
		var img = document.getElementById('captcha_code'),
        timestamp = new Date().getTime();
    	img.src = '<?php echo base_url();?>user/commonwidget/captcha?timestamp=' + new Date().getTime();
		$("#captcha").val('');
  	});	
 });

</script>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="AskPrabhuPost">
			<h3 class="AskPrabhuTitle title">POST YOUR QUESTION</h3>
			<div class="AskPrabhuForm">
	
			<!--<p style="color:red">Note: Only Selected Questions will be answered.</p>-->
			<form method="post" name="AskPrabhuForm" id="AskPrabhuForm"  enctype="multipart/form-data" action="<?php echo base_url(); ?>user/commonwidget/add_askprabhuquestion">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 padding-right-10">
				<div class="form-group">
					<label>Name</label><sup>*</sup>
					<input type="text" id="txtName" name="txtName" class="form-control">		
				</div>
				<div class="form-group group-margin">
					<label>Mobile Number</label><sup>*</sup>
					<input type="text" id="txtEmail" name="txtEmail" class="form-control">	
				</div>
			</div>
			
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="form-group" style="display:none;">
					<label>Place</label>
					<input type="text" id="txtPlace" name="txtPlace" class="form-control">
				</div>
				<div class="form-group">
					<label>Post Your question</label><sup>*</sup>
					<textarea id="txtQuestion" name="txtQuestion" class="form-control" rows="5"></textarea>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="form-group">
					<img id="captcha_code" class="CaptchaImg" src="<?php echo base_url();?>user/commonwidget/captcha" alt="" style="width:30%;" /> <span id="captcha-info" class="info">
					<input type="text" name="captcha" id="captcha" placeholder="Enter the text" class="CaptchaInputBox">
					<a href="javascript:void(0);"name="submit" id="btnrefresh" class="captcha-refresh" style="background-color:transparent;font-size:19px;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
					<p id="capcha_error" style="color:#F00" class="text-left"></p>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="form-group">
					<button id="btnPost" name="btnPost" type="button" class="btn btn-primary">Post</button>
				</div>
			</div>
		</div>
			</form>
			</div>
		</div>
	</div>
</div>
<script>
		function post_questions()
		{
			var question=$('#txtQuestion').val();
			var email=$('#txtEmail').val();
			var place=$('#txtPlace').val();
			var name=$('#txtName').val();
			$.ajax({
			type: "POST",
			data: {"question":question,"mailid":email,"place":place,"username":name},
			url:"<?php echo base_url(); ?>user/commonwidget/add_askprabhuquestion",
			success: function(result)
			{
				//console.log(result);
				if(result=="success")
				{
					alert('Your question posted successfully');	
					$('#txtQuestion').val('');
					$('#txtEmail').val('');
					$('#txtPlace').val('');
					$('#txtName').val('');
					$('#captcha').val('');
					var img = document.getElementById('captcha_code'),
					timestamp = new Date().getTime();
					img.src = '<?php echo base_url();?>user/commonwidget/captcha?timestamp=' + new Date().getTime();
				}
				else
				{
					alert('Your question posted failed');	
				}
				//alert(result);
				
			}
		});
		}
</script>