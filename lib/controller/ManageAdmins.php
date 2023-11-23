<?php

include("./lib/model/Admin.php");

class ManageAdmins{

    private array $admins;


    public function __construct(bool $load = true){
        
    }

    public function getAdmins(): array{
        return $this->admins;
    }
    public function setAdmins(array $admins): void{
        $this->admins = $admins;
    }
    public function addAdmin(Admin $admin): bool{

        $this->admins[] = $admin;
        return true;

    }

    public function insertAdmin(Admin $admin): void{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.insert_admin(:username, :name, :password);");

        $db_sta->execute([":username" => $admin->getUsername(), ":name" => $admin->getName(), ":password" => password_hash($admin->getPassword(), PASSWORD_BCRYPT, ["cost" => 12])]);

    }

    public function getTotalAdmins(): int{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("SELECT * FROM foodsaver.get_total_admins;");

        $db_sta->execute();

        $db_sta->setFetchMode(PDO::FETCH_COLUMN, 0);

        return (int) $db_sta->fetch();

    }

    public function generateRandomAdmin(): ?array{

        if($this->getTotalAdmins() != 0){

            return null;

        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!?@#$&*-_';
        $pwd = "";
        for ($i = 0; $i < 12; $i++) {

            $n = rand(0, strlen($alphabet) -1);
            $pwd .= $alphabet[$n];

        }

        $username = "a". uniqid();

        $name = $username;

        $random_admin = new Admin(username: $username, name: $name, password: $pwd);

        $this->insertAdmin($random_admin);

        return ["username" => $username, "name" => $name, "pwd" => $pwd];

    }

    public function login (string $username, string $password): int{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.admin_login(:username);");

        $db_sta->execute([":username" => $username]);

        $db_sta->setFetchMode(PDO::FETCH_ASSOC);

        $result = $db_sta->fetch();

        if (is_null($result["id"]) && is_null($result["password"])){

            return -1;

        }else if(!password_verify($password, $result["password"])) {
            
            return -1;

        }


        return $result["id"];

    }

    public function verifyPassword(int $id, string $password): bool{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.get_admin(:id);");

        $db_sta->execute([":id" => $id]);

        $db_sta->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Admin");

        $admin = $db_sta->fetch();

        return password_verify($password, $admin->getPassword());

    }

    public function updatePassword(int $id, string $password): bool{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.update_admin_password(:id, :password);");

        $db_sta->execute([":id" => $id, "password" => password_hash($password, PASSWORD_BCRYPT, ["cost" => 12])]);

        return (bool) $db_sta->rowCount();

    }
    
}

?>