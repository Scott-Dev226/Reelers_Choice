<?php
$servername = "mysql.nicsco22.dreamhosters.com";
$username = "chaosdblogin";
$password = "Hacker7*";
$dbname = "chaosbackenddb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection


$timeStamp = date("m/d/Y");
$firstName = $_REQUEST['first-name'];
$stockName = $_REQUEST['stock-name'];
$stockSymbol = $_REQUEST['stock-symbol'];
$stockIndex = $_REQUEST['stock-index'];
$comments = $_REQUEST['comments'];

$result = mysqli_query($conn, 'SELECT * FROM Stock_Hint');
$result2 = $result->num_rows + 1;

$sql = "INSERT INTO Stock_Hint (Primary_ID, Date_Time, First_Name,Stock_Name,Stock_Symbol,Stock_Index,Comments)
VALUES ($result2, '$timeStamp','$firstName','$stockName','$stockSymbol', '$stockIndex',' $comments' )";

mysqli_query($conn, $sql);
 
  /*
  echo json_encode([$result2,$firstName,$stockName,$stockSymbol, $stockIndex, $comments]);  

*/

$result3 = mysqli_query($conn, 'SELECT Date_Time,First_Name,Stock_Symbol FROM Stock_Hint');



$rows = array();
while($r = mysqli_fetch_assoc($result3)) {
    $rows[] = $r;
}
echo json_encode($rows);
  
  

  
	
 echo $jsonPayload;
mysqli_close($conn);

?>