<div class="row" style="margin: 0;">
	<iframe src="<?php echo ossn_ads_iframe_url($params['item']->guid); ?>" style="width: 100%;margin:0 auto;overflow:hidden;" height="<?php echo $params['item']->iframe_height; ?>" frameborder="0"></iframe>
	<a target="_blank" href="<?php echo $params['item']->site_url;?>" style="margin-top:-<?php echo $params['item']->iframe_height; ?>px; display:inline-block; width:100%; height: <?php echo $params['item']->iframe_height+22; ?>px; z-index:5;">
	</a>
</div>
