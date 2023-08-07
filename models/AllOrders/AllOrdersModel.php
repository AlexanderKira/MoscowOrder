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
            `created_at` VARCHAR (10) NOT NULL,
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

//поиск 
    public function readAllorders(){
        try{
            $stmt = $this->db->query("SELECT orderMoscow.id, orderMoscow.created_at, orderMoscow.status, region.name, regionPrice.price, orderMoscow.AddSender, orderMoscow.AddSenderApartment, orderMoscow.AddSenderfloor, orderMoscow.PhoneSender, orderMoscow.NameSender, orderMoscow.AddRecipient, orderMoscow.PhoneRecipient, orderMoscow.RecipientName, orderMoscow.comments, orderMoscow.NumberSeats, orderMoscow.Weight
            FROM region
            JOIN regionPrice ON region.region = regionPrice.region
            JOIN orderMoscow ON region.region = orderMoscow.region
            ORDER BY orderMoscow.id DESC
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

    public function readsearch($SearchOrder, $SearchRegion, $SearchDate, $SearchStatus){
        //$id = trim(strip_tags(stripcslashes(htmlspecialchars($id))));
        $query = "SELECT orderMoscow.id, orderMoscow.created_at, orderMoscow.status, region.name, region.region, regionPrice.price, orderMoscow.AddSender, orderMoscow.AddSenderApartment, orderMoscow.AddSenderfloor, orderMoscow.PhoneSender, orderMoscow.NameSender, orderMoscow.AddRecipient, orderMoscow.PhoneRecipient, orderMoscow.RecipientName, orderMoscow.comments, orderMoscow.NumberSeats, orderMoscow.Weight
        FROM region
        JOIN regionPrice 
        ON region.region = regionPrice.region
        JOIN orderMoscow 
        ON region.region = orderMoscow.region
        WHERE orderMoscow.id
        AND orderMoscow.id LIKE '$SearchOrder' 
        OR orderMoscow.region LIKE '$SearchRegion'
        OR orderMoscow.created_at LIKE '$SearchDate' 
        OR orderMoscow.status LIKE '$SearchStatus' 
        ORDER BY orderMoscow.id DESC";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $orders = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $orders[] = $row;
            }
            return $orders;
        } catch(PDOException $e){
            return false;
        }
    }

    
    
    //для вывода всех данных для интерфейса районов
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


    public function read($id){
        $query = "SELECT orderMoscow.id, orderMoscow.status, orderMoscow.NameSender, orderMoscow.PhoneSender, 
        region.region, region.name, orderMoscow.AddSender, orderMoscow.AddSenderApartment, 
        orderMoscow.AddSenderfloor, orderMoscow.NumberSeats, orderMoscow.Weight, orderMoscow.RecipientName, 
        orderMoscow.PhoneRecipient, orderMoscow.AddRecipient, orderMoscow.comments 
        FROM region
        JOIN orderMoscow ON region.region = orderMoscow.region
        WHERE orderMoscow.id = ? ORDER BY orderMoscow.id DESC";

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
        $status = !empty($data['status']) && $data['status'] !== 0 ? 1 : 0;
        $comments = $data['comments'];
        

        $query = "UPDATE orderMoscow SET NameSender = ?, PhoneSender = ?, region = ?, AddSender = ?, AddSenderApartment = ?, AddSenderfloor = ?, NumberSeats = ?, Weight = ?, RecipientName = ?, PhoneRecipient = ?, AddRecipient = ?, status = ? , comments = ? WHERE id = ?";
    
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