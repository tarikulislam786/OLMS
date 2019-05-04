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

        $stmt = $conn->prepare('SELECT email FROM users WHERE email LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['email'];
            // $return_arr['id'] =  $row['id'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}if (isset($_GET['email'])){
    $emailID= $_GET['email'];//print_r($emailID);
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".$hostdb.";dbname=".$namedb, $userdb, $passdb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT id,first_name,last_name FROM users WHERE email="'.$emailID.'"');//print_r($stmt);
        $stmt->execute(array('emailID' => $emailID));

        while($row = $stmt->fetch()) {
            $return_arr['uid'] =  $row['id'];
            $return_arr['first_name'] = $row['first_name'];
            $return_arr['last_name'] =  $row['last_name'];
            // $return_arr['id'] =  $row['id'];
        }
       // print_r($return_arr);

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode(array('id'=>$return_arr['uid'],'fname'=>$return_arr['first_name'], 'lname'=>$return_arr['last_name']));
}
?>