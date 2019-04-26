<?php
if ( !function_exists('var_export_json_txt'))
{
    function var_export_json_txt($var, $type="", $indent="") {
        switch (gettype($var)) {
            case "string":
                switch($type){
                    case "key":
                        return $var;
                    default:
                        return "'" . $var . "'";
                }
            case "array":
                $indexed = array_keys($var) === range(0, count($var) - 1);
                $r = [];
                foreach ($var as $key => $value) {
                    $r[] = "$indent    "
                    . ($indexed ? "" : var_export_json_txt($key) . " : ")
                    . var_export_json_txt($value, "$indent    ");
                }
                return "{". PHP_EOL . implode(",". PHP_EOL, $r) . PHP_EOL . $indent . "}";
            case "boolean":
                return $var ? "TRUE" : "FALSE";
            default:
                return var_export($var, TRUE);
        }
    }
}

if ( !function_exists('var_export_array_txt'))
{
    function var_export_array_txt($var, $indent="") {
        switch (gettype($var)) {
            case "string":
                return '"' . $var . '"';
            case "array":
                $indexed = array_keys($var) === range(0, count($var) - 1);
                $r = [];
                foreach ($var as $key => $value) {
                    $r[] = "$indent    "
                    . ($indexed ? "" : var_export_array_txt($key) . " => ")
                    . var_export_array_txt($value, "$indent    ");
                }
                return "[". PHP_EOL . implode(",". PHP_EOL, $r) . PHP_EOL . $indent . "];";
            case "boolean":
                return $var ? "TRUE" : "FALSE";
            default:
                return var_export($var, TRUE);
        }
    }
}