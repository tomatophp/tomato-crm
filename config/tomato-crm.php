<?php

return [
    "features" => [
        "accounts" => true,
        "groups" => true,
        "locations" => true,
        "contacts" => true,
        "activites" => false,
        "notifications" => true,
        "apis" => true
    ],
    "login_by" => "phone",
    "guard" => "accounts",
    "required_otp" => true,
    "model" => \TomatoPHP\TomatoCrm\Models\Account::class
];
