<?php 
    class Employee {
        // DB attributes
        private $connection;
        private $table = 'employees';

        // GET Properties
        public $emp_no;
        public $birth_name;
        public $first_name;
        public $last_name;
        public $gender;
        public $hire_date;

        // Constructor with DB
        public function __construct($db) {
            $this->connection = $db;
        }

        // GET data
        public function get( $emp_no = 0 ) {
            // Create query
            if($emp_no != 0) {
                $query = 'SELECT
                    e.emp_no,
                    e.birth_date,
                    e.first_name,
                    e.last_name,
                    e.gender,
                    e.hire_date
                FROM
                    ' . $this->table .' e
                WHERE e.emp_no=' . $emp_no . ' LIMIT 1';
            }
            else {
                $query = 'SELECT
                    e.emp_no,
                    e.birth_date,
                    e.first_name,
                    e.last_name,
                    e.gender,
                    e.hire_date
                FROM
                    ' . $this->table .' e
                ORDER BY 
                    e.emp_no DESC';
            }
            
            // Prepare statement
            $stmt = $this->connection->prepare($query);

            // Execute statement
            $stmt->execute();

            return $stmt;
        }

        // POST data
        public function insert($emp_no, $birth_date, $first_name, $last_name, $gender, $hire_date) {
            
            $query="INSERT INTO 
                        " . $this->table ."(emp_no, birth_date, first_name, last_name, gender, hire_date) 
                    VALUES
                        ('".$emp_no."','".$birth_date."','".$first_name."','".$last_name."','".$gender."','".$hire_date."')";

            $stmt = $this->connection->prepare($query);

            if($stmt->execute()) {
                $response=array(
                    'status' => 1,
                    'status_message' =>'Zaposlenik '.$emp_no.' '.$birth_date.' '.$first_name.' '.$last_name.' '.$gender.' '.$hire_date.' je uspješno dodan.'
                );
            }
            else {
                $response=array(
                    'status' => 0,
                    'status_message' =>'Dodavanje zaposlenika nije uspjelo.'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        // PUT data
        public function update($emp_no, $birth_date, $first_name, $last_name, $gender, $hire_date) {
            // Update query
            $query="UPDATE 
                        " . $this->table ." 
                    SET 
                        birth_date='".$birth_date."', first_name='".$first_name."', last_name='".$last_name."', gender='".$gender."', hire_date='".$hire_date."' WHERE emp_no=".$emp_no;

            $stmt = $this->connection->prepare($query);

            if($stmt->execute()) {
                $response=array(
                    'status' => 1,
                    'status_message' =>'Zaposlenik '.$emp_no.' '.$first_name.' je uspješno izmjenjen.'
                );
            }
            else {
                $response=array(
                    'status' => 0,
                    'status_message' =>'Uređivanje zaposlenika nije uspjelo.'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        // DELETE data
        public function delete($emp_no) {
            // Create delete query
            $query="DELETE FROM " . $this->table . " WHERE emp_no =" .$emp_no;

            // Prepare delete statement
            $stmt = $this->connection->prepare($query);

            // Prepare and execute query for checking employee by emp_no
            $check_query = 'SELECT * FROM ' . $this->table .' e WHERE e.emp_no=' . $emp_no . ' LIMIT 1';
            $stmt_check = $this->connection->prepare($check_query);
            $stmt_check->execute();

            // If employee with given emp_no exists, try to delete
            if($stmt_check->rowCount() > 0) {
                if( $stmt->execute() ) {
                    $response = [
                        'status' => 1,
                        'status_message' =>'Zaposlenik je uspješno izbrisan'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
                else {
                    $response = [
                        'status' => 0,
                        'status_message' =>'Brisanje zaposlenika nije uspjelo.'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
            // If employee is not found
            else {
                $response = [
                    'status' => -1,
                    'status_message' =>'Zaposlenik nije pronađen.'
                ];

                echo json_encode($response);
            }
        }
    }