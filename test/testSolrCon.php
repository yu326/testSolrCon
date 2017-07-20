<?php
/**
 * Created by PhpStorm.
 * User: koreyoshi
 * Date: 2017/7/19
 * Time: 18:20
 */


/**
 *  连接solr  测试update ，delete ， select
 *  solr版本  4.10
 *  字段参见schema.xml
 */
ini_set("error_reporting", "E_ALL & ~E_NOTICE");

include_once("../util/include.php");
initLogger(LOGNAME_TEST);
header("content-type:text/html;charset=utf-8");

try {
    execute();
} catch (Exception $ex) {
    echo $ex->getMessage();
}


function execute()
{
    //查询
//    getDataFromSolr();
    //插入
    insert();
    //修改
//    updateSolrData();
    //删除
//    deleteSolrData();
}

/**
 * @return bool|mixed|null 查询数据
 */

function getDataFromSolr()
{
    global $logger;
    $url = SOLR_URL_SELECT;     //solr的url
    $q = "*:*";
    $other = "&fl=&facet=off&start=0&rows=10&wt=json";

    $finalUrl = $url . "?q=" . $q . "&" . $other;
    $logger->info(" log:  the finalurl is:" . var_export($finalUrl, true) . "!");
    $data = httpGet($finalUrl);
    if (empty($data)) {
        $logger->info("the data is null.");
        return null;
    } else {
        $logger->info("the solr  data is:" . var_export($data, true));
        print_r($data);
        return $data;
    }
}

/**
 *  插入数据
 */
function insert()
{
    global $logger;
    $url = SOLR_URL_UPDATE;
    $q = "type=insert&commit=true";  //commit决定是否刷新到磁盘上
    $finalUrl = $url . "?" . $q;

    //数据
    $sendData = array();
    $sendData[0]['id'] = "yu01_php";
    $sendData[0]['title'] = "title01_php";
    $sendData[0]['content'] = "content01_php";
    $sendData[1]['id'] = "yu02_php";
    $sendData[1]['title'] = "title02_php";
    $sendData[1]['content'] = "content02_php";
    $sendData[2]['id'] = "yu03_php";
    $sendData[2]['title'] = "title03_php";
    $sendData[2]['content'] = "content03_php";

    $data = send_solr($sendData, $finalUrl);
    $logger->info("the data is:" . var_export($data, true));

}

/**
 *  更新数据    //其实solr的insert,update都是一样的。。   都是先检查id师傅存在，不存在则add，存在则update
 */
function updateSolrData()
{
    global $logger;
    $url = SOLR_URL_UPDATE;
    $q = "type=update&commit=true";  //commit决定是否刷新到磁盘上
    $finalUrl = $url . "?" . $q;

    //数据
    $sendData = array();
    $sendData[0]['id'] = "yu01_php";
    $sendData[0]['title'] = "title01_php";
    $sendData[0]['content'] = "content01_php";
    $sendData[1]['id'] = "yu02_php";
    $sendData[1]['title'] = "title02_php";
    $sendData[1]['content'] = "content02_php";
    $sendData[2]['id'] = "yu03_php";
    $sendData[2]['title'] = "title03_php";
    $sendData[2]['content'] = "content03_php";

    $data = send_solr($sendData, $finalUrl);
    $logger->info("the data is:" . var_export($data, true));
}

/**
 *  删除solr的数据
 */
function deleteSolrData()
{
//    {"delete":{"query":"*:*"}}
    global $logger;
    $url = SOLR_URL_DELETE;
    $q = "type=update&commit=true";  //commit决定是否刷新到磁盘上
    $finalUrl = $url . "?" . $q;
    $sendData = array();
    $query['query'] = "*:*";

    $sendData['delete'] = $query;
    $data = send_solr($sendData, $finalUrl);
    $logger->info("the data is:" . var_export($data, true));

}

?>