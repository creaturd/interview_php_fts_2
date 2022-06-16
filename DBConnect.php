<?php
header('Content-type: application/json; charset=UTF-8');
abstract class DBConnect
{
    abstract public function connect($host, $port, $database, $username, $password);
    abstract public function query($sql, $params);
}
class MySQLConnect extends DBConnect {

    private $db;

    public function __construct(){
	}

    public function connect($host, $port, $database, $username, $password){
        try {
            $this->db = new PDO('mysql:host=mysql-rfam-public.ebi.ac.uk; port=4497;dbname=Rfam', 'rfamro', '');
            echo "Database connection established\n";
        }
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query($sql, $params = []){
        $stmt = $this->db->prepare($sql);
        if ( !empty($params) ) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }
        $stmt->execute();

        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
    }
}
?>