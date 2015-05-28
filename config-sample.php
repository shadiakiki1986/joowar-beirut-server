<?php

# Copy this file to config.php
# and edit it with the proper parameter values

define("ROOT", dirname(__FILE__));
require_once ROOT.'/vendor/autoload.php'; #  if this line throw an error, I probably forgot to run composer install

# AWS connection information
define('AWS_KEY','abcdefghi');
define('AWS_SECRET','abcdefghi');
define('AWS_REGION','abcdefghi');

# S3
define('S3_BUCKET',"zboota-server");
define('S3_FOLDER',"joowar-beirut-maps");
