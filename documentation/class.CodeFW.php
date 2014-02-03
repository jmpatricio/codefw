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
     * @author Jo‹o Patr’cio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function CodeFW()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B24 begin
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B24 end
    }

    /**
     * Get the applications list
     *
     * @access public
     * @author Jo‹o Patr’cio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function getApps()
    {
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B2A begin
        // section 127-0-1-1--766a57a2:143ea1b1add:-8000:0000000000000B2A end
    }

    /**
     * Read all active applications from json. Updates the attribute apps
     *
     * @access private
     * @author Jo‹o Patr’cio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    private function readApps()
    {
        // section 127-0-1-1--2052b255:143ea654bd8:-8000:0000000000000ACE begin
        // section 127-0-1-1--2052b255:143ea654bd8:-8000:0000000000000ACE end
    }

    /**
     * Add an app menud to sidepane of wordpress backend
     *
     * @access public
     * @author Jo‹o Patr’cio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function addMenus()
    {
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000ADC begin
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000ADC end
    }

    /**
     * Configure wordpress hooks to add actions
     *
     * @access private
     * @author Jo‹o Patr’cio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    private function runWPHooks()
    {
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000AE3 begin
        // section 127-0-1-1-7dcf081a:143ea6edf6e:-8000:0000000000000AE3 end
    }

    /**
     * Loads an app from wordpress side menu
     *
     * @access public
     * @author Jo‹o Patr’cio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function loadApp()
    {
        // section 127-0-1-1--60f43130:143ea95fd0a:-8000:0000000000000AE9 begin
        // section 127-0-1-1--60f43130:143ea95fd0a:-8000:0000000000000AE9 end
    }

} /* end of class CodeFW */

?>