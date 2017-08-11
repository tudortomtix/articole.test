<?php

namespace framework;

class Mess
{
	/**
	* $key poate lua una din valorile: notice, error, success
	* Mess::setMess('notice', 'Valoarea nu e setata')
	*/
	public static function setMess($key, $message = '')
	{
		if(!empty($key)){
			$_SESSION['message'][$key] = $message;
		}
	}

	/**
	* Mess::getMess('')
	*/
	public static function getMess($key)
	{
		if(self::hasMess($key)){
			$message = $_SESSION['message'][$key];
			unset($_SESSION['message'][$key]);
			return $message;
		}
	}

	public static function getAllMess(){
		if(isset($_SESSION['message'])){
			$messages = $_SESSION['message'];
			unset($_SESSION['message']);
			return $messages;
		}
		return false;		
	}

	public static function hasMess($key)
	{
		if(!empty($key) && isset($_SESSION['message'][$key])){
			return true;
		}
		return false;
	}
}
