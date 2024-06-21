<?php
  if(isset($_GET['deleteSchool'])){
    $id = $_GET['id'];
    
    include('../reusable/con.php');

    $query = "DELETE FROM schools WHERE `id` = '$id'";
    $school = mysqli_query($connect, $query);

    if($school){
      header('Location: ../index.php');
    }
    else{
      echo mysqli_error($connect);
    }
  }else{
    echo "You should not be here!";
  }





  
