<?php

include("./lib/model/Admin.php");

class ManageAdmins{

    private array $admins;


    public function __construct(array $admins = []){
        $this->admins = $admins;
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
    
}

?>