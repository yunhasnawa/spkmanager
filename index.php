<?php

use framework\icf\main\ICF_Globals;

use framework\icf\main\ICF_Setting;

/**
 * @author Yoppy Yunhasnawa
 * @copyright 2011
 */

include 'framework/icf/core.php';

use framework\icf\main\ICF_Application;

$route = array(
    '' => array('Home', 'index'),
	'index' => array('Home', 'index'),
	'spk' => array('Buat_Spk', 'baru'),
	'spk/edit' => array('Buat_Spk', 'edit'),
	'spk/save' => array('Buat_Spk', 'save'),
	'spk/delete' => array('Buat_Spk', 'delete'),
	'status' => array('Status_Spk', 'index'),
	'status/ajax_change_status' => array('Status_Spk', 'ajaxChangeStatus'),
	'cetak' => array('Cetak_Spk', 'index'),
	'cetak/preview' => array('Cetak_Spk', 'preview'),
	'auth' => array('Authentication', 'accountHome'),
	'auth/' => array('Authentication', 'accountHome'),
	'auth/accountHome' => array('Authentication', 'accountHome'),
	'auth/login' => array('Authentication', 'login'),
	'auth/logout' => array('Authentication', 'logout'),
);

$app = new ICF_Application(ICF_Globals::$BROWSER_URL, $route);

$app->execute();

?>