<?php
    # headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    # include DB and Category classes
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    # instatiate DB and connect
    $database = new Database();
    $db = $database->connect();

    # instatiate category object
    $category = new Category($db);

    # get id
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    # get category
    $category -> read_single();

    # create array
    $category_arr = array(
        'id' => $category->id,
        'name' => $category->name
    );

    # convert to json
    print_r(json_encode($category_arr));

?>