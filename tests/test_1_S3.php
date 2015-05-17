<?php

//define("ROOT", "/home/ubuntu/Development/zboota-server"); // Development ROOT
require_once '/etc/joowar-beirut-server-config.php';
require_once ROOT.'/lib/JoowarBeirutS3Client.php';

$s3=new JoowarBeirutS3Client();
$s3->connect();
$s3->test();
var_dump($s3->listMaps());

$f1=$s3->put("mapLaMadonna.json",'{"map":"bla","a":"bli"}');

var_dump($s3->listMaps());

var_dump($s3->get("mapLaMadonna.json"));


