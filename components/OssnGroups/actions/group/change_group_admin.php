<?php 
$new_admin = input('user');
$group     = ossn_get_group_by_guid(input('group'));

if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin() && !$group->isUserGroupAdmin($group->guid,ossn_loggedin_user()->guid)) {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}


if ($group->makeGroupAdmin($new_admin, $group->guid)) {
    ossn_trigger_message("User added as Group Admin successfully!!");
    redirect("group/{$group->guid}/members");
} else {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}

?>