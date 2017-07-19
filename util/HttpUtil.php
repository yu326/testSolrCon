<?php
/**
 * Created by PhpStorm.
 * User: koreyoshi
 * Date: 2017/7/19
 * Time: 17:39
 */


/**
 *   http  请求公共方法
 */


function send_solr(&$statuses_info, $url, $contentType = 'Content-type:application/json')
{
    global $logger;
    if (!$url) {
        $logger->error('opt url is null');
        return false;
    }
//    $logger->debug(__FILE__ . __LINE__ . " curl_exec statuses_info:" . var_export($statuses_info, true));
    if (!empty($statuses_info)) {
        $senddata = json_encode($statuses_info);
    }
    $logger->debug(__FILE__ . __LINE__ . " send data is:" . var_export($senddata, true));
    $timeout = 0;
    //$logger->debug(__FUNCTION__ . " curl_exec statuses_info:" . var_export($statuses_info, true));
    //$logger->debug(__FILE__ . __LINE__ . " invoke solr url:" . $url . " senddata " . var_export($senddata, true));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, DEFAULT_HTTP_TIMEOUT * 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    if (!empty($senddata)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $senddata);
    }


    $header_array = array($contentType);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
    curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);

    $start_time = microtime_float();
    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode != 200) {
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $logger->error(__FILE__ . __LINE__ . " send http request [post] faield. URL:[" . $url . "] Returncode:{$httpCode}, error:{$error}" . " errorNo:[" . $errno . "].");
        curl_close($ch);
        return false;
    }

    $end_time = microtime_float();
    $logger->info(__FUNCTION__ . " 调用solr花费时间:[" . ($end_time - $start_time) . "] 秒！");
    $logger->debug(__FILE__ . __LINE__ . " respones " . var_export($response, true));
    if ($response === FALSE) {
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $logger->error(__FILE__ . __LINE__ . " invoke solr response is false, URL:[" . $url . "] curl errorcode:{$errno}, error:{$error}" . " reqData:[" . (isset($senddata) ? $senddata : "") . "].");
        //$logger->error(__FUNCTION__ . " curl errorcode:{$errno}, error:{$error}");
        curl_close($ch);
        return false;
    } else {
        $data = json_decode($response, true);
        if (empty($data)) {
            $logger->error(__FILE__ . __LINE__ . " invoke solr response json data is null! OriginalData:" . $response);
            curl_close($ch);
            return false;
        } else {
            unset($senddata);
            unset($response);
            curl_close($ch);
            $logger->info(__FILE__ . __LINE__ . " invoke solr success! URL:[" . $url . "]. data:[" . (isset($data) ? var_export($data): "应答数据为空!"));
            return $data;
        }
    }
}


function httpGet($url)
{
    global $logger;
    $start_time = microtime_float();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_TIMEOUT, DEFAULT_HTTP_TIMEOUT * 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $end_time = microtime_float();
    $logger->info(__FUNCTION__ . " 调用solr花费时间:[" . ($end_time - $start_time) . "] 秒！");
    $logger->debug(__FILE__ . __LINE__ . " respones " . var_export($response, true));
    if ($response === FALSE) {
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $logger->error(__FILE__ . __LINE__ . " invoke solr response is false, URL:[" . $url . "] curl errorcode:{$errno}, error:{$error}" . " reqData:[" . (isset($senddata) ? $senddata : "") . "].");
        //$logger->error(__FUNCTION__ . " curl errorcode:{$errno}, error:{$error}");
        curl_close($ch);
        return false;
    } else {
        $data = json_decode($response, true);
        if (empty($data)) {
            $logger->error(__FILE__ . __LINE__ . " invoke solr response json data is null! OriginalData:" . $response);
            curl_close($ch);
            return false;
        } else {
            unset($response);
            curl_close($ch);
            $logger->info(__FILE__ . __LINE__ . " invoke solr success! URL:[" . $url . "]. data:[" . (isset($data) ? $data : "应答数据为空!"));
            return $data;
        }
    }
}


?>