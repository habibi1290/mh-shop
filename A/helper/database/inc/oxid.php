<?php
/**
 * Initialize SQL Runner for OXID Environment
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @package         grunt-tasks\Helpers
 * @copyright       ©2015 Noriskshop
 *
 * @author          Amely Kling <akling@noriskshop.de> - *Initial development*
 * @author          Andre Zaharias <azaharias@noriskshop.de> - *UTF-8*
 *
 */
/* Get Config
 * =================================================================================================================== */

class Database
{
    public $connection;
    protected static $instance;

    public static function getConnection($environment)
    {
        if (self::$instance === null) {
            self::$instance = new self;
            self::$instance->init($environment);
        }

        return self::$instance->connection;
    }

    /**
     * init
     * -----------------------------------------------------------------------------------------------------------------
     * Loads config and connection
     * Not static since the config variables assume an object
     *
     * @param string $environment
     * @throws Exception
     */
    protected function init($environment)
    {
        $this->loadConfig($environment);

        if ($this->dbType != "mysql" && $this->dbType != "pdo_mysql") {
            throw new Exception('Only MYSQL is supported');
        }

        $this->connect();
    }

    /**
     * loadConfig
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @param string $environment
     * @throws Exception
     */
    protected function loadConfig($environment)
    {
        if ($environment == "ROOT") {
            $configPath = realpath(dirname(__FILE__) . "/../../../..");
            if (is_dir($configPath.'/source')) {
                $configPath.= '/source';
            }
            $configPath .=   "/config.inc.php";
        } elseif (!$environment) {
            $configPath = getcwd() . "/config.inc.php";
        }else {
            $configPath = $environment . "/config.inc.php";
        }

        if (!is_readable($configPath)) {
            throw new Exception("Config file at $configPath ($environment) is not readable");
        }

        require_once $configPath;

        if ($this->dbHost == "localhost") {
            $this->dbHost = "127.0.0.1";
        }
    }

    /**
     * connect
     * -----------------------------------------------------------------------------------------------------------------
     * Connects to the configured db
     *
     * @throws Exception
     */
    protected function connect()
    {
        $connection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPwd);
        if (mysqli_connect_errno()) {
            throw new Exception('Error connecting to MySQL server: ' . mysqli_connect_error());
        }

        // Select database
        if (!mysqli_select_db($connection, $this->dbName)) {
            throw new Exception('Error selecting MySQL database: ' . mysqli_error($connection));
        }

        $this->connection = $connection;

        // Initial queries to set mode and UTF-8 (same as OXID does)
        mysqli_query($connection, 'SET SQL_MODE=""');
        mysqli_query($connection, 'SET NAMES "utf8"');
        mysqli_query($connection, 'SET CHARACTER SET utf8');
        mysqli_query($connection, 'SET CHARACTER_SET_CONNECTION = utf8');
        mysqli_query($connection, 'SET CHARACTER_SET_DATABASE = utf8');
        mysqli_query($connection, 'SET character_set_results = utf8');
        mysqli_query($connection, 'SET character_set_server = utf8');
    }
}
