<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php echo('hello');?>

    <?php echo '<h1>Welcome to HTTP5225</h1>';?>

    <?php echo '<p>We will\'s learn PHP in this class</p>';?>

    <p>Things we will learn in class</p>

    <?php
    echo '<ul>
        <li>PHP</li>
        <li>mySQL</li>
        <li>Laravel</li>
    </ul>';
    ?>

    <?php echo '<img src="https://i.kym-cdn.com/entries/icons/original/000/046/895/huh_cat.jpg" width="500px" alt="">;'?>

    <img src="<?php echo 'https://i.kym-cdn.com/entries/icons/original/000/046/895/huh_cat.jpg';?>" alt="" width="500px">


<!-- variables -->
    <?php
    $fname ='cherry';
    $lname ='liu';
    $name['fname'] = 'Cherry';
    ?>

    <?php echo $fname;?>

    <?php
        echo '<br>';
        // echo 'Hello ' . $fname . ' ' . $lname;
        echo 'Hello ' . $name['fname'] . ' ' . $lname;
    ?>

</body>
</html>