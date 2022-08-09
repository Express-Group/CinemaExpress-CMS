<?php
//WIDGET CONFIGURATION
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$widget_section_url  = $content['widget_section_url'];
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$view_mode           = $content['mode'];
$render_mode         = $content['RenderingMode'];
$max_article         = 5;

//END;

//WIDGET DYNAMIC ATTRIBUTES
$AuthorId=str_replace('-',' ',$_GET['q']);
$Type=(isset($_GET['t']) && $_GET['t']!='')?$_GET['t']:0;
$AuthorDetails=$this->widget_model->GetAuthorDetailsById($AuthorId,$Type);
$AuthorName=$AuthorDetails[0]->AuthorName;
$columnnist_articles_list = $this->widget_model->get_Stories_For_Author('10', $AuthorId, $content['mode'],$AuthorName);
//print_R($columnnist_articles_list);

$FaceBook='https://www.facebook.com/XpressCinema';
$Twitter='https://twitter.com/XpressCinema';
$Instagram='https://www.instagram.com/newindianexpress/';

$this->live_db = $this->load->database('live_db', TRUE);
$TotalRows = $this->live_db->query("SELECT content_id FROM article WHERE status='P' AND author_name='".$AuthorName."'")->num_rows();
$config=['base_url'=>$content['widget_section_url'],'total_rows'=>$TotalRows,'per_page'=>15,'num_links'=>4,'page_query_string'=>TRUE,'reuse_query_string'=>FALSE,'suffix'=>'&q='.$_GET['q'],'cur_tag_open'=>'<a class="active">','cur_tag_close'=>'</a>','use_page_numbers'=>TRUE,'first_url'=>$content['widget_section_url'].'?q='.$_GET['q'],'first_link'=>FALSE,'last_link'=>FALSE];
$row=(isset($_GET['per_page']) && $_GET['per_page'])?$_GET['per_page']:0;
$this->pagination->initialize($config);
$pagination=$this->pagination->create_links();
//$columnnist_articles_list = $this->widget_model->get_Stories_For_Author('10', $AuthorId, $content['mode'],$AuthorName);
$columnnist_articles_list = $this->live_db->query("SELECT content_id FROM article WHERE status='P' AND author_name='".$AuthorName."' ORDER BY content_id DESC LIMIT ".$row.", 15")->result_array();
//ATTRIBUTES ENDS..
?>
<div class="row author-panel">
	<div class="col-md-6 col-ls-6 col-xs-12 col-sm-12 author-img-rotate img-circle">
	<?php
	$ImagePath=BASEURL.$AuthorDetails[0]->image_path;
	if(empty($AuthorDetails[0]->image_path)):
		$ImagePath=base_url('images/static_img/author_noimage.png');
	endif;
	?>
		<img src="<?php print $ImagePath?>" class="img-circle img-responsive" style="border-radius: 50%; height: 150px; width: 150px;    object-fit: cover; border: 3px solid red; box-shadow: 0 0 5px;">
	</div>
	<div class="col-md-6 col-ls-6 col-xs-12 col-sm-12">
		<h2 class="author-panel-heading" style="color:#ed1c24"><span><?php print $AuthorDetails[0]->AuthorName?></span></h2>
			<div class="col-md-12 p13">
			<?php if($AuthorDetails[0]->Email!=''): ?>
				<p >Email ID : <?php print $AuthorDetails[0]->Email?></p>
			<?php endif; if(strlen($AuthorDetails[0]->mobile) > 3):  ?>
				<p>Phone Number : <?php print $AuthorDetails[0]->mobile?></p>
			<?php endif;?>
			</div>
			<div class="author-social">
				<a href="<?php ($AuthorDetails[0]->facebook=='')? print $FaceBook : print $AuthorDetails[0]->facebook;?>" class="link facebook" target="_blank"><span class="fa fa-facebook-square"></span></a>
				<a href="<?php ($AuthorDetails[0]->twitter=='')? print $Twitter : print $AuthorDetails[0]->twitter; ?>" class="link twitter" target="_blank"><span class="fa fa-twitter"></span></a>
				<a href="<?php ($AuthorDetails[0]->instagram=='')? print $Instagram : print $AuthorDetails[0]->instagram;?>" class="link google-plus" target="_blank"><span class="fa fa-instagram"></span></a>
			</div>
			
	</div>

	<div class="col-md-12">
		<?php if($AuthorDetails[0]->ShortBiography !=''): ?>
		<p class="bio-hr"></p>
		<p class="bio-title">Biography:</p>
		<p class="bio-content"><?php print stripslashes($AuthorDetails[0]->ShortBiography); ?></p>
		<?php endif; ?>
	</div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="main_column">
      <h4 class="Authorname"><?php echo $author_name;?></h4>
      <div class="current all_column">
        <?php
		  if(count($columnnist_articles_list)>0 && $AuthorId!=''){
		 foreach($columnnist_articles_list as $article_list){ 
			  $content_type =1 ;
              $content_details = $this->widget_model->get_contentdetails_from_database($article_list['content_id'], $content_type, $is_home, $view_mode);
				$custom_title        = "";
				$custom_summary      = "";
				$original_image_path = "";
				$imagealt            = "";
				$imagetitle          = "";																
				
				$content_url = $content_details[0]['url'];
				$param = $content['close_param']; //page parameter
				$live_article_url = $domain_name. $content_url.$param;
			
				if( $custom_title == '')
				{
					$custom_title = stripslashes($content_details[0]['title']);
				}	
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
								
				if( $custom_summary == '')
				{
					$custom_summary =  $content_details[0]['summary_html'];
				}
				$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
			?>
        <div class="sub_column"> <i class="fa fa-chevron-right"></i>
          <div class="ColumnList">
            <h5><a class="article_click" href="<?php echo $live_article_url; ?>" ><?php echo $display_title;?></a></h5>
            <p class="column_det summary"><?php echo $summary;?></p>
            <p class="post_time">
              <?php $time= $content_details[0]['last_updated_on'];
				 $post_time= $this->widget_model->time2string($time); echo $post_time;?>
              </p>
          </div>
        </div>
        <?php } 
		  echo '<div class="pagina">'.$pagination.'</div>';
		  }?>
      </div>
    </div>
  </div>
</div>

