<?php

$title = 'EditOrder';
ob_start();

?>

<div>
    <form method="POST" action="index.php?page=FormOrder&action=store">
    <div class="mb-3">
        <label for="NameSender" class="form-label">Имя отправителя</label>
        <input type="text" class="form-control" id="NameSender" name="NameSender" required>
    </div>
    <div class="mb-3">
        <label for="PhoneSender" class="form-label">Номер телефона отправителя</label>
        <input type="tel" class="form-control" id="PhoneSender" name="PhoneSender" required>
    </div>
    <div class="mb-3">
        <label for="region" class="form-label">Район</label>
        <select class="form-control" id="region" name="region">
            <?php foreach($areas as $area): ?>
                <option value="<?php echo $area['region'];?>" selected ><?php echo $area['region'];?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="mb-3">
        <label for="AddSender" class="form-label">Адрес отправителя</label>
        <input type="text" class="form-control" id="AddSender" name="AddSender" required>
    </div>
    <div class="mb-3">
        <label for="NumberSeats" class="form-label">Колличество мест</label>
        <input type="number" class="form-control" id="NumberSeats" name="NumberSeats" required>
    </div>
    <div class="mb-3">
        <label for="Weight" class="form-label">Примерный вес</label>
        <input type="number" class="form-control" id="Weight" name="Weight" required>
    </div>
    <div class="mb-3">
        <label for="RecipientName" class="form-label">Имя получателя</label>
        <input type="text" class="form-control" id="RecipientName" name="RecipientName" required>
    </div>
    <div class="mb-3">
        <label for="PhoneRecipient" class="form-label">Номер телефона получателя</label>
        <input type="tel" class="form-control" id="PhoneRecipient" name="PhoneRecipient" required>
    </div>
    <div class="mb-3">
        <label for="AddRecipient" class="form-label">Адрес получателя</label>
        <input type="text" class="form-control" id="AddRecipient" name="AddRecipient" required>
    </div>
    <div class="mb-3">
        <label for="comments" class="form-label">Комментарий к заказу</label>
        <textarea class="form-control" id="comments" name="comments" required></textarea>
    </div>

    
    <button type="submit" class="btn btn-primary">Готово</button>
    </form>
</div>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>