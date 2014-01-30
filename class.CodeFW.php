<?php

error_reporting(E_ALL);

/**
 * Main class of codefw framework. 
 * The core functions and the integration with Wordpress are here
 *
 * @author João Patrício
 * @since 2014/01
 * @version 1.0
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include CodeFW_App
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.CodeFW_App.php');

/* user defined includes */
// section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000967-includes begin
// section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000967-includes end

/* user defined constants */
// section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000967-constants begin
// section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000967-constants end

/**
 * Main class of codefw framework. 
 * The core functions and the integration with Wordpress are here
 *
 * @access public
 * @author João Patrício
 * @since 2014/01
 * @version 1.0
 */
class CodeFW
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Application List
     *
     * @access public
     * @see CodeFW_App Class
     * @var CodeFW_App
     */
    public $apps = null;

    // --- OPERATIONS ---

    /**
     * Create a codefw object
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function CodeFW()
    {
        // section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000978 begin
            
            $json = file_get_contents(plugin_dir_path(__FILE__)."../codefw-apps/apps.json");
            //$json = file_get_contents( );  
            var_dump(json_decode($json));
            //foreach app
                // 
                // create a menu

        // section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000978 end
        
        //add_action('admin_init', array($this, 'addMenuPage'));
    }

    /**
     * Add a menu page into wordpress backend
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function addMenuPage()
    {
        // section 127-0-1-1--362c337a:143e0ac8ec9:-8000:000000000000097E begin
        //add_menu_page( 'CodefW menu', 'CodeFW', null, 'codeFW_Menu', array($this, 'loadView' );
        // section 127-0-1-1--362c337a:143e0ac8ec9:-8000:000000000000097E end
        

    }

    /**
     * Load a app view
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  app
     * @param  viewName
     * @return mixed
     */
    public function loadView($app, $viewName)
    {
        // section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000980 begin
        echo "Hello World";
        // section 127-0-1-1--362c337a:143e0ac8ec9:-8000:0000000000000980 end
    }

    /**
     * Returns an app
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  name App name
     * @return mixed
     */
    public function getApp($name)
    {
        // section 127-0-1-1--af3b2eb:143e31b3f52:-8000:0000000000000A83 begin
        // section 127-0-1-1--af3b2eb:143e31b3f52:-8000:0000000000000A83 end
    }

} /* end of class CodeFW */

?>