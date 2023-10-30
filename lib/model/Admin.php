<?php

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
    public function setPassword(string $password): void{
        $this->password = $password;
    }

    public function generateRandomAdmin(): Admin{

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!?@#$&*-_';
        $pwd = "";
        for ($i = 0; $i < 12; $i++) {

            $n = rand(0, strlen($alphabet) -1);
            $pwd .= $alphabet[$n];

        }

       $this->username = "random". uniqid();
       $this->password = $pwd;

        return $this;

    }
    

}

?>