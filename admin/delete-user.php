<?php

try{
// check request
  if(isset($_GET['id']) && isset($_GET['id']) != "") {
      // include Database connection file
      include("dbconnect.php");

      // get user id
      $user_id = $_GET['id'];


      if (!empty($user_id)) {//print_r($user_id);exit;
          // detect this user id is contained in student, teacher or librarian entity by role
          // role 2=student, 3= teacher, 4=librarian
          $stmt = $conn->prepare("SELECT users.id,role FROM (users LEFT JOIN students
  ON users.id = students.user_id) LEFT JOIN teachers on users.id = teachers.user_id
  LEFT JOIN librarians on users.id = librarians.user_id WHERE users.id =".$user_id);
          $stmt->execute();
          $row = $stmt->fetch();
          $role = $row['role'];
          // we restrict to delete user who have issued books by Setting up a foreign key constraint in (mysql)phpmyadmin
           if ($role == 2) { // if student
             // delete Stduent

             $queryDelStudent = "DELETE FROM students WHERE user_id = '$user_id'";
             // delete User
             $queryDelUser = "DELETE FROM users WHERE id = '$user_id'";
             $result = $conn->query($queryDelUser);
             $conn->query($queryDelStudent);
             header("Location:users-manage.php");
         } elseif ($role == 3) { // if teacher
             // delete teacher
             $queryDelTeacher = "DELETE FROM teachers WHERE user_id = '$user_id'";
             // delete User
             $queryDelUser = "DELETE FROM users WHERE id = '$user_id'";
             $result = $conn->query($queryDelUser);
             $conn->query($queryDelTeacher);
             header("Location:users-manage.php");
         } elseif ($role == 4) { // if librarian
             // delete librarian
             $queryDelLibrarian = "DELETE FROM librarians WHERE user_id = '$user_id'";
             // delete User
             $queryDelUser = "DELETE FROM users WHERE id = '$user_id'";
             $result = $conn->query($queryDelUser);
             $conn->query($queryDelLibrarian);
             header("Location:users-manage.php");
            }
         } else {
             die('not found');
         } 
      }

}catch (PDOException $e) { 
    if ($e->getCode() == '23000') // foreignkey constraint code
        //echo "Syntax Error: ".$e->getMessage(); 
    header("Location:users-manage.php?fkeyconstraint=1");
}

?>