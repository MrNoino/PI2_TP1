<?php

class Entity{

    private string $name;
    private string $description;
    private string $logo;
    private string $address;
    private string $phone_number;
    private string $email;
    private ?string $password;
    private bool $active;

    public function __construct(string $name = "", string $description = "",  string $logo = "", string $address = "", string $phone_number = "", string $email = "", ?string $password = null, bool $active = 1){

        $this->name = $name;
        $this->description = $description;
        $this->logo = $logo;
        $this->address = $address;
        $this->phone_number = $phone_number;   
        $this->email = $email;
        $this->password = $password;
        $this->active = $active; 

    }

    

}

?>