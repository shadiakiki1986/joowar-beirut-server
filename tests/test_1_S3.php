<?php

require_once dirname(__FILE__).'/../config.php';
require_once ROOT.'/lib/JoowarBeirutS3Client.php';

$s3=new JoowarBeirutS3Client();
$s3->connect();
$s3->test();
var_dump($s3->listMaps());

$f1=$s3->put("mapLaMadonna.json",'{"map":"bla","a":"bli"}');

var_dump($s3->listMaps());

var_dump($s3->get("mapLaMadonna.json"));


