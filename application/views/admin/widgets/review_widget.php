<?php
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
if($render_mode == "manual"){
	$content_type =2;

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
	$content_type =2;
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
//print_R($widget_contents );
?>
<div class="row">
	 <h5 class="block-title"><span><?php print $widget_custom_title ?></span></h5>
	 <div class="review-block">
	 <?php
	 if(count($widget_contents)>0){
		$n=1;
		foreach($widget_contents as $get_content){
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
			$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_150X150.jpg';
			if($original_image_path !='' && get_image_source($original_image_path, 1)){
				$imagedetails = get_image_source($original_image_path, 2);
				$imagewidth = $imagedetails[0];
				$imageheight = $imagedetails[1];	
		
				if ($imageheight > $imagewidth){
					$Image150X150 	= $original_image_path;
				}
				else{
					$Image150X150  = str_replace("original","w150X150", $original_image_path);
				}
				if ($Image150X150 != '' && get_image_source($Image150X150, 1)){
					$show_image = image_url. imagelibrary_image_path . $Image150X150;
				}
				else{
					$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_150X150.jpg';
				}
				
				
				$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_150X150.jpg';
			}
			else{
				$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_150X150.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_150X150.jpg';
			}
			$content_url = $get_content['url'];
			$param = $content['close_param'];
			$live_article_url = $domain_name.$content_url.$param;
			if( $custom_title == ''){
				$custom_title = $get_content['title'];
			}	
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);
			$GetRating=$this->widget_model->getReviews($get_content['content_id']);
			if($GetRating!=0){
				?>
					<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 review-widget">
						<div class="review-image">
							<img data-src="<?php echo  $show_image; ?>" src="<?php echo $dummy_image; ?>" class="img-responsive" alt="<?php echo $imagealt; ?>" title=" <?php echo $imagetitle; ?>">
						</div>
						<div class="review-rating">
							<div class="review-stars">
								<?php if($get_content['author_name']!=''): ?>
								<p><a target="_BLANK" href="<?php echo BASEURL.'authors?q='.str_replace(' ','-',$get_content['author_name']);?>"><?php echo $get_content['author_name']; ?></a></p>
								<?php endif; ?>
								<div class="review-title">
									<a href="<?php echo $live_article_url; ?>"><?php echo $display_title; ?></a>
								</div>
								<?php echo $review[$GetRating]; ?>							
							</div>
						</div>
					</div>
					
					<?php
			
			
			}
			
			
			$n++;		
		}
	 }
	 ?>
	 </div>
</div>