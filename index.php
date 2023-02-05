<?php 

include_once("config.php");
include_once("err_handler.php");
include_once("db_connect.php");
include_once("functions.php");

include_once("find_token.php");

if(!isset($_GET['type'])) {
    echo ajax_echo(
        "Ошибка!", 
        "Вы не указали GET параметр type", 
        true, 
        "ERROR", 
        null 
    );
    exit();
}
// вывод list product
if(preg_match_all("/^(list_product)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `name`, `sub_price` FROM `product`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе.", 
            true, 
            "ERROR", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Список продукции",
        "Вывод списка продуктов",
        false, 
        "SUCCESS", 
        $arr_list 
    );

    exit();
}
// вывод list_users
if(preg_match_all("/^(list_users)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `name`, `email` FROM `users`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Owibka", 
            "Owibka v zaprose.", 
            true, 
            "ERROR", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Spisok polzovateley",
        "Vivod spiska polzovateley",
        false, 
        "SUCCESS", 
        $arr_list 
    );

    exit();
}

// вывод cart_product
if(preg_match_all("/^(cart_product)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `user_id`, `product_id`, `deleted` FROM `cart_products`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе.", 
            true, 
            "ERROR", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Список наличия продуктов",
        "Вывод списка наличия",
        false, 
        "SUCCESS", 
        $arr_list 
    );

    exit();
}

// вывод services
if(preg_match_all("/^(services)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `name`, `price`, `deleted` FROM `services`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе.", 
            true, 
            "ERROR", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Список услуг",
        "Вывод списка услуг",
        false, 
        "SUCCESS", 
        $arr_list 
    );

    exit();
}

// вывод cart services
if(preg_match_all("/^(cart_services)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `user_id`, `services_id`, `deleted` FROM `cart_services`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе.", 
            true, 
            "ERROR", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Список услуг в наличии",
        "Вывод списка наличия",
        false, 
        "SUCCESS", 
        $arr_list 
    );

    exit();
}

// добавление новых записей в продукты едрить колотить
else if(preg_match_all("/^add_product$/ui", $_GET['type'])){

    if(!isset($_GET['sub_price'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr sub_price!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr name!",
            "ERROR",
            null
        );
        exit;
    }
    
    if(!isset($_GET['amount'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr amount!",
            "ERROR",
            null
        );
        exit;
    }
    $query = "INSERT INTO `product`(`name`, `sub_price`, `amount`) VALUES ('".$_GET['name']."',".$_GET['sub_price'].", ".$_GET['amount'].")";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Owibka!",
            "Owibka v zaprose!",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Ura!",
        "Nowiy towar bil dobavlen v bd",
        false,
        "SUCCESS"
    );
    exit;
}
// добавление новой услуги
else if(preg_match_all("/^add_service$/ui", $_GET['type'])){

    if(!isset($_GET['price'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr price!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Owbika!",
            "Vi ne ukazali GET parametr name!",
            "ERROR",
            null
        );
        exit;
    }
    
    $query = "INSERT INTO `services`(`name`, `price`) VALUES ('".$_GET['name']."',".$_GET['price'].")";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Owibka!",
            "Owibka v zaprose!",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Ura!",
        "Novaya usluga bila dobavlena v bd!",
        false,
        "SUCCESS"
    );
    exit;
}

// добавление тренера
else if(preg_match_all("/^add_coach$/ui", $_GET['type'])){

    if(!isset($_GET['user_id'])){
        echo ajax_echo(
            "Owibka",
            "Vi ne ukazali GET parametr user_id!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['busy_id'])){
        echo ajax_echo(
            "OWibka!",
            "Vi ne ukazali GET parametr busy_id!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "OWibka!",
            "Vi ne ukazali GET parametr name!",
            "ERROR",
            null
        );
        exit;
    }
    
    $query = "INSERT INTO `coach`(`name`, `busy_id`, `user_id`) VALUES ('".$_GET['name']."','".$_GET['busy_id']."','".$_GET['user_id']."')";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Owibka!",
            "Owibka v zaprose!",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Uspex!",
        "New coach bil dobavlen!",
        false,
        "SUCCESS"
    );
    exit;
}
// изменение данных тренера
else if(preg_match_all("/^edit_coach$/ui", $_GET['type'])){

    if(!isset($_GET['id'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr id!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['busy_id'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr busy_id!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr name!!",
            "ERROR",
            null
        );
        exit;
    }

    $query = "UPDATE `coach` SET `name`='".$_GET['name']."',`busy_id`=".$_GET['busy_id']." WHERE `id` = ".$_GET['id'];
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Owibka",
            "Owibka v zaprose",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Ura!",
        "Coach bil izmenen v baze dannix",
        false,
        "SUCCESS"
    );
    exit;
}

//редактирование пользователя
else if(preg_match_all("/^edit_users$/ui", $_GET['type'])){

    if(!isset($_GET['id'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr id!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['surname'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr surname!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr name!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['login'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr login!",
            "ERROR",
            null
        );
        exit;
    }
    
    $query = "UPDATE `users` SET `name`='".$_GET['name']."',`surname`='".$_GET['surname']."',`login`='".$_GET['login']."' WHERE `id` = ".$_GET['id'];
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Owibka!",
            "OWibka v zaprose!",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Ura!",
        "User bil izmenen v baze dannih!",
        false,
        "SUCCESS"
    );
    exit;
}
//изменение в услугах
else if(preg_match_all("/^edit_service$/ui", $_GET['type'])){

    if(!isset($_GET['id'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr id!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['price'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametrprice!",
            "ERROR",
            null
        );
        exit;
    }

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Owibka!",
            "Vi ne ukazali GET parametr name!",
            "ERROR",
            null
        );
        exit;
    }

    $query = "UPDATE `services` SET `name`='".$_GET['name']."',`price`=".$_GET['price']." WHERE `id` = ".$_GET['id'];
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Owibka!",
            "Owibka v zaprose!",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Uspex!",
        "Usluga bila izmenena v baze dannih!",
        false,
        "SUCCESS"
    );
    exit;
}
