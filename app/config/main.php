<?php

// Configurari ce tin de aplicatie - e.g. Blog

switch ($_SERVER['SERVER_NAME']){
// dev config    
    case 'articole.test';
    return array(
        'charset' => 'utf-8',
        'theme' => 'blog_theme',
        'database' => array(
            'host' => 'localhost',      
            'name' => 'articole_test',
            'username' => 'root',       
            'password' => 'root',
            'options' => array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION   
            )
        )   
    );
    break;
// dev config        
    case 'localhost';
    return array(
        'charset' => 'utf-8',
        'theme' => 'blog_theme',
        'database' => array(
            'host' => 'localhost',      
            'name' => 'articole_test',
            'username' => 'root',       
            'password' => 'root',
            'options' => array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION   
            )
        )   
    );
    break;    
// staging config
    case 'ctrlf5.online';
    return array(
        'charset' => 'utf-8',
        'theme' => 'blog_theme',
        'database' => array(
            'host' => 'localhost',      
            'name' => 'articole_test',
            'username' => 'root',       
            'password' => '7ca60ce5950723e0a56c27e3452f7403edeabf5642b507a3',
            'options' => array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION   
            )
        )   
    );
    break;
}