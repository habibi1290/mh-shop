<?php
/**
 * Cleanup Module List
 *
 * Based on p8026/vagrant/phing/activateModules.php by Dominik Obermaier
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @param1 $cwd     Path to Oxid Environment
 * @param2 $action  Action (clean)
 *
 * @package         grunt-tasks\Helpers\Oxid
 * @copyright       ©2015 Noriskshop
 *
 * @author          Amely Kling <akling@noriskshop.de> - *Initial development*
 *
 */


/* Setting error reporting mode
 * =================================================================================================================== */

error_reporting(E_ALL ^ E_NOTICE);


/* Parse Arguments
 * =================================================================================================================== */

array_shift($argv); // skip phpfile
$cwd = array_shift($argv);
$action = array_shift($argv);

if (!$action) {
    $action = "clean";
}


/* Change Working Dir (to OXID environment)
 * =================================================================================================================== */

if ($cwd && $cwd != "" && $cwd != "ROOT") {
    chdir($cwd);
}


/* Execute
 * =================================================================================================================== */

try {
    // run as OXID Admin-Mode
    define('OX_IS_ADMIN', true);

    // run OXIDs bootstrap
    include_once(realpath(__DIR__ . "/../../..") . "/source/bootstrap.php");

    // echo what we're doing
    echo "\n$action modulelist for $cwd\n";

    // loop through all shops
    foreach (\OxidEsales\Eshop\Core\Registry::getConfig()->getShopIds() as $iShopId) {

        // set shop id
        \OxidEsales\Eshop\Core\Registry::getConfig()->setShopId($iShopId);
        if (method_exists(\OxidEsales\Eshop\Core\Registry::getConfig(), 'reinitialize')) {
            // Should exist
            \OxidEsales\Eshop\Core\Registry::getConfig()->reinitialize();
        }


        /* Cleanup unused / old module entries
         * ------------------------------------------------------------------------------------------------------------*/
        echo "Cleanup unused / old module entries for Shop " . $iShopId . "\n";
        $oModuleList = oxNew(\OxidEsales\Eshop\Core\Module\ModuleList::class);
        $oModuleList->cleanup();
    }
}


/* Catched Exception
 * =================================================================================================================== */

catch (Exception $oEx) {
    echo $oEx->getMessage() . "\n" . $oEx->getTraceAsString();
    exit(1);
}
