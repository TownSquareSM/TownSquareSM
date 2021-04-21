<div class="ossn-ad-item">
<div class="row" style="margin: 0;">
	<?php require_once("custom_item.php"); ?>
</div>
</div>
<script>
	let ads_guid = <?php echo json_encode($params['ads_guid']); ?>;
	var i = 0;
	var k = 0;
	function Change() {
		setTimeout('Change()', <?php echo $params['timer']; ?>*1000);
		if (k == 0) {
			k = 1;
		} else {
			if(i >= <?php echo count($params['ads_guid']) ?>) {
				i = 0;
			}
			$.getJSON('<?php echo ossn_site_url('ossnads/html/'); ?>'+ads_guid[i++], function(data) {
				$('div.ossn-ad-item').html(data.code);
			});
		}
	}
	window.onload = Change;
</script>
