<?php

class Offer{

    private string $name;
    private string $description;
    private string $image;
    private float $price;

    public function __construct(string $name, string $description, string $image, float $price){

        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        
    }

}

?>