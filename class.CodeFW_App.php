<?php

error_reporting(E_ALL);

/**
 * Defines a CodeFW Application.
 * Every application must have an instance of this class.
 *
 * @author Joao Patricio
 * @since 1.0
 * @version 1.0
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/* user defined includes */
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AC2-includes begin
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AC2-includes end

/* user defined constants */
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AC2-constants begin
// section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AC2-constants end

/**
 * Defines a CodeFW Application.
 * Every application must have an instance of this class.
 *
 * @access public
 * @author Joao Patricio
 * @since 1.0
 * @version 1.0
 */
class CodeFW_App
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Application name
     *
     * @access private
     * @since 1.0
     * @var String
     */
    private $name = null;

    /**
     * Full path of this application
     *
     * @access private
     * @since 1.0
     * @var String
     */
    private $path = null;

    /**
     * Configuration
     *
     * @access private
     * @since 1.0
     * @var Array
     */
    private $config = null;

    // --- OPERATIONS ---

    /**
     * Get application base directory
     *
     * @access public
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public static function getBaseDir()
    {
        // section 127-0-1-1--2052b255:143ea654bd8:-8000:0000000000000AC8 begin
        return WP_PLUGIN_DIR.'/codefw-apps/';
        // section 127-0-1-1--2052b255:143ea654bd8:-8000:0000000000000AC8 end
    }

    /**
     * Check if a application exists in filesystem
     *
     * @access public
     * @author João Patrício
     * @param  name Application name
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public static function exists($name)
    {
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000AD1 begin
        return file_exists( CodeFW_App::getBaseDir().$name.'/config.json');
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000AD1 end
    }

    /**
     * Creates a new CodeFW_App instance
     *
     * @access public
     * @author João Patrício
     * @param  name Application name. Must be a string without spaces or special characters
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function CodeFW_App($name)
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AD5 begin
        $this->name = $name;
        $this->path = CodeFW_App::getBaseDir().$this->name.'/';
        $this->readConfig();
				add_action('admin_enqueue_scripts', array($this,'includeJsFile'));
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AD5 end
    }

    /**
     * Get app name
     *
     * @access public
     * @author João Patrício
     * @since 1.0
     * @version 1.0
     */
    public function getName()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000ADF begin
        return $this->name;
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000ADF end
    }

    /**
     * Get application path related to wordpress install directory
     *
     * @access public
     * @author Joao Patricio
     * @since 1.0
     * @version 1.0
     */
    public function getPath()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AE5 begin
        return $this->path;
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000AE5 end
    }

    /**
     * Get application config. Returns an array
     *
     * @access public
     * @author João Patrício
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function getConfig()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B07 begin
        return $this->config;
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B07 end
    }

    /**
     * Read application config file. Updates attribute config
     *
     * @access private
     * @author João Patrício
     * @return mixed
     */
    private function readConfig()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B14 begin
        $json = file_get_contents($this->getPath().'/config.json') or null;
        $this->config = json_decode($json);
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B14 end
    }

    /**
     * Get initial view name
     *
     * @access public
     * @author Joao Patricio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function getInitialView()
    {
        // section 127-0-1-1--2b7cee71:143eaa7ed1d:-8000:0000000000000AEE begin
        return $this->getConfig()->settings->initial_view;
        // section 127-0-1-1--2b7cee71:143eaa7ed1d:-8000:0000000000000AEE end
    }

    /**
     * Get the view content in html
     *
     * @access public
     * @author Joao Patricio
     * @param  view View name
     * @param  clientId
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function getViewContent($view, $clientId)
    {
        // section 127-0-1-1--2b7cee71:143eaa7ed1d:-8000:0000000000000AF4 begin
        //var_dump($this->getPath().'views/'.$view.'html');
				$path = preg_replace('#^https?://#', '', plugins_url());
				$path = '/'.$path.'/codefw-apps/'.$this->getName();
				$apiPath = plugins_url().'/codefw-apps/'.$this->getName().'api.php';
				$jsContent = "<script>
	/**
	 * Get api url
	 */
	function codeFW_getApiBaseUrl(){
		return '".$path."/api.php';
	}

	function codeFW_getAppBaseDir(){
		return '".$path."/';
	}

	function codeFW_getClientId(){
		return '".$clientId."';
	}

</script>";
        
    		$content = '<div class="codeFW_Wrap">';
        $content .= $jsContent;
				$content .= file_get_contents($this->getPath().'views/'.$view.'.html');
				$content .= '</div>';
        return $content;
        // section 127-0-1-1--2b7cee71:143eaa7ed1d:-8000:0000000000000AF4 end
    }

    /**
     * Include app.js file
     *
     * @access public
     * @author Andre Bittencourt
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function includeJsFile()
    {
        // section -64--88-1-3-3275a490:1441856423a:-8000:0000000000000B05 begin
				$path = plugins_url().'/codefw-apps/'.$this->getName();
				wp_enqueue_script($this->getName().'_js', $path.'/js/app.js', array('angular_js','angular_js_route'), '1.0.0', true);
        // section -64--88-1-3-3275a490:1441856423a:-8000:0000000000000B05 end
    }

} /* end of class CodeFW_App */

?>