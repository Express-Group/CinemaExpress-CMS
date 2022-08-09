<?php
$widget_bg_color 		=	$content['widget_bg_color'];
$widget_custom_title 	=	$content['widget_title'];
$widget_instance_id 	=	$content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= 	$content['sectionID'];
$main_sction_id 		= 	"";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$view_mode              = $content['mode'];
$max_article         = $content['show_max_article'];
$render_mode         = $content['RenderingMode'];
if($widget_custom_title==' '){ $widget_custom_title='Related Articles'; }
?>
<div class="row">
	<h5 class="block-title margin-bottom-10"><span><?php print $widget_custom_title  ?></span></h5>
</div>
<div class="row Custom-related-article">
</div>
<script>
var url=window.location.href;
var content_type;
var type=url.split('/');
var type=type[3].toLowerCase();
if(type=='photos'){
	content_type=3;
}else if(type=='videos'){
	content_type=2;
}else{
	content_type=1;
}  
url=url.split('-');
url=url[(url.length)-1];
url=url.split('.');
var Content_id=url[0];
if(Content_id ==undefined || Content_id==''){
	console.log(Content_id);
}else{
	$.ajax({
		type:'post',
		cache:false,
		url:'<?php print BASEURL; ?>user/commonwidget/GetRelatedArticles',
		data:{'content_id':Content_id,'content_type':content_type},
		success:function(result){
			$('.Custom-related-article').html(result);
		}
	});
}


</script>