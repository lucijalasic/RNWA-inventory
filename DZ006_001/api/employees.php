<?php 
    $valid_passwords = [
        "admin" => "admin",
        "lussinda" => "test",
        "antonia" => "test"
    ];
    $valid_users = array_keys($valid_passwords);

    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];

    $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

    if (!$validated) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");
    }


    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Employee.php';

    $request_method = $_SERVER["REQUEST_METHOD"];

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    switch($request_method)
    {
        case 'GET':
            // employee query 

            // If emp_no is set, pass emp_no to function and retrieve only that data
            if(!empty($_GET["emp_no"]))
            {
                $emp_no = $_GET["emp_no"];
                $result = $employee->get($emp_no);
            }
            // else, if emp_no is not set, retrieve all data
            else {
                $result = $employee->get();
            }
            // Get row count
            $numRows = $result->rowCount();

            // Check for data
            if($numRows > 0) {
                // employee array
                $employee_arr = array();

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $employee_item = array(
                        'emp_no'        => $emp_no,
                        'birth_date'    => $birth_date,
                        'first_name'    => $first_name,
                        'last_name'     => $last_name,
                        'gender'        => $gender,
                        'hire_date'     => $hire_date,
                    );

                    // Push to array
                    array_push($employee_arr, $employee_item);
                }

                // Turn to JSON & output
                echo json_encode($employee_arr);
            }
            else {
                // No data
                echo json_encode(
                    array('message' => 'No data found for this employee')
                );
            }
            break;
        
        // INSERT data
        case 'POST':
            // Insert Employee
            $emp_no     = $_GET["emp_no"];
            $birth_date = $_GET["birth_date"];
            $first_name = $_GET["first_name"];
            $last_name  = $_GET["last_name"];
            $gender     = $_GET["gender"];
            $hire_date  = $_GET["hire_date"];

            $result = $employee->insert($emp_no, $birth_date, $first_name, $last_name, $gender, $hire_date);

            echo $result;
            break;

        // UPDATE data
        case 'PUT':
            // Update Employee
            $emp_no     = $_GET["emp_no"];
            $birth_date = $_GET["birth_date"];
            $first_name = $_GET["first_name"];
            $last_name  = $_GET["last_name"];
            $gender     = $_GET["gender"];
            $hire_date  = $_GET["hire_date"];

            $result = $employee->update($emp_no, $birth_date, $first_name, $last_name, $gender, $hire_date);

            echo $result;
            break;

        case 'DELETE':
            // Delete Emoloyee
            $emp_no = $_GET["emp_no"];
            $result = $employee->delete($emp_no);

            echo json_encode($result);
            break;

        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode("Sorry, but that method is not allowed for this URL :(");
            break;
    }