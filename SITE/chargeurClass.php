<?php

// chargement automatique de toutes les classes du repertoire classes
//evite de faire un require ou include à chaque fois que l'on veut appeller la classe'
////function loadClass($classe){
//require 'classes/'. $classe.'.php';
//}
//spl_autoload_register('loadClass');

set_include_path ( dirname(__FILE__));
//version fd
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
}
);


//***********version david*****
//permet de trouver les classes meme dans un repertoire
//
//function autoload($classname) {
//    if (file_exists($file = __DIR__ . '/' . $classname . '.php')) {
//        require $file;
//    }
//}
//spl_autoload_register('autoload');

?>