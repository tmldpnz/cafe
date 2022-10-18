<!DOCTYPE html>
<html>
<head>
<title>Old Factory Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
  height: 100%;
  font-family: "Inconsolata", sans-serif;
}

.bgimg {
  background-position: center;
  background-size: cover;
  background-image: url("https://www.w3schools.com/w3images/coffeehouse.jpg");
  min-height: 75%;
}

.menu {
  display: none;
}
</style>
</head>
<body>

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3">
      <a href="index.php" class="w3-button w3-block w3-black">CUSTOMER PAGE</a>
    </div>
  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Open from 6am to 5pm</span>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white" style="font-size:90px">the<br>Old Factory Cafe</span>
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-large">
    <span class="w3-text-white">15 Cafe Street, Auckland</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- Menu Container -->
<div class="w3-container w3-yellow" id="items">
  <div class="w3-content" style="max-width:1000px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">MANAGE MENU ITEMS</span></h5>
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
<h4><a href='additem.php'>[Add an item]</a></h4>

		<div id="menuitems" class="w3-tag w3-wide">
<table border="1" class="w3-container w3-yellow">
<thead><tr><th>Category</th><th>Menu Item</th><th colspan="3">Action</th></tr></thead>
<?php

//makes sure we have items
if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
		
	  $id = $row['menuid'];	
	  
	  echo '<tr><td>'.$row['category'].'</td><td>'.$row['name'].'</td>';
	  echo '<td><a href="viewitem.php?id='.$id.'">[view]</a></td>';
	  echo '<td><a href="edititem.php?id='.$id.'">[edit]</a></td>';
	  echo '<td><a href="deleteitem.php?id='.$id.'">[delete]</a></td>';
      echo '</tr>';	
   }
} else echo '<p>No items found!</p>'; //suitable feedback

mysqli_free_result($result); //free any memory used by the query

?>    </table>
    </div>
  </div>
</div>

<!-- Booking Container -->
<div class="w3-container w3-yellow" id="bookings">
  <div class="w3-content" style="max-width:1000px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">MANAGE BOOKINGS</span></h5>
<?php

//prepare a query and send it to the server
$query = 'SELECT bookingid,name,people,dateandtime,comment FROM booking';
$result = mysqli_query($db_connection, $query);
$rowcount = mysqli_num_rows($result); 
?>
<h4><a href='adminbookingform.php'>[Add a booking]</a></h4>

		<div id="bookings" class="w3-tag w3-wide">
<table border="1" class="w3-container w3-yellow">
<thead><tr><th>Name</th><th>Number in Group</th><th>Date and Time</th><th>Comments</th></tr></thead>
<?php

//makes sure we have items
if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
		
	  $id = $row['bookingid'];	
	  
	  echo '<tr><td>'.$row['name'].'</td><td>'.$row['people'].'</td><td>'.$row['dateandtime'].'</td><td>'.$row['comment'].'</td>';
	  echo '<td><a href="editbooking.php?id='.$id.'">[edit]</a></td>';
	  echo '<td><a href="deletebooking.php?id='.$id.'">[delete]</a></td>';
      echo '</tr>';	
   }
} else echo '<p>No bookings found!</p>'; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($db_connection); //close the connection once done
?>    </table>
    </div>
  </div>
</div>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>


</body>
</html>
