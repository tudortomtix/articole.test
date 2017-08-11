<?php
namespace app\controllers;
use framework\BaseController;
use app\models\PageModel;
use \framework\Mess;

class PageController extends BaseController
{

	private $_model;

	public function __construct()
	{
		$this->_model = new PageModel;
	}
	
	public function viewAction()
	{

		$page = $this->_model->findByPk('id', $_GET['id']);


		$this->render('view', array('page' => $page));

	}

}