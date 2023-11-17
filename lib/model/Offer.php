<?php

class Offer{

    private ?int $id;
    private ?int $entity_id;
    private string $name;
    private string $description;
    private string $image;
    private float $price;
    private string $date;
    private bool $available;


    public function __construct(?int $id = null, ?int $entity_id = null, string $name = "", string $description = "", string $image = "", float $price = 0, bool $available = true){

        $this->id = $id;
        $this->entity_id = $entity_id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->date = date("Y-m-d");
        $this->available = $available;
        
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getentityID(): ?int{
        return $this->entity_id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function getImage(): string{
        return $this->image;
    }

    public function getPrice(): float{
        return $this->price;
    }

    public function getDate(): string{
        return $this->date;
    }

    public function isAvailable(): bool{
        return $this->available;
    }

}

?>