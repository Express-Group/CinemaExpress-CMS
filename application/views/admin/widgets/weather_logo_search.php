<div class="row">
<style>
.gsc-control-cse{ font-family: Arial, sans-serif; border:0px solid #fff !important; background-color:transparent !important; margin-top:64px; }
.gsc-search-box-tools .gsc-search-box .gsc-input{ padding-right:0 !important; }
.gsc-input-box{ border:1px solid #D9D9D9; background:#fff; height:25px; width:70%; float:right;}
.cse .gsc-search-button input.gsc-search-button-v2, input.gsc-search-button-v2{width: 26px !important; height: 25px !important;padding: 6px !important;margin: 3px 0 0 0 !important;}
input.gsc-search-button, input.gsc-search-button:hover, input.gsc-search-button:focus{border-color: #f0b660 !important;background-color: #f0b660!important;}
.gsc-input{background:none !important;}
@media only screen and (min-width:1551px) {
.gsc-input-box {width:60%; }
}
</style>
<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$is_home = $content['is_home_page'];
$view_mode = $content['mode'];
$header_details = $this->widget_model->select_setting($view_mode);
$search_term    = $this->input->get('search_term');
?>
<div class="MobileInput">  <form class="" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="mobileSearchForm" method="get" role="form">
<input type="text" placeholder="Search..." name="search_term" id="mobile_srch_term" value="<?php echo $search_term;?>"/> <a href="javascript:void(0);" id="mobile_search"><img src="<?php echo image_url; ?>images/FrontEnd/images/search-mob.png" /></a></form></div>
<div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 share-padd-right-0">
<div class="social_icons SocialCenter mobile-share"><span> <a class="android" href="https://play.google.com/store/apps/details?id=com.newindianexpress.news" target="_blank"><i class="fa fa-android" aria-hidden="true"></i></a> <a class="apple" href="https://itunes.apple.com/in/app/new-indian-express-official/id968640811?mt=8" target="_blank" ><i class="fa fa-apple" aria-hidden="true"></i></a></span> <a class="fb" href="<?php echo $header_details['facebook_url'];?>" target="_blank"><i class="fa fa-facebook"></i></a> <a class="twit" href="<?php echo $header_details['twitter_url'];?>" target="_blank"><i class="fa fa-twitter"></i></a><!--<a class="pinterest" href="http://www.pinterest.com/newindianexpres" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>-->
          <a class="instagram" href="https://www.instagram.com/xpresscinema/?hl=en" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> <a class="rss" href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></a> </div>
            <ul class="MobileNav">
            <li class="MobileShare dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><i class="fa fa-share-alt" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i></span></a><ul class="dropdown-menu">
          <li><a href="<?php echo $header_details['facebook_url'];?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo $header_details['twitter_url'];?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <!--<li><a href="http://www.pinterest.com/newindianexpres" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
          <li><a href="https://instagram.com/newindianexpress/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->  
          <li><a href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></i></a></li>
          
        </ul></li>
            </ul>
</div>
 <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
	<div class="group_logo">
		 <?php 
echo '<a href="http://www.newindianexpress.com/">
<img src="'.image_url.'images/FrontEnd/images/NIE_group.png'.'"></a>';
	?>
	</div>
 </div>
 <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
    <div class="main_logo">
      <?php 
echo '<a href="'.BASEURL.'">
<img src="'.image_url.'images/FrontEnd/images/NIE-logo21.png'.'"></a>';
	?>
	<!--<div class="loc" id="current_time">
		<?php 
		$day = date('l');
		$month = date('F');
		echo '<span>'.$day.', '.$month.', '.date('d').', '.date('Y').' &nbsp;&nbsp;'.date('h:i:s A ').'</span>';
		?>
    </div>-->
   <?php //echo '<div id="mobile_date">'.date('d')." <span>".$month."</span> ".date('Y').'</div>'; ?>
    </div>
  </div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 search-padd-left-0">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <ul class="MobileNav">
				<!--changed bykrishwer for menu problem-->
                   <?php if($content['page_param']=="?-?-") { ?>
                   <li>
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button></li><?php } ?>
                   <li class="MobileSearch"><a class="SearchHide" href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                   
                  </ul>
       <div class="large-screen-search">
       <div class="search1" style="float:left;width:100%;">
		
         <form class="navbar-form form" style="padding:0;float: left;width: 100%;margin-top: 80px;" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="SimpleSearchForm" method="get" role="form" >
		 
            <div class="input-group search-form" style="display:none;width: 97%;float:left;">
              <input type="text" class="form-control tbox" placeholder="" name="search_term" id="srch-term" value="<?php echo $search_term;?>">
              <div class="input-group-btn">
                <input type="hidden" class="form-control tbox"  name="home_search" value="H" id="home_search">
                <button class="btn btn-default btn-bac" id="search-submit" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
			 <span style="color:#fff;cursor:pointer;font-size: 20px;float:right;" class="search-icon"><i class="fa fa-search inactive search-inner" aria-hidden="true"></i></span>
          </form>

          <label id="error_throw" style="text-align:left;"></label>
        </div>
        
        </div>
      </div>
    </div>
  </div>
</div>