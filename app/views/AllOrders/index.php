<?php

$title = 'Все заказы';
ob_start(); 
?>

<h1>Все заказы</h1>
<div class="container">
    <form action="index.php?page=AllOrders&action=search" method="POST">
        <div class="row">
            <div class="col">
                <input type="text" name="order-search" id="order-search" class="form-control" placeholder="Номер заказа">
            </div>
            <div class="col">
                <select class="form-control" id="region-search" name="region-search">
                        <option value="<?php echo null; ?>">Все районы</option>
                    <?php foreach($regions as $region): ?>
                        <option value="<?php echo $region['region'];?>"><?php echo $region['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col">
                <input type="date" name="date-search" id="date-search" class="form-control">
            </div>
            <div class="col">
                <select name="status-search" id="status-search" class="form-control">
                    <option value="2">любой статус</option>
                    <option value="0">Не выполнен</option>
                    <option value="1">Выполнен</option>
                </select>
            </div>
            <button type="submit" class="col mb-3 btn btn-primary">Найти</button>
        </div>
    </form>
</div>

    <div class="container mt-4">
    <?php //функция readAllorders 

    //var_dump($_POST);
    // if(isset($_POST['submit'])){ 
    //     if(isset($_GET['go'])){ 
    //     if(preg_match("/[A-Z  | a-z]+/", $_POST['name'])){ 
    //     $name=$_POST['name']; 
    //     // Подключиться к базе данных
    //     $db=mysql_connect  ("servername", "username",  "password") or die ('Я не могу подключиться к базе данных, так как: ' . mysql_error());  
    //     //- Выберите базу данных
    //     $mydb=mysql_select_db("yourDatabase"); 
    //     //- Запрос к таблице базы данных
    //     $sql="SELECT  ID, FirstName, LastName FROM Contacts WHERE FirstName LIKE '%" . $name .  "%' OR LastName LIKE '%" . $name ."%'"; 
    //     //- Запустить запрос к функции MySQL Query
    //     $result=mysql_query($sql); 
    //     } 
    //     else{ 
    //     echo  "<p> Пожалуйста, введите поисковый запрос </p>"; 
    //     } 
    //     } 
    //     } 
    foreach ($orders as $order): ?>
            <?php require 'app/views/AllOrders/search.php';?>
    <?php endforeach; ?>
    </div>


<?php $content = ob_get_clean(); 

include 'app/views/layout.php';
?>