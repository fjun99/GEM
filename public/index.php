<?php
//define("APPLICATION_PATH", "APP/");
define("APPLICATION_PATH", realpath((phpversion() >= "5.3"? __DIR__: dirname(__FILE__)).'/../'));
$app = new Yaf_Application(APPLICATION_PATH . "/conf/app.ini", 'common');
$app->bootstrap()->run();
