<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

if(ossn_isLoggedin()) {
		redirect('home');
}
$email    = input('email');
$password = input('password');

if(empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		ossn_trigger_message(ossn_print('login:error'));
		redirect();
}
$user = ossn_user_by_email($email);

if($user && !$user->isUserVALIDATED()) {
		$user->resendValidationEmail();
		ossn_trigger_message(ossn_print('ossn:user:validation:resend'), 'error');
		redirect(REF);
}
$vars = array(
		'user' => $user
);
ossn_trigger_callback('user', 'before:login', $vars);

$login           = new OssnUser;
$login->email    = $email;
$login->password = $password;
if($login->Login()) {
	if (isset($_POST['rememberlogin']) && isset($_COOKIE['rl_bfp'])) {
		// Checkbox is selected
		// store mail in a cookie named "rl_uma" that expires after 1 year
		$data = rembember_me_data();
		if (!ossn_loggedin_user()->isAdmin()) {
			setcookie('rl_uma', ossn_string_encrypt($data, $_COOKIE['rl_bfp'] . ossn_site_settings('site_key')), time() + (86400 * 30 * 12), "/");  // 86400 = 1 day
		}
	}
	//One uneeded redirection when login #516
	ossn_trigger_callback('login', 'success', $vars);
	redirect('home');
} else {
	redirect('login?error=1');
}
