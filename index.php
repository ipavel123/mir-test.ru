<?php

header("Content-type:text/html; charset=utf-8");

require_once '/core.php';
require_once '/agency.php';

$core = new core();
$core->route($_SERVER['REQUEST_URI']);
$agency = new agency();
$action = 'x' . $agency->string_to_camel('_', $core->uri_action ? : 'get_list');

call_user_func_array(array($agency, $action), $core->uri_params ? : array());
die();
?>
