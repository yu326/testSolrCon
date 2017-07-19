<?php
/**
 * Created by PhpStorm.
 * User: koreyoshi
 * Date: 2017/7/19
 * Time: 17:49
 */




//配置文件根定义
define('CONFIG_DIR', 'U:/testSolrCon');
define('LOG4PHP_DIR', CONFIG_DIR . '/util/log4php');//日志控件地址
//日志名定义
define("LOGNAME_TEST", "test");
define("LOGNAME_SUIXIN", "suixin");
define("LOGNAME_SOLR", "solr");
//引入log4php
include_once(LOG4PHP_DIR . "/Logger.php");
Logger::configure(CONFIG_DIR . "/php_config/log4php.xml");

//
//define('DATABASE_SERVER', 'localhost:3306');    //数据库server
//define('DATABASE_USERNAME', 'root');    //用户名
//define('DATABASE_PASSWORD', 'root');    //密码

//
////默认状态
//define('COMMENT_ISSHOW', 0);
//define('COMMENT_LEVEL', 1);

define('SOLR_PARAM_SELECT', "select");//solr查询
define('SOLR_PARAM_KWBLUR', "kwblur");//solr模糊查询
define('SOLR_PARAM_KWGROUP', "kwgroup");//solr组合关键词查询
define('SOLR_PARAM_KWTOKEN', "kwtoken");//solr分词查询
define('SOLR_PARAM_UPDATE', "update/?type=update");//solr更新
define('SOLR_PARAM_INSERT', "update/?type=insert");//solr新增
define('SOLR_PARAM_DELETE', "update/?type=delete");//solr删除
define('SOLR_PARAM_RETRIEVE', "retrieve");//solr提取数据
define('SOLR_PARAM_DICTIONARY', "dictionary");//solr字典
define('SOLR_PARAM_ANALYSIS', "analysis");//solrNLP的分析



define('SOLR_STORE', "127.0.0.1:9000/solr/collection2/");//新版solr地址
define('SOLR_URL_SELECT', SOLR_STORE . SOLR_PARAM_SELECT);//solr查询地址
define('SOLR_URL_KWBLUR', SOLR_STORE . SOLR_PARAM_KWBLUR);//solr模糊查询地址
define('SOLR_URL_KWGROUP', SOLR_STORE . SOLR_PARAM_KWGROUP);//solr组合关键词查询地址
define('SOLR_URL_KWTOKEN', SOLR_STORE . SOLR_PARAM_KWTOKEN);//solr分词查询地址
define('SOLR_URL_UPDATE', SOLR_STORE . SOLR_PARAM_UPDATE);//solr更新地址
define('SOLR_URL_INSERT', SOLR_STORE . SOLR_PARAM_INSERT);//solr新增地址
define('SOLR_URL_DELETE', SOLR_STORE . SOLR_PARAM_DELETE);//solr删除地址
define('SOLR_URL_RETRIEVE', SOLR_STORE . SOLR_PARAM_RETRIEVE);//solr提取数据地址


define('DEFAULT_HTTP_TIMEOUT',5);

?>