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
$add = new OssnAds;

$params['iframe_height'] = input('iframe_height');
$params['siteurl'] = input('siteurl');
$params['html'] = input('htmleditor');
foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error');
        redirect(REF);
    }
}
$hidden = input('file-submit');
$params['title'] = input('title');
$params['description'] = input('description');
$created_ad = $add->addNewAd($params);
if($hidden === 'file-submit' && $created_ad) {
    redirect("administrator/component/OssnAds?settings=edit&id={$created_ad->guid}");
}
if ($created_ad) {
    ossn_trigger_message(ossn_print('ad:created'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('ad:create:fail'), 'error');
    redirect(REF);
}
