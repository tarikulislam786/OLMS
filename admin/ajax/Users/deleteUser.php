<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "") {
    // include Database connection file
    include("../../dbconnect.php");

    // get user id
    $user_id = $_POST['id'];


    if (!empty($user_id)) {
        // detect this user id is contained in student, teacher or librarian entity
        $sqlStudent = 'SELECT id from students WHERE user_id = ? LIMIT 1';
        $stmtStudent = $conn->prepare($sqlStudent);
        $stmtStudent->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmtStudent->execute();

        $sqlTeacher = 'SELECT id from teachers WHERE user_id = ? LIMIT 1';
        $stmtTeacher = $conn->prepare($sqlTeacher);
        $stmtTeacher->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmtTeacher->execute();

        $sqlLibrarian = 'SELECT id from librarians WHERE user_id = ? LIMIT 1';
        $stmtLibrarian = $conn->prepare($sqlLibrarian);
        $stmtLibrarian->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmtLibrarian->execute();

        if ($stmtStudent->fetchColumn()) {
            // query from student entity
            // delete Stduent
            $queryDelStudent = "DELETE FROM students WHERE user_id = '$user_id'";
            // delete User
            $queryDelUser = "DELETE FROM users WHERE id = '$user_id'";
            $conn->query($queryDelStudent);
            $conn->query($queryDelUser);
        } elseif ($stmtTeacher->fetchColumn()) {
            // delete teacher
            $queryDelTeacher = "DELETE FROM teachers WHERE user_id = '$user_id'";
            // delete User
            $queryDelUser = "DELETE FROM users WHERE id = '$user_id'";
            $conn->query($queryDelTeacher);
            $conn->query($queryDelUser);
        } elseif ($stmtLibrarian->fetchColumn()) {
            // delete librarian
            $queryDelLibrarian = "DELETE FROM librarians WHERE user_id = '$user_id'";
            // delete User
            $queryDelUser = "DELETE FROM users WHERE id = '$user_id'";
            $conn->query($queryDelLibrarian);
            $conn->query($queryDelUser);
        } else {
            die('not found');
        }

        /*if (!$result = mysql_query($query)) {
            exit(mysql_error());
        }*/

    }
}
?>