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

class CodeFW {

	function CodeFW(){
		var_dump("Hello World");
		//$this->createMenu();
	}

	function createMenu(){
		//add_menu_page( 'My Page Title', 'My Page', 'edit_others_posts', 'my_page_slug', 'my_page_function', plugins_url( 'myplugin/images/icon.png' ), 6 );
	}

	function loadView(){
		//echo "Ola Mundo";
	}
}

//initialize this things
$CodeFW_plugin = new CodeFW();

?>
