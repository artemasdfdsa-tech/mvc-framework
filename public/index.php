<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

$base = dirname($_SERVER['SCRIPT_NAME']);
$uri = substr($uri, strlen($base));

if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

require_once __DIR__ . '/../index.php';