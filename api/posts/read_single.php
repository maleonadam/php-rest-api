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

    # get id
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    # get post
    $post->read_single();

    #create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    #convert to json
    print_r(json_encode($post_arr));
?>