<?php

use Faker\Generator as Faker;
use Pooyadch\LaravelRoleManagement\UserRolePermission;

$factory->define(UserRolePermission::class, function (Faker $faker) {
    return [
        'role_name' => 'customer',
        'controller_address' => 'null',
        'method_name' => $faker->randomElement(['NULL','POST','GET','DELETE']),
        'permission_type' => $faker->randomElement(['admin','branch','own']), // secret
        'access' => $faker->randomElement(['Allow','Deny']),
        'priority' => 0,
        'filter' => 'file',
    ];
});
