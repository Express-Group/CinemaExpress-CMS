<style>
.youtube-container{padding-right:10px;}
</style>
<?php

$widget_bg_color 		= $content['widget_bg_color'];
$widget_instance_id	 	= $content['widget_values']['data-widgetinstanceid'];
$view_mode              = $content['mode'];
$widget_instance_details= $this->widget_model->getWidgetInstance('', '','', '', $widget_instance_id, $content['mode']);
$widget_position = $content['widget_position'];	

$yurl = 'https://www.googleapis.com/youtube/v3/playlistItems?playlistId='.$widget_instance_details['AdvertisementScript'].'&key=AIzaSyAI21xRZ3Xjxae6Kikq81YDCSaUlfjLPPY&part=snippet&maxResults=10';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $yurl);
curl_setopt($curl, CURLOPT_HTTPHEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$youtubejson = curl_exec($curl);
curl_close($curl);
$youtubejson = json_decode($youtubejson , true);
$temp =[];
for($i=0;$i<count($youtubejson['items']);$i++){
	$details['title'] = $youtubejson['items'][$i]['snippet']['title'];
	$details['default_thumbnails'] = $youtubejson['items'][$i]['snippet']['thumbnails']['default'];
	$details['medium_thumbnails'] = $youtubejson['items'][$i]['snippet']['thumbnails']['medium'];
	$details['large_thumbnails'] = $youtubejson['items'][$i]['snippet']['thumbnails']['high'];
	$details['videoid'] = $youtubejson['items'][$i]['snippet']['resourceId']['videoId'];
	array_push($temp,$details);
}
$youtubejson = $temp;
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h5 class="block-title margin-bottom-10"><span><a>YouTube Videos</a></span></h5>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom-space-10">
		<div class="slide others_slider1 others_slider_change other">
			<?php
				if(count($youtubejson) > 0){
					foreach($youtubejson as $get_content):
						$show_image_300 = $get_content['large_thumbnails']['url'];
						$dummy_image = image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
						$display_title = '<a target="_BLANK" href="https://www.youtube.com/watch?v='.$get_content['videoid'].'"><i style="color: red;" class="fa fa-youtube-play" aria-hidden="true"></i> '.$get_content['title'].'</a>';
						$template .='<div class="youtube-container">';
						$template .='<div><a href="https://www.youtube.com/watch?v='.$get_content['videoid'].'" target="_BLANK"><img src="'.$dummy_image.'" data-src="'.$show_image_300.'" alt="'.$get_content['title'].'" class="img-responsive"></a><h5 class="subtopic" style="border:none;padding:8px ​0 0!important;margin:0;">'.$display_title.'</h5></div>';
						$template .='</div>';
					endforeach;
				}
				echo $template; 
			?>
		</div>
	</div>
</div>