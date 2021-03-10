<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team https://www.softlab24.com/contact
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

define('BPAGE', ossn_route()->com . 'BusinessPage/');
require_once(BPAGE . 'classes/Page.php');
require_once(BPAGE . 'classes/Cover.php');
require_once(BPAGE . 'classes/Photo.php');
require_once(BPAGE . 'classes/Like.php');
ossn_register_system_sdk('BusinessPage', 'business_pages_init_116');