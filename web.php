<?php

$mainBackend = require __DIR__ . '/backend/config/main.php';
$mainBackendLocal = require __DIR__ . '/backend/config/main-local.php';
$mainCommon = require __DIR__ . '/backend/config/main.php';
$mainCommonLocal = require __DIR__ . '/backend/config/main-local.php';

$paramsBackend = require __DIR__ . '/backend/config/params.php';
$paramsBackendLocal = require __DIR__ . '/backend/config/params-local.php';
$paramsCommon = require __DIR__ . '/backend/config/params.php';
$paramsCommonLocal = require __DIR__ . '/backend/config/params-local.php';

$config = $mainBackend;
$config["components"] = array_merge($config["components"],
    $mainBackendLocal["components"],
    $mainCommon["components"],
    $mainCommonLocal["components"]);
$config["params"] = array_merge($paramsBackend ,
    $paramsBackendLocal,
    $paramsCommon ,
    $paramsCommonLocal);


return $config;
