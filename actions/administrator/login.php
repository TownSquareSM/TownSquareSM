<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if (ossn_isAdminLoggedin()) {
    redirect('administrator/dashboard');
}

$email = input('email');
$password = input('password');

if (empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ossn_trigger_message(ossn_print('login:error'), 'error');
    redirect(REF);
}
if (ossn_user_by_email($email)->type !== 'admin') {
    ossn_trigger_message(ossn_print('login:error'), 'error');
    redirect(REF);
}

$login = new OssnUser;
$login->email = $email;
$login->password = $password;
if ($login->Login()) {
    ossn_trigger_message(ossn_print('login:success'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('login:error'), 'error');
    redirect(REF);
}