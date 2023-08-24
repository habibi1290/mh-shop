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
$module = array_shift($argv);
$action = array_shift($argv);

if (!$action) {
    $action = "activate";
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
    include_once(realpath(dirname(__FILE__) . "/../../..") . "/source/bootstrap.php");

    // echo what we're doing
    echo "\n$action module $module for $cwd\n";

    // loop through all shops
    foreach (\OxidEsales\Eshop\Core\Registry::getConfig()->getShopIds() as $iShopId) {
        // set shop id
        \OxidEsales\Eshop\Core\Registry::getConfig()->setShopId($iShopId);
        \OxidEsales\Eshop\Core\Registry::getConfig()->reinitialize();

        // get necessary objects
        $oModule = oxNew(\OxidEsales\Eshop\Core\Module\Module::class);

        // get module
        if (!$oModule->load($module)) {
            throw new oxException('EXCEPTION_MODULE_NOT_LOADED');
        }

        $oModuleCache = oxNew(\OxidEsales\Eshop\Core\Module\ModuleCache::class, $oModule);
        $oModuleInstaller = oxNew(\OxidEsales\Eshop\Core\Module\ModuleInstaller::class, $oModuleCache);

        // always deactivate
        $oModuleInstaller->deactivate($oModule);

        // Internal caching is very deep. This is the easiest way to fix it
        $aModuleControllers = \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('aModuleControllers');
        \OxidEsales\Eshop\Core\Registry::getUtilsObject()->setModuleVar('aModuleControllers', $aModuleControllers);

        // activate module (if action is activate)
        if ($action == "activate") {
            $oModuleInstaller->activate($oModule);
        }
    }
}


/* Catched Exception
 * =================================================================================================================== */

catch (Exception $oEx) {
    echo $oEx->getMessage() . "\n" . $oEx->getTraceAsString();
    exit(1);
}
