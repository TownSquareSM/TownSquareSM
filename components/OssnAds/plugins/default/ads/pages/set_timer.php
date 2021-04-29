<?php
echo ossn_view_form('set_timer', array(
    'action' => ossn_site_url() . 'action/ossnads/set-timer',
    'component' => 'OssnAds',
    'class' => 'ossn-ads-form',
    'params' => $params,
), false);
