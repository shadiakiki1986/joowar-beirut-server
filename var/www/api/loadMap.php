<?php

header("Access-Control-Allow-Origin: *");

# Example usage:
# php loadMap.php mapLaMadonna.json

require_once dirname(__FILE__).'/../../../config.php';
require_once ROOT.'/lib/JoowarBeirutS3Client.php';

if(isset($argc) && $argc>1) {
	$name0=$argv[1];
} else {
	if(!array_key_exists("name",$_GET)) throw new Exception("Wrong usage of GET");
	$name0=$_GET["name"];
}
$name0=rtrim(ltrim($name0));
if($name0=="" ) throw new Exception("Map: Empty name passed");

// security check
if(basename($name0)!=$name0) {
	throw new Exception("Map with name '$name0' contains a path, and hence is a security threat");
} else {
	// open the file in a binary mode
	$s3=new JoowarBeirutS3Client();
	$s3->connect();
	echo $s3->get($name0);
}
