<?php
    # headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    # include DB and Category classes
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    # instatiate DB and connect
    $database = new Database();
    $db = $database->connect();

    # instatiate category object
    $category = new Category($db);

    # get raw data
    $data = json_decode(file_get_contents("php://input"));

    # assign data to category
    $category->name = $data->name;

    # create category
    if ($category->create()) {
        echo json_encode(array('message' => 'Category created.'));
    } else {
        echo json_encode(array('message' => 'Category not created!'));
    }

?>