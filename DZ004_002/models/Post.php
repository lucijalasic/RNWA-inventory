<?php 
    class Post{
        // DB attributes
        private $connection;
        private $table = 'posts';

        // GET Properties
        public $id;
        public $title;
        public $body;
        public $user_id;
        public $post_thumbnail;
        public $deleted_at;
        public $created_at;
        public $updated_at;

        // Constructor with DB
        public function __construct($db) {
            $this->connection = $db;
        }

        // GET data
        public function get( $id = 0 ) {
            // Create query
            if($id != 0) {
                $query = 'SELECT
                    p.id,
                    p.title,
                    p.body,
                    p.user_id,
                    p.post_thumbnail,
                    p.deleted_at,
                    p.created_at,
                    p.updated_at
                FROM
                    ' . $this->table .' p
                WHERE p.id=' . $id . ' LIMIT 1';
            }
            else {
                $query = 'SELECT
                    p.id,
                    p.title,
                    p.body,
                    p.user_id,
                    p.post_thumbnail,
                    p.deleted_at,
                    p.created_at,
                    p.updated_at
                FROM
                    ' . $this->table .' p
                ORDER BY 
                    p.id DESC';
            }
            
            // Prepare statement
            $stmt = $this->connection->prepare($query);

            // Execute statement
            $stmt->execute();

            return $stmt;
        }

        // POST data
        public function insert($id, $title, $body, $user_id, $post_thumbnail, $deleted_at, $created_at, $updated_at) {
            
            $query="INSERT INTO 
                        " . $this->table ."(id, title, body, user_id, post_thumbnail, deleted_at, created_at, updated_at) 
                    VALUES
                        ('".$id."','".$title."','".$body."','".$user_id."','".$post_thumbnail."','".$deleted_at."','".$created_at."','".$updated_at."')";

            $stmt = $this->connection->prepare($query);

            if($stmt->execute()) {
                $response=array(
                    'status' => 1,
                    'status_message' =>'Post '.$id.' '.$title.' '.$body.' '.$user_id.' '.$post_thumbnail.' '.$deleted_at.' '.$created_at.' '.$updated_at.' je uspješno dodan.'
                );
            }
            else {
                $response=array(
                    'status' => 0,
                    'status_message' =>'Dodavanje posta nije uspjelo.'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        // PUT data
        public function update($id, $title, $body, $user_id, $post_thumbnail, $deleted_at, $created_at, $updated_at) {
            // Update query
            $query="UPDATE 
                        " . $this->table ." 
                    SET 
                        title='".$title."', body='".$body."', user_id='".$user_id."', post_thumbnail='".$post_thumbnail."', deleted_at='".$deleted_at."', created_at='".$created_at."', updated_at='".$updated_at."' WHERE id=".$id;

            $stmt = $this->connection->prepare($query);

            if($stmt->execute()) {
                $response=array(
                    'status' => 1,
                    'status_message' =>'Post '.$id.' '.$body.' je uspješno izmjenjen.'
                );
            }
            else {
                $response=array(
                    'status' => 0,
                    'status_message' =>'Uređivanje posta nije uspjelo.'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        // DELETE data
        public function delete($id) {
            // Create delete query
            $query="DELETE FROM " . $this->table . " WHERE id =" .$id;

            // Prepare delete statement
            $stmt = $this->connection->prepare($query);

            // Prepare and execute query for checking employee by id
            $check_query = 'SELECT * FROM ' . $this->table .' e WHERE e.id=' . $id . ' LIMIT 1';
            $stmt_check = $this->connection->prepare($check_query);
            $stmt_check->execute();

            // If employee with given id exists, try to delete
            if($stmt_check->rowCount() > 0) {
                if( $stmt->execute() ) {
                    $response = [
                        'status' => 1,
                        'status_message' =>'post je uspješno izbrisan'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
                else {
                    $response = [
                        'status' => 0,
                        'status_message' =>'Brisanje posta nije uspjelo.'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
            // If employee is not found
            else {
                $response = [
                    'status' => -1,
                    'status_message' =>'post nije pronađen.'
                ];

                echo json_encode($response);
            }
        }
    }