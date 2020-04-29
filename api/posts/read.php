<?php
    # headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    # include DB and Post classes
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    # instatiate DB and connect
    $database = new Database();
    $db = $database->connect();

    # instatiate blog post object
    $post = new Post($db);

    # blog post query
    $result = $post->read();

    # get row count
    $num = $result->rowCount();

    # check if any posts exist
    if ($num > 0) {
        # post array
        $posts_arr = array();
        $posts_arr['data'] = array();

        # while loop to go through the data
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            # post item for each post
            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );
            # push to array
            array_push($posts_arr['data'], $post_item);
        }

        # convert to json and output
        echo json_encode($posts_arr);
    } else {
        # no posts
        echo json_encode(
            array('message' => 'No Posts Found!')
        );
    }
?>
    