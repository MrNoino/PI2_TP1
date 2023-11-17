<?php

class Entity{


    private ?int $id;
    private string $name;
    private string $description;
    private string $logo;
    private string $address;
    private string $phone_number;
    private string $email;
    private ?string $password;
    private bool $active;

    public function __construct(?int $id = null, string $name = "", string $description = "",  string $logo = "", string $address = "", string $phone_number = "", string $email = "", ?string $password = null, bool $active = true){

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->logo = $logo;
        $this->address = $address;
        $this->phone_number = $phone_number;   
        $this->email = $email;
        $this->password = empty($password) ? "" : password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $this->active = $active; 

    }

    public function getID(): ?int{
        return $this->id;
    }
    public function getName(): string{
        return $this->name;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function getLogo(): string{
        return $this->logo;
    }

    public function getAddress(): string{
        return $this->address;
    }

    public function getPhoneNumber(): string{
        return $this->phone_number;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function isActive(): bool{
        return $this->active;
    }

}

?>