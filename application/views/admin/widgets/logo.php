<div class="row row-mob">
<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$is_home = $content['is_home_page'];
$view_mode = $content['mode'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$domain_name         = base_url();
$mega_menu           = "drop_menu";
$header_details = $this->widget_model->select_setting($view_mode);
$search_term    = $this->input->get('search_term');
if($view_mode == "live"){ 
	$page_details	     = $this->widget_model->get_template_xmlcontent($content['widget_values']['data-widgetpageid'], '');
	$page_menu_id        =  $page_details['menuid'];
}else{
	$page_id 		     = $this->uri->segment('4');
	$page_details	     = $this->widget_model->get_template_xmlcontent($page_id , '');
	$page_menu_id        =  $page_details['menuid'];
}
$activesectionid     = $page_menu_id;
if($activesectionid == 10000){
	if($page_details['pagetype']!=2){
		$activesectionid     = $content['page_param'];
		$page_menu_id        = $content['page_param'];
	}else{
		$menu_url_segment 	= explode("/",$this->uri->uri_string());
		$segment_part       = (count($menu_url_segment)-4);	
		$special_section	= '';
		$url_parent_section = '';
		$url_sub_section 	= '';
		switch($segment_part){
			case 1:
				$special_section	= '';
				$url_parent_section = '';
				$url_sub_section 	= $menu_url_segment[0];
			break;
			case 2:
				$special_section	 = '';
				$url_parent_section  = $menu_url_segment[0];
				$url_sub_section 	 = $menu_url_segment[1];
			break;
			case 3:
				$special_section	= $menu_url_segment[0];
				$url_parent_section = $menu_url_segment[1];
				$url_sub_section 	= $menu_url_segment[2];
			break;
		}	
		$url_section_details = $this->widget_model->get_sectionid_with_names($url_sub_section, $url_parent_section, $special_section);
		if(count($url_section_details)>0){
			$page_details = $url_section_details[0];
			$activesectionid     = $page_details['Section_id'];
			$page_menu_id        = $page_details['Section_id'];
		}else{
			$activesectionid = "home";
		}
	}
}
if($activesectionid=="home"){
	$page_details 	     = $this->widget_model->get_section_by_urlname("Home" , $view_mode);	
	$activesectionid     = $page_details['Section_id'];
	$page_menu_id        = $page_details['Section_id'];
}
$parent_section = $this->widget_model->get_parent_sectionmane($activesectionid, $view_mode);
$parent_sectionname = "";
if(count($parent_section)>0){
	$parent_sectionname = $parent_section['Sectionname'];
}
if(isset($activesectionid)){
	if($activesectionid != ''){
        $Section_Details =  $this->widget_model->get_sectionDetails($activesectionid, $view_mode);
		if($Section_Details['IsSubSection'] == '0' && $Section_Details['IsSeperateWebsite'] == '1'){
			$section_mapping 	= $this->widget_model->multiple_section_mapping_by_section_id($page_menu_id, $view_mode);
			$home_section 	= array($this->widget_model->get_sectionid_by_name("Home", $view_mode));
			$section_mapping = array_merge($home_section, $section_mapping);
		}else if((count($parent_section)>0 && $parent_section['IsSeperateWebsite'] == '1') &&( $Section_Details['IsSeperateWebsite'] == '0' ||  $Section_Details['IsSeperateWebsite'] == '1')){ 
			$CheckTopParentSection = $this->widget_model->CheckTopParentSection($Section_Details['ParentSectionID'], $view_mode);
			if($CheckTopParentSection == 0){
				$section_mapping 	= $this->widget_model->multiple_section_mapping_by_section_id($Section_Details['ParentSectionID'], $view_mode);
				$home_section 	= array($this->widget_model->get_sectionid_by_name("Home", $view_mode));
				$section_mapping = array_merge($home_section, $section_mapping);
				}
				else 
				$section_mapping 	= $this->widget_model->multiple_section_mapping_by_section_id($CheckTopParentSection, $view_mode);
		}else{
			$section_mapping 	= $this->widget_model->multiple_section_mapping_by_section_id("", $view_mode);
		}	
	}
}
?>
	<div class="MobileInput">
		<form class="" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="mobileSearchForm" method="get" role="form">
			<input type="text" placeholder="Search..." name="search_term" id="mobile_srch_term" value="<?php echo $search_term;?>"/> <a href="javascript:void(0);" id="mobile_search"><img data-src="<?php echo image_url; ?>images/FrontEnd/images/lazy.png" src="<?php echo image_url; ?>images/FrontEnd/images/search-mob.png" /></a>
		</form>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 search-block">
		<form class="hidden-xs" action="<?php echo BASEURL; ?>topic" name="SimpleSearchForm" id="SimpleSearchForm" method="get" role="form">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" id="srch-term" name="search_term">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit" id="search-submit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
			<label id="error_throw"></label>
		</form>
		<ul class="MobileNav">
			<li class="MobileShare dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><i class="fa fa-globe" aria-hidden="true" style="font-size: 18px;padding-top: 3px;"></i><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo $header_details['facebook_url'];?>" rel="noopener" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="<?php echo $header_details['twitter_url'];?>" rel="noopener" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<li><a href="https://www.instagram.com/xpresscinema/?hl=en" target="_blank" rel="noopener"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="https://www.youtube.com/channel/UC2MgcperJNAFDQgafrijUnA" rel="noopener" target="_blank"><i class="fa fa-youtube"></i></a></li>
					<li><a href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></i></a></li>
	  
				</ul>
			</li>
		</ul>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<div class="main_logo">
		<?php 
			echo '<a href="'.base_url().'"><img alt="cinemaxpress_logo" title="logo" src="'.image_url.'images/FrontEnd/images/NIE-logo21.png'.'" data-src="'.image_url.'images/FrontEnd/images/NIE-logo21.png'.'"></a>';
		?>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
		<div class="right-block">
			<div class="social-icons hidden-xs">
				<a target="_BLANK" href="<?php echo $header_details['facebook_url'];?>" title="facebook" rel="noopener"><i class="fa fa-facebook-f"></i></a>
				<a target="_BLANK" href="<?php echo $header_details['twitter_url'];?>" title="twitter" rel="noopener"><i class="fa fa-twitter"></i></a>
				<a target="_BLANK" href="https://www.instagram.com/xpresscinema/?hl=en" title="instagram" rel="noopener"><i class="fa fa-instagram"></i></a>
				<!--<a target="_BLANK"><i class="fa fa-pinterest-p"></i></a>-->
				<a target="_BLANK" href="https://www.youtube.com/channel/UC2MgcperJNAFDQgafrijUnA" title="youtube" rel="noopener"><i class="fa fa-youtube"></i></a>
				<a target="_BLANK" href="<?php echo $header_details['rss_url'];?>" title="rss"><i class="fa fa-rss"></i></a>
			</div>
			<a class="hidden-xs" target="_BLANK" href="https://www.newindianexpress.com/"><img alt="group_logo" title="group logo" src="<?php echo image_url ?>images/FrontEnd/images/group.jpg"  data-src="<?php echo image_url ?>images/FrontEnd/images/group.jpg"></a>
			<ul class="MobileNav">
				<li class="MobileSearch">
					<button type="button" class="slide-slider"><i class="fa fa-bars"></i></button>
				</li>
				<!--<li class="MobileSearch"><a class="SearchHide" href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i></a></li>-->  
			</ul>
		</div>
	</div>
</div>
<!--navbar details-->
<div class="row hidden-xs hidden-sm">
  <div class="col-lg-12">
    <div class="navbar navbar-inverse navbar-fixed-top main-menu menu" role="navigation" style="margin-bottom:0px; position:relative; color:#fff;">
		<!--<span class="slide-right"><i class="fa fa-caret-right"></i></span>-->
		<div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand home_logo" rel="home" href="<?php echo base_url(); ?>"><i class="fa fa-home"></i></a> 
        </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav menus">
          <?php
		  if(isset($section_mapping)) { 
			 $Section_Count  = 0;

				 foreach($section_mapping as $mapping) { 
				 if($mapping['MenuVisibility'] === '1')  
	             { 
				 $Section_Count++;

			   $url_section_value = $mapping['URLSectionStructure'];
			   $MainSectionPageURL = base_url(). $url_section_value;												
					 				
				 if(strtolower($mapping['Sectionname']) != "home")
				 {
					 
					 	if(((strtolower($Section_Details['Sectionname']) == strtolower($mapping['Sectionname'])) && $Section_Details['IsSubSection'] == '0') || (($Section_Details['Sectionname'] != "Technology" ) && strtolower($parent_sectionname) == strtolower($mapping['Sectionname'])))
						{  
				 ?>
          <li class="<?php  if(!empty( $mapping['sub_section']) && $Section_Details['Sectionname'] != "Magazine" ) { echo "CitiesHover";  } else { echo "StatesHover";  } ?>" id="tab<?php echo $mapping['Section_id']; ?>"><a class="MenuItem active" id="maintabs-<?php echo $mapping['Section_id']; ?>" <?php if(count($mapping['sub_section']) == 0) { ?> onmouseover="show_main_menu('<?php echo $mapping['Section_id'];?>', 'main')" <?php } else { ?> onmouseover="show_main_menu('<?php echo $mapping['sub_section'][0]['Section_id']; ?>','<?php echo $mapping['Section_id'];?>')"  <?php }?> href="<?php echo $MainSectionPageURL; ?>"><?php echo preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$mapping['SectionnameInHTML']); ?></a>
            <?php
						}
						elseif((strtolower($Section_Details['Sectionname']) == strtolower($mapping['Sectionname'])) && $Section_Details['IsSubSection'] == '1' && $parent_section['IsSeperateWebsite'] == '1')
						{ 
				 ?>
          <li class="<?php  if(!empty( $mapping['sub_section']) && $Section_Details['Sectionname'] != "Magazine") { echo "CitiesHover";  } else { echo "StatesHover";  } ?>" id="tab<?php echo $mapping['Section_id']; ?>"><a class="MenuItem active"  id="maintabs-<?php echo $mapping['Section_id']; ?>" <?php if(count($mapping['sub_section']) == 0) { ?> onmouseover="show_main_menu('<?php echo $mapping['Section_id'];?>', 'main')" <?php } else { ?> onmouseover="show_main_menu('<?php echo $mapping['sub_section'][0]['Section_id']; ?>','<?php echo $mapping['Section_id'];?>')"  <?php }?> href="<?php echo $MainSectionPageURL; ?>"><?php echo preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$mapping['SectionnameInHTML']); ?></a>
            <?php
						}else
						{ 
				 ?>
          <li class="<?php  if(!empty( $mapping['sub_section']) && $Section_Details['Sectionname'] != "Magazine") { echo "CitiesHover";  } else { echo "StatesHover";  } ?>" id="tab<?php echo $mapping['Section_id']; ?>"><a class="MenuItem"  id="maintabs-<?php echo $mapping['Section_id']; ?>" <?php if(count($mapping['sub_section']) == 0) { ?> onmouseover="show_main_menu('<?php echo $mapping['Section_id'];?>', 'main')" <?php } else { ?> onmouseover="show_main_menu('<?php echo $mapping['sub_section'][0]['Section_id']; ?>','<?php echo $mapping['Section_id'];?>')"  <?php }?> href="<?php echo $MainSectionPageURL; ?>"><?php echo preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$mapping['SectionnameInHTML']); ?> <?php if(count($mapping['sub_section']) > 0){ echo '<i class="fa fa-caret-down" style="font-size: 25px;float: right;margin-left: 10px;margin-top: -2px;"></i>'; } ?></a>
            <?php
						}
					
				 ?>
            <?php
				 	if ($Section_Details['Sectionname'] == "Magazine" )
					{
                     ?>
            <div class="MultiStatesContents MultiCitiesCont" id="maintabs_content-78">
               <!--  Magazine menu content appear here -->
            </div>
            <?php
					}
					
				 if(!empty( $mapping['sub_section']) && strtolower($mapping['Sectionname']) != "lifestyle" && strtolower($mapping['Sectionname']) != "columns" && strtolower($mapping['Sectionname']) != "magazine") { ?>
            <div class="MultiCities <?php echo $mega_menu;?>" id="tabs<?php echo $mapping['Section_id']; ?>">
              <ul class="MultiCitiesList">
                <?php $i=1; foreach($mapping['sub_section'] as $key=>$sub_section) {
					if($sub_section['MenuVisibility'] === '1')  
                    {
					$subSectionPageURL = base_url().$sub_section['URLSectionStructure'];
							 ?>
                <li class="<?php echo ($i==1)?'active':'';?>" data-target="#tabs-<?php echo $sub_section['Section_id']; ?>"><a href="<?php echo $subSectionPageURL;?>" id="subtabs-<?php echo $sub_section['Section_id']; ?>" onmouseover="show_main_menu('<?php echo $sub_section['Section_id']; ?>','')" data-id="<?php echo $sub_section['Section_id']; ?>" ><?php echo preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$sub_section['SectionnameInHTML']); ?> <i class="fa fa-chevron-right"></i></a></li>
				<?php 
				if($sub_section['Sectionname']=='Videos'){
					$Url = base_url().'photos/'.str_replace('videos' , 'photos' , $sub_section['URLSectionStructure']);
					echo '<li class=""><a href="'.$Url.'">Photos</a></li>';
				}
				?>
                <?php 	
					$i++;
						if($key  == 6)
							break;
					}
					} ?>
              </ul>
              <?php if(!empty( $mapping['sub_section'])) { ?>
              <div class="MultiCitiesContents tab-content">
                <?php $i=1; foreach($mapping['sub_section'] as $key=>$sub_section) { 
					if($sub_section['MenuVisibility'] === '1')  
                    { ?>
                <div id="tabs-<?php echo $sub_section['Section_id']; ?>" class="MultiCitiesCont tab-pane <?php echo ($i==1)?'active':'';?>">
                  <!--  Sub tabs menu content appear here -->
                </div>
                <?php 
					$i++;
					} 
					}?>
              </div>
              <?php 
					
					} ?>
            </div>
            <?php } else { ?>
            <div class="MultiStatesContents MultiCitiesCont" id="maintabs_content-<?php echo $mapping['Section_id'];?>">
            <!--  Main Menu content appear here -->
            </div>
            <?php } ?>
          </li>
          <?php
				 }
				 else
				 {
					 if(strtolower($Section_Details['Sectionname']) == 'home')
					 {
				 ?>
        <li class="CitiesHover active"><a class="MenuItem" href="<?php echo base_url(); ?>">Home</a></li>
          <?php 
                     }
                     else
                     { ?>
        <li class="CitiesHover"><a class="MenuItem" href="<?php echo base_url(); ?>">Home</a></li>
          <?php }
					 }
				if ($Section_Count == 13 ) 
				break;   
				
				}
				 }
			 } 
			 
			
			 
			 ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="menu-slider visible-xs visible-sm">
	<div class="input-group">
		<input type="text" class="form-control" name="text" placeholder="Search" id="mob-term-sec">
		<span class="input-group-addon"><i class="fa fa-search"></i></span>
	</div>
	<ul class="slider-ul">
		<?php
		if(isset($section_mapping)){
			 $Section_Count = 0;
			 foreach($section_mapping as $mapping){
				if($mapping['MenuVisibility'] === '1'){
					$Section_Count++;
					$url_section_value = $mapping['URLSectionStructure'];
					$MainSectionPageURL = base_url();
					if($url_section_value!='Home'){
						$MainSectionPageURL .=$url_section_value;
					}
					echo '<li class="menu-sec"><a href="'.$MainSectionPageURL.'">'.preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$mapping['SectionnameInHTML']).'</a>';
					if(!empty($mapping['sub_section'])){
						echo '<span><i class="fa fa-angle-down"></i></span>';
					}
					if(!empty($mapping['sub_section'])){
						echo '<ul class="menu-sub">';
						foreach($mapping['sub_section'] as $key=>$sub_section){
							$subSectionPageURL = base_url().$sub_section['URLSectionStructure'];
							echo '<li><a href="'.$subSectionPageURL.'">'.preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$sub_section['SectionnameInHTML']).'</a>';
							if($sub_section['Sectionname']=='Videos'){
								$Url = base_url().'photos/'.str_replace('videos' , 'photos' , $sub_section['URLSectionStructure']);
								echo '<li class=""><a href="'.$Url.'">Photos</a></li>';
							}
						}
						echo '</ul>';
					}
					echo '</li>';
					if($Section_Count == 13) 
						break;
				} 	 
			 }
		}
		?>
	</ul>
