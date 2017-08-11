<?php
 namespace app\models;
 use framework\BaseModel;
 use \framework\Mess;





 //class UserModel extends BaseModel
class UserModel extends BaseModel
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
        if(empty($post['prenume']) || !ctype_alnum($post['prenume'])){
            Mess::setMess('prenume', 'Invalid Prenume');
            $validate = false;
        }   
        if(empty($post['nume']) || !ctype_alnum($post['nume'])){
            Mess::setMess('nume', 'Invalid Nume');
            $validate = false;
        }
        if(empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            Mess::setMess('email', 'Invalid Email');
            $validate = false;
        }   

        return $validate;
    }

    // Listarea tuturor utilizatorilor
    
 	public function listUsers()
 	{

    // logica pentru paginare

        require 'app/config/misc.php';
        if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }
        $startrow = (($pag-1)*$perpag);	

 		return $this->pdo->query("SELECT * FROM user ORDER by ID ASC LIMIT $startrow,$perpag"); 		
 	}

    // Listarea ultimilor useri 

    public function latestUsers()
    {    
        require 'app/config/misc.php';   
        return $this->pdo->query("SELECT * FROM user ORDER BY id DESC LIMIT $lat");         
    }    

    // Modificarea datelor unui utilizator
    public function update($id, $post)
    {           
        if(!$this->validate($post)){            
            return false;           
        }

        $set = 'prenume = :prenume, nume = :nume, email = :email';
        $sql = $this->pdo->prepare("UPDATE user SET $set  WHERE id = :id");

        return $sql->execute(array(
            ':id' => $id, 
            ':prenume' => $post['prenume'],
            ':nume' => $post['nume'],
            ':email' => $post['email'],
            ':password' => $post['password']));               
    }

// Adaugare user
    public function add($id, $post)
    {   
        if(!$this->validate($post)){            
            return false;           
        }        

        $sql = $this->pdo->prepare("INSERT INTO user (prenume, nume, email, password) VALUES (:prenume, :nume, :email, :password)");

        return $sql->execute(array(
            ':prenume' => $post['prenume'],
            ':nume' => $post['nume'],
            ':email' => $post['email'],
            ':password' => md5($post['password'])));               
    }
    
// Stergere user
    public function deleteUsers($id) {
        $sql = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
        return $sql->execute(array(':id' => $id));
    }

// Find user by email

    public function findByEmail($pk_name, $pk_value)
    {
        $table = $this->getModelTable();
        $query = self::$_pdo->prepare("SELECT * FROM $table WHERE $pk_name = :email");
        $query->execute(array(':email' => $pk_value));
        return $query->fetch();
    }


// Paginare useri
    public function pagUser() 
    {
        return $this->pdo->query('SELECT * FROM user'); 
    }



 }