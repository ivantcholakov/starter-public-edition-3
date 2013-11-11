<?php

$PLATFORMPATH = dirname(__FILE__).'/../platform';

if (!isset($FCPATH)) {
    $FCPATH = dirname(__FILE__);
}

if (!isset($SELF)) {
    $SELF = 'index.php';
}

$PLATFORMRUN = $PLATFORMPATH.'/run.php';
$PLATFORMCREATE = $PLATFORMPATH.'/create.php';
$PLATFORMDESTROY = $PLATFORMPATH.'/destroy.php';
