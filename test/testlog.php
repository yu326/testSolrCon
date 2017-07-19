<?php
/**
 * Created by PhpStorm.
 * User: koreyoshi
 * Date: 2017/7/19
 * Time: 17:48
 */

echo phpinfo();
die;

include_once("../util/include.php");
initLogger(LOGNAME_TEST);

$logger->info(__FUNCTION__ . __FILE__ . __LINE__ . " the is a test info level data~");
$logger->debug(__FUNCTION__ . __FILE__ . __LINE__ . " the is a test debug level data~");