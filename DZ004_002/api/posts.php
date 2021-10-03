<?php 
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Post.php';

    $request_method = $_SERVER["REQUEST_METHOD"];

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate post object
    $post = new Post($db);

    switch($request_method)
    {
        case 'GET':
            // post query 

            // If id is set, pass id to function and retrieve only that data
            if(!empty($_GET["id"]))
            {
                $id = $_GET["id"];
                $result = $post->get($id);
            }
            // else, if id is not set, retrieve all data
            else {
                $result = $post->get();
            }
            // Get row count
            $numRows = $result->rowCount();

            // Check for data
            if($numRows > 0) {
                // post array
                $post_arr = array();

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $post_item = array(
                        'id'            => $id,
                        'title'         => $title,
                        'body'          => $body,
                        'user_id'       => $user_id,
                        'post_thumbnail'=> $post_thumbnail,
                        'deleted_at'    => $deleted_at,
                        'created_at'    => $created_at,
                        'updated_at'    => $updated_at
                    );

                    // Push to array
                    array_push($post_arr, $post_item);
                }

                // Turn to JSON & output
                echo json_encode($post_arr);
            }
            else {
                // No data
                echo json_encode(
                    array('message' => 'No data found for this post')
                );
            }
            break;
        
        // INSERT data
        case 'POST':
            // Insert post
            $id             = $_GET["id"];
            $title          = $_GET["title"];
            $body           = $_GET["body"];
            $user_id        = $_GET["user_id"];
            $post_thumbnail = $_GET["post_thumbnail"];
            $deleted_at     = $_GET["deleted_at"];
            $created_at     = $_GET["created_at"];
            $updated_at     = $_GET["updated_at"];

            $result = $post->insert($id, $title, $body, $user_id, $post_thumbnail, $deleted_at, $created_at, $updated_at);

            echo $result;
            break;

        // UPDATE data
        case 'PUT':
            // Update post
            $id             = $_GET["id"];
            $title          = $_GET["title"];
            $body           = $_GET["body"];
            $user_id        = $_GET["user_id"];
            $post_thumbnail = $_GET["post_thumbnail"];
            $deleted_at     = $_GET["deleted_at"];
            $created_at     = $_GET["created_at"];
            $updated_at     = $_GET["updated_at"];

            $result = $post->update($id, $title, $body, $user_id, $post_thumbnail, $deleted_at, $created_at, $updated_at);

            echo $result;
            break;

        case 'DELETE':
            // Delete Emoloyee
            $id = $_GET["id"];
            $result = $post->delete($id);

            echo json_encode($result);
            break;

        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode("Sorry, but that method is not allowed for this URL :(");
            break;
    }