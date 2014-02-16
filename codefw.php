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


function installDataBase(){
    global $wpdb;
    $sql = "CREATE TABLE IF NOT EXISTS `codefw_client` (
  `id` VARCHAR(255) NOT NULL COMMENT 'Is a guid',
  `id_user` VARCHAR(45) NULL COMMENT 'What user',
  `is_active` TINYINT(1) NULL COMMENT 'If this client is active or not',
  `end_date` BIGINT(10) NULL COMMENT 'When this client expires',
  `ip` VARCHAR(20) NULL COMMENT 'Client IP Address',
  `app` VARCHAR(255) NULL COMMENT 'What CodeFW app',
  `_creation` BIGINT(10) NULL COMMENT 'When this record was created',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB
COMMENT = 'Manage active codefw clients';";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook(__FILE__, 'installDataBase');

$codefw = new CodeFW();
//var_dump($codefw->getApps());

?>
