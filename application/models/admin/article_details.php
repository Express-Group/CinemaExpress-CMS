<article class="WidthFloat_L printthis">
<?php
					$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
				    $content_id= $content['content_id'];
					$content_type_id = $content['content_type'];
					$view_mode          = $content['mode'];
					if($content_id!=''){
										 
					if($content['content_from'] =="live"){
					//$content_details = $this->widget_model->widget_article_content_by_id($content_id, $content_type_id, ""); from live
					$content_details = $content['detail_content'];   // from Template Controller
					}else if($content['content_from']=="archive"){
		            $content_details = $content['detail_content'];
					}
					$content_det= $content_details[0];
					
					$section_id = $content_det['section_id'];
					
					//print_r($content_det);exit;
					$domain_name =  base_url();
					$section_details = $this->widget_model->get_sectionDetails($section_id, $view_mode);
					$home_section_name = 'Home';
					$child_section_name = $section_details['Sectionname'];
					$child_section_name1 = $section_details['URLSectionStructure'];
					$url_structure       = $section_details['URLSectionStructure'];
					$sub_section_name = 'Home';
					if($section_details['IsSubSection'] =='1'&& $section_details['ParentSectionID']!=''&& $section_details['ParentSectionID']!=0 ){
					$sub_section = $this->widget_model->get_sectionDetails($section_details['ParentSectionID'], $view_mode);
					$sub_section_name = ($sub_section['Sectionname']!='')? $sub_section['Sectionname'] : '' ;
					$sub_section_name1= $sub_section['URLSectionStructure'];
					 if($sub_section['IsSubSection'] =='1'&& $sub_section['ParentSectionID']!=''&& $sub_section['ParentSectionID']!=0 ){
					$grand_sub_section = $this->widget_model->get_sectionDetails($sub_section['ParentSectionID'], $view_mode);
					$grand_parent_section_name = $grand_sub_section['Sectionname'];
					$grand_parent_section_name1 = $grand_sub_section['URLSectionStructure'];
					$section_link = '<a href="'.$domain_name.'">'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$grand_parent_section_name1.'">'.$grand_parent_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$sub_section_name1.'">'.$sub_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$child_section_name1.'">'.$child_section_name.'</a>';
					}else{
					$section_link = '<a href='.$domain_name.' >'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$sub_section_name1.' >'.$sub_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$child_section_name1.' >'.$child_section_name.'</a>';
					}
					}elseif(strtolower($child_section_name) != "home"){
					$section_link = '<a href= '.$domain_name.' >'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$child_section_name1.' >'.$child_section_name.'</a>';
					}elseif(strtolower($child_section_name) == "home" || strtolower($child_section_name) == "home"){
					$section_link = '<a href= '.$domain_name.' >'.$home_section_name.'</a>';
					}
				  /*  edited to hide breadcrumb
				  echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				  echo '<div class="bcrums"> 
				   '.$section_link.'  </div>
				  </div>
				  </div>'; */
				  ?>
<script src="DWConfiguration/ActiveContent/IncludeFiles/AC_RunActiveContent.js" type="text/javascript"></script>


<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
    <?php 		
					//////  For Article title  ////		
					$content_title = $content_det['title'];
					if( $content_title != '')
					{
						//$content_title = stripslashes(preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $content_title));
						$content_title = stripslashes(strip_tags($content_title, '</p>'));
					}
					else
					{
						$content_title = '';
					}
                    $content_url = '';
					$page_index_number = '';
					if($content_type_id ==1){	
					$linked_to_columnist = $content_det['author_name'];
					$author_name    = $content_det['author_name'];
					$summary_html   = $content_det['summary_html'];
					$author_image   = $content_det['author_image_path'];
					$agency_name    = $content_det['agency_name'];
					$is_author      = ($content_det['author_name']!='')? 1 : 0;
					$is_agency      = ($content_det['agency_name']!='')? 1 : 0;
					$author_pos     = stripos($author_name, $child_section_name);
				   // $author_url     = ($author_pos === false)? "author/".join("-", explode(" ", $author_name)) : "columns/".join("-", explode(" ", $author_name));
					$author_url     = ($author_pos === false)? "author/".join("-", explode(" ", $author_name)) : $child_section_name1;
					$author_url_new     = 'authors/?q='.str_replace(' ','-',$author_name);
					}else{
					$is_author      = 0;
					$is_agency      = ($content_det['agency_name']!='')? 1 : 0;
					$author_name    = '';
					$agency_name    = $content_det['agency_name'];
					}
					
				   $published_date = date('dS  F Y ' , strtotime($content_det['publish_start_date']));
				   $last_updated_date  = date('dS  F Y ' , strtotime($content_det['last_updated_on']));
				   $allow_social_btn= 1; //$content_det['allow_social_button'];
				   $allow_comments= $content_det['allow_comments'];
				
				   $email_shared = 0; //$content_det['emailed'];
				   if ($email_shared > 999 && $email_shared <= 999999) {
					$email_shared = round($email_shared / 1000, 1).'K';
				   } else if ($email_shared > 999999) {
				   $email_shared = round($email_shared / 1000000, 1).'M';
				   } else {
					$email_shared = $email_shared;
				   }
				   $publish_start_date = $content_det['publish_start_date'];
					?>
    <h1 class="ArticleHead" id="content_head" itemprop="name"><?php echo $content_title;?></h1>
     <div class="straptxt"><?php echo $summary_html;?></div>
    <p class="ArticlePublish">
      
        
          <?php if($allow_social_btn==1) { ?>
    
    <?php  } ?>
    <!--  <?php  //if($content_type_id!= 1){ ?>
      Last Updated: <span><?php //echo $last_updated_date;?></span>&nbsp;&nbsp;
    <p></p>
    <?php //} ?>
    </p>
    <?php  //if($content_type_id=='1'){ ?>
    <p class="ArticlePublish margin-bottom-10"> Last Updated: <span><?php echo $last_updated_date;?></span>&nbsp;&nbsp;|&nbsp;&nbsp; <span class="FontSize" id="incfont" data-toggle="tooltip" title="Zoom In">A+</span><span class="FontSize" id="resetMe" data-toggle="tooltip" title="Reset">A&nbsp;</span><span class="FontSize" id="decfont" data-toggle="tooltip" title="Zoom Out">A-</span> <span id="print_article">&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-print"></i></span></p>
    <?php //} ?>
    <div class="vuukle-powerbar"></div>-->
    <?php  if($author_image!=''){?> 
   <div class="author_img"><img class="img-circle" alt="" src="<?php echo image_url.$author_image;?>"></div> 
   <div class="author_publish">
   <?php if($is_author==1 && $is_agency==1){ ?>
  <span class="author_name"><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> 

      <?php }else if($author_name!=''){ ?>
      <span class="author_name"><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> 
        
      <?php }else if($agency_name!=''){ ?>
      <span class="author_name"><?php echo $agency_name;?></span> 
       
      <?php } ?>
   <?php }
   else
   { ?>
  <div class="author_img"><img class="img-circle" alt="" src="http://www.cinemaexpress.com/images/static_img/no_author.jpg"></div> 
  <div class="author_publish">
  <?php if($is_author==1 && $is_agency==1){ ?>
      <span class="author_name"><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> 
       
      <?php }else if($author_name!=''){ ?>
     <span class="author_name"><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> 
        
      <?php }else if($agency_name!=''){ ?>
      <span class="author_name"><?php echo $agency_name;?></span> 
        

      <?php } ?>
   <?php
   } ?>
   <?php if($author_name!=''):  ?>
   &nbsp;&nbsp; | &nbsp;&nbsp; Published: <span><?php echo $published_date;?></span></p>
   <?php else: ?>
	 &nbsp;&nbsp; Published: <span><?php echo $published_date;?></span></p></div>
	 <?php endif; ?>
  </div>
</div>
<?php
	  
	/* ------------------------------------- Article content Type --------------------------------------------*/	
				  
	if($content_type_id=='1'){
	
	$article_body_text =  stripslashes($content_det['article_page_content_html']);	
	
	$Image600X390      = str_replace(' ', "%20", $content_det['article_page_image_path']);
	
	if (getimagesize(image_url . imagelibrary_image_path . $Image600X390) && $Image600X390 != '')
	{
	$imagedetails = getimagesize(image_url . imagelibrary_image_path.$Image600X390);
	$imagewidth = $imagedetails[0];
	$imageheight = $imagedetails[1];
	
	if ($imageheight > $imagewidth)
	{
		$Image600X390 	= $content_det['article_page_image_path'];
	}
	else
	{				
		//$Image600X390 	= str_replace("original","w600X390", $content_det['article_page_image_path']);
		$Image600X390 	= $content_det['article_page_image_path'];
	}
	$image_path='';
	
		$image_path = image_url. imagelibrary_image_path . $Image600X390;
		
	}
	else{
	$image_path='';
	$image_caption='';	
	}
	$show_image = ($image_path != '') ? $image_path : "no_image";
	$image_caption= $content_det['article_page_image_title'];
	$image_alt =  $content_det['article_page_image_alt'];
	$content_url       = base_url().$content_det['url'];
	$page_index_number = ($content_det['allow_pagination']==1)? $content['image_number'] : "no_pagination";
	$special_class     = (strtolower($section_details['Sectionname'])=="specials")? 'special_class': '';
	?>
<div class="Social_Font">
      <div class="PrintSocial">  <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="twitter" data-txt="<?php echo strip_tags($content_title);?>" data-via="NewIndianXpress" data-count="true"><i class="fa fa-twitter fa_social"></i></a></span> <span  class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="facebook" data-count="true"><i class="fa fa-facebook fa_social"></i></a></span> <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="google" data-lang="en" data-count="true"><i class="fa fa-google-plus fa_social"></i></a></span> <span class="Share_Icons PositionRelative"><i class="fa fa-envelope-o fa_social" id="popoverId"></i></span>
	  <span  class="Share_Icons">
			<a class="whatsapp" data-txt="<?php echo strip_tags($content_title);?>" data-link="<?php echo $article_url; ?>"  data-count="true">
			<i class="fa fa-whatsapp fa_social"></i></a>
	  </span>
        <div id="popover-content" class="popover_mail_form fade right in ">
          <div class="arrow"></div>
          <h3 class="popover-title">Share Via Email</h3>
          <div class="popover-content">
            <form class="form-inline Mail_Tooltip" action="<?php echo base_url(); ?>user/commonwidget/share_article_via_email" name="mail_share" method="post" id="mail_share" role="form">
              <div class="form-group">
                <input type="text" placeholder="Name" name="sender_name" id="name" class="form-control">
                <input type="text" placeholder="Your Mail" name="share_email" id="share_email" class="form-control">
                <input type="text" placeholder="Friends's Mail" name="refer_email" id="refer_email" class="form-control">
                <textarea placeholder="Type your Message" class="form-control" name="message" id="message"></textarea>
                <input type="hidden"  class="content_id" name="content_id" value="<?php echo $content_id;?>" />
                <input type="hidden"  class="section_id" name="section_id" value="<?php echo $section_id;?>" />
                <input type="hidden"  class="content_type_id" name="content_type_id" value="<?php echo $content_type_id;?>" />
                <input type="hidden"  class="article_created_on" name="article_created_on" value="<?php echo $publish_start_date;?>" />
                <input type="reset" value="Reset" class="submit_to_email submit_post">
                <!--<input type="submit" value="share" class="submit_to_email submit_post" name="submit">-->
                <input type="button" value="Share" id="share_submit" class="submit_to_email submit_post" onclick="mail_form_validate();" name="submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetailContent <?php echo $special_class;?>">
  <div id="content" class="content" itemprop="description">
    <?php if($show_image!='no_image'){ ?>
    <figure class="AticleImg open_image">
      <div class="image-Zoomin"><i class="fa fa-search-plus"></i><i class="fa fa-search-minus"></i></div>
      <img src="<?php echo $show_image;?>" title="<?php echo $image_caption;?>" alt="<?php echo $image_alt;?>" itemprop="image">
      <!-- <?php if($image_caption!=''){ ?>
     <p class="AticleImgBottom"><?php echo strip_tags($image_caption);?></p>
      <?php } ?>  -->
    </figure>
    <?php } ?>
     <div id="storyContent">
    <?php echo $article_body_text; ?> 
    </div>
	<?php
	
	$Rating=$this->widget_model->getReviews($content_id);
	if($Rating!=0 || $Rating >5){
		$review=[];
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
		echo '<div class="review-stars">';
		echo '<span>Rating:</span>';
			echo $review[$Rating];
		echo '</div>';
	
	}
	?>
	<!--<div class="review-stars">
		<span>Rating:</span>
		<i class="fa fa-star star-success" aria-hidden="true"></i>
		<i class="fa fa-star star-success" aria-hidden="true"></i>
		<i class="fa fa-star star-success" aria-hidden="true"></i>
		<i class="fa fa-star star-failure" aria-hidden="true"></i>
		<i class="fa fa-star star-failure" aria-hidden="true"></i>
	</div>-->
    </div>
 
  <!--<div class="pagination pagina">
    <ul>
      <li><a href="javascript:;" id="prev" class="prevnext element-disabled">« Previous</a></li>
      <li><a href="javascript:;" id="next" class="prevnext">Next »</a></li>
    </ul>
    <br />
  </div>-->
  <div class="text-center">
  <ul class="article_pagination" id="article_pagination">
    </ul></div>
  <div id="keywordline"></div>
</div>
<?php }
	/* ------------------------------------- Gallery content Type --------------------------------------------*/	
else if($content_type_id=='3'){ 
$get_gallery_images	 = $content_details;
$image_number        = $content['image_number'];
$content_url         = base_url().$content_details[0]['url'];
$page_index_number   = $content['image_number'];
$gallery_description = $content_det['summary_html'];
?>
<div class="row">
<p class="Gallery_description_summary"> <?php echo strip_tags($gallery_description);?></p>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 features">

<div class="gallery_detail_skin">
  <?php if(count($get_gallery_images)> 1){ ?>
  <div class="text-center play-pause-icon"> <span id="auto-play" class="cursor-pointer"><i class="fa fa-play" title="Play"></i> </span> </div>
  <?php } ?>
  
  <div class="slide GalleryDetail GalleryDetailSlide" style="width:100% !important">
    <?php foreach($get_gallery_images as $gallery_image){ 
                  $gallery_caption = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $gallery_image['gallery_image_title']);
				  $gallery_alt =  $gallery_image['gallery_image_alt'];
				  $Image600X390= str_replace(' ', "%20",$gallery_image['gallery_image_path']);
				  if (getimagesize(image_url . imagelibrary_image_path . $Image600X390) && $Image600X390 != '')
					{
				  $imagedetails = getimagesize(image_url . imagelibrary_image_path.$Image600X390);
					$imagewidth = $imagedetails[0];
                    $imageheight = $imagedetails[1];
					if ($imageheight > $imagewidth)
					{
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"';
					}else if($imagewidth > 600 && $imagewidth < 700) // minimum width image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"'; 
					}
					else if($imagewidth < 600) // minimum width image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"'; //'class="gallery_minimum_pixel"';
					}else  // normal image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = '';
					}
						$show_gallery_image = image_url. imagelibrary_image_path . $Image600X390;
					}else{
						$show_gallery_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
						$is_verticle        = '';
					}
                  ?>
    <div class="item">
      <figure class="PositionRelative"> <img src="<?php echo $show_gallery_image;?>" title="<?php echo $gallery_caption;?>" alt="<?php echo $gallery_alt;?>" <?php echo $is_verticle;?>>
       <?php if($gallery_caption!=''){ ?>
        <div class="TransLarge Font14"><?php echo $gallery_caption;?></div>
         <?php  } ?> 
      </figure>
    </div>
	 
    <?php 
					 } ?>
	
  </div>
  
  </div>
  <?php if(count($get_gallery_images)> 1){ ?>
  <div class="text-center">
    <ul class="gallery_pagination" id="gallery_pagination">
    </ul>
  </div>
  <?php } ?>
    <script>
