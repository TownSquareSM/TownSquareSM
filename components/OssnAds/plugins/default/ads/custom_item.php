<div class="row" style="margin: 0;">
		<a target="_blank" href="<?php echo $params['item']->site_url;?>" style="margin-bottom:-300px; display:inline-block; width:100%; height: 300px; z-index:5;">
		<iframe src="<?php echo ossn_ads_iframe_url($params['item']->guid); ?>" style="width: 100%;margin:0 auto;" height="<?php echo $params['item']->iframe_height; ?>" frameborder="0"></iframe>
	</a>
		<script>$('iframe').on('click', function() {
			alert("clicked");
		});</script>
</div>
