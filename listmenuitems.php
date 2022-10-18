<!DOCTYPE HTML>
<html><head><title>Edit Menu Items</title> </head>
 <body>

<?php
include "config.php"; //load in any variables
$db_connection = mysqli_connect(HOST, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//prepare a query and send it to the server
$query = 'SELECT menuid,category,description,name, price FROM menu';
$result = mysqli_query($db_connection, $query);
$rowcount = mysqli_num_rows($result); 
?>
<h1>Menu Items</h1>
<h2><a href='additem.php'>[Add an item]</a><a href="/cafe">[Return to main page]</a></h2>
<table border="1">
<thead><tr><th>Category</th><th>Menu Item</th><th>Action</th></tr></thead>
<?php

//makes sure we have rooms
if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
	  $id = $row['menuid'];	
	  echo '<tr><td>'.$row['category'].'</td><td>'.$row['name'].'</td>';
	  echo '<td><a href="viewitem.php?id='.$id.'">[view]</a>';
	  echo '<a href="edititem.php?id='.$id.'">[edit]</a>';
	  echo '<a href="deleteitem.php?id='.$id.'">[delete]</a></td>';
      echo '</tr>';
   }
} else echo '<h2>No items found!</h2>'; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($db_connection); //close the connection once done
?>
</table>
</body>
</html>
  