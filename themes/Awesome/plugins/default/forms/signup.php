<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
	<div class='row'>
		<div class="col-md-6">
			<input type="text" name="firstname" class="form-control" placeholder="<?php echo ossn_print('first:name'); ?>" />
		</div>
		<div class="col-md-6">
			<input type="text" name="lastname" class="form-control" placeholder="<?php echo ossn_print('last:name'); ?>" />
		</div>
	</div>
	<div class='row'>
		<div class="col-md-6">
			<input type="text" class="form-control" name="email" placeholder="<?php echo ossn_print('email'); ?>" />
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" name="email_re" type="text" placeholder="<?php echo ossn_print('email:again'); ?>" />
		</div>
	</div>
	<div class='row'>
		<div class="col-md-12">
			<input type="password" class="form-control" name="password" placeholder="<?php echo ossn_print('password'); ?>" />
		</div>
	</div>
<?php
$fields = ossn_default_user_fields();
if($fields){
			$vars	= array();
			$vars['items'] = $fields;
			echo ossn_plugin_view('user/fields/item', $vars);
}
?>
<div class="row">
	<div class="col-md-12">
 		<div>
			<?php echo ossn_fetch_extend_views('forms/signup/before/submit'); ?>
		</div>
		<div id="ossn-signup-errors" class="alert alert-danger"></div>
		<p>
			<?php echo ossn_print('account:create:notice'); ?>
			<?php //Loosing typed in data when clicking Terms and Conditions link #620 ?>
			<a target="_blank" href="<?php echo ossn_site_url('site/terms'); ?>">
				<?php echo ossn_print('site:terms'); ?>
			</a>
		</p>
		<div class="ossn-loading ossn-hidden"></div>
		<input type="submit" id="ossn-submit-button"  class="btn <?php echo oa_theme_get_settings('btnoutline');?>" value="<?php echo ossn_print('create:account'); ?>" class="" />   
    </div>
</div>