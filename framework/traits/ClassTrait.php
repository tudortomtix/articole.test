<?php
 /**
  * Class utilities
  */
namespace framework\traits;

trait ClassTrait
{
	/**
	 * Returneaza numele modelului, dar fara namespace si cuvantul Model
	 * pentru a fi utilizat ca si nume de tabel (e.g. user from app\models\UserModel)
	 */ 
	public static function getModelTable()
	{
		$reflection = new \ReflectionClass(get_called_class());
		return strtolower(str_replace('Model', '', $reflection->getShortName()));
	}
}