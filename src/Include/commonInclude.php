<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION["siteConfig"] = [
        "dataBase" => include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dataBase.conf.php",
        "dateTimeFormat" => include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dateTimeFormat.conf.php",
    ];
    // Setting a default language for the user based on the user-agent
    $_SESSION["language"] = strtoupper(substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2));

};

include $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
$siteConfig["dataBase"] = include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dataBase.conf.php";
$siteConfig["dateTimeFormat"] = include $_SERVER["DOCUMENT_ROOT"] . "/src/Config/dateTimeFormat.conf.php";


return $siteConfig;

