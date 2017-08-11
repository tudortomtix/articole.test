<?php
 namespace app\models;
 use framework\BaseModel;
 use \framework\Mess;

 //class PageModel extends BaseModel
class PageModel extends BaseModel
 {
 	private $pdo;

 	public function __construct()
 	{
 		parent::connectDB();
 		$this->pdo = parent::$_pdo;		
 	}


}