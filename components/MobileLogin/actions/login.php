<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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
if(is_numeric($email)){
	$user = ossn_user_by_mobile($email);
	if($user){
		$email = $user->email;
	}
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
		//One uneeded redirection when login #516
		ossn_trigger_callback('login', 'success', $vars);
		redirect('home');
} else {
		redirect('login?error=1');
}
