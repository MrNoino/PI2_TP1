<?php

include_once("lib/model/DBWrapper.php");

class Admin{

    private ?int $id;
    private string $username;
    private string $name;
    private string $password;

    public function __construct(?int $id = null, string $username = "", string $name = "", string $password = ""){
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
        $this->password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
    }

}

?>