<?php
namespace app\controllers;
use framework\BaseController;
use app\models\UserModel;
use \framework\Mess;

class UserController extends BaseController
{

	private $_model;

	public function __construct()
	{
		$this->_model = new UserModel;
	}
	

	public function listAction()
	{
		$users = $this->_model->listUsers();
		$latestusers = $this->_model->latestUsers();		
		$this->render('list', array('users' => $users, 'latestusers' => $latestusers));		
			
	}

	public function latestAction()
	{
		$latestusers = $this->_model->latestUsers();		
		$this->render('list', array('users2' => $latestusers));	
	}


	public function editAction()
	{
		// method from parent Model class (must have id parameter in URL)
		$user = $this->_model->findByPk('id', $_GET['id']);
		if(isset($_POST['User'])){
			if($this->_model->update((int)$_GET['id'], $_POST['User'])){
				Mess::setMess('success', 'Update cu succes!');
				$this->redirect('index.php?c=user&a=list&pag=1');				
			}			
		}

		$this->render('update', array('user' => $user));

	}

	public function addAction()
	{
		$user = $this->_model->findByPk('id', $_GET['id']);
		if(isset($_POST['addUser'])){
			if($this->_model->add((int)$_GET['id'], $_POST['addUser'])){
				Mess::setMess('success', 'Adaugare cu succes!');
				$this->redirect('index.php?c=user&a=list&pag=1');				
			}		
		}

		$this->render('add', array('user' => $user));
	}

	public function deleteAction()
	{
		$this->_model->delete('id', $_GET['id']);
		$this->redirect('index.php?c=user&a=list&pag=1');
	}



	public function pagAction()
	{
		require 'app/config/misc.php';
		$rows = $this->_model->pagUser();
		$nr_rows = $rows->rowCount();
		$totalpag=ceil($nr_rows/$perpag);


    // construiesc paginarea
        $curent_url = basename($_SERVER['REQUEST_URI']);
        $base_url = substr("$curent_url", 0, -1);

        if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }    

        /*
        echo "<br />";
		echo 'nr_rows= ' .$nr_rows;
		echo "<br />";
		echo 'totalpag= ' .$totalpag;
		echo "<br />";
		echo 'perpag= ' .$perpag;
		echo "<br />";
		echo "curent_url= " .$curent_url;
		echo "<br />";
		echo "base_url= " .$base_url;
		echo "<br />";
		echo "<br />";
		*/

	// asta ar trebui sa o mut in view

		if($pag>1)
		{
		echo '<a class="btnpag" href="'.$base_url.($pag-1).'">PREV</a>';
		}

		echo "<ul class='pagination'>";
		for($i=1;$i<=$totalpag;$i++)
		{
		if($i==$pag) { echo "<li class='current'>".$i."</li>"; }

		else { echo '<li><a href="'.$base_url.$i.'">'.$i.'</a></li>'; }
		}
		echo "</ul>";

		if($pag!=$totalpag)
		{
		echo '<a class="btnpag" href="'.$base_url.($pag+1).'">NEXT</a>';
		}
	}



}