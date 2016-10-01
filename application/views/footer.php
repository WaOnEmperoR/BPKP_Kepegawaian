<footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><?php echo $this->config->item('nama_aplikasi'); ?> - | Perwakilan Provinsi Maluku &copy; 2016</li>
		</ul>
        <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
	</div>
</footer>

<script type="text/javascript">
	jQuery(document).ready(function($){
		// browser window scroll (in pixels) after which the "back to top" link is shown
		var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('#back-to-top');
		
		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			}, scroll_top_duration
			);
		});
	});	
</script>