<div class="ossn-ad-item">
<div class="row" style="margin: 0;">
	<a target="_blank" href="<?php echo $params['item']->site_url;?>" style="margin-bottom:-300px; display:inline-block; width:100%; height: 300px; z-index:5;">
		<iframe src="<?php echo ossn_ads_iframe_url($params['item']->guid); ?>" style="width: 100%;margin:0 auto;" frameborder="0" height="<?php echo $params['item']->iframe_height; ?>"></iframe>
	</a>
</div>
</div>
<script>
	let ads_guid = <?php echo json_encode($params['ads_guid']); ?>;
	var i = 0;
	function Change() {
				if(i >= <?php echo count($params['ads_guid']) ?>) {
					i = 0;
				}
				$.getJSON('<?php echo ossn_site_url('ossnads/html/'); ?>'+ads_guid[i++], function(data) {
					$('div.ossn-ad-item').html(data.code);
				})
			setTimeout('Change()', <?php echo $params['timer']; ?>*1000);
	}
	window.onload = Change;
</script>
