<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article         = $content['show_max_article'];
$render_mode         = $content['RenderingMode'];
// widget config block ends
$domain_name         =  base_url();
$show_simple_tab     = "";
if($content['widget_title_link'] == 1){
	$show_simple_tab 	    .= 	'<fieldset class="FieldTopic custom_widget_title"><legend class="topic"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></legend></fieldset>';
}else{
$show_simple_tab 	    .= 	'<fieldset class="FieldTopic custom_widget_title"><legend class="topic">'.$widget_custom_title.'</legend></fieldset>';
}
$show_simple_tab    .='<div class="row">
					   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom-space-10">
					   <div class="role_widget" '.$widget_bg_color.'>';
					
	//getting content block - getting content list based on rendering mode
	//getting content block starts here . Do not change anything
if($content['RenderingMode'] == "manual")
{
$content_type = $content['content_type_id'];  // manual article content type
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'], $max_article); 
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
$content_type = $content['content_type_id'];  // auto article content type
$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}	
$i =1;
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		// Code Block B - if rendering mode is manual then if custom image is available then assigning the imageid to a variable
		// Code Block B starts here - Do not change	
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$custom_title        = "";
		$custom_summary      = "";
			if($render_mode == "manual")
			{
				if($get_content['custom_image_path'] != '')
				{
				$original_image_path = $get_content['custom_image_path'];
				$imagealt            = $get_content['custom_image_title'];	
				$imagetitle          = $get_content['custom_image_alt'];												
				}
				$custom_title   = $get_content['CustomTitle'];
				$custom_summary = $get_content['CustomSummary'];
			}
		if($original_image_path =="")                                                // from cms || live table    
		{
		$original_image_path  = $get_content['ImagePhysicalPath'];
		$imagealt             = $get_content['ImageCaption'];	
		$imagetitle           = $get_content['ImageAlt'];	
		}
		// Code Block B ends here
		// getting content details from database - Do not change
		$show_image="";
		if($original_image_path !='' && get_image_source($original_image_path, 1))
		{
			$imagedetails = get_image_source($original_image_path, 2);
			$imagewidth = $imagedetails[0];
			$imageheight = $imagedetails[1];
			if($i==1)
			{
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
			$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			}
			else
			{
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
			$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			}
		}
		else
		{
			if($i==1)
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			}
			else
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			}
		}
		$content_url = $get_content['url'];
		$param = $content['close_param'];
		$live_article_url = $domain_name.$content_url.$param;
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
		//  Assign article links block ends hers
		// Assign summary block - creating links for  article summary
		// Assign summary block starts here
		if( $custom_summary == '' && $render_mode=="auto")
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
		// Assign summary block starts here
		if($i == 1) 
		{
			$show_simple_tab.=	' <div class="phase1"> <div>   </div> <figure><a  href="'.$live_article_url.'" class="article_click" >
			<img src="'.$dummy_image.'" data-src="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'"><i class="fa fa-play video_iconsmall" aria-hidden="true"></i></a></a></figure>
			
			<div class="tbox">
			<div class="txt_lead">'.$display_title.'</div>';
			/*edited for topborder film roll karthik
			$show_simple_tab.=	' <div class="phase1"> <div class="top_border">   </div> <figure><a  href="'.$live_article_url.'" class="article_click" >
			<img src="'.$dummy_image.'" data-src="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a></figure>
			<div class="top_border">   </div>
			<div class="tbox">
			<div class="txt_lead">'.$display_title.'</div>'; */
			if($is_summary_required== 1)
			{
			$show_simple_tab.='<div class="role_description">'.$summary.'</div>';
			}
			$show_simple_tab.='</div></div>';
		} 
		else 
		{
			if($i == 2) 
			{
			$show_simple_tab.=	'<div class="phase2"><div class="rolecontent">';
			}
			
			
			/*$show_simple_tab.=	'
			<div class="oddbox">
				<div class="imagewrap">
					<div class="filmborder"></div>
					<a  href="'.$live_article_url.'" class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a> 
					<div class="filmborder"></div>
				</div>';*/
				$show_simple_tab.=	'
			<div class="oddbox">
				<div class="imagewrap">
					
					<a  href="'.$live_article_url.'" class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'"><i class="fa fa-play video_iconsmall_1" aria-hidden="true"></i></a></a> 
					
				</div>';
			$show_simple_tab.=	'
						<div class="o_textwrap">
                    
                    	<div class="o_txt_lead">'.$display_title.'</div>
						
                    
                        </div></div>';
			if($i == count($widget_contents))
			$show_simple_tab.=	'</div></div>'; 
		}
		//<div class="o_bottom"></div>
		// display title and summary block ends here					
		//Widget design code block 1 starts here																
		//Widget design code block 1 starts here			
		$i =$i+1;							  
	}
}
 elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}
// content list iteration block ends here
// Adding content Block ends here
$show_simple_tab .='</div>';
if($content['widget_title_link'])
{
$show_simple_tab .=' <div class="custom_arrow"><a class="cinema-review-more" href="'.$widget_section_url.'">More '.strtolower($widget_custom_title).' >></a></div>';
}
$show_simple_tab .='</div></div>';
echo $show_simple_tab;
?>
