<!DOCTYPE html>
<html>
<head>
<title>Old Factory Cafe - Add Booking (Admin)</title>
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

<?php
include "config.php"; //load in any variables
include "cleaninput.php";

$db_connection = mysqli_connect(HOST, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}
?>
<h3>Add New Booking</h3>

<?php
$error=0;
//the data was sent using a form therefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Create')) {     
//validate incoming data - only the first field is done for you in this example - rest is up to you do
    
//roomname
       $name = clean_input($_POST['name']); 
//description
       $people = clean_input($_POST['people']);        
//roomtype
       $dateandtime = clean_input($_POST['dateandtime']);         
//beds
       $comment = clean_input($_POST['comment']);         
    
//save the item data if the error flag is still clear

  if ($error == 0)
	{
        $query = "INSERT INTO booking SET name=?,people=?,dateandtime=?,comment=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'ssss', $name, $people, $dateandtime, $comment); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h3>Booking added.</h3>";          
    } 
	else
	{ 
      echo "error in setting up post data";
    }      
}

?>
<h2>Add New Booking</h2>
<div class="w3-container" id="where" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <p><strong>Reserve</strong> a table:</p>
<form action="addbooking.php" method="POST" target="_blank">
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="name"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="How many people" required name="people"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="datetime-local" placeholder="Date and time" required name="dateandtime"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message / Special requirements" name="message"></p>
      <p><input class="w3-button w3-black" type="submit" value="Create"></p>
</form>
  </div>
</div>

<?php 
mysqli_close($db_connection); //close the connection once done
?>



<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3">
      <a href="admin.php" class="w3-button w3-block w3-black">ADMIN HOME</a>
    </div>
  </div>
</div>

</h4>
<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- About Container -->
<div class="w3-container" id="about">
  <div class="w3-content" style="max-width:700px">
    <img src="https://www.w3schools.com/w3images/coffeeshop.jpg" style="width:100%;max-width:1000px" class="w3-margin-top">
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
