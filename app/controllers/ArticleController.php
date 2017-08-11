<?php
namespace app\controllers;
use framework\BaseController;
use app\models\ArticleModel;
use \framework\Mess;

class ArticleController extends BaseController
{

	private $_model;

	public function __construct()
	{
		$this->_model = new ArticleModel;
	}

	public function listAction()
	{
		$articles = $this->_model->listArticles();
		$latestarticles = $this->_model->latestArticles();		
		$this->render('list', array('articles' => $articles, 'latestarticles' => $latestarticles));
			
	}

	public function catlistAction()
	{
		$articles = $this->_model->catlistArticles('cat', $_GET['cat']);
		$latestarticles = $this->_model->latestArticles();
		$category = $this->_model->catlistArticles('cat', $_GET['cat']);
		$this->render('list', array('articles' => $articles, 'latestarticles' => $latestarticles, 'category' => $category));
			
	}	

	public function viewAction()
	{

		$article = $this->_model->findByPk('id', $_GET['id']);

		$this->render('view', array('article' => $article, 'articles' => $articles));

		//$related = $this->_model->relatedArticles();

		//$this->render('list', array('related' => $related));

	}

	public function editAction()
	{
		// method from parent Model class (must have id parameter in URL)
		$article = $this->_model->findByPk('id', $_GET['id']);
		if(isset($_POST['Article'])){
			if($this->_model->update((int)$_GET['id'], $_POST['Article'])){
				Mess::setMess('success', 'Update cu succes!');
				$this->redirect('index.php?c=article&a=list&pag=1');				
			}			
		}

		$this->render('update', array('article' => $article));

	}


	public function addAction()
	{
		$article = $this->_model->findByPk('id', $_GET['id']);

	switch ($_SERVER['SERVER_NAME']){
		case 'articole.net'; // dev
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/images/covers/";
		break;
		case 'localhost'; // dev
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/images/covers/";
		break;
		case 'ctrlf5.online'; // staging
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/work/articole.test/' . "/public/images/covers/";
		break;

	}	
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["addArticle"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		
		// Check if file already exists
		if (file_exists($target_file)) {
		    Mess::setMess('Error', 'Sorry, file already exists.');
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    Mess::setMess('Error', 'Sorry, your file is too large.');
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    Mess::setMess('Error', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    Mess::setMess('Error', 'Sorry, your file was not uploaded.');
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        Mess::setMess('Success', 'The file has been uploaded.');
		    } else {
		        Mess::setMess('Sorry, there was an error uploading your file.');
		    }
		}

	}

		if(isset($_POST['addArticle'])){
			if($this->_model->add((int)$_GET['id'], $_POST['addArticle'])){
				Mess::setMess('success', 'Adaugare cu succes!');
				$id = $_GET['id'];
				$this->redirect('index.php?c=article&a=list&pag=1');				
			}		
		}

		$this->render('add', array('article' => $article));
	}

	public function deleteAction()
	{
		$this->_model->delete('id', $_GET['id']);
		$this->redirect('index.php?c=article&a=list&pag=1');
	}


	public function pagAction()
	{
		require 'app/config/misc.php';
		$rows = $this->_model->pagArticle();
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