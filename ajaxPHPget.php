<?php
$servername = "mysql.nicsco22.dreamhosters.com";
$username = "chaosdblogin";
$password = "Hacker7*";
$dbname = "chaosbackenddb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}




$result = mysqli_query($conn, 'SELECT * FROM movie_reactions');
$result2 = $result->num_rows;





$result3 = mysqli_query($conn, 'SELECT * FROM movie_reactions');
$htmlTableString = '<table>
<tr>
  <th> ID</th>
  <th>title</th>
  <th>rating</th>
  <th>comments/th>
   <th>username</th>
</tr>';



for($i=0;$i<$result2;$i++) {

// This command pulls the next row of the query result
$row = mysqli_fetch_assoc($result3);




// The .= appends to whatever the variable string is
$htmlTableString .= '<tr>';


$htmlTableString .= '<td>' . $row['Band_Name'] . '</td>';
$htmlTableString .= '<td>' . $row['Song_Name'] . '</td>';
$htmlTableString .= '<td>' . $row['Release_Year'] . '</td>';




$htmlTableString .= '</tr>';
}

$htmlTableString .= '</table>';




echo '<style>
table, th, td {
border: 1px solid black;
}
</style>';


echo $htmlTableString;



mysqli_close($conn);


?>