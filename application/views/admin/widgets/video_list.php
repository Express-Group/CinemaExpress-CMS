<style>
.video_list_manual{padding:3px;}
</style>
<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid     = $content['sectionID'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article            = $content['show_max_article'];
$page_section_id = $content['page_param'];
$Main_widget_Id=79;
$contentID=array();
$template='';
$CI = &get_instance();
$this->live_db = $this->load->database('live_db', TRUE);
$this->live_db->select('WidgetInstancelive_id');
$this->live_db->select('WidgetInstance_id');
$this->live_db->select('Container_ID');
$this->live_db->from('widgetinstance_live');
$this->live_db->where(['Page_type'=>1,'Pagesection_id'=>$page_section_id,'Widget_id'=>$Main_widget_Id]);
$GetWidgetInstance=$this->live_db->get();
$GetWidgetInstance=$GetWidgetInstance->result();
$ExitsArticle=$this->live_db->query("SELECT content_id FROM widgetinstancecontent_live WHERE WidgetInstance_id='".@$GetWidgetInstance[0]->WidgetInstance_id."' AND Status=1")->result();
foreach($ExitsArticle as $Data){
	array_push($contentID,$Data->content_id);
}
$NewContentId=implode(',',$contentID);
$row=@$_COOKIE['cx_total_row'];
/* if($row!=''){
$total_rows=$row;
}
else{ */
if ($page_section_id == 31)
{
	$total_rows=$this->live_db->query("SELECT content_id FROM article WHERE status='P' AND (section_id=31 OR section_id=21 OR section_id=33) AND content_id NOT IN(".$NewContentId.")")->num_rows();
}
else
{
 $total_rows=$this->live_db->query("SELECT content_id FROM article WHERE status='P' AND section_id=".$page_section_id." AND content_id NOT IN(".$NewContentId.")")->num_rows();
}
setcookie('cx_total_row',$total_rows);
//}
$config['base_url']=str_replace('index.php/','',$_SERVER['PHP_SELF']);
$config['total_rows']=$total_rows;
$config['per_page']=6;
$config['num_links']=5;
$config['page_query_string']=TRUE;
$config['reuse_query_string']=TRUE;
$config['use_page_numbers']=TRUE;
$config['first_url']=str_replace('index.php/','',$_SERVER['PHP_SELF']);
$config['cur_tag_open']='<a class="active">';
$config['cur_tag_close']='</a>';
$this->pagination->initialize($config);
$limit=(isset($_GET['per_page']) && $_GET['per_page'])?$_GET['per_page']:0;
if ($page_section_id == 31)
{
$GetArticle=$this->live_db->query("SELECT title,url,section_page_image_path,article_page_image_path FROM article WHERE status='P' AND (section_id=31 OR section_id=21 OR section_id=33) AND content_id NOT IN(".$NewContentId.") LIMIT ".$limit." , 6")->result();
}
else{
	$GetArticle=$this->live_db->query("SELECT title,url,section_page_image_path,article_page_image_path FROM article WHERE status='P' AND section_id=".$page_section_id." AND content_id NOT IN(".$NewContentId.") LIMIT ".$limit." , 6")->result();
}
$template .='<div class="Entertainment Enter_Video">';
$template .='<fieldset class="FieldTopic"><legend class="topic"><a>Other Videos</a></legend></fieldset>';
$j=1;
$domain_name         =  base_url();
foreach($GetArticle as $Article):
	if($j==1){
		$template .='<div class="row">';
	}
	$ArticleImage=$Article->article_page_image_path;
	$SectionImage=$Article->section_page_image_path;
	if($SectionImage!=''){
		$original_image_path=$SectionImage;
	}else{
		$original_image_path=$ArticleImage;
	}
	
	$show_image="";
	if($original_image_path !='' && get_image_source($original_image_path, 1))
	{
	$imagedetails = get_image_source($original_image_path, 2);
	$imagewidth = $imagedetails[0];
	$imageheight = $imagedetails[1];	

	if ($imageheight > $imagewidth)
	{
		$Image600X390 	= $original_image_path;
	}
	else
	{
		 $Image600X390  = str_replace("original","w600X390", $original_image_path);
	}
	
	if ($Image600X390 != '' && get_image_source($Image600X390, 1))
	{
	$show_image = image_url. imagelibrary_image_path . $Image600X390;
	}
	
	else {
	$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	}
	$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	}
	else
	{
	$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	}
	$icon=image_url. imagelibrary_image_path.'play-circle.png';
	$Title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$Article->title);
	$live_article_url = $domain_name. $Article->url;
	$template .='<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 video_list_manual">';
	$template .='<figure class="PositionRelative"><img src="'.$dummy_image.'" data-src="'.$show_image.'" title="" alt="" class="lazy-loaded"><img src="'.$icon.'" class="GalleryListing"></figure>';
	$template .='<p><a href="'.$live_article_url.'">'.$Title.'</a></p>';
	$template .='</div>';
	if($j==3){
		$template .='</div>';
		$j=1;
	}else{
		$j++;
	}
	
endforeach;
if($j==2 || $j==3){

	$template .='</div>';
}
$template .='</div>';
$template .='<div class="pagina">';
$template .=$this->pagination->create_links();
$template .='</div>';
print $template;

?>