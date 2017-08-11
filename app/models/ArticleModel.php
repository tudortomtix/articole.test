<?php
 namespace app\models;
 use framework\BaseModel;
 use \framework\Mess;

 //class ArticleModel extends BaseModel
class ArticleModel extends BaseModel
 {
 	private $pdo;

 	public function __construct()
 	{
 		parent::connectDB();
 		$this->pdo = parent::$_pdo;		
 	}

// Validarea datelor trimise prin POST
    private function validate($post)
    {       
        $validate = true;
        if(empty($post['title']) || !ctype_alnum($post['title'])){
            Mess::setMess('title', 'Invalid Title ');
            $validate = false;
        }   
        if(empty($post['body']) || !ctype_alnum($post['body'])){
            Mess::setMess('body', 'Invalid Body Article');
            $validate = false;
        }

        return $validate;
    } 	

// Listarea tuturor articolelor

 	public function listArticles()
 	{ 		

    // logica pentru paginare

        require 'app/config/misc.php';
        if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }
        $startrow = (($pag-1)*$perpag); 

 		return $this->pdo->query("SELECT * FROM article ORDER by ID ASC LIMIT $startrow,$perpag"); 		
 	}

// Listarea ultimelor articole

    public function latestArticles()
    {       
        require 'app/config/misc.php';
        return $this->pdo->query("SELECT * FROM article ORDER BY id DESC LIMIT $lat");         
    }    


// Listarea articolelor dintr-o anumita categorie

    public function catlistArticles()
    {       

    // logica pentru paginare

        require 'app/config/misc.php';
        if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }
        $startrow = (($pag-1)*$perpag); 

        $cat = $_GET['cat'];

        return $this->pdo->query("SELECT * FROM article AS art LEFT JOIN categories AS cat ON art.category_id = cat.idcat WHERE art.category_id = $cat ORDER by art.id ASC LIMIT $startrow,$perpag"); 

    }  

// Listarea articolelor related pe un articol

    public function relatedArticles()
    {       

        $id = $_GET['id'];
        $cat = $this->pdo->query("SELECT cat.idcat FROM article AS art LEFT JOIN categories AS cat ON art.category_id = cat.idcat WHERE art.id = $id"); 

        return $this->pdo->query("SELECT * FROM article WHERE category_id = $cat"); 

    }   



// Modificarea datelor unui articol
    public function update($id, $post)
    {           
    	/* scot temporat validare
    	if(!$this->validate($post)){            
           return false;           
        }*/

        $set = 'title = :title, body = :body';
        $sql = $this->pdo->prepare("UPDATE article SET $set  WHERE id = :id");

        return $sql->execute(array(
            ':id' => $id, 
            ':title' => $post['title'],
            ':body' => $post['body']));               
    }


// Adaugarea unui articol
    public function add($id, $post)
    {   
        /*scot temporar validarea
        if(!$this->validate($post)){            
            return false;           
        }    */    

		date_default_timezone_set('Europe/Bucharest');
		$curentdate = date('Y-m-d H:i:s');

        $sql = $this->pdo->prepare("INSERT INTO article (title, date_insert, body, cover_photo, category_id) VALUES (:title, :date_insert, :body, :cover_photo, :category_id)");

        return $sql->execute(array(
            ':title' => $post['title'],
            ':date_insert' => $curentdate,            
            ':body' => $post['body'],
            ':cover_photo' => $_FILES["fileToUpload"]["name"],
            ':category_id' => $post['category_id']));               
    }

    public function deleteArticles($id) {
        $sql = $this->pdo->prepare("DELETE FROM article WHERE id = :id");
        return $sql->execute(array(':id' => $id));
    }


    // Paginare useri
    public function pagArticle() 
    {   
        if(isset($_GET['cat'])) {
            $cat = $_GET['cat'];
            return $this->pdo->query("SELECT * FROM article WHERE category_id = $cat"); 
        } else {
            return $this->pdo->query("SELECT * FROM article"); 
        }

    }

}