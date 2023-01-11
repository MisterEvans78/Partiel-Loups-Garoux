<div class="container mt-5">
    <h1 class="title">Salon de la partie</h1>
    <div class="row fond-regle">
    <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th> Numéro Joueur</th>
                <th> Pseudo joueur</th>
                <th> Pays du joueur </th>
            </tr>
            </thead>
            <tbody>
                
                
            </tbody>
    </div>
</div>
<?php
   // Connect to the database
  
  
   // Get the player's name from the request
   $player_name = $_POST['player_name'];
   
   // Check if the player name is already taken
   $result = $conn->query("SELECT * FROM players WHERE name = '$player_name'");
   if ($result->num_rows > 0) {
     echo json_encode(['error' => 'Name is already taken.']);
     exit;
   }
   
   // Add the new player to the database
   $result = $conn->query("INSERT INTO players (name) VALUES ('$player_name')");
   if ($result === TRUE) {
     echo json_encode(['success' => 'Player has joined the game.']);
   } else {
     echo json_encode(['error' => 'Failed to join the game.']);
   }
?>

<script >  // Connect to the database
  $conn = new mysqli(...);
  
  // Get the player's name from the request
  $player_name = $_POST['player_name'];
  
  // Check if the player name is already taken
  $result = $conn->query("SELECT * FROM players WHERE name = '$player_name'");
  if ($result->num_rows > 0) {
    echo json_encode(['error' => 'Name is already taken.']);
    exit;
  }
  
  // Add the new player to the database
  $result = $conn->query("INSERT INTO players (name) VALUES ('$player_name')");
  if ($result === TRUE) {
    echo json_encode(['success' => 'Player has joined the game.']);
  } else {
    echo json_encode(['error' => 'Failed to join the game.']);
  }
  function getPlayerList() {
  // Make an AJAX request to the PHP script
  fetch('path/to/get_player_list.php')
    .then(function(response) {
      return response.json();
    })
    .then(function(players) {
      // Update the page with the player list
      updatePlayerList(players);
    });
}
function updatePlayerList(players) {
  // Clear the current player list
  var playerList = document.getElementById("playerList");
  playerList.innerHTML = "";
}

  // Add the new players to the list
</script>