<?php
  if(isset($_POST['addSchool'])){
    // print_r($_POST);
    $schoolName = $_POST['schoolName'];
    $schoolLevel = $_POST['schoolLevel'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Connection string
    include('../reusable/con.php');
    $query = "INSERT INTO schools (`School Name`, `School Level`, `Phone`, `Email`) VALUES ('$schoolName', '$schoolLevel', '$phone', '$email')";

    $school = mysqli_query($connect, $query);

    if($school){
      header("Location: ../index.php"); 
    }else{
      echo "Failed: " . mysqli_error($connect);
  }
  }else{
    echo "You should not be here!";
  }
?>