<?php

$helpers = [
    "auth_guard_helper",
    "logger_helper",
    "indonesianHelpers",
    "RouteCommandDescriptor",
    "custom_blade_directive",
    "module_helper",
];


///WARNING!
//DO NOT EDIT CODE BELOW THIS

foreach ($helpers as $helper) {
    include __DIR__ . "/" . $helper . ".php";
}
