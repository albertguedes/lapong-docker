<?php
file_put_contents('/tmp/lumen_debug.log', 
    "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'NOT SET') . "\n" .
    "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'NOT SET') . "\n" .
    "SCRIPT_FILENAME: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'NOT SET') . "\n" .
    "QUERY_STRING: " . ($_SERVER['QUERY_STRING'] ?? 'NOT SET') . "\n" .
    "PATH_INFO: " . ($_SERVER['PATH_INFO'] ?? 'NOT SET') . "\n"
, FILE_APPEND);
echo "DEBUG LOGGED";
