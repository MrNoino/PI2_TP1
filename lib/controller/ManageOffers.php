<?php

include_once("lib/model/Offer.php");

class ManageOffers{

    private array $offers = [];

    public function __construct(bool $load = true, ?int $entity_id = null ){

        if($load && !is_null($entity_id)){

            $db_handler = new DBWrapper();

            $db_conn = $db_handler->get_connection();

            $db_sta = $db_conn->prepare("CALL foodsaver.get_offers(:entity_id);");

            $db_sta->execute(["entity_id" => $entity_id]);

            $db_sta->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Offer");

            $this->offers = $db_sta->fetchAll();

        }else{

            $this->offers = [];

        }

    }

    public function getOffers(?string $date = null): array{

        if(!$date){

            return $this->offers;

        }else{

            $filtered_offers = [];

            foreach($this->offers as $offer){

                if($offer->getDate() == $date)
                    $filtered_offers[] = $offer;

            }

            return $filtered_offers;

        }
    
    }

    public function insertOffer(Offer $offer): bool{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.insert_offer(:entity_id, :name, :description, :image, :price, :date, :available);");

        $db_sta->execute([":entity_id" => $offer->getEntityID(),
                            ":name" => $offer->getName(), 
                            ":description" => $offer->getDescription(), 
                            ":image" => $offer->getImage(),
                            ":price" => $offer->getPrice(),
                            ":date" => $offer->getDate(),
                            ":available" => $offer->isAvailable()]);

        return (bool) $db_sta->rowCount();

    }

    public function deleteOffer(int $id): bool{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.delete_offer(:id);");

        $db_sta->execute([":id" => $id]);

        $deleted = (bool) $db_sta->rowCount();

        if($deleted){

            foreach($this->offers as $key => $offer){

                if($offer->getId() == $id){

                    unlink("resources/images/offers/" . $offer->getImage());
                    unset($this->offers[$key]);
                    break;

                }

            }

        }

        return $deleted;

    }

    public function getOffer(int $id): ?Offer {

        foreach($this->offers as $offer){
            if($offer->getId() == $id){
                return $offer;
            }
        }

        return null;

    }

    public function updateOffer(Offer $offer): bool{

        $db_handler = new DBWrapper();

        $db_conn = $db_handler->get_connection();

        $db_sta = $db_conn->prepare("CALL foodsaver.update_offer(:id, :entity_id, :name, :description, :image, :price, :date, :available);");

        $db_sta->execute([":id" => $offer->getId(),
                            ":entity_id" => $offer->getEntityID(),
                            ":name" => $offer->getName(), 
                            ":description" => $offer->getDescription(), 
                            ":image" => $offer->getImage(),
                            ":price" => $offer->getPrice(),
                            ":date" => $offer->getDate(),
                            ":available" => $offer->isAvailable()]);

        $updated = (bool) $db_sta->rowCount();

        if($updated){

            foreach($this->offers as $key => $o){

                if($offer->getId() == $o->getId()){

                    $this->offers[$key] = $offer;
                    break;

                }

            }

        }

        return $updated;

    }

}

?>