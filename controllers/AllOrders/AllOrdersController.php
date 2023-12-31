<?php

class AllOrdersController{
    public function index(){
        $Model = new AllOrdersModel();
        $orders = $Model->readAllorders();
        $regions = $Model->readAllareas();
    
        include 'app/views/AllOrders/index.php';
    }

    public function search(){
        $data =[
            'order-search' => '',
            'region-search' => '',
            'date-search' => '',
            'status-search' => '2',
        ];

        if($_POST === $data){
            $Model = new AllOrdersModel();
            $orders = $Model->readAllorders();
            $regions = $Model->readAllareas();
    
            include 'app/views/AllOrders/index.php';
        }else{
            $Model = new AllOrdersModel();
            $orders = $Model->readsearch($_POST['order-search'],$_POST['region-search'],$_POST['date-search'],$_POST['status-search']);
            $regions = $Model->readAllareas();
    
            include 'app/views/AllOrders/index.php';
        }
    }

    public function edit(){
        $Model = new AllOrdersModel();
        $order = $Model->read($_GET['id']);
        $regions = $Model->readAllareas();

        include 'app/views/AllOrders/edit.php';
    }

    public function update(){
        $Model = new AllOrdersModel();
        $Model->update($_GET['id'], $_POST);
        var_dump($_POST);

        header('Location: index.php?page=AllOrders');
    }

    public function delete(){
        $Model = new AllOrdersModel();
        $Model->delete($_GET['id']);

        header('Location: index.php?page=AllOrders');
    }
}



?>