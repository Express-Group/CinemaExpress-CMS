<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$widget_section_url 	= $content['widget_section_url'];
$is_home 				= $content['is_home_page'];
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$view_mode            	= $content['mode'];
$max_article            = $content['show_max_article'];
$render_mode            = $content['RenderingMode'];
$review=[];
		$review['0.5']='<i class="fa fa-star-half-o star-success" aria-hidden="true"></i>';
		$review['1']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';

		$review['1.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['2']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['2.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['3']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['3']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['3.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['4']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
		$review['4.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i>';
		$review['5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i>';
// widget config block ends

$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 SpecialLeadStory ">
					<div class="headline2">';	

if($content['widget_title_link'] == 1){
	$show_simple_tab.=	'<h5><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></h4>';
}
else{
	$show_simple_tab.=	'<h5>'.$widget_custom_title.'</h4>';
}
$show_simple_tab.='<div class="row">';

$content_type 		= $content['content_type_id'];  // auto article content type
$widget_contents 	= array();

//getting content block - getting content list based on rendering mode
//getting content block starts here . Do not change anything
if($render_mode == "manual"){
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode, $max_article);
		
	$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	$get_content_ids = implode("," ,$get_content_ids); 
	
	if($get_content_ids!='')
	{
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}	
	
} else {
	//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $view_mode);
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
//getting content block ends here
/*
if (function_exists('array_column')) 
{
	$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
}
else
{
	$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
}
$get_content_ids = implode("," ,$get_content_ids);

if($get_content_ids!='')
{

	$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
	$widget_contents = array();
	foreach ($widget_instance_contents as $key => $value) {
		foreach ($widget_instance_contents1 as $key1 => $value1) {
			if($value['content_id']==$value1['content_id']){
			   $widget_contents[] = array_merge($value, $value1);
			}
		}
	}
} */


	$i =1;
	if(count($widget_contents) > 0 ){
		// content list iteration block - Looping through content list and adding it the list
		// content list iteration block starts here
		foreach($widget_contents as $get_content)
		{
			
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
			if($original_image_path ==""){  // from cms || live table   
			   $original_image_path  = $get_content['ImagePhysicalPath'];
			   $imagealt             = $get_content['ImageCaption'];	
			   $imagetitle           = $get_content['ImageAlt'];	
			}
			
			$show_image="";
			if($original_image_path !='' && get_image_source($original_image_path, 1))
			{
				$imagedetails = get_image_source($original_image_path, 2);
				$imagewidth = $imagedetails[0];
				$imageheight = $imagedetails[1];	
			
				if ($imageheight > $imagewidth)
				{
					$Image600X300 	= $original_image_path;
				}
				else
				{	
				    $Image600X300  = str_replace("original","w600X390", $original_image_path);
			    }
				if (get_image_source($Image600X300, 1) && $Image600X300 != ''){
					$show_image = image_url. imagelibrary_image_path . $Image600X300;
				}
				else {
					$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
				}
				$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			}
			else{
				$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			}
			
			$content_url = $get_content['url'];
			$param = $content['close_param'];
			$live_article_url = $domain_name.$content_url.$param;
			$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? $get_content['title']: '' ) ;
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);
			$Rating=$this->widget_model->getReviews($get_content['content_id']);
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
			// Assign summary block starts here
			if( $custom_summary == '' && $render_mode=="auto")
				{
					$custom_summary =  $get_content['summary_html'];
				}
		   $custom_summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
			
			// display title and summary block starts here
			/*if($i == 1)
			{*/
				$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#f7edde;">
				<div class="margin-bottom-25 Overflow">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 SpecialLeadStory_3">';
					$show_simple_tab .='<h4>'.$display_title.'</h4>';
					if($is_summary_required== 1){	
					 $show_simple_tab .= '<p>'.$custom_summary.'</p>';
					 }
					$show_simple_tab  .= '</div>';	
					if($Rating!=0){					
					$show_simple_tab .='<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 SpecialLeadStory_2">';
					$show_simple_tab.= '<div class="review-stars_bigimage">';
					$show_simple_tab.= '<span class="info">';
					$show_simple_tab.= @$review[$Rating];
						
					$show_simple_tab.= '</span></div>';
					$show_simple_tab .='<figure><img src="'.$dummy_image.'" data-src="'.$show_image.'"></figure></div>
				</div>
				</div>';	
					}
					else{
						$show_simple_tab .='<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 SpecialLeadStory_2">';
						$show_simple_tab .='<figure><img src="'.$dummy_image.'" data-src="'.$show_image.'"></figure></div>
				</div>
				</div>';	
					}
					
						
			/*}*/	
			$i =$i+1;							  
		}// content list iteration block ends here
	//}
}  elseif($view_mode=="adminview"){
	$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}

$show_simple_tab .='</div></div></div></div>';
echo $show_simple_tab;
?>
