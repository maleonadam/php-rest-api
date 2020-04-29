<?php
    # headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    # include DB and Post classes
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    # instatiate DB and connect
    $database = new Database();
    $db = $database->connect();

    # instatiate blog post object
    $post = new Post($db);

    # get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    # set id to update
    $post->id = $data->id;

    # assign data to post
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    # update post
    if ($post->update()) {
        echo json_encode(array('message' => 'Post updated.'));
    } else {
        echo json_encode(array('message' => 'Post not updated!'));
    }
    
?>