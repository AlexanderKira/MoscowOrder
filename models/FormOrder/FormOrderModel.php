<?php

class FormOrderModel{
    public $db;
    public function __construct(){
        $this->db = database::getInstance()->getConnection();

        try{
            $result = $this->db->query("SELECT 1 FROM `areas` LIMIT 1");
        } catch(PDOException $e){
            $this->createTable();
        }
    }

    public function createTable(){
        $AreasTableQuery = "CREATE TABLE IF NOT EXISTS areas (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `region` INT NOT NULL UNIQUE,
            `name` VARCHAR (1255) NOT NULL
            )";

        $distanceTableQuery = "CREATE TABLE IF NOT EXISTS distance (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `region` INT NOT NULL,
            `near` INT NOT NULL,
            FOREIGN KEY (`region`) REFERENCES areas (`region`)
            )";

        $orderMoscowTableQuery = "CREATE TABLE IF NOT EXISTS orderMoscow (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `NameSender` VARCHAR (1255) NOT NULL,
            `PhoneSender` INT NOT NULL,
            `region` INT NOT NULL,
            `AddSender` VARCHAR (3000) NOT NULL,
            `NumberSeats` INT NOT NULL,
            `Weight` INT NOT NULL,
            `RecipientName` VARCHAR (1255) NOT NULL,
            `PhoneRecipient` INT NOT NULL,
            `AddRecipient` VARCHAR (3000) NOT NULL,
            `comments` VARCHAR (5000) NOT NULL
             )";

        try{
            $this->db->exec($AreasTableQuery);
            $this->db->exec($distanceTableQuery);
            $this->db->exec($orderMoscowTableQuery);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }


    public function readAllareas(){
        try{
            $stmt = $this->db->query("SELECT * FROM `areas`");
            $areas = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $areas[] = $row;
            }
            return $areas;
        }catch(PDOException $e){
            return false;
        }
    }

    public function create($data){
        $NameSender = $data['NameSender'];
        $PhoneSender = $data['PhoneSender'];
        $region = $data['region'];
        $AddSender = $data['AddSender'];
        $NumberSeats = $data['NumberSeats'];
        $Weight = $data['Weight'];
        $RecipientName = $data['RecipientName'];
        $PhoneRecipient = $data['PhoneRecipient'];
        $AddRecipient = $data['AddRecipient'];
        $comments = $data['comments'];
    
        //$created_at = date('Y-m-d H:i:s');
    
        $query = "INSERT INTO `orderMoscow` (NameSender,PhoneSender,region,AddSender,NumberSeats,Weight,RecipientName,PhoneRecipient,AddRecipient,comments) VALUES (?,?,?,?,?,?,?,?,?,?)";
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$NameSender, $PhoneSender, $region, $AddSender, $NumberSeats, $Weight, $RecipientName, $PhoneRecipient, $AddRecipient, $comments]);
            return true;
        }catch(PDOException $e) {
            return false;
        }
    }
}

?>