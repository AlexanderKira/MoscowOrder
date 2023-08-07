<?php

class FormOrderModel{
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

    public function create($data){
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
        $created_at = date('Y-m-d');
        $comments = $data['comments'];

    
        $query = "INSERT INTO `orderMoscow` (NameSender,PhoneSender,region,AddSender,AddSenderApartment,AddSenderfloor,NumberSeats,Weight,RecipientName,PhoneRecipient,AddRecipient,created_at,comments) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$NameSender, $PhoneSender, $region, $AddSender, $AddSenderApartment, $AddSenderfloor, $NumberSeats, $Weight, $RecipientName, $PhoneRecipient, $AddRecipient, $created_at, $comments]);
            return true;
        }catch(PDOException $e) {
            return false;
        }
    }
}

?>