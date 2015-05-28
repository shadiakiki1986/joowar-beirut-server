<?php

require_once dirname(__FILE__).'/../config.php';
use Aws\S3\S3Client;

class JoowarBeirutS3Client {

protected $client;

function __construct() {
	if(!defined("S3_BUCKET")) throw new Exception("Please define the S3_BUCKET variable in the joowar-beirut-server config file");
	if(!defined("S3_FOLDER")) throw new Exception("Please define the S3_FOLDER variable in the joowar-beirut-server config file");
	if(!defined("AWS_KEY")||!defined("AWS_SECRET")||!defined("AWS_REGION")) throw new Exception("Please define your AWS properties in the joowar-beirut-server config file");

}

function connect() {
	$this->client=S3Client::factory(array(
	    'key' => AWS_KEY, # check config file
	    'secret'  => AWS_SECRET,
	    'region'  => AWS_REGION
	));
}

function test() {
	if(!$this->client->isValidBucketName(S3_BUCKET)) throw new Exception("Why did I name my S3 bucket ".S3_BUCKET."?");
	if(!$this->client->doesBucketExist(S3_BUCKET)) throw new Exception("Where is my S3 bucket?");
	if(!$this->client->doesObjectExist(S3_BUCKET,S3_FOLDER."/")) throw new Exception("Where is the root folder?");
}

function listMaps() {
	$o1=$this->client->getIterator('ListObjects', array(  'Bucket' => S3_BUCKET, 'Prefix' => S3_FOLDER));
	$o2=array();
	foreach ($o1 as $object) { array_push($o2,preg_replace("/".S3_FOLDER."\/(.*)/","$1",$object['Key'])); }
	$o2=array_filter($o2,function($x) { return $x!=""; });
	return $o2;
}

function put($mapName,$mapData) {
# Stores the map json into a file on S3
# $mapName: Name of map to use
# $mapData: json format of map

	// Name of file to use on S3
	if($mapName!=basename($mapName)) die("Misuse");

	//
	$this->client->putObject(array(
		'Bucket'=>S3_BUCKET,
		'Key'=>S3_FOLDER."/".$mapName,
		'Body'=>$mapData
	));
}

function get($mapName) {
# Get an uploaded map
# $mapName

	$result=$this->client->getObject(array(
		'Bucket'=>S3_BUCKET,
		'Key'=>S3_FOLDER."/".$mapName
	));
	return (string)$result['Body'];
}

}
