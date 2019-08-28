<?php

// Initialise the session if it doesn't exist and load
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION["siteConfig"] = [
        "dataBase" => include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dataBase.conf.php",
        "dateTimeFormat" => include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dateTimeFormat.conf.php",
    ];
}

include $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
$siteConfig["dataBase"] = include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dataBase.conf.php";
$siteConfig["dateTimeFormat"] = include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dateTimeFormat.conf.php";

return $siteConfig;
