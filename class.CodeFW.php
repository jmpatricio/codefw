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
require_once('include/vendor/autoload.php');
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

    /**
     * Database connection
     *
     * @access private
     * @since 1.0
     * @var Array
     */
    private $db = null;

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

        //initialize the database connection
        $config = new \Doctrine\DBAL\Configuration();
        //..
        $connectionParams = array(
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASSWORD,
            'host' => DB_HOST,
            'driver' => 'pdo_mysql',
        );
        $this->db = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

        $this->readApps();
        $this->runWPHooks();
        register_activation_hook( __FILE__, array( $this, 'installDatabase' ) );
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


            $client = $this->createClient($app);
            //var_dump($user);
            $view = $app->getInitialView();
			echo $app->getViewContent($view, $client['id']);
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
				wp_enqueue_script('angular_js', $angularPath.'angular.js', array(), '1.0.0', true);
				wp_enqueue_script('angular_js_route', $angularPath.'angular-route.js', array('angular_js'), '1.0.0', true);
        // section -64--88-1-2-5a3b52dc:143f96db593:-8000:0000000000000B04 end
    }

    /**
     * Create a new valid client
     *
     * @access private
     * @author Joao Patricio
     * @param  app
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    private function createClient($app)
    {
        // section 127-0-1-1-14c550e7:1443737d2bb:-8000:0000000000000B0B begin

        $client['id'] = $this->createGuid();
        $client['ip'] = $_SERVER['REMOTE_ADDR']; 

        $current_user = wp_get_current_user();
        $client['id_user'] = $current_user->ID;
        $client['app'] = $app->getName();
        $client['is_active'] = 1;

        date_default_timezone_set("UTC"); 
        $client['_creation'] = time();
        $client['end_date'] = $client['_creation'] + (60 * 30); //now + 30 min
        
        $this->cleanClients(); 
        $this->db->insert('codefw_client', $client);

        return $client; 
        // section 127-0-1-1-14c550e7:1443737d2bb:-8000:0000000000000B0B end
    }

    /**
     * Create a new guid.
     *
     * @access private
     * @author Joao Patricio
     * @return mixed
     * @see http://guid.us/GUID/PHP
     * @since 1.0
     * @version 1.0
     */
    private function createGuid()
    {
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C14 begin
        static $guid = '';
        $uid = uniqid("", true);
        $data = mt_rand();
        $data .= isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : mt_rand();
        $data .= isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : mt_rand();
        $data .= isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : mt_rand();
        $data .= isset($_SERVER['LOCAL_PORT']) ? $_SERVER['LOCAL_PORT'] : mt_rand();
        $data .= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : mt_rand();
        $data .= isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : mt_rand();
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = mt_rand(1,10) .   
            substr($hash,  0,  8) . 
            mt_rand(1,10) .
            substr($hash,  8,  4) .
            mt_rand(1,10) .
            substr($hash, 12,  4) .
            mt_rand(1,10) .
            substr($hash, 16,  4) .
            mt_rand(1,10) .
            substr($hash, 20, 12) .
            mt_rand(1,10);
        return $guid; 
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C14 end
    }

    /**
     * Clean old and inactive clients to mantain the table sanity
     *
     * @access public
     * @author Joao Patricio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function cleanClients()
    {
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C1B begin

        $sql = "delete from codefw_client where is_active=:is_active or end_date < :now";

        // query        
        $q = $this->db->prepare($sql);

        // bind parameters
        date_default_timezone_set("UTC");
        $q->bindValue("is_active", 0);
        
        date_default_timezone_set("UTC"); 
        $q->bindValue("now", time());

        // execute query
        $q->execute();
            
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C1B end
    }

} /* end of class CodeFW */

?>
