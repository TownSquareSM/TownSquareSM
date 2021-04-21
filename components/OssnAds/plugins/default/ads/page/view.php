<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$ads = new OssnAds;
$ads = $ads->getAds(
	array (
		'offset' => 1
	)
);
$timer = new OssnAds;
$timer = $timer->get_ad_timer()->description;
if ($ads) {
	echo '<div class="ossn-ads">';
	foreach($ads as $ad) {
		$ads_guid[] = $ad->guid;
	}
	$item = ossn_plugin_view('ads/item', array(
		'item'     => $ads[count($ads)-1],
		'ads_guid' => $ads_guid,
		'timer'    => $timer,
	));
	echo ossn_plugin_view('widget/view', array(
			'title' => ossn_print('sponsored'),
			'contents' => $item,
	));	
	echo '</div>';
}
?>
