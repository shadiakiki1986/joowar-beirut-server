<?php

# Copy this file to /etc/joowar-beirut-server-config.php
# and edit it with the proper parameter values

# Root directory of installation of joowar-beirut-server
define("ROOT", "/home/shadi/Development/joowar-beirut-server");

# AWS connection information
define("AWS_PHAR","/usr/share/php5/aws.phar");
define('AWS_KEY','abcdefghi');
define('AWS_SECRET','abcdefghi');
define('AWS_REGION','abcdefghi');

# S3
define('S3_BUCKET',"zboota-server");
define('S3_FOLDER',"joowar-beirut-maps");
