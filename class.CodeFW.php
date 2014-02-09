<?php

error_reporting(E_ALL);

/**
 * Core class of codefw framework. This class is the bridge between CodeFW
 * and the Wordpress
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * Defines a CodeFW Application.
 * Every application must have an instance of this class.
 *
 * @author Joao Patricio
 * @since 1.0
 * @version 1.0
 */
require_once('class.CodeFW_App.php');

/* user defined includes */
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B18-includes begin
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B18-includes end

/* user defined constants */
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B18-constants begin
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B18-constants end

/**
 * Core class of codefw framework. This class is the bridge between CodeFW
 * and the Wordpress
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class CodeFW
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Lost of current apps
     *
     * @access private
     * @since 1.0
     * @var Array
     */
    private $apps = null;

    // --- OPERATIONS ---

    /**
     * Create a new instance of CodeFW
     *
     * @access public
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function CodeFW()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B24 begin
        $this->readApps();
        $this->runWPHooks();
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B24 end
    }

    /**
     * Get the applications list
     *
     * @access public
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function getApps()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B2A begin
        return $this->apps;
        
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B2A end
    }

    /**
     * Read all active applications from json. Updates the attribute apps
     *
     * @access private
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    private function readApps()
    {
        // section 127-0-1-1--2052b255:143ea654bd8:-8000:0000000000000ACE begin
        $appsDir = CodeFW_App::getBaseDir();
        $json = $appsDir.'apps.json';
        $apps = json_decode(file_get_contents($json));
        foreach ($apps->enabled as $app){
            if (CodeFW_App::exists($app)){
                $this->apps[$app] = new CodeFW_App($app);
            }
        }
        
        // section 127-0-1-1--2052b255:143ea654bd8:-8000:0000000000000ACE end
    }

    /**
     * Add an app menud to sidepane of wordpress backend
     *
     * @access public
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function addMenus()
    {
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000ADC begin
        foreach ($this->apps as $app){
            add_menu_page( $app->getConfig()->info->name, $app->getConfig()->info->name, 'activate_plugins', $app->getName(), array($this, 'loadApp'));   
        }
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000ADC end
    }

    /**
     * Configure wordpress hooks to add actions
     *
     * @access private
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    private function runWPHooks()
    {
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000AE3 begin
        add_action('admin_menu', array($this,'addMenus'));
				add_action('admin_enqueue_scripts', array($this,'includeBootstrapFiles'));
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000AE3 end
    }

    /**
     * Loads an app from wordpress side menu
     *
     * @access public
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function loadApp()
    {
        // section 127-0-1-1--60f43130:143ea95fd0a:-8000:0000000000000AE9 begin
        $appName = $_GET['page'];
        if (!empty($appName)){
            $app = $this->apps[$appName];
            $view = $app->getInitialView();
						echo $app->getViewContent($view);
        } else {
            echo "<h3>Ups</h3>";
        }
        // section 127-0-1-1--60f43130:143ea95fd0a:-8000:0000000000000AE9 end
    }

    /**
     * Include bootstrap files on the app's view
     *
     * @access public
     * @author André Bittencourt
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function includeBootstrapFiles()
    {
        // section -64--88-1-2-5a3b52dc:143f96db593:-8000:0000000000000B04 begin
				$bootstrapPath = plugins_url().'/codefw/include/ui/bootstrap/';
                $angularPath = plugins_url().'/codefw/include/ui/angularjs/';
				wp_enqueue_style('booststrap_custom_css', $bootstrapPath.'css/bootstrap-custom.css');
				wp_enqueue_script('bootstrap_min_js', $bootstrapPath.'js/bootstrap.min.js', array('jquery'), '1.0.0', true);
				wp_enqueue_script('angular_js', $angularPath.'angular.js', array());
                wp_enqueue_script('angular_js_route', $angularPath.'angular-route.js', array('angular_js'));
				//wp_enqueue_script('angular_route_js', 'http://ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-route.js', array(), '1.0.0', true);
        // section -64--88-1-2-5a3b52dc:143f96db593:-8000:0000000000000B04 end
    }

} /* end of class CodeFW */

?>
