<?php

namespace app\controllers;
use framework\BaseController as BaseController;

class IndexController extends BaseController
{
	public function indexAction()
	{		
        $this->render('index');
	}
}