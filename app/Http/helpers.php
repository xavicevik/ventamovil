<?php

    function stringtoXML($text) {
        $Xml = '';
        foreach ($text as $key => $val){
            $Xml .= "<$key>$val</$key>";
        }

        return $Xml;
    }

?>
