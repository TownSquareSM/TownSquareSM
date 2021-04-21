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
?>
<div class="row">
<div class="col-sm-6">
<h4><?php echo $params['entity']->title;?></h4>
<a href="<?php echo $params['entity']->site_url;?>"><?php echo $params['entity']->site_url;?></a>
<p><?php echo $params['entity']->description;?></p>
<div class="ossn-ad-image" style="background:url('<?php echo ossn_ads_image_url($params['entity']->guid);?>') no-repeat;background-size: contain;"></div></div>
<div class="col-sm-6">
<div>This is how the ad looks like</div>
<iframe src="<?php echo ossn_ads_iframe_url($params['entity']->guid); ?>" style="border: 1px solid black;" width="250" height="<?php echo $params['entity']->iframe_height; ?>" frameborder="0"></iframe>
</div>
</div>