<div class="col-md-11">
	<div class="ossn-profile-edit-layout">
		<div class="profile-edit-layout-title">
			<?php echo ossn_print('edit'); ?>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="profile-edit-tabs">
					<?php
						echo ossn_view_menu('profile/edit/tabs', 'profile/menus/edittabs')
						?>
				</div>
			</div>
			<div class="col-md-9">
				<div class="profile-edit-layout-right">
					<?php echo $params['contents'];?>
					<hr/>
					<a id="delete-account" class="btn btn-danger" data-confirm-msg="Confirm deletion!" href="<?php echo ossn_add_tokens_to_url(ossn_site_url('action/gdpr/delete/account')); ?>"><?php echo ossn_print('gdpr:deleteaccount'); ?></a>
					<script>
						if($.isFunction($.fn.btsConfirmButton)){
							$(document).ready(function() {
								$('#delete-account').btsConfirmButton(function(e) {
									window.location = $('#delete-account').attr('href');
									$('#delete-account').hide();
								});
							});
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>