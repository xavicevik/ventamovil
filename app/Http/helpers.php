<?php

    function stringtoXML($text) {
        $Xml = '';
        foreach ($text as $key => $val){
            $Xml .= "<$key>$val</$key>";
        }

        return $Xml;
    }

    function valTrue($val) {
        if ($val == 'S' && $val == 'Y' && $val == 1 || $val === true || $val == "true") {
            return true;
        } else {
            return false;
        }
    }

?>
