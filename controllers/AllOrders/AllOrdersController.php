<?php

class AllOrdersController{
    public function index(){
        $Model = new AllOrdersModel();
        $orders = $Model->readAllorders();
    
        include 'app/views/AllOrders/index.php';
    }

    public function edit(){
        $Model = new AllOrdersModel();
        $order = $Model->read($_GET['id']);
        $regions = $Model->readAllareas();

        // $roleModel = new Role();
        // $roles = $roleModel->getAllRoles();

        include 'app/views/AllOrders/edit.php';
    }

    public function update(){
        $Model = new AllOrdersModel();
        $Model->update($_GET['id'], $_POST);

        header('Location: index.php?page=AllOrders');
    }

    public function delete(){
        $Model = new AllOrdersModel();
        $Model->delete($_GET['id']);

        header('Location: index.php?page=AllOrders');
    }
}



?>