var currentimageIndex = "<?php echo (($image_number)> count($get_gallery_images))? 1: $image_number;  ?>";
var TotalIndex = "<?php echo (count($get_gallery_images));  ?>";
$( document ).ready(function() {
$('html').addClass('gallery_video_remodal');
<?php if(($image_number) > 1 ){ ?>
 $('.GalleryDetailSlide').slick('slickGoTo', <?php echo $image_number-1;?>);
<?php } ?>
});
</script>
  <div id="keywordline"></div>
</div>
<?php 
							}
						/* ------------------------------------- Video content Type --------------------------------------------*/	
							else if($content_type_id=='4')
							{    
							 $video_scipt       = htmlspecialchars_decode($content_det['video_script']);
							 $video_description = $content_det['summary_html'];
							 $content_url       = base_url().$content_det['url'];
						?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="videodetail" style="text-align: center;">
    <?php if($content_det['video_site']=='ventunovideo'){ 
	//$video_scipt = trim(stripslashes($video_scipt),'"');
	?>
    <script type="text/javascript">
AC_FL_RunContent( 'width','630','height','441','id','ventuno_player_0','src','http://cfplayer.ventunotech.com/player/vtn_player_2?vID==<?php echo $video_scipt;?>','wmode','transparent','allownetworking','all','allowscriptaccess','always','allowfullscreen','true','movie','http://cfplayer.ventunotech.com/player/vtn_player_2?vID==<?php echo $video_scipt;?>' ); //end AC code
</script><noscript><object width="630" height="441" id="ventuno_player_0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
      <param name="movie" value="http://cfplayer.ventunotech.com/player/vtn_player_2.swf?vID==<?php echo $video_scipt;?>"/>
      <param name="allowscriptaccess" value="always"/>
      <param name="allowFullScreen" value="true"/>
      <param name="wmode" value="transparent"/>
      <embed src="http://cfplayer.ventunotech.com/player/vtn_player_2.swf?vID==<?php echo $video_scipt;?>" width="630" height="441" 
wmode="transparent" allownetworking="all" allowscriptaccess="always" allowfullscreen="true"></embed>
    </object></noscript>
    <?php }else{
		echo $video_scipt;
	}
		 ?>
  </div>
  <p> <?php echo $video_description;?></p>
  <div id="keywordline"></div>
</div>
<script>
						 $( document ).ready(function() {
						 $('html').addClass('gallery_video_remodal');
						});
						</script>
<?php 
							}
					/* ------------------------------------- Audio content Type --------------------------------------------*/	
							else 
							{ 
							 $audio_path       = image_url. audio_source_path.$content_det['audio_path'];
							 $audio_description = $content_det['summary_html'];
							 $content_url       = base_url().$content_det['url'];
							?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="">
      <audio class="margin-left-10 margin-top-5" controls="" src="<?php echo $audio_path;?>"> </audio>
      <p> <?php echo $audio_description;?></p>
    </div>
    <div id="keywordline"></div>
  </div>
  <?php	}
}?>
  <?php 
			  $article_tags= $content_det['tags'];
              $get_tags =array();
			  if($article_tags!='')
			  $get_tags=  explode(",", $article_tags);
			  if(count($get_tags)>0){
			   ?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
    <div class="tags">
      <div> <span>TAGS</span> </div>
      <?php foreach($get_tags as $tag){
		             if($tag!=''){
				     $tag_title = join( "_",( explode(" ", trim($tag) ) ) );
		             $tag_url_title = preg_replace('/[^A-Za-z0-9\_]/', '', $tag_title); 

							$tag_link = base_url().'topic/'.$tag_url_title; 
                            echo '<a href="'.$tag_link.'">'.$tag.'</a>';
					       }
                            } ?>
    </div>
  </div>
  <?php }  ?>
