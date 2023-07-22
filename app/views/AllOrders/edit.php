<?php

$title = 'EditOrder';
ob_start();

?>

<div>
    <form method="POST" action="index.php?page=AllOrders&action=update&id=<?php echo $order['id']; ?>">
    <div class="mb-3">
        <label for="status" class="form-label">Статус: </label>
        <select name="status" id="status" class="form-control">
            <option value="0" <?php if(!$order['status'] ) {echo 'selected';}?>>Не выполнен</option>
            <option value="1" <?php if($order['status'] ) {echo 'selected';}?>>Выполнен</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="NameSender" class="form-label">Имя отправителя</label>
        <input value="<?php echo $order['NameSender'];?>" type="text" class="form-control" id="NameSender" name="NameSender" required>
    </div>
    <div class="mb-3">
        <label for="PhoneSender" class="form-label">Номер телефона отправителя</label>
        <input value="<?php echo $order['PhoneSender'];?>" type="tel" class="form-control" id="PhoneSender" name="PhoneSender" required>
    </div>
    <div class="mb-3">
        <label for="region" class="form-label">Район</label>
        <select class="form-control" id="region" name="region">
            <?php foreach($regions as $region): ?>
                <option value="<?php echo $region['region'];?>" <?php echo $order['region'] == $region['region'] ? 'selected' : ''; ?> ><?php echo $region['name'];?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="mb-3">
        <label for="AddSender" class="form-label">Адрес отправителя</label>
        <input value="<?php echo $order['AddSender']; ?>" type="text" class="form-control" id="AddSender" name="AddSender" required>
    </div>
    <div class="mb-3">
        <label for="NumberSeats" class="form-label">Колличество мест</label>
        <input value="<?php echo $order['NumberSeats']; ?>" type="number" class="form-control" id="NumberSeats" name="NumberSeats" required>
    </div>
    <div class="mb-3">
        <label for="Weight" class="form-label">Примерный вес</label>
        <input value="<?php echo $order['Weight']; ?>" type="number" class="form-control" id="Weight" name="Weight" required>
    </div>
    <div class="mb-3">
        <label for="RecipientName" class="form-label">Имя получателя</label>
        <input value="<?php echo $order['RecipientName']; ?>" type="text" class="form-control" id="RecipientName" name="RecipientName" required>
    </div>
    <div class="mb-3">
        <label for="PhoneRecipient" class="form-label">Номер телефона получателя</label>
        <input value="<?php echo $order['PhoneRecipient']; ?>" type="tel" class="form-control" id="PhoneRecipient" name="PhoneRecipient" required>
    </div>
    <div class="mb-3">
        <label for="AddRecipient" class="form-label">Адрес получателя</label>
        <input value="<?php echo $order['AddRecipient']; ?>" type="text" class="form-control" id="AddRecipient" name="AddRecipient" required>
    </div>
    <div class="mb-3">
        <label for="comments" class="form-label">Комментарий к заказу</label>
        <textarea value="<?php echo $order['comments']; ?>" class="form-control" id="comments" name="comments"></textarea>
    </div>

    
    <button type="submit" class="btn btn-primary">Готово</button>
    </form>
</div>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>