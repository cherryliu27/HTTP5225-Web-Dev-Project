<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loops</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
      <div class="row">
          
          <?php
            function getUsers(){
              $url = "users.json";
              $data = file_get_contents($url);
              //echo gettype($data);
              return json_decode($data, true);
            }
        
            $users = getUsers();


            if(!empty($users)){
              foreach($users as $user){
                echo
                '<div class="col-md-3">
                  <div class="card" style="">
                  <div class="card-body">
                    <h5 class="card-title">' . $user['name'] . '</h5>
                    <p class="card-text">' . $user['email'] . '</p>
                  </div>
                </div>
                </div>';
              }
            }
          ?>
        </div>
      </div>
    </div>


</body>
</html>


