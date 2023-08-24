<?php
/**
 * Manages Migration for modules
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @package         grunt-tasks\Helpers
 * @copyright       ©2015 Noriskshop
 *
 * @author          Amely Kling <akling@noriskshop.de> - *Initial development*
 *
 */

require_once __DIR__ . '/nrSQLRunner.php';

class nrMigrations
{

    /* Variables
     * =============================================================================================================== */

    var $environment;
    var $module;
    var $sqlRunner;

    var $module_version;
    var $database_version;
    var $migrations;
    var $versions;

    var $basedir;

    var $mysql_connection;

    /* Constructor
     * =============================================================================================================== */

    public function __construct($environment, $module, $mysql_connection)
    {
        $this->environment = $environment;
        $this->module = $module;

        $this->sqlRunner = new nrSQLRunner($mysql_connection);

        $this->mysql_connection = $mysql_connection;

        // set path to environment if environment is not ROOT
        if ($environment == "ROOT") {
            $path = "";
        } else {
            $path = "$this->environment/";
        }

        // set subpath to grunt if module = OXID
        if ($this->module == "OXID") {
            $subpath = "grunt/migrations";
        } else {
            $subpath = "source/modules/$this->module/install/migrations";
        }

        // combine basedir
        $this->basedir = $path . $subpath;

        // inits
        if ($this->hasMigrationsDir()) {
            $this->loadMigrations();

            if ($this->hasMigrations()) {
                $this->initTable();
                $this->getDatabaseVersion();
                $this->getModuleVersion();
            }
        }
    }


    /* Public Methods
     * =============================================================================================================== */

    /**
     * migrate
     * -----------------------------------------------------------------------------------------------------------------
     * Get pending Migrations and send to SQL Runner
     */
    public function migrate()
    {
        if (!$this->hasMigrationsDir() || !$this->hasMigrations()) {
            return array("success" => true, "message" => "No Migrations found.");
        }

        if (function_exists('posix_getlogin')) {
            $processUserName = posix_getlogin();
        } else {
            $processUserName = "unknown";
        }

        $pendingMigrations = $this->getPendingMigrations();

        if ($pendingMigrations) {
            foreach ($pendingMigrations as $version => $migration) {
                echo "Running migration $migration ... ";

                if ($this->sqlRunner->runFile($migration)) {
                    echo "successfully\n";
                    // store status
                    mysqli_query($this->mysql_connection, "INSERT INTO nrMigrations (identifier, version, sqlfile, executed_by) VALUES ('$this->module', $version, '$migration', '$processUserName');");
                } else {
                    echo "failed!\n";

                    return array("success" => false, "message" => "Corrupt SQL-File");
                    break;
                }
            }

            return array("success" => true, "message" => "Completed all migrations for $this->module");
        } else {
            return array("success" => true, "message" => "Migrations for $this->module are up to date.");
        }
    }

    /**
     * reset
     * -----------------------------------------------------------------------------------------------------------------
     * ..
     */
    public function reset()
    {
        $resetFile = "$this->basedir/reset.sql";

        if (!file_exists($resetFile)) {
            return array("success" => true, "message" => "No Reset SQL found.");
        }

        if ($this->database_version == $this->module_version) {
            echo "Resetting $resetFile ... ";
            if ($this->sqlRunner->runFile($resetFile)) {
                echo "successfully\n";
                // store status
                mysqli_query($this->mysql_connection, "DELETE FROM nrMigrations WHERE identifier = '$this->module';");

                return array("success" => true, "message" => "Reset successful for $this->module");
            } else {
                echo "failed!\n";

                return array("success" => false, "message" => "Corrupt Reset SQL-File");
            }
        } else {
            return array("success" => false, "message" => "Database is not up to date. Reset would probably break. Try running migrations before, or reset manually.");
        }
    }

    /* Private Methods
     * =============================================================================================================== */

    /**
     * initTable
     * -----------------------------------------------------------------------------------------------------------------
     * Initializes table for storing migration data
     *
     */
    private function initTable()
    {
        $this->sqlRunner->runFile(__DIR__ . "/../sql/init.sql");
    }

    /**
     * getDatabaseVersion
     * -----------------------------------------------------------------------------------------------------------------
     * gets the current migration version for a module in the database
     *
     */
    private function getDatabaseVersion()
    {
        $result = mysqli_query($this->mysql_connection, "SELECT version FROM nrMigrations WHERE identifier='$this->module' ORDER BY VERSION DESC LIMIT 1");

        if (!$result) {
            throw new Exception("Database query failed: " . mysqli_error($this->mysql_connection));
        }

        if (mysqli_num_rows($result) > 0) {
            $state = mysqli_fetch_assoc($result);
            $this->database_version = intval($state["version"]);
        } else {
            $this->database_version = -1;
        }
    }

    /**
     * getModuleVersion
     * -----------------------------------------------------------------------------------------------------------------
     * get current module migration version
     *
     */
    private function getModuleVersion()
    {
        $this->module_version = $this->versions[count($this->versions) - 1];
    }

    /**
     * hasMigrationsDir
     * -----------------------------------------------------------------------------------------------------------------
     * get migration files from module
     */
    private function hasMigrationsDir()
    {
        return file_exists($this->basedir);
    }

    /**
     * get Migrations
     * -----------------------------------------------------------------------------------------------------------------
     * get migration files from module
     */
    private function loadMigrations()
    {
        // get files
        $files = scandir($this->basedir);
        // filter files
        $files = preg_grep("/\d+-[\w\-_]+\.sql/", $files);

        // push into migrations array
        $this->migrations = array();
        foreach ($files as $sqlfile) {
            $parts = explode("-", $sqlfile);
            $this->migrations[$parts[0]] = "$this->basedir/$sqlfile";
        }

        // sort array by version
        ksort($this->migrations);

        // store versions
        $this->versions = array_keys($this->migrations);
    }

    /**
     * getPendingMigrations
     * -----------------------------------------------------------------------------------------------------------------
     * compare version numbers and collect pending migrations (version > database_version)
     *
     * @return array|null
     */
    private function getPendingMigrations()
    {
        $pendingMigrations = null;
        if ($this->module_version > $this->database_version) {
            $pendingMigrations = Array();
            foreach ($this->migrations as $version => $migration) {
                if ($version > $this->database_version) {
                    $pendingMigrations[$version] = $migration;
                }
            }
        }

        return $pendingMigrations;
    }

    private function hasMigrations()
    {
        return (bool) count($this->migrations);
    }
}
