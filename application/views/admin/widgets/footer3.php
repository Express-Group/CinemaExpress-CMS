<?php 
$view_mode              = $content['mode'];
$social_urls            = $this->widget_model->select_setting($view_mode); 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$page_type 				= 'section';
// widget config block ends
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer2bac">
	<div class="footer2" style="padding-top:2%;">
		<p class="footer-links"> Main Links &emsp;|&emsp; 
			<a class="AllTopic" href="<?php echo base_url()."tamil"; ?>"><?php echo "Tamil"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."english"; ?>"><?php echo "Engilsh"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."hindi"; ?>"><?php echo "Hindi"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."telugu"; ?>"><?php echo "Telugu"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."malayalam"; ?>"><?php echo "Malayalam"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."kannada"; ?>"><?php echo "Kannada"; ?></a>
		</p>
		<p class="footer-links"> Other Group Sites &emsp;|&emsp; 
			<a class="AllTopic" href="http://www.newindianexpress.com/" target="_blank">The New Indian Express</a>
			<a class="AllTopic" href="http://www.dinamani.com" target="_blank">Dinamani</a>
			<a class="AllTopic" href="http://www.kannadaprabha.com" target="_blank">Kannada Prabha</a>
			<a class="AllTopic" href="http://www.samakalikamalayalam.com" target="_blank">Samakalika Malayalam</a>
			<a class="AllTopic" href="http://www.indulgexpress.com" target="_blank">Indulgexpress</a>
			<a class="AllTopic" href="http://www.edexlive.com" rel="nofollow" target="_blank">Edex Live</a>
			<a class="AllTopic" href="http://www.eventxpress.com/" rel="nofollow" target="_blank">Event Xpress</a>
		</p>
		<p class="footer-links"> Other Links &emsp;|&emsp; 
			<a class="AllTopic" href="<?php echo base_url()."contact-us"; ?>"><?php echo "Contact Us"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."about-us"; ?>"><?php echo "About Us"; ?></a> 
			<a class="AllTopic" href="<?php echo base_url()."privacy-policy"; ?>"><?php echo "Privacy Policy"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."terms-of-use"; ?>"><?php echo "Terms of Use"; ?></a>
			<a class="AllTopic" href="<?php echo base_url()."advertise-with-us"; ?>"><?php echo "Advertise With Us"; ?> </a>
			<a class="AllTopic" href="http://www.edexlive.com" rel="nofollow" target="_blank">Edex Live</a>
			<a class="AllTopic" href="http://www.eventxpress.com/" rel="nofollow" target="_blank">Event Xpress</a>
		</p>
		<hr>
		<div class="footer-strip">
			<div class="footer_social"> 
				<a class="fb" href="<?php echo $social_urls['facebook_url'];?>" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
				<a style="background:#1DA1F2;" class="twit" href="<?php echo $social_urls['twitter_url'];?>"target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a>
				<a style="background:#cd486b;" href="https://www.instagram.com/xpresscinema/?hl=en" target="_blank" rel="noopener"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<a style="background:#ee802f;" class="rss" href="<?php echo $social_urls['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></a> 
			</div>
			<span>Copyright - cinemaexpress.com <?php echo date('Y'); ?></span>
		</div>
  </div>
</div>
<script>
var $ = $.noConflict();
$(document).ready(function( $ ){
    scrollToTop.init( );
});
var scrollToTop =
{
    init: function(  ){
        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });
        // Click event to scroll to top
        $('.scrollToTop').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });
    }
};
</script>