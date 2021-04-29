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
$edit = new OssnAds;

$params['siteurl'] = input('siteurl');
$params['iframe_height'] = input('iframe_height');
$params['guid'] = input('entity');
$params['html'] = input('htmleditor');

foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error');
        redirect(REF);
    }
}
$params['title'] = input('title');
$params['description'] = input('description');

$hidden = input('file-submit');
$editedAd = $edit->EditAd($params);
if ($hidden === 'file-submit' && $editedAd) {
    redirect("administrator/component/OssnAds?settings=edit&id={$params['guid']}");
}
if ($editedAd) {
    ossn_trigger_message(ossn_print('ad:edited'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('ad:edit:fail'), 'error');
    redirect(REF);
}
