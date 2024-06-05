<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $connect = mysqli_connect('localhost', 'root', 'root', 'HTTP5225Week5');

        if(!$connect){
            echo 'Error code:' . mysqli_connect_errno();
            echo 'Error code:' . mysqli_connect_error();
            exit;
        }

        $query = 'SELECT Name, Hex FROM colors';
        //run and execute query
        //Needs two parameters (1. connection string, 2. query)
        $result = mysqli_query($connect, $query);  

        if(!$result){
            echo 'Error Message' . mysqli_error($connect); //display error if nth returned
            exit;
        } else{
            echo 'The query found ' . mysqli_num_rows($result) . ' records:' .'<br>';
            foreach($result as $color){
                // echo $color['Name'] .' ('. $color['Hex'] . ')';
                echo '<div style="height: 15px; width: 200px; background: ' . $color['Hex'] . '">'. $color['Name'] .'</div>';
                echo '<br>';
            }
        }
    ?>
    
</body>
</html>