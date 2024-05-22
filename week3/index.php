<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 3</title>
</head>
<body>
    <?php
        // $hour = rand(1,24);
        // echo $hour;
        // echo '</br>';
        // if ($hour >= 5 && $hour <12) {
        //     echo 'Good Morning';
        // } 
        // elseif ($hour >= 12 && $hour<18) {
        //     echo 'Good Afternoon';
        // }
        // elseif ($hour >= 18 && $hour<21) {
        //     echo 'Good Evening';
        // }
        // elseif ($hour >= 21 && $hour<=24 || $hour <5) {
        //     echo 'Good Night';
        // }

        $num = rand(1,25);
        echo $num;
        echo '</br>';
        if ($num % 3 === 0 && $num % 5 != 0) {
            echo 'Fizz';
        }
        elseif ($num % 5 === 0 && $num % 3 != 0) {
            echo 'Buzz';
        } 
        elseif ($num % 3 === 0 && $num % 5 === 0) {
            echo 'FizzBuzz';
        } 
        else {
            echo $num;
        }
    ?>
</body>
</html>