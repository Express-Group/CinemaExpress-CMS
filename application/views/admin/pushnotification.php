<!DOCTYPE html>
<html>
<head>
	<title>Push Notification</title>
	<link href="<?php print base_url('css/admin/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php print base_url('css/admin/font-awesome.min.css'); ?>" rel="stylesheet">
	<script src="<?php print base_url('js/jquery-1.11.3.min.js'); ?>"></script>
	<script src="<?php print base_url('js/bootstrap.min.js'); ?>"></script>
	<style>
		 body{font-family:Calibri, Arial !important;}
		.header{background: #3c8dbc;height: 52px;}
		.header span{line-height:48px;color:#fff;font-size:29px;}
		.margin-header{margin-top:2%;}
		 th{background-color:#84c7ea;}
		 table-td{background-color:#cce9f6;}
		.table-td:hover{background-color:#bce2f3;}
		.well #well-heading{text-align:center;color: #3c8dbc;font-size: 23px;font-weight: bold;text-transform: uppercase}
		.well{background-color:#fff;padding:7px;}
		.toast {width:300px; height:20px;height:auto;position:absolute;left:50%; margin-left:-100px; bottom:40%;background-color: #009900;color: #fff;    font-family: Calibri;font-size: 20px;padding:10px;text-align:center;border-radius: 2px;-webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);    -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);}
		.panel-primary>.panel-heading {background-color: #3c8dbc;border-color: #3c8dbc;}
		.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{background-color: #3c8dbc; border-color: #3c8dbc;}
		.fb-custom{background-color:#3b5998 !important;border-color:#3b5998 !important;}
		.tw-custom{background-color:#1dcaff !important;border-color:#3b5998 !1dcaff;}
		.fb-custom:hover{background-color:#3b5998 !important;border-color:#3b5998 !important;}
		.tw-custom:hover{background-color:#1dcaff !important;border-color:#3b5998 !1dcaff;}
		.f{z-index:11;}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-6 col-sm-12 header">
				<span>ENPL - CMS </span>
			</div>
			<div class="col-md-6 col-sm-12 header">
				<!--<a href="<?php site_url('niecpan/clog/logout')?>" class="is-template-version-saved"><i class="fa fa-sign-out"></i></a>-->
			</div>
		</div>
		</br>&nbsp;
		<div class="row-fluid">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">SET NOTIFICATION</div>
					<div class="panel-body">
						<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>TITLE</th>
								<th>ACTION</th>
								<th>SHARE</th>
							</tr>
							<?php
							if($this->uri->segment(4)==''):
								$i=1;
							else:
								$i=$this->uri->segment(4)+1;
							endif;
								
								foreach($data as $article_row){
									$notification_status=$controller->check_notification($article_row->content_id);
									if($i%2==0):
										print '<tr class="table-td" id="'.$article_row->content_id.'">';
									else:
										print '<tr id="'.$article_row->content_id.'">';
									endif;
									print '<td>'.$i.'</td>';

									//$title_ulr		= str_ireplace("<p>",'',$article_row->title);
									//$title_ulr		= str_ireplace("</p>",'',$article_row->title);
									//$title_ulr = preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '', $article_row->title);
									$title_ulr = strip_tags($article_row->title);
								
									print '<td class="t-'.$article_row->content_id.'">'.$title_ulr.'</td>';
									if($notification_status==0):
										print '<td class="text-center">';
										?>
										<button class="btn btn-primary f b-<?=$article_row->content_id ?>" title="set notification" onclick="set_notification('<?=$article_row->content_id ?>');"><i class="fa fa-bell-o" aria-hidden="true"></i></button>
										<input type="hidden" class="u-<?=$article_row->content_id ?>" value="<?=$article_row->url?>">
										<?php
										print '</td>';
									else:
										print '<td class="text-center">';
										?>
										<button class="btn btn-danger f b-<?=$article_row->content_id ?>" title="notified" onclick="set_notification('<?=$article_row->content_id ?>');" disabled><i class="fa fa-lock" aria-hidden="true"></i></button>
										<?php
										print '</td>';
									
									endif;
									print'<td><button value="'.$article_row->content_id.'" onclick="share(1,'.$article_row->content_id.')" class="btn btn-primary fb-custom"><span><i class="fa fa-facebook-square" aria-hidden="true"></i></span></button><button value="'.$article_row->content_id.'" onclick="share(2,'.$article_row->content_id.')" class="btn btn-primary tw-custom"><span><i class="fa fa-twitter-square" aria-hidden="true"></i></span></button></td>';
									
									$i++;
									
								}
							?>
							
						</table>
						<div class="col-md-12 text-center">
							<?php print $pagination; ?>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='toast' style='display:none'>toast</div>
	<script>
	function set_notification(content_id){
	
		var app=confirm('Are you sure want to set notification?');
		if(app==true){
			var title=$('.t-'+content_id).text();
			var a_url=$('.u-'+content_id).val();
			$.ajax({
				type:'post',
				cache:false,
                                data:{'c':content_id,'t':title,'u':a_url},
				url:'<?php print site_url()?>'+'niecpan/push_notification/send_notification',
				success:function(result){
					console.log(result);
					if(result==1){
						$('.b-'+content_id).html('<i class="fa fa-lock" aria-hidden="true"></i>').prop('disabled',true).addClass('btn-danger').removeClass('btn-primary');
						$('.toast').html('Notification sent successfully').fadeIn(400).delay(2000).fadeOut(400);
					}else{
						$('.toast').html('Something went wrong.please try again').css('background-color','#cc3300').fadeIn(400).delay(2000).fadeOut(400);
						
					}
				}
			});
		}
		
	
	}
	
	function share(type,id){
		var url_content=$('.u-'+id).val();
		var title=$('.t-'+id).text();
		url_content='<?php print BASEURL ?>'+url_content;
		if(type==1){
			var fb_url='https://www.facebook.com/sharer/sharer.php?u='+url_content;
			var facebook = window.open(fb_url, "", "width=800,height=400");
		}else{
			$.ajax({
			type:'post',
			cache:false,
			url:'<?php print HOMEURL?>user/commonwidget/get_shorten_url',
			data:{'article_url':url_content},
			dataType : 'json',
			success:function(result){
				console.log(result.id);
				var fb_url='https://twitter.com/intent/tweet?original_referer='+result.id+'&text='+title+'&url='+result.id+'&via=XpressCinema';
				window.open(fb_url, "", "width=800,height=400");
			}
			});
		}	
		
	}
	</script>
</body>
</html>
