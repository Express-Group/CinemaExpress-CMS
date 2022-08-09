<style>
@font-face {
  font-family: 'Lato-Regular';
  src: 
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/Lato-Regular/Lato-Regular.eot?#iefix') format('embedded-opentype'),  
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/Lato-Regular/Lato-Regular.woff') format('woff'), 
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/Lato-Regular/Lato-Regular.ttf')  format('truetype'), 
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/Lato-Regular/Lato-Regular.svg#Lato-Regular') format('svg');
  font-weight: normal;
  font-style: normal;
}
@font-face {
  font-family: 'SourceSansPro-Regular';
  src: 
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/SourceSansPro-Regular/SourceSansPro-Regular.eot?#iefix') format('embedded-opentype'),  
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/SourceSansPro-Regular/SourceSansPro-Regular.woff') format('woff'), 
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/SourceSansPro-Regular/SourceSansPro-Regular.ttf')  format('truetype'), 
  url('<?php echo base_url(); ?>css/FrontEnd/fonts/SourceSansPro-Regular/SourceSansPro-Regular.svg#Roboto-Regular') format('svg');
  font-weight: normal;
  font-style: normal;
}
@media only screen and (max-width: 1550px) and (min-width: 1297px){
 .container, .remodal.main-menu {
    width: 900px;
}
}
#preview_article_popup{
	display: block;

}
.remodal-overlay {
    background-color: #000 !important;
}
.remodal-overlay:after{
display:inline;
}
#preview_article_popup .ArticleDetailContent {
    font-family: SourceSansPro-Regular !important;
}
#preview_article_popup .ArticleHead{
font-family:Lato-Regular;
font-weight:bold !important;
}
#preview_article_popup .pagination{
background:none;
box-shadow:none;
width:auto;
margin: 0 !important;
padding-right: 0;
}
#preview_article_popup .SectionContainer{
	overflow:hidden;
}
#preview_article_popup .page{
	background:#fff !important;
	color:#000 !important;
	font-weight:normal;
}
#preview_article_popup .article_pagination{
	width:80%;
    
}
#preview_article_popup #auto-play .fa-pause{
	margin:0;
}
#preview_article_popup #auto-play i{
	
	font-size:12px;
}
@media only screen and (max-width: 1550px) and (min-width: 1297px){

#preview_article_popup{
	display: block;
    background: none;
    box-shadow: none;
    width: 918px;
    margin: auto 182px;
}
}
#preview_article_popup .VideoScriptContent{
	margin-bottom:30px;
}
#preview_article_popup .play-pause-icon {
    background: #fff none repeat scroll 0 0;
    border: 2px solid #ccc;
    border-radius: 100%;
    height: 27px;
    padding: 5px 0;
    position: absolute;
    right: 24px;
    top: 10px;
    width: 28px;
    z-index: 999;
}
#preview_article_popup p {
	line-height:1.3; 
}
#preview_article_popup .page{
padding:0;
margin:0;
}
#preview_article_popup .pagination a{
	font-size:12px;
		float: left;
		padding: 6px 10px;	
}
#preview_article_popup li{
	float: none; list-style: inherit;
	margin-left: 30px;
}

#preview_article_popup blockquote {
     padding-left: 20px !important;
    padding-right: 8px !important;
    border-left-width: 5px;
    border-color: #ccc;
    font-style: italic;
	margin: 10px 0 10px 20px!important;
 padding: 12px 16px !important;
 font-size:13px !important;
}
#preview_article_popup  blockquote p{font-size:16px; !important;text-align:auto; }
#preview_article_popup li a{ float:none}
</style>


