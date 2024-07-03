<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <h1>PS Games Tracker</h1>
        <p>The PS Games Tracker keeps track of all my purchased PlayStation games, storing details like genre, personal ratings, total hours played, and release dates. It also includes a play log that tracks the hours played and progress for each game session.</p>
        <div class="accordion" id="accordionExample">

            <?php
            //connection to database
            $connect = mysqli_connect('localhost', 'root', 'root', 'PSGameTracker');

            if (!$connect) {
                //For error handling
                echo 'Error code:' . mysqli_connect_errno();
                echo 'Error code:' . mysqli_connect_error();
                exit;
            }

            //GET data for Games Collection
            $queryGames = 'SELECT gameid, title, genre, player_mode, released_date, price, status, rating, hours_played, description FROM PSGames';
            //run and execute query
            //Needs two parameters (1. connection string, 2. query)
            $resultGames = mysqli_query($connect, $queryGames);

            foreach ($resultGames as $game) {
                $gameid = $game['gameid'];

                // GET data for playlogs based on the gameid
                $queryLogs = 'SELECT logid, gameid, log_date, status, hours_played, progress FROM PlayLogs WHERE gameid = ' . $gameid . ' ORDER BY log_date DESC';
                $resultLogs = mysqli_query($connect, $queryLogs);

                // Output accordion item
                echo '<div class="accordion-item">
                          <h2 class="accordion-header" id="heading' . $game['gameid'] . '">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $game['gameid'] . '"
                                  aria-expanded="false" aria-controls="collapse' . $game['gameid'] . '">
                                  #' .  $game['gameid'] . '&nbsp<strong>' . $game['title'] . '</strong>&nbsp - ' . $game['status'] .
                    '</button>
                          </h2>
                          <div id="collapse' . $game['gameid'] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $game['gameid'] . '"
                              data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                  <p><strong>Genre:</strong> ' . $game['genre'] . '</p>
                                  <p><strong>Player Mode:</strong> ' . $game['player_mode'] . '</p>
                                  <p><strong>Released Date:</strong> ' . $game['released_date'] . '</p>
                                  <p><strong>Status:</strong> ' . $game['status'] . '</p>
                                  <p><strong>Rating:</strong> ' . $game['rating'] . '</p>
                                  <p><strong>Hours Played:</strong> ' . $game['hours_played'] . '</p>
                                  <p><strong>Description:</strong> ' . $game['description'] . '</p>
                                  <p>
                                      <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample' . $game['gameid'] . '" role="button" aria-expanded="false" aria-controls="collapseExample' . $game['gameid'] . '">
                                          View Play Logs
                                      </a>
                                  </p>
                                  <div class="collapse" id="collapseExample' . $game['gameid'] . '">
                                      <div class="card card-body">
                                          <table class="table table-bordered table-striped"> <!-- Added table-bordered -->
                                              <thead>
                                                  <tr>
                                                      <th scope="col">Log Date</th>
                                                      <th scope="col">Status</th>
                                                      <th scope="col">Hours Played</th>
                                                      <th scope="col">Progress</th>
                                                  </tr>
                                              </thead>
                                              <tbody>';


                //Error handling for fetching play logs
                if (!$resultLogs) {
                    echo '<tr><td colspan="4" class="text-danger">Failed to fetch play logs: ' . mysqli_error($connect) . '</td></tr>';
                } else {
                    if (mysqli_num_rows($resultLogs) == 0) {
                        echo '<tr><td colspan="4">No play logs found for this game.</td></tr>';
                    } else {
                        foreach ($resultLogs as $log) {
                            echo '<tr>
                                    <td>' . $log['log_date'] . '</td>
                                    <td>' . $log['status'] . '</td>
                                    <td>' . $log['hours_played'] . '</td>
                                    <td>' . $log['progress'] . '</td>
                                  </tr>';
                        }
                    }
                }
                echo '</tbody></table></div></div></div></div></div>';
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>