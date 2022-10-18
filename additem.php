<!DOCTYPE html>
<html>
<head>
<title>Old Factory Cafe - Add Menu item</title>
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

<head><title>Add Menu Item</title> </head>
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
<h1>Add New Menu Item</h1>
<h4>
<?php
$error=0;
//the data was sent using a form therefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Create')) {     
//validate incoming data - only the first field is done for you in this example - rest is up to you do
    
//roomname
       $itemname = clean_input($_POST['itemname']); 
//description
       $description = clean_input($_POST['description']);        
//roomtype
       $category = clean_input($_POST['category']);         
//beds
       $price = clean_input($_POST['price']);         
    
//save the item data if the error flag is still clear

  if ($error == 0)
	{
        $query = "INSERT INTO menu SET name=?,description=?,category=?,price=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'sssd', $itemname, $description, $category, $price); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Item details updated.</h2>";          
    } 
	else
	{ 
      echo "error in setting up post data";
    }      
}

?>
<h2>Add New Menu Item</h2>
<h4>
<form method="POST" action="additem.php">
   <p>
    <label for="itemname">Item name: </label>
    <input type="text" id="itemname" name="itemname" minlength="5" maxlength="60" size="60" required> 
  </p> 
  <p>
    <label for="description">Description: </label>
    <input type="text" id="description" name="description" size="150" minlength="5" maxlength="200" required> 
  </p>  
  <p>  
    <label for="category">Category: </label>
    <input type="radio" id="category" name="category" value="eat"> Eat 
    <input type="radio" id="category" name="category" value="drink"> Drink 
   </p>
  <p>
    <label for="price">Price: $</label>
    <input type="number" step="0.01" id="price" name="price" size="10" required> 
  </p> 
   <input type="submit" name="submit" value="Create">
 </form>
 </h4>

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
  <div class="w3-content" style="max-width:700px">>
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
