<?php
/**
 * Returns or saves which migrations have been run (the maximum "version")
 * nrMigrations.json is saved when called via CLI
 * Otherwise the JSON data is output directly
 *
 * This file will be directly uploaded to a server and will probably not be located in some grunt subfolder
 * That's why the Database class is not included
 * Also we can't just use OXID directly because OXID might throw segfaults at the moment
 * but we still want migration info
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @package         grunt-tasks\Helpers
 * @copyright       ©2018 norisk GmbH
 *
 * @author          Amely Kling <akling@noriskshop.de>              - *Initial development*
 * @author          Maximilian Zwack <mzwack@noriskshop.de>         - DEV-125: Refactoring/Cleanup
 */

if (PHP_SAPI !== 'cli' && $_GET["auth"] != "80b317b6cdb7552cf449222e47d572518959c91f") {
    echo "[]";
    exit;
}

/* Connect to OXID Environment (MySQL)
 * =================================================================================================================== */

class nrConfig
{
    public function init()
    {
        include_once("config.inc.php");
    }
}

$config = new nrConfig();
$config->init();

if ($config->dbHost == "localhost") {
    $config->dbHost = "127.0.0.1";
}

/* Connect MYSQL
 * =================================================================================================================== */

// is type mysql?
if ($config->dbType != "mysql" && $config->dbType != "pdo_mysql") die('Only MYSQL is supported');

// Connect to MySQL server
$connection = mysqli_connect($config->dbHost, $config->dbUser, $config->dbPwd);
if (mysqli_connect_errno()) {
    echo 'Error connecting to MySQL server: ' . mysqli_connect_error() . PHP_EOL;
    exit(1);
}

// Select database
if (!mysqli_select_db($connection, $config->dbName)) {
    echo 'Error selecting MySQL database: ' . mysqli_error($connection) . PHP_EOL;
    exit(1);
}

/* Get Migrations from DB
 * =================================================================================================================== */

$result = mysqli_query($connection, "SELECT identifier, MAX(version) as version FROM nrMigrations GROUP BY identifier");

$migrations = array();
if ($result) {
    $migrations = $result->fetch_all(MYSQLI_ASSOC);
}

/* Save Migrations to JSON
 * =================================================================================================================== */

if (PHP_SAPI === 'cli') {
    file_put_contents("nrMigrations.json", json_encode($migrations, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
} else {
    echo PHP_EOL . json_encode($migrations) . PHP_EOL;
}
