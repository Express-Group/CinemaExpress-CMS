<link href="<?php echo image_url; ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<link href="<?php echo image_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo image_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style>
sup{color:red;}
#example img{width: 100px;height: 100px;object-fit: cover;border-radius: 5px;}
.pager strong , .pager a{border-radius: 5px;padding: 6px 12px;background: #3c8dbc;color: #fff;}
.pager strong{background:#205878;}
.modal-dialog{top:7%;}
.form-group, .article_content1 input{width: 100% !important;}
.form-control{border: 1px solid #ccc !important;}
#cke_answer, #cke_e_answer{width: 100% !important;}
#QandA_button{width: auto; color: white !important;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> > <a href="#">Star Manager</a> > <a href="#"><?php echo $title; ?></a></div>
				<h2><?php echo $title; ?></h2>
			</div>
			<p class="FloatRight SaveBackTop"><button onclick="window.close();" class="btn-primary btn"><i class="fa fa-eye"></i> Close</button></p>
			<p class="FloatRight SaveBackTop"><button onclick="window.location.href='><?php echo base_url(folder_name);?>/star_manager'" class="btn-primary btn"><i class="fa fa-reply"></i> Go Back</button></p>
			<?php if(defined("USERACCESS_ADD".$Menu_id) && constant("USERACCESS_ADD".$Menu_id) == 1){ ?>
				<p class="FloatRight SaveBackTop"><button id="ques_and_ans" class="btn-primary btn"><i class="fa fa-plus-circle"></i> Add</button></p>
			<?php } ?>
		</div>
		<div class="Overflow DropDownWrapper">
			<table id="example" style="margin-top: 1rem;" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>QID</th>
						<th>QUESTION</th>
						<th>ANSWER</th>
                        <th>MODIFIED BY</th>
                        <th>MODIFIED ON</th>
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($records as $record){
						echo '<tr>';
						echo '<td>'.$record['qid'].'</td>';
						echo '<td>'.$record['question'].'</td>';
						echo '<td>'.$record['answer'].'</td>';
						echo '<td>'.$controller->getUsername($record['created_by']).'</td>';
						echo '<td>'.date( 'jS F Y H:i:s A', strtotime($record['modified_on'])).'</td>';
						echo '<td>';
						if($record['status']==1){
							echo '<span class="label label-success">ACTIVE</span>';
						}else{
							echo '<span class="label label-danger">INACTIVE</span>';
						}
						echo '</td>';
						echo '<td>';
						echo '<button class="btn btn-primary get_attributes" data-id='.$record['qid'].'><i class="fa fa-pencil" ></i></button>';
						echo '</td>';
						echo '</tr>';
						
					}
					?>
				</tbody>
			</table>
			<div class="pager">
				<?php echo $links; ?>
			</div>
		</div>
	</div>
</div>
<!-- Language Modal -->
<div id="QandA" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">ADD QUESTION AND ANSWER</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" id="QandA_form">
					<input type="hidden" name="star_id" id="star_id" value="<?php echo $this->uri->segment(4); ?>" />
					<div class="form-group">
						<label>Enter Question <sup>*</sup></label>
						<input type="text" name="question" id="question" class="form-control" />
					</div>
					<div class="form-group">
						<label>Enter Answer <sup>*</sup></label>
						<textarea name="answer" id="answer" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Status <sup>*</sup></label>
						<select name="status" class="form-control" id="status">	
							<option value="">Please Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" id="add_attribute_button" class="btn btn-primary">Submit</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="edit_QandA" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">EDIT QUESTION AND ANSWER</h4>
			</div>
			<div class="modal-body" id="edit_QA_attr">
				<form method="post" action="" id="edit_QandA_form">
					<input type="hidden" name="qid">
					<div class="form-group">
						<label>Enter Question <sup>*</sup></label>
						<input type="text" name="e_question" id="e_question" class="form-control" />
					</div>
					<div class="form-group">
						<label>Enter Answer <sup>*</sup></label>
						<textarea name="e_answer" id="e_answer" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Status <sup>*</sup></label>
						<select name="e_status" id="e_status" class="form-control">	
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="update_attributes" class="btn btn-primary">Update</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>includes/ckeditor/ckeditor.js?v=9"></script>
<script  type="text/javascript">
	$('#example').dataTable({
		"autoWidth": false,
		"bPaginate": false,
		"ordering": false
	});
	$(document).ready(function(e){
		<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==1){ ?>
		toastr.success("New Question created successfully");
		<?php }?>
		<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==2){ ?>
		toastr.success("Question updated successfully");
		<?php }?>
		<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==0){ ?>
		toastr.error("Something went wrong. Please try agian");
		<?php }?>
		
	});

	$('#ques_and_ans').click(function(){
		$('#QandA').modal({backdrop: "static"});
	});

	$('#add_attribute_button').click(function(e){
		var error = false;
		toastr.remove();
		if($('#question').val().trim()==''){
			error = true;
			toastr.error("Please enter valid question");
		}
		var tx = CKEDITOR.instances['answer'].getData();
		if($(tx).text().trim()==''){
			error = true;
			toastr.error("Please enter valid answer");
		}
		if($('#status').val().trim()==''){
			error = true;
			toastr.error("Please select valid status");
		}
		if(!error){
			var formdata = new FormData();
			formdata.append('star_id', <?php echo $this->uri->segment(4); ?>);
			formdata.append('question', $('#question').val().trim());
			formdata.append('answer', tx.trim());
			formdata.append('status', $('#status').val());
			$.ajax({
				type : 'post',
				cache : false,
				url : "<?php echo base_url(folder_name).'/star_manager/addAttributes'; ?>",
				data : formdata,
				processData: false,
				contentType: false,
				beforeSend: function(){
					toastr.warning("Please wait....");
				},
				success : function(result){
					location.reload();
				},
				error : function(err){
					console.log(err);
				}
				
			});
		}
		
	});
	
	$('.get_attributes').click(function(){
		toastr.remove();
		var id = $(this).data('id');
		var template = '';
		$.ajax({
			type : 'post',
			cache : false,
			url : "<?php echo base_url(folder_name).'/star_manager/getAttributes' ?>",
			data : {'id' : id},
			dataType : 'json',
			beforeSend : function(){
				toastr.warning("Please wait...");
			},
			success : function(result){
				$('input[name="qid"]').val(result['qid']);
				$('#e_question').val(result['question']);
				CKEDITOR.instances.e_answer.setData(result['answer']);
				template += '<option value="1">Please select any one</option>';
				template += '<option '+((result['status']=='1')? ' selected ': '')+' value="1" >Active</option>';
				template += '<option '+((result['status']=='0')? ' selected ': '')+' value="0">Inactive</option>';
				$('#e_status').html(template);
				
				$('#edit_QandA').modal({backdrop: "static"});
				toastr.remove();
			},
			error : function(err){
				console.log(err);
			}
		});
	});
	
	$('#update_attributes').on('click' , function(e){
		var error = false;
		toastr.remove();
		if($('#e_question').val().trim()==''){
			error = true;
			toastr.error("Please enter valid question");
		}
		var tx = CKEDITOR.instances['e_answer'].getData();
		if($(tx).text().trim()==''){
			error = true;
			toastr.error("Please enter valid answer");
		}
		if($('#e_status').val().trim()==''){
			error = true;
			toastr.error("Please select valid status");
		}
		if(!error){
			var formdata = new FormData();
			formdata.append('qid', $('input[name="qid"]').val());
			formdata.append('question', $('#e_question').val().trim());
			formdata.append('answer', tx.trim());
			formdata.append('status', $('#e_status').val());
			$.ajax({
				type : 'post',
				cache : false,
				url : "<?php echo base_url(folder_name).'/star_manager/updateAttributes'; ?>",
				data : formdata,
				processData: false,
				contentType: false,
				beforeSend: function(){
					toastr.warning("Please wait....");
				},
				success : function(result){
					location.reload();
				},
				error : function(err){
					console.log(err);
				}
				
			});
		}
	});
	
	CKEDITOR.replace( 'answer', {
		toolbar : [ 
			{items: [ 'TextColor','BGColor','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Bold','Italic','Underline'] },
			{items : [ 'Format', 'Fontsize']},
			{items: ['Image']},
			{items: [ 'Source','NumberedList','BulletedList'] }
		],  
		extraPlugins: 'autogrow,html5audio,embed,colordialog,fontAwesome,notification', 
		contentsCss : image_url+'includes/ckeditor/plugins/fontAwesome/css/font-awesome.min.css',
		allowedContent : true,
		removePlugins : 'magicline',
		autoGrow_maxHeight : 1000,
		extraAllowedContent : 'audio(*){*}[*];img(*){*}[*];object(*){*}[*];embed(*){*}[*];param(*){*}[*];script(*){*}[*];blockquote(*){*}[*];p(*){*}[*]',
		on:{
			change: function( evt ) {}
		}
	});
	
	CKEDITOR.replace( 'e_answer', {
		toolbar : [ 
			{items: [ 'TextColor','BGColor','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Bold','Italic','Underline'] },
			{items : [ 'Format', 'Fontsize']},
			{items: ['Image']},
			{items: [ 'Source','NumberedList','BulletedList'] }
		],  
		extraPlugins: 'autogrow,html5audio,embed,colordialog,fontAwesome,notification', 
		contentsCss : image_url+'includes/ckeditor/plugins/fontAwesome/css/font-awesome.min.css',
		allowedContent : true,
		removePlugins : 'magicline',
		autoGrow_maxHeight : 1000,
		extraAllowedContent : 'audio(*){*}[*];img(*){*}[*];object(*){*}[*];embed(*){*}[*];param(*){*}[*];script(*){*}[*];blockquote(*){*}[*];p(*){*}[*]',
		on:{
			change: function( evt ) {}
		}
	});
</script>