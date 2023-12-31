<?php

class FormOrderController{

    public function instruction(){
        include 'app/views/FormOrder/instruction.php';
    }

    public function FormEC(){
        include 'app/views/FormOrder/index.php';
    }

    public function create(){
        $Model = new FormOrderModel();
        $regions = $Model->readAllareas();

        include 'app/views/FormOrder/create.php';
    }



    public function store(){
        if(isset($_POST['NameSender']) && isset($_POST['PhoneSender']) 
        && isset($_POST['region']) && isset($_POST['AddSender']) 
        && isset($_POST['AddSenderApartment']) && isset($_POST['AddSenderfloor'])
        && isset($_POST['NumberSeats']) && isset($_POST['Weight']) 
        && isset($_POST['RecipientName']) && isset($_POST['PhoneRecipient']) 
        && isset($_POST['AddRecipient'])  && isset($_POST['comments'])){

            $Model = new FormOrderModel();
            $data = [
              'NameSender' => $_POST['NameSender'],
              'PhoneSender' => $_POST['PhoneSender'],
              'region' => $_POST['region'],
              'AddSender' => $_POST['AddSender'],
              'AddSenderApartment' => $_POST['AddSenderApartment'],
              'AddSenderfloor' => $_POST['AddSenderfloor'],
              'NumberSeats' => $_POST['NumberSeats'],
              'Weight' => $_POST['Weight'],
              'RecipientName' => $_POST['RecipientName'],
              'PhoneRecipient' => $_POST['PhoneRecipient'],
              'AddRecipient' => $_POST['AddRecipient'],
              'comments' => $_POST['comments'],
            ];
            $Model->create($data);
            
        }
        header("Location: index.php?page=FormOrder");
    }
}

?>