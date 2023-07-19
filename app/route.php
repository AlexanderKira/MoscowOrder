<?php

class Route{
    
    public function run(){
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        switch($page){
            case '':
            case 'home':
                $controller = new HomeController();
                $controller->index();
                break;
                case 'FormOrder':
                    $controller = new FormOrderController();
                    if(isset($_GET['action'])){
                        switch ($_GET['action']){
                            case 'create':
                                $controller->create();
                                break;
                            case 'store':
                                $controller->store();
                                break;
                        }
                    }else{
                        $controller = new HomeController();
                        $controller->index();
                        break;
                    }
                break;
                case 'AllOrders':
                    $controller = new AllOrdersController();
                    if(isset($_GET['action'])){
                        switch ($_GET['action']){
                            case 'edit':
                                $controller->edit($_GET['id']);
                                break;
                            case 'update':
                                $controller->update();
                                break;
                            case 'delete':
                                $controller->delete();
                                break;
                        }
                    }else{
                        $controller->index();
                    }
                break;
            default:
                http_response_code(404);
                echo "Page not found!";
                break;
        }
    }
}

?>