<?php
$servername = "mysql.nicsco22.dreamhosters.com";
$username = "chaosdblogin";
$password = "Hacker7*";
$dbname = "chaosbackenddb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection



$result = mysqli_query($conn, 'SELECT * FROM movie_reactions');
$result2 = $result->num_rows + 1;


 
  /*
  echo json_encode([$result2,$firstName,$stockName,$stockSymbol, $stockIndex, $comments]);  

*/

$result3 = mysqli_query($conn, 'SELECT * FROM movie_reactions');



$rows = array();
while($r = mysqli_fetch_assoc($result3)) {
    $rows[] = $r;
}
echo json_encode($rows);
  
  

  
	

mysqli_close($conn);

?>