<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-page-contents">
    	<?php
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('bpage:add'),
						'contents' => ossn_view_form('bpage/add', array(
								'action' => ossn_site_url('action/bpage/add'),
					 	 )),
			));
		?>
</div>