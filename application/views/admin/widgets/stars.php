<?php
$CI = &get_instance();
$this->live_db = $CI->load->database('live_db' , true);
$starId = $this->input->get('star_id');
if($starId==''):
$links ='';
$lid = $this->input->get('lid');
$search ="";
if($lid!='' && is_numeric($lid)){
	$search .=" AND slid='".$lid."'";
}
$languageQuery = "SELECT slid, name FROM star_language_master WHERE status=1 ".$search."";
if(!$this->memcached_library->get($languageQuery) && $this->memcached_library->get($languageQuery) == ''){
	$languageList = $this->live_db->query($languageQuery)->result();
}else{
	$languageList = $this->memcached_library->get($languageQuery);
}
?>
<div class="row">
<?php
foreach($languageList as $language){
	if($lid!='' && is_numeric($lid)){
		$this->load->library('pagination');
		$config['base_url'] = current_url();
		$config['total_rows'] = $this->live_db->query("SELECT star_id FROM star_master WHERE status=1 AND language='".$language->slid."'")->num_rows();
		$config['per_page'] = 18;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 5;
		$config['suffix'] = "&lid=".$language->slid;
		$this->pagination->initialize($config);
		$links = $this->pagination->create_links();
		$row = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0;
		$starsQuery = "SELECT star_id, name, img_path FROM star_master WHERE language='".$language->slid."' AND status=1 ORDER BY modified_on DESC LIMIT ".$row." , ".$config['per_page']."";
	}else{
		$starsQuery = "SELECT star_id, name, img_path FROM star_master WHERE language='".$language->slid."' AND status=1 ORDER BY modified_on DESC LIMIT 6";
	}
	if(!$this->memcached_library->get($starsQuery) && $this->memcached_library->get($starsQuery) == ''){
		$starsList = $this->live_db->query($starsQuery)->result();
	}else{
		$starsList = $this->memcached_library->get($starsQuery);
	}
	if(count($starsList) >0):
	echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
	echo '<h5 class="block-title"><span><a href="'.current_url().'?lid='.$language->slid.'">'.$language->name.'</a></span></h5>';
	echo '<div class="stars-block">';
	$i=1;
	foreach($starsList as $stars){
		if($i==1){
			echo '<div class="row">';
		}
		echo '<div class="col-xs-4 col-sm-12 col-md-4 col-lg-4 ">';
		echo '<div class="star-inner">';
		echo '<a href="'.current_url().'?star_id='.$stars->star_id.'"><div><img src="'.image_url.'images/stars/'.$stars->img_path.'"></div><h4>'.$stars->name.'</h4></a>';
		echo '</div>';
		echo '</div>';
		if($i==3){
			echo '</div>';
			$i=1;
		}else{
			$i++;
		}
	}
	if($i!=1){
		echo '</div>';
	}
	echo '<div class="row">';
	echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">';
	if($lid!='' && is_numeric($lid)){
		echo '<div class="pagina">';
		echo '<a href="'.current_url().'" class="active"><i style="font-size: inherit;" class="fa fa-home"></i> Home</a>';
		echo $links;
		echo '</div>';
	}else{
		echo '<a href="'.current_url().'?lid='.$language->slid.'" style="color: #ed1c24;font-weight: bold;">More<i class="fa fa-angle-right" style="margin-left: 4px;"></i><i class="fa fa-angle-right"></i></a>';
	}
	
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
	echo '</div>';
	endif;
}
?>
</div>
<?php endif; ?>
<?php if($starId!=''):
$starQuery = "SELECT star_id , name , bio , img_path FROM star_master WHERE status=1 AND star_id='".$starId."'";
if(!$this->memcached_library->get($starQuery) && $this->memcached_library->get($starQuery) == ''){
	$starsDetails = $this->live_db->query($starQuery)->row_array();
}else{
	$starsDetails = $this->memcached_library->get($starQuery);
}
if(is_array($starsDetails) && count($starsDetails) > 0){
	$atributesQuerry = "SELECT question , answer FROM star_master_attributes WHERE star_id='".$starId."' AND status=1";
	if(!$this->memcached_library->get($atributesQuerry) && $this->memcached_library->get($atributesQuerry) == ''){
		$atributesDetails = $this->live_db->query($atributesQuerry)->result_array();
	}else{
		$atributesDetails = $this->memcached_library->get($atributesQuerry);
	}
	echo '<div class="row">';
	echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
	echo '<h5 class="block-title"><span><a>'.$starsDetails['name'].'</a></span></h5>';
	echo '<div class="stars-block star-block-second">';
	echo '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 stars-image-block">';
	echo '<img src="'.image_url.'images/stars/'.$starsDetails['img_path'].'">';
	echo '</div>';
	echo '<div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">';
	echo '<h4 style="font-weight: bold;">'.$starsDetails['name'].'</h4>';
	echo $starsDetails['bio'];
	echo '</div>';
	echo '</div>';
	if(count($atributesDetails) > 0){
		echo '<div class="stars-block-1"">';
		$i=1;
		foreach($atributesDetails as $atribute){
			echo '<div class="star-attribute">';
			echo '<h5 style="font-weight:700;">'.$i.'. '.$atribute['question'].'</h5>';
			echo $atribute['answer'];
			echo '</div>';
			$i++;
		}
		
		echo '</div>';
	}
	echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">';
	echo '<div class="pagina">';
	echo '<a href="'.current_url().'" class="active"><i style="font-size: inherit;" class="fa fa-home"></i> Home</a>';
	echo $links;
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
endif;