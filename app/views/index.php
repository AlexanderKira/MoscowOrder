<?php

$title = 'Главная';
ob_start();

?>

<h1>Home</h1>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>