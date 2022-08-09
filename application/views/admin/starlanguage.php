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
			<p class="FloatRight SaveBackTop"><button onclick="window.location.href='<?php echo base_url(folder_name);?>/star_manager'" class="btn-primary btn"><i class="fa fa-reply"></i> Go Back</button></p>
			<?php if(defined("USERACCESS_ADD".$Menu_id) && constant("USERACCESS_ADD".$Menu_id) == 1){ ?>
				<p class="FloatRight SaveBackTop"><button id="new_language" class="btn-primary btn"><i class="fa fa-plus-circle"></i> Add</button></p>
			<?php } ?>
		</div>
		<div class="Overflow DropDownWrapper">
			<table id="example" style="margin-top: 1rem;" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>LID</th>
						<th>LANGUAGE</th>
						<th>CREATED BY</th>
                        <th>MODIFIED ON</th>
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($records as $record){
						echo '<tr>';
						echo '<td>'.$record['slid'].'</td>';
						echo '<td>'.$record['name'].'</td>';
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
						echo '<button class="btn btn-primary edit_language" data-name="'.$record['name'].'" data-id="'.$record['slid'].'" data-status="'.$record['status'].'"><i class="fa fa-pencil" ></i></button>';
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
<div id="new_language_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">ADD NEW LANGUAGE</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Enter Language <sup>*</sup></label>
					<input type="text" name="language" id="language" class="form-control" />
				</div>
				<div class="form-group">
					<label>Status <sup>*</sup></label>
					<select name="status" class="form-control" id="status">	
						<option value="">Please Select Status</option>
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
			<button type="button" id="add_language_button" class="btn btn-primary">Submit</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Language Model for Edit-->
<div id="edit_language_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">EDIT LANGUAGE</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" id="edit_language_form">
					<input type="hidden" name="e_id" id="e_id" />
					<div class="form-group">
						<label>Enter Language <sup>*</sup></label>
						<input type="text" name="e_language" id="e_language" class="form-control" />
					</div>
					<div class="form-group">
						<label>Status <sup>*</sup></label>
						<select name="e_status" class="form-control" id="e_status">	
							<option value="">Please select any one</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" id="update_language_button" class="btn btn-primary">Submit</button>
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
		toastr.success("New language created successfully");
		<?php }?>
		<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==2){ ?>
		toastr.success("language updated successfully");
		<?php }?>
		<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==0){ ?>
		toastr.error("Something went wrong. Please try agian");
		<?php }?>
		
	});
	
	$('#new_language').click(function(){
		$('#new_language_modal').modal({backdrop: "static"});
	});
	
	$('#add_language_button').click(function(e){
		toastr.remove();
		var error = false;
		if($('#language').val().trim()==''){
			toastr.error("Please enter valid language");
			error = true;
		}
		if($('#status').val().trim()==''){
			toastr.error("Please select valid status");
			error = true;
		}
		if(!error){
			$.ajax({
				type: 'post',
				cache: false,
				url : "<?php echo base_url(folder_name).'/star_manager/addLanguage'; ?>",
				data : {'language' : $('#language').val().trim() , 'status' : $('#status').val().trim()},
				success : function(result){
					if(result==1){
						location.reload();
					}else{
						toastr.error("Something went wrong. Please try agian");
					}	
				},
				error : function(err){
					console.log(err);
				}
			});
		}
	});
	$('.edit_language').on('click' , function(e){
		var lid = $(this).data('id');
		var name = $(this).data('name');
		var status = $(this).data('status');
		$('#e_id').val(lid);
		$('#e_language').val(name);
		$('#e_status').val(status).change();
		$('#edit_language_modal').modal({backdrop: "static"});
	});
	$('#update_language_button').click(function(){
		toastr.remove();
		var error = false;
		if($('#e_language').val().trim()==''){
			toastr.error("Please enter valid language");
			error = true;
		}
		if($('#e_status').val().trim()==''){
			toastr.error("Please select valid status");
			error = true;
		}
		if(!error){
			$.ajax({
				type: 'post',
				cache: false,
				url : "<?php echo base_url(folder_name).'/star_manager/updateLanguage'; ?>",
				data : {'language' : $('#e_language').val().trim() , 'status' : $('#e_status').val().trim() , 'id' : $('#e_id').val()},
				success : function(result){
					if(result==1){
						location.reload();
					}else{
						toastr.error("Something went wrong. Please try agian");
					}	
				},
				error : function(err){
					console.log(err);
				}
			});
		}
	});
	
</script>