<?php
/**
* Aceasta clasa se ocupa de partea de initializare a aplicatiei:
* acces la configurari, incarcarea automata a claselor pentru controllers si models,
* pornirea sesiunii, translatarea URL-ului in clase si metode
*
* URL-ul, ca o conventie, o sa fie index.php?c=user&a=delete,
* unde 'c' este numele controller-ului, iar 'a' este metoda din clasa controller-ului
*/
namespace framework;

class Framework
{
	public static $params;

	public static function init()
	{
		// pornirea sesiunii
		session_start();
		
		/**
		* includerea configurarilor generale si ale aplicatiei
		* configurarile aplicatiei sunt furnizate intr-un array
		* si trebuie sa fie disponibile peste tot in aplicatie, 
		* deci ar fi util sa le avem intr-o variabila statica - $params
		*/
		include 'config.php';
		self::$params = require APP_PATH.'config'.DIRECTORY_SEPARATOR.'main.php';

		// autoload classes for Controllers and Models
		self::autoLoadFiles();

		// Managementul erorilor intr-o clasa separata
		ErrorManager::setErrorHandlers();

		// Translatam URL-ul si creem o noua instanta a Controller-ului
		self::translateURL();					
	}

	/**
	* Utilizam spl_autoload_register() ca sa incarcam automat
	* clasele pentru controllers, models si altele
	*/
	private static function autoLoadFiles()
	{
		spl_autoload_register(array(__CLASS__, 'loadClasses'));
	}

	/**
	* metoda folosita ca parametru in spl_autoload_register()
	* Conform PSR-4: http://www.php-fig.org/psr/psr-4/
	*/
	private static function loadClasses($class)
	{
		// project-specific namespace prefix
	    $prefix = '';

	    // base directory for the namespace prefix
	    $base_dir = BASE_PATH;

	    // does the class use the namespace prefix?
	    $len = strlen($prefix);
	    if (strncmp($prefix, $class, $len) !== 0) {
	        // no, move to the next registered autoloader
	        return;
	    }

	    // get the relative class name
	    $relative_class = substr($class, $len);

	    // replace the namespace prefix with the base directory, replace namespace
	    // separators with directory separators in the relative class name, append
	    // with .php
	    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
	    
	    // if the file exists, require it
	    if (file_exists($file)) {
	        require $file;
	    } 
	}

	/**
	* Utilizam aceasta metoda pentru a transpune parametrii din URL
	* in apeluri catre Controllers si metodele acestora
	* e.g. index.php?c=user&a=delete se va transforma intru-un apel
	* al metodei deleteAction din clasa UserController
	*/ 
	private static function translateURL()
	{		
		$translated = FALSE;
		$controller = '';		

		if(isset($_GET['c'], $_GET['a'])){
			$controller = 'app\\controllers\\'.ucfirst($_GET['c']).'Controller';
			$action = $_GET['a'].'Action';
		}

		if(class_exists($controller)){
			$instance = new $controller;
			if(method_exists($instance, $action)){
				$instance->$action();
				$translated = TRUE;
			}
		}

		if(!$translated){
			$instance = new \app\controllers\IndexController;
			$instance->indexAction();
		}
	}
}