</div>
<script>
$(document).ready(function(){
	$('.slide-slider').on('click' , function(e){
		if($(this).find('i').hasClass('fa-bars')){
			$(this).find('i').removeClass('fa-bars').addClass('fa-times');
		}else{
			$(this).find('i').removeClass('fa-times').addClass('fa-bars');
		}
		$('.menu-slider').toggleClass('menu-slider-open');
	});
	$('.menu-sec span').on('click' , function(e){
		if($(this).find('i').hasClass('fa-angle-down')){
			$(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
		}else{
			$(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
		}
		$(this).parent().find('ul').slideToggle();
	});
	$('.menu-slider .input-group-addon').on('click' , function(e){
		var term = $('#mob-term-sec').val();
		var re = /^[ A-Za-z0-9_@.,#&+-:;'"/]*$/;
		if (term.trim().length==0){
			alert("Please provide search keyword(s)");
			return false;
		}else if(!re.test(term)){
			alert("Please enter alphanumeric search keyword(s)");
			return false;
		}else{
			if(term.trim().length > 200){
				alert("Please do not enter more than 200 characters!");
				return false;
			} 
		}
		window.location.href = "<?php echo BASEURL;?>topic?search_term="+term;
	});
   <?php if(isset($section_mapping)) { 

				 foreach($section_mapping as $mapping) {  ?>
     <!--Dropdown Menu--> 
	$( "#tabs<?php echo $mapping['Section_id']; ?> li" ).hover( function(){
      $(this).tab('show'); 
    });
		  <?php } } ?>
		  setTimeout(function(){sessionStorage.clear(); }, 240000);  //clear Session Storage every 4 mins
});
//$('.menus li:nth-last-child(2)').addClass('jumbo_full');
//$('.menus li:nth-last-child(3)').addClass('jumbo_full');

	   function show_main_menu(menuId, type){
		   var storage_name = "menu_content_"+menuId;
		   if (sessionStorage.getItem(storage_name)) { 	// Code for localStorage/sessionStorage.
		 var sessiondata = sessionStorage.getItem(storage_name);
			if(type=='main'){
			   $('#maintabs_content-'+menuId).html(sessiondata);
			   $('#maintabs-'+menuId).removeAttr('onmouseover');
			   }else{
				$('#tabs-'+menuId).html(sessiondata);
			   $('#maintabs-'+type).removeAttr('onmouseover');
			   $('#subtabs-'+menuId).removeAttr('data-id');
				$('#subtabs-'+menuId).removeAttr('onmouseover');
			   }
			} else { // Sorry! No Web Storage support..
		 $.ajax({
			url			: '<?php echo base_url(); ?>user/commonwidget/get_menu_content',
			method		: 'post',
			data		: { menuid: menuId, mode: '<?php echo $content['mode'];?>', 'rendermode' : '<?php echo $content['RenderingMode'];?>', is_home : '<?php echo $is_home;?>', param : '<?php echo $content['close_param'];?>', menu_type : type},
			beforeSend	: function() {				
				console.log(menuId);
				if(type=='main'){
				  document.getElementById('maintabs_content-'+menuId).innerHTML = '<figure style="text-align: center;"><img src="<?php echo base_url();?>images/FrontEnd/images/menu-loader.gif" style="width: 70px;"></figure>';
				   }else{
				   document.getElementById('tabs-'+menuId).innerHTML = '<figure style="text-align: center;"><img src="<?php echo base_url();?>images/FrontEnd/images/menu-loader.gif" style="width: 70px;position: absolute;top: 43%;left: 57%;"></figure>';
				   }
			},
			success		: function(result){ 
			       if(type=='main'){
				   $('#maintabs_content-'+menuId).html(result);
				   $('#maintabs-'+menuId).removeAttr('onmouseover');
				   }else{
				    $('#tabs-'+menuId).html(result);
				   $('#maintabs-'+type).removeAttr('onmouseover');
				   $('#subtabs-'+menuId).removeAttr('data-id');
				    $('#subtabs-'+menuId).removeAttr('onmouseover');
				   }
				   sessionStorage.setItem('menu_content_'+menuId, result);
                   console.clear();
				   }			
		});
		}
	   }
	   $(document).ready(function(e){
		   if(screen.width < 800 || document.documentElement.clientWidth < 800){
				$('.CitiesHover,.StatesHover > a').find('i').on('click' , function(e){
					if($(this).text().toLowerCase()!='home'){
						e.preventDefault();
					}
				});
		   }
		   $('.slide-right').on('click' , function(e){
			   $(".menus").scrollLeft('50');
			   $(this).hide(1000);
		   });
	   });
	   
</script>