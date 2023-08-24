<?php
$aLang = array();
require($argv[1]);


echo json_encode($aLang);

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