<?php
/**
 * Created by PhpStorm.
 * User: koreyoshi
 * Date: 2017/7/19
 * Time: 18:09
 */

/*
 * 初始化记录日志的实例
 * author: Todd
 * param：$conf 日志配置名称
 * return：返回Logger实例
 */
function initLogger($conf)
{
    global $logger;
    $logger = Logger::getLogger($conf);
}

/*
 * 用于计算执行时间，返回当前的时间点
 */
function microtime_float()
{
    //set_log(DEBUG, "enter microtime_float", __FILE__, __LINE__);
    list($usec, $sec) = explode(" ", microtime());
    //set_log(DEBUG, "exit microtime_float", __FILE__, __LINE__);
    return ((float)$usec + (float)$sec);
}



?>