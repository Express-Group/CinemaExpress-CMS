<?php
$formUrl = base_url(folder_name.'/star_manager/add');
if($type==1){
	$formUrl = base_url(folder_name.'/star_manager/edit/'.$this->uri->segment(4));	
}
?>
<span class="css_and_js_files">
	<link href="<?php echo image_url; ?>css/admin/video-up.css" rel="stylesheet" type="text/css">
	<link href="<?php echo image_url ?>css/admin/tabcontent.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo image_url ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
	<link href="<?php echo image_url ?>includes/ckeditor/contents.css" rel="stylesheet" type="text/css" id="contents_css" />
	<link href="<?php echo image_url ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo image_url ?>css/admin/jquery-ui-autocomplete.css" rel="stylesheet" type="text/css" /> 
	<link rel="stylesheet" href="<?php echo image_url ?>css/admin/jquery-ui-custom.css">
	<link href="<?php echo image_url ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
</span>
<style>
	.form-group, .article_content1 input{width: 100% !important;}
	.form-control{border: 1px solid #ccc !important;}
	.no_fi div{margin-right: 10%;float: left;}
	.no_fi input, label{display: inline-block; width: auto !important;}
	.form_error, sup{color: red; font-size: 13px;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> > <a href="#"><?php echo $title; ?></a></div>
				<h2><?php echo $title; ?></h2>
			</div>
			<p class="FloatRight save-back">
				<button class="btn btn-primary FloatRight i_button" id="formSubmit" title="Publish"><i class="fa fa fa-flag"></i> &nbsp;<?php if($type==1){ echo 'Update'; }else{ echo 'Submit'; } ?></button>
				<button onclick="window.location.href='<?php echo base_url(folder_name);?>/star_manager'" class="btn btn-primary FloatRight i_button" id="formSubmit" title="Go Back"><i class="fa fa-reply"></i> &nbsp;Back</button>
			</p>
		</div>
		<div class="Overflow DropDownWrapper">
			<ul class="tabs Article-Tab">
				<li class="selected" id="content_div"><a href="#view1">Content</a></li>
			</ul>
			<section class="tap-main Article-Tab">
				<div class="tabcontents padding-right-0 article_tab_contents">
					<div id="view1" style="display: block;">
						<div class="article_content1">
							<form method="post" id="star_form" action="<?php echo $formUrl; ?>" enctype="multipart/form-data">
								<div class="form-group">
									<label>Enter Star Name:</label><sup>*</sup>
									<input value="<?php if($type==1){ if(set_value('star_name')!=''){ echo set_value('star_name'); }else{ echo $detail['name'];}}?>" type="text" name="star_name" id="star_name" class="form-control" />
									<label class="form_error"><?php echo form_error('star_name'); ?></label>
								</div>
								<div class="form-group">
									<label>Enter Star Biography:</label><sup>*</sup>
									<textarea name="star_bio" id="star_bio" class="form-control"><?php if($type==1){ if(set_value('star_bio')!=''){ echo set_value('star_bio'); }else{ echo $detail['bio'];}}?></textarea>
									<label class="form_error"><?php echo form_error('star_bio'); ?></label>
								</div>
								<div class="form-group" style="width:50% !important;padding-right: 1%;float: left;">
									<?php
									if($type==1){
										echo '<div style="position:relative;"><img style="width: 100px;height: 100px;object-fit: cover;border-radius: 5px;display: block;" src="'.image_url.'images/stars/'.$detail['img_path'].'"><i style="position: absolute;top: 0px;left: 0px;background: #3c8dbc;color: #fff;   border-top-left-radius: 5px;padding: 5px;cursor:pointer;" class="fa fa-trash remove-image"></i></div>';
									}
									?>
									<label>Upload Star Image</label><sup>*</sup>
									<input type="file" name="star_image" id="star_image" class="form-control"/>
									<input type="hidden" name="star_image_value" value="<?php if($type==1){echo $detail['img_path'];}?>"/>
									<label class="form_error"><?php echo form_error('star_image'); ?></label>
								</div>
								<div class="form-group" style="width:50% !important;padding-left: 1%;float: left;">
									<label>Select Language (Industry):</label><sup>*</sup>
									<select class="form-control" name="language" id="language">
										<option value="">Please select the language</option>
										<?php
										foreach($languages as $lang){
											echo '<option '.(($type==1 && $detail['language']==$lang['slid'])? ' selected ': '').' value="'.$lang['slid'].'">'.$lang['name'].'</option>';
										}
										?>
									</select>
									<label class="form_error"><?php echo form_error('language'); ?></label>
								</div>
							</div>
							<div class="article_content2">
								<div class="form-group">
									<label>Status <sup>*</sup></label>
									<select class="form-control" name="status">
										<option value="">Please select any one</option>
										<option <?php if($type==1 && $detail['status']==1){ echo 'selected'; }?> value="1">Active</option>
										<option <?php if($type==1 && $detail['status']==0){ echo 'selected'; }?> value="0">Inactive</option>
									</select>
									<label class="form_error"><?php echo form_error('status'); ?></label>
								</div>
								<div class="form-group">
									<label>Meta Title</label>
									<input value="<?php if($type==1){ if(set_value('metatitle')!=''){ echo set_value('metatitle'); }else{ echo $detail['meta_title'];}}?>" type="text" name="metatitle" id="metatitle" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Meta Description</label>
									<textarea name="metadesc" id="metadesc" class="form-control"><?php if($type==1){ if(set_value('metadesc')!=''){ echo set_value('metadesc'); }else{ echo $detail['meta_description'];}}?></textarea>
								</div>
								<div class="form-group">
									<label>Meta Keyword (seperate with commas)</label>
									<input value="<?php if($type==1){ if(set_value('metakeyword')!=''){ echo set_value('metakeyword'); }else{ echo $detail['meta_keyword'];}}?>" type="text" name="metakeyword" id="metakeyword" class="form-control"/>
								</div>
								<div class="form-group no_fi">
									<div>
										<input <?php if($type==1 && $detail['noindex']==1){ echo 'checked'; }?> style="float:left;" type="checkbox" name="noindex" id="noindex" class="form-control" />
										<label style="float:left;margin-top: 8px;" for="noindex">No Index</label>
									</div>
									<div>
										
										<input <?php if($type==1 && $detail['nofollow']==1){ echo 'checked'; }?> style="float:left;" type="checkbox" name="nofollow" id="nofollow" class="form-control" />
										<label style="float:left;margin-top: 8px;" for="nofollow">No Follow</label>
									</div>	
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/tabcontent.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery.form.js" ></script>    
<script type="text/javascript" src="<?php echo image_url ?>js/jquery-ui.min.1.8.16.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/bootstrap/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery.remodal.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/modernizr.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>includes/ckeditor/ckeditor.js?v=9"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/bootstrap/bootstrap-hover-dropdown.min.js"></script>
<script>
	$(document).ready(function(){
		CKEDITOR.replace( 'star_bio', {
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
			change: function( evt ) {
			}
		  }
		});
		
		$('#formSubmit').click(function(){
			$('#star_form').submit();
		});
		$('.remove-image').on('click' , function(e){
			var cnf = confirm("Are you sure want to delete image?");
			if(cnf){
				$('input[name="star_image_value"]').val('');
				$(this).parent().remove();
			}
		});
	});
	
</script>
