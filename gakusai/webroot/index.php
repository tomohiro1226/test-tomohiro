<?php

require_once (dirname(__FILE__) . '/../../framework/mvc/Dispatchar.php');
require_once (dirname(__FILE__) . '/../../framework/mvc/ModelBase.php');

// DB接続情報設定
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'gakusai',
    'dbuser'   => 'root',
    'password' => ''
);
ModelBase::setConnectionInfo($connInfo );

$dispatcher = new Dispatcher();

// controllers, models, viewsなどを置くフォルダーを指定する
$dispatcher->setSystemRoot(dirname(__FILE__) . "/../backend/");
$dispatcher->dispatch();

?>