</div>
<div class="Social_Font">
      <div class="PrintSocial">  <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="twitter" data-txt="<?php echo strip_tags($content_title);?>" data-via="NewIndianXpress" data-count="true"><i class="fa fa-twitter fa_social"></i></a></span> <span  class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="facebook" data-count="true"><i class="fa fa-facebook fa_social"></i></a></span> <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="google" data-lang="en" data-count="true"><i class="fa fa-google-plus fa_social"></i></a></span> <span class="Share_Icons PositionRelative"><i class="fa fa-envelope-o fa_social" id="popoverId"></i></span>
	   <span  class="Share_Icons">
			<a class="whatsapp" data-txt="<?php echo strip_tags($content_title);?>" data-link="<?php echo $article_url; ?>"  data-count="true">
			<i class="fa fa-whatsapp fa_social"></i></a>
	  </span>
        <div id="popover-content" class="popover_mail_form fade right in ">
          <div class="arrow"></div>
          <h3 class="popover-title">Share Via Email</h3>
          <div class="popover-content">
            <form class="form-inline Mail_Tooltip" action="<?php echo base_url(); ?>user/commonwidget/share_article_via_email" name="mail_share" method="post" id="mail_share" role="form">
              <div class="form-group">
                <input type="text" placeholder="Name" name="sender_name" id="name" class="form-control">
                <input type="text" placeholder="Your Mail" name="share_email" id="share_email" class="form-control">
                <input type="text" placeholder="Friends's Mail" name="refer_email" id="refer_email" class="form-control">
                <textarea placeholder="Type your Message" class="form-control" name="message" id="message"></textarea>
                <input type="hidden"  class="content_id" name="content_id" value="<?php echo $content_id;?>" />
                <input type="hidden"  class="section_id" name="section_id" value="<?php echo $section_id;?>" />
                <input type="hidden"  class="content_type_id" name="content_type_id" value="<?php echo $content_type_id;?>" />
                <input type="hidden"  class="article_created_on" name="article_created_on" value="<?php echo $publish_start_date;?>" />
                <input type="reset" value="Reset" class="submit_to_email submit_post">
                <!--<input type="submit" value="share" class="submit_to_email submit_post" name="submit">-->
                <input type="button" value="Share" id="share_submit" class="submit_to_email submit_post" onclick="mail_form_validate();" name="submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
                                
