<?php
/**
 * Clasa BaseModel sta la baza oricarui Model
 * si contine functiona
 */
namespace framework;

class BaseModel
{
    use \framework\traits\ClassTrait;

    protected static $_pdo;

    /**
     * Singleton pattern care ne asigura ca nu realizam decat o data conexiunea la baza de date
     * Pastram conexiunea, care ne ajuta la interogari, intr-o variabila protected
     */
    public static function connectDB()
    {
        if(is_null(self::$_pdo)){
            $host = Framework::$params['database']['host'];
            $database = Framework::$params['database']['name'];
            $username = Framework::$params['database']['username']; 
            $password = Framework::$params['database']['password'];     
            $options = Framework::$params['database']['options'];

            self::$_pdo = new \PDO("mysql:dbname={$database};host={$host};port=3306;charset=utf8", $username, $password, $options);
        }else{
            return self::$_pdo;
        }
    }

    public function findByPk($pk_name, $pk_value)
    {
        $table = $this->getModelTable();
        $query = self::$_pdo->prepare("SELECT * FROM $table WHERE $pk_name = :id");
        $query->execute(array(':id' => $pk_value));
        return $query->fetch();
    }

    public function delete($pk_name, $pk_value)
    {
        $table = $this->getModelTable();
        $query = self::$_pdo->prepare("DELETE FROM $table WHERE $pk_name = :id");
        $query->execute(array(':id' => $pk_value));
    }    
}