<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function autoload($classname) {
    if (file_exists($file = __DIR__ . '/' . $classname . '.php')) {
        require $file;
    }
}
spl_autoload_register('autoload');