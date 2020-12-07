<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'beejee',
    'username'  => 'root',
    'password'  => 'qwer1221',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
