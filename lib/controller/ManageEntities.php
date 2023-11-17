<?php

include_once("lib/model/Entity.php");

class ManageEntities{

    private array $entities = [];

    public function __construct(bool $load = true){

        if($load){

            $db_handler = new DBWrapper();

            $db_conn = $db_handler->get_connection();

            $db_sta = $db_conn->query("SELECT * FROM foodsaver.get_entities;");

            $db_sta->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity");

            $this->entities = $db_sta->fetchAll();

        }else{

            $this->entities = [];

        }
    
    }

    public function getEntities(): array{
    
        return $this->entities;
    
    }

    public function insertEntity(Entity $entity): bool{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.insert_entity(:name, :description, :logo, :address, :phone_number, :email, :password, :active);");

        $db_sta->execute([":name" => $entity->getName(), 
                            ":description" => $entity->getDescription(), 
                            ":logo" => $entity->getLogo(),
                            ":address" => $entity->getAddress(),
                            ":phone_number" => $entity->getPhoneNumber(),
                            ":email" => $entity->getEmail(),
                            ":password" => $entity->getPassword(),
                            ":active" => $entity->isActive()]);

        return (bool) $db_sta->rowCount();

    }

    public function login(string $email, string $password): int{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.entity_login(:email);");

        $db_sta->execute([":email" => $email]);

        $db_sta->setFetchMode(PDO::FETCH_ASSOC);

        $result = $db_sta->fetch();

        if (is_null($result["id"]) && is_null($result["password"])){

            return -1;

        }else if(!password_verify($password, $result["password"])) {
            
            return -1;

        }

        return $result["id"];

    }

    public function getEntity(int $id): ?Entity {

        foreach($this->entities as $entity){
            if($entity->getID() == $id){
                return $entity;
            }
        }

        return null;

    }

}

?>