<section>	
  <div class="container SectionContainer "> 
  <div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="bcrums"> 
       <a href="javascript:void(0);">Home</a> <i class="fa fa-angle-right"></i>
	<?php if(isset($url_structure) && $url_structure != '') { 
	$array_structure = explode("/",$url_structure);
	foreach($array_structure as $key=>$structure) { ?>
		  <a href="javascript:void(0);"><?php echo $structure; ?></a> 
		  <?php if(isset($array_structure[$key+1])) { ?>
		  <i class="fa fa-angle-right"></i>
	<?php } }
	
		
	} ?>

	   </div>
      </div>
      </div>
                 <div class="row">
    
        <div class="<?php if($content_type == 1) { echo "col-lg-7 col-md-7"; } else { echo "col-lg-12 col-md-12"; }?> col-sm-12 col-xs-12 ColumnSpaceRight">
      <!--  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
      <div class="bcrums"> <a href="javascript:void(0);">Home</a> <i class="fa fa-angle-right"></i> <a href="#">Gallery</a> </div>
      </div>
      </div> -->
      
        <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
      <h1 class="ArticleHead"><?php if(trim(strip_tags($article_headline)) != '') echo $article_headline; else echo "<p> Please give the HeadLine </p>"; ?></h1>
	  
	 <?php if($content_type == 1) { ?>
	 <p>
      	
             <div class=""> <div class="author_img"><img class="img-circle" alt="" src="http://staging.cinemaexpress.com/images/static_img/no_author.jpg"></div> 
  <div class="author_publish"><span class="author_name"><a href="<?php echo base_url().$author_url;?>" target="_blank"><?php echo ucfirst($author_name); ?></span>
</a>&nbsp;&nbsp;|&nbsp;&nbsp;<span><?php echo $agency_name;?></span></div></div></p>
      <p style="color: #000;padding: 0px;font-size: 11px !important;text-align: left !important;margin: 10px 0 0 0;float: left;width: auto;line-height: 20px !important;"><?php if($author_name != '') { ?> <?php } ?></span><?php if($publishdate != '') { ?> Published:<span> <?php echo $publishdate; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?> </p>
	  
	 <?php } else { ?>
	 
      <p>
      	
             <div class=""></div><span class="author_name"><a href="<?php echo base_url().$author_url;?>" target="_blank"><?php echo ucfirst($author_name); ?></span>
</a>&nbsp;&nbsp;|&nbsp;&nbsp;<span><?php echo $agency_name;?></span></div></div></p><p style="color: #000;padding: 0px;font-size: 11px !important;text-align: left !important;margin: 10px 0 0 0;float: left;width: auto;line-height: 20px !important;"><?php if($author_name != '') { ?> <?php } ?></span><?php if($publishdate != '') { ?> Published:<span> <?php echo $publishdate; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?></p>
	  
	 <?php } ?>
      

			     <div class="Social_Font">
      <div class="PrintSocial">  <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="twitter" data-txt="<?php echo strip_tags($content_title);?>" data-via="NewIndianXpress" data-count="true"><i class="fa fa-twitter fa_social"></i><span class="csbuttons-count">0</span></a></span> <span  class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="facebook" data-count="true"><i class="fa fa-facebook fa_social"></i><span class="csbuttons-count">0</span></a></span> <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="google" data-lang="en" data-count="true"><i class="fa fa-google-plus fa_social"></i><span class="csbuttons-count">0</span></a></span> <span class="Share_Icons PositionRelative"><i class="fa fa-envelope-o fa_social" id="popoverId"></i></span>
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
      
      </div>
      </div>
	  
  
	  
      <div class="row">
	  
	  	<?php if($content_type == 1) { ?>
		
		<!--<script type="text/javascript">
		$(document).ready(function(){
			  $("iframe").width('100%');
		$("table").width('98%');
		});
		</script> -->
      
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetailContent" >
	    <div id="content" class="content" itemprop="description">
	  <?php if($article_image != '') { ?>
      <figure class="AticleImg open_image">
     <div class="image-Zoomin"><i class="fa fa-search-plus"></i><i class="fa fa-search-minus"></i></div>
      <img src="<?php echo @$article_image; ?>">
	    <?php if(isset($caption) && trim($caption) != '') { ?>
      <p class="AticleImgBottom"><?php echo @$caption; ?></p>
	    <?php } ?>
      </figure>
      <?php } ?>
      <div id="storyContent">
	   <?php if(trim(strip_tags($body_text)) != '') echo @$body_text; else echo "<p> Please give the Article Body Text </p>"; ?>
       </div>
	   </div>
		</div>
		
		<?php if(!empty($related_article)) { ?>
		 <ul class="RelatedArticle" style="display:none;">
        <div class="RelatedArt">Related Article</div>
			<?php foreach($related_article as $article) { 
		  if($article->type == 'I') {?>
		  <li><a href="javascript:void(0);"><i class="fa fa-angle-right"></i><?php echo $article->long_title; ?></a></li>
		  <?php } else { ?>
			<li><a href="javascript:void(0);"><i class="fa fa-angle-right"></i><?php echo $article->external_title; ?></a></li>  
		  <?php }} ?>
		</ul>
		
		<?php } ?>
		<div class="text-center">
		  <ul class="article_pagination" id="article_pagination">
    </ul>
	</div>
  <div id="keywordline"></div>
		
		<?php  }  elseif($content_type == 3) { ?>
		
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 features">
  <div class="slide GalleryDetail GalleryDetailSlide" style="width:100% !important">
    <?php 
	foreach($gallery_images as $gallery_image){ 
                  ?>
    <div class="item">
      <figure class="PositionRelative"> <img src="<?php echo $gallery_image['source'];?>" title="<?php echo $gallery_image['caption'];;?>" alt="<?php echo $gallery_image['alt'];?>" <?php echo $gallery_image['is_verticle'];?>>
	  <?php if($gallery_image['caption'] && $gallery_image['caption'] != '') { ?>
        <div class="TransLarge Font14"><?php echo $gallery_image['caption'];?></div>
	  <?php } ?>
      </figure>
    </div>
    <?php 
	 } ?>
  </div>
  	<?php if(count($gallery_images)> 1){ ?>
  <div class="text-center play-pause-icon">
  <span id="auto-play" class="cursor-pointer"><i class="fa fa-play" title="Play"></i>
</span><!--|<span id="pause" class="cursor-pointer" style="color:red;"><i class="fa fa-pause"></i>
</span>-->
  </div>
  <div class="text-center">
    <ul class="gallery_pagination" id="gallery_pagination">
    </ul>
  </div>
             <?php } 
			 $image_number = 1;
			 ?>
  <div id="keywordline"></div>
</div>
		  <script type="text/javascript">
		  
			 $(document).ready(function() {
							 
			$('html').addClass('gallery_video_remodal');					
					$(document).click(".slick-next", function(){
					var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
				  console.log(currentSlide);
				  var index = currentSlide+1;
				  $('#gallery_pagination').twbsPagination("show", currentSlide+1);
				});
				$(document).click(".slick-prev", function(){
				var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
				  if(currentSlide==0){
				  $('#gallery_pagination').twbsPagination("show", currentSlide+1);
				  }else{
				   $('#gallery_pagination').twbsPagination("show", currentSlide+1);
				  }
				}); 
              
				var clicked = false;
				$("#auto-play").click(function(){
					if (clicked) {
						$(this).find('i').attr('title','Play');
						$(this).find('i').toggleClass('fa-play fa-pause');
						$('.GalleryDetailSlide').slick('slickPause');
						$('.GalleryDetailSlide').unbind('beforeChange');
						clicked = false;
					}
					else {
						$(this).find('i').attr('title','Pause');
						$(this).find('i').toggleClass('fa-play fa-pause');
						$('.GalleryDetailSlide').slick('slickPlay', true);
						$('.GalleryDetailSlide').on('beforeChange', function(event, slick, currentSlide, nextSlide){
							console.log(nextSlide+1);
							// $('#gallery_pagination').bootstrapPaginator("show", nextSlide+1);
							 $('#gallery_pagination').twbsPagination("show", nextSlide+1);

						});
						  clicked = true;
					}
				});
				
				$('.GalleryDetailSlide').on('swipe', function(event, slick, direction){
				  console.log(direction);
				  console.log(slick);
				  if(direction=='left'){
					 var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
				  console.log(currentSlide);
				  $('#gallery_pagination').twbsPagination("show", currentSlide+1); 
				  }else if(direction=='right'){
					 var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
				  console.log(currentSlide);
				  if(currentSlide==0){
				 $('#gallery_pagination').twbsPagination("show", currentSlide+1);
				  }else{
				$('#gallery_pagination').twbsPagination("show", currentSlide+1);
				  } 
				  }
				
				});
				
				<?php if(count($gallery_images)> 1){ ?>
				
				<?php } ?>
					
	});
						
						
						</script>
		
			
		<?php  }  elseif($content_type == 4) { ?>
		
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class=" VideoScriptContent videodetail" style="text-align: center;"> <?php echo $script;?>
      <p> <?php echo $body_text;?></p>
    </div>
    <div id="keywordline"></div>
  </div>
		
		<?php } elseif($content_type == 5) { ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="GalleryDetail"> <audio class="margin-left-10 margin-top-5" controls="" src="<?php echo $script;?>">
		</audio>
      <p> <?php echo $body_text;?></p>
    </div>
    <div id="keywordline"></div>
  </div>	
						
		<?php } ?>
		
		
		<!-- condition end -->
		
		
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
				<!--<div class="pagina">
                <div> <a href="javascript:void(0);"><i class="fa fa-angle-double-left"></i></a> <a href="javascript:void(0);"><i class="fa fa-angle-left"></i></a> <a class="active" href="javascript:void(0);">1</a> <a href="javascript:void(0);">2</a> <a href="javascript:void(0);">3</a> <a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a> <a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i></a> </div>
              </div> -->
			  
			  		  <?php
			$tags = array_filter($tags);
			  if(!empty($tags)) { ?>
              <div class="tags">
                            <div>
                            <span>TAGS</span>
                            </div>
                            <?php foreach($tags as $article_tags) {  ?>
                            <a href="javascript:void(0);"><?php echo $article_tags; ?></a>
							 <?php } ?>
                            </div>
							
							  <?php } ?>
      </div>
	  
	  <!-- common tag content -->
	  
	  
      </div>
    
                 </div>
				 
				 <!-- staic content condition -->
				 
				 	<?php if($content_type == 1) { ?>
				 
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="ad300"> <img src="<?php echo base_url(); ?>/images/admin/template_design/images/widget_images/add_300_250-small.jpg"> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom-space-10">
          <fieldset class="FieldTopic">
<legend class="topic">Most Popular</legend>
</fieldset>
            <div class="most">
              <div class="most1"> <img src="<?php echo base_url(); ?>images/admin/article-popup/img1.jpg">
                <p><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
              </div>
              <div class="most1"> <img src="<?php echo base_url(); ?>images/admin/article-popup/img2.jpg">
                <p><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
              </div>
              <div class="most1"> <img src="<?php echo base_url(); ?>images/admin/article-popup/img3.jpg">
                <p><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
              </div>
              <div class="most1"> <img src="<?php echo base_url(); ?>images/admin/article-popup/img4.jpg">
                <p><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
              </div>
            </div>
          </div>
        </div>
        
        
  
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom-space-10">
            <div class="GalleryVideo">
                 <fieldset class="FieldTopic">
<legend class="topic"><a href="javascript:void(0);">Gallery</a></legend>
</fieldset>
              <div class="g_whole">
                 <figure class="PositionRelative NewGallery">
                <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/admin/article-popup/img2.jpg">
                <img class="GalleryIcon" src="<?php echo base_url(); ?>images/FrontEnd/images/gallery-icon.png">
                </a>
                <div class="TransSmall"><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></div>
                </figure>
                <figure class="PositionRelative NewGallery">
                <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/admin/article-popup/img1.jpg">
                <img class="GalleryIcon" src="<?php echo base_url(); ?>images/FrontEnd/images/gallery-icon.png"></a>
                <div class="TransSmall"><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></div>
                </figure>
              </div>
              
              
            </div>
              <div class="arrow_right"><a class="landing-arrow" href="javascript:void(0);">arrow</a></div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom-space-10">
            <div class="GalleryVideo">
                 <fieldset class="FieldTopic">
<legend class="topic"><a href="javascript:void(0);">Video</a></legend>
</fieldset>
              <div class="g_whole">
                 <figure class="PositionRelative NewGallery">
                <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/admin/article-popup/img4.jpg">
                <img class="SmallPlay" src="<?php echo base_url(); ?>images/FrontEnd/images/play-circle.png">                </a>
                <div class="TransSmall"><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></div>
                </figure>
                <figure class="PositionRelative NewGallery">
                <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/admin/article-popup/img3.jpg">
                <img class="SmallPlay" src="<?php echo base_url(); ?>images/FrontEnd/images/play-circle.png"></a>
                <div class="TransSmall"><a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></div>
                </figure>
              </div>
              
              
            </div>
              <div class="arrow_right"><a class="landing-arrow" href="javascript:void(0);">arrow</a></div>
          </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="accordion">
                        <div class="panel-group" id="accordion1">
                          <div class="panel panel-default">
                            <div class="panel-heading active">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="javascript:void(0);accordion1" href="javascript:void(0);collapseOne1">
                                 Editor Pick
                                  <i class="fa fa fa-chevron-up pull-right"></i>
                                  <i class="fa fa fa-chevron-down pull-right"></i>
                                </a>
                              </h3>
                            </div>

                            <div id="collapseOne1" class="panel-collapse collapse in">
                              <div class="panel-body common_p">
                                        
                                        <p> <i class="fa fa-angle-right"></i> <a href="javascript:void(0);"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
                <p> <i class="fa fa-angle-right"></i> <a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
                <p> <i class="fa fa-angle-right"></i> <a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
                <p> <i class="fa fa-angle-right"></i> <a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
                <p> <i class="fa fa-angle-right"></i> <a href="javascript:void(0);">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></p>
                                        </div>
                            </div>
                          </div>
                        </div><!--/javascript:void(0);accordion1-->
                    </div>
                    </div>
                    </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <!-- <div class="ad300"> <img src="<?php echo base_url(); ?>/images/admin/template_design/images/widget_images/add_300_250-small.jpg"> </div> -->
          </div>
        </div>
      </div>
	  
					<?php } ?>
	  <!-- end condition -->
	  
        </div>
   
                 </div>
                 </section>
				 	<script type="text/javascript">

$(document).ready(function() {
	
	
	
	 $("#content p:eq(2)").after($('.RelatedArticle').show());
	
    $('#incfont').click(function() {
        $('.ArticleDetailContent p').css("font-size", function() {
			var curSize = parseInt($(this).css('font-size')) + 1 ;
			if(curSize<=25){
            return curSize;
			}
			else{ return $(this).css('font-size','25px'); }
        });
    });
	 $('#decfont').click(function() {
        $('.ArticleDetailContent p').css("font-size", function() {
            var curSize = parseInt($(this).css('font-size')) - 1 ;
			if(curSize>=12){
            return curSize;
			}
			else{ return $(this).css('font-size','12px'); }
        });
    });
	$('#resetMe').click(function(){
		$('.ArticleDetailContent p').css('font-size','15px');
	});
	
	/*show fullimage*/
$('.AticleImg').click(function () {
    $(".AticleImg").toggleClass('open_image');
 });

   $("#mail_form_show").click(function(){
                $(".PrintSocial .popover").toggleClass('mail_sharing_open');
              }); 
	
});
  </script>
  <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>