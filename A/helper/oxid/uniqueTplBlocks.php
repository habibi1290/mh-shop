<?php
/**
 * Activate OXID module in given environment
 *
 * Based on p8026/vagrant/phing/activateModules.php by Dominik Obermaier
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @param1 $cwd     Path to Oxid Environment
 * @param2 $module  Module
 * @param3 $action  What should happen?  (activate | deactivate)
 *
 * @package         grunt-tasks\Helpers\Oxid
 * @copyright       ©2015 Noriskshop
 *
 * @author          Stan Saric <ssaric@noriskshop.de> - *Initial development*
 * @author          Amely Kling <akling@noriskshop.de> - *Initial development*
 *
 */


/* Setting error reporting mode
 * =================================================================================================================== */

set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);

/* Parse Arguments
 * =================================================================================================================== */

array_shift($argv); // skip phpfile
$key = array_shift($argv);
$cwd = array_shift($argv);


/* Security
 * =================================================================================================================== */

// Enforce CLI
if (php_sapi_name() !== 'cli') {
    die("CLI only. Sorry. ".php_sapi_name());
}

if($key !== '20592bfa3767ee5cdf1fc953ff4505d4'){
    die("Wrong Key. Sorry. ".$key);
}

/* Change Working Dir (to OXID environment)
 * =================================================================================================================== */

if ($cwd && $cwd != "" && $cwd != "ROOT") {
    chdir($cwd);
}


/* Execute
 * =================================================================================================================== */

try {
    // run OXIDs bootstrap
    include_once(realpath(dirname(__FILE__) . "/../../..") . "/source/bootstrap.php");

    // cli
    echo "Delete duplicate entries in oxtplblocks in $cwd\n";

    // log
    \OxidEsales\Eshop\Core\Registry::getUtils()->writeToLog(date(DATE_ATOM)." Deleting duplicate entries" . PHP_EOL, "nrFixOxtplblocks.txt");

    // db connection
    $oDb = oxDb::getDb(oxDb::FETCH_MODE_ASSOC);

    // delete statement (deletes newer duplicates)
    $sSql = "delete q1 FROM oxtplblocks q1, oxtplblocks q2 WHERE
                q1.oxtimestamp < q2.oxtimestamp AND
                q1.oxactive=q2.oxactive and
                q1.oxshopid=q2.oxshopid and
                q1.oxtemplate=q2.oxtemplate and
                q1.oxblockname=q2.oxblockname and
                q1.oxfile=q2.oxfile and
                q1.oxmodule=q2.oxmodule";

    // execute SQL
    $oDb->execute($sSql);

    // cli
    echo "SUCCESS\n";

    // write log
    \OxidEsales\Eshop\Core\Registry::getUtils()->writeToLog(date(DATE_ATOM)." SUCCESS" . PHP_EOL, "nrFixOxtplblocks.txt");

}


    /* Catched Exception
     * =================================================================================================================== */

catch (Exception $oEx) {
    // cli
    echo "FAILED:\n";
    echo $oEx->getMessage() . "\n" . $oEx->getTraceAsString();

    // write log
    \OxidEsales\Eshop\Core\Registry::getUtils()->writeToLog(date(DATE_ATOM)." FAILED" . PHP_EOL. $oEx->getMessage() . PHP_EOL . $oEx->getTraceAsString(), "nrFixOxtplblocks.txt");

    exit(1);
}
