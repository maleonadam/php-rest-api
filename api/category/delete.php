<?php
    # headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    # set id to delete
    $category->id = $data->id;

    # delete category
    if ($category->delete()) {
        echo json_encode(array('message' => 'Category deleted.'));
    } else {
        echo json_encode(array('message' => 'Category not deleted!'));
    }

?>