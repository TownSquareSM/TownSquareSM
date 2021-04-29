<?php
$add = new OssnAds;

$params['timer'] = input('timer');
foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error');
        redirect(REF);
    }
}
if ($add->set_ad_timer($params)) {
    ossn_trigger_message(ossn_print('ad:set-timer'), 'success');
    redirect('administrator/component/OssnAds');
} else {
    ossn_trigger_message(ossn_print('ad:set-timer:fail'), 'error');
    redirect(REF);
}
