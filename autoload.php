<?php

spl_autoload_register('Autoload');

function Autoload($classname)
{
    $filepath = "classes/";
    $ext = ".php";
    $fullpath = $filepath . $classname . $ext;

    include "$fullpath";
}
