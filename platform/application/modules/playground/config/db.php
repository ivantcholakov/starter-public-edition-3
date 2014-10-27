<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['db'] = array(
    'dsn'      => '',
    'hostname' => 'sqlite:'.APPPATH.'demo_data/demo.sqlite',
    'username' => '',
    'password' => '',
    'database' => '',
    'dbdriver' => 'pdo',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => CACHE_DB_PATH,
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'autoinit' => TRUE,
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
