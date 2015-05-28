<?php

header("Access-Control-Allow-Origin: *");

# Example usage (cannot use from CLI) from angular $http:
#
#	$http.post(     ZBOOTA_SERVER_URL+'/api/putMap.php',                
#			{name:'bla',data:{a:[[0,0,0],[0,0,0]],b:...,c:...}},
#		    {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}      
#		).
#		success( function(text) {
#			...
#		}).
#		error( function() {
#			...
#		});                                                                       


require_once '/etc/joowar-beirut-server-config.php';
require_once ROOT.'/lib/JoowarBeirutS3Client.php';

# Angular/php-post stuff
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
if(isset($request["name"])) $name0=$request["name"]; else throw new Exception("Wrong usage of POST");
if(isset($request["data"])) $data=$request["data"]; else throw new Exception("Wrong usage of POST");

$name0=rtrim(ltrim($name0));
$data=rtrim(ltrim($data));
if($name0=="" ) throw new Exception("Map: Empty name passed");
if($data=="" ) throw new Exception("Map: Empty data passed");

// security check
if(basename($name0)!=$name0) {
	throw new Exception("Map with name '$name0' contains a path, and hence is a security threat");
} else {
	// open the file in a binary mode
	$s3=new JoowarBeirutS3Client();
	$s3->connect();
	echo $s3->put($name0,$data);
}
