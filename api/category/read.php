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

    # category query
    $result = $category->read();

    # get row count
    $num = $result->rowCount();

    # check if any categories exist
    if ($num > 0) {
        # category array
        $categories_arr = array();
        $categories_arr['data'] = array();

        # while loop to go through the data
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            # category item for each category
            $category_item = array(
                'id' => $id,
                'name' => $name
            );
            # push to array
            array_push($categories_arr['data'], $category_item);
        }

        # convert to json and output
        echo json_encode($categories_arr);
    } else {
        # no categories
        echo json_encode(
            array('message' => 'No categories Found!')
        );
    }
?>
    