</article>
<div class="NextArticle FixedOptions" style="display:none;">
  <?php
					//$time1 = microtime(true);
					$prev_article = $this->widget_model->get_section_previous_article($content['content_id'], $content_det['section_id'],$content_type_id);
					$next_article = $this->widget_model->get_section_next_article($content['content_id'], $content_det['section_id'],$content_type_id);
										
//$time2 = microtime(true);
//echo "script execution time: ".($time2-$time1); //value in seconds				

					//print_r($select_section_prev_article);exit;
					?>
  <?php if(count($prev_article)> 0){
					$prev_content_id = $prev_article['content_id'];
					$prev_section_id = $prev_article['section_id'];
					$param = $content['close_param'];
					$prev_string_value = $domain_name.$prev_article['url'].$param;
	                 ?>
  <a class="prev_article_click LeftArrow" href="<?php echo $prev_string_value;?>" title="<?php echo strip_tags($prev_article['title']);?>"><i class="fa fa-chevron-left"></i></a>
  <?php } ?>
  <?php if(count($next_article)> 0){
					$next_content_id = $next_article['content_id'];
					$next_section_id = $next_article['section_id'];
					$param = $content['close_param'];
					$next_string_value = $domain_name.$next_article['url'].$param;
					?>
  <a class="next_article_click RightArrow" href="<?php echo $next_string_value;?>" title="<?php echo strip_tags($next_article['title']);?>"><i class="fa fa-chevron-right"></i></a>
  <?php } ?>
 <?php //$bitly = getSmallLink($content_url); 
       $bitly_url = "";//$bitly['id'];
	   $bitly_message = "";//$bitly['msg'];
 ?>
</div>
<!--style overwriting editor body content-->
<style>
.ArticleDetailContent li{float: none; list-style: inherit;}
.ArticleDetailContent blockquote {
    padding-left: 20px !important;
    padding-right: 8px !important;
    border-left-width: 5px;
    border-color: #ccc;
    font-style: italic;
	margin:10px 0 !important;
	padding: 12px 16px !important;
	font-size:13px !important;
}
.ArticleDetailContent blockquote p{font-size:13px !important;text-align:center;}
@media screen and ( max-width: 768px){
 audio { width:100%;}
}
</style>
<script type="text/javascript">
            $(document).ready(function() {
                $('.whatsapp').on("click", function(e) {
                    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

                        var article = $(this).attr("data-txt");
                        var weburl = $(this).attr("data-link");
                        var whats_app_message = article +" - "+weburl;
                        var whatsapp_url = "whatsapp://send?text="+whats_app_message;
                        window.location.href= whatsapp_url;
						//alert(whatsapp_url);
                    }/* else{
                        alert('you are not using mobile device.');
                    } */
                });
            });
</script>
<script type="text/javascript">
	var base_url        = "<?php echo base_url(); ?>";
	var content_id      = "<?php echo $content_id; ?>";
	var content_type_id = "<?php echo $content_type_id; ?>";
	var page_Indexid    = "<?php echo $page_index_number; ?>";
	var section_id      = "<?php echo $section_id; ?>";
	//location.reload(true);
	var content_url     = "<?php echo $content_url; ?>";
	var page_param      = "<?php echo $content['page_param']; ?>";
	var content_from    = "<?php echo $content['content_from']; ?>";
	var bitly_url       = "<?php echo $bitly_url;?>";
	var bitly_message   = "<?php echo $bitly_message;?>";
</script>
<div class="recent_news" style="display:none;">
<div id="topover" class="slide-open" style="visibility: hidden;">
  <p>O<br>
    P<br>
    E<br>
    N</p>
</div>
</div>
<script src="<?php echo image_url; ?>js/FrontEnd/js/remodal-article.js"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script id="dsq-count-scr" src="//www-edexlive-com.disqus.com/count.js" async></script>
<?php //echo "open me";exit;?>
