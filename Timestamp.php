<?php
require_once 'Lib/Utilities.php';

error_reporting(E_ALL);

$ret = array();

$ret['Timestamp'] = time();

Response::sendMsg($ret);


