<?php
/**
 * Run from /export folder.
 *
 * Creates translations of all lang strings that are in templates in the paths given in $aIncludedPaths
 *
 * Export is a csv file in /export/export_lang.csv
 *
 * ---------------------------------------------------------------------------------------------------------------------
 *
 * @copyright       ©2016 Noriskshop
 *
 * @author          Andre Zaharias <azaharias@noriskshop.de>
 * @author          Thomas Heinig <theinig@noriskshop.de> *Error handling and data encoding (to ISO-8859-1)*
 */

require_once __DIR__."/../../../source/bootstrap.php";

array_shift($argv); // skip phpfile

$aIncludedPaths = $argv;

// prepare arrays
$aArrayPrototype = array(
    "path" => "",
    "ident" => "",
);

$aHeader = array(
    "Pfad des Templates",
    "ID"
);

/** @var oxlang $oLang */
$oLang = oxRegistry::getLang();
$aLanguageArray = $oLang->getLanguageArray();

foreach($aLanguageArray as $key => $aLanguage) {
    if ($aLanguage->active == "0") {
        unset($aLanguageArray[$key]);
    }
}

foreach ($aLanguageArray as $oCurLang) {
    $aArrayPrototype[$oCurLang->abbr] = "";
    $aHeader[] = $oCurLang->abbr;
}

$aFullResult = array();

foreach ($aIncludedPaths as $sBasePath) {
    $oIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(OX_BASE_PATH.$sBasePath));
    foreach ($oIterator as $file) {
        if (!$file->isDir()) {
            // only FE templates
            if (strpos($file->getPathname(), "/admin/") !== false) {
                continue;
            }
            if (strpos($file->getPathname(),".tpl") !== false) {
                // read from file and match lang idents
                $sContents = file_get_contents($file->getPathname());
                $aMatches = array();
                preg_match_all('/(?<=oxmultilang ident=")(.*?)(?=")/', $sContents, $aMatches);
                $aMatches = array_unique($aMatches[0]);

                // write to array
                foreach ($aMatches as $sMatch) {
                    $blNewEntry = false;
                    if (!array_key_exists($sMatch, $aFullResult)) {
                        $aFullResult[$sMatch] = $aArrayPrototype;
                        $blNewEntry = true;
                    }
                    $aFullResult[$sMatch]["ident"] = utf8_encode($sMatch);

                    $sFileName = substr($file->getPathname(), strlen(OX_BASE_PATH));
                    if ($blNewEntry) {
                        $aFullResult[$sMatch]["path"] = utf8_encode($sFileName);
                    }
                    else {
                        $aFullResult[$sMatch]["path"] .= " | " . $sFileName;
                        // translation has already been written
                        continue;
                    }

                    // get translation
                    foreach ($aLanguageArray as $oCurLang) {
                        $sTranslation = utf8_decode(html_entity_decode($oLang->translateString($sMatch, $oCurLang->id, true)));
                        if ($sTranslation == $sMatch) {
                            $sTranslation = utf8_decode(html_entity_decode($oLang->translateString($sMatch, $oCurLang->id)));
                        }
                        // if we still haven't found a translation, module is not active or translation is missing
                        if($sTranslation == $sMatch) {
                            $sTranslation = "";
                        }

                        $aFullResult[$sMatch][$oCurLang->abbr] = utf8_encode($sTranslation);
                    }
                }
            }
        }
    }
}

echo json_encode($aFullResult);

switch (json_last_error()) {
    case JSON_ERROR_DEPTH:
        echo '["JSONERROR - Maximum stack depth exceeded"]';
        break;
    case JSON_ERROR_STATE_MISMATCH:
        echo '["JSONERROR - Underflow or the modes mismatch"]';
        break;
    case JSON_ERROR_CTRL_CHAR:
        echo '["JSONERROR - Unexpected control character found"]';
        break;
    case JSON_ERROR_SYNTAX:
        echo '["JSONERROR - Syntax error, malformed JSON"]';
        break;
    case JSON_ERROR_UTF8:
        echo '["JSONERROR - Malformed UTF-8 characters, possibly incorrectly encoded"]';
        break;
}