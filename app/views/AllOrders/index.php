<?php

$title = 'All orders';
ob_start(); 
?>

<h1>Все заказы</h1>
<div class="container">
    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <input type="text" value="id" class="form-control" placeholder="Номер заказа">
            </div>
            <div class="col">
                <!-- <label for="region" class="form-label">Район </label> -->
                <select class="form-control" id="region" name="region">
                    <?php foreach($regions as $region): ?>
                        <option value="<?php echo $region['region'];?>"><?php echo $region['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col">
                <!-- <label for="date" class="form-label">Дата</label> -->
                <input type="date" name="" id="" class="form-control">
            </div>
            <div class="col">
                <select name="" id="" class="form-control">
                    <option value="0" <?php //if(!$order['status'] ) {echo 'selected';}?>>Не выполнен</option>
                    <option value="1" <?php //if($order['status'] ) {echo 'selected';}?>>Выполнен</option>
                </select>
            </div>
            <button type="submit" class="col mb-3 btn btn-primary">Найти</button>
        </div>
    </form>
</div>

<?php foreach ($orders as $order): ?>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col"><?php echo 'Заказ №' . $order['id']?></div>
                            <div class="col"><?php echo $order['name']?></div>
                            <div class="col"><?php echo $order['created_at']?></div>
                            <div class="col"><?php echo $order['status'] ? 'Выполнен' : 'Не выполнен'; ?></div>
                        </div>
                    </div>
                    
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="container">
                        <h3>Отправление</h3>
                        <div class="row mb-3">
                            <div class="col"><strong>Район: </strong><?php echo $order['name']?></div>
                            <div class="col"><strong>Курьерские: </strong><?php echo $order['price']?>р</div>
                        </div>
                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                            <div class="col mb-3"><strong>Отправление: </strong><?php echo $order['AddSender']?></div>
                            <div class="col mb-3"><strong>кв/офис: </strong><?php echo $order['AddSenderApartment']?></div>
                            <div class="col mb-3"><strong>Этаж: </strong><?php echo $order['AddSenderfloor']?></div>
                        </div>
                        
                        <div class="mb-3"><strong>н/т Отправителя: </strong><?php echo $order['PhoneSender'] . ' ' . $order['NameSender']?></div>
                        <div class="mb-3"><strong>Комментарии: </strong><?php echo $order['comments']?></div>
                        
                        <div class="row mb-3">
                            <div class="col"><strong>к/мест: </strong><?php echo $order['NumberSeats']?></div>
                            <div class="col"><strong> Вес: </strong><?php echo $order['Weight']?> кг</div>
                        </div>

                        <h3>Получение</h3>
                        <div class="mb-3"><strong>Получение: </strong><?php echo $order['AddRecipient']?></div>
                        <div class="mb-3"><strong>н/т Получателя: </strong><?php echo $order['PhoneRecipient'] . ' ' . $order['RecipientName']?></div>
                        
                        <div class="row justify-content-between">
                            <a href="index.php?page=AllOrders&action=edit&id=<?php echo $order['id']; ?>" class="btn btn-primary col-4">Изменить</a>
                            <a href="index.php?page=AllOrders&action=delete&id=<?php echo $order['id']; ?>" class="btn btn-danger col-3">Удалить</a>
                        </div>
                    </div>
                    
                        
                            
                
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
 


<?php $content = ob_get_clean(); 

include 'app/views/layout.php';
?>