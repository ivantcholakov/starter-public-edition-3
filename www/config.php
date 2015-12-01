<?php

$PLATFORMPATH = dirname(__FILE__).'/../platform';

$DEFAULTFCPATH = dirname(__FILE__);

if (!isset($FCPATH)) {
    $FCPATH = $DEFAULTFCPATH;
}

if (!isset($SELF)) {
    $SELF = 'index.php';
}

$PLATFORMRUN = $PLATFORMPATH.'/run.php';
$PLATFORMCREATE = $PLATFORMPATH.'/create.php';
$PLATFORMDESTROY = $PLATFORMPATH.'/destroy.php';
