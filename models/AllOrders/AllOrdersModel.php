<?php

class AllOrdersModel{
    public $db;
    public function __construct(){
        $this->db = database::getInstance()->getConnection();

        try{
            $result = $this->db->query("SELECT 1 FROM `region` LIMIT 1");
        } catch(PDOException $e){
            $this->createTable();
        }
    }

    public function createTable(){
        $regionTableQuery = "CREATE TABLE IF NOT EXISTS region (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `region` INT NOT NULL UNIQUE,
            `name` VARCHAR (1255) NOT NULL
            )";

        $distanceTableQuery = "CREATE TABLE IF NOT EXISTS distance (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `region` INT NOT NULL,
            `distance` INT NOT NULL,
            FOREIGN KEY (`region`) REFERENCES region (`region`)
            )";

        $regionPriceTableQuery = "CREATE TABLE IF NOT EXISTS regionPrice (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `region` INT NOT NULL,
            `price` INT NOT NULL,
            FOREIGN KEY (`region`) REFERENCES region (`region`)
            )";

        $orderMoscowTableQuery = "CREATE TABLE IF NOT EXISTS orderMoscow (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `NameSender` VARCHAR (1255) NOT NULL,
            `PhoneSender` BIGINT(12) NOT NULL,
            `region` INT NOT NULL,
            `AddSender` VARCHAR (3000) NOT NULL,
            `AddSenderApartment` INT,
            `AddSenderfloor` INT,
            `NumberSeats` INT NOT NULL,
            `Weight` INT NOT NULL,
            `RecipientName` VARCHAR (1255) NOT NULL,
            `PhoneRecipient` BIGINT(12) NOT NULL,
            `AddRecipient` VARCHAR (3000) NOT NULL,
            `status` TINYINT(1) NOT NULL DEFAULT 0,
            `comments` VARCHAR (5000),
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`region`) REFERENCES region (`region`)
            )";

        try{
            $this->db->exec($regionTableQuery);
            $this->db->exec($distanceTableQuery);
            $this->db->exec($orderMoscowTableQuery);
            $this->db->exec($regionPriceTableQuery);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }

    public function readAllorders(){
        try{
            $stmt = $this->db->query("SELECT orderMoscow.id, orderMoscow.created_at, orderMoscow.status, region.name, regionPrice.price, orderMoscow.AddSender, orderMoscow.AddSenderApartment, orderMoscow.AddSenderfloor, orderMoscow.PhoneSender, orderMoscow.NameSender, orderMoscow.AddRecipient, orderMoscow.PhoneRecipient, orderMoscow.RecipientName, orderMoscow.comments, orderMoscow.NumberSeats, orderMoscow.Weight
            FROM region
            JOIN regionPrice ON region.region = regionPrice.region
            JOIN orderMoscow ON region.region = orderMoscow.region
            ORDER BY created_at DESC
            ");

            $orders = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $orders[] = $row;
            }
            return $orders;
        } catch(PDOException $e){
            return false;
        }
    }


    public function readAllareas(){
        try{
            $stmt = $this->db->query("SELECT * FROM `region`");
            $regions = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $regions[] = $row;
            }
            return $regions;
        }catch(PDOException $e){
            return false;
        }
    }

    public function orderFilter($id){
        $query = "SELECT orderMoscow.id, orderMoscow.created_at, orderMoscow.status, region.name, regionPrice.price, orderMoscow.AddSender, orderMoscow.AddSenderApartment, orderMoscow.AddSenderfloor, orderMoscow.PhoneSender, orderMoscow.NameSender, orderMoscow.AddRecipient, orderMoscow.PhoneRecipient, orderMoscow.RecipientName, orderMoscow.comments, orderMoscow.NumberSeats, orderMoscow.Weight
        FROM region
        JOIN regionPrice ON region.region = regionPrice.region
        JOIN orderMoscow ON region.region = orderMoscow.region
        WHERE orderMoscow.id = ? ORDER BY created_at DESC";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $orders = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $orders[] = $row;
            }
            return $orders;
        } catch(PDOException $e){
            return false;
        }
    }

    public function read($id){
        $query = "SELECT orderMoscow.id, orderMoscow.status, orderMoscow.NameSender, orderMoscow.PhoneSender, region.region, region.name, orderMoscow.AddSender, orderMoscow.AddSenderApartment, orderMoscow.AddSenderfloor, orderMoscow.NumberSeats, orderMoscow.Weight, orderMoscow.RecipientName, orderMoscow.PhoneRecipient, orderMoscow.AddRecipient, orderMoscow.comments 
        FROM region
        JOIN orderMoscow ON region.region = orderMoscow.region
        WHERE orderMoscow.id = ? ORDER BY created_at DESC";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch(PDOException $e){
            return false;
        }
    }

    public function update($id, $data){
        $NameSender = $data['NameSender'];
        $PhoneSender = $data['PhoneSender'];
        $region = $data['region'];
        $AddSender = $data['AddSender'];
        $AddSenderApartment = $data['AddSenderApartment'];
        $AddSenderfloor = $data['AddSenderfloor'];
        $NumberSeats = $data['NumberSeats'];
        $Weight = $data['Weight'];
        $RecipientName = $data['RecipientName'];
        $PhoneRecipient = $data['PhoneRecipient'];
        $AddRecipient = $data['AddRecipient'];
        $comments = $data['comments'];
        $status = !empty($data['status']) && $data['status'] !== 0 ? 1 : 0;

        $query = "UPDATE orderMoscow SET NameSender = ?, PhoneSender = ?, region = ?, AddSender = ?, NumberSeats = ?, Weight = ?, RecipientName = ?, PhoneRecipient = ?, AddRecipient = ?, status = ? , comments = ? WHERE id = ?";
    
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$NameSender, $PhoneSender, $region, $AddSender, $AddSenderApartment, $AddSenderfloor, $NumberSeats, $Weight, $RecipientName, $PhoneRecipient, $AddRecipient,  $status, $comments, $id]);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = "DELETE FROM orderMoscow WHERE id = ?";

        try{
            $stmt =$this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }

}


?>