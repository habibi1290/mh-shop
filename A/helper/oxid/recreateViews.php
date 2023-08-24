<?php
/**
 * Recreate Views
 *
 * Based on p8026/vagrant/phing/recreateViews.php by Dominik Obermaier
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @param1 $cwd     Path to Oxid Environment
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
    include_once(realpath(dirname(__FILE__)."/../../..")."/source/bootstrap.php");

    // echo what we're doing
    echo "\nReset Views for $cwd\n"; // Echo here so PHP can still send its "headers"

    // loop through all shops
    foreach (\OxidEsales\Eshop\Core\Registry::getConfig()->getShopIds() as $iShopId) {

        // set shop id
        \OxidEsales\Eshop\Core\Registry::getConfig()->setShopId($iShopId);

        // reset table description cache
        \OxidEsales\Eshop\Core\DatabaseProvider::getInstance()->flushTableDescriptionCache();

        // get oDbMeta
        /** @var $oDbMeta \OxidEsales\Eshop\Core\DbMetaDataHandler */
        $oDbMeta = \OxidEsales\Eshop\Core\Registry::get(\OxidEsales\Eshop\Core\DbMetaDataHandler::class);

        // update views
        $oDbMeta->updateViews();

    }
}


/* Catched Exception
 * =================================================================================================================== */

catch (Throwable $oEx) {
    echo $oEx->getMessage() . "\n" . $oEx->getTraceAsString();
    exit(1);
} catch (Exception $oEx) {
    echo $oEx->getMessage() . "\n" . $oEx->getTraceAsString();
    exit(1);
}
