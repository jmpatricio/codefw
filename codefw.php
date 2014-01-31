<?php

/**
 * Plugin Name: CodeFW
 * Plugin URI: https://github.com/jmpatricio/codefw
 * Description: A coding framework to create modern plugins
 * Version: 1.0
 * Author: João Patrício
 * Author URI: http://#
 * License: GPL2
 */


include "class.CodeFW.php";

/*
$app = new CodeFW_App("hello");
var_dump($app->getName());
var_dump($app->getPath());
var_dump($app->getConfig());
*/
$codefw = new CodeFW();
//var_dump($codefw->getApps());