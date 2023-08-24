<?php
/**
 * Manages Module Migrations
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @package         grunt-tasks\Helpers
 * @copyright       ©2015 Noriskshop
 *
 * @author          Amely Kling <akling@noriskshop.de> - *Initial development*
 *
 */


/* Parse Arguments
 * =================================================================================================================== */

array_shift($argv); // skip phpfile
$environment = array_shift($argv);
$module = array_shift($argv);
$action = array_shift($argv);

echo "\nMigrate $module in $environment\n";


/* Connect to OXID Environment (MySQL)
 * =================================================================================================================== */

require_once __DIR__. "/inc/oxid.php";
$connection = Database::getConnection($environment);

/* Include and run nrMigrations
 * =================================================================================================================== */

require_once __DIR__."/inc/nrMigrations.php";

// init migrations
$migrations = new nrMigrations($environment, $module, $connection);

// run action
switch($action) {
    default:
    case "migrate":
        $res = $migrations->migrate();
        break;
    case "reset":
        $res = $migrations->reset();
        break;
}

// return exit values
if ($res["success"]) {
    echo $res["message"];
    exit(0);
} else {
    echo $res["message"];
    exit(1);
}
