test:
	phpunit

install:
	cp config-sample.php config.php
	vim config.php
	composer install
