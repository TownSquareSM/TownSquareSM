<?php 
$new_admin = input('user');
$group     = ossn_get_group_by_guid(input('group'));

if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin() && !$group->isUserGroupAdmin($group->guid,ossn_loggedin_user()->guid)) {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}


if ($group->removeAsGroupAdmin($group->guid,$new_admin)) {
    ossn_trigger_message("User removed as Group Admin succesfully!!");
    redirect("group/{$group->guid}/members");
} else {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}

?>