<?php

class DbConnect
{
    private string $host = 'mariadb';
    private string $db = 'test';
    private string $user = 'root';
    private string $password = 'rootpass';
    public object $database;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=UTF8";

        try {
            $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];

            $this->database =  new \PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function make()
    {
        return $this->database;
    }
}


$new = new DbConnect();
$db =  $new->make();

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true);
$email = $response['email'];
//$email = ""
$query = $db->prepare( "SELECT `email` FROM `users` WHERE `email` = ?" );
$query->bindValue( 1, $email );
$query->execute();

if( $query->rowCount() > 0 ) {
    echo json_encode(["available" => false]);
}
else {
    echo json_encode(["available" => true]);
}
