<?php
// Connection data (server_address, database, name, poassword)
$hostdb = 'localhost';
$namedb = 'olms';
$userdb = 'root';
$passdb = '';

if (isset($_GET['term'])){
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".$hostdb.";dbname=".$namedb, $userdb, $passdb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT roll_no FROM students WHERE roll_no LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['roll_no'];
            // $return_arr['id'] =  $row['id'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}if (isset($_GET['stid'])){
    $stid= $_GET['stid'];
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".$hostdb.";dbname=".$namedb, $userdb, $passdb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT users.id,first_name,last_name,roll_no, user_id FROM users INNER JOIN students ON users.id=students.user_id WHERE roll_no='.$stid);
        $stmt->execute(array('stid' => $stid));

        while($row = $stmt->fetch()) {
            $return_arr['first_name'] =  $row['first_name'];
            $return_arr['last_name'] =  $row['last_name'];
            $return_arr['user_id'] =  $row['user_id'];
            // $return_arr['id'] =  $row['id'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode(array('fname'=>$return_arr['first_name'], 'lname'=>$return_arr['last_name'], 'user_id'=>$return_arr['user_id']));
}
?>