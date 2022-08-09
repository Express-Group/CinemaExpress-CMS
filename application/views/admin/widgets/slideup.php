<?php
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid     = $content['sectionID'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article         = $content['show_max_article'];
$render_mode         = $content['RenderingMode'];
$domain_name =  base_url();
//end----
if($widget_custom_title==''){
	$widget_custom_title='two';
}

if($render_mode == "manual"){
	$content_type = $content['content_type_id'];
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode, $max_article);
	$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	$get_content_ids = implode("," ,$get_content_ids); 
	$widget_contents = array();
	if($get_content_ids!=''){
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach ($widget_instance_contents as $key => $value){
			foreach ($widget_instance_contents1 as $key1 => $value1){
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}						
}else{
	$content_type = $content['content_type_id'];
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
?>
  
	
	<fieldset class="FieldTopic"><legend class="topic"><?php print str_replace(array("style='background-color:",";'"),"",$widget_bg_color) ?></legend> </fieldset> 
	<div class="row-fluid">
	<?php
		if(count($widget_contents)>0){
			foreach($widget_contents as $get_content){
				$ArticlepublishDate=date_create($get_content['publish_start_date']);
				$Current_date=date_create(date('Y-m-d h:i:s'));
				$Days=date_diff($ArticlepublishDate,$Current_date);
				$original_image_path = "";
				$imagealt            = "";
				$imagetitle          = "";
				$custom_title        = "";
				$custom_summary      = "";
				
				if($render_mode == "manual"){
					if($get_content['custom_image_path'] != ''){
						$original_image_path = $get_content['custom_image_path'];
						$imagealt            = $get_content['custom_image_title'];	
						$imagetitle          = $get_content['custom_image_alt'];												
					}
					
					$custom_title   = $get_content['CustomTitle'];
					$custom_summary = $get_content['CustomSummary'];
				}
				if($original_image_path ==""){
					$original_image_path  = $get_content['ImagePhysicalPath'];
					$imagealt             = $get_content['ImageCaption'];	
					$imagetitle           = $get_content['ImageAlt'];	
				}
				$logo_prefix = ($is_home=='y') ? 'nie' : 'nie';
				$show_image="";
				
				if($original_image_path !='' && get_image_source($original_image_path, 1)){
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];	
		
					if ($imageheight > $imagewidth){
						$Image600X390 	= $original_image_path;
					}
					else{
						$Image600X390  = str_replace("original","w600X390", $original_image_path);
					}
					if ($Image600X390 != '' && get_image_source($Image600X390, 1)){
						$show_image = image_url. imagelibrary_image_path . $Image600X390;
					}
					else{
						$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
					}
					$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
				}
				else{
					$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
					$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
				}
				$content_url = $get_content['url'];
				$param = $content['close_param'];
				$live_article_url = $domain_name.$content_url.$param;
				if( $custom_title == ''){
					$custom_title = $get_content['title'];
				}	
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);
				if( $custom_summary == '' && $render_mode=="auto"){
					$custom_summary =  $get_content['summary_html'];
				}
				$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);
				if($widget_custom_title=='two' || $widget_custom_title=='rightpanel'):
					if(strlen($summary) > 75){
							$summary=substr($summary,0,75) . '...';
						}
				endif;
					
				if($widget_custom_title=='two'):
				print '<div class="widget-slideup-content">';
				print '<img src="'.$show_image.'" class="img-responsive widget-slideup-image">';
				print '<div class="widget-slideup-fixed">';
				print '<span> <i class="fa fa-clock-o" aria-hidden="true"></i> '.$Days->format("%a days").' ago</span>';
				print '<h4>'.$display_title.'</h4>';
				print '<p>'.$summary.'</p>';
				print '<a class="btn btn-primary" href="'.$live_article_url.'">read more <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
				print '</div>';
				print '</div>';
				endif;
				if($widget_custom_title=='one'):
				print '<div class="widget-slideup-content-one">';
				print '<img src="'.$show_image.'" class="img-responsive widget-slideup-image">';
				print '<div class="widget-slideup-fixed-one">';
				print '<span> <i class="fa fa-clock-o" aria-hidden="true"></i> '.$Days->format("%a days").' ago</span>';
				print '<h4>'.$display_title.'</h4>';
				print '<p>'.$summary.'</p>';
				print '<a class="btn btn-primary" href="'.$live_article_url.'">read more <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
				print '</div>';
				print '</div>';
				endif;
				if($widget_custom_title=='rightpanel'):
				print '<div class="widget-slideup-content widget-slideup-rightpanel">';
				print '<img src="'.$show_image.'" class="img-responsive widget-slideup-image">';
				print '<div class="widget-slideup-fixed">';
				print '<span> <i class="fa fa-clock-o" aria-hidden="true"></i> '.$Days->format("%a days").' ago</span>';
				print '<h4>'.$display_title.'</h4>';
				print '<p>'.$summary.'</p>';
				print '<a class="btn btn-primary" href="'.$live_article_url.'">read more <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
				print '</div>';
				print '</div>';
				endif;
			}
		
		
		}else{
		
		}
		
	?>
</div>
