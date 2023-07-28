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
                        <option>Все районы</option>
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
                    <option>любой статус</option>
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
    foreach ($orders as $order): ?>
            <?php require 'app/views/AllOrders/search.php';?>
    <?php endforeach; ?>
    </div>


<?php $content = ob_get_clean(); 

include 'app/views/layout.php';
?>