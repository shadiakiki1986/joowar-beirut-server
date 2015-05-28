<?php

header("Access-Control-Allow-Origin: *");

# Example usage:
# php loadMap.php mapLaMadonna.json

require_once dirname(__FILE__).'/../../../config.php';
require_once ROOT.'/lib/JoowarBeirutS3Client.php';

	// open the file in a binary mode
	$s3=new JoowarBeirutS3Client();
	$s3->connect();
	echo json_encode($s3->listMaps());
