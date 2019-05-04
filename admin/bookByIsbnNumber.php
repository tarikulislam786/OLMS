<?php
// Connection data (server_address, database, name, poassword)
$hostdb = 'localhost';
$namedb = 'olms';
$userdb = 'root';
$passdb = '';

if (isset($_POST['isbn'])){
     $isbn = $_POST['isbn'];
    $return_arr = array();
   

    try {
        $conn = new PDO("mysql:host=".$hostdb.";dbname=".$namedb, $userdb, $passdb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT book_id, book_name FROM books WHERE isbn_number ='.$isbn);
        $stmt->execute(array('isbn' => $isbn));

        while($row = $stmt->fetch()) {
            $return_arr['id'] =  $row['book_id'];
            $return_arr['book_name'] =  $row['book_name'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    //echo json_encode($return_arr);
    echo json_encode(array('book_id'=>$return_arr['id'], 'book_name'=>$return_arr['book_name']));
}
?>