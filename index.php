<?php

//модели
require_once 'models/database.php';
require_once 'models/FormOrder/FormOrderModel.php';
require_once 'models/AllOrders/AllOrdersModel.php';

//контроллеры
require_once 'controllers/HomeController.php';
require_once 'controllers/FormOrder/FormOrderController.php';
require_once 'controllers/AllOrders/AllOrdersController.php';
//маршруты
require_once 'app/route.php';

$route = new Route();

$route->run();

?>