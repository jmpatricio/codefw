<?php

error_reporting(E_ALL);

/**
 * CodeFW Diagrams - class.CodeFW_App_API.php
 *
 * $Id$
 *
 * This file is part of CodeFW Diagrams.
 *
 * Automatically generated on 20.02.2014, 22:46:46 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/* user defined includes */
// section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C23-includes begin
require_once(dirname(__FILE__).'/../../../wp-config.php');
require_once('include/vendor/autoload.php');
// section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C23-includes end

/* user defined constants */
// section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C23-constants begin
// section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C23-constants end

/**
 * Short description of class CodeFW_App_API
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class CodeFW_App_API
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Short description of attribute dbWp
     *
     * @access private
     * @var Array
     */
    private $dbWp = null;

    // --- OPERATIONS ---

    /**
     * Create a new api base methods
     *
     * @access public
     * @author Joao Patricio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function CodeFW_App_Api()
    {
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C2D begin


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
        $this->dbWp = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);




        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C2D end
    }

    /**
     * Verify if this client call is valid or not
     *
     * @access public
     * @author Joao Patricio
     * @return mixed
     * @since 1,0
     * @version 1.0
     */
    public function validateClient()
    {
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C24 begin
        $clientId = (isset($_GET['clientid'])) ? $_GET['clientid'] : null;

        if ($clientId != null){
            date_default_timezone_set("UTC");
            $sql = "SELECT * FROM codefw_client WHERE id=:clientId and is_active = :is_active and ip=:ip and end_date > :end_date";
            $stmt = $this->dbWp->prepare($sql);
            $stmt->bindValue("is_active", 1);
            $stmt->bindValue("clientId", $clientId);
            $stmt->bindValue("end_date", time());
            $stmt->bindValue("ip", $_SERVER['REMOTE_ADDR']);
            $stmt->execute();
            $client = $stmt->fetchAll();
            if (!empty($client))
                return true;
        }
        return false;
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C24 end
    }

    /**
     * Listen and executes api requests
     *
     * @access public
     * @author Joao Patricio
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    public function listen()
    {
        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C33 begin
        $is_valid = $this->validateClient();

        if (!$is_valid || !isset($_GET['method'])  ){
            //not valid. access denied
            http_response_code(403);
        } else {
            $method_name = $_GET['method'];

            parse_str($_SERVER['QUERY_STRING'], $parameters);
            $this->{$method_name}($parameters);
        }

        // section 127-0-1-1--751a8510:1443b2e74af:-8000:0000000000000C33 end
    }

    /**
     * Send json response to output
     *
     * @access protected
     * @author Joao Patricio
     * @param  response
     * @param  code
     * @return mixed
     * @since 1.0
     * @version 1.0
     */
    protected function sendJSON($response, $code)
    {
        // section 127-0-1-1--8dd4c14:14451795dc8:-8000:0000000000000B3D begin
        echo json_encode($response);
        http_response_code($code);
        // section 127-0-1-1--8dd4c14:14451795dc8:-8000:0000000000000B3D end
    }

} /* end of class CodeFW_App_API */

?>