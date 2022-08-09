<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = $content['page_param'];
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$section_widgetID    = $content['widget_values']['data-widgetid'];  // current widget id
$content_type        = $content['content_type_id'];  // auto article content type
$widget_section_url  = $content['widget_section_url'];
$max_article          = $content['show_max_article'];
$render_mode          = $content['RenderingMode'];
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
//print_r($content);
// widget config block ends
//getting tab list for hte widget
if($render_mode == "manual")
{
$content_type = $content['content_type_id'];  // manual article content type
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode, $max_article);
	// changed newly on 10-09-2016
	$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	$get_content_ids = implode("," ,$get_content_ids); 
$widget_contents = array();
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
	
	
}
else
{
//	$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type, $view_mode);	
$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .= '<div class="row">
					<div class="">
					<div class="headline2 margin-top-15">';	
	/* if($content['widget_title_link'] == 1){
		$show_simple_tab.=	'<h5><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></h4>';
	}
	else{
		$show_simple_tab.=	'<h5>'.$widget_custom_title.'</h4>';
	} */
	$show_simple_tab.='<div class="row">';
//$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
//$get_content_ids = implode("," ,$get_content_ids);
	//echo '<pre>'; echo $get_content_ids; die();	
//if($get_content_ids!='')
//{
	/*
	$content_type = $content['content_type_id'];
	$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
	$widget_contents = array();
	//echo '<pre>'; print_r($widget_instance_contents1); die();	
	foreach ($widget_instance_contents as $key => $value) {
		foreach ($widget_instance_contents1 as $key1 => $value1) {
			if($value['content_id']==$value1['content_id']){
				$widget_contents[] = array_merge($value, $value1);
			}
		}
	}
	*/
				// content list iteration block - Looping through content list and adding it the list
				// content list iteration block starts here
				
				$i =1;
	if(count($widget_contents)>0)
	{
				$i =1;
				foreach($widget_contents as $get_content)
				{
					if($i < 8):
					$original_image_path = "";
					$imagealt            = "";
					$imagetitle          = "";
					$custom_title        = "";
					$custom_summary      = "";
					$Image600X390        = "";
					if($render_mode == "manual")
					{
						if($get_content['custom_image_path'] != '')
						{
							$original_image_path = $get_content['custom_image_path'];
							$imagealt            = $get_content['custom_image_title'];	
							$imagetitle          = $get_content['custom_image_alt'];												
						}
						$custom_title   = $get_content['CustomTitle'];
					}
					if($original_image_path =="")                                                // from cms imagemaster table    
					{
					   $original_image_path  = $get_content['ImagePhysicalPath'];
					   $imagealt             = $get_content['ImageCaption'];	
					   $imagetitle           = $get_content['ImageAlt'];	
					}
				
					$show_image="";
					if($original_image_path !=''  && get_image_source($original_image_path, 1))
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
					if (get_image_source($Image600X390, 1) && $Image600X390 != '')
					{
						$show_image = image_url. imagelibrary_image_path . $Image600X390;
					}
					else
					{
						$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
					}
					
					}
					else
					{
					$show_image	  = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
					
					}
					$dummy_image  = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
						
						
						$content_url = $get_content['url'];
						$param       = $content['close_param'];
						$live_article_url = $domain_name.$content_url.$param;
						$section_name= $get_content['section_name'];
						if( $custom_title == '')
						{
							$custom_title = $get_content['title'];
						}	
						$lastpublishedon = $get_content['last_updated_on'];
						$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
						$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
					//  Assign article links block ends hers
						$summary =  $get_content['summary_html'];
						$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$summary);	
						$Rating=$this->widget_model->getReviews($get_content['content_id']);
						if(trim($summary) == '') {
							$bodycontent = trim(strip_tags($get_content['article_page_content_html']));
							$headline_position = strpos($bodycontent, ":");
							
							if($headline_position < 50) {
							$bodycontent = substr($bodycontent, $headline_position + 1);  
							}
							$summary  = character_limiter($bodycontent,150);
						}	
						$time = '';															
						if($i == 1) 
						{
	
							$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
							$show_simple_tab .='<div class="sub-main-widget">';
							$show_simple_tab .='<figure><img src="'.$dummy_image.'" data-src="'.$show_image.'"></figure>';
							if($Rating!=0){
								$show_simple_tab.= '<span>';
								$show_simple_tab.= @$review[$Rating];
								$show_simple_tab.= '</span>';
							}
							$show_simple_tab .='<h4>'.$display_title.'</h4>';
							if($is_summary_required== 1){	
								$show_simple_tab .= '<p>'.$summary.'</p>';
							}
							$show_simple_tab .='</div>';
							$show_simple_tab .='</div>';
						}
					  
					else 
					{
						
						if($i==2 || $i==5)	
						{
						
						$j=$i+3;
						$show_simple_tab.= '<div class="WidthFloat_L" '.$widget_bg_color.'>'; 
						}
						$show_simple_tab.= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 EnterNews_1">';
						$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>';
						if($Rating!=0){
							$show_simple_tab.= '<span>';
							$show_simple_tab.= @$review[$Rating];
							$show_simple_tab.= '</span>';
						}
						$show_simple_tab .='<h4>'.$display_title.'</h4>';
						$show_simple_tab.= '</div>';
						if($i%4==0)
						{ 
					
						$show_simple_tab.=  '</div></div>'; //  WidthFloat_L For innernal 
						}
						
					}
						
			
					if($i==count($widget_contents))
					{
					
						if($i%4!=0)
						{
							
							$show_simple_tab.=  '</div>';
						}
						
					}
		// display title and summary block ends here					
		//Widget design code block 1 starts here																
		//Widget design code block 1 starts here
		//echo $i;exit;			
					$i =$i+1;	
				endif;
			}
				
				// content list iteration block ends here
		}
		 elseif($view_mode=="adminview")
		{
			$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
		}
		if($i==3 || $i==4 ){
				$show_simple_tab .='</div>';
			}
			$show_simple_tab .='</div>
          </div>
          </div>';
																			  

	if(count($widget_contents) > 0):
		echo $show_simple_tab;
	endif;
?>
