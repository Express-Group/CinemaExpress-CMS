<link href="<?php echo image_url; ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<link href="<?php echo image_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo image_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style>
#example img{width: 100px;height: 100px;object-fit: cover;border-radius: 5px;}
.pager strong , .pager a{border-radius: 5px;padding: 6px 12px;background: #3c8dbc;color: #fff;}
.pager strong{background:#205878;}
.modal-dialog{top:7%;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> > <a href="#"><?php echo $title; ?></a></div>
				<h2><?php echo $title; ?></h2>
			</div>
			<?php if(defined("USERACCESS_ADD".$Menu_id) && constant("USERACCESS_ADD".$Menu_id) == 1){ ?>
				<p class="FloatRight SaveBackTop"><a href="<?php echo base_url(folder_name);?>/star_manager/add" class="btn-primary btn"><i class="fa fa-plus-circle"></i> Create Stars</a></p>
				<p class="FloatRight SaveBackTop"><a style="margin-right:10px;" href="<?php echo base_url(folder_name);?>/star_manager/languages" class="btn-primary btn"><i class="fa fa-plus-circle"></i> Languages</a></p>
			<?php } ?>
		</div>
		<div class="Overflow DropDownWrapper">
			<div class="FloatLeft TableColumn">
				<form method="get">
				<div class="FloatLeft w2ui-field">
					<select name="star_status" class="controls">
						<option value="">Status: All</option>
						<option <?php if($this->input->get('star_status')==1){ echo ' selected '; }?>value="1" >Active</option>
						<option <?php if($this->input->get('star_status')==0){ echo ' selected '; }?>value="0" >Inactive</option>
					</select>
				</div>
				<div class="FloatLeft w2ui-field">
					<select name="lang" class="controls">
						<option value="">-Select Language-</option>
						<?php
						foreach($languages as $lang){
							echo '<option '.(($this->input->get('lang')==$lang['slid'])? ' selected ':'').' value="'.$lang['slid'].'">'.$lang['name'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="FloatLeft TableColumnSearch"><input value="<?php echo trim($this->input->get('search_text')); ?>" autocomplete="off" type="search" placeholder="Search" class="SearchInput" name="search_text" ></div>
				<button class="btn btn-primary" type="submit">Search</button>
				<button onclick="window.location.href='<?php echo base_url(folder_name)?>/star_manager'" class="btn btn-primary" type="button">Clear Search</button>
				</form>
			</div>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>STAR ID</th>
						<th>STAR NAME</th>
						<th>LANGUAGE</th>
                        <th>STAR IMAGE</th>
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
						echo '<td>'.$record->star_id.'</td>';
						echo '<td style="font-weight:700;">'.$record->name.'</td>';
						echo '<td style="color: #3c8dbc;font-weight: 700;">'.$record->lang_name.'</td>';
						echo '<td><img src="'.image_url.'images/stars/'.$record->img_path.'"></td>';
						echo '<td>'.$controller->getUsername($record->modified_by).'</td>';
						echo '<td>'.$record->modified_on.'</td>';
						echo '<td>';
						if($record->status==1){
							echo '<span class="label label-success">ACTIVE</span>';
						}else{
							echo '<span class="label label-danger">INACTIVE</span>';
						}
						echo '</td>';
						echo '<td>';
						echo '<a href="'.base_url(folder_name).'/star_manager/edit/'.$record->star_id.'" style="padding: 6px 8px !important;margin-right: 5px;" class="btn btn-primary"><i class="fa fa-pencil"></i></a>';
						echo '<a target="_BLANK" href="'.base_url(folder_name).'/star_manager/star_list/'.$record->star_id.'" style="padding: 6px 8px !important;margin-right: 5px;" class="btn btn-primary"><i style="color:#fff;" class="fa fa-check"></i></a>';
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
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/bootstrap.min.js"></script>
<script  type="text/javascript">
$('#example').dataTable({
	"autoWidth": false,
	"bPaginate": false,
	"ordering": false
});
$(document).ready(function(e){
	<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==1){ ?>
	toastr.success("New star created successfully");
	<?php }?>
	<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==2){ ?>
	toastr.success("Star updated successfully");
	<?php }?>
	<?php if($this->session->flashdata('result')!='' && $this->session->flashdata('result')==0){ ?>
	toastr.error("Something went wrong. Please try agian");
	<?php }?>
	
});
</script>