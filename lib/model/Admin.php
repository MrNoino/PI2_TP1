<?php

include_once("lib/model/DBWrapper.php");

class Admin{

    private int $id;
    private string $username;
    private string $name;
    private string $password;

    public function __construct(int $id = -1, string $username = "", string $name = "", string $password = ""){
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->password = $password; 
    }

    public function getId(): int{
        return $this->id;
    }

    public function getUsername(): string{
        return $this->username;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getPassword(): string{
        return $this->password;
    }
    
    public function setId(int $id): void{
        $this->id = $id;
    }

    public function setUsername(string $username): void{
        $this->username = $username;
    }
    
    public function setName(string $name): void{
        $this->name = $name;
    }
    public function setPassword(string $password): void{
        $this->password = $password;
    }

    public function insertAdmin(): void{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.insert_admin(:username, :name, :password);");

        $db_sta->execute([":username" => $this->username, ":name" => $this->name, ":password" => password_hash($this->password, PASSWORD_BCRYPT, ["cost" => 12])]);

        $db_handler = null;

    }

    public function getTotalAdmins(): int{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("SELECT * FROM foodsaver.get_total_admins;");

        $db_sta->execute();

        $db_sta->setFetchMode(PDO::FETCH_COLUMN, 0);

        return (int) $db_sta->fetch();

    }

    public function generateRandomAdmin(): ?Admin{

        if($this->getTotalAdmins() != 0){

            return null;

        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!?@#$&*-_';
        $pwd = "";
        for ($i = 0; $i < 12; $i++) {

            $n = rand(0, strlen($alphabet) -1);
            $pwd .= $alphabet[$n];

        }

       $this->username = "randusrnm". uniqid();
       $this->name = "randnm". uniqid();
       $this->password = $pwd;

       $this->insertAdmin();

        return $this;

    }

    public function login (string $username, string $password): ?int{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.admin_login(:username, @id, @password);");

        $db_sta->execute([":username" => $username]);

        $result = $db_conn->query("SELECT @id as \"id\", @password as \"password\";");

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result = $result->fetch();

        if ($result == null || empty($result)  || !password_verify($password, $result["password"])) {
            
            return null;

        }

        return $result["id"];

    }
    

